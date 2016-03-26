<?php

class LadderModel extends Model
{	
   // Persos :
    public function listPersos($min,$max)
    {
        $this->switchDb(DB_STATIC);
        $query = $this->db->query ('SELECT * FROM personnages ORDER BY xp DESC LIMIT '.$min.','.$max);
        return $query -> fetchAll();
        $this->switchDb(DB_OTHER);
    }
	 
    public function persosCount()
    {
        $this->switchDb(DB_STATIC);
        $query = $this->db->query('SELECT COUNT(guid) AS count FROM personnages');
	return $query -> fetch();
        $this->switchDb(DB_OTHER);
    }
    
   // Guildes :
    public function listGuilds($min,$max)
    {
        $this->switchDb(DB_STATIC);
        $query = $this->db->query ('SELECT * FROM guilds ORDER BY xp DESC LIMIT '.$min.','.$max);
        return $query -> fetchAll();
        $this->switchDb(DB_OTHER);
    }
    
    public function guildsCount()
    {
        $this->switchDb(DB_STATIC);
        $query = $this->db->query('SELECT COUNT(id) AS count FROM guilds');
	return $query -> fetch();
        $this->switchDb(DB_OTHER);
    }
    
    public function guildMembersCount($guild)
    {
        $query = $this->db->prepare('SELECT COUNT(guid) AS count FROM guild_members WHERE guild = ?');
        $query->bindValue(1,$guild);
        $query->execute();
        return $query->fetch();
    }

   // Voteurs:
    public function listVoteurs($min,$max)
    {
        $query = $this->db->query ('SELECT * FROM accounts WHERE vote > 0 ORDER BY vote DESC LIMIT '.$min.','.$max);
        return $query -> fetchAll();
    }
	
    public function voteursCount()
    {
        $query = $this->db->query('SELECT COUNT(guid) AS count FROM accounts WHERE vote > 0');
	return $query -> fetch();
    }
}