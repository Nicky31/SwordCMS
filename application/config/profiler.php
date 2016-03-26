<?php

/*
 * Configuration du profiler
 * Définit les sections à afficher
 * Activation du profiler via la méthode enable_profiler de la classe Output
 *    $this->output->enable_profiler(true);
 * -------------------------------------------------------------------------
 */

/*
 * Affiche tous les benchmarks enregistrés
 */
$profiler['benchmark']                = TRUE;

/*
 * Affiche la liste des données POST
 */
$profiler['post']                      = TRUE;

/*
 * Affiche la liste des données GET
 */
$profiler['get']                       = TRUE;

/*
 * Affiche la liste des données SESSION
 */
$profiler['session']                    = TRUE;

/*
 * Affiche la liste des requêtes et leur durée
 */
$profiler['queries']                   = TRUE;

/*
 * Affiche la configuration générale
 */
$profiler['config']                    = TRUE;