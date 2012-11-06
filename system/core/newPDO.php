<?php

class myPDO extends PDO 
{
	
	protected $count 		= 0; 
	public    $queries              = array();
	protected $time			= 0;

        
	// GETTERS
	
	public function count()    	{ return $this->count;       }
	public function queries()      { return $this->queries;     }
	public function time()     	{ return $this->time;        } 
 
	public function increment() 
	{ 
		$this->count ++; 
	}
        
	public function addQuery($query, $time=0)
	{	
		$this->queries[] = array($query, $time);
	}
	public function addTime($time)
	{	
		$this->time += $time;
	}
 
	function __construct($dsn, $username="root", $password="", $driver_options=array()) 
	{
		parent::__construct($dsn,$username,$password, $driver_options);
		
		// Utilisation de myPDOStatement 
		$this->setAttribute(PDO::ATTR_STATEMENT_CLASS, array('myPDOStatement', array($this)));		
	}
	
	public function query($query) 
	{
		
		$tmpTemps = microtime(true);  
		$return = parent::query($query);
		$addTime = round(microtime(true) - $tmpTemps,5);


		$this->addQuery($query,$addTime);
		$this->addTime($addTime);
                $this->increment();
                
		return $return;
	}
	
	public function exec($query) 
	{

		$tmpTemps = microtime(true);  
		$return = parent::exec($query);
		$addTime = round(microtime(true) - $tmpTemps,5);
		
		$this->addQuery($query,$addTime);
		$this->addTime($addTime);
                $this->increment();
		
		return $return;
	}
 
}

?>