<?php
error_reporting(E_ALL | E_STRICT);

// Nom
    define('NAME',      'Arkalys');

// Url commençant par http:// jusqu'au répertoire du site, sans / final
    define('BASE_PATH', 'http://localhost/MVC'); 
    
// Dossier systeme
    define('SYS_DIR',  'system');

// Dossier application
    define('APP_DIR',  'application');
    
// Dossier assets
    define('ASSETS_DIR',  'assets');
    
// Chemin Application
    define('APP_PATH',__DIR__.'/'.APP_DIR);
    
// Chemin Système
    define('SYS_PATH',__DIR__.'/'.SYS_DIR);
    
// Controller par défaut
    define('DEFAULT_CONTROLLER',  'News');
    
// Méthode par défaut
    define('DEFAULT_METHOD',  'index');
    
session_start(); 

require_once SYS_DIR.'/core/Arkalys.php';
$Arkalys = new Arkalys();
$Arkalys->run();
