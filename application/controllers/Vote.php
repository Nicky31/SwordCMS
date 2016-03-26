<?php if(! defined('BASE_PATH') ) exit('No direct script access allowed');

class Vote extends Controller
{
    public function __construct()
    {
        parent::__construct();
		
        if(!isset($_SESSION['id']))
        {
            $this->runnable = FALSE;
        }
	
        $this->model('VoteModel','voteManager');
    }
    
    public function index()
    { 
        if(!$this->runnable)
        {
            $this->output->view('vote/vote_offline');
            return;
        }
       $this->output->view('vote/vote_online');
    }
    
    public function vote()
    { 
        if(!$this->runnable)
        {
            header('Location:'. $this->output->config('vote'));
            return;
        }
        
        $check = $this->voteManager->checkPermission(getIp(),$_SESSION['id']);
        if($check['count'] == 0) // Si aucune mule n'a voté ces deux dernières heures
        {
            $_SESSION['pts'] += $this->output->config('pts_vote');

            $this->voteManager->editPts($_SESSION['id'],$_SESSION['pts']); // Update du nbre de pts
            $this->voteManager->upVotes($_SESSION['id']);
            $this->voteManager->setLog($_SESSION['id']); // Insert du log
            header('Location:'. $this->output->config('vote')); // Redirige
        }
        else
        {
            $datas['wait'] = return_time($check['wait']);
            $this->output -> view('vote/wait',$datas);
        }
    }
}