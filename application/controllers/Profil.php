<?php if(! defined('BASE_PATH') ) exit('No direct script access allowed');

class Profil extends Controller
{
    public function __construct()
    {  
        parent::__construct();
            
        if(empty($_SESSION['id']))
        {
            $this->runnable = FALSE;
        }
        
        $this->model('ProfilModel','profilManager');
        $this->helper('regex');
    }

    public function index()
    { 
        if(!$this->runnable)
        {
            $this->output->view('errors/online_required');
            return;
        }
        
        $this->output->view('profil/infos');
    }
	
    public function setAccount()
    {
        if(!$this->runnable)
        {
            $this->output->view('errors/online_required');
            return;
        }
        
        if(empty($_POST['reponse']) || empty($_POST['newAccount']))
	{
            $this->output->view('profil/setAccount');
        }
	else
	{
            if($_POST['reponse'] == $_SESSION['reponse'])
            {
                if(checkLogin($_POST['newAccount'])) // Si le nom de compte est correct
		{
                    $this->profilManager->editAccount($_POST['newAccount'],$_SESSION['id']);
                    $_SESSION['account'] = $_POST['newAccount'];
                    $this->output->view('success/edit');
                    return;
                }
		else 
                    $this->output->view('inscription/badAccount');
            }
            else
                $this->output->view('profil/badResponse');
            
            $this->output->view('profil/setAccount');
        }
    }
	 
    public function setPassword()
    {
        if(!$this->runnable)
        {
            $this->output->view('errors/online_required');
            return;
        }
        
        if(empty($_POST['reponse']) || empty($_POST['newPass']) || empty($_POST['passConfirm']))
        {
            $this->output->view('profil/setPassword');
	}
	else // traitement 
	{
            if($_POST['reponse'] == $_SESSION['reponse'])
            {
                if($_POST['newPass'] == $_POST['passConfirm'])
		{
                    if(checkLogin($_POST['newPass'])) // Si le password est correct
                    {
                        if($this->output->config('enable_hash'))
                        {
                            $_POST['newPass'] = hash($this->output->config('hash'),$_POST['newPass']); // Si hash activé, on hash le mdp
                        }
                        $this->profilManager->editPassword($_POST['newPass'],$_SESSION['id']);
                        $this->output->view('success/edit');
                        return;
                    }
                    else
                        $this->output->view('inscription/badPassword');
                }
		else
                    $this->output->view('inscription/differentsPass');
            }
            else
                $this->output->view('profil/badResponse');
            
            $this->output->view('profil/setPassword');
        }
    }
	 
    public function setEmail()
    {
        if(!$this->runnable)
        {
            $this->output->view('errors/online_required');            
            return;
        }
        
        if(empty($_POST['reponse']) || empty($_POST['newMail']))
	{
            $this->output->view('profil/setEmail');
	}
	else
	{
            if($_POST['reponse'] == $_SESSION['reponse'])
            {
                if(checkMail($_POST['newMail'])) // Si le mail est correct
		{
                    $this->profilManager->editMail($_POST['newMail'],$_SESSION['id']);
                    $_SESSION['email'] = $_POST['newMail'];
                    $this->output->view('success/edit');
                    return;
		}
		else
                    $this->output->view('inscription/incorrectEmail');
            }
            else
                $this->output->view('profil/badResponse');
            
            $this->output->view('profil/setEmail');
	}
    }
	 
    public function setQuestion()
    {
        if(!$this->runnable)
        {
            $this->output->view('errors/online_required');            
            return;
        }
        
        if(empty($_POST['reponse']) || empty($_POST['newQuestion']) || empty($_POST['newResponse']))
	{
            $this->output->view('profil/setQuestion');
	}
	else
	{
            if($_POST['reponse'] ==  $_SESSION['reponse'])
            {
                if(checkQuestion($_POST['newQuestion']) && checkAnswer($_POST['newResponse'])) // Si le pseudo est correct
		{
                    $this->profilManager->editQuestion($_POST['newQuestion'],$_POST['newResponse'],$_SESSION['id']);
                    $_SESSION['question'] = $_POST['newQuestion'];
                    $_SESSION['reponse'] = $_POST['newResponse'];
                    $this->output->view('success/edit');
                    return;
		}
		else
                    $this->output->view('inscription/incorrectQuestion');
            }
            else
                $this->output->view('profil/badResponse');
            
            $this->output->view('profil/setQuestion');
	}
    }
}