<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\User_model;

class User extends BaseController {
	protected $User_model;
	public function __construct(){
		$this->User_model = new User_model();
	}
	function index(){
		$data=[];
		$data['userList'] = $this->User_model->list_user();
		echo view('user/user-list', $data);
	}
	function user_permission($id){
		$data=[];
		echo view('user/user-permission', $data);
	}
	function user_add(){
		$data=[];
		if ($this->request->isAJAX()){
			if($this->request->getPost('userform') == 'true'){
				$this->validation->setRule('user', 'Name', ['required', 'regex_match[/^['.spl_alpha().']*$/]'],[ 
					'regex_match' => '{field} is invalid'
				]);
				$this->validation->setRule('email', 'Email', ['required', 'is_unique[ci_users.userEmail]', 'valid_email'],[ 
					'is_unique' => 'This {field} is already exist.'
				]);
				$this->validation->setRule('password', 'Password', ['required', 'min_length[6]'],[ 
					'min_length' => 'Your {field} is too short. You want to get hacked?'
				]);				
				$this->validation->setRule('confirm', 'Confirm Password', ['required', 'matches[password]'],[ 
					'matches' => 'Your {field} is not match with password'
				]);
				$this->validation->setRule('role.*', 'Group', ['required', 'integer']);
				
				if($this->validation->withRequest($this->request)->run() == true){
					//_p($this->request->getPost());	
					$this->User_model->user_insert();
					$response = [
						'status' => true,
						'token' => csrf_hash()
					];
				}else{
					$data['postArr'] = $this->request->getPost();
					$data['fileArr'] = $this->request->getFile('photo');
					//$result = view('ajx/post-array', $data);
					
					$smgArr=[];
					foreach($this->validation->getErrors() as $k=>$val){
						$str = str_replace(['.', '*'], '', $k);
						$smgArr[$str] = $val;
					}
					$response = [
						'status' => false,
						'message' => $smgArr,
						//'post' => $result,
						'token' => csrf_hash()
					];
				}
			}
		   return $this->response->setJSON($response);
		}else{
			$data['groupList'] = $this->User_model->list_group();
			echo view('user/user-add', $data);
		}
	}
	function user_edit($id){
		$data=[];
		if ($this->request->isAJAX()){
			if($this->request->getPost('userform') == 'true'){
				$this->validation->setRule('user', 'Name', ['required', 'regex_match[/^['.spl_alpha().']*$/]'],[ 
					'regex_match' => '{field} is invalid.'
				]);
				$this->validation->setRule('email', 'Email', ['required', "is_unique[ci_users.userEmail, userID, $id]", 'valid_email'],[ 
					'is_unique' => 'This {field} is already exist.'
				]);
				$this->validation->setRule('password', 'Password', ['permit_empty', 'min_length[6]'],[ 
					'min_length' => 'Your {field} is too short. You want to get hacked?'
				]);				
				$this->validation->setRule('confirm', 'Confirm Password', ['permit_empty', 'matches[password]'],[ 
					'matches' => 'Your {field} is not match with password'
				]);
				$this->validation->setRule('role.*', 'Group', ['required', 'integer']);
				
				if($this->validation->withRequest($this->request)->run() == true){	
					$this->User_model->user_update($id);
					$response = [
						'status' => true,
						'token' => csrf_hash()
					];
				}else{
					$data['postArr'] = $this->request->getPost();
					$data['fileArr'] = $this->request->getFile('photo');
					//$result = view('ajx/post-array', $data);
					
					$smgArr=[];
					foreach($this->validation->getErrors() as $k=>$val){
						$str = str_replace(['.', '*'], '', $k);
						$smgArr[$str] = $val;
					}
					$response = [
						'status' => false,
						'message' => $smgArr,
						//'post' => $result,
						'token' => csrf_hash()
					];
				}
			}
		   return $this->response->setJSON($response);
		}else{
			$data['groupList'] = $this->User_model->list_group();
			$data['editRow'] = $this->User_model->list_user($id);	
			echo view('user/user-edit', $data);
		}
	}
	function user_delete($id){
		$this->User_model->delete_user($id);
		return redirect()->to('/user/list-user');
	}
	
	/****--Group--*****/
	function group_list(){
		$data=[];
		$data['groupList'] = $this->User_model->list_group();
		echo view('user/group-list', $data);
	}
	function group_add(){
		$data=[];
		if ($this->request->isAJAX()){
			if($this->request->getPost('groupform') == 'true'){
				$this->validation->setRule('title', 'Group name', 'required|regex_match[/^['.spl_alpha().']*$/]|is_unique[ci_group.groupTitle]',[ 
					'is_unique' => 'This {field} is already exist.',
					'regex_match' => '{field} is invalid.'
				]);
				
				if($this->validation->withRequest($this->request)->run() == true){	
					$this->User_model->group_insert();
					$response = [
						'status' => true,
						'token' => csrf_hash()
					];
				}else{
					$response = [
						'status' => false,
						'message' => $this->validation->getErrors(),
						'token' => csrf_hash()
					];
				}
			}
		   return $this->response->setJSON($response);
		}else{
			echo view('user/group-add', $data);
		}
	}
	function group_edit($id){
		$data=[];
		if ($this->request->isAJAX()){
			if($this->request->getPost('groupform') == 'true'){
				$this->validation->setRule('title', 'Group name', "required|regex_match[/^[".spl_alpha()."]*$/]|is_unique[ci_group.groupTitle, groupID, $id]",[ 
					'is_unique' => 'This {field} is already exist.',
					'regex_match' => '{field} is invalid.'
				]);
				if($this->validation->withRequest($this->request)->run() == true){	
					$this->User_model->group_update($id);
					$response = [
						'status' => true,
						'token' => csrf_hash()
					];
				}else{
					$response = [
						'status' => false,
						'message' => $this->validation->getErrors(),
						'token' => csrf_hash()
					];
				}
			}
		   return $this->response->setJSON($response);
		}else{
			$data['editRow'] = $this->User_model->list_group($id); 	
			echo view('user/group-edit', $data);
		}
	}
	function group_delete($id){
		$this->User_model->delete_group($id);
		return redirect()->to('user/list-group');
	}
	
	/*****--Group right--*****/
	function group_right($id){
		$data=[];
		if ($this->request->isAJAX()){
			if($this->request->getPost('rightform') == 'true'){				
				$rules = [
					'page' => ['label' => 'Template', 'rules' => 'permit_empty'],
					'subpage' => ['label' => 'Sub Template', 'rules' => 'permit_empty'],
					'right' => ['label' => 'Permission', 'rules' => 'required'],
				];
				if ($this->validate($rules)) {
					$this->User_model->group_permission($id);
					$response = [
						'status' => true,
						'token' => csrf_hash()
					];
				}else{
					$response = [
						'status' => false,
						'error' => $this->validation->listErrors(),
						'token' => csrf_hash()
					];
				}
			}
		   return $this->response->setJSON($response);
		}else{
			$data['userTemplate'] = $this->User_model->group_right_template($id);
			$data['usersubTemplate'] = $this->User_model->group_right_subtemplate($id);
			$data['userRight'] = $this->User_model->group_right_permission($id);
			$data['groupRow'] = $this->User_model->list_group($id); 	
			echo view('user/group-right', $data);	
		}
	}
	
	function signout(){
		 if($this->session->has('login_id')){
			$this->session->destroy();
			return redirect()->to('/dashboard');
		 }
	}
}
