<?php

class ScreensModel extends Model
{
    public function getScreens()
    {
        $query = $this->db->query('SELECT * FROM screenshots');
        return $query->fetchAll();
    }
    
    public function addScreen($url,$comments)
    {
        $query = $this->db->prepare('INSERT INTO screenshots(url,comments) VALUES (?,?)');
        $query -> bindValue(1,$url);
        $query -> bindValue(2,$comments);
        $query -> execute();
    }
    
    public function deleteScreen($id)
    {
        $query = $this->db->prepare('DELETE FROM screenshots WHERE id = ?');
        $query -> bindValue(1,$id);
        $query -> execute();
    }
}