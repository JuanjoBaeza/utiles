<?php

// https://fossbytes.com/free-proxy-list/

class Principal {
    
    public function __construct() {

        $this->wait = 1; // wait Timeout In Seconds
        $this->host = null;
        $this->port = null;
        $this->file = fopen("http_proxies.txt", "r");
    }
    
    public function abrirFichero() {

        if ($this->file) {
        
            while(!feof($this->file)) {
            
                $this->line = fgets($this->file);

                if ($this->line == '') { echo ''; } else { $this->checkIP($this->line); }
            }
            fclose($this->file);
        }        
    }
    
    public function checkIP($line) {
    
        $porciones = explode(":", $line);
        $host = $porciones[0];
        $port = $porciones[1];
            
        $fp = @fSockOpen($host, $port, $errCode, $errStr, $this->wait);
        
        echo "Abriendo socket en: $host:$port => ";

        if ($fp) {
               echo 'SUCCESS <br>';
               fclose($fp);
        } else {
               echo "ERROR: $errCode - $errStr <br>";
        }
        echo PHP_EOL;
    }    
}
$ejecuta = new Principal();
$ejecuta->abrirFichero();
