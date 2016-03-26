<?php if(! defined('BASE_PATH') ) exit('No direct script access allowed');

class Pagination
{
    private $_baseUrl; // Base de l'url, où on y rajoute la variable n (pagination)
    private $_perPage; // Nombre d'entrées à mettre par page
    private $_rowCount; // Nombre d'entrées    
    private $_current; // ID de la première entrée de la page actuelle
    private $_links;
    
    public function __construct($config)
    {
        $this->_baseUrl  = $config['base_url'];
	$this->_perPage  = $config['per_page'];
	$this->_rowCount = $config['rowCount'];
	$this->_current  = $config['current'];
        $this->_pagesCount = ceil($this->_rowCount/$this->_perPage);
    }
		
    public function createLinks()
    {
	$before = $this->_current - $this->_perPage;
	$after = $this->_current + $this->_perPage;
		
        $this->_links .= '<ul class="pager">';
	if($this->_current > 0) 
            $this->_links .= '<a style="color:#BFC132;" href="'. $this->_baseUrl .'/'. $before .'">« Prev</a>';
        for($i=0; $i < $this->_pagesCount; $i++)
	{	
            $num = $i + 1; 
            $id = $i * $this->_perPage;
            if($this->_current == $id)
                $this->_links .= '<a class="btn">'.$num.'</a>';
            else
                $this->_links .= '<a href="'. $this->_baseUrl .'/'. $id .'" class="btn">'.$num.'</a>';
        }
        // Si ce n'est pas la dernière page
	if($after - 1 < $this->_rowCount - 1) 
            $this->_links .= '<a style="color:#BFC132;" href="'. $this->_baseUrl .'/'. $after .'">Next »</a>';
	$this->_links .='</ul>';
                 
	return $this->_links;
    }
	 
    public function __toString()
    {
        return $this->createLinks();
    }
} 
