<?php  if ( ! defined('BASE_PATH')) exit('No direct script access allowed');

class Ladder extends Controller 
{

    public function __construct()
    {
        parent::__construct();
		
	$this->model('LadderModel','ladderManager');
    }
	 
    public function index()
    {
        $this->persos();
    }
	  
    public function persos($num_perso = 0)
    {
	$persos_count = $this->ladderManager->persosCount(); // nombre de news
        
        if($num_perso > 0) 
        {
            if($num_perso <= $persos_count)
            {
                $num_perso = intval($num_perso);
            }
            else				
            {
                $num_perso = 0;
            }
        }  
        else
        {
            $num_perso = 0;
        }
         
        $configPagination = array('base_url' => site_url('ladder','persos'),
                                  'per_page' => $this->output->config('persos_per_page'),
                                  'rowCount' => $persos_count['count'],
                                  'current'  => $num_perso);
	$Pagination = $this->library('Pagination',$configPagination);
	$datas['persos'] = $this->ladderManager->listPersos($num_perso,$this->output->config('persos_per_page'));
        $datas['pagination'] = $Pagination -> createLinks();
        $datas['persos_count'] = $persos_count;
	$datas['num_perso'] = $num_perso + 1;
        
        /*
        foreach($datas['persos'] as $k => $v)
        {
            $splitFactions = explode(',',$v['faction']);
            $datas['persos'][$k]['alignement'] = $splitFactions[0];
            $datas['persos'][$k]['honor'] = $splitFactions[1];
        }*/
        
        $this->output->view('ladder/choice');
	$this->output->view('ladder/persos',$datas);
    }
	 
    public function guilds($num_guild = 0)
    {
	$guilds_count = $this->ladderManager->guildsCount(); // nombre de news
					
        if($num_guild > 0) 
        {
            if($num_guild <= $guilds_count)
            {
                $num_guild = intval($num_guild);
            }
            else				
            {
                $num_guild = 0;
            }
        }  
        else
        {
            $num_guild = 0;
        }
         
        $configPagination = array('base_url' => site_url('ladder','guilds'),
                                  'per_page' => $this->output->config('persos_per_page'),
                                  'rowCount' => $guilds_count['count'],
                                  'current'  => $num_guild);
	$Pagination = $this->library('Pagination',$configPagination);
	
	$datas['guilds'] = $this->ladderManager->listGuilds($num_guild,$this->output->config('persos_per_page'));
        $datas['pagination'] = $Pagination -> createLinks();
        $datas['guilds_count'] = $guilds_count;
	$datas['num_guild'] = $num_guild + 1;
        
        foreach($datas['guilds'] as $k => $v)
        {
            //$splitMembers = explode(';',$datas['guilds'][$k]['members']);
            //$datas['guilds'][$k]['membersCount'] = sizeof($splitMembers);
            $datas['guilds'][$k]['membersCount'] = $this->ladderManager->guildMembersCount($v['id']);
            $datas['guilds'][$k]['membersCount'] = $datas['guilds'][$k]['membersCount']['count'];
        }
        
        $this->output->view('ladder/choice');
	$this->output->view('ladder/guilds',$datas); 
    }
		
    public function votes($num_voteur = 0)
    {
	$voteurs_count = $this->ladderManager->voteursCount(); // nombre de news
					
        if($num_voteur > 0) 
        {
            if($num_voteur <= $voteurs_count)
            {
                $num_voteur = intval($num_voteur);
            }
            else				
            {
                $num_voteur = 0;
            }
        }  
        else
        {
            $num_voteur = 0;
        }
         
        $configPagination = array('base_url' => site_url('ladder','votes'),
                                  'per_page' => $this->output->config('persos_per_page'),
                                  'rowCount' => $voteurs_count['count'],
                                  'current'  => $num_voteur);
	$Pagination = $this->library('Pagination',$configPagination);
	
	$datas['voteurs'] = $this->ladderManager->listVoteurs($num_voteur,$this->output->config('persos_per_page'));
        $datas['pagination'] = $Pagination -> createLinks();
        $datas['voteurs_count'] = $voteurs_count;
	$datas['num_voteur'] = $num_voteur + 1;
        $this->output->view('ladder/choice');
	$this->output->view('ladder/voteurs',$datas);
    }
	
}