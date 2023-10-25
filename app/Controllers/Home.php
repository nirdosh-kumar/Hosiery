<?php

namespace App\Controllers;
//use App\Controllers\BaseController;
use App\Models\Home_model;

class Home extends BaseController {
	private $Home_model;
	public function __construct(){
		$this->Home_model = new Home_model();
	}
    public function index(){
		$data=[];
		if ($this->request->isAJAX()){
			if($this->request->getPost('assessmentform') == 'true'){
				$this->validation->setRule('assessment', 'Select Assessment', ['required', 'alpha']);
				if($this->request->getPost('assessment') == 'Old'){
					$this->validation->setRule('ori', 'Old Resident ID', ['required', 'integer']);
				}else{
					$this->validation->setRule('ori', 'Old Resident ID', ['permit_empty', 'integer']);	
				}
				if($this->validation->withRequest($this->request)->run() == true){
					$countrows = $this->Home_model->check_old_resident();
					if($countrows < 1) {
						$response = [
							'status' => false,
							'message' => ['ori'=>'Old Resident ID is not exist in records'],
							'token' => csrf_hash()
						];
					}else{
						$response = [
							'status' => true,
							'token' => csrf_hash()
						];	
					}
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
			$data['editRow'] = $this->Home_model->user_info();
			echo view('dashboard', $data);	
		}
    }
}
