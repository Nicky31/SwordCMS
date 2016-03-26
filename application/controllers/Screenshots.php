<?php if(! defined('BASE_PATH') ) exit('No direct script access allowed');

class Screenshots extends Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->model('ScreensModel','screensManager');
   
    }
    
    public function index()
    {
        $countColumns = 4;
        $datas['screens'] = $this->screensManager->getScreens();
        $datas['countTr'] = ceil(sizeof($datas['screens']) / $countColumns);
        $datas['countColumns'] = $countColumns;
        $this->output->view('screens/list',$datas);
    }
    
    public function add()
    {
        if(!isset($_SESSION['id']))
        {
            $this->output->view('errors/online_required');
            return;
        }
        if($_SESSION['gmlevel'] < $this->output->config('gmLevel'))
        {
            $this->output->view('errors/admin_required');
            return;
        }
        
        if(empty($_POST['url']) || empty($_POST['comments']))
        {
            $this->output->view('screens/add');
        } else
        {
            $this->screensManager->addScreen($_POST['url'],$_POST['comments']);
            $this->output->view('screens/add_success');
        }
    }
    
    public function delete($id = -1)
    {
        if(!isset($_SESSION['id']))
        {
            $this->output->view('errors/online_required');
            return;
        }
        if($_SESSION['gmlevel'] < $this->output->config('gmLevel'))
        {
            $this->output->view('errors/admin_required');
            return;
        }
        
        if($id == -1)
        {
            $this->output->view('errors/get_missing');
            return;
        } else
        {
            $this->screensManager->deleteScreen(intval($id));
            $this->output->view('screens/delete_success');
        }
    }
}
