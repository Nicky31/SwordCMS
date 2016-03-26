<?php
// Constants Stats
define('STAT_VIE',0);
define('STAT_PA',1);
define('STAT_DMG',2);
define('STAT_CC',3);
define('STAT_PO',4);
define('STAT_FORCE',5);
define('STAT_AGI',6);
define('STAT_EC',7);
define('STAT_CHANCE',8);
define('STAT_SASA',9);
define('STAT_VITA',10);
define('STAT_INTEL',11);
define('STAT_PM',12);
define('STAT_PRCENT_DMG',13);
define('STAT_PODS', 14);
define('STAT_ESQUIVE_PA', 15);
define('STAT_ESQUIVE_PM', 16);
define('STAT_INI', 17);
define('STAT_PP', 18);
define('STAT_SOINS', 19);
define('STAT_INVOC', 20);
define('STAT_RESIS_PRCENT_TERRE', 21);
define('STAT_RESIS_PRCENT_EAU', 22);
define('STAT_RESIS_PRCENT_AGI', 23);
define('STAT_RESIS_PRCENT_FEU', 24);
define('STAT_RESIS_PRCENT_NEUTRE', 25);
define('STAT_RENVOI_DMG', 26);
define('STAT_DMG_PIEGE', 27);
define('STAT_PRCENT_PIEGE', 28);
define('STAT_DMG_NEUTRE', 29);
define('STAT_DMG_EAU', 30);
define('STAT_DMG_TERRE', 31);
define('STAT_DMG_AIR', 32);
define('STAT_DMG_FEU', 33);
define('STAT_VOLE_TERRE', 34);
define('STAT_VOLE_FEU', 35);
define('STAT_VOLE_EAU', 36);
define('STAT_VOLE_AIR', 37);
define('STAT_VOLE_NEUTRE', 38);
define('STAT_RESIS_TERRE', 39);
define('STAT_RESIS_EAU', 40);
define('STAT_RESIS_AGI', 41);
define('STAT_RESIS_FEU', 42);
define('STAT_RESIS_NEUTRE', 43);
define('STAT_FAMI_HEAL',44);

function getStats($item,$stuff = NULL,$bonus = NULL) 
{
    $stats = array(
    STAT_VIE => array(0, 0),
    STAT_PA => array(0, 0),
    STAT_DMG => array(0, 0),
    STAT_CC => array(0, 0),
    STAT_PO => array(0, 0),
    STAT_FORCE => array(0, 0),
    STAT_AGI => array(0, 0),
    STAT_EC => array(0, 0),
    STAT_CHANCE => array(0, 0),
    STAT_SASA => array(0, 0),
    STAT_VITA => array(0, 0),
    STAT_INTEL => array(0, 0),
    STAT_PM => array(0, 0),
    STAT_PRCENT_DMG => array(0, 0),
    STAT_PODS => array(0, 0),
    STAT_ESQUIVE_PA => array(0, 0),
    STAT_ESQUIVE_PM => array(0, 0),
    STAT_INI => array(0, 0),
    STAT_PP => array(0, 0),
    STAT_SOINS => array(0, 0),
    STAT_INVOC => array(0, 0),
    STAT_RESIS_PRCENT_TERRE => array(0, 0),
    STAT_RESIS_PRCENT_EAU => array(0, 0),
    STAT_RESIS_PRCENT_AGI => array(0, 0),
    STAT_RESIS_PRCENT_FEU => array(0, 0),
    STAT_RESIS_PRCENT_NEUTRE => array(0, 0),
    STAT_RENVOI_DMG => array(0, 0),
    STAT_DMG_PIEGE => array(0, 0),
    STAT_PRCENT_PIEGE => array(0, 0),
    STAT_DMG_NEUTRE => array(0, 0),
    STAT_DMG_EAU => array(0, 0),
    STAT_DMG_TERRE => array(0, 0),
    STAT_DMG_AIR => array(0, 0),
    STAT_DMG_FEU => array(0, 0),
    STAT_VOLE_TERRE => array(0, 0),
    STAT_VOLE_FEU => array(0, 0),
    STAT_VOLE_EAU => array(0, 0),
    STAT_VOLE_AIR => array(0, 0),
    STAT_VOLE_NEUTRE => array(0, 0),
    STAT_RESIS_TERRE => array(0, 0),
    STAT_RESIS_EAU => array(0, 0),
    STAT_RESIS_AGI => array(0, 0),
    STAT_RESIS_FEU => array(0, 0),
    STAT_RESIS_NEUTRE => array(0, 0),
    STAT_FAMI_HEAL => array(0,0)
);
    if($stuff != NULL) // Si c'est le stuff qu'on doit traiter
    {		
        foreach($stuff as $k => $valeur1) // $stuff['typeObjet'][template|stats]
        {
            if(!empty($valeur1[1])) // si les stats sont renseignés
            {
                $fullStats = explode(',',$valeur1[1]);
                for($i=0;$i < sizeof($fullStats);$i++)
                {
                    $effets = explode('#',$fullStats[$i]);
                    $stats = getElement($effets,$stats);
                }
            }
        }
        for($i = 0; $i < sizeof($stats); $i++)
        {
            if(!isset($stats[$i]))
                break;
            $stats[$i] = $stats[$i][0];
        }
        return $stats;
    }

    elseif($bonus != NULL) // Si c'est les bonus qu'on doit traiter
    {
        for($n=0;$n < sizeof($bonus);$n++)
        {
            If(!empty($bonus[$n]))
            {

                $fullStats = explode(',',$bonus[$n]);
                for($i=0;$i < sizeof($fullStats);$i++)
                {
                    $effets = explode(':',$fullStats[$i]);
                    $effets[0] = dechex($effets[0]);
                    $effets[1] = dechex($effets[1]);
                    $stats = getElement($effets,$stats);
                }
            }
        }
        
        for($i = 0; $i < sizeof($stats); $i++)
        {
            if(!isset($stats[$i]))
                break;
            $stats[$i] = $stats[$i][0];
        }
        
        return $stats;
    }

    else if($item != NULL)
    {
        $html = NULL;

        $fullStats = explode(',',$item[1]); // [1] = stats

        for($i=0;$i < sizeof($fullStats);$i++)
        {
            $effets = explode('#',$fullStats[$i]);
            $stats = getElement($effets,$stats);
        }

        if($stats == NULL)
            return $html;

        foreach($stats as $k => $v)
        {
            if($v[0] != 0)
            {
                $html .= '<img src="'.img_url('puce.png').'" style="margin-right:3px;"/> ';
                if($v[0] != $v[1])
                    $html .= $v[0] .' à '. $v[1] . getStatString($k);
                else
                    $html .= $v[0] . getStatString($k);
          
                $html .= '<br />';
            }
        }

        return $html;
    }
    
    return $stats;
}

function getElement($effets,$stats = null)
{ 
    if(!empty($effets[0]))
    {
        // Conversion des stats hex -> décimal
        $effets[0] = hexdec($effets[0]); // Type d'effet
        $effets[1] = hexdec($effets[1]); // Taux min
        $effets[2] = (isset($effets[2])) ? hexdec($effets[2]) : 0; // Taux Max
        $effets[2] = ($effets[2] == 0) ? $effets[1] : $effets[2];

        Switch($effets[0])
        {
            case 91: // Vole Eau
                $stats[STAT_VOLE_EAU][0] += $effets[1];
                $stats[STAT_VOLE_EAU][1] += $effets[2];
            break;
            case 92: // Vole Terre
                $stats[STAT_VOLE_TERRE][0] += $effets[1];
                $stats[STAT_VOLE_TERRE][1] += $effets[2];
            break;
            case 93: // Vole Air
                $stats[STAT_VOLE_AIR][0] += $effets[1];
                $stats[STAT_VOLE_AIR][1] += $effets[2];
            break;
            case 94: // Vole Feu
                $stats[STAT_VOLE_FEU][0] += $effets[1];
                $stats[STAT_VOLE_FEU][1] += $effets[2];
            break;
            case 95: // Vole NEUTRE
                $stats[STAT_VOLE_NEUTRE][0] += $effets[1];
                $stats[STAT_VOLE_NEUTRE][1] += $effets[2];
            break;
            case 96: // Degats Eau
                $stats[STAT_DMG_EAU][0] += $effets[1];
                $stats[STAT_DMG_EAU][1] += $effets[2];
            break;
            case 97: // Degats Terre
                $stats[STAT_DMG_TERRE][0] += $effets[1];
                $stats[STAT_DMG_TERRE][1] += $effets[2];
            break;
            case 98: // Degats Air
                $stats[STAT_DMG_AIR][0] += $effets[1];
                $stats[STAT_DMG_AIR][1] += $effets[2];
            break;
            case 99: // Degats Feu
                $stats[STAT_DMG_FEU][0] += $effets[1];
                $stats[STAT_DMG_FEU][1] += $effets[2];
            break;
            case 100: // Degats Neutre
                $stats[STAT_DMG_NEUTRE][0] += $effets[1];
                $stats[STAT_DMG_NEUTRE][1] += $effets[2];
            break;
            case 111: // +Pa
                $stats[STAT_PA][0] += $effets[1];
                $stats[STAT_PA][1] += $effets[2];
            break;
            case 112: //+dmg
                $stats[STAT_DMG][0] += $effets[1];
                $stats[STAT_DMG][1] += $effets[2];
            break;
            case 115: // +cc
                $stats[STAT_CC][0] += $effets[1];
                $stats[STAT_CC][1] += $effets[2];    
            break; 
            case 116: // -po
                $stats[STAT_PO][0] -= $effets[1];
                $stats[STAT_PO][1] -= $effets[2];    
            case 117: // +Po
                $stats[STAT_PO][0] += $effets[1];
                $stats[STAT_PO][1] += $effets[2];
            break;
            case 118: //+Force
                $stats[STAT_FORCE][0] += $effets[1];
                $stats[STAT_FORCE][1] += $effets[2];     
            break;
            case 119: //+Agilité
                $stats[STAT_AGI][0] += $effets[1];
                $stats[STAT_AGI][1] += $effets[2];
            break;
            case 122: //+ec
                $stats[STAT_EC][0] += $effets[1];
                $stats[STAT_EC][1] += $effets[2];    
            break;
            case 123: // +chance
                $stats[STAT_CHANCE][0] += $effets[1];
                $stats[STAT_CHANCE][1] += $effets[2];
            break;
            case 124: // +sagesse
                $stats[STAT_SASA][0] += $effets[1];
                $stats[STAT_SASA][1] += $effets[2];    
            break;
            case 125: // +vita
                $stats[STAT_VITA][0] += $effets[1];
                $stats[STAT_VITA][1] += $effets[2];
            break;
            case 126: // +intel
                $stats[STAT_INTEL][0] += $effets[1];
                $stats[STAT_INTEL][1] += $effets[2];
            break;
            case 128: // +pm
                $stats[STAT_PM][0] += $effets[1];
                $stats[STAT_PM][1] += $effets[2];
            break;
            case 138: //%dmg
                $stats[STAT_PRCENT_DMG][0] += $effets[1];
                $stats[STAT_PRCENT_DMG][1] += $effets[2];
            break;
            case 152: //-chance
                $stats[STAT_CHANCE][0] -= $effets[1];
                $stats[STAT_CHANCE][1] -= $effets[2];
            break;
            case 153: //-vita
                $stats[STAT_VITA][0] -= $effets[1];
                $stats[STAT_VITA][1] -= $effets[2];
            break;
            case 154: //-agilité
                $stats[STAT_AGI][0] -= $effets[1];
                $stats[STAT_AGI][1] -= $effets[2];
            break;
            case 155: //-intelligence
                $stats[STAT_INTEL][0] -= $effets[1];
                $stats[STAT_INTEL][1] -= $effets[2];
            break;
            case 156: //-sagesse
                $stats[STAT_SASA][0] -= $effets[1];
                $stats[STAT_SASA][1] -= $effets[2];
            break;
            case 157: //-force
                $stats[STAT_FORCE][0] -= $effets[1];
                $stats[STAT_FORCE][1] -= $effets[2];    
            break;
            case 158: //+Pods
                $stats[STAT_PODS][0] += $effets[1];
                $stats[STAT_PODS][1] += $effets[2];
            break;
            case 159: //-Pods
                $stats[STAT_PODS][0] -= $effets[1];
                $stats[STAT_PODS][1] -= $effets[2];
            break;
            case 160: //+esquivePA
                $stats[STAT_ESQUIVE_PA][0] += $effets[1];
                $stats[STAT_ESQUIVE_PA][1] += $effets[2];
            break;
            case 161: //+esquive PM
                $stats[STAT_ESQUIVE_PM][0] += $effets[1];
                $stats[STAT_ESQUIVE_PM][1] += $effets[2];
            break;
            case 162: //-esquivePA
                $stats[STAT_ESQUIVE_PA][0] -= $effets[1];
                $stats[STAT_ESQUIVE_PA][1] -= $effets[2];
            break;
            case 163: //-esquivePM
                $stats[STAT_ESQUIVE_PM][0] -= $effets[1];
                $stats[STAT_ESQUIVE_PM][1] -= $effets[2];
            break;
           case 168: //-PA
                $stats[STAT_PA][0] -= $effets[1];
                $stats[STAT_PA][1] -= $effets[2];
            break;
            case 169: //-PM
                $stats[STAT_PM][0] -= $effets[1];
                $stats[STAT_PM][1] -= $effets[2];
            break;
            case 171: //-CC
                $stats[STAT_CC][0] -= $effets[1];
                $stats[STAT_CC][1] -= $effets[2];
            break;
            case 174: //+initiative
                $stats[STAT_INI][0] += $effets[1];
                $stats[STAT_INI][1] += $effets[2];
            break;
            case 175: //-initiative
                $stats[STAT_INI][0] -= $effets[1];
                $stats[STAT_INI][1] -= $effets[2];
            break;
            case 176: //+prospection
                $stats[STAT_PP][0] += $effets[1];
                $stats[STAT_PP][1] += $effets[2];
            break;
            case 177: //-prospection
                $stats[STAT_PP][0] -= $effets[1];
                $stats[STAT_PP][1] -= $effets[2];
            break;
            case 178: //+soins
                $stats[STAT_SOINS][0] += $effets[1];
                $stats[STAT_SOINS][1] += $effets[2];
            break;
            case 178: //-soins
                $stats[STAT_SOINS][0] -= $effets[1];
                $stats[STAT_SOINS][1] -= $effets[2];
            break;
            case 182: //+invocs
                $stats[STAT_INVOC][0] += $effets[1];
                $stats[STAT_INVOC][1] += $effets[2];
            break;
            case 210: //+ %resisTerre
                $stats[STAT_RESIS_PRCENT_TERRE][0] += $effets[1];
                $stats[STAT_RESIS_PRCENT_TERRE][1] += $effets[2];
            break;
            case 211: //+ %resisEau
                $stats[STAT_RESIS_PRCENT_EAU][0] += $effets[1];
                $stats[STAT_RESIS_PRCENT_EAU][1] += $effets[2];
            break;
            case 212: //+ %resisAir
                $stats[STAT_RESIS_PRCENT_AGI][0] += $effets[1];
                $stats[STAT_RESIS_PRCENT_AGI][1] += $effets[2];
            break;
            case 213: //+ %resisFeu
                $stats[STAT_RESIS_PRCENT_FEU][0] += $effets[1];
                $stats[STAT_RESIS_PRCENT_FEU][1] += $effets[2];
            break;
            case 214: //+ %resisNeutre
                $stats[STAT_RESIS_PRCENT_NEUTRE][0] += $effets[1];
                $stats[STAT_RESIS_PRCENT_NEUTRE][1] += $effets[2];
            break;
            case 215: //- %resisTerre 
                $stats[STAT_RESIS_PRCENT_TERRE][0] -= $effets[1];
                $stats[STAT_RESIS_PRCENT_TERRE][1] -= $effets[2];
            break;
            case 216: //- %resisEau
                $stats[STAT_RESIS_PRCENT_EAU][0] -= $effets[1];
                $stats[STAT_RESIS_PRCENT_EAU][1] -= $effets[2];
            break;
            case 217: //- %resisAir
                $stats[STAT_RESIS_PRCENT_AGI][0] -= $effets[1];
                $stats[STAT_RESIS_PRCENT_AGI][1] -= $effets[2];
            break;
            case 218: //- %resisFeu
                $stats[STAT_RESIS_PRCENT_FEU][0] -= $effets[1];
                $stats[STAT_RESIS_PRCENT_FEU][1] -= $effets[2];
            break;
            case 219: //- %resisNeutre
                $stats[STAT_RESIS_NEUTRE][0] -= $effets[1];
                $stats[STAT_RESIS_NEUTRE][1] -= $effets[2];
            break;
            case 220: //+renvoiDmg
                $stats[STAT_RENVOI_DMG][0] += $effets[1];
                $stats[STAT_RENVOI_DMG][1] += $effets[2];
            break;
            case 225: //+dmgPièges
                $stats[STAT_DMG_PIEGE][0] += $effets[1];
                $stats[STAT_DMG_PIEGE][1] += $effets[2];
            break;
            case 226: //+%Pièges
                $stats[STAT_PRCENT_PIEGE][0] += $effets[1];
                $stats[STAT_PRCENT_PIEGE][1] += $effets[2];
            break;
            case 240: //+ResisTerre
                $stats[STAT_RESIS_TERRE][0] += $effets[1];
                $stats[STAT_RESIS_TERRE][1] += $effets[2];
            break;
            case 241: //+ResisEau
                $stats[STAT_RESIS_EAU][0] += $effets[1];
                $stats[STAT_RESIS_EAU][1] += $effets[2];
            break;
            case 242: //+ResisAir
                $stats[STAT_RESIS_AGI][0] += $effets[1];
                $stats[STAT_RESIS_AGI][1] += $effets[2];
            break;
            case 243: //+ResisFeu
                $stats[STAT_RESIS_FEU][0] += $effets[1];
                $stats[STAT_RESIS_FEU][1] += $effets[2];
            break;
            case 244: //+ResisNeutre
                $stats[STAT_RESIS_NEUTRE][0] += $effets[1];
                $stats[STAT_RESIS_NEUTRE][1] += $effets[2];
            break;
            case 800:
            $stats[STAT_FAMI_HEAL][0] += $effets[1];    
            $stats[STAT_FAMI_HEAL][1] += $effets[2];
            break;
            default:
                $stats[-1][0] = $effets[0];
                $stats[-1][1] = $effets[0];
            break;

        }
        
    return $stats;	  
    }
} 

function getStatString($statNum)
{
    if($statNum == -1)
        return " : Effet non connu";
    
    $statsString = array (
        "Vie",
        "PA",
        "Dommages",
        "Coups Critiques",
        "PO",
        "Force",
        "Agilité",
        "Echecs Critiques",
        "Chance",
        "Sagesse",
        "Vitalité",
        "Intelligence",
        "PM",
        "% Dommages",
        "Pods",
        "Esquive PA",
        "Esquive PM",
        "Initiative",
        "Prospection",
        "Soins",
        "Invocation",
        "% Résistance Terre",
        "% Résistance Eau",
        "% Résistance Air",
        "% Résistance Feu",
        "% Résistance Neutre",
        "Renvoi Dommages",
        "Dommages Pièges",
        "% Pièges",
        "dégâts Neutre",
        "dégâts Eau",
        "dégâts Terre",
        "dégâts Air",
        "dégâts Feu",
        "vol Terre",
        "vol Feu",
        "vol Eau",
        "vol Air",
        "vol Neutre",
        "Résistance Terre",
        "Résistance Eau",
        "Résistance Air",
        "Résistance Feu",
        "Résistance Neutre",
        "Points de vie"
    );
    
    return " " . $statsString[$statNum];
}

function getBonus($stuff,$db)
{
    $panos = array();  // Array numéroté: "IdPano|NbreItems|BonusPano"


    foreach($stuff as $cle1 => $valeur1)
    { 
        $report = TRUE;

        if(!empty($valeur1[0])) // Si un templateId est renseigné ...
        { 
            $donnees = $db -> hasItemSet($valeur1[0]);
            if($donnees['ItemSet'] != 0) // Si l'item courrant appartient à une pano
            {	  			 
                for($i=0;$i < sizeof($panos);$i++) // On regarde dans l'array si la pano est déjà repertorié
                {
                    $infos = explode("|",$panos[$i]);
                    if($infos[0] == $donnees['ItemSet'])
                    { 
                        $reponse = $db->getItemSet($donnees['ItemSet']);

                        $infos[1]++; // On incrémente le nombre d'items de cette pano stuffs
                        $panos[$i] = $donnees['ItemSet'].'|'. $infos[1] .'|'. $reponse['bonus'];
                        $report = FALSE;
                    }
                }

                if($report) // Si la pano n'a pas encore été repertoriée
                 {
                    $currentPano = $db->getItemSet($donnees['ItemSet']);

                    $panos[sizeof($panos)] = $donnees['ItemSet'].'|'. 1 .'|'. $currentPano['bonus'];
                }

            }
        }
    }

    $bonus = array();
    $id = 0;		
    for($n=0;$n < sizeof($panos);$n++)
    {
        $stuff = explode("|",$panos[$n]);
        
        If($stuff[1] > 1) // Si y a plus d'un item de la pano de stuff
        {
            $explode = explode(';',$stuff[2]); // On ne va laisser que le bonus correspondant au nbre d'item stuffs actuel
            $bonus[$id] = $explode[$stuff[1] - 1]; 
            $id++;	  
        }
    }


return $bonus;		   
}