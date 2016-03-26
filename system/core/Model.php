<?php if(! defined('BASE_PATH') ) exit('No direct script access allowed');

/*
 * Classe mère des models
 * Crée une connexion SQL et implémentes les différentes methodes permettant la gestion basique de données SQL.
 * Ne s'instancie pas directement.
 * --------------------------------------------------------------------------
 */

abstract class Model
{
    protected $db;
    private   $output;
    
    public function __construct()
    {
        $this->output =& Controller::get_instance()->output();
            
        require_once APP_PATH.'/config/database.php';
        require_once SYS_PATH.'/core/newPDO.php';
        require_once SYS_PATH.'/core/newPDOStatement.php';
            
	$this->db = new myPDO('mysql:host=' . HOST . ';dbname=' . DB_OTHER , LOGIN , PASSWORD);
        $query= $this->db->query('SET CHARSET utf8');
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
         
    public function __destruct()
    {  
        $this->output->setArg('statement',$this->statement());
    }
        
    public function switchDb($dbName)
    {
        $query = $this->db->query('USE '. $dbName);
    }
 
    public function statement()
    {
        $stats['count']   = $this->db->count();
        $stats['time']    = $this->db->time();
        $stats['queries'] = $this->db->queries();
        return $stats;
    }
         
    /*
     * Ne pas utiliser le CRUD (insécurisé)
     */
    public function select($table,$column = '*',$where = NULL,$order = NULL,$limit = NULL)
    {
        $query = 'SELECT '. $column .' FROM '. $table;
             
        if(!empty($where)) // si des conditions sont définies
        {
            $query .= ' WHERE ';
            if(!is_array($where)) // Where en toutes lettres
            {
                $query .= $where;
            }
            else  // Sous forme d'array
            {
                $query .= $this->parseCond($where);
            }
        }
             
        if(!empty($order))
        {
            $query .= 'ORDER BY '. $order .' ';
        }
             
        if(!empty($limit))
        {
            $query .= 'LIMIT '. $limit;
        }
           
        $q = $this->db->prepare($query);
        $q -> execute();
             
        return $q->fetchAll(); 
    }
         
    public function delete($table,$where)
    {
        $query = 'DELETE FROM '. $table .' WHERE ';
             
        if(!is_array($where)) // Where en toutes lettres
        {
            $query .= $where;
        }
        else // Sous forme d'array
        { 
            $query .= $this->parseCond($where);
        }
                
        $q = $this->db->prepare($query);
        return (bool) $q -> execute();
    }
         
    public function insert($table,$columns,$values)
    {
        $query = 'INSERT INTO '. $table;
             
        foreach($values as $k => $v)
        {
            if(!is_numeric($v)) // On entoure les chaînes d'apostrophes
                $values[$k] = $this->db->quote ($v);
        }
             
        $query .= ' ('. implode(',',$columns) .')';
        $query .= ' VALUES ('. implode(',',$values) .')';
             
        $q = $this->db->prepare($query);
        return (bool) $q -> execute();
    }
         
    public function update($table,$columns,$values,$where = null)
    {
        $query = 'UPDATE '. $table .' SET ';
        $fields = array();
             
        foreach($columns as $k => $v)
        {
            if(!is_numeric($values[$k]))
                $values[$k] = $this->db->quote($values[$k]);
                 
            $fields[] = $v .' = '. $values[$k];
        }
             
        $query .= implode(',',$fields);
             
        if(!empty($where))
            $query .= 'WHERE '. $this->parseCond($where);
             
        $q = $this->db->prepare($query);
        return (bool) $q->execute();
    }
         
    public function count($table,$group = '*',$where = null)
    {
        $query = 'SELECT COUNT('. $group .') FROM '. $table;
             
        if(!empty($where))
            $query .= ' WHERE '. $this->parseCond($where);
             
        $q = $this->db->prepare($query);
        $q -> execute();
        $count = $q->fetch();
        return $count[0];
    }

    public function parseCond($conds) // Array 2D -> 0:colonne,valeur,operateur/1:colonne,valeur,...
    {
        $where = ''; 
             
        if(is_array($conds))
        {
            foreach($conds as $k => $v)
            {
                if(is_array($conds[$k])) 
                {
                    $operator = (!empty($conds[$k][2])) ? $conds[$k][2] : ' = ';
                    $where .= $conds[$k][0] . $operator . $conds[$k][1] .' ';
                } else 
                {
                    switch($conds[$k]) :
                        case 'OR':
                            $where .= 'OR ';
                        break;
                        case 'AND':
                            $where .= 'AND ';
                        break;
                        default:
                            throw new Exception("Mot clé <b>". $conds[$k] ."</b> invalide !");
                        break;
                    endswitch;
                }
            }
        } else // Si les conds sont déjà sous forme de chaîne, on les retourne
        {
            return $conds;
        }
           
        return $where;
    }	
}


