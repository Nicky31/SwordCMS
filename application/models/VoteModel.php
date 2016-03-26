<?php if(! defined('BASE_PATH') ) exit('No direct script access allowed');

class VoteModel extends Model
{
    
    public function editPts($accountId,$newPts)
    {
        $query = $this->db->prepare('UPDATE accounts SET points = ? WHERE guid = ?');
        $query -> bindValue(1,$newPts);
        $query -> bindValue(2,$accountId);
        $query -> execute();
    }
    
    public function upVotes($accountId)
    {
        $query = $this->db->prepare('UPDATE accounts SET vote = vote + 1 WHERE guid = ?');
        $query -> bindValue(1,$accountId);
        $query -> execute();
    }
	
    public function setLog($id)
    {
        $query = $this->db->prepare('INSERT INTO votes_logs(account,date,ip) VALUES(?,NOW(),?)');
	$query -> bindValue(1,$id);
	$query -> bindValue(2,getIp());
	$query -> execute();
    }
	 
    public function checkPermission($ip,$account)
    {
        $query = $this->db->prepare('SELECT 7200-(UNIX_TIMESTAMP(NOW()) - UNIX_TIMESTAMP(date)) AS wait FROM votes_logs WHERE (ADDDATE(date,INTERVAL 7200 SECOND) > NOW() AND ip = ?) OR (ADDDATE(date,INTERVAL 7200 SECOND) > NOW() AND account = ?)');
	$query -> bindValue(1,$ip);
	$query -> bindValue(2,$account);
	$query -> execute();
	$datas = $query -> fetch();
		
	$check['count'] = $query -> rowCount();
	$check['wait'] = $datas['wait'];
	return $check;
    }

}