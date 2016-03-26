<?php
// A configurer :
   // Nom du site
    define('NAME',      'Sword CMS');
   // Url commençant par http:// jusqu'au répertoire du site, sans / final
    define('BASE_PATH', 'http://localhost/sword'); 
   // Mode débug. Mettre en TRUE durant le développement, FALSE en production.
    define('DEBUG_MODE', TRUE);

    
/* ---------------------------------------------------------------------
 * Détails pour les développeurs
 * Ne pas modifier sans savoir ce que vous faites
 */

// Dossiers
   // Système
    define('SYS_DIR',  'system');
   // Application
    define('APP_DIR',  'application');
   // Assets
    define('ASSETS_DIR',  'themes');
    
// Chemins
   // Système
    define('SYS_PATH',__DIR__.'/'.SYS_DIR);
   // Application
    define('APP_PATH',__DIR__.'/'.APP_DIR);
   // Assets
    define('ASSETS_PATH',__DIR__.'/'.ASSETS_DIR);
    
// Theme (Dossier du thème dans assets)
    define('THEME','swordorigin');
    
// Controller par défaut
   // Fichier controller
    define('DEFAULT_CONTROLLER',  'Thread');
   // Méthode
    define('DEFAULT_METHOD',  'index');

if(DEBUG_MODE)
    error_reporting(E_ALL | E_STRICT);
else
    error_reporting(0);
    
session_start(); 

require_once SYS_DIR.'/core/Arkalys.php';
$Arkalys = new Arkalys();
$Arkalys->run();
