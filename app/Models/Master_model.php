<?php 

namespace App\Models;

use CodeIgniter\Model;

class Master_model extends Model{
	protected $db;
	protected $request;
	function __construct(){
		parent::__construct();
		$this->session = \Config\Services::session();
		$this->request = \Config\Services::request();
		$this->db = db_connect();
	}	
	/*****--Group--*****/	
	function type_insert(){
		$data=[
			'userID'=>$this->session->get('login_id'),
			'typeTitle'=>$this->request->getPost('title'),
			'typeCode'=>$this->request->getPost('code'),
			'typeDes'=>$this->request->getPost('msg'),
			'isPublish'=>1,
			'addedOn'=>addedOn()
		];
		$this->db->table('ci_type')->insert($data);
	}
	function list_type($id=null){
		if($id == null){
			$query = $this->db->table('ci_type AS t')
			->select('t.typeID, t.typeTitle, t.typeCode, u.userName')
			->join('ci_users AS u', 'u.userID=t.userID', 'INNER')
			->where('t.isDeleted', 0)
			->get();
			//echo $this->db->getLastQuery();
			if($query->getNumRows() > 0){
				return $query->getResultArray();	
			}
		}else{
			$query = $this->db->table('ci_type')->where(['typeID'=>$id, 'isDeleted'=>0])->get();
			if($query->getNumRows() > 0){
				return $query->getRowArray();	
			}
		}
	}
	function type_update($id){
		$data=[
			'userID'=>$this->session->get('login_id'),
			'typeTitle'=>$this->request->getPost('title'),
			'typeCode'=>$this->request->getPost('code'),
			'typeDes'=>$this->request->getPost('msg'),
			'isPublish'=>1,
			'updatedOn'=>addedOn()
		];
		$this->db->table('ci_type')->where(['typeID'=>$id, 'isDeleted'=>0])->update($data);
	}
	function delete_type($id){
		$this->db->table('ci_type')->where(['typeID'=>$id, 'isDeleted'=>0])->update([
			'userID'=>$this->session->get('login_id'),
			'isDeleted'=>1
		]);
	}
	/*****--general code--*****/
	function get_type(){
		$query = $this->db->table('ci_type')->select('typeID, typeTitle')
		->where(['isDeleted'=>0, 'isPublish'=>1])
		->get();
		if($query->getNumRows() > 0){
			return $query->getResultArray();	
		}
	}
	function check_general_code(){
		$countrows = $this->db->table('ci_general_code')
		->where([
			'typeID'=>$this->request->getPost('general'), 
			'generalCode'=>$this->request->getPost('code')
		])
		->countAllResults();
		return $countrows;
	}
	function general_insert(){
		$isPublish = $this->request->getPost('publish') ? $this->request->getPost('publish') : 0;
		$data=[
			'userID'=>$this->session->get('login_id'),
			'typeID'=>$this->request->getPost('general'),
			'generalCode'=>$this->request->getPost('code'),
			'generalTitle'=>$this->request->getPost('title'),
			'generalDes'=>$this->request->getPost('msg'),
			'order1'=>$this->request->getPost('order1'),
			'order2'=>$this->request->getPost('order2'),
			'isPublish'=>$isPublish,
			'addedOn'=>addedOn()
		];
		$this->db->table('ci_general_code')->insert($data);
	}
	function list_general($id=null){
		if($id == null){
			$query = $this->db->table('ci_general_code AS gc')
			->select('gc.codeID, gc.generalCode, gc.generalTitle, gc.order1, gc.order2, t.typeTitle, u.userName')
			->join('ci_type AS t', 't.typeID=gc.typeID', 'INNER')
			->join('ci_users AS u', 'u.userID=gc.userID', 'INNER')
			->where('gc.isDeleted', 0)
			->orderBy('t.typeTitle ASC, gc.order1 ASC, gc.order2 ASC, gc.generalCode')
			->get();
			//echo $this->db->getLastQuery();
			if($query->getNumRows() > 0){
				return $query->getResultArray();	
			}
		}else{
			$query = $this->db->table('ci_general_code')->where(['codeID'=>$id, 'isDeleted'=>0])->get();
			if($query->getNumRows() > 0){
				return $query->getRowArray();	
			}
		}
	}
	function general_update($id){
		$isPublish = $this->request->getPost('publish') ? $this->request->getPost('publish') : 0;
		$data=[
			'userID'=>$this->session->get('login_id'),
			'typeID'=>$this->request->getPost('general'),
			'generalCode'=>$this->request->getPost('code'),
			'generalTitle'=>$this->request->getPost('title'),
			'generalDes'=>$this->request->getPost('msg'),
			'order1'=>$this->request->getPost('order1'),
			'order2'=>$this->request->getPost('order2'),
			'isPublish'=>$isPublish,
			'updatedOn'=>addedOn()
		];
		$this->db->table('ci_general_code')->where(['codeID'=>$id, 'isDeleted'=>0])->update($data);
	}
	function delete_general($id){
		$this->db->table('ci_general_code')->where(['codeID'=>$id, 'isDeleted'=>0])->update([
			'userID'=>$this->session->get('login_id'),
			'isDeleted'=>1
		]);
	}
	/******---currency--******/
	function currency_insert(){
		//$isPublish = $this->request->getPost('publish') ? $this->request->getPost('publish') : 0;
		$data=[
			'currency_code'=>ltrimr($this->request->getPost('code')),
			'currency_name'=>ltrimr($this->request->getPost('title')),
			'decimal_name'=>ltrimr($this->request->getPost('deci')),
			'sort_order_1'=>ltrimr($this->request->getPost('order1')),
			'sort_order_2'=>ltrimr($this->request->getPost('order2')),
			'isPublish'=>1,
			'created_by'=>$this->session->get('login_id'),
			'created_on'=>addedOn()
		];
		$this->db->table('ci_currency')->insert($data);
	}
	function list_currency($id=null){
		if($id == null){
			$query = $this->db->table('ci_currency AS c')
			->select('c.currency_ID, c.currency_code, c.currency_name, c.decimal_name')
			->where('c.isDeleted', 0)
			->get();
			//echo $this->db->getLastQuery();
			if($query->getNumRows() > 0){
				return $query->getResultArray();	
			}
		}else{
			$query = $this->db->table('ci_currency AS c')
			->select('c.*, u.userName, u2.userName AS modifiby')
			->join('ci_users AS u', 'u.userID=c.created_by', 'INNER')
			->join('ci_users AS u2', 'u2.userID=c.modified_by', 'LEFT')
			->where(['c.currency_ID'=>$id, 'c.isDeleted'=>0])
			->get();
			if($query->getNumRows() > 0){
				return $query->getRowArray();	
			}
		}
	}
	function currency_update($id){
		//$isPublish = $this->request->getPost('publish') ? $this->request->getPost('publish') : 0;
		$data=[
			'currency_code'=>ltrimr($this->request->getPost('code')),
			'currency_name'=>ltrimr($this->request->getPost('title')),
			'decimal_name'=>ltrimr($this->request->getPost('deci')),
			'sort_order_1'=>ltrimr($this->request->getPost('order1')),
			'sort_order_2'=>ltrimr($this->request->getPost('order2')),
			'isPublish'=>1,
			'modified_by'=>$this->session->get('login_id'),
			'modified_on'=>addedOn()
		];
		$this->db->table('ci_currency')->where(['currency_ID'=>$id, 'isDeleted'=>0])->update($data);
	}
	function delete_currency($id){
		$this->db->table('ci_currency')->where(['currency_ID'=>$id, 'isDeleted'=>0])->update([
			'isDeleted'=>1,
			'modified_by'=>$this->session->get('login_id'),
			'modified_on'=>addedOn()
		]);
	}
	/******--company---******/
	function generalcode_select2($search, $id){
		$query = $this->db->table('ci_general_code AS gc')
		->select('gc.codeID, gc.typeID, gc.generalTitle')
		->where(['gc.typeID'=>$id, 'gc.isDeleted'=>0, 'gc.isPublish'=>1])
		->like('gc.generalTitle', $search, 'both')
		//->orLike('p.barCode', $search, 'after')
		->get();
		if($query->getNumRows() > 0){
			return $query->getResultArray();	
		}
	}
	function currency_select2($search){
		$query = $this->db->table('ci_currency AS c')
		->select('c.currency_ID, c.currency_name')
		->where(['c.isDeleted'=>0, 'c.isPublish'=>1])
		->like('c.currency_name', $search, 'both')
		//->orLike('p.barCode', $search, 'after')
		->get();
		if($query->getNumRows() > 0){
			return $query->getResultArray();	
		}
	}
	function attributes($id){
		$query = $this->db->table('ci_general_code AS gc')
		->select('gc.codeID, gc.typeID, gc.generalTitle')
		->where(['gc.typeID'=>$id, 'gc.isDeleted'=>0, 'gc.isPublish'=>1])
		->get();
		//echo $this->db->getLastQuery();
		if($query->getNumRows() > 0){
			return $query->getResultArray();	
		}
	}
	function get_currency(){
		$query = $this->db->table('ci_currency AS c')
		->select('c.currency_ID, c.currency_name')
		->where(['c.isDeleted'=>0, 'c.isPublish'=>1])
		->get();
		if($query->getNumRows() > 0){
			return $query->getResultArray();	
		}
	}
	function company_insert(){
		$cLogo = "";
		if ($this->request->getFile('logo')) {
			$file = $this->request->getFile('logo');	
			if ($file->isValid() && ! $file->hasMoved()) {
				$cLogo = $file->getRandomName();
				$file->move(ROOTPATH . 'public/uploads/company', $cLogo);	
			}
		}
		$isPublish = $this->request->getPost('publish') ? $this->request->getPost('publish') : 0;
		$data=[
			'currency_ID'=>$this->request->getPost('currency'),
			'company_name'=>ltrimr($this->request->getPost('company')),
			'reg_no'=>ltrimr($this->request->getPost('regno')),
			'ownership_ID'=>$this->request->getPost('owner'),
			'gst_no'=>ltrimr($this->request->getPost('gstno')),
			'vat_no'=>ltrimr($this->request->getPost('vatno')),
			'logo'=>$cLogo,
			'address_line_1'=>ltrimr($this->request->getPost('address1')),
			'address_line_2'=>ltrimr($this->request->getPost('address2')),
			'address_line_3'=>ltrimr($this->request->getPost('address3')),
			'city_village_district'=>ltrimr($this->request->getPost('city')),
			'state'=>ltrimr($this->request->getPost('state')),
			'country'=>ltrimr($this->request->getPost('country')),
			'pin_code'=>ltrimr($this->request->getPost('pin')),
			'telephone_1'=>ltrimr($this->request->getPost('phone1')),
			'telephone_2'=>ltrimr($this->request->getPost('phone2')),
			'email_1'=>ltrimr($this->request->getPost('email1')),
			'email_2'=>ltrimr($this->request->getPost('email2')),
			'isPublish'=>$isPublish,
			'created_by'=>$this->session->get('login_id'),
			'created_on'=>addedOn()
		];
		$this->db->table('ci_company')->insert($data);
		$companyID = $this->db->insertID();
		
		if(!empty($this->request->getPost('attrb'))){
			$data=[];
			foreach($this->request->getPost('attrb') as $k=>$val){
				if(!empty($val)){
					$codeID = $this->request->getPost('attrcode')[$k];
					$data[]=[
						'companyID'=>$companyID,
						'codeID'=>$codeID,
						'attribute_value'=>$val,
						'created_by'=>$this->session->get('login_id'),
						'created_on'=>addedOn()
					];	
				}
			}
			$this->db->table('ci_company_attribute')->insertBatch($data);
		}
	}
	function list_company($id=null){
		if($id == null){
			$query = $this->db->table('ci_company AS c')
			->select('c.company_ID, c.company_name, c.reg_no, c.telephone_1, c.email_1')
			->where('c.isDeleted', 0)
			->get();
			//echo $this->db->getLastQuery();
			if($query->getNumRows() > 0){
				return $query->getResultArray();	
			}
		}else{
			$query = $this->db->table('ci_company AS cy')
			->select('cy.*, u.userName, u2.userName AS modifiby')
			->join('ci_users AS u', 'u.userID=cy.created_by', 'INNER')
			->join('ci_users AS u2', 'u2.userID=cy.modified_by', 'LEFT')
			->where(['cy.company_ID'=>$id, 'cy.isDeleted'=>0])
			->get();
			if($query->getNumRows() > 0){
				return $query->getRowArray();	
			}
		}
	}
	function company_attributes($id){
		$query = $this->db->table('ci_company_attribute')->where('company_ID', $id)->get();
		if($query->getNumRows() > 0){
			return $query->getResultArray();	
		}
	}
	function company_update($id){
		$cLogo = "";
		if ($this->request->getFile('logo')) {
			$file = $this->request->getFile('logo');	
			if ($file->isValid() && ! $file->hasMoved()) {
				$cLogo = $file->getRandomName();
				$file->move(ROOTPATH . 'public/uploads/company', $cLogo);
				
				$this->db->table('ci_company')->where(['company_ID'=>$id, 'isDeleted'=>0])->update([
					'logo'=>$cLogo,
				]);	
			}
		}
		$isPublish = $this->request->getPost('publish') ? $this->request->getPost('publish') : 0;
		$data=[
			'currency_ID'=>$this->request->getPost('currency'),
			'company_name'=>ltrimr($this->request->getPost('company')),
			'reg_no'=>ltrimr($this->request->getPost('regno')),
			'ownership_ID'=>$this->request->getPost('owner'),
			'gst_no'=>ltrimr($this->request->getPost('gstno')),
			'vat_no'=>ltrimr($this->request->getPost('vatno')),
			'address_line_1'=>ltrimr($this->request->getPost('address1')),
			'address_line_2'=>ltrimr($this->request->getPost('address2')),
			'address_line_3'=>ltrimr($this->request->getPost('address3')),
			'city_village_district'=>ltrimr($this->request->getPost('city')),
			'state'=>ltrimr($this->request->getPost('state')),
			'country'=>ltrimr($this->request->getPost('country')),
			'pin_code'=>ltrimr($this->request->getPost('pin')),
			'telephone_1'=>ltrimr($this->request->getPost('phone1')),
			'telephone_2'=>ltrimr($this->request->getPost('phone2')),
			'email_1'=>ltrimr($this->request->getPost('email1')),
			'email_2'=>ltrimr($this->request->getPost('email2')),
			'isPublish'=>$isPublish,
			'modified_by'=>$this->session->get('login_id'),
			'modified_on'=>addedOn()
		];
		$this->db->table('ci_company')->where(['company_ID'=>$id, 'isDeleted'=>0])->update($data);
		$company_ID = $id;
		
		if(!empty($this->request->getPost('attrb'))){
			$data=[];
			foreach($this->request->getPost('attrb') as $k=>$val){
				if(!empty($val)){
					$codeID = $this->request->getPost('attrcode')[$k];
					$data[]=[
						'company_ID'=>$company_ID,
						'codeID'=>$codeID,
						'attribute_value'=>$val,
						'modified_by'=>$this->session->get('login_id'),
						'modified_on'=>addedOn()
					];	
				}
			}
			if(!empty($data)){
				$this->db->table('ci_company_attribute')->where('company_ID', $id)->delete();
				$this->db->table('ci_company_attribute')->insertBatch($data);	
			}
		}
	}
	function delete_company($id){
		$this->db->table('ci_company')->where(['company_ID'=>$id, 'isDeleted'=>0])->update([
			'modified_by'=>$this->session->get('login_id'),
			'modified_on'=>addedOn(),
			'isDeleted'=>1
		]);
	}
	/******---supplier--******/
	/* function delivery_attribute(){
		$query = $this->db->table('ci_general_code AS gc')
		->select('gc.codeID, gc.typeID, gc.generalTitle')
		->where(['gc.typeID'=>9, 'gc.isDeleted'=>0, 'gc.isPublish'=>1])
		->get();
		if($query->getNumRows() > 0){
			return $query->getResultArray();	
		}
	} */
	/* function credit_attribute(){
		$query = $this->db->table('ci_general_code AS gc')
		->select('gc.codeID, gc.typeID, gc.generalTitle')
		->where(['gc.typeID'=>10, 'gc.isDeleted'=>0, 'gc.isPublish'=>1])
		->get();
		if($query->getNumRows() > 0){
			return $query->getResultArray();	
		}
	} */
	function supplier_insert(){
		$active_status = $this->request->getPost('publish') ? $this->request->getPost('publish') : 0;
		$data=[
			'supplier_currency'=>$this->request->getPost('currency'),
			'supplier_code'=>ltrimr($this->request->getPost('code')),
			'supplier_name'=>ltrimr($this->request->getPost('sname')),
			'gst_no'=>ltrimr($this->request->getPost('gstno')),
			'address_line_1'=>ltrimr($this->request->getPost('address1')),
			'address_line_2'=>ltrimr($this->request->getPost('address2')),
			'address_line_3'=>ltrimr($this->request->getPost('address3')),
			'city_village_district'=>ltrimr($this->request->getPost('city')),
			'state'=>ltrimr($this->request->getPost('state')),
			'country'=>ltrimr($this->request->getPost('country')),
			'pin_code'=>ltrimr($this->request->getPost('pin')),
			'telephone_1'=>ltrimr($this->request->getPost('phone1')),
			'telephone_2'=>ltrimr($this->request->getPost('phone2')),
			'email_1'=>ltrimr($this->request->getPost('email1')),
			'email_2'=>ltrimr($this->request->getPost('email2')),
			'delivery_terms_ID'=>$this->request->getPost('terms'),
			'credit_terms_ID'=>$this->request->getPost('credit'),
			'active_status'=>$active_status,
			'created_by'=>$this->session->get('login_id'),
			'created_on'=>addedOn()
		];
		$this->db->table('ci_supplier')->insert($data);
		$supplier_ID = $this->db->insertID();
		
		if(!empty($this->request->getPost('attrb'))){
			$data=[];
			foreach($this->request->getPost('attrb') as $k=>$val){
				if(!empty($val)){
					$codeID = $this->request->getPost('attrcode')[$k];
					$data[]=[
						'supplier_ID'=>$supplier_ID,
						'codeID'=>$codeID,
						'attribute_value'=>$val,
						'created_by'=>$this->session->get('login_id'),
						'created_on'=>addedOn()
					];				
				}
			}
			$this->db->table('ci_supplier_attribute')->insertBatch($data);
		}
		
		$data=[];
		foreach($this->request->getPost('cname') as $k=>$val){
			$pos = $this->request->getPost('position')[$k];
			$email = $this->request->getPost('cemail')[$k];
			$phone = $this->request->getPost('cphone')[$k];
			$tele = $this->request->getPost('ctele')[$k];
			
			$pos = !empty($pos) ? $pos : '';
			$email = !empty($email) ? $email : '';
			$phone = !empty($phone) ? $phone : '';
			$tele = !empty($tele) ? $tele : '';
			
			if(!empty($val) || !empty($pos) || !empty($email) || !empty($phone) || !empty($tele)){
				$data[]=[
					'supplier_ID'=>$supplier_ID,
					'contactName'=>$val,
					'contactPos'=>$pos,
					'contactEmail'=>$email,
					'contactPhone'=>$phone,
					'contactTele'=>$tele,
				];	
			}
		}
		$this->db->table('ci_supplier_contact')->insertBatch($data);
	}
	function list_supplier($id=null){
		if($id == null){
			$query = $this->db->table('ci_supplier AS s')
			->select('s.supplier_ID, s.supplier_code, s.supplier_name, s.telephone_1, s.email_1, c.currency_name, u.userName, u.userName AS modifiby')
			->join('ci_users AS u', 'u.userID=s.created_by', 'INNER')
			->join('ci_currency AS c', 'c.currency_ID=s.supplier_currency', 'INNER')
			->join('ci_users AS u1', 'u1.userID=s.modified_by', 'LEFT')
			->where('s.isDeleted', 0)
			->get();
			//echo $this->db->getLastQuery();
			if($query->getNumRows() > 0){
				return $query->getResultArray();	
			}
		}else{
			$query = $this->db->table('ci_supplier AS s')
			->select('s.*, u.userName, u.userName AS modifiby')
			->join('ci_users AS u', 'u.userID=s.created_by', 'INNER')
			->join('ci_users AS u1', 'u1.userID=s.modified_by', 'LEFT')
			->where(['s.supplier_ID'=>$id, 's.isDeleted'=>0])->get();
			if($query->getNumRows() > 0){
				return $query->getRowArray();	
			}
		}
	}
	function supplier_contact($id){
		$query = $this->db->table('ci_supplier_contact')->where('supplier_ID', $id)->get();
		if($query->getNumRows() > 0){
			return $query->getResultArray();	
		}
	}
	function supplier_attributes($id){
		$query = $this->db->table('ci_supplier_attribute')->where('supplier_ID', $id)->get();
		if($query->getNumRows() > 0){
			return $query->getResultArray();	
		}
	}
	function supplier_update($id){
		$active_status = $this->request->getPost('publish') ? $this->request->getPost('publish') : 0;
		$data=[
			'supplier_currency'=>ltrimr($this->request->getPost('currency')),
			'supplier_code'=>ltrimr($this->request->getPost('code')),
			'supplier_name'=>ltrimr($this->request->getPost('sname')),
			'gst_no'=>ltrimr($this->request->getPost('gstno')),
			'address_line_1'=>ltrimr($this->request->getPost('address1')),
			'address_line_2'=>ltrimr($this->request->getPost('address2')),
			'address_line_3'=>ltrimr($this->request->getPost('address3')),
			'city_village_district'=>ltrimr($this->request->getPost('city')),
			'state'=>ltrimr($this->request->getPost('state')),
			'country'=>ltrimr($this->request->getPost('country')),
			'pin_code'=>ltrimr($this->request->getPost('pin')),
			'telephone_1'=>ltrimr($this->request->getPost('phone1')),
			'telephone_2'=>ltrimr($this->request->getPost('phone2')),
			'email_1'=>ltrimr($this->request->getPost('email1')),
			'email_2'=>ltrimr($this->request->getPost('email2')),
			'delivery_terms_ID'=>$this->request->getPost('terms'),
			'credit_terms_ID'=>$this->request->getPost('credit'),
			'active_status'=>$active_status,
			'modified_by'=>$this->session->get('login_id'),
			'modified_on'=>addedOn()
		];
		$this->db->table('ci_supplier')->where(['supplier_ID'=>$id, 'isDeleted'=>0])->update($data);
		$supplier_ID = $id;
		
		if(!empty($this->request->getPost('attrb'))){
			$data=[];
			foreach($this->request->getPost('attrb') as $k=>$val){
				if(!empty($val)){
					$codeID = $this->request->getPost('attrcode')[$k];
					$data[]=[
						'supplier_ID'=>$supplier_ID,
						'codeID'=>$codeID,
						'attribute_value'=>$val,
						'modified_by'=>$this->session->get('login_id'),
						'modified_on'=>addedOn()
					];				
				}
			}
			if(!empty($data)){
				$this->db->table('ci_supplier_attribute')->where('supplier_ID', $id)->delete();
				$this->db->table('ci_supplier_attribute')->insertBatch($data);	
			}
		}
		
		$data=[];
		foreach($this->request->getPost('cname') as $k=>$val){
			$pos = $this->request->getPost('position')[$k];
			$email = $this->request->getPost('cemail')[$k];
			$phone = $this->request->getPost('cphone')[$k];
			$tele = $this->request->getPost('ctele')[$k];
			
			$pos = !empty($pos) ? $pos : '';
			$email = !empty($email) ? $email : '';
			$phone = !empty($phone) ? $phone : '';
			$tele = !empty($tele) ? $tele : '';
			
			if(!empty($val) || !empty($pos) || !empty($email) || !empty($phone) || !empty($tele)){
				$data[]=[
					'supplier_ID'=>$supplier_ID,
					'contactName'=>$val,
					'contactPos'=>$pos,
					'contactEmail'=>$email,
					'contactPhone'=>$phone,
					'contactTele'=>$tele,
				];	
			}
		}
		$this->db->table('ci_supplier_contact')->where('supplier_ID', $id)->delete();
		$this->db->table('ci_supplier_contact')->insertBatch($data);
	}
	function delete_supplier($id){
		$this->db->table('ci_supplier')->where(['supplier_ID'=>$id, 'isDeleted'=>0])->update([
			'modified_by'=>$this->session->get('login_id'),
			'modified_on'=>addedOn(),
			'isDeleted'=>1
		]);
	}
	/******--customer---******/
	/* function payment_attribute(){
		$query = $this->db->table('ci_general_code AS gc')
		->select('gc.codeID, gc.typeID, gc.generalTitle')
		->where(['gc.typeID'=>3, 'gc.isDeleted'=>0, 'gc.isPublish'=>1])
		->get();
		if($query->getNumRows() > 0){
			return $query->getResultArray();	
		}
	} */
	function customer_insert(){
		$active_status = $this->request->getPost('publish') ? $this->request->getPost('publish') : 0;
		$data=[
			'customer_code'=>ltrimr($this->request->getPost('code')),
			'customer_name'=>ltrimr($this->request->getPost('sname')),
			'address_line_1'=>ltrimr($this->request->getPost('address1')),
			'address_line_2'=>ltrimr($this->request->getPost('address2')),
			'address_line_3'=>ltrimr($this->request->getPost('address3')),
			'city_village_district'=>ltrimr($this->request->getPost('city')),
			'state'=>ltrimr($this->request->getPost('state')),
			'country'=>ltrimr($this->request->getPost('country')),
			'pin_code'=>ltrimr($this->request->getPost('pin')),
			'telephone_1'=>ltrimr($this->request->getPost('phone1')),
			'telephone_2'=>ltrimr($this->request->getPost('phone2')),
			'email_1'=>ltrimr($this->request->getPost('email1')),
			'email_2'=>ltrimr($this->request->getPost('email2')),
			'payment_terms_ID'=>$this->request->getPost('terms'),
			'fixed_discount_percentage'=>$this->request->getPost('fixed'),
			'gst_no'=>ltrimr($this->request->getPost('gstno')),
			'vat_no'=>ltrimr($this->request->getPost('vatno')),
			//'agent_ID'=>$this->request->getPost('agent'),
			'sort_order_1'=>$this->request->getPost('order1'),
			'sort_order_2'=>$this->request->getPost('order2'),
			'created_by'=>$this->session->get('login_id'),
			'created_on'=>addedOn(),
			'active_status'=>$active_status,
		];
		$this->db->table('ci_customer')->insert($data);
		$customer_ID = $this->db->insertID();
		
		if(!empty($this->request->getPost('attrb'))){
			$data=[];
			foreach($this->request->getPost('attrb') as $k=>$val){
				if(!empty($val)){
					$codeID = $this->request->getPost('attrcode')[$k];
					$data[]=[
						'customer_ID'=>$customer_ID,
						'codeID'=>$codeID,
						'attribute_value'=>$val,
						'created_by'=>$this->session->get('login_id'),
						'created_on'=>addedOn()
					];	
				}
			}
			$this->db->table('ci_customer_attribute')->insertBatch($data);
		}
		
		$data=[];
		foreach($this->request->getPost('cname') as $k=>$val){
			$pos = $this->request->getPost('position')[$k];
			$email = $this->request->getPost('cemail')[$k];
			$phone = $this->request->getPost('cphone')[$k];
			$tele = $this->request->getPost('ctele')[$k];
			
			$pos = !empty($pos) ? $pos : '';
			$email = !empty($email) ? $email : '';
			$phone = !empty($phone) ? $phone : '';
			$tele = !empty($tele) ? $tele : '';
			
			if(!empty($val) || !empty($pos) || !empty($email) || !empty($phone) || !empty($tele)){
				$data[]=[
					'customer_ID'=>$customer_ID,
					'contactName'=>$val,
					'designation'=>$pos,
					'email'=>$email,
					'mobile'=>$phone,
					'telephone'=>$tele,
				];	
			}
		}
		$this->db->table('ci_customer_contact')->insertBatch($data);
	}
	function list_customer($id=null){
		if($id == null){
			$query = $this->db->table('ci_customer AS c')
			->select('c.customer_ID, c.customer_code, c.customer_name, c.telephone_1, c.email_1, u.userName, u.userName AS modifiby')
			->join('ci_users AS u', 'u.userID=c.created_by', 'INNER')
			->join('ci_users AS u1', 'u1.userID=c.modified_by', 'LEFT')
			->where('c.isDeleted', 0)
			->get();
			//echo $this->db->getLastQuery();
			if($query->getNumRows() > 0){
				return $query->getResultArray();	
			}
		}else{
			$query = $this->db->table('ci_customer AS c')
			->select('c.*, u.userName, u.userName AS modifiby')
			->join('ci_users AS u', 'u.userID=c.created_by', 'INNER')
			->join('ci_users AS u1', 'u1.userID=c.modified_by', 'LEFT')
			->where(['c.customer_ID'=>$id, 'c.isDeleted'=>0])
			->get();
			if($query->getNumRows() > 0){
				return $query->getRowArray();	
			}
		}
	}
	function customer_attributes($id){
		$query = $this->db->table('ci_customer_attribute')->where('customer_ID', $id)->get();
		if($query->getNumRows() > 0){
			return $query->getResultArray();	
		}
	}
	function customer_contact($id){
		$query = $this->db->table('ci_customer_contact')->where('customer_ID', $id)->get();
		if($query->getNumRows() > 0){
			return $query->getResultArray();	
		}
	}
	function customer_update($id){
		$active_status = $this->request->getPost('publish') ? $this->request->getPost('publish') : 0;
		$data=[
			'customer_code'=>ltrimr($this->request->getPost('code')),
			'customer_name'=>ltrimr($this->request->getPost('sname')),
			'address_line_1'=>ltrimr($this->request->getPost('address1')),
			'address_line_2'=>ltrimr($this->request->getPost('address2')),
			'address_line_3'=>ltrimr($this->request->getPost('address3')),
			'city_village_district'=>ltrimr($this->request->getPost('city')),
			'state'=>ltrimr($this->request->getPost('state')),
			'country'=>ltrimr($this->request->getPost('country')),
			'pin_code'=>ltrimr($this->request->getPost('pin')),
			'telephone_1'=>ltrimr($this->request->getPost('phone1')),
			'telephone_2'=>ltrimr($this->request->getPost('phone2')),
			'email_1'=>ltrimr($this->request->getPost('email1')),
			'email_2'=>ltrimr($this->request->getPost('email2')),
			'payment_terms_ID'=>$this->request->getPost('terms'),
			'fixed_discount_percentage'=>$this->request->getPost('fixed'),
			'gst_no'=>ltrimr($this->request->getPost('gstno')),
			'vat_no'=>ltrimr($this->request->getPost('vatno')),
			//'agent_ID'=>$this->request->getPost('agent'),
			'sort_order_1'=>$this->request->getPost('order1'),
			'sort_order_2'=>$this->request->getPost('order2'),
			'modified_by'=>$this->session->get('login_id'),
			'modified_on'=>addedOn(),
			'active_status'=>$active_status,
		];
		$this->db->table('ci_customer')->where(['customer_ID'=>$id, 'isDeleted'=>0])->update($data);
		$customer_ID = $id;
		
		if(!empty($this->request->getPost('attrb'))){
			$data=[];
			foreach($this->request->getPost('attrb') as $k=>$val){
				if(!empty($val)){
					$codeID = $this->request->getPost('attrcode')[$k];
					$data[]=[
						'customer_ID'=>$customer_ID,
						'codeID'=>$codeID,
						'attribute_value'=>$val,
						'modified_by'=>$this->session->get('login_id'),
						'modified_on'=>addedOn()
					];	
				}
			}
			if(!empty($data)){
				$this->db->table('ci_customer_attribute')->where(['customer_ID', $id])->delete();
				$this->db->table('ci_customer_attribute')->insertBatch($data);	
			}
		}
		
		$data=[];
		foreach($this->request->getPost('cname') as $k=>$val){
			$pos = $this->request->getPost('position')[$k];
			$email = $this->request->getPost('cemail')[$k];
			$phone = $this->request->getPost('cphone')[$k];
			$tele = $this->request->getPost('ctele')[$k];
			
			$pos = !empty($pos) ? $pos : '';
			$email = !empty($email) ? $email : '';
			$phone = !empty($phone) ? $phone : '';
			$tele = !empty($tele) ? $tele : '';
			
			if(!empty($val) || !empty($pos) || !empty($email) || !empty($phone) || !empty($tele)){
				$data[]=[
					'customer_ID'=>$customer_ID,
					'contactName'=>$val,
					'designation'=>$pos,
					'email'=>$email,
					'mobile'=>$phone,
					'telephone'=>$tele,
				];	
			}
		}
		$this->db->table('ci_customer_contact')->where('customer_ID', $id)->delete();
		$this->db->table('ci_customer_contact')->insertBatch($data);
	}
	/******---size set--******/
	function size_general_code($id){
		$query = $this->db->table('ci_general_code')->where(['typeID'=>$id, 'isDeleted'=>0])->get();
		if($query->getNumRows() > 0){
			return $query->getResultArray();	
		}
	}
	function sizeset_insert(){
		$data=[
			'size_set_name'=>ltrimr($this->request->getPost('sizeset')),
			'created_by'=>$this->session->get('login_id'),
			'created_on'=>addedOn(),
		];
		$this->db->table('ci_size_set')->insert($data);
		$size_set_ID = $this->db->insertID();
		
		if(!empty($this->request->getPost('multisize'))){
			$data=[];
			foreach($this->request->getPost('multisize') as $val){
				if(!empty($val)){
					$data[]=[
						'size_set_ID'=>$size_set_ID,
						'size_ID'=>$val,
					];	
				}
			}
			$this->db->table('ci_size_set_sizes')->insertBatch($data);
		}
	}
	function list_sizeset($id=null){
		if($id == null){
			$query = $this->db->table('ci_size_set AS s')
			->select('s.size_set_ID, s.size_set_name, u.userName')
			->join('ci_users AS u', 'u.userID=s.created_by', 'INNER')
			->where('s.isDeleted', 0)
			->get();
			//echo $this->db->getLastQuery();
			if($query->getNumRows() > 0){
				return $query->getResultArray();	
			}
		}else{
			$query = $this->db->table('ci_size_set AS st')
			->select('st.*, u.userName, u2.userName AS modifiby')
			->join('ci_users AS u', 'u.userID=st.created_by', 'INNER')
			->join('ci_users AS u2', 'u2.userID=st.modified_by', 'LEFT')
			->where(['st.size_set_ID'=>$id, 'st.isDeleted'=>0])
			->get();
			if($query->getNumRows() > 0){
				return $query->getRowArray();	
			}
		}
	}
	function sizeset_code($id){
		$query = $this->db->table('ci_size_set_sizes')->where('size_set_ID', $id)->get();
		if($query->getNumRows() > 0){
			return $query->getResultArray();	
		}
	}
	function sizeset_update($id){
		$data=[
			'size_set_name'=>ltrimr($this->request->getPost('sizeset')),
			'modified_by'=>$this->session->get('login_id'),
			'modified_on'=>addedOn(),
		];
		$this->db->table('ci_size_set')->where(['size_set_ID'=>$id, 'isDeleted'=>0])->update($data);
		$size_set_ID = $id;
		
		if(!empty($this->request->getPost('multisize'))){
			$data=[];
			foreach($this->request->getPost('multisize') as $val){
				if(!empty($val)){
					$data[]=[
						'size_set_ID'=>$size_set_ID,
						'size_ID'=>$val,
					];	
				}
			}
			$this->db->table('ci_size_set_sizes')->where('size_set_ID', $id)->delete();
			$this->db->table('ci_size_set_sizes')->insertBatch($data);
		}
	}
	function delete_sizeset($id){
		$this->db->table('ci_size_set')->where(['size_set_ID'=>$id, 'isDeleted'=>0])->update([
			'modified_by'=>$this->session->get('login_id'),
			'modified_on'=>addedOn(),
			'isDeleted'=>1
		]);
	}
} 
?>