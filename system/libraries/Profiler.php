<?php if(! defined('BASE_PATH') ) exit('No direct script access allowed');

/*
 * Classe Profiler
 * Rassemble & affiche des informations sur page courante
 * Inspiré du profiler du fw CodeIgniter
 */

class Profiler
{
    private $config       = array(); 
    private $benchmark;
    private $statement;
    
    public function __construct()
    {
        /*
         * Chargement de la configuration du profiler
         */
         if(file_exists(APP_PATH.'/config/profiler.php'))
                 require_once APP_PATH.'/config/profiler.php';
         else
                 throw new Exception("Fichier <em>".APP_PATH."/config/<b>profiler</b>.php</em> introuvable !");
 
         if(empty($profiler) OR !is_array($profiler)) 
                 throw new Exception("Fichier <b>".APP_PATH."/config/profiler.php</b> mal formaté : Tableau \$profiler inexistant");
         else 
                 $this->config = $profiler;
      
        /*
         * Chargement de la classe benchmarks
         */
         $this->benchmark =& Benchmarks::get_instance();
      
        /*
         * Chargement des informations SQL
         */
         $output =& Controller::get_instance()->output();
         $this->statement = (!empty($output->_args['statement'])) ? $output->_args['statement'] : null; // Données sql
         $this->statement['count'] = array_sum($this->statement['count']);
         $this->statement['time'] = array_sum($this->statement['time']);
    }
 
    public function run()
    {
        $profiler = '<div style=\'clear:both;background-color:#fff;padding:10px;\'>';
        
        foreach($this->config as $k => $v)
        {
            if($v)
            { 
                $func = 'compile_'.$k;
                $profiler .= (method_exists($this, $func)) ? $this->$func() : null;
            }
        }
        
        $profiler .= '</div>';
        return $profiler;
    }
    
    public function compile_benchmark()
    {
      $benchmarks = array();
      $profiler = "\n\n";
      $profiler .= '<fieldset style="border:1px solid red; color:red; background-color:#eee;padding:6px 10px 10px 10px;margin:20px 0 20px 0;"> <legend style="color: red;">BENCHMARKS</legend> <table style=\'width:100%\'>';
      
      foreach($this->benchmark->markers as $k => $v)
      {
         $point = substr($k, strrpos($k, '_') + 1); // Start or end ? 
         $markerName = str_replace('_'.$point,'',$k);
         
         if($point != 'full')
         {
            if(isset($this->benchmark->markers[$markerName.'_end']) && isset($this->benchmark->markers[$markerName.'_start']))
            {
                $time = $this->benchmark->elapsed_time($markerName.'_start',$markerName.'_end');
                $benchmarks[$markerName] = $time;
            }
         } else {
                $time = $this->benchmark->elapsed_time($markerName);
                $benchmarks[$markerName] = $time;   
         }
      }
      
      foreach($benchmarks as $k => $v )
      {           
         $profiler .= '<tr><td style=\'width:50%;padding:5px;color:#000;background-color:#ddd;\'> <b>'. ucwords(str_replace('_', ' ', $k)) .'</b> </td>
                       <td style=\'width:50%;padding:5px;color:red;font-weight:normal;background-color:#ddd;\'>'. $v .'</td>
                       </tr>';
      }
      
     return $profiler .= '</table> </fieldset>';
    }
    
    public function compile_post()
    { 
      $profiler = "\n\n";  
      $profiler .= '<fieldset style="border:1px solid forestgreen; color:green; background-color:#eee;padding:6px 10px 10px 10px;margin:20px 0 20px 0;"> <legend style="color: green;">POST DATA</legend>';
      
      if(empty($_POST))
          $profiler .= '<span style="font-weight: bold;">No POST data exists</span>';
      else {
          $profiler .= '<table style=\'width:100%\'>';
            foreach($_POST as $k => $v)
               $profiler .= '<tr><td style=\'width:50%;padding:5px;color:#000;background-color:#ddd;\'> $_POST[\''. $k.'\'] </td>
                             <td style=\'width:50%;padding:5px;color:green;font-weight:normal;background-color:#ddd;\'>'. $v .'</td>
                             </tr>';
            
          $profiler .= '</table>';
      }
      return $profiler .= '</fieldset>';
    }
    
    public function compile_get()
    { 
      $profiler = "\n\n";  
      $profiler .= '<fieldset style="border:1px solid blue; color:blueviolet; background-color:#eee;padding:6px 10px 10px 10px;margin:20px 0 20px 0;"> <legend style="color: blue;">GET DATA</legend>';
      
      if(empty($_GET))
          $profiler .= '<span style="font-weight: bold;color:blue;">No GET data exists</span>';
      else {
          $profiler .= '<table style=\'width:100%\'>';
            foreach($_GET as $k => $v)
               $profiler .= '<tr><td style=\'width:50%;padding:5px;color:#000;background-color:#ddd;\'> $_GET[\''. $k.'\'] </td>
                             <td style=\'width:50%;padding:5px;color:blue;font-weight:normal;background-color:#ddd;\'>'. $v .'</td>
                             </tr>';
            
          $profiler .= '</table>';
      }
      return $profiler .= '</fieldset>';
    }
    
    public function compile_session()
    { 
      $profiler = "\n\n"; 
      $profiler .= '<fieldset style="border:1px solid brown; color:brown; background-color:#eee;padding:6px 10px 10px 10px;margin:20px 0 20px 0;"> <legend style="color: brown;">SESSION DATA</legend>';
      
      if(empty($_SESSION))
          $profiler .= '<span style="font-weight: bold;">No SESSION data exists</span>';
      else {
          $profiler .= '<table style=\'width:100%\'>';
            foreach($_SESSION as $k => $v)
               @$profiler .= '<tr><td style=\'width:50%;padding:5px;color:#000;background-color:#ddd;\'> $_SESSION[\''. $k .'\'] </td>
                             <td style=\'width:50%;padding:5px;color:brown;font-weight:normal;background-color:#ddd;\'>'. $v .'</td>
                             </tr>';
            
          $profiler .= '</table>';
      }
      return $profiler .= '</fieldset>';
    }
    
    public function compile_queries()
    {        
        $profiler = "\n\n";
        $profiler .= '<fieldset style="border:1px solid orange; color:orange; background-color:#eee;padding:6px 10px 10px 10px;margin:20px 0 20px 0;"> <legend style="color: orange;">QUERIES (<b>'. $this->statement['count'] .'</b>) </legend>';
        
        if(empty($this->statement))
            $profiler .= '<span style="font-weight: bold;">No QUERIES exists</span>';
        else {
            $profiler .= '<table style=\'width:100%\'>';
            
              foreach($this->statement['queries'] as $query)
                $profiler .='<tr><td style=\'width:50%;padding:5px;color:#000;background-color:#ddd;\'> '. $query[1] .' s (<em>'. round(($query[1]/$this->statement['time']) * 100) .' %</em>) </td>
                             <td style=\'width:50%;padding:5px;color:orange;font-weight:normal;background-color:#ddd;\'>'. $query[0] .' </td>
                             </tr>';
              
            $profiler .='</table>';
        }
        
        return $profiler .='</fieldset>';       
    }
    
    public function compile_config()
    {
     $config = Arkalys::get_instance()->config();
     
     $profiler = "\n\n";
     $profiler .= '<fieldset style="border:1px solid black; color:black; background-color:#eee;padding:6px 10px 10px 10px;margin:20px 0 20px 0;"> <legend style="color: black;">CONFIG VARIABLES (<b>'.sizeof($config).'</b>)</legend>';
     
     if(empty($config))
         $profiler .= '<span style="font-weight: bold;">Empty config</span>';
     else {
         $profiler .= '<table style=\'width:100%\'>';
         
             foreach($config as $item => $value)
                  @$profiler .= '<tr><td style=\'width:50%;padding:5px;color:#000;background-color:#ddd;\'> '. $item .' </td>
                                <td style=\'width:50%;padding:5px;color:black;font-weight:normal;background-color:#ddd;\'>'. $value .'</td>
                                </tr>';
             
        $profiler .= '</table>';
     }
     
     return $profiler .= '</fieldset';
    }
}
