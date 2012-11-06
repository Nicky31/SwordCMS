<?php if(! defined('BASE_PATH') ) exit('No direct script access allowed');

/*
 * Appelle la méthode & le controller demandés
 * -------------------------------------------
 */

class Arkalys
{       
    private static $instance;
    private        $Controller;
    private        $BM;
    private        $config;
    
    // Getters
     public        function config()         { return $this->config['general']; }
     public static function &get_instance() { return self::$instance;          }
         
        public function __construct()
         { 
             self::$instance =& $this;
             require_once SYS_DIR.'/core/SystemHelper.php'; // Fonctions de base
             set_exception_handler('exception_handler');    // Gestion des exceptions
          
           /*
            *  Require des fichiers systèmes
            */
             require_once SYS_DIR.'/core/Benchmarks.php';
             require_once SYS_DIR.'/core/Output.php';
             require_once SYS_DIR.'/core/Model.php';
             require_once SYS_DIR.'/core/Controller.php';
             require_once SYS_DIR.'/core/Router.php';
            
           /*
            * Instanciation du benchmark
            */
             $this -> BM = new Benchmarks;
             $this -> BM -> mark('total_execution_time_start');
 
          /*
           * Chargement de la config de l'autoload
           */
             loadFile('config', 'autoload',TRUE,FALSE); // Include de la config, uniquement dans dossier app
             
             if(empty($autoload) OR !is_array($autoload)) 
                 throw new Exception("Fichier <b>".APP_DIR."/config/autoload.php</b> mal formaté : Tableau \$autoload inexistant");
             else 
                 $this->config['autoload'] = $autoload;
             
          /*
           * ------
           * Chargement de la config générale
           */
             loadFile('config', 'config', TRUE, FALSE); // Include de la config 
             
             if(empty($config) OR !is_array($config))
                   throw new Exception('Fichier <b>'.APP_DIR.'/config/config.php</b> mal formaté : Tableau $config inexistant');
             else
                   $this->config['general'] = $config;
             
          /*
           * -- 
           * Chargement des fichiers de base
           */
             $this->autoloads($this->config['autoload']);
         }
        
	public function run()
	 {  
            $Router = new Router;
            $url = $Router();
            
		if(file_exists(APP_DIR.'/controllers/'. $url['controller'] .'.php')) // Si le controller demandé existe
		{ 
                        include(APP_DIR.'/controllers/'. $url['controller'] .'.php');
			$this->Controller= new $url['controller'];
		} else { // Sinon on en choisit un par défaut
                        include(APP_DIR.'/controllers/News.php');
                        $this->Controller = new News;
			$url['method'] = 'index';
		}

		if(method_exists($this->Controller,$url['method']))
                        call_user_func_array(array($this->Controller,$url['method']),array($url['args']));
                else 
			$this->Controller -> undefinedAction();	 
	 }

         public function autoloads($autoloads) // Chargement automatique des fichiers de base 
         {
             foreach($autoloads as $k => $v)
             { 
                 if($k == 'helpers') // Chargement des helpers
                 {
                     foreach($autoloads[$k] as $autoload)
                     {
                         loadFile('helpers', $autoload);
                     }
                 }
             }
         }
         
}