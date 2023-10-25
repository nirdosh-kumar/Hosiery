<?php 

namespace App\Models;

use CodeIgniter\Model;

class User_model extends Model{
	protected $db;
	protected $request;
	function __construct(){
		parent::__construct();
		$this->session = \Config\Services::session();
		$this->request = \Config\Services::request();
		$this->db = db_connect();
	}
	function user_logged($id){
		$query = $this->db->table('ci_users AS u')
		->select('u.userID, u.userName, u.userEmail, u.userType')
		->where(['userID'=>$id])->get();
		if($query->getNumRows() > 0){
			return $query->getRowArray();	
		}
	}
	function user_insert(){
		$userImage=$roleid="";
		/* if ($this->request->getFile('photo')) {
			$file = $this->request->getFile('photo');	
			if ($file->isValid() && ! $file->hasMoved()) {
				$userImage = $file->getRandomName();
				$file->move(ROOTPATH . 'public/uploads/user', $userImage);	
			}
		} */
		$isActive = $this->request->getPost('isactive') ? $this->request->getPost('isactive') : 0;
		
		foreach($this->request->getPost('role') as $role){
			$roleid .= $role.',';
		}
		$roleid = reduce_multiples($roleid, ', ', true);
		
		$password = password_hash($this->request->getPost('password'), PASSWORD_BCRYPT);
		$data=[
			'groupID'=>$roleid,
			'userName'=>ltrimr($this->request->getPost('user')),
			'userEmail'=>ltrimr($this->request->getPost('email')),
			'userImage'=>$userImage,
			'userPassword'=>$password,
			'isActive'=>$isActive,
			'created_by'=>$this->session->get('login_id'),
			'created_on'=>addedOn()
		];
		$this->db->table('ci_users')->insert($data);
		$userID = $this->db->insertID();
		
		$query = $this->db->table('ci_group_right')->whereIn('groupID', $this->request->getPost('role'))->get();
		if($query->getNumRows() > 0){
			$data=$urlArr=[];
			foreach($query->getResultArray() as $row){
				if(!in_array($row['urlSegment'], $urlArr)){
					$data[]=[
						'userID'=>$userID,
						'pageHead'=>$row['pageHead'],
						'pagesubHead'=>$row['pagesubHead'],
						'urlSegment'=>$row['urlSegment'],
					];	
				}
				$urlArr[] = $row['urlSegment'];
			}
			$this->db->table('ci_permission')->insertBatch($data);	
		}
	}
	function get_groups($str){
		$newArr = explode(',', $str);
		$query = $this->db->table('ci_group')
		->select('groupTitle')
		->whereIn('groupID', $newArr, false)
		->where('isDeleted', 0)
		->get();
		//echo $this->db->getLastQuery();
		if($query->getNumRows() > 0){
			return $query->getResultArray();	
		}
	}
	function list_user($id=null){
		if($id == null){
			$query = $this->db->table('ci_users AS u')
			->select('u.userID, u.userName, u.userEmail, u.groupID, u.isActive, g.groupTitle')
			->join('ci_group AS g', 'g.groupID=u.groupID', 'INNER')
			->whereNotIn('u.groupID', [1])
			->where('u.isDeleted', 0)
			->get();
			//echo $this->db->getLastQuery();
			if($query->getNumRows() > 0){
				return $query->getResultArray();	
			}
		}else{
			$query = $this->db->table('ci_users AS us')
			->select('us.*, u.userName, u2.userName AS modifiby')
			->join('ci_users AS u', 'u.userID=us.created_by', 'INNER')
			->join('ci_users AS u2', 'u2.userID=us.modified_by', 'INNER')
			->where(['us.userID'=>$id, 'us.isDeleted'=>0])
			->get();
			if($query->getNumRows() > 0){
				return $query->getRowArray();	
			}
		}
	}
	function user_update($id){
		$userImage=$roleid="";
		/* if ($this->request->getFile('photo')) {
			$file = $this->request->getFile('photo');	
			if ($file->isValid() && ! $file->hasMoved()) {
				$userImage = $file->getRandomName();
				$file->move(ROOTPATH . 'public/uploads/user', $userImage);
				$this->db->table('ci_users')->where('userID', $id)->update([
					'userImage'=>$userImage,
				]);
			}
		} */
		$isActive = $this->request->getPost('isactive') ? $this->request->getPost('isactive') : 0;
		
		foreach($this->request->getPost('role') as $role){
			$roleid .= $role.',';
		}
		$roleid = reduce_multiples($roleid, ', ', true);
		
		if($this->request->getPost('password')){
			$password = password_hash($this->request->getPost('password'), PASSWORD_BCRYPT);
			$data=[
				'groupID'=>$roleid,
				'userName'=>ltrimr($this->request->getPost('user')),
				'userEmail'=>ltrimr($this->request->getPost('email')),
				'userPassword'=>$password,
				'isActive'=>$isActive,
				'modified_by'=>$this->session->get('login_id'),
				'modified_on'=>addedOn()
			];
			$this->db->table('ci_users')->where(['userID'=>$id, 'isDeleted'=>0])->update($data);
		}else{
			$data=[
				'groupID'=>$roleid,
				'userName'=>$this->request->getPost('user'),
				'userEmail'=>$this->request->getPost('email'),
				'isActive'=>$isActive,
				'modified_by'=>$this->session->get('login_id'),
				'modified_on'=>addedOn()
			];
			$this->db->table('ci_users')->where(['userID'=>$id, 'isDeleted'=>0])->update($data);
		}
		
		$query = $this->db->table('ci_group_right')->whereIn('groupID', $this->request->getPost('role'))->get();
		
		if($query->getNumRows() > 0){
			$data=$urlArr=[];
			foreach($query->getResultArray() as $row){
				if(!in_array($row['urlSegment'], $urlArr)){
					$data[]=[
						'userID'=>$id,
						'pageHead'=>$row['pageHead'],
						'pagesubHead'=>$row['pagesubHead'],
						'urlSegment'=>$row['urlSegment'],
					];	
				}
				$urlArr[] = $row['urlSegment'];
			}
			$this->db->table('ci_permission')->where('userID', $id)->delete();
			$this->db->table('ci_permission')->insertBatch($data);	
		}
	}
	function delete_user($id){
		$this->db->table('ci_users')->where(['userID'=>$id, 'isDeleted'=>0])->update([
			'modified_by'=>$this->session->get('login_id'),
			'modified_on'=>addedOn(),
			'isDeleted'=>1,
		]);
	}
	
	/*****--Group--*****/	
	function group_insert(){
		$data=[
			'groupTitle'=>ltrimr($this->request->getPost('title')),
			'created_by'=>$this->session->get('login_id'),
			'created_on'=>addedOn()
		];
		$this->db->table('ci_group')->insert($data);
	}
	function list_group($id=null){
		if($id == null){
			$query = $this->db->table('ci_group AS g')
			->select('g.groupID, g.groupTitle')
			->where('g.groupID !=', 1)
			->where('g.isDeleted', 0)
			->get();
			//echo $this->db->getLastQuery();
			if($query->getNumRows() > 0){
				return $query->getResultArray();	
			}
		}else{
			$query = $this->db->table('ci_group AS g')
			->select('g.*, u.userName, u2.userName AS modifiby')
			->join('ci_users AS u', 'u.userID=g.created_by', 'INNER')
			->join('ci_users AS u2', 'u2.userID=g.modified_by', 'INNER')
			->where(['g.groupID'=>$id, 'g.isDeleted'=>0])
			->get();
			if($query->getNumRows() > 0){
				return $query->getRowArray();	
			}
		}
	}
	function group_update($id){
		$data=[
			'groupTitle'=>ltrimr($this->request->getPost('title')),
			'modified_by'=>$this->session->get('login_id'),
			'modified_on'=>addedOn()
		];
		$this->db->table('ci_group')->where(['groupID'=>$id, 'isDeleted'=>0])->update($data);
	}
	function delete_group($id){
		$this->db->table('ci_group')->where(['groupID'=>$id, 'isDeleted'=>0])->update([
			'modified_by'=>$this->session->get('login_id'),
			'modified_on'=>addedOn(),
			'isDeleted'=>1,
		]);
	}
	
	/*****--Group right--*****/
	function group_right_template($id){
		$query = $this->db->table('ci_group_right')
		->select('pageHead')
		->where(['groupID'=>$id])
		->groupBy('pageHead')->get();
		if($query->getNumRows() > 0){
			return $query->getResultArray();			
		}
	}
	function group_right_subtemplate($id){
		$query = $this->db->table('ci_group_right')
		->select('pagesubHead')
		->where(['groupID'=>$id])
		->groupBy('pagesubHead')->get();
		if($query->getNumRows() > 0){
			return $query->getResultArray();			
		}
	}
	function group_right_permission($id){
		$query = $this->db->table('ci_group_right')
		->select('urlSegment')
		->where(['groupID'=>$id])
		->get();
		if($query->getNumRows() > 0){
			return $query->getResultArray();			
		}
	}
	function group_permission($id){
		//_p($this->request->getPost());
		$data=[];
		if(!empty($this->request->getPost('right'))){
			$this->db->table('ci_group_right')->where('groupID', $id)->delete();
			$exp1='';
			foreach($this->request->getPost('right') as $key=>$valArr){
				$exp = explode('*-*', $key);
				if(array_key_exists(1, $exp) == true){
					$exp1 = $exp[1];
				}
				
				foreach($valArr as $val){
					$data[] = [
						'groupID'=>$id,
						'pageHead'=>$exp[0],
						'pagesubHead'=>$exp1,
						'urlSegment'=>$val
					];
				}
			}
			$this->db->table('ci_group_right')->insertBatch($data);
		}
	}
} 
?>