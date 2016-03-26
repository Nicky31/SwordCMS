<?php if(! defined('BASE_PATH') ) exit('No direct script access allowed');

class StaffModel extends Model
{
    public function listStaff()
    {
        $query = $this->db->query ('SELECT pseudo,level FROM accounts WHERE level > 0 ORDER BY level DESC')
                          -> fetchAll();
	return $query;
    }
}