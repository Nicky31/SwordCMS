<?php

class Comments extends Controller
{
    public function __construct()
    {
        parent::__construct();
        
        $this->model('CommentsModel','commentsManager');
        
        if(empty($_SESSION['pseudo']))
        {
            $this->runnable = FALSE;
        }
    }
    
    public function index($article = -1,$numComs = 0)
    {
        $datas = array();

        if($article == -1) // Id article non renseigné
        {
            $this->output->view('errors/get_missing');
            return;
        }
        
        $datas['article'] = $this->commentsManager->getThread($article);
        
        if(empty($datas['article'])) // Article inexistant
        {
            $this->output->view('comments/inexistant_article');
            return;
        }
        
        $comments_count = $this->commentsManager->commentsCount($article); // Nombre de commentaires
		
	if($numComs > 0) 
        {
            if($numComs <= $comments_count['count'])
            {
                $numComs = intval($numComs);
            }
            else				
            {
                $numComs = 0;
            }
        }  
        else
        {
            $numComs = 0;
        }
        
        $configPagination = array('base_url' => site_url('comments','index',$article),
                                  'per_page' => $this->output->config('news_per_page'),
                                  'rowCount' => $comments_count['count'],
                                  'current'  => $numComs);
        
        $Pagination = $this->library('Pagination',$configPagination);
        $datas['comments'] = $this->commentsManager->getComments($article,$numComs,$this->output->config('news_per_page'));
        $datas['pagination'] = $Pagination->createLinks();
        $this->output->view('comments/list',$datas);
    }
    
    public function add($articleId = -1)
    {
        if(!$this->runnable)
        {
            $this->output->view('errors/online_required');
            return;
        }
        if(empty($_POST['comment']))
        {
            $this->output->view('errors/post_missing');
            return;
        }
        if($articleId == -1)
        {
            $this->output->view('errors/get_missing');
            return;
        }

        $this->commentsManager->addComment($_POST['comment'],$_SESSION['pseudo'],$articleId);
        header('Location: '. site_url('comments','index',$articleId) );
    }
    
    public function delete($commentId = -1)
    {
        if(!$this->runnable)
        {
            $this->output->view('errors/online_required');
            return;
        }
        if($commentId == -1)
        {
            $this->output->view('errors/get_missing');
            return;
        }
        $Comment = $this->commentsManager->getComment($commentId);
        if(empty($Comment))
        {
            $this->output->view('comments/inexistant_comment');
            return;
        }
        if((isset($_SESSION['gmlevel']) && $_SESSION['gmlevel'] < $this->output->config('gmLevel')) && $_SESSION['pseudo'] != $Comment['auteur'])
        {
            $this->output->view('errors/admin_required');
            return;
        }
        
        $this->commentsManager->deleteComment($commentId);
        $this->output->view('success/delete');
    }
    
    public function edit($commentId = -1)
    {
        if(!$this->runnable)
        {
            $this->output->view('errors/online_required');
            return;
        }
        if($commentId == -1)
        {
            $this->output->view('errors/get_missing');
            return;
        }
        $Comment = $this->commentsManager->getComment($commentId);
        if(empty($Comment))
        {
            $this->output->view('comments/inexistant_comment');
            return;
        }
        if($_SESSION['pseudo'] != $Comment['auteur'])
        {
            $this->output->view('comments/autor_required');
            return;
        }
    
        if(empty($_POST['comment']))
        {
            $this->output->view('comments/edit',$Comment);
        } else 
        {
            $this->commentsManager->editComment($commentId,$_POST['comment']);
            $this->output->view('success/edit');
        }
    }
    
}