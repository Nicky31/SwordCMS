<?php
/*
 * Classe Benchmarks
 * Enregistre les timestamp de différents moments du chargement de la page pour calculer le temps d'exécution
 * de x élément.
 * Donées transmises au profiler si ce dernier est activé
 * Classe inspirée de celle du fw CodeIgniter
 * -----------------------------------------------------------------------------------------------------------
 */
class Benchmarks
{
    private        $markers      = array(); 
    private        $durations    = array();
    private static $instance;
    
    public        function __construct()  { self::$instance =& $this; }
    public        function __get($key)     { return $this->$key;      }
    public static function &get_instance(){ return self::$instance;  }
    
    public function mark($name)
    {
        $this->markers[$name] = microtime(true);
    }
    
    public function set_duration($name,$value)
    {
        $this->durations[$name] = $value;
        $this->markers[$name.'_full'] = 0;
    }   
    
    public function elapsed_time($start,$end = null,$decimals = 4)
    {
        if(!is_numeric($decimals))
           $decimals = 4;
        
        if(!array_key_exists($start, $this->durations))
        {
            if(empty($this->markers[$start]) || empty($this->markers[$end]))
                return false;

            return number_format($this->markers[$end] - $this->markers[$start], $decimals,'.','');  
        } else
            return number_format ($this->durations[$start], $decimals, '.', '');
    }
}
