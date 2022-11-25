<?php

namespace App;

class Tools{

    public static $imagesMIME=['image/png', 'image/jpeg', 'image/webp', 'image/tiff', 'image/ico', 'image/bmp'];

    public static function mostrarError($var){
        if(isset($_SESSION[$var])){
            echo <<<TXT
                <p style="color:red;font-size=1em">{$_SESSION[$var]}</p>
            TXT;
            unset($_SESSION[$var]);
        }
    }
}