<?php if(! defined('BASE_PATH') ) exit('No direct script access allowed');

/*
 * Classe mère des controllers
 * Implémente les différentes methodes de base nécessaires à tout controller.
 * Ne s'instancie pas directement.
 * --------------------------------------------------------------------------
 */

abstract class Controller
{	
    private static $instance;
    protected      $output;
    protected      $models     = array(); // Nom des models instanciés
    
    // Getters
   public static function &get_instance()  { return self::$instance; }
   public        function &output()         { return $this->output;   }
           
   public function __get($name) 
   {      
          if(isset($this->$name))
              return $this->$name;
          else 
              throw new Exception("Echec de la tentative d'accès à l'attribut <b>". $name .".</b>");
   }
       
   public function __construct()
   {   
          self::$instance =& $this;
          $this->output = new Output;
                
          $this->model('IndexModel','indexManager');
          $stats = $this->indexManager->initStats($this->output->config('serverHost'),$this->output->config('serverPort'));
          $this -> output -> setArg('stats',$stats);
   }
        
   public function __destruct()
   {
          if($this->output->profiler && sizeof($this->models) > 0) // Si profiler == 1 && modèles uses
              foreach($this->models as $model)
                  $this->$model->__destruct(); // Destruction des modèles pour récupérer la liste des requêtes 
            
          $this->output->display();
   }

   public function model($model,$name = NULL)
   {       
          loadFile('models', $model);              // Include
          $name = (empty($name)) ? $model : $name; // Nom de l'attribut
            
          if(empty($this->$name)) {
              $this->$name = new $model;
              $this->models[] = $name; // Liste des modèles chargés
          } else
              throw new Exception("Un modèle du nom de <b>". $name ."</b> est déjà instancié !");
   }
   
   public function helper($helpers)
   {
          if(is_array($helpers))
          {
              foreach($helpers as $helper)
              {
                  $this->helper($helper);
              }
              
              return TRUE;
          }
          
          loadFile('helpers', $helpers);
   }
        
   public function library($libraries,$params)
   {
          if(is_array($libraries))
          {
              foreach($libraries as $library)
              {
                  $this->$library($library);
              }
              
              return TRUE;
          }
          
          loadFile('libraries', $libraries);
          $this->$libraries = new $libraries($params);
   }
        
   public function undefinedAction()
   {
          $this->output->view('errors/action_notfound');
   }
	
   public function loadController($controller,$method,$args = array()) // Charge un second contrôleur
   {
	  require_once(APP_PATH.'controllers/'. $controller .'.php');
	  $this->SecundController = new $controller;
          call_user_func_array(array($this->SecundController,$method),array($args));
    }
}