<?php
// liens
$config['forum'] = 'http://www.funky-emu.net/';
$config['vote'] = 'http://www.funky-emu.net/';
$config['configName'] = 'config.xml'; // Page Nous Rejoindre : nom de la config ou de l'uplauncher placé dans dossier uploads/

// Config générale
$config['pts_vote'] = 5; // gain de pts boutique par vote
$config['pts_credit'] = 100; // gain de pts boutique par créditage starpass
$config['enable_hash'] = false; // Activation ou désactivation du hash : true ou false
$config['hash'] = 'sha512'; // type de hashage si activé
$config['gmLevel'] = 2; // Niveau gm minimum pour pouvoir administrer le site (entre autres, gestion des news)
$config['maxCos'] = 100; // Limite de connection sur le serveur. Je ne sais plus si c'est utilisé
$config['perfectPrice'] = 1.20; // Boutique : Si jet parfait, multiplier prix par perfectPrice. 1.20 = 20% en plus

// Pagination
$config['news_per_page'] = 3; // Nombre de news par pages sur la page d\'accueil
$config['persos_per_page'] = 50; // Nombre de persos/guildes/voteurs par pages sur les trois ladders

// Config starpass
/* Création du document starpass: Starpass CLASSIC, puis 
 * Url de la page d'acc�s = http://urlsite/index.php/credit/starpass
 * Url du document = http://urlsite/index.php/credit/creditage
 * Url d'erreur = laisser vide
 */
$config['starpassDocId'] = 105950; // Id du document starpass, vous pouvez l'avoir sur votre compte starpass > Gestion documents > colonne "Identifiant"
$config['starpassId'] = 61718; // Id du compte starpass ; visible dans le script de protection , le nombre apr�s &idp=xxx

// Serveurs de jeux
$config['servers'] = array(
  'Sword Origin Fun' => array( // Nom du serveur
      'host' => 'localhost', // IP
      'port' => 5555,        // Port
      'rateXP' => 4,         // Rate exp
      'rateDrop' => 2,       // Rate drop
      'rateKamas' => 1,      // Rate Kamas
      'startLevel' => 1,     // Niveau de départ
      'lastLevel' => 200     // Niveau maximum
  )  
);