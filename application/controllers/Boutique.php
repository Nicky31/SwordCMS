<?php if(! defined('BASE_PATH') ) exit('No direct script access allowed');

class Boutique extends Controller
{ 
    public function __construct()
    {
        parent::__construct();
		
	if(!isset($_SESSION['id'])) 
        {
            $this->runnable = FALSE;
        }
        
        $this->model('BoutiqueModel','boutiqueManager');
        $this->helper('items');
    }

    public function index()
    { 
        if(!$this->runnable)
        {
            $this->output->view('errors/online_required');
            return;
        }
        
        $datas['items'] = $this->boutiqueManager->listItems();
        foreach($datas['items'] as $k => $v)
        {
            $datas['items'][$k]['html'] = 'Aucun effet reconnu';
            if(!empty($v['statsTemplate']))
            {
                $datas['items'][$k]['html'] = getStats(array(1 => $v['statsTemplate']));
            }
            
            $datas['items'][$k]['swf'] = (file_exists(ASSETS_PATH.'/shared/images/items/'.$v['id'].'.swf')) ? $v['id'] : '0';
        }
        
        $this->output->view('boutique/list',$datas);
    }
    
    public function choose($itemId = -1)
    {
        if(!$this->runnable)
        {
            $this->output->view('errors/online_required');
            return;           
        }
        if($itemId == -1)
        {
            $this->output->view('errors/get_missing');
            return;
        }
        
        $datas = array();
        $datas['item'] = $this->boutiqueManager->getItemBoutique($itemId);
        if(empty($datas['item']))
        {
            $this->output->view('boutique/inexistant_item');
            return;
        }
        
        //$templateDatas = $this->boutiqueManager->getItemDatas($itemId);
        //$datas['item'] = array_merge($datas['item'],$templateDatas);
        $datas['item']['html'] = 'Aucun effet reconnu';
        if(!empty($datas['item']['statsTemplate']))
        {
            $datas['item']['html'] = getStats(array(1 => $datas['item']['statsTemplate']));
            $datas['item']['swf'] = (file_exists(ASSETS_PATH.'/shared/images/items/'.$datas['item']['id'].'.swf')) ? $datas['item']['ID'] : '0';
        }
            
        if(empty($_SESSION['persos']))
        {
            $this->output->view('boutique/need_perso');
            return;
        }
        $this->output->view('boutique/choose',$datas);
    }
    
    public function buy()
    {
        if(!$this->runnable)
        {
            $this->output->view('errors/online_required');
            return;           
        }
        if(empty($_POST['perso']) || empty($_POST['item']))
        {
            $this->output->view('errors/post_missing');
            return;
        } 
        
        $_POST['jet'] = (!empty($_POST['jet'])) ? $_POST['jet'] : 20;
        $_POST['jet'] = ($_POST['jet'] != 20 && $_POST['jet'] != 21) ? 20 : $_POST['jet'];
        $Perso = $this->boutiqueManager->getPerso($_POST['perso']);
        $Item = $this->boutiqueManager->getItemBoutique($_POST['item']);
        $Item['points'] = ($_POST['jet'] == 21) ? $Item['points'] * $this->output->config('perfectPrice') : $Item['points'];
        
        if(sizeof($Perso) == 0 || (sizeof($Perso) > 0 && $Perso['account'] != $_SESSION['id']))
        {
            $this->output->view('boutique/inexistant_perso');
            return;
        }
        if(sizeof($Item) == 0) // Non en boutique
        {
            $this->output->view('boutique/inexistant_item');
            return;
        }
        if(sizeof($Item) > 0 && $Item['points'] > $_SESSION['pts'])
        {
            $this->output->view('boutique/pts_missing');
            return;
        }
        
        $this->boutiqueManager->giveItem($Perso['guid'],$_POST['jet'],$Item['id']);
        $_SESSION['pts'] -= $Item['points'];
        $this->boutiqueManager->editPts($_SESSION['id'],$_SESSION['pts']);
            
        $this->output->view('boutique/buy_success');
    }
    
    public function add()
    {
        if(!$this->runnable)
        {
            $this->output->view('errors/online_required');
            return;           
        }
        if(isset($_SESSION['gmlevel']) && $_SESSION['gmlevel'] < $this->output->config('gmLevel'))
        {
            $this->output->view('errors/admin_required');
            return;
        }
        
        if(empty($_POST['item']) || empty($_POST['prix']))
        {
            $this->output->view('boutique/add');
        } 
        else
        {
            $Item = $this->boutiqueManager->getItemByName($_POST['item']);
            if(!$Item)
            {
                $this->output->view('boutique/inexistant_item');
                return;
            }
            if($Item['points'] > 0)
            {
                $this->output->view('boutique/shopitem_already_exists');
                return;
            }
            
            $this->boutiqueManager->setBoutique(intval($Item['id']),intval($_POST['prix']));
            $this->output->view('boutique/add_success');
        }
    }
    
    public function delete($id = -1)
    {
        if(isset($_SESSION['gmlevel']) && $_SESSION['gmlevel'] >= $this->output->config('gmLevel'))
        {
            if($id != -1) // Id indiqué ?
            {
		$this->boutiqueManager->deleteBoutique(intval($id));
		$this->output -> view ('boutique/delete_success');
            }
            else
            {
                $this->output -> view('errors/get_missing');
            }
        }
	else
        {
            $this->output -> view('errors/admin_required');
        }
    }
    
    public function ajax() // Recherche d'item par nom (formulaire d'ajout)
    {
        if(empty($_POST['search']))
            exit("");
        
        $items = $this->boutiqueManager->getItemsLike($_POST['search']);
        $datas = "";
        foreach($items as $k => $v)
        {
            $datas .= $v['name'] . '|';
        }
        exit($datas);
    }
}