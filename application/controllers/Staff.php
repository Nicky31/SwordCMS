<?php if(! defined('BASE_PATH') ) exit('No direct script access allowed');

class Staff extends Controller
{
    public function __construct()
    {
        parent::__construct();
	$this->model('StaffModel','staffManager');
    }

    public function index()
    {         
        $staff = $this->staffManager->listStaff();
        $datas = array('animateurs'      => array(),
                       'modos'           => array(),
                       'chefmodos'       => array(),
                       'administrateurs' => array());
        
        foreach($staff as $current)
        {
            if($current['level'] > 4)
                $current['level'] = 4;
            
            switch ($current['level'])
            {
                case 1:
                    $datas['animateurs'][]      = $current['pseudo'];
                break;
                case 2:
                    $datas['modos'][]           = $current['pseudo'];
                break;
                case 3:
                    $datas['chefmodos'][]       = $current['pseudo'];
                break;
                case 4: 
                    $datas['administrateurs'][] = $current['pseudo'];
                break;
            }
        }
	$this->output->view('staff/staff',$datas);
    }
}