<?php

/*
 * $autoload = array();
 * Array contenant tous les fichiers à inclure automatiquement au début du chargement de la page
 * Leur chargement se fait via la méthode autoloads de la classe native DependencyManager, appelée dans le Core
 * --
 * Autoloads possibles : helpers, models
 *
 * -------------------------------------------------------------------------------------------------   
 */

/*
 * $autoload['helpers'];
 * Array numeroté contenant le nom de tous les helpers à charger,
 * situés dans APP_PATH/helpers OU SYS_PATH/helpers
 */

$autoload = array();
$autoload['helpers'] = array('assets','urlManager','functions');

$autoload['libraries'] = array();

