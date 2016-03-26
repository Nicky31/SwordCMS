<?php if(! defined('BASE_PATH') ) exit('No direct script access allowed');

class ProfilModel extends Model
{

    public function getAccount($id)
    {
        $query = $this->db->prepare ('SELECT password FROM accounts WHERE guid = ?');
	$query -> bindValue(1,$id);
	$query -> execute();
	$datas = $query -> fetch();
        return $datas;
    }

    public function editPassword($pass,$id)
    {
        $query = $this->db->prepare ('UPDATE accounts SET pass = ? WHERE guid = ?');
	$query -> bindValue(1,$pass);
	$query -> bindValue(2,$id);
	$query -> execute();
    }
    
    public function editAccount($account,$id)
    {
        $query = $this->db->prepare ('UPDATE accounts SET account = ? WHERE guid = ?');
	$query -> bindValue(1,$account);
	$query -> bindValue(2,$id);
	$query -> execute();
    }
    
    public function editMail($email,$id)
    {
        $query = $this->db->prepare ('UPDATE accounts SET email = ? WHERE guid = ?');
	$query -> bindValue(1,$email);
	$query -> bindValue(2,$id);
	$query -> execute();
    }
    
        
    public function editQuestion($question,$reponse,$id)
    {
        $query = $this->db->prepare ('UPDATE accounts SET question = ?,reponse = ? WHERE guid = ?');
	$query -> bindValue(1,$question);
        $query -> bindValue(2,$reponse);
	$query -> bindValue(3,$id);
	$query -> execute();
    }
}