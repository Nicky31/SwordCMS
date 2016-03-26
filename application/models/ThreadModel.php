<?php if(! defined('BASE_PATH') ) exit('No direct script access allowed');

class ThreadModel extends Model
{

    public function listThreads($type,$min,$max)
    {
        $query = $this->db->prepare('SELECT * FROM threads WHERE type = ? ORDER BY id DESC LIMIT '. $min.','.$max);
        $query -> bindValue(1,$type);
        $query -> execute();
        return $query -> fetchAll();
    }
    
    public function getThread($id)
    {
        $query = $this->db->prepare('SELECT * FROM threads WHERE id = ?');
        $query -> bindValue(1, $id);
        $query -> execute();
        return $query -> fetch();
    }
	
    public function threadsCount($threadType)
    {
        $query = $this->db->prepare('SELECT COUNT(id) AS count FROM threads WHERE type = ?');
        $query -> bindValue(1,$threadType);
        $query -> execute();
	return $query -> fetch();
    }
	
    public function insertThread($title,$news,$account,$type)
    {	
        $query = $this->db->prepare('INSERT INTO threads(titre,text,auteur,type,date) VALUES(?,?,?,?,NOW())');
	$query -> bindValue(1,$title);
	$query -> bindValue(2,$news);
	$query -> bindValue(3,$account);
	$query -> bindValue(4,$type);
	return (bool) $query -> execute();
    }
	
    public function deleteThread($id)
    {
        $query = $this->db->prepare('DELETE FROM threads WHERE id = ?');
	$query -> bindValue(1,$id);
	$query -> execute();
    }
	
    public function edit($title,$news,$id)
    {
        $query = $this->db->prepare('UPDATE threads SET titre = ?,text = ?,date = NOW() WHERE id = ?');
	$query -> bindValue(1,$title);
	$query -> bindValue(2,$news);
	$query -> bindValue(3,$id);
	$query -> execute();
    }    

}