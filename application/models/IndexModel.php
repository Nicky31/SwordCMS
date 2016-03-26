<?php if(! defined('BASE_PATH') ) exit('No direct script access allowed');

class IndexModel extends Model
{   
    public function initStats()
    {
        $stats = array();

        $query = $this->db->query('SELECT COUNT(guid) AS count FROM accounts');
        $stats['comptes'] = $query -> fetch(); // Nombre de comptes
        
        $query = $this->db->query('SELECT COUNT(guid) AS count FROM accounts WHERE logged = 1');
	$stats['logged'] = $query -> fetch(); // Nombre de comptes connectés
		
	return $stats;
    }
	
    public function checkConnec($server,$port) // teste la connction d'un serveur, renvoi une bool
    {
        $connec = @fsockopen($server,$port,$errno,$errstr,1);
	if(!$connec)
            return false;
	fclose($connec);
	return true;
    }

}