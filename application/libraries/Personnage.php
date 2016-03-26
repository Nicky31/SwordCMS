<?php
class Personnage
{
    private $_id;
    private $_name;
    public $_classe = array();
    private $_sexe;
    public $_level;
    private $_alignement;
    private $_grade;
    public  $_baseStats = array();
    private $_guilde= array(); // ['name'] // ['lvl'] // ['count'] // ['emblem']
    private $_objets;
    private $_db;


    public function __construct($params)
    {
        $donnees = $params[0];
        // Initialisation des motherfucking variables
        $this->_id = $donnees['guid'];
        $this->_name = $donnees['name'];
        $this->_classe = $donnees['class']; 
        If($donnees['sexe'] == 0){ $this->_sexe = 'm'; } else{$this->_sexe = 'f';}
        $this->_level = $donnees['level'];
        $this->_alignement = $donnees['alignement'];
        $this->_grade = $donnees['alvl'];
        $this->_objets = $donnees['objets'];
        $this->_db = $params[1]; // other par défaut

        // Stats de base
        If($this->_classe == 3) { $basePP = 120; } else { $basePP = 100; }
        $this->_baseStats['vitalite'] = $donnees['vitalite'];
        $this->_baseStats['force'] = $donnees['force'];
        $this->_baseStats['sagesse'] = $donnees['sagesse'];
        $this->_baseStats['intelligence'] = $donnees['intelligence'];
        $this->_baseStats['chance'] = $donnees['chance'];
        $this->_baseStats['agilite'] = $donnees['agilite'];
        If($this->_level >= 100) { $this->_baseStats['pa'] = 7; } else { $this->_baseStats['pa'] = 6; }
        $this->_baseStats['pm'] = 3;
        $this->_baseStats['initiative'] = $this->_baseStats['force'] + $this->_baseStats['intelligence'] + $this->_baseStats['chance'] + $this->_baseStats['agilite'] +
                                           $this->_baseStats['vitalite'] + 55;
        $this->_baseStats['prospection'] = intval($this->_baseStats['chance']/10) + $basePP;
        $this->_baseStats['portée'] = 0;
        $this->_baseStats['invocations'] = 1;
        $this->_baseStats['esquive'] = intval($donnees['sagesse']/10);
        
        self::nameClasse(); // On remplace l'id de la classe par son nom
        self::infosGuilde();// On récupère les infos sur sa guilde
    }

    public function getHead()
    {
        Switch ($this->_alignement) // Cadre alignement
        {
            case 0:
                $ali = 'images/infos/cadre_neutre.png';
            break;

            case 1:
                $ali = 'images/infos/cadre_bonta.png';
            break;

            case 2:
                $ali = 'images/infos/cadre_brakmar.png';
            break;

            case 3:
                $ali = 'images/infos/cadre_mercenaire.png';
            break;
        }

        return '<img src="'.img_url('armurerie/class/'. $this->_classe[0] . '_'. $this->_sexe .'.png').'" style="position:relative;top:6px;left:4px;"/>';
    }

    public function getName()
    {
        $html = $this->_name .'<br>';
        $html .= '<span style="color:rgb(244,148,60);font-weight:bold; font-size:16px;font-variant:small-caps;">'.$this->_classe[1].' Niveau '. $this->_level.'</span>';
        return $html;
    }

    public function getGuilde()
    {
        $html = NULL;
        If(!empty($this->_guilde)) // S'il a une guilde
        {
            $embleme = explode(',',$this->_guilde['emblem']);
            $embleme['bgSrc'] = base_convert($embleme['0'],36,10);
            $embleme['bgColor'] = base_convert($embleme['1'],36,10);
            $embleme['logoSrc'] = base_convert($embleme['2'],36,10);
            $embleme['logoColor'] = base_convert($embleme['3'],36,10);

            $html .= '<object style="margin:30px 0px -80px 0px;" id="logo_guilde_container" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="65" height="65" >
                      <param name="movie" value="http://staticns.ankama.com/dofus/www//game/DofusGuildes.swf" />
                      <param name="play" value="true" />
                      <param name="flashvars" value="bcgSrc='.$embleme['bgSrc'].'&bcgColor='.$embleme['bgColor'].'&frtSrc='.$embleme['logoSrc'].'&frtColor='.$embleme['logoColor'].'" />
		      <param name="loop" value="true" />
		      <param name="quality" value="high" />
                      <param name="wmode" value="transparent" />
		      <!--[if !IE]>-->
		      <object style="margin:7px 0px -80px 0px;" id="logo_guilde_container" type="application/x-shockwave-flash" data="http://staticns.ankama.com/dofus/www//game/DofusGuildes.swf" width="65" height="65">
                      <param name="play" value="true" />
		      <param name="flashvars" value="bcgSrc='.$embleme['bgSrc'].'&bcgColor='.$embleme['bgColor'].'&frtSrc='.$embleme['logoSrc'].'&frtColor='.$embleme['logoColor'].'" />
		      <param name="loop" value="true" />
		      <param name="quality" value="high" />
		      <param name="wmode" value="transparent" />
		      <!--<![endif]-->
		      <a href="http://www.adobe.com/go/getflashplayer">
		      <img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" />
		      </a>
		      <!--[if !IE]>-->
	              </object>
		      <!--<![endif]-->
                      </object> ';
            $html .= '<br><br><br><br><br><font color="white"><strong>'.$this->_guilde['name'].'</strong></font><br>';
            $html .= '<font color="grey">Niveau:<strong>'.$this->_guilde['lvl'].'</strong></font><br>';
            $html .= '<font color="beige">Membres:<strong>'.$this->_guilde['count'].'</strong></font>';
        }
        else 
        { 
            $html .= '<font color="white"><strong>Héros Solitaire</strong></font><br><br>';
            $html .= '<span style="color:rgb(94,73,17);"><strong>'.$this->_name .'<br>ne fait partit<br>d\'aucune guilde.</strong></span>';
        }
        return $html;
    }

    private function nameClasse()
    {
        Switch ($this->_classe) 
        {
            case 1:
                return $this->_classe = array('feca','Feca');
            break;
            case 2:
                return $this->_classe = array('osa','Osamodas');
            break;
            case 3:
                return $this->_classe = array('enu','Enutrof');
            break;
            case 4:
                return $this->_classe = array('sram','Sram');
            break;
            case 5:
                return $this->_classe = array('xel','Xelor');
            break;
            case 6:
                return $this->_classe = array('eca','Ecaflip');
            break;
            case 7:
                return $this->_classe = array('eni','Eniripsa');
            break;
            case 8:
                return $this->_classe = array('iop','Iop');
            break;
            case 9:
                return $this->_classe = array('cra','Crâ');
            break;
            case 10:
                return $this->_classe = array('sadi','Sadida');
            break;
            case 11:
                return $this->_classe = array('sacri','Sacrieur');
            break;
            case 12:
                return $this->_classe = array('pand','Panda');
            break;
        }
    }

    private function infosGuilde()
    {
        $query = $this->_db->getGuildMembers();
        $again = TRUE;

        foreach($query as $donnees)
        {
            If($donnees['name'] == $this->_name) // Si le perso à une guilde => récupérer les infos de la guilde
            { 
                $guilde = $donnees['guild']; 
                $again = FALSE; 

                $donnees = $this->_db->getGuild($guilde);

                $this->_guilde['name'] = $donnees['name']; // Nom de sa guilde
                $this->_guilde['lvl'] = $donnees['lvl'];   // Lvl de sa guilde
                $this->_guilde['emblem'] = $donnees['emblem'];   // Emblème de sa guilde

                $info = $this->_db->getGuildCountMembers($guilde);
                $this->_guilde['count'] = $info['count']; // Nombre de membres
            }
        }
    }

    public function getCaracts()
    {
        $stuff = $this->getStuff(); // items équipés
        $bonusPanos = getBonus($stuff,$this->_db); // Array(string) des bonus

        $bonus = getStats(null,null,$bonusPanos);
        $statsStuff = getStats(null,$stuff);

        return $stats = array(
            'statsStuff' => $statsStuff,
            'bonus' => $bonus
        );
    }
    /*
     * Inutile ? 
    public function displayStuff()
    {
        $stuff = getStuff($this->_id,$this->_db); // On récupère le stuff (0 - 1) => template - stats en hexa
        $stuff = getGfx($stuff,$this->_db); // On récupère les gfx (2 - 3 - 4) => swf - name - level

        foreach($stuff as $cle => $valeur)
        {
            $return = getStats(null,null,$stuff[$cle]);
            $stuff[$cle][5] = $return[0];
            $stuff[$cle][6] = $return[1];
        }

        return $stuff;
    }*/

    public function jobName($job)
    {
        switch($job)
        {
            case 2: 
                $job = 'Bûcheron';
            break;
            case 11:
                $job = 'Forgeur d\'Epees';
            break;
            case 13:
                $job = 'Sculpteur d\'Arcs';
            break;
            case 14:
                $job = 'Forgeur de Marteaux';
            break;
            case 15:
                $job = 'Cordonnier';
            break;
            case 16:
                $job = 'Bijoutier';
            break;
            case 17:
                $job = 'Forgeur de Dagues';
            break;
            case 18:
                $job = 'Sculpteur de Bâtons';
            break;
            case 19:
                $job = 'Sculpteur de Baguettes';
            break;
            case 20:
                $job = 'Forgeur de Pelles';
            break;
            case 24:
                $job = 'Mineur';
            break;
            case 25:
                $job = 'Boulanger';
            break;
            case 26:
                $job = 'Alchimiste';
            break;
            case 27:
                $job = 'Tailleur';
            break;
            case 28:
                $job = 'Paysan';
            break;
            case 31:
                $job = 'Forgeur de Haches';
            break;
            case 36:
                $job = 'Pêcheur';
            break;
            case 41:
                $job = 'Chasseur';
            break;
            case 43:
                $job = 'Forgemage de Dagues';
            break;
            case 44:
                $job = 'Forgemage d\'Epees';
            break;
            case 45:
                $job = 'Forgemage de Marteaux';
            break;
            case 46:
                $job = 'Forgemage de Pelles';
            break;
            case 47:
                $job = 'Forgemage de Haches';
            break;
            case 48:
                $job = 'Sculptemage d\'Arcs';
            break;
            case 49:
                $job = 'Sculptemage de Baguettes';
            break;
            case 50:
                $job = 'Sculptemage de Bâtons';
            break;
            case 56:
                $job = 'Boucher';
            case 58:
                $job = 'Poissonier';
            break;
            case 60:
                $job = 'Forgeur de Boucliers';
            break;
            case 62:
                $job = 'Cordomage';
            break;
            case 63:
                $job = 'Joaillomage';
            break;
            case 64:
                $job = 'Costumage';
            break;
            case 65:
                $job = 'Bricoleur';
            break;
        }
        return $job;
    }

    /*
     * $stuff = array numéroté
     *   $stuff[x][0] = templateId
     *   $stuff[x][1] = stats
     */
    public function getStuff()
    {
        $stuff = array();

        $items = explode('|',$this->_objets);

        foreach($items as $donnees)
        {
            $item = $this->_db->getItem($donnees);

            If($item['pos'] != '-1')
            {
                /*
                 * $stuff['type']
                 * [0] = Template
                 * [1] = Stats en hexadécimal
                 * [2] = Nom
                 * [3] = Niveau
                 * [4] = Html des stats
                 */
                Switch($item['pos'])
                {
                    case 0: // Amulette
                        $stuff['amu'] = array($item['template'],$item['stats']);
                        $template = $this->_db->getTemplate($item['template']);
                        $stuff['amu'][2] = $template['name'];
                        $stuff['amu'][3] = $template['level'];
                        $stuff['amu'][4] = getStats(array(1 => $item['stats']));
                    break;
                    case 1: // CàC
                        $stuff['cac'] = array($item['template'],$item['stats']);
                        $template = $this->_db->getTemplate($item['template']);
                        $stuff['cac'][2] = $template['name'];
                        $stuff['cac'][3] = $template['level'];
                        $stuff['cac'][4] = getStats(array(1 => $item['stats']));
                    break;
                    case 2: // Anneau de gauche
                        $stuff['anneauG'] = array($item['template'],$item['stats']);
                        $template = $this->_db->getTemplate($item['template']);
                        $stuff['anneauG'][2] = $template['name'];
                        $stuff['anneauG'][3] = $template['level'];
                        $stuff['anneauG'][4] = getStats(array(1 => $item['stats']));
                    break;
                    case 3: // Ceinture
                        $stuff['ceinture'] = array($item['template'],$item['stats']);
                        $template = $this->_db->getTemplate($item['template']);
                        $stuff['ceinture'][2] = $template['name'];
                        $stuff['ceinture'][3] = $template['level'];
                        $stuff['ceinture'][4] = getStats(array(1 => $item['stats']));
                    break;
                    case 4: // Anneau de droite
                        $stuff['anneauD'] = array($item['template'],$item['stats']);
                        $template = $this->_db->getTemplate($item['template']);
                        $stuff['anneauD'][2] = $template['name'];
                        $stuff['anneauD'][3] = $template['level'];
                        $stuff['anneauD'][4] = getStats(array(1 => $item['stats']));
                    break;
                     case 5: // Bottes
                        $stuff['bottes'] = array($item['template'],$item['stats']);
                        $template = $this->_db->getTemplate($item['template']);
                        $stuff['bottes'][2] = $template['name'];
                        $stuff['bottes'][3] = $template['level'];
                        $stuff['bottes'][4] = getStats(array(1 => $item['stats']));
                    break;
                    case 6: // Coiffe
                        $stuff['coiffe'] = array($item['template'],$item['stats']);
                        $template = $this->_db->getTemplate($item['template']);
                        $stuff['coiffe'][2] = $template['name'];
                        $stuff['coiffe'][3] = $template['level'];
                        $stuff['coiffe'][4] = getStats(array(1 => $item['stats']));
                    break;
                    case 7: // Cape
                        $stuff['cape'] = array($item['template'],$item['stats']);
                        $template = $this->_db->getTemplate($item['template']);
                        $stuff['cape'][2] = $template['name'];
                        $stuff['cape'][3] = $template['level'];
                        $stuff['cape'][4] = getStats(array(1 => $item['stats'])); 
                    break;
                    case 8: // Familier
                        $stuff['fami'] = array($item['template'],$item['stats']);
                        $template = $this->_db->getTemplate($item['template']);
                        $stuff['fami'][2] = $template['name'];
                        $stuff['fami'][3] = $template['level'];
                        $stuff['fami'][4] = getStats(array(1 => $item['stats']));
                    break;
                    case 9: // Dofus1
                        $stuff['dofus1'] = array($item['template'],$item['stats']);
                        $template = $this->_db->getTemplate($item['template']);
                        $stuff['dofus1'][2] = $template['name'];
                        $stuff['dofus1'][3] = $template['level'];
                        $stuff['dofus1'][4] = getStats(array(1 => $item['stats']));
                    break;
                    case 10: // Dofus2
                        $stuff['dofus2'] = array($item['template'],$item['stats']);
                        $template = $this->_db->getTemplate($item['template']);
                        $stuff['dofus2'][2] = $template['name'];
                        $stuff['dofus2'][3] = $template['level'];
                        $stuff['dofus2'][4] = getStats(array(1 => $item['stats']));
                    break;
                    case 11: // Dofus3
                        $stuff['dofus3'] = array($item['template'],$item['stats']);
                        $template = $this->_db->getTemplate($item['template']);
                        $stuff['dofus3'][2] = $template['name'];
                        $stuff['dofus3'][3] = $template['level'];
                        $stuff['dofus3'][4] = getStats(array(1 => $item['stats']));
                    break;
                    case 12: // Dofus4
                        $stuff['dofus4'] = array($item['template'],$item['stats']);
                        $template = $this->_db->getTemplate($item['template']);
                        $stuff['dofus4'][2] = $template['name'];
                        $stuff['dofus4'][3] = $template['level'];
                        $stuff['dofus4'][4] = getStats(array(1 => $item['stats']));
                    break;
                    case 13: // Dofus5
                        $stuff['dofus5'] = array($item['template'],$item['stats']);
                        $template = $this->_db->getTemplate($item['template']);
                        $stuff['dofus5'][2] = $template['name'];
                        $stuff['dofus5'][3] = $template['level'];
                        $stuff['dofus5'][4] = getStats(array(1 => $item['stats']));
                    break;
                    case 14: // Dofus6
                        $stuff['dofus6'] = array($item['template'],$item['stats']);
                        $template = $this->_db->getTemplate($item['template']);
                        $stuff['dofus6'][2] = $template['name'];
                        $stuff['dofus6'][3] = $template['level'];
                        $stuff['dofus6'][4] = getStats(array(1 => $item['stats']));
                    break;
                    case 15: // Bouclier
                        $stuff['bouclier'] = array($item['template'],$item['stats']);
                        $template = $this->_db->getTemplate($item['template']);
                        $stuff['bouclier'][2] = $template['name'];
                        $stuff['bouclier'][3] = $template['level'];
                        $stuff['bouclier'][4] = getStats(array(1 => $item['stats']));
                    break; 
                }
            }	
        }
        return $stuff;
    }
}

