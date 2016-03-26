<?php if(! defined('BASE_PATH') ) exit('No direct script access allowed');

class Perso extends Controller
{ 
    public function __construct()
    {
        parent::__construct();
		
	if(!isset($_SESSION['id'])) 
        {
            $this->runnable = FALSE;
        }
        
        $this->model('PersoModel','persoManager');
        $this->helper('items');
    }
    
    public function index($perso = -1)
    {
        $this->jobs($perso);
    }
    
    public function jobs($perso = -1)
    {
        if($perso == -1)
        {
            $this->output->view('armurerie/need_perso');
            return;
        }
        $datas = $this->persoManager->getPerso($perso);
        
        if(empty($datas)) // Personnage inexistant
        { 
            $this->output->view('armurerie/need_perso');
            return;
        }
        $params = array($datas);
        $params[1] = $this->persoManager;
        $this->Personnage = $this->library('Personnage', $params,TRUE);
        
        $datas['head'] = $this->Personnage->getHead();
        $datas['name'] = $this->Personnage->getName();
        $datas['guild'] = $this->Personnage->getGuilde();
        $datas['pseudo'] = $perso;
        
        $this->output->view('armurerie/head',$datas);
        

        $jobs = array();
        $proviJobs = explode(';',$datas['jobs']);
        for($i = 0;$i < sizeof($proviJobs); $i++) // On traite chaques métiers uns par uns 
        {
            $currentJob = explode(',',$proviJobs[$i]);
            if(sizeof($currentJob) < 2)
                continue;
            
            $jobId = $currentJob[0];
            $jobLvl = $currentJob[1];
            if($currentJob[1] > 100) // Si le lvl indiqué en db > 100 (bug qui peut arriver;à gérer)
            {
                $jobLvl = 100;
            }
            elseif($currentJob[1] == 0) 
            {
                $jobLvl = 1;
            }
            else
            {
                $jobLvl = $currentJob[1];
            }
            $jobs[$jobId]['level'] = $jobLvl;
            $jobs[$jobId]['name'] = $this->Personnage->jobName($jobId);
        }	
        $datas['jobs'] = $jobs;
        $this->output->view('armurerie/jobs',$datas);
    }
    
    public function stuff($perso = -1)
    {
        if($perso == -1)
        {
            $this->output->view('armurerie/need_perso');
            return;
        }
        $datas = $this->persoManager->getPerso($perso);
        
        if(empty($datas)) // Personnage inexistant
        { 
            $this->output->view('armurerie/need_perso');
            return;
        }
        $params = array($datas);
        $params[1] = $this->persoManager;
        $this->Personnage = $this->library('Personnage', $params,TRUE);
        
        $datas['head'] = $this->Personnage->getHead();
        $datas['name'] = $this->Personnage->getName();
        $datas['guild'] = $this->Personnage->getGuilde();
        $datas['pseudo'] = $perso;
        
        $this->output->view('armurerie/head',$datas);
        
        $datas['stuff'] = $this->Personnage->getStuff();
        foreach($datas['stuff'] as $k => $v)
        {
            $stats = $v[4];
            $datas['stuff'][$k][4] = '<span id=&quot;name&quot;><b>'.$v[2].'</b> <span style=&quot;float:right;&quot;>Niveau '.$v[3].'</span> </span> <br> <br> <span id=&quot;effets&quot;>Effets</span><br><br>';
            $datas['stuff'][$k][4] .= $stats;
        }
        $datas['css'] = $this->getStuffCss();
        $this->output->view('armurerie/stuff',$datas);
        
    }
                                
    private function getStuffCss()
    {
        $css = array();
        $css['cac'] = "position:absolute; top:15px; left:266px;";
        $css['coiffe'] = "position:absolute; top:60px; left:266px;";
        $css['anneauD'] = "position:absolute; top:108px; left:266px;";
        $css['ceinture'] = "position:absolute; top:160px; left:266px;";
        $css['fami'] = "position:absolute; top:207px; left:263px;";
        $css['dofus6'] = "position:absolute; top:257px; left:263px;";
        $css['dofus5'] = "position:absolute; top:257px; left:211px;";
        $css['dofus4'] = "position:absolute; top:257px; left:165px;";
        $css['dofus3'] = "position:absolute; top:257px; left:115px;";
        $css['dofus2'] = "position:absolute; top:257px; left:66px;";
        $css['dofus1'] = "position:absolute; top:257px; left:17px;";
        $css['bouclier'] = "position:absolute; top:8px; left:17px;";
        $css['amu'] = "position:absolute; top:60px; left:17px;";
        $css['anneauG'] = "position:absolute; top:108px; left:17px;";
        $css['cape'] = "position:absolute; top:160px; left:17px;";
        $css['bottes'] = "position:absolute; top:207px; left:17px;";
        return $css;
    }
    
    public function stats($perso = -1)
    {
        if($perso == -1)
        {
            $this->output->view('armurerie/need_perso');
            return;
        }
        $datas = $this->persoManager->getPerso($perso);
        
        if(empty($datas)) // Personnage inexistant
        { 
            $this->output->view('armurerie/need_perso');
            return;
        }
        $params = array($datas);
        $params[1] = $this->persoManager;
        $this->Personnage = $this->library('Personnage', $params,TRUE);
        
        $datas['head'] = $this->Personnage->getHead();
        $datas['name'] = $this->Personnage->getName();
        $datas['guild'] = $this->Personnage->getGuilde();
        $datas['pseudo'] = $perso;
        
        $this->output->view('armurerie/head',$datas);
        
        $datas['stats'] = $this->Personnage->getCaracts();
        $stuff = $datas['stats']['statsStuff']; // Stats donnés par les items
	$bonus = $datas['stats']['bonus']; 	   // Bonus des panos

	$totalStuff = array(); // = bonus + stats du stuff
	$total = array();      // = bonus + stats du stuff + stats de base

        // On aditionne les stats stuff + bonus panos
        foreach($stuff as $k => $v)
        {
            $totalStuff[$k] = $stuff[$k] + $bonus[$k];
        }
        
        foreach($totalStuff as $k => $v) // Evite un bug
            if(is_array($v))
                $totalStuff[$k] = 0;

	$total['vitalité'] = $this->Personnage->_baseStats['vitalite'] + $totalStuff[STAT_VITA];
	$total['sagesse'] = $this->Personnage->_baseStats['sagesse'] + $totalStuff[STAT_SASA];
	$total['force'] = $this->Personnage->_baseStats['force'] + $totalStuff[STAT_FORCE];
	$total['intelligence'] = $this->Personnage->_baseStats['intelligence'] + $totalStuff[STAT_INTEL];
	$total['chance'] = $this->Personnage->_baseStats['chance'] + $totalStuff[STAT_CHANCE];
	$total['agilité'] = $this->Personnage->_baseStats['agilite'] + $totalStuff[STAT_AGI];
	$total['pa'] = $this->Personnage->_baseStats['pa'] + $totalStuff[STAT_PA];
	$total['pm'] = $this->Personnage->_baseStats['pm'] + $totalStuff[STAT_PM];
	
	// Calcul de l'initiative :
        $total['initiative'] = 1;
	$fact = ($this->Personnage->_classe == 11) ? 8 : 4;
	$pvmax = ($this->Personnage->_level - 1) * 5 + $total['vitalité'];
	$coef = ($pvmax / $fact) + $totalStuff[STAT_INI] + $total['agilité'] + $total['chance'] + $total['intelligence'] + $total['force'];
	$total['initiative'] = intval($coef);
			
	$total['prospection'] = $this->Personnage ->_baseStats['prospection'] + $totalStuff[STAT_PP];
	$total['portée'] = $this->Personnage ->_baseStats['portée'] + $totalStuff[STAT_PO];
	$total['invocations'] = $this->Personnage ->_baseStats['invocations'] + $totalStuff[STAT_INVOC];
	$total['esquivePA'] = $this->Personnage->_baseStats['esquive'] + $totalStuff[STAT_ESQUIVE_PA];
	$total['esquivePM'] = $this->Personnage->_baseStats['esquive'] + $totalStuff[STAT_ESQUIVE_PM];
        
        $datas['baseStats'] = $this->Personnage->_baseStats;
        $datas['totalStuff'] = $totalStuff;
        $datas['total'] = $total;
        
        
        $this->output->view('armurerie/stats',$datas);
    }
}