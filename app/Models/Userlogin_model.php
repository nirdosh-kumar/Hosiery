<?php 

namespace App\Models;

use CodeIgniter\Model;

class Userlogin_model extends Model{
	protected $db;
	protected $request;
	function __construct(){
		parent::__construct();
		$this->session = \Config\Services::session();
		$this->request = \Config\Services::request();
		$this->db = \Config\Database::connect();
	}
	function user_login(){
		$query = $this->db->table('ci_users')
		->select('userID, userName, userPassword')
		->where(['userEmail'=>$this->request->getPost('email'), 'isDeleted'=>0, 'isActive'=>1])
		->get();
		if($query->getNumRows() > 0){
			$row = $query->getRowArray();
			if (password_verify($this->request->getPost('password'), $row['userPassword'])) {
				$this->session->set('login_id', $row['userID']);
				$this->session->set('login_name', ucwords($row['userName']));
				return true;
			}
		}else{
			return false;
		}
	}
	function check_login(): bool {
		$query = $this->db->table('ci_users')
		->select('userID')
		->where(['userID'=>$this->session->get('login_id'), 'isDeleted'=>0, 'isActive'=>1])
		->get();
		if($query->getNumRows() > 0){
			return true;
		}else{
			return false;
		}
	}
	function check_right($str){
		$str = preg_replace('/[^a-z0-9-\/]/i', '', $str);
		
		$query = $this->db->query(
			"SELECT COUNT(*) AS numrows FROM ci_permission 
			WHERE userID=".$this->session->get('login_id')." 
			AND FIND_IN_SET('$str', urlSegment)"
		);
		$countrow = $query->getRowArray();
		
		$query1 = $this->db->table('ci_users AS u')
		->select('u.groupID')
		//->select('g.groupTitle')
		//->join('ci_group AS g', 'g.groupID=u.groupID', 'INNER')
		->where(['u.userID'=>$this->session->get('login_id'), 'u.isDeleted'=>0, 'u.isActive'=>1])
		->get();
		$row = $query1->getRowArray();
		/* echo $this->db->getLastQuery();
		exit; */
		
		if($countrow['numrows'] > 0){
			return true;
		}else if($row['groupID'] === '1') {
			return true;
		}else{
			return false;
		}
	}
} 
?>