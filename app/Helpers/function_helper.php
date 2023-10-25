<?php 
use CodeIgniter\I18n\Time;
use App\Models\Userlogin_model;
use App\Models\User_model;

if( ! function_exists('addedOn')){
	function addedOn(){
		$dateTime = new Time('now', 'Asia/Kolkata', 'en_IN');
		return $dateTime;
	}
}
if( ! function_exists('_p')){
	function _p($arr, $die=null){
		if($die == 1){
			echo("<pre>".print_r($arr,true)."</pre>");
			exit();
		}else{
			echo("<pre>".print_r($arr,true)."</pre></br>");
		}	
	}
}
if( ! function_exists('segments_array')){
	function segments_array($url){
		$uri = new \CodeIgniter\HTTP\URI($url);
		$segmentArr = $uri->getSegments();
		return $segmentArr;
	}
}
if( ! function_exists('filter_clean')){
	function filter_clean($str){
		$newtitle = str_replace(' ', '_', $str);
		$newtitle = str_replace('.', '', $newtitle);
		$newtitle = str_replace('(', '', $newtitle);
		$newtitle = str_replace(')', '', $newtitle);
		$newtitle = str_replace('/', '', $newtitle);
		$newtitle = strtolower($newtitle);
		return $newtitle;
	}
}
if( ! function_exists('user_right')){
	function user_right($str){
		$model = new Userlogin_model();
		$result = $model->check_right($str);
		return $result;
	}
}
if( ! function_exists('cleantxt')){
	function cleantxt($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
}
if( ! function_exists('cleanslug')){
	function cleanslug($str){
		$str = preg_replace('/[^a-zA-Z0-9-. ]+/', '', $str);
		$str = str_replace(" ", "-", $str);
		$str = str_replace("'", "", $str);
		$str = str_replace("--", "-", $str);
		return strtolower($str);
	}
}
if( ! function_exists('user_info')){
	function user_info($id){
		$model = new User_model();
		$result = $model->user_logged($id);
		return $result;
	}
}
if( ! function_exists('cleanurl')){
	function cleanurl(string $str){
		$str = preg_replace('/[^a-zA-Z0-9-. ]+/', '', $str);
		$str = str_replace(" ", "-", $str);
		$str = str_replace("'", "", $str);
		$str = str_replace("--", "-", $str);
		return strtolower($str);
	}
}
if( ! function_exists('ltrimr')){
	function ltrimr($str){
		$str=ltrim($str);
		$str=rtrim($str);
		return $str;
	}
}
if( ! function_exists('sort_length')){
	function sort_length(){
		return 4;
	}
}
if( ! function_exists('sort_value')){
	function sort_value(){
		return 9999;
	}
}
if( ! function_exists('spl_alpha')){
	function spl_alpha(){
		return 'a-zA-Z0-9 &,.#(\/)-';
	}
}
if( ! function_exists('spl_num')){
	function spl_num(){
		return '0-9 -';
	}
}
?>