<?php 

namespace App\Models;

use CodeIgniter\Model;

class Home_model extends Model{
	protected $db;
	protected $request;
	function __construct(){
		parent::__construct();
		$this->session = \Config\Services::session();
		$this->request = \Config\Services::request();
		$this->db = \Config\Database::connect();
	}
} 
?>