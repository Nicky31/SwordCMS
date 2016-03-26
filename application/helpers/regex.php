<?php
 /*
  * Expressions régulières
  * ----------------------
  */	

    function checkLogin($login)        // NDC: Entre 6 & 20 lettres et chiffres
    {
	return preg_match('#^[a-zA-Z0-9-]{6,20}$#',$login);
    }
   
    function checkPseudo($pseudo)      // Pseudo: Entre 4 & 20 lettres & chiffres
    {
	return preg_match('#^[a-zA-Z0-9]{4,20}$#',$pseudo);
    }
	
    function checkMail($mail)          // Forme d'un email
    {
	return preg_match('#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#',$mail);
    }

    function checkQuestion($question)  // Question secrète: 5 à 48 lettres,chiffres,é,è,espaces & tirets suivis d'un point d'interrogation
    {
	return preg_match('#^[a-zA-Z0-9éè\s-]{5,48}\?$#',$question);
    }

    function checkAnswer($answer)      // Réponse secrète: 5 à 48 lettres,chiffres,é,è,espaces,tirets
    {
	return preg_match('#^[a-zA-Z0-9éè\s-]{5,48}$#',$answer);
    }

