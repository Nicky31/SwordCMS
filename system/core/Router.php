<?php if(! defined('BASE_PATH') ) exit('No direct script access allowed');

/*
 * Router
 * Définit le contrôleur & la méthodes demandée ainsi que les arguments fournis en traitant l'url
 * Cette dernière suit par défaut la stucture suivante :
 * http://url_site/index.php/Controller/Methode/Arg1/Arg2
 * 
 * Le contrôleur sélectionné par défaut est News, la méthode sélectionnée par défaut est index
 * Ainsi, une adresse "http://url_site/index.php/Controller" demandera par défaut la méthode index de la 
 * classe Controller.
 * Le controller et la méthode par défaut sont configurables sur l'index.
 * ----------------------------------------------------------------------------------------------
 */

class Router
{
      public static $_router = array();
        
	public function __invoke()
	{            
	   self::$_router = array('controller' => DEFAULT_CONTROLLER,
                                  'method'     => DEFAULT_METHOD,
                                  'args'       => array());  
           
	   if(!empty($_SERVER['PATH_INFO'])) // Si le chemin est renseigné
	   {
              // Split des args 
	       $path_info = explode('/',$_SERVER['PATH_INFO']);

              // Détermine le controller
               if(sizeof($path_info) > 1)
               {
                   self::$_router['controller'] = ucfirst($path_info[1]);
               } else
               {
                   self::$_router['controller'] = DEFAULT_CONTROLLER;
               }
               
              // Détermine la méthode
               if(sizeof($path_info) > 2)
               {
                   self::$_router['method'] = $path_info[2];
               } else
               {
                   self::$_router['method'] = DEFAULT_METHOD;
               }
               
              // Ajax requête ? 
               if(isset($_POST['ajax']) && $_POST['ajax'] == 1)
               {
                   self::$_router['method'] = 'ajax';
               }
               
               if(sizeof($path_info) > 3) // S'il y a des arguments
               {
	           array_shift($path_info);
		   array_shift($path_info);
		   array_shift($path_info);
		   self::$_router['args'] = $path_info;
	       }
	   }
           
	   return self::$_router;
	}
	
}