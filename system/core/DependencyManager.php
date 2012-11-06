<?php if(! defined('BASE_PATH') ) exit('No direct script access allowed');

/*
 * Charge toutes les classes & objets demandés puis les garde en mémoire pour permettre leur utilisation
 * n'importe où.
 * Classe abandonnée .
 * -----------------------------------------------------------------------------------------------------
 */

class DependencyManager
{
      private static $listClasses = array(); // Liste des classes chargées 
      private static $listObjects = array(); // Liste des objets instanciés
      
    public static function load($class,$object = true,$alias = NULL) // Include une classe & l'instancie par défaut
    {
        if(is_array($class)) 
            list($name,$args) = $class;
        else
            $name = $class;
            
         $classNamePos = strrpos($name, '.') + 1; 
         $className = substr($name,$classNamePos); // Nom de la classe
         $alias = (!empty($alias)) ? $alias : $className;
         
        if(!in_array($alias,self::$listClasses)) // Si la classe n'a pas encore été include
        { 
            $path = str_replace('.', '/',$name) . '.php';
            $path = str_replace('sys', SYS_DIR,$path);
            $path = str_replace('app', APP_DIR,$path); // Chemin complet jusqu'au fichier classe
            
            
            if(file_exists($path)) {
                require_once $path;
                
                self::$listClasses[] = $alias; // On ajoute la classe à la liste des classes chargées

                if($object) { // S'il faut l'instancier
                    if(empty($args))
                        self::$listObjects[$alias] = new $className;
                    else
                        self::$listObjects[$alias] = new $className($args);
                    
                    return self::$listObjects[$alias];
                }
            }
            else 
                throw new Exception("Le fichier classe <b>". $path ."</b> est introuvable !");
        } else { // Si la classe est déjà include
            if($object) { 
                if(array_key_exists($alias,self::$listObjects)) // S'il est déjà instancié
                        return self::$listObjects[$alias]; 
                else { // sinon on l'instancie & le retourne
                    
                        if(empty($args))
                            self::$listObjects[$alias] = new $className;
                        else
                            self::$listObjects[$alias] = new $className($args);
                    
                    return self::$listObjects[$alias]; 
                }
            }
                
         }
    }
   
    public static function addObject($object,$alias,$force = false) // Ajouter un objet à l'array
    {
        if(!array_key_exists($alias, self::$listObjects)) // Si l'alias n'est pas répertorié
            self::$listObjects[$alias] = $object;
        else {
            if($force)
                self::$listObjects[$alias] = $object;
            else
                throw new Exception("L'objet <b>". $alias ."</b> est déjà répertorié dans la liste d'objets de la classe <b>DependencyManager</b>.");
        }
    }
    
   public static function auto_load($name) // Auto-load des helpers
    {          
            if(file_exists(APP_DIR.'/helpers/'. $name .'.php'))
                    self::load ('app.helpers.'. $name,false);
            elseif(file_exists(SYS_DIR.'/helpers/'. $name .'.php'))
                    self::load('sys.helpers.'. $name,false);	
    }
    
    public static function autoloads($autoloads) // Chargement automatique des fichiers de base 
    {
        foreach($autoloads as $k => $v)
        { 
            if($k == 'helpers') // Chargement des helpers
            {
                array_walk($autoloads[$k],'DependencyManager::auto_load');
            }
        }
    }
}
