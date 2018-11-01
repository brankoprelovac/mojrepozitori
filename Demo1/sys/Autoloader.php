<?php
    function __autoload($imeKlase){
        if (in_array ($imeKlase, ['Controller', 'Database', 'Misc', 'ModelInterface', 'Session', 'AdminController', 'ApiController'])) {
            require_once 'sys/' . $imeKlase . '.php';
        } elseif (preg_match('/^([A-Z][a-z]+)+Controller$/', $imeKlase)){
            require_once 'app/controllers/' . $imeKlase . '.php';
        } elseif (preg_match('/^([A-Z][a-z]+)+Model$/', $imeKlase)){
            require_once 'app/models/' . $imeKlase . '.php';
        } elseif ($imeKlase === 'Configuration') {
            require_once $imeKlase . '.php';
        }
    }