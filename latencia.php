<?php

$domain   = "192.168.1.4";
$port     =  80;
$ntimes   =  15;
$timeout  =   1;

function ping($host, $port, $timeout) { 

	  $tB = microtime(true); 
	  $fP = fSockOpen($host, $port, $errno, $errstr, $timeout);
	  
	  	if (!$fP) { return "down"; } 
		  $tA = microtime(true);
		  
		  return round((($tA - $tB) * 1000), 0)." ms";
		  fclose($fP);
}

echo "LATEN  DOMAIN\n";

for ($i = 1; $i <= $ntimes; $i++) {
 
 	$a = ping($domain, $port, $timeout);

    echo $a, "  $domain\n";
    sleep(1);
}