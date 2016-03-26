<?php

class CommentsModel extends Model
{
    public function getThread($id)
    {
        $query = $this->db->prepare('SELECT * FROM threads WHERE id = ? LIMIT 0,1');
        $query -> bindValue(1,$id);
        $query -> execute();
        return $query -> fetch();
    }
    
    public function getComments($threadId,$min,$max)
    {
        $query = $this->db->prepare('SELECT * FROM comments WHERE thread = ? ORDER BY id DESC LIMIT '.$min.','.$max);
        $query -> bindValue(1,$threadId);
        $query -> execute();
        return $query -> fetchAll();
    }
    
    public function commentsCount($thread)
    {
        $query = $this->db->prepare('SELECT COUNT(id) AS count FROM comments WHERE thread = ?');
        $query -> bindValue(1,$thread);
        $query -> execute();
        return $query -> fetch();
    }
    
    public function addComment($text,$auteur,$thread)
    {
        $query = $this->db->prepare('INSERT INTO comments(text,auteur,date,thread) VALUES (?,?,NOW(),?)');
        $query -> bindValue(1,$text);
        $query -> bindValue(2,$auteur);
        $query -> bindValue(3,$thread);
        $query -> execute();
    }
    
    public function getComment($commentId)
    {
        $query = $this->db->prepare('SELECT * FROM comments WHERE id = ?');
        $query -> bindValue(1,$commentId);
        $query -> execute();
        return $query -> fetch();
    }
    
    public function deleteComment($commentId)
    {
        $query = $this->db->prepare('DELETE FROM comments WHERE id = ?');
        $query -> bindValue(1,$commentId);
        $query -> execute();
    }
    
    public function editComment($commentId,$text)
    {
        $query = $this->db->prepare('UPDATE comments SET text = ? WHERE id = ?');
        $query -> bindValue(1,$text);
        $query -> bindValue(2,$commentId);
        $query -> execute();
    }
}