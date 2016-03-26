<?php if(! defined('BASE_PATH') ) exit('No direct script access allowed');

class InscriptionModel extends Model
{
    
    public function checkExists($login)
    {
        $query = $this->db->prepare('SELECT COUNT(guid) AS count FROM accounts WHERE account = ?');
	$query -> bindValue(1,$login);
	$query -> execute();
	$query = $query -> fetch();
		
	if($query['count'] >= 1) // Si un compte avec le ndc demand� existe
            return true;
	else
            return false;
    }
    
    public function checkExistsPseudo($pseudo)
    {
        $query = $this->db->prepare('SELECT COUNT(guid) AS count FROM accounts WHERE pseudo = ?');
	$query -> bindValue(1,$pseudo);
	$query -> execute();
	$query = $query -> fetch();
		
        if($query['count'] >= 1) // Si un compte avec le ndc demand� existe
            return true;
	else
            return false;
    }
	
    public function createAccount($login,$pass,$pseudo,$question,$answer,$email)
    {
        $query = $this->db->prepare('INSERT INTO accounts(account,pass,pseudo,question,reponse,email) VALUES
									 (?,?,?,?,?,?)');
        $query->bindValue(1,$login);
	$query->bindValue(2,$pass);
	$query->bindValue(3,$pseudo);
	$query->bindValue(4,$question);
	$query->bindValue(5,$answer);
	$query->bindValue(6,$email);
	$query->execute();	
    }
}