<?php if(! defined('BASE_PATH') ) exit('No direct script access allowed');

class CreditModel extends Model
{
    public function editPts($accountId,$newPts)
    {
        $query = $this->db->prepare('UPDATE accounts SET points = ? WHERE guid = ?');
        $query -> bindValue(1,$newPts);
        $query -> bindValue(2,$accountId);
        $query -> execute();
    }
	
    public function setLog($id)
    {
        $query = $this->db->prepare('INSERT INTO credits_logs(account,date,ip) VALUES(?,NOW(),?)');
	$query -> bindValue(1,$id);
	$query -> bindValue(2,getIp());
	$query -> execute();
    }
}