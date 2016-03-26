<?php

class ServersModel extends Model
{
    public function statsServer($serverHost,$serverPort)
    {
        $stats = array();

	$stats['server'] = 'En ligne';
	// $stats['server'] = ($this->checkConnec($serverHost,$serverPort)) ? "EN LIGNE" : "<font color=\"red\">Hors ligne</font>";
        $query = $this->db->query('SELECT COUNT(Id) AS count FROM accounts');
        $stats['comptes'] = $query -> fetch(); // Nombre de comptes
        
        $query = $this->db->query('SELECT COUNT(Id) AS count FROM accounts WHERE Logged = 1');
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