<?php if(! defined('BASE_PATH') ) exit('No direct script access allowed');

class Inscription extends Controller
{
    public function __construct()
    {
        parent::__construct();		
                
        $this->model('InscriptionModel','inscriptionManager');
        $this->helper('regex');
            
        if(isset($_SESSION['id']))
        {
            $this->output->view('errors/offline_required');
            $this->runnable = FALSE;
        }   
    }

    public function index()
    {
        if(!$this->runnable)
        {
            return;
        }
           
	if(empty($_POST['account']) || empty($_POST['password']) || empty($_POST['password2']) || empty($_POST['pseudo']) || empty($_POST['email']) || empty($_POST['question']) || empty($_POST['response']))
	{ // Si tous les POST ne sont pas envoy�s
            //$this->loadController('News','index');
        }
	else
	{		  
            $this->output->setArg('title','Inscription');	 
                if(checkLogin($_POST['account']))
		{
                    if(!$this->inscriptionManager->checkExists($_POST['account']))
                    {
                        if(!$this->inscriptionManager->checkExistsPseudo($_POST['pseudo']))
                        {
                            if($_POST['pseudo'] != $_POST['account'])
                            {
                                if(checkPseudo($_POST['pseudo']))
                                {
                                    if(checkLogin($_POST['password']))
                                    {
                                        if($_POST['password'] == $_POST['password2'])
                                        {
                                            if(checkMail($_POST['email']))
                                            {
                                                if(checkQuestion($_POST['question']))
                                                {
                                                    if(checkAnswer($_POST['response']))
                                                    { // V�rifs termin�es
                                                        $_POST['password'] = ($this->output->config('enable_hash')) ? hash($this->output->config('hash'),$_POST['password']) : $_POST['password'];

                                                        $this->inscriptionManager->createAccount($_POST['account'],$_POST['password'],$_POST['pseudo'],$_POST['question'],$_POST['response'],$_POST['email']);
                                                        $this->output->view('inscription/success');
                                                        return;
                                                    }
                                                    else
                                                        $this->output -> view('inscription/badResponse');
                                                }
                                                else
                                                    $this->output -> view('inscription/badQuestion');
                                            }
                                            else
                                                $this->output -> view('inscription/badEmail');
                                        }
                                        else
                                            $this->output -> view('inscription/differentsPass');
                                    }
                                    else
                                        $this->output -> view('inscription/badPassword');
                                }
                                else
                                    $this->output -> view('inscription/badPseudo');
                            }
                            else
                                $this->output -> view('inscription/same_AccountPseudo');
                        }    
                        else
                            $this->output -> view('inscription/pseudoAlreadyExists');
                    }
		   else
                        $this->output -> view('inscription/accountAlreadyExists');
            }
            else
                $this->output -> view('inscription/badAccount');
        }
               
        $this->output->view('inscription/form',array(),'content');
    }
    
    public function ajax()
    {
        if(!empty($_POST['account']))
        {
            if($this->inscriptionManager->checkExists($_POST['account']))
            {
               exit('<font color="red">Nom de compte déjà pris</font>'); 
            }
        }
        
        if(!empty($_POST['pseudo']))
        {
            if($this->inscriptionManager->checkExistsPseudo($_POST['pseudo']))
            {
                exit('<font color="red">Pseudo déjà pris</font>');
            }
        }
        
    }
}