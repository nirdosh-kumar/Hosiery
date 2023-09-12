<?php

namespace App\Controllers;
//use App\Controllers\BaseController;
use App\Models\Userlogin_model;

class Userlogin extends BaseController {
	private $Userlogin_model;
	public function __construct(){
		$this->Userlogin_model = new Userlogin_model();
	}
    public function index(){
		$data=[];
		if($this->request->getPost()){
			$rules = [
				'email' => ['label' => 'Email', 'rules' => 'required|valid_email'],
				'password' => ['label' => 'Password', 'rules' => 'required|min_length[6]|max_length[16]',
					'errors' => [
						'min_length' => 'Your {field} is too short. You want to get hacked?',
						'max_length' => 'Your {field} is maximum.',
					]
				],
			];
			if($this->validate($rules)) {
				$getrow = $this->Userlogin_model->user_login();
				if($getrow == true){
					return redirect()->to('/dashboard');
				}else{
					$this->session->setFlashdata('error', 'Invalid email or password');
					return redirect()->to('/login');
				}
			}else{
				$this->session->setFlashdata('error', $this->validation->listErrors());
				return redirect()->to('/login');
			}	
		}
		echo view('login', $data);
    }
}
