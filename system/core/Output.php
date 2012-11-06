<?php if(! defined('BASE_PATH') ) exit('No direct script access allowed');

/*
 * Traite le flux sortant pour afficher la page dans son intégralité en fin de chargement.
 * ---------------------------------------------------------------------------------------
 */

class Output
{
      private   $_content;
      protected $_layout      = 'template.php';
      private   $_args        = array(); // Diverses variables nécessaires au template
      private   $_viewPanel;
      private   $_panelHtml;
      private   $profiler;
		
	public function __construct()
	{
          // Config
           $this->_args['config'] = Arkalys::get_instance()->config();

	  // Panel par défaut
           $this->_viewPanel = (isset($_SESSION['id'])) ? 'login' : 'logout';
           $this->setPanel($this->_viewPanel);
		
	  // Variables
           $this->_args['forum'] = $this->config('forum');
           $this->_args['gm'] = (isset($_SESSION['rang']) && $_SESSION['rang'] >= $this->config('gmLevel')) ? true : false;       
        }
          
        public function __get($name) 
        {
           if(isset($this->$name))
              return $this->$name;
           else 
              throw new Exception("Echec de la tentative d'accès à l'attribut <b>". $name .".</b>");
        }
	   
        public function setArg($cle,$value)
	{
           if(empty($this->_args[$cle]))
               $this->_args[$cle] = $value;
           else 
               $this->_args[$cle] = array_merge_recursive((array) $this->_args[$cle], (array) $value);
        }
          
        public function config($item)
        {
           return $this->_args['config'][$item];
        }
		
	public function setPanel($file)
	{
           ob_start();
           extract($this->_args);
	   include(APP_PATH.'/views/panel/'. $file .'.php');
	   $this->_panelHtml = ob_get_contents();
	   ob_end_clean();
        }
		
        public function enable_profiler($bool)
        {
           $this->profiler = $bool;
        }
	
	public function view($file,$params = array())
	{
	   extract($params);
	   extract($this->_args);
			
	   ob_start();
           if(file_exists(APP_PATH.'/views/'. $file .'.php'))
               require_once APP_PATH.'/views/'. $file .'.php';
           else
               throw new Exception("Fichier vue <b>". $file.".php introuvable !");
           $this->_content .= ob_get_contents();
	   ob_end_clean();
        }
		
        public function display()
	{   
           ob_start();
	   $content=$this->_content; // Contenu de la page
	   $panel=$this->_panelHtml; // Contenu du panel
	   extract($this->_args); // On extrait les var nécessaires au layout
                        
           if(file_exists(APP_PATH.'/themes/'.$this->_layout))
               include APP_PATH.'/themes/'.$this->_layout;
           else
               throw new Exception("Template <em>".APP_PATH."/themes/<b>".$this->_layout."</b></em> introuvable !");
                        
           $page = ob_get_contents();
           ob_end_clean();
                        
           if($this->profiler) // Profiler
           { 
               $statement['time'] = array_sum($statement['time']);
                
               require_once SYS_PATH.'/helpers/Profiler.php';
               $Profiler = new Profiler;
               $BM =& Benchmarks::get_instance();
               $BM->mark('total_execution_time_end');
               $BM->set_duration('queries_execution_time',$statement['time']);
                            
               if(preg_match('#</body>#i', $page))
                   $page = preg_replace('#</body>#',$Profiler->run() .' </body>',$page);
               else 
                   $page .= $Profiler->run();
           }
           
           echo $page;
        }
}