<?php

class Servers extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->model('ServersModel', 'serversManager');
    }
    
    public function index()
    {
        $datas = array();
        $datas['servers'] = array();
        foreach($this->output->config('servers') as $k => $v)
        {
      
            $datas['servers'][] = array(
                'name' => $k,
                'status' => $this->serversManager->checkConnec($v['host'],$v['port']),
                'rateXP' => $v['rateXP'],
                'rateDrop' => $v['rateDrop'],
                'rateKamas' => $v['rateKamas'],
                'startLevel' => $v['startLevel'],
                'lastLevel' => $v['lastLevel']
            );
        }
        
        $this->output->view('servers/list',$datas);
    }
}