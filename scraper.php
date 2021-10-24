<?php

// Scraper para la web de filmaffinity.com, obtiene la puntuación de una
// película dada una lista de películas dentro de un directorio.
// No funciona cuando encuentra varias películas que tienen el mismo nombre

class Principal {
    
    public function __construct() {

        // La carpeta de nuestro recurso compartido montado en el OS
        $this->fileList = glob('/media/NAS/*');
    }
    
    public function Dom($body) {
        
        $dom = new DomDocument;
        $dom->preserveWhiteSpace = false;
        $dom->validateOnParse    = true;

        @$dom->loadHTML($body);
        
        // El id del dato que nos interesa capturar
        $this->belement = $dom->getElementById("movie-rat-avg");
        return $this->belement;
    }

    public function Main(){

    foreach($this->fileList as $key => $value){

        $n_value = str_replace(array('/media/NAS/', '.mkv', '.avi', '.mp4'),"",$value); 
        $n_value_corregido = str_replace(' ', '%20', $n_value);
        
        $homepage = file_get_contents("https://www.filmaffinity.com/es/search.php?stext=$n_value_corregido");
        
        // Descargamos los ficheros html de las fichas encontradas
        file_put_contents('/var/www/html/lenguajes/php/tmp/'.$n_value.'.php', $homepage);   
        $body = file_get_contents('/var/www/html/lenguajes/php/tmp/'.$n_value.'.php');

        $this->Dom($body);
        $spl = new SplFileInfo($n_value);
        
        if ($n_value == 'Thumbs.db' || $n_value == 'Thumbs.db.php'){echo '';} 
        if ($spl->getExtension() == '.srt'){echo '';}
        else { echo $n_value.' > '.@$this->belement->textContent.'<br>';}
        
        // Borramos los temporales
        unlink('/var/www/html/lenguajes/php/tmp/'.$n_value.'.php');
        }
        
    }
}

$ejecuta = new Principal();
$ejecuta->Main();
