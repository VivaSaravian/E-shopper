<?php

spl_autoload_register( function($classname){
    
    $array_paths = array(
        '/models/',
        '/components/'
    );

    foreach ($array_paths as $path){
        $path = ROOT . $path . $classname . '.php';
        if (is_file($path)){
            include_once($path);
        }
    }	
} );