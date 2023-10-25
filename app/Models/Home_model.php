<?php 

namespace App\Models;

use CodeIgniter\Model;

class Home_model extends Model{
	protected $db;
	protected $request;
	function __construct(){
		parent::__construct();
		$this->session = \Config\Services::session();
		$this->request = \Config\Services::request();
		$this->db = \Config\Database::connect();
	}
	function user_info(){
		$query = $this->db->table('ci_users AS u')
		->select('u.userName, u.userName AS modifiby, u.modified_on, u.created_by, u.created_on')
		->where(['u.userID'=>$this->session->get('login_id'), 'u.isActive'=>1])
		->get();
		if($query->getNumRows() > 0){
			return $query->getRowArray();	
		}
	}
} 
?>