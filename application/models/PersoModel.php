<?php

class PersoModel extends Model
{
    public function getPerso($persoPseudo)
    {
        $query = $this->db->prepare('SELECT * FROM personnages WHERE name = ?');
        $query -> bindValue(1,$persoPseudo);
        $query -> execute();
        return $query->fetch();
    }
    
    public function getGuildMembers()
    {
        $query = $this->db->query('SELECT guild,name FROM guild_members');
        return $query -> fetchAll();
    }
    
    public function getGuild($guild)
    {
        $query = $this->db->prepare('SELECT * FROM guilds WHERE id = ? ');
        $query -> bindValue(1,$guild);
        $query -> execute();
        return $query -> fetch();
    }
    
    public function getGuildCountMembers($guild)
    {
        $query = $this->db->prepare('SELECT COUNT(name) AS count FROM guild_members WHERE guild = ?');
        $query -> bindValue(1,$guild);
        $query -> execute();
        return $query -> fetch();
    }
    
    public function getItem($id)
    {
        $query = $this->db-> prepare('SELECT * FROM items WHERE guid = ?');
        $query -> bindValue(1,$id);
        $query -> execute();
        return $query -> fetch();
    }
    
    public function getTemplate($id)
    {
        $this->switchDb(DB_STATIC);
        $query = $this->db-> prepare('SELECT name,level FROM item_template WHERE id = ? ');
        $query -> bindValue(1,$id);
        $query -> execute();
        $this->switchDb(DB_OTHER);
        return $query -> fetch();
    }
    
    public function hasItemSet($item)
    {
        $this->switchDb(DB_STATIC);
        $query = $this->db->prepare('SELECT ItemSet,Name FROM item_db WHERE ID = ?');
        $query -> bindValue(1,$item);
        $query -> execute();
        $this->switchDb(DB_OTHER);
        return $query -> fetch();
    }
    
    public function getItemSet($id)
    {
        $this->switchDb(DB_STATIC);
        $query = $this->db-> prepare('SELECT * FROM itemsets WHERE ID = ? ');
        $query -> bindValue(1,$id);
        $query -> execute();
        $this->switchDb(DB_OTHER);
        return $query -> fetch();
    }
}