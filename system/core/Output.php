<?php if(! defined('BASE_PATH') ) exit('No direct script access allowed');

/*
 * Traite le flux sortant pour afficher la page dans son intégralité en fin de chargement.
 * ---------------------------------------------------------------------------------------
 */

class Output
{
   // Variables nécessaires au layout / views
    private   $_args        = array(); 
   // Html des différentes vues associé à une variable
    private   $_views       = array();
   // Html du profiler
    public    $_profiler;
		
    public function __construct()   
    {
        // Config
        $this->_args['config'] = Arkalys::get_instance()->config();
		
	// Variables
        $this->_args['forum'] = $this->config('forum');
        $this->_args['gm'] = (isset($_SESSION['gmlevel']) && $_SESSION['gmlevel'] >= $this->config('gmLevel')) ? true : false;       
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
		
    public function enable_profiler($bool)
    {
        $this->_profiler = $bool;
    }
	
    public function view($file,$params = array(),$var = 'content')
    {
        extract($params);
	extract($this->_args);
			
	ob_start();
        if(file_exists(ASSETS_PATH.'/'. THEME .'/views/'. $file .'.php'))
            require_once ASSETS_PATH.'/'. THEME .'/views/'. $file .'.php';
        else
            throw new Exception("Fichier vue <b>". $file.".php introuvable !");
        $this->_views[$var] .= ob_get_contents();
	ob_end_clean();
    }
		
    public function display()
    {   
        
        // Aucun panel spécifié : celui par défaut
        if(empty($this->_views['panel']))
        {
            $panelName = (isset($_SESSION['id'])) ? 'login' : 'logout';
            $this->view('panel/'.$panelName, array(), 'panel');
        }
        
        // Topbar
        $topbarName = (isset($_SESSION['id'])) ? 'topbar_login' : 'topbar_logout';
        $this->view('panel/'.$topbarName, array(), 'topbar');
        
        ob_start();
	extract($this->_args); // On extrait les var nécessaires au layout
        extract($this->_views); // Vues chargées                
        
        if(file_exists(ASSETS_PATH.'/'. THEME .'/template.php'))
            include ASSETS_PATH.'/'. THEME .'/template.php';
        else
            throw new Exception("Template <em>".ASSETS_PATH."/". THEME . "/<b>template.php</b></em> introuvable !");
                        
        $page = ob_get_contents();
        ob_end_clean();
                        
        if($this->_profiler) // Profiler
        { 
            $statement['time'] = array_sum($statement['time']);
                
            loadFile('libraries', 'Profiler', SYS);
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