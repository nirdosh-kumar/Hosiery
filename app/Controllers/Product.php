<?php

namespace App\Controllers;
//use App\Controllers\BaseController;
use App\Models\Product_model;

class Product extends BaseController {
	private $Product_model;
	public function __construct(){
		$this->Product_model = new Product_model();
	}
	function index(){
		$data=[];
		$data['categoryList'] = $this->Product_model->list_category();
		echo view('product/category-list', $data);
	}
    function category_add(){
		$data=[];
		if ($this->request->isAJAX()){
			if($this->request->getPost('categoryform') == 'true'){
				$this->validation->setRule('code', 'Category Code', 'required|regex_match[/^['.spl_alpha().']*$/]|is_unique[ci_product_category.product_category_code]',[ 
					'is_unique' => 'This {field} is already exist.',
					'regex_match' => '{field} is invalid.'
				]);
				$this->validation->setRule('catname', 'Category Name', ['required', 'regex_match[/^['.spl_alpha().']*$/]'],[ 
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
				if($this->validation->withRequest($this->request)->run() == true){
					$this->Product_model->category_insert();
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
			echo view('product/category-add', $data);	
		}
    }
	function category_edit($id){
		$data=[];
		if ($this->request->isAJAX()){
			if($this->request->getPost('categoryform') == 'true'){
				$this->validation->setRule('code', 'Category Code', "required|regex_match[/^[".spl_alpha()."]*$/]|is_unique[ci_product_category.product_category_code, product_category_ID, $id]",[ 
					'is_unique' => 'This {field} is already exist.',
					'regex_match' => '{field} is invalid.'
				]);
				$this->validation->setRule('catname', 'Category Name', ['required', 'regex_match[/^['.spl_alpha().']*$/]'],[ 
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
				if($this->validation->withRequest($this->request)->run() == true){
					$this->Product_model->category_update($id);
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
			$data['editRow'] = $this->Product_model->list_category($id);
			echo view('product/category-edit', $data);	
		}
	}
	function category_delete($id){
		$this->Product_model->delete_category($id);
		return redirect()->to('product/list-category');
	}
	/******--product type---******/
	function type_add(){
		$data=[];
		if ($this->request->isAJAX()){
			if($this->request->getPost('typeform') == 'true'){
				$this->validation->setRule('typecat', 'Product Category', ['required', 'is_natural']);
				$this->validation->setRule('code', 'Product Type Code', 'required|regex_match[/^['.spl_alpha().']*$/]|is_unique[ci_product_type.product_type_code]',[ 
					'is_unique' => 'This {field} is already exist.',
					'regex_match' => '{field} is invalid.'
				]);
				$this->validation->setRule('typename', 'Product Type Name', ['required', 'regex_match[/^['.spl_alpha().']*$/]'],[ 
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
				$this->validation->setRule('publish', 'Active Status', ['required', 'integer']);
				if($this->validation->withRequest($this->request)->run() == true){	
					$this->Product_model->type_insert();
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
			$data['categoryGet'] = $this->Product_model->get_category();
			echo view('product/type-add', $data);
		}
	}
	function type_list(){
		$data=[];
		$data['typeList'] = $this->Product_model->list_type();
		echo view('product/type-list', $data);
	}
	function type_edit($id){
		$data=[];
		if ($this->request->isAJAX()){
			if($this->request->getPost('typeform') == 'true'){
				$this->validation->setRule('typecat', 'Product Category', ['required', 'is_natural']);
				$this->validation->setRule('code', 'Product Type Code', "required|regex_match[/^[".spl_alpha()."]*$/]|is_unique[ci_product_type.product_type_code, product_type_ID, $id]",[ 
					'is_unique' => 'This {field} is already exist.',
					'regex_match' => '{field} is invalid.'
				]);
				$this->validation->setRule('typename', 'Product Type Name', ['required', 'regex_match[/^['.spl_alpha().']*$/]'],[ 
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
				$this->validation->setRule('publish', 'Active Status', ['required', 'integer']);
				if($this->validation->withRequest($this->request)->run() == true){	
					$this->Product_model->type_update($id);
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
			$data['editRow'] = $this->Product_model->list_type($id);
			$data['categoryGet'] = $this->Product_model->get_category();
			echo view('product/type-edit', $data);
		}
	}
	function type_delete($id){
		$this->Product_model->delete_type($id);
		return redirect()->to('product/list-type');
	}
}
