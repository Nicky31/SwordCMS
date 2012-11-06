<?php if(! defined('BASE_PATH') ) exit('No direct script access allowed');

class Pagination
{
private $_baseUrl; // Base de l'url, où on y rajoute la variable n (pagination)
private $_perPage; // Nombre d'entrées à mettre par page
private $_rowCount; // Nombre d'entrées    
private $_current;
private $_links;

	public function __construct($base_url,$per_page,$rowCount,$current)
	 {
		$this->_baseUrl = $base_url;
		$this->_perPage = $per_page;
		$this->_rowCount = $rowCount;
		$this->_current = $current;
	 }
		
	public function createLinks()
	 {
		$pages_count = ceil($this->_rowCount/$this->_perPage);
			$before = $this->_current - $this->_perPage;
			$after = $this->_current + $this->_perPage;
		
	
			if($this->_current > 0) $this->_links .= '<a href="'. $this->_baseUrl .'/'. $before .'">Précédente</a> |';
		for($i=0; $i < $pages_count; $i++)
		 {	
			$num = $i + 1; 
			$id = $i * $this->_perPage;
			if($this->_current == $id)
				$this->_links .= ' <b>'. $num .'</b> |';
			else
				$this->_links .= ' <a href="'. $this->_baseUrl .'/'. $id.'">'. $num .'</a> |';
		 }
			if($this->_current + 1 < $this->_rowCount) $this->_links .= '<a href="'. $this->_baseUrl .'/'. $after .'">Suivante</a> ';
		 
	   return $this->_links;
	 }
	 
   public function __toString()
    {
		return $this->createLinks();
	}
} 
