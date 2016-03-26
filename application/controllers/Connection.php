<?php if(! defined('BASE_PATH') ) exit('No direct script access allowed');

class Connection extends Controller
{
    public function __construct()   
    {			
        parent::__construct();
	$this->model('ConnectionModel','connectionManager');
    }
	
    public function index()
    { 
        if(! isset($_SESSION['id'])) // Si bien déco
	{
            if(!empty($_POST['login']) && !empty($_POST['password']))
            {
                $_POST['password'] = ($this->output->config('enable_hash')) ? hash($this->output->config('hash'),$_POST['password']) : $_POST['password'];
		$account = $this->connectionManager->getAccount($_POST['login'],$_POST['password']);
					
		if($account['count'] == 1) // Si le compte existe
		{
                        $_SESSION['id'] = $account['infos']['guid'];
			$_SESSION['account'] = $account['infos']['account'];
			$_SESSION['pseudo'] = $account['infos']['pseudo'];
			$_SESSION['email'] = $account['infos']['email'];
			$_SESSION['gmlevel'] = $account['infos']['level'];
			$_SESSION['pts'] = $account['infos']['points'];
                        $_SESSION['question'] = $account['infos']['question'];
                        $_SESSION['reponse'] = $account['infos']['reponse'];
                        $_SESSION['persos'] = $account['infos']['characters'];
			header('Location: '. site_url() );
		}
		else
                    $this->output->view('connection/fail');
            }
            else
                header('Location: '. site_url() );
        }
	else
            header('Location: '. site_url() );
    }
	 
    public function logout()
    {
        if(isset($_SESSION['id'])) 
        {
            session_destroy();
        }
			
	header('Location: '. site_url() );
    }
	 
}