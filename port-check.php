<?php

$wait  = 1; // wait Timeout In Seconds
$host  = '192.168.1.33';
$ports = [
    'http'  => 80,
    'https' => 443,
    'ftp'   => 21,
    'ssh'   => 22
];

foreach ($ports as $key => $port) {
    
    $fp = @fsockopen($host, $port, $errCode, $errStr, $wait);
    echo "Abriendo socket en: $host:$port ($key) ==> ";
    
    if ($fp) {
        echo 'SUCCESS <br>';
        fclose($fp);
    } else {
        echo "ERROR: $errCode - $errStr <br>";
    }
    echo PHP_EOL;
}
