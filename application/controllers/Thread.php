<?php if(! defined('BASE_PATH') ) exit('No direct script access allowed');

class Thread extends Controller
{
    private $_threadsType;
    
    public function __construct()
    {
        parent::__construct();
	$this->model('ThreadModel','threadsManager');
        
        // Différents types de sujets / discussions
        $this->_threadsType = array(
            'news',
            'tutorial'
        );   
    }
         
    public function index($threadType = 'news',$num_thread = 0)
    {
        if(!array_search($threadType, $this->_threadsType)) // Type de discussion inexistant
                $threadType = $this->_threadsType[0];
        
	$threads_count = $this->threadsManager->threadsCount($threadType); // nombre de threads
		
	if($num_thread > 0) 
        {
            if($num_thread <= $threads_count['count'])
            {
                $num_thread = intval($num_thread);
            }
            else				
            {
                $num_thread = 0;
            }
        }  
        else
        {
            $num_thread = 0;
        }
         
        $configPagination = array('base_url' => site_url('thread','index',$threadType),
                                  'per_page' => $this->output->config('news_per_page'),
                                  'rowCount' => $threads_count['count'],
                                  'current'  => $num_thread);
	$Pagination = $this->library('Pagination',$configPagination);
		
	$datas['threads'] = $this->threadsManager -> listThreads($threadType,$num_thread,$this->output->config('news_per_page'));		
	$datas['pagination'] = $Pagination -> createLinks();
	$this->output->view($threadType .'/list',$datas);
    }
	  
    public function add()
    {
        if(isset($_SESSION['gmlevel']) && $_SESSION['gmlevel'] >= $this->output->config('gmLevel'))
	{
            if(!empty($_POST['title']) && !empty($_POST['content']) && !empty($_POST['type']))
            {
                if($this->threadsManager->insertThread($_POST['title'],$_POST['content'],$_SESSION['pseudo'],$_POST['type']))
		{
                    $this->output->view('threads/addSuccess');
                }
		else
                {
                    $this->output->view('errors/unexpected_error');
                }
            }
            else
            {
                $this->output->view('errors/post_missing');
            }
        }
	else
        {
            $this->output -> view('errors/admin_required');
        }
    }
	 
    public function delete($id = -1)
    {
        if($thread = $this->threadsManager->getThread($id))
        {
            if((isset($_SESSION['gmlevel']) && $_SESSION['gmlevel'] >= $this->output->config('gmLevel')) || (isset($_SESSION['pseudo']) && $_SESSION['pseudo'] == $thread['auteur']))
            {
                if($id != -1) // si l'id est bien indiqué
                {
                    $this->threadsManager->deleteThread(intval($id));
                    $this->output -> view ('threads/deleteSuccess');
                }
                else
                {
                    $this->output -> view('errors/get_missing');
                }
            }
            else
            {
                $this->output -> view('threads/autorRequired');
            }
        } else 
            $this->output->view('threads/inexistantThread');
    }
	 
    public function edit($id = -1)
    {
        if($id == -1)
        {
            $this->output -> view('errors/get_missing');
            return;
        }
        
        if($thread = $this->threadsManager->getThread($id))
        {
            if((isset($_SESSION['gmlevel']) && $_SESSION['gmlevel'] >= $this->output->config('gmLevel')) || (isset($_SESSION['pseudo']) && $_SESSION['pseudo'] == $thread['auteur']))
            {
                if(!empty($_POST['title']) && !empty($_POST['content'])) 
                {
                    $this->threadsManager->edit($_POST['title'],$_POST['content'],intval($id));
                    $this->output -> view('threads/editSuccess');
                }	
                else 
                    $this->output -> view($thread['type'] .'/edit',$thread);
            }
            else
                $this->output -> view('threads/autorRequired');
        } else 
            $this->output->view('threads/inexistantThread');
    }
}

