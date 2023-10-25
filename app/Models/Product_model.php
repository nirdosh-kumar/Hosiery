<?php 

namespace App\Models;

use CodeIgniter\Model;

class Product_model extends Model{
	protected $db;
	protected $request;
	function __construct(){
		parent::__construct();
		$this->session = \Config\Services::session();
		$this->request = \Config\Services::request();
		$this->db = \Config\Database::connect();
	}
	function category_insert(){
		$active_status = $this->request->getPost('publish') ? $this->request->getPost('publish') : 0;
		$data=[
			'product_category_code'=>ltrimr($this->request->getPost('code')),
			'product_category_name'=>ltrimr($this->request->getPost('catname')),
			'sort_order_1'=>ltrimr($this->request->getPost('order1')),
			'sort_order_2'=>ltrimr($this->request->getPost('order2')),
			'created_by'=>$this->session->get('login_id'),
			'created_on'=>addedOn(),
			'active_status'=>$active_status,
		];
		$this->db->table('ci_product_category')->insert($data);
	}
	function list_category($id=null){
		if($id == null){
			$query = $this->db->table('ci_product_category AS pc')
			->select('pc.product_category_ID, pc.product_category_code , pc.product_category_name, u.userName')
			->join('ci_users AS u', 'u.userID=pc.created_by', 'INNER')
			->where('pc.isDeleted', 0)
			->get();
			//echo $this->db->getLastQuery();
			if($query->getNumRows() > 0){
				return $query->getResultArray();	
			}
		}else{
			$query = $this->db->table('ci_product_category')->where(['product_category_ID'=>$id, 'isDeleted'=>0])->get();
			if($query->getNumRows() > 0){
				return $query->getRowArray();	
			}
		}
	}
	function category_update($id){
		$active_status = $this->request->getPost('publish') ? $this->request->getPost('publish') : 0;
		$data=[
			'product_category_code'=>ltrimr($this->request->getPost('code')),
			'product_category_name'=>ltrimr($this->request->getPost('catname')),
			'sort_order_1'=>ltrimr($this->request->getPost('order1')),
			'sort_order_2'=>ltrimr($this->request->getPost('order2')),
			'modified_by'=>$this->session->get('login_id'),
			'modified_on'=>addedOn(),
			'active_status'=>$active_status,
		];
		$this->db->table('ci_product_category')->where(['product_category_ID'=>$id, 'isDeleted'=>0])->update($data);
	}
	function delete_category($id){
		$this->db->table('ci_product_category')->where(['product_category_ID'=>$id, 'isDeleted'=>0])->update([
			'modified_by'=>$this->session->get('login_id'),
			'modified_on'=>addedOn(),
			'isDeleted'=>1
		]);
	}
	/******---product type--******/
	function get_category(){
		$query = $this->db->table('ci_product_category AS pc')
		->select('pc.product_category_ID , pc.product_category_name')
		->where(['pc.active_status'=>1, 'pc.isDeleted'=>0])
		->get();
		//echo $this->db->getLastQuery();
		if($query->getNumRows() > 0){
			return $query->getResultArray();	
		}
	}
	function type_insert(){
		$active_status = $this->request->getPost('publish') ? $this->request->getPost('publish') : 0;
		$data=[
			'product_category_ID'=>$this->request->getPost('typecat'),
			'product_type_code'=>ltrimr($this->request->getPost('code')),
			'product_type_name'=>ltrimr($this->request->getPost('typename')),
			'sort_order_1'=>$this->request->getPost('order1'),
			'sort_order_2'=>$this->request->getPost('order2'),
			'created_by'=>$this->session->get('login_id'),
			'created_on'=>addedOn(),
			'active_status'=>$active_status,
		];
		$this->db->table('ci_product_type')->insert($data);
	}
	function list_type($id=null){
		if($id == null){
			$query = $this->db->table('ci_product_type AS pt')
			->select('pt.product_type_ID, pt.product_type_code, pt.product_type_name, pc.product_category_name, u.userName')
			->join('ci_product_category AS pc', 'pc.product_category_ID=pt.product_category_ID', 'INNER')
			->join('ci_users AS u', 'u.userID=pt.created_by', 'INNER')
			->where('pt.isDeleted', 0)
			->get();
			//echo $this->db->getLastQuery();
			if($query->getNumRows() > 0){
				return $query->getResultArray();	
			}
		}else{
			$query = $this->db->table('ci_product_type')->where(['product_type_ID'=>$id, 'isDeleted'=>0])->get();
			if($query->getNumRows() > 0){
				return $query->getRowArray();	
			}
		}
	}
	function type_update($id){
		$active_status = $this->request->getPost('publish') ? $this->request->getPost('publish') : 0;
		$data=[
			'product_category_ID'=>$this->request->getPost('typecat'),
			'product_type_code'=>ltrimr($this->request->getPost('code')),
			'product_type_name'=>ltrimr($this->request->getPost('typename')),
			'sort_order_1'=>$this->request->getPost('order1'),
			'sort_order_2'=>$this->request->getPost('order2'),
			'modified_by'=>$this->session->get('login_id'),
			'modified_on'=>addedOn(),
			'active_status'=>$active_status,
		];
		$this->db->table('ci_product_type')->where(['product_type_ID'=>$id, 'isDeleted'=>0])->update($data);
	}
	function delete_type($id){
		$this->db->table('ci_product_type')->where(['product_type_ID'=>$id, 'isDeleted'=>0])->update([
			'modified_by'=>$this->session->get('login_id'),
			'modified_on'=>addedOn(),
			'isDeleted'=>1
		]);
	}
} 
?>