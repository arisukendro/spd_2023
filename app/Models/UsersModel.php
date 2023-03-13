<?php
namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model 
{
    protected $table = 'users';
//     protected $primaryKey = 'id';
    
    protected $allowedFields = ['username','email','password_hash','active'];
    
    protected $useSoftDeletes = false ;
    
    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

   public function selectId($id)
    {
         return $this->db->table($this->table)
        //  ->join('klompeg','klompeg.id_klompeg='.$this->table.'.klompeg_id')
        //  ->join('subbag','subbag.id_subbag = '.$this->table.'.subbag_id')
        //  ->join('jabatan','jabatan.id_jabatan = '.$this->table.'.jabatan_id')
        //  ->where($this->primaryKey, $id)
         ->get()
         ->getRowArray();  
    }

     public function selectAll()
    {
         return $this->db->table($this->table)
         ->select('users.id id, username, email, active, agu.group_id, ag.id group_id, ag.name group_name, ag.description group_description')
         ->join('auth_groups_users agu','agu.user_id= '.$this->table.'.id')
         ->join('auth_groups ag','ag.id = agu.group_id')
         ->get()
         ->getResultArray();  
    }
}