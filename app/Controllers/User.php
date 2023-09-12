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
				
				$this->validation->setRule('user', 'Name', ['required', 'alpha_numeric_space']);
				$this->validation->setRule('email', 'Email', ['required', 'is_unique[ci_users.userEmail]', 'valid_email'],[ 
					'is_unique' => 'This {field} is already exist.'
				]);
				$this->validation->setRule('password', 'Password', ['required', 'min_length[6]'],[ 
					'min_length' => 'Your {field} is too short. You want to get hacked?'
				]);
				$this->validation->setRule('photo', 'Image', [ 'ext_in[photo,png,jpg,jpeg,gif,webp]|max_size[photo, 40096]'],[ 
					'ext_in' => 'Invalid {field} type to upload',
					'max_size' => '{field} exceeded maximun size to upload'
				]);
				
				$this->validation->setRule('confirm', 'Confirm Password', ['required', 'matches[password]'],[ 
					'matches' => 'Your {field} is not match with password'
				]);
				$this->validation->setRule('role', 'Position', ['required', 'alpha_numeric_space']);
				
				if($this->validation->withRequest($this->request)->run() == true){	
					$this->User_model->user_insert();
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
			echo view('user/user-add', $data);
		}
	}
	function user_edit($id){
		$data=[];
		if ($this->request->isAJAX()){
			if($this->request->getPost('userform') == 'true'){
				
				$this->validation->setRule('user', 'Name', ['required', 'alpha_numeric_space']);
				$this->validation->setRule('email', 'Email', ['required', "is_unique[ci_users.userEmail, userID, $id]", 'valid_email'],[ 
					'is_unique' => 'This {field} is already exist.'
				]);
				$this->validation->setRule('password', 'Password', ['permit_empty', 'min_length[6]'],[ 
					'min_length' => 'Your {field} is too short. You want to get hacked?'
				]);
				$this->validation->setRule('photo', 'Image', [ 'ext_in[photo,png,jpg,jpeg,gif,webp]|max_size[photo, 40096]'],[ 
					'ext_in' => 'Invalid {field} type to upload',
					'max_size' => '{field} exceeded maximun size to upload'
				]);
				
				$this->validation->setRule('confirm', 'Confirm Password', ['permit_empty', 'matches[password]'],[ 
					'matches' => 'Your {field} is not match with password'
				]);
				$this->validation->setRule('role', 'Position', ['required', 'alpha_numeric_space']);
				
				if($this->validation->withRequest($this->request)->run() == true){	
					$this->User_model->user_update($id);
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
			$data['editRow'] = $this->User_model->list_user($id);	
			echo view('user/user-edit', $data);
		}
	}
	function user_delete($id){
		$this->User_model->delete_user($id);
		return redirect()->to('/list-user');
	}
	function signout(){
		 if($this->session->has('login_id')){
			$this->session->destroy();
			return redirect()->to('/dashboard');
		 }
	}
}
