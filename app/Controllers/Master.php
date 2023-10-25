<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\Master_model;

class Master extends BaseController {
	protected $Master_model;
	public function __construct(){
		$this->Master_model = new Master_model();
	}
	
	/****--General code type--*****/
	function index(){
		$data=[];
		$data['typeList'] = $this->Master_model->list_type();
		echo view('general-code/type-list', $data);
	}
	function type_add(){
		$data=[];
		if ($this->request->isAJAX()){
			if($this->request->getPost('typeform') == 'true'){
				$this->validation->setRule('title', 'Name', 'required|regex_match[/^['.spl_alpha().']*$/]|is_unique[ci_type.typeTitle]',[ 
					'is_unique' => 'This {field} is already exist.',
					'regex_match' => '{field} is invalid.'
				]);
				$this->validation->setRule('code', 'Code', ['required', 'regex_match[/^['.spl_alpha().']*$/]'],[ 
					'regex_match' => '{field} is invalid.'
				]);
				$this->validation->setRule('msg', 'Description', ['required', 'regex_match[/^['.spl_alpha().']*$/]'],[ 
					'regex_match' => '{field} is invalid.'
				]);
				if($this->validation->withRequest($this->request)->run() == true){	
					$this->Master_model->type_insert();
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
			echo view('general-code/type-add', $data);
		}
	}
	function type_edit($id){
		$data=[];
		if ($this->request->isAJAX()){
			if($this->request->getPost('typeform') == 'true'){
				$this->validation->setRule('title', 'Title', "required|regex_match[/^[".spl_alpha()."]*$/]|is_unique[ci_type.typeTitle, typeID, $id]",[ 
					'is_unique' => 'This {field} is already exist.',
					'regex_match' => '{field} is invalid.'
				]);
				$this->validation->setRule('code', 'Code', ['required', 'regex_match[/^['.spl_alpha().']*$/]'],[ 
					'regex_match' => '{field} is invalid.'
				]);
				$this->validation->setRule('msg', 'Description', ['required', 'regex_match[/^['.spl_alpha().']*$/]'],[ 
					'regex_match' => '{field} is invalid.'
				]);
				if($this->validation->withRequest($this->request)->run() == true){	
					$this->Master_model->type_update($id);
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
			$data['editRow'] = $this->Master_model->list_type($id); 	
			echo view('general-code/type-edit', $data);
		}
	}
	function type_delete($id){
		$this->Master_model->delete_type($id);
		return redirect()->to('general-code/list-type');
	}
	/*****--General code--*****/
	function general_list(){
		$data=[];
		$data['generalList'] = $this->Master_model->list_general();
		echo view('general-code/general-code-list', $data);
	}
	function general_add(){
		$data=[];
		if ($this->request->isAJAX()){
			if($this->request->getPost('generalform') == 'true'){
				$this->validation->setRule('general', 'General Code Type', ['required', 'is_natural']);
				/* $this->validation->setRule('code', 'General Code', ['required', 'is_unique[ci_general_code.generalCode]'],[ 
					'is_unique' => 'This {field} is already exist.'
				]); */
				$this->validation->setRule('code', 'General Code', ['required', 'regex_match[/^['.spl_alpha().']*$/]'],[ 
					'regex_match' => '{field} is invalid.'
				]);
				$this->validation->setRule('title', 'General Code Name', ['required', 'regex_match[/^['.spl_alpha().']*$/]'],[ 
					'regex_match' => '{field} is invalid.'
				]);
				$this->validation->setRule('msg', 'General Code Desc', ['required', 'regex_match[/^['.spl_alpha().']*$/]'],[ 
					'regex_match' => '{field} is invalid.'
				]);
				$this->validation->setRule('order1', 'Sort Order 1', 'permit_empty|is_natural|max_length['.sort_length().']|less_than_equal_to['.sort_value().']',[ 
					'max_length' => 'This {field} is required 4 digit in length',
					'less_than_equal_to' => 'This {field} should not be greater than '.sort_value(),
				]);
				$this->validation->setRule('order2', 'Sort Order 2', 'permit_empty|is_natural|max_length['.sort_length().']|less_than_equal_to['.sort_value().']',[ 
					'max_length' => 'This {field} is required 4 digit in length',
					'less_than_equal_to' => 'This {field} should not be greater than '.sort_value(),
				]);
				$this->validation->setRule('publish', 'Active Status', ['permit_empty', 'integer']);
				if($this->validation->withRequest($this->request)->run() == true){
					$countrows = $this->Master_model->check_general_code();
					if($countrows < 1){
						$this->Master_model->general_insert();
						$response = [
							'status' => true,
							'token' => csrf_hash()
						];	
					}else{
						$response = [
							'status' => false,
							'message' => ['code'=>'General Code is already exist for this General Code Type'],
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
			$data['getType'] = $this->Master_model->get_type();
			echo view('general-code/general-code-add', $data);
		}
	}
	function general_edit($id){
		$data=[];
		if ($this->request->isAJAX()){
			if($this->request->getPost('generalform') == 'true'){
				$this->validation->setRule('general', 'General Code Type', ['required', 'is_natural']);
				/* $this->validation->setRule('code', 'General Code', ['required', "is_unique[ci_general_code.generalCode, codeID, $id]"],[ 
					'is_unique' => 'This {field} is already exist.'
				]); */
				$this->validation->setRule('code', 'General Code', ['required', 'regex_match[/^['.spl_alpha().']*$/]'],[ 
					'regex_match' => '{field} is invalid.'
				]);
				$this->validation->setRule('title', 'General Code Name', ['required', 'regex_match[/^['.spl_alpha().']*$/]'],[ 
					'regex_match' => '{field} is invalid.'
				]);
				$this->validation->setRule('msg', 'General Code Desc', ['required', 'regex_match[/^['.spl_alpha().']*$/]'],[ 
					'regex_match' => '{field} is invalid.'
				]);
				$this->validation->setRule('order1', 'Sort Order 1', 'permit_empty|is_natural|max_length['.sort_length().']|less_than_equal_to['.sort_value().']',[ 
					'max_length' => 'This {field} is required 4 digit in length',
					'less_than_equal_to' => 'This {field} should not be greater than '.sort_value(),
				]);
				$this->validation->setRule('order2', 'Sort Order 2', 'permit_empty|is_natural|max_length['.sort_length().']|less_than_equal_to['.sort_value().']',[ 
					'max_length' => 'This {field} is required 4 digit in length',
					'less_than_equal_to' => 'This {field} should not be greater than '.sort_value(),
				]);
				$this->validation->setRule('publish', 'Active Status', ['permit_empty', 'integer']);
				if($this->validation->withRequest($this->request)->run() == true){
					$countrows=0;
					if( ($this->request->getPost('oldgeneral') != $this->request->getPost('general')) || ($this->request->getPost('oldcode') != $this->request->getPost('code')) ){
						$countrows = $this->Master_model->check_general_code();	
					}
					if($countrows < 1){
						$this->Master_model->general_update($id);
						$response = [
							'status' => true,
							'token' => csrf_hash()
						];
					}else{
						$response = [
							'status' => false,
							'message' => ['code'=>'General Code is already exist for this General Code Type'],
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
			$data['getType'] = $this->Master_model->get_type();
			$data['editRow'] = $this->Master_model->list_general($id);
			echo view('general-code/general-code-edit', $data);
		}
	}
	function general_delete($id){
		$this->Master_model->delete_general($id);
		return redirect()->to('general-code/list-general-code');
	}
	/******--currency---******/
	function currency_list(){
		$data=[];
		$data['currencyList'] = $this->Master_model->list_currency();
		echo view('master/currency-list', $data);
	}
	function currency_add(){
		$data=[];
		if ($this->request->isAJAX()){
			if($this->request->getPost('currencyform') == 'true'){
				$this->validation->setRule('code', 'Currency Code', 'required|alpha_numeric|is_unique[ci_currency.currency_code]',[ 
					'is_unique' => 'This {field} is already exist.'
				]);
				$this->validation->setRule('title', 'Currency Name', ['required', 'regex_match[/^['.spl_alpha().']*$/]'],[ 
					'regex_match' => '{field} is invalid.'
				]);
				$this->validation->setRule('deci', 'Decimal Name', ['required', 'regex_match[/^['.spl_alpha().']*$/]'],[ 
					'regex_match' => '{field} is invalid.'
				]);
				$this->validation->setRule('order1', 'Sort Order 1', 'permit_empty|is_natural|max_length['.sort_length().']|less_than_equal_to['.sort_value().']',[ 
					'max_length' => 'This {field} is required 4 digit in length',
					'less_than_equal_to' => 'This {field} should not be greater than '.sort_value(),
				]);
				$this->validation->setRule('order2', 'Sort Order 2', 'permit_empty|is_natural|max_length['.sort_length().']|less_than_equal_to['.sort_value().']',[ 
					'max_length' => 'This {field} is required 4 digit in length',
					'less_than_equal_to' => 'This {field} should not be greater than '.sort_value(),
				]);
				//$this->validation->setRule('publish', 'Active Status', ['permit_empty', 'integer']);
				if($this->validation->withRequest($this->request)->run() == true){	
					$this->Master_model->currency_insert();
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
			echo view('master/currency-add', $data);
		}
	}
	function currency_edit($id){
		$data=[];
		if ($this->request->isAJAX()){
			if($this->request->getPost('currencyform') == 'true'){
				$this->validation->setRule('code', 'Currency Code', "required|alpha_numeric|is_unique[ci_currency.currency_code, currency_ID, $id]",[ 
					'is_unique' => 'This {field} is already exist.'
				]);
				$this->validation->setRule('title', 'Currency Name', ['required', 'regex_match[/^['.spl_alpha().']*$/]'],[ 
					'regex_match' => '{field} is invalid.'
				]);
				$this->validation->setRule('deci', 'Decimal Name', ['required', 'regex_match[/^['.spl_alpha().']*$/]'],[ 
					'regex_match' => '{field} is invalid.'
				]);
				$this->validation->setRule('order1', 'Sort Order 1', 'permit_empty|is_natural|max_length['.sort_length().']|less_than_equal_to['.sort_value().']',[ 
					'max_length' => 'This {field} is required 4 digit in length',
					'less_than_equal_to' => 'This {field} should not be greater than '.sort_value(),
				]);
				$this->validation->setRule('order2', 'Sort Order 2', 'permit_empty|is_natural|max_length['.sort_length().']|less_than_equal_to['.sort_value().']',[ 
					'max_length' => 'This {field} is required 4 digit in length',
					'less_than_equal_to' => 'This {field} should not be greater than '.sort_value(),
				]);
				//$this->validation->setRule('publish', 'Active Status', ['permit_empty', 'integer']);
				if($this->validation->withRequest($this->request)->run() == true){	
					$this->Master_model->currency_update($id);
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
			$data['editRow'] = $this->Master_model->list_currency($id);
			echo view('master/currency-edit', $data);
		}
	}
	function currency_delete($id){
		$this->Master_model->delete_currency($id);
		return redirect()->to('master/list-currency');
	}
	/******--company---******/
	function select2_generalcode($id){
		if ($this->request->isAJAX()){
			$res=[];
			$searchstr = preg_replace('/[^a-zA-Z0-9 &,.(\/)-]+/', '', $this->request->getGet('search'));
			if(!empty($searchstr)){
				$products = $this->Master_model->generalcode_select2($searchstr, $id);
				foreach($products as $row){
					$res[] = ['id'=>$row['codeID'], 'text'=>$row['generalTitle']];
				}
			}
			$response = [
				'status' => true,
				'result' => $res,
				'token' => csrf_hash()
			];
					
			return $this->response->setJSON($response);
		}
	}
	function select2_currency(){
		if ($this->request->isAJAX()){
			$res=[];
			$searchstr = preg_replace('/[^a-zA-Z0-9 &,.(\/)-]+/', '', $this->request->getGet('search'));
			if(!empty($searchstr)){
				$products = $this->Master_model->currency_select2($searchstr);
				foreach($products as $row){
					$res[] = ['id'=>$row['currency_ID'], 'text'=>$row['currency_name']];
				}
			}
			$response = [
				'status' => true,
				'result' => $res,
				'token' => csrf_hash()
			];
					
			return $this->response->setJSON($response);
		}
	}
	function company_add(){
		$data=[];
		if ($this->request->isAJAX()){
			if($this->request->getPost('companyform') == 'true'){
				$this->validation->setRule('company', 'Company Name', 'required|regex_match[/^['.spl_alpha().']*$/]|is_unique[ci_company.company_name]',[ 
					'is_unique' => 'This {field} is already exist.',
					'regex_match' => '{field} is invalid.'
				]);
				$this->validation->setRule('regno', 'Reg No', ['permit_empty', 'regex_match[/^['.spl_alpha().']*$/]'],[ 
					'regex_match' => '{field} is invalid.'
				]);
				$this->validation->setRule('owner', 'Ownership', ['permit_empty', 'integer']);
				$this->validation->setRule('currency', 'Currency', ['required', 'integer']);
				$this->validation->setRule('gstno', 'GST No', 'permit_empty|gst_check|max_length[30]|alpha_numeric',[
					'gst_check' => '{field} is invalid format',
					'max_length' => '{field} should not exceed 30 character in length',
				]);
				$this->validation->setRule('vatno', 'VAT No', ['permit_empty', 'regex_match[/^['.spl_alpha().']*$/]'],[ 
					'regex_match' => '{field} is invalid.'
				]);
				$this->validation->setRule('logo', 'Company Logo', [ 'ext_in[logo,png,jpg,jpeg,gif,webp]|max_size[logo, 40096]'],[ 
					'ext_in' => 'Invalid {field} type to upload',
					'max_size' => '{field} exceeded maximun size to upload'
				]);
				$this->validation->setRule('address1', 'Address 1', ['required', 'regex_match[/^['.spl_alpha().']*$/]'],[ 
					'regex_match' => '{field} is invalid'
				]);
				$this->validation->setRule('address2', 'Address 2', ['permit_empty', 'regex_match[/^['.spl_alpha().']*$/]'],[ 
					'regex_match' => '{field} is invalid'
				]);
				$this->validation->setRule('address3', 'Address 3', ['permit_empty', 'regex_match[/^['.spl_alpha().']*$/]'],[ 
					'regex_match' => '{field} is invalid'
				]);
				$this->validation->setRule('city', 'City/Village/District', ['required', 'regex_match[/^['.spl_alpha().']*$/]'],[ 
					'regex_match' => '{field} is invalid'
				]);
				$this->validation->setRule('state', 'State', ['required', 'regex_match[/^['.spl_alpha().']*$/]'],[ 
					'regex_match' => '{field} is invalid'
				]);
				$this->validation->setRule('country', 'Country', ['required', 'regex_match[/^['.spl_alpha().']*$/]'],[ 
					'regex_match' => '{field} is invalid'
				]);
				$this->validation->setRule('pin', 'PIN Code', ['required', 'alpha_numeric']);
				$this->validation->setRule('phone1', 'Telephone 1', ['required', 'regex_match[/^[0-9]*$/]', 'min_length[10]', 'max_length[12]'],[ 
					'regex_match' => '{field} is invalid',
					'min_length' => '{field} should be atleast 10 digit',
					'max_length' => '{field} should be maximum of 12 digit',
				]);
				$this->validation->setRule('phone2', 'Telephone 2', ['permit_empty', 'regex_match[/^[0-9]*$/]', 'min_length[10]', 'max_length[12]'],[ 
					'regex_match' => '{field} is invalid',
					'min_length' => '{field} should be atleast 10 digit',
					'max_length' => '{field} should be maximum of 12 digit',
				]);
				$this->validation->setRule('email1', 'Email 1', ['required', 'valid_email']);
				$this->validation->setRule('email2', 'Email 2', ['permit_empty', 'valid_email']);
				$this->validation->setRule('attrb.*', 'Attribute', ['permit_empty', 'regex_match[/^['.spl_alpha().']*$/]'],[ 
					'regex_match' => '{field} is invalid'
				]);
				$this->validation->setRule('publish', 'Active Status', ['permit_empty', 'integer']);
				if($this->validation->withRequest($this->request)->run() == true){	
					$this->Master_model->company_insert();
					$response = [
						'status' => true,
						'token' => csrf_hash()
					];
				}else{
					$smgArr=[];
					foreach($this->validation->getErrors() as $k=>$val){
						$str = str_replace('.', '', $k);
						$smgArr[$str] = $val;
					}
					$response = [
						'status' => false,
						'message' => $smgArr,
						'token' => csrf_hash()
					];
				}
			}
		   return $this->response->setJSON($response);
		}else{
			$data['getCurrency'] = $this->Master_model->get_currency();
			$data['ownership'] = $this->Master_model->attributes(2);
			$data['getAttribute'] = $this->Master_model->attributes(1);
			echo view('master/company-add', $data);
		}
	}
	function company_list(){
		$data=[];
		$data['companyList'] = $this->Master_model->list_company();
		echo view('master/company-list', $data);
	}
	function company_edit($id){
		$data=[];
		if ($this->request->isAJAX()){
			if($this->request->getPost('companyform') == 'true'){
				$this->validation->setRule('company', 'Company Name', "required|regex_match[/^[".spl_alpha()."]*$/]|is_unique[ci_company.company_name, company_ID, $id]",[ 
					'is_unique' => 'This {field} is already exist.',
					'regex_match' => '{field} is invalid.'
				]);
				$this->validation->setRule('regno', 'Reg No', ['permit_empty', 'regex_match[/^['.spl_alpha().']*$/]'],[ 
					'regex_match' => '{field} is invalid.'
				]);
				$this->validation->setRule('owner', 'Ownership', ['permit_empty', 'integer']);
				$this->validation->setRule('currency', 'Currency', ['required', 'integer']);
				$this->validation->setRule('gstno', 'GST No', 'permit_empty|gst_check|max_length[30]|alpha_numeric',[
					'gst_check' => '{field} is invalid format',
					'max_length' => '{field} should not exceed 30 character in length',
				]);
				$this->validation->setRule('vatno', 'VAT No', ['permit_empty', 'regex_match[/^['.spl_alpha().']*$/]'],[ 
					'regex_match' => '{field} is invalid.'
				]);
				$this->validation->setRule('logo', 'Company Logo', [ 'ext_in[logo,png,jpg,jpeg,gif,webp]|max_size[logo, 40096]'],[ 
					'ext_in' => 'Invalid {field} type to upload',
					'max_size' => '{field} exceeded maximun size to upload'
				]);
				$this->validation->setRule('address1', 'Address 1', ['required', 'regex_match[/^['.spl_alpha().']*$/]'],[ 
					'regex_match' => '{field} is invalid'
				]);
				$this->validation->setRule('address2', 'Address 2', ['permit_empty', 'regex_match[/^['.spl_alpha().']*$/]'],[ 
					'regex_match' => '{field} is invalid'
				]);
				$this->validation->setRule('address3', 'Address 3', ['permit_empty', 'regex_match[/^['.spl_alpha().']*$/]'],[ 
					'regex_match' => '{field} is invalid'
				]);
				$this->validation->setRule('city', 'City/Village/District', ['required', 'regex_match[/^['.spl_alpha().']*$/]'],[ 
					'regex_match' => '{field} is invalid'
				]);
				$this->validation->setRule('state', 'State', ['required', 'regex_match[/^['.spl_alpha().']*$/]'],[ 
					'regex_match' => '{field} is invalid'
				]);
				$this->validation->setRule('country', 'Country', ['required', 'regex_match[/^['.spl_alpha().']*$/]'],[ 
					'regex_match' => '{field} is invalid'
				]);
				$this->validation->setRule('pin', 'PIN Code', ['required', 'alpha_numeric']);
				$this->validation->setRule('phone1', 'Telephone 1', ['required', 'regex_match[/^[0-9]*$/]', 'min_length[10]', 'max_length[12]'],[ 
					'regex_match' => '{field} is invalid',
					'min_length' => '{field} should be atleast 10 digit',
					'max_length' => '{field} should be maximum of 12 digit',
				]);
				$this->validation->setRule('phone2', 'Telephone 2', ['permit_empty', 'regex_match[/^[0-9]*$/]', 'min_length[10]', 'max_length[12]'],[ 
					'regex_match' => '{field} is invalid',
					'min_length' => '{field} should be atleast 10 digit',
					'max_length' => '{field} should be maximum of 12 digit',
				]);
				$this->validation->setRule('email1', 'Email 1', ['required', 'valid_email']);
				$this->validation->setRule('email2', 'Email 2', ['permit_empty', 'valid_email']);
				$this->validation->setRule('attrb.*', 'Attribute', ['permit_empty', 'regex_match[/^['.spl_alpha().']*$/]'],[ 
					'regex_match' => '{field} is invalid'
				]);
				$this->validation->setRule('publish', 'Active Status', ['permit_empty', 'integer']);
				if($this->validation->withRequest($this->request)->run() == true){	
					$this->Master_model->company_update($id);
					$response = [
						'status' => true,
						'token' => csrf_hash()
					];
				}else{
					$smgArr=[];
					foreach($this->validation->getErrors() as $k=>$val){
						$str = str_replace('.', '', $k);
						$smgArr[$str] = $val;
					}
					$response = [
						'status' => false,
						'message' => $smgArr,
						'token' => csrf_hash()
					];
				}
			}
		   return $this->response->setJSON($response);
		}else{
			$data['getCurrency'] = $this->Master_model->get_currency();
			$data['ownership'] = $this->Master_model->attributes(2);
			$data['getAttribute'] = $this->Master_model->attributes(1);
			$data['editRow'] = $this->Master_model->list_company($id);
			$data['editAttr'] = $this->Master_model->company_attributes($id);
			echo view('master/company-edit', $data);
		}
	}
	function company_delete($id){
		$this->Master_model->delete_company($id);
		return redirect()->to('master/list-company');
	}
	/******---supplier--******/
	function supplier_add(){
		$data=[];
		if ($this->request->isAJAX()){
			if($this->request->getPost('supplierform') == 'true'){
				$this->validation->setRule('code', 'Supplier Code', 'required|regex_match[/^['.spl_alpha().']*$/]|max_length[8]|is_unique[ci_supplier.supplier_code]',[ 
					'is_unique' => 'This {field} is already exist.',
					'max_length' => '{field} should not exceed 8 character in length',
					'regex_match' => '{field} is invalid.'
				]);
				$this->validation->setRule('sname', 'Supplier Name', ['required', 'regex_match[/^['.spl_alpha().']*$/]'],[ 
					'regex_match' => '{field} is invalid.'
				]);
				$this->validation->setRule('currency', 'Supplier Currency', ['required', 'is_natural']);
				$this->validation->setRule('terms', 'Delivery Terms', ['required', 'is_natural']);
				$this->validation->setRule('credit', 'Credit Terms', ['required', 'is_natural']);
				$this->validation->setRule('gstno', 'GST No', 'permit_empty|gst_check|max_length[30]|alpha_numeric',[
					'gst_check' => '{field} is invalid format',
					'max_length' => '{field} should not exceed 30 character in length',
				]);
				$this->validation->setRule('address1', 'Address 1', ['permit_empty', 'regex_match[/^['.spl_alpha().']*$/]'],[ 
					'regex_match' => '{field} is invalid'
				]);
				$this->validation->setRule('address2', 'Address 2', ['permit_empty', 'regex_match[/^['.spl_alpha().']*$/]'],[ 
					'regex_match' => '{field} is invalid'
				]);
				$this->validation->setRule('address3', 'Address 3', ['permit_empty', 'regex_match[/^['.spl_alpha().']*$/]'],[ 
					'regex_match' => '{field} is invalid'
				]);
				$this->validation->setRule('city', 'City/Village/District', ['permit_empty', 'regex_match[/^['.spl_alpha().']*$/]'],[ 
					'regex_match' => '{field} is invalid.'
				]);
				$this->validation->setRule('state', 'State', ['permit_empty', 'regex_match[/^['.spl_alpha().']*$/]'],[ 
					'regex_match' => '{field} is invalid.'
				]);
				$this->validation->setRule('country', 'Country', ['permit_empty', 'regex_match[/^['.spl_alpha().']*$/]'],[ 
					'regex_match' => '{field} is invalid.'
				]);
				$this->validation->setRule('pin', 'PIN Code', ['permit_empty', 'alpha_numeric']);
				$this->validation->setRule('phone1', 'Telephone 1', ['permit_empty', 'regex_match[/^[0-9]*$/]', 'min_length[10]', 'max_length[30]'],[ 
					'regex_match' => '{field} is invalid',
					'min_length' => '{field} should be atleast 10 digit',
					'max_length' => '{field} should be maximum of 12 digit',
				]);
				$this->validation->setRule('phone2', 'Telephone 2', ['permit_empty', 'regex_match[/^[0-9]*$/]', 'min_length[10]', 'max_length[30]'],[ 
					'regex_match' => '{field} is invalid',
					'min_length' => '{field} should be atleast 10 digit',
					'max_length' => '{field} should be maximum of 12 digit',
				]);
				$this->validation->setRule('email1', 'Email 1', ['permit_empty', 'valid_email']);
				$this->validation->setRule('email2', 'Email 2', ['permit_empty', 'valid_email']);
				$this->validation->setRule('attrb.*', 'Attribute', ['permit_empty', 'regex_match[/^['.spl_alpha().']*$/]'],[ 
					'regex_match' => '{field} is invalid.'
				]);
				$this->validation->setRule('publish', 'Active Status', ['permit_empty', 'is_natural']);
				$this->validation->setRule('cname.*', 'Name', ['permit_empty', 'regex_match[/^['.spl_alpha().']*$/]'],[ 
					'regex_match' => '{field} is invalid.'
				]);
				$this->validation->setRule('position.*', 'Designation', ['permit_empty', 'regex_match[/^['.spl_alpha().']*$/]'],[ 
					'regex_match' => '{field} is invalid.'
				]);
				$this->validation->setRule('cemail.*', 'Email', ['permit_empty', 'valid_email']);
				$this->validation->setRule('cphone.*', 'Mobile', ['permit_empty', 'regex_match[/^[0-9]*$/]', 'min_length[10]', 'max_length[30]'],[ 
					'regex_match' => '{field} is invalid',
					'min_length' => '{field} should be atleast 10 digit',
					'max_length' => '{field} should be maximum of 12 digit',
				]);
				$this->validation->setRule('ctele.*', 'Telephone', ['permit_empty', 'regex_match[/^[0-9]*$/]', 'min_length[10]', 'max_length[30]'],[ 
					'regex_match' => '{field} is invalid',
					'min_length' => '{field} should be atleast 10 digit',
					'max_length' => '{field} should be maximum of 12 digit',
				]);
				if($this->validation->withRequest($this->request)->run() == true){	
					$this->Master_model->supplier_insert();
					$response = [
						'status' => true,
						'token' => csrf_hash()
					];
				}else{
					$smgArr=[];
					foreach($this->validation->getErrors() as $k=>$val){
						$str = str_replace('.', '', $k);
						$smgArr[$str] = $val;
					}
					$response = [
						'status' => false,
						'message' => $smgArr,
						'token' => csrf_hash()
					];
				}
			}
		   return $this->response->setJSON($response);
		}else{
			$data['getCurrency'] = $this->Master_model->get_currency();
			/* $data['dterms'] = $this->Master_model->delivery_attribute(); */
			$data['dterms'] = $this->Master_model->attributes(9);
			/* $data['cterms'] = $this->Master_model->credit_attribute(); */
			$data['cterms'] = $this->Master_model->attributes(10);
			$data['getAttribute'] = $this->Master_model->attributes(11);
			echo view('master/supplier-add', $data);
		}
	}
	function supplier_list(){
		$data=[];
		$data['supplierList'] = $this->Master_model->list_supplier();
		echo view('master/supplier-list', $data);
	}
	function supplier_edit($id){
		$data=[];
		if ($this->request->isAJAX()){
			if($this->request->getPost('supplierform') == 'true'){
				$this->validation->setRule('code', 'Supplier Code', "required|regex_match[/^[".spl_alpha()."]*$/]|max_length[8]|is_unique[ci_supplier.supplier_code, supplier_ID, $id]",[ 
					'is_unique' => 'This {field} is already exist.',
					'max_length' => '{field} should not exceed 8 character in length',
					'regex_match' => '{field} is invalid.'
				]);
				$this->validation->setRule('sname', 'Supplier Name', ['required', 'regex_match[/^['.spl_alpha().']*$/]'],[ 
					'regex_match' => '{field} is invalid.'
				]);
				$this->validation->setRule('currency', 'Supplier Currency', ['required', 'is_natural']);
				$this->validation->setRule('terms', 'Delivery Terms', ['required', 'is_natural']);
				$this->validation->setRule('credit', 'Credit Terms', ['required', 'is_natural']);
				$this->validation->setRule('gstno', 'GST No', 'permit_empty|gst_check|max_length[30]|alpha_numeric',[
					'gst_check' => '{field} is invalid format',
					'max_length' => '{field} should not exceed 30 character in length',
				]);
				$this->validation->setRule('address1', 'Address 1', ['permit_empty', 'regex_match[/^['.spl_alpha().']*$/]'],[ 
					'regex_match' => '{field} is invalid'
				]);
				$this->validation->setRule('address2', 'Address 2', ['permit_empty', 'regex_match[/^['.spl_alpha().']*$/]'],[ 
					'regex_match' => '{field} is invalid'
				]);
				$this->validation->setRule('address3', 'Address 3', ['permit_empty', 'regex_match[/^['.spl_alpha().']*$/]'],[ 
					'regex_match' => '{field} is invalid'
				]);
				$this->validation->setRule('city', 'City/Village/District', ['permit_empty', 'regex_match[/^['.spl_alpha().']*$/]'],[ 
					'regex_match' => '{field} is invalid.'
				]);
				$this->validation->setRule('state', 'State', ['permit_empty', 'regex_match[/^['.spl_alpha().']*$/]'],[ 
					'regex_match' => '{field} is invalid.'
				]);
				$this->validation->setRule('country', 'Country', ['permit_empty', 'regex_match[/^['.spl_alpha().']*$/]'],[ 
					'regex_match' => '{field} is invalid.'
				]);
				$this->validation->setRule('pin', 'PIN Code', ['permit_empty', 'alpha_numeric']);
				$this->validation->setRule('phone1', 'Telephone 1', ['permit_empty', 'regex_match[/^[0-9]*$/]', 'min_length[10]', 'max_length[30]'],[ 
					'regex_match' => '{field} is invalid',
					'min_length' => '{field} should be atleast 10 digit',
					'max_length' => '{field} should be maximum of 12 digit',
				]);
				$this->validation->setRule('phone2', 'Telephone 2', ['permit_empty', 'regex_match[/^[0-9]*$/]', 'min_length[10]', 'max_length[30]'],[ 
					'regex_match' => '{field} is invalid',
					'min_length' => '{field} should be atleast 10 digit',
					'max_length' => '{field} should be maximum of 12 digit',
				]);
				$this->validation->setRule('email1', 'Email 1', ['permit_empty', 'valid_email']);
				$this->validation->setRule('email2', 'Email 2', ['permit_empty', 'valid_email']);
				$this->validation->setRule('attrb.*', 'Attribute', ['permit_empty', 'regex_match[/^['.spl_alpha().']*$/]'],[ 
					'regex_match' => '{field} is invalid.'
				]);
				$this->validation->setRule('publish', 'Active Status', ['permit_empty', 'integer']);
				$this->validation->setRule('cname.*', 'Name', ['permit_empty', 'regex_match[/^['.spl_alpha().']*$/]'],[ 
					'regex_match' => '{field} is invalid.'
				]);
				$this->validation->setRule('position.*', 'Designation', ['permit_empty', 'regex_match[/^['.spl_alpha().']*$/]'],[ 
					'regex_match' => '{field} is invalid.'
				]);
				$this->validation->setRule('cemail.*', 'Email', ['permit_empty', 'valid_email']);
				$this->validation->setRule('cphone.*', 'Mobile', ['permit_empty', 'regex_match[/^[0-9]*$/]', 'min_length[10]', 'max_length[30]'],[ 
					'regex_match' => '{field} is invalid',
					'min_length' => '{field} should be atleast 10 digit',
					'max_length' => '{field} should be maximum of 12 digit',
				]);
				$this->validation->setRule('ctele.*', 'Telephone', ['permit_empty', 'regex_match[/^[0-9]*$/]', 'min_length[10]', 'max_length[30]'],[ 
					'regex_match' => '{field} is invalid',
					'min_length' => '{field} should be atleast 10 digit',
					'max_length' => '{field} should be maximum of 12 digit',
				]);
				if($this->validation->withRequest($this->request)->run() == true){	
					$this->Master_model->supplier_update($id);
					$response = [
						'status' => true,
						'token' => csrf_hash()
					];
				}else{
					$smgArr=[];
					foreach($this->validation->getErrors() as $k=>$val){
						$str = str_replace('.', '', $k);
						$smgArr[$str] = $val;
					}
					$response = [
						'status' => false,
						'message' => $smgArr,
						'token' => csrf_hash()
					];
				}
			}
		   return $this->response->setJSON($response);
		}else{
			$data['editRow'] = $this->Master_model->list_supplier($id);
			$data['getCurrency'] = $this->Master_model->get_currency();
			/* $data['dterms'] = $this->Master_model->delivery_attribute(); */
			$data['dterms'] = $this->Master_model->attributes(9);
			/* $data['cterms'] = $this->Master_model->credit_attribute(); */
			$data['cterms'] = $this->Master_model->attributes(10);
			$data['getAttribute'] = $this->Master_model->attributes(11);
			$data['editAttr'] = $this->Master_model->supplier_attributes($id);
			$data['editContact'] = $this->Master_model->supplier_contact($id);
			echo view('master/supplier-edit', $data);
		}
	}
	function supplier_delete($id){
		$this->Master_model->delete_supplier($id);
		return redirect()->to('master/list-supplier');
	}
	/******---customer--******/
	function customer_add(){
		$data=[];
		if ($this->request->isAJAX()){
			if($this->request->getPost('customerform') == 'true'){
				$this->validation->setRule('code', 'Customer Code', 'required|regex_match[/^['.spl_alpha().']*$/]|max_length[8]|is_unique[ci_customer.customer_code]',[ 
					'is_unique' => 'This {field} is already exist.',
					'max_length' => '{field} should not exceed 8 character in length',
					'regex_match' => '{field} is invalid.'
				]);
				$this->validation->setRule('sname', 'Customer Name', ['required', 'regex_match[/^['.spl_alpha().']*$/]'],[ 
					'regex_match' => '{field} is invalid.'
				]);
				$this->validation->setRule('fixed', 'Fixed Discount %', ['required', 'decimal']);
				$this->validation->setRule('terms', 'Payment Terms', ['required', 'is_natural']);
				$this->validation->setRule('gstno', 'GST No', 'permit_empty|gst_check|max_length[30]|alpha_numeric',[
					'gst_check' => '{field} is invalid format',
					'max_length' => '{field} should not exceed 30 character in length',
				]);
				$this->validation->setRule('vatno', 'VAT No', ['permit_empty', 'regex_match[/^['.spl_alpha().']*$/]'],[ 
					'regex_match' => '{field} is invalid.'
				]);
				$this->validation->setRule('order1', 'Sort Order 1', 'permit_empty|is_natural|max_length['.sort_length().']|less_than_equal_to['.sort_value().']',[ 
					'max_length' => 'This {field} is required 4 digit in length',
					'less_than_equal_to' => 'This {field} should not be greater than '.sort_value(),
				]);
				$this->validation->setRule('order2', 'Sort Order 2', 'permit_empty|is_natural|max_length['.sort_length().']|less_than_equal_to['.sort_value().']',[ 
					'max_length' => 'This {field} is required 4 digit in length',
					'less_than_equal_to' => 'This {field} should not be greater than '.sort_value(),
				]);
				$this->validation->setRule('address1', 'Address 1', ['permit_empty', 'regex_match[/^['.spl_alpha().']*$/]'],[ 
					'regex_match' => '{field} is invalid'
				]);
				$this->validation->setRule('address2', 'Address 2', ['permit_empty', 'regex_match[/^['.spl_alpha().']*$/]'],[ 
					'regex_match' => '{field} is invalid'
				]);
				$this->validation->setRule('address3', 'Address 3', ['permit_empty', 'regex_match[/^['.spl_alpha().']*$/]'],[ 
					'regex_match' => '{field} is invalid'
				]);				
				$this->validation->setRule('city', 'City/Village/District', ['permit_empty', 'regex_match[/^['.spl_alpha().']*$/]'],[ 
					'regex_match' => '{field} is invalid.'
				]);
				$this->validation->setRule('state', 'State', ['permit_empty', 'regex_match[/^['.spl_alpha().']*$/]'],[ 
					'regex_match' => '{field} is invalid.'
				]);
				$this->validation->setRule('country', 'Country', ['permit_empty', 'regex_match[/^['.spl_alpha().']*$/]'],[ 
					'regex_match' => '{field} is invalid.'
				]);
				$this->validation->setRule('pin', 'PIN Code', ['permit_empty', 'alpha_numeric']);
				$this->validation->setRule('phone1', 'Telephone 1', ['permit_empty', 'regex_match[/^[0-9]*$/]', 'min_length[10]', 'max_length[30]'],[ 
					'regex_match' => '{field} is invalid',
					'min_length' => '{field} should be atleast 10 digit',
					'max_length' => '{field} should be maximum of 12 digit',
				]);
				$this->validation->setRule('phone2', 'Telephone 2', ['permit_empty', 'regex_match[/^[0-9]*$/]', 'min_length[10]', 'max_length[30]'],[ 
					'regex_match' => '{field} is invalid',
					'min_length' => '{field} should be atleast 10 digit',
					'max_length' => '{field} should be maximum of 12 digit',
				]);
				$this->validation->setRule('email1', 'Email 1', ['permit_empty', 'valid_email']);
				$this->validation->setRule('email2', 'Email 2', ['permit_empty', 'valid_email']);
				$this->validation->setRule('attrb.*', 'Attribute', ['permit_empty', 'regex_match[/^['.spl_alpha().']*$/]'],[ 
					'regex_match' => '{field} is invalid.'
				]);
				$this->validation->setRule('publish', 'Active Status', ['permit_empty', 'integer']);
				$this->validation->setRule('cname.*', 'Name', ['permit_empty', 'regex_match[/^['.spl_alpha().']*$/]'],[ 
					'regex_match' => '{field} is invalid.'
				]);
				$this->validation->setRule('position.*', 'Designation', ['permit_empty', 'regex_match[/^['.spl_alpha().']*$/]'],[ 
					'regex_match' => '{field} is invalid.'
				]);
				$this->validation->setRule('cemail.*', 'Email', ['permit_empty', 'valid_email']);
				$this->validation->setRule('cphone.*', 'Mobile', ['permit_empty', 'regex_match[/^[0-9]*$/]', 'min_length[10]', 'max_length[30]'],[ 
					'regex_match' => '{field} is invalid',
					'min_length' => '{field} should be atleast 10 digit',
					'max_length' => '{field} should be maximum of 12 digit',
				]);
				$this->validation->setRule('ctele.*', 'Telephone', ['permit_empty', 'regex_match[/^[0-9]*$/]', 'min_length[10]', 'max_length[30]'],[ 
					'regex_match' => '{field} is invalid',
					'min_length' => '{field} should be atleast 10 digit',
					'max_length' => '{field} should be maximum of 12 digit',
				]);
				if($this->validation->withRequest($this->request)->run() == true){	
					$this->Master_model->customer_insert();
					$response = [
						'status' => true,
						'token' => csrf_hash()
					];
				}else{
					$smgArr=[];
					foreach($this->validation->getErrors() as $k=>$val){
						$str = str_replace('.', '', $k);
						$smgArr[$str] = $val;
					}
					$response = [
						'status' => false,
						'message' => $smgArr,
						'token' => csrf_hash()
					];
				}
			}
		   return $this->response->setJSON($response);
		}else{
			/* $data['pterms'] = $this->Master_model->payment_attribute(); */
			$data['pterms'] = $this->Master_model->attributes(3);
			$data['getAttribute'] = $this->Master_model->attributes(12);
			echo view('master/customer-add', $data);
		}
	}
	function customer_list(){
		$data=[];
		$data['customerList'] = $this->Master_model->list_customer();
		echo view('master/customer-list', $data);
	}
	function customer_edit($id){
		$data=[];
		if ($this->request->isAJAX()){
			if($this->request->getPost('customerform') == 'true'){
				$this->validation->setRule('code', 'Customer Code', "required|regex_match[/^[".spl_alpha()."]*$/]|max_length[8]|is_unique[ci_customer.customer_code, customer_ID, $id]",[ 
					'is_unique' => 'This {field} is already exist.',
					'max_length' => '{field} should not exceed 8 character in length',
				]);
				$this->validation->setRule('sname', 'Customer Name', ['required', 'regex_match[/^['.spl_alpha().']*$/]'],[ 
					'regex_match' => '{field} is invalid.'
				]);
				$this->validation->setRule('fixed', 'Fixed Discount %', ['required', 'decimal']);
				$this->validation->setRule('terms', 'Payment Terms', ['required', 'is_natural']);
				$this->validation->setRule('gstno', 'GST No', 'permit_empty|gst_check|max_length[30]|alpha_numeric',[
					'gst_check' => '{field} is invalid format',
					'max_length' => '{field} should not exceed 30 character in length',
				]);
				$this->validation->setRule('vatno', 'VAT No', ['permit_empty', 'regex_match[/^['.spl_alpha().']*$/]'],[ 
					'regex_match' => '{field} is invalid.'
				]);
				$this->validation->setRule('order1', 'Sort Order 1', 'permit_empty|is_natural|max_length['.sort_length().']|less_than_equal_to['.sort_value().']',[ 
					'max_length' => 'This {field} is required 4 digit in length',
					'less_than_equal_to' => 'This {field} should not be greater than '.sort_value(),
				]);
				$this->validation->setRule('order2', 'Sort Order 2', 'permit_empty|is_natural|max_length['.sort_length().']|less_than_equal_to['.sort_value().']',[ 
					'max_length' => 'This {field} is required 4 digit in length',
					'less_than_equal_to' => 'This {field} should not be greater than '.sort_value(),
				]);
				$this->validation->setRule('address1', 'Address 1', ['permit_empty', 'regex_match[/^['.spl_alpha().']*$/]'],[ 
					'regex_match' => '{field} is invalid'
				]);
				$this->validation->setRule('address2', 'Address 2', ['permit_empty', 'regex_match[/^['.spl_alpha().']*$/]'],[ 
					'regex_match' => '{field} is invalid'
				]);
				$this->validation->setRule('address3', 'Address 3', ['permit_empty', 'regex_match[/^['.spl_alpha().']*$/]'],[ 
					'regex_match' => '{field} is invalid'
				]);
				$this->validation->setRule('city', 'City/Village/District', ['permit_empty', 'regex_match[/^['.spl_alpha().']*$/]'],[ 
					'regex_match' => '{field} is invalid.'
				]);
				$this->validation->setRule('state', 'State', ['permit_empty', 'regex_match[/^['.spl_alpha().']*$/]'],[ 
					'regex_match' => '{field} is invalid.'
				]);
				$this->validation->setRule('country', 'Country', ['permit_empty', 'regex_match[/^['.spl_alpha().']*$/]'],[ 
					'regex_match' => '{field} is invalid.'
				]);
				$this->validation->setRule('pin', 'PIN Code', ['permit_empty', 'alpha_numeric']);
				$this->validation->setRule('phone1', 'Telephone 1', ['permit_empty', 'regex_match[/^[0-9]*$/]', 'min_length[10]', 'max_length[30]'],[ 
					'regex_match' => '{field} is invalid',
					'min_length' => '{field} should be atleast 10 digit',
					'max_length' => '{field} should be maximum of 12 digit',
				]);
				$this->validation->setRule('phone2', 'Telephone 2', ['permit_empty', 'regex_match[/^[0-9]*$/]', 'min_length[10]', 'max_length[30]'],[ 
					'regex_match' => '{field} is invalid',
					'min_length' => '{field} should be atleast 10 digit',
					'max_length' => '{field} should be maximum of 12 digit',
				]);
				$this->validation->setRule('email1', 'Email 1', ['permit_empty', 'valid_email']);
				$this->validation->setRule('email2', 'Email 2', ['permit_empty', 'valid_email']);
				$this->validation->setRule('attrb.*', 'Attribute', ['permit_empty', 'regex_match[/^['.spl_alpha().']*$/]'],[ 
					'regex_match' => '{field} is invalid.'
				]);
				$this->validation->setRule('publish', 'Active Status', ['permit_empty', 'integer']);
				$this->validation->setRule('cname.*', 'Name', ['permit_empty', 'regex_match[/^['.spl_alpha().']*$/]'],[ 
					'regex_match' => '{field} is invalid.'
				]);
				$this->validation->setRule('position.*', 'Designation', ['permit_empty', 'regex_match[/^['.spl_alpha().']*$/]'],[ 
					'regex_match' => '{field} is invalid.'
				]);
				$this->validation->setRule('cemail.*', 'Email', ['permit_empty', 'valid_email']);
				$this->validation->setRule('cphone.*', 'Mobile', ['permit_empty', 'regex_match[/^[0-9]*$/]', 'min_length[10]', 'max_length[30]'],[ 
					'regex_match' => '{field} is invalid',
					'min_length' => '{field} should be atleast 10 digit',
					'max_length' => '{field} should be maximum of 12 digit',
				]);
				$this->validation->setRule('ctele.*', 'Telephone', ['permit_empty', 'regex_match[/^[0-9]*$/]', 'min_length[10]', 'max_length[30]'],[ 
					'regex_match' => '{field} is invalid',
					'min_length' => '{field} should be atleast 10 digit',
					'max_length' => '{field} should be maximum of 12 digit',
				]);
				if($this->validation->withRequest($this->request)->run() == true){	
					$this->Master_model->customer_update($id);
					$response = [
						'status' => true,
						'token' => csrf_hash()
					];
				}else{
					$smgArr=[];
					foreach($this->validation->getErrors() as $k=>$val){
						$str = str_replace('.', '', $k);
						$smgArr[$str] = $val;
					}
					$response = [
						'status' => false,
						'message' => $smgArr,
						'token' => csrf_hash()
					];
				}
			}
		   return $this->response->setJSON($response);
		}else{
			$data['editRow'] = $this->Master_model->list_customer($id);
			/* $data['pterms'] = $this->Master_model->payment_attribute(); */
			$data['pterms'] = $this->Master_model->attributes(3);
			$data['getAttribute'] = $this->Master_model->attributes(12);
			$data['editAttr'] = $this->Master_model->customer_attributes($id);
			$data['editContact'] = $this->Master_model->customer_contact($id);
			echo view('master/customer-edit', $data);
		}
	}
	/******---size set--******/
	function sizeset_add(){
		$data=[];
		if ($this->request->isAJAX()){
			if($this->request->getPost('sizesetform') == 'true'){
				$this->validation->setRule('sizeset', 'Size Set', 'required|regex_match[/^['.spl_alpha().']*$/]|is_unique[ci_size_set.size_set_name]',[ 
					'is_unique' => 'This {field} is already exist.',
					'regex_match' => 'Special character is not allowed in {field}',
				]);
				$this->validation->setRule('multisize.*', 'Size', ['required', 'is_natural']);
				if($this->validation->withRequest($this->request)->run() == true){	
					$this->Master_model->sizeset_insert();
					$response = [
						'status' => true,
						'token' => csrf_hash()
					];
				}else{
					$smgArr=[];
					foreach($this->validation->getErrors() as $k=>$val){
						$str = str_replace(['.', '*'], '', $k);
						$smgArr[$str] = $val;
					}
					$response = [
						'status' => false,
						'message' => $smgArr,
						'token' => csrf_hash()
					];
				}
			}
		   return $this->response->setJSON($response);
		}else{
			$data['getCode'] = $this->Master_model->size_general_code(7);
			echo view('master/sizeset-add', $data);
		}
	}
	function sizeset_list(){
		$data=[];
		$data['sizesetList'] = $this->Master_model->list_sizeset();
		echo view('master/sizeset-list', $data);
	}
	function sizeset_edit($id){
		$data=[];
		if ($this->request->isAJAX()){
			if($this->request->getPost('sizesetform') == 'true'){
				$this->validation->setRule('sizeset', 'Size Set', "required|regex_match[/^[".spl_alpha()."]*$/]|is_unique[ci_size_set.size_set_name, size_set_ID, $id]",[ 
					'is_unique' => 'This {field} is already exist.',
					'regex_match' => 'Special character is not allowed in {field}',
				]);
				$this->validation->setRule('multisize.*', 'Size', ['required', 'is_natural']);
				if($this->validation->withRequest($this->request)->run() == true){	
					$this->Master_model->sizeset_update($id);
					$response = [
						'status' => true,
						'token' => csrf_hash()
					];
				}else{
					$smgArr=[];
					foreach($this->validation->getErrors() as $k=>$val){
						$str = str_replace(['.', '*'], '', $k);
						$smgArr[$str] = $val;
					}
					$response = [
						'status' => false,
						'message' => $smgArr,
						'token' => csrf_hash()
					];
				}
			}
		   return $this->response->setJSON($response);
		}else{
			$data['editRow'] = $this->Master_model->list_sizeset($id);
			$data['sizesList'] = $this->Master_model->sizeset_code($id);
			$data['getCode'] = $this->Master_model->size_general_code(7);
			echo view('master/sizeset-edit', $data);
		}
	}
	function sizeset_delete($id){
		$this->Master_model->delete_sizeset($id);
		return redirect()->to('master/list-sizeset');
	}
}
