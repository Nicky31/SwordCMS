<?php

class BoutiqueModel extends Model
{
    public function listItems()
    {
        $this->switchDb(DB_STATIC);
        $query = $this->db->query('SELECT statsTemplate, id, level, name, points
                                   FROM item_template WHERE points > 0
                                   ORDER BY points DESC');
        $query -> execute();
        $this->switchDb(DB_OTHER);
        return $query->fetchAll();
    }
    
    public function getItemBoutique($itemId)
    {
        $this->switchDb(DB_STATIC);
        $query = $this->db->prepare('SELECT statsTemplate,id, level, name, points
                                     FROM item_template WHERE id = ? AND points > 0');
        $query -> bindValue(1,$itemId);
        $query -> execute();
        $this->switchDb(DB_OTHER);
        return $query->fetch();
    }
    
    public function getItemsLike($templateName)
    {
        $this->switchDb(DB_STATIC);
        $query = $this->db->prepare('SELECT name FROM item_template WHERE name LIKE ? LIMIT 0,5');
        $query -> bindValue(1,$templateName.'%');
        $query -> execute();
        $this->switchDb(DB_OTHER);
        return $query->fetchAll();
    } 
    
    public function getItem($templateId)
    {
        $this->switchDb(DB_STATIC);
        $query = $this->db->prepare('SELECT name,points,statsTemplate FROM item_template WHERE id = ?');
        $query -> bindValue(1, $templateId);
        $query -> execute();
        $this->switchDb(DB_OTHER);
        return $query->fetch();
    }
    
    public function getItemByName($templateName)
    {
        $this->switchDb(DB_STATIC);
        $query = $this->db->prepare('SELECT id,name,points,statsTemplate FROM item_template WHERE name = ?');
        $query -> bindValue(1, $templateName);
        $query -> execute();
        $this->switchDb(DB_OTHER);
        return $query->fetch();
    }
    
    public function itemBoutiqueExists($templateName)
    {
        $this->switchDb(DB_STATIC);
        $query = $this->db->prepare('SELECT COUNT(*) AS count FROM item_template WHERE name = ? AND points > 0');
        $query -> bindValue(1,$templateName);
        $query -> execute();
        $this->switchDb(DB_OTHER);
        $result = $query -> fetch();
        
        if($result['count'] > 0) // Item boutique déjà existant
            return TRUE;
        
        return FALSE;
    }
    
    public function getPerso($persoPseudo)
    {
        $query = $this->db->prepare('SELECT guid,account FROM personnages WHERE name = ?');
        $query -> bindValue(1,$persoPseudo);
        $query -> execute();
        return $query->fetch();
    }
    
    public function giveItem($persoId,$jet,$id)
    {
        $query = $this->db->prepare('INSERT INTO live_action(PlayerID,Action,Nombre) VALUES(?,?,?)');
        $query -> bindvalue(1,$persoId);
        $query -> bindValue(2,$jet);
        $query -> bindValue(3,$id);
        $query -> execute();
    }
    
    /*
    public function giveItem($persoId,$item,$title,$message,$image)
    {
        $query = $this->db->prepare('INSERT INTO gifts(Target,ItemID,Title,Message,Image) VALUES(?,?,?,?,?)');
        $query -> bindvalue(1,$persoId);
        $query -> bindValue(2,$item);
        $query -> bindValue(3,$title);
        $query -> bindValue(4,$message);
        $query -> bindValue(5,$image);
        $query -> execute();
    }*/
    
    public function editPts($accountId,$newPts)
    {
        $query = $this->db->prepare('UPDATE accounts SET points = ? WHERE guid = ?');
        $query -> bindValue(1,$newPts);
        $query -> bindValue(2,$accountId);
        $query -> execute();
    }
    
    public function setBoutique($item,$prix)
    {
        $this->switchDb(DB_STATIC);
        $query = $this->db->prepare('UPDATE item_template SET points = ? WHERE id = ?');
        $query -> bindValue(1,$prix);
        $query -> bindValue(2,$item);
        $query -> execute();
        $this->switchDb(DB_OTHER);
    }
    
    /*
    public function addItemBoutique($templateId, $price, $giftItemID, $templateName)
    {
        $this->switchDb(DB_STATIC);
        $query = $this->db->prepare('INSERT INTO shop_items(name,templateID,normal_price,giftItemID) VALUES (?,?,?,?)');
        $query -> bindValue(1, $templateName);
        $query -> bindValue(2, $templateId);
        $query -> bindValue(3, $price);
        $query -> bindValue(4, $giftItemID);
        $query -> execute();
        $this->switchDb(DB_OTHER);
    }*/
    
    public function deleteBoutique($item)
    {
        $this->switchDb(DB_STATIC);
        $query = $this->db->prepare('UPDATE item_template SET points = 0 WHERE id = ?');
        $query -> bindValue(1,$item);
        $query -> execute();
        $this->switchDb(DB_OTHER);
    }
    

}