<?php if(! defined('BASE_PATH') ) exit('No direct script access allowed');

class ConnectionModel extends Model
{
	
    public function getAccount($login,$pass)
    {
        $query = $this->db->prepare('SELECT * FROM accounts WHERE account = ? AND pass = ?');
	$query->bindValue(1,$login);
	$query->bindValue(2,$pass);
	$query->execute();
		
	$account['count'] = $query -> rowCount();
	$account['infos'] = $query -> fetch();
        
        /*
        $account['infos']['characters'] = explode(';',$account['infos']['characters']);
        $characters = array();
        foreach($account['infos']['characters'] as $k => $v)
        {
            $current = explode(',',$v);
            $characters[] = $current[0];
        }*/
        $account['infos']['characters'] = $this->getPersos($account['infos']['guid']);
		
	return $account;
    }

    public function getPersos($accountId)
    {
        $query = $this->db->prepare('SELECT name FROM personnages WHERE account = ?');
        $query -> bindValue(1,$accountId);
        $query -> execute();
        return $query->fetchAll();
    }
}