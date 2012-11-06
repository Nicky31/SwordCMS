<?php

class myPDOStatement extends PDOStatement 
{
 
    protected $pdo;
    
    public function count() { return $this->pdo->count(); }
    
    
    protected function __construct($_pdo) 
    {
        $this->pdo = $_pdo;
    }
 
    public function execute($input = null) 
    {   
		$tmpTemps = microtime(true);  
		$return = parent::execute($input);
		$addTime = round(microtime(true) - $tmpTemps, 5);
		$this->pdo->increment();
                $this->pdo->addQuery($this->queryString, $addTime);
		$this->pdo->addTime($addTime);
		
		return $return;
    }
 
}

?>