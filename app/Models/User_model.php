<?php 

namespace App\Models;

use CodeIgniter\Model;

class User_model extends Model{
	protected $db;
	protected $request;
	function __construct(){
		parent::__construct();
		$this->request = \Config\Services::request();
		$this->db = db_connect();
	}
	function user_logged($id){
		$query = $this->db->table('ci_users AS u')
		->select('u.userID, u.userName, u.userEmail, u.userType, u.userRole')
		->where(['userID'=>$id])->get();
		if($query->getNumRows() > 0){
			return $query->getRowArray();	
		}
	}
	function user_insert(){
		$userImage = "";
		if ($this->request->getFile('photo')) {
			$file = $this->request->getFile('photo');	
			if ($file->isValid() && ! $file->hasMoved()) {
				$userImage = $file->getRandomName();
				$file->move(ROOTPATH . 'public/uploads/user', $userImage);	
			}
		}
		$isActive = $this->request->getPost('isactive') ? $this->request->getPost('isactive') : 0;
		$password = password_hash($this->request->getPost('password'), PASSWORD_BCRYPT);
		$data=[
			'userName'=>$this->request->getPost('user'),
			'userEmail'=>$this->request->getPost('email'),
			'userImage'=>$userImage,
			'userPassword'=>$password,
			'userRole'=>$this->request->getPost('role'),
			'isActive'=>$isActive,
			'addedOn'=>addedOn()
		];
		$this->db->table('ci_users')->insert($data);
	}
	function list_user($id=null){
		if($id == null){
			$query = $this->db->table('ci_users AS u')
			->select('u.userID, u.userName, u.userEmail, u.userRole, u.isActive')
			->where('u.isDeleted', 0)
			->get();
			//echo $this->db->getLastQuery();
			if($query->getNumRows() > 0){
				return $query->getResultArray();	
			}
		}else{
			$query = $this->db->table('ci_users')->where(['userID'=>$id, 'isDeleted'=>0])->get();
			if($query->getNumRows() > 0){
				return $query->getRowArray();	
			}
		}
	}
	function user_update($id){
		$userImage = "";
		if ($this->request->getFile('photo')) {
			$file = $this->request->getFile('photo');	
			if ($file->isValid() && ! $file->hasMoved()) {
				$userImage = $file->getRandomName();
				$file->move(ROOTPATH . 'public/uploads/user', $userImage);
				$this->db->table('ci_users')->where('userID', $id)->update([
					'userImage'=>$userImage,
				]);
			}
		}
		$isActive = $this->request->getPost('isactive') ? $this->request->getPost('isactive') : 0;
		
		if($this->request->getPost('password')){
			$password = password_hash($this->request->getPost('password'), PASSWORD_BCRYPT);
			$data=[
				'userName'=>$this->request->getPost('user'),
				'userEmail'=>$this->request->getPost('email'),
				'userPassword'=>$password,
				'userRole'=>$this->request->getPost('role'),
				'isActive'=>$isActive,
				'updatedOn'=>addedOn()
			];
			$this->db->table('ci_users')->where(['userID'=>$id, 'isDeleted'=>0])->update($data);
		}else{
			$data=[
				'userName'=>$this->request->getPost('user'),
				'userEmail'=>$this->request->getPost('email'),
				'userRole'=>$this->request->getPost('role'),
				'isActive'=>$isActive,
				'updatedOn'=>addedOn()
			];
			$this->db->table('ci_users')->where(['userID'=>$id, 'isDeleted'=>0])->update($data);
		}
	}
	function delete_user($id){
		$this->db->table('ci_users')->where(['userID'=>$id, 'isDeleted'=>0])->update([
			'isDeleted'=>1,
		]);
	}
} 
?>