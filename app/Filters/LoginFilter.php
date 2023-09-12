<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use App\Models\Userlogin_model;

class LoginFilter implements FilterInterface
{
	public function __construct(){
		$this->Userlogin_model = new Userlogin_model();
	}
    public function before(RequestInterface $request, $arguments = null)
    {
		helper('function');
		$segment = '';
		$uriArr = segments_array(current_url(true));
		$segmentArr = [
			0=>$uriArr[0],
			1=>$uriArr[1],
			2=>!empty($uriArr[2]) ? $uriArr[2] : '',
			3=>!empty($uriArr[3]) ? $uriArr[3] : '',
		];
		if(array_key_exists(2, $segmentArr) == true & array_key_exists(3, $segmentArr) == true){
			$segment = $segmentArr[2].'/'.$segmentArr[3];
		}else{
			$segment = $segmentArr[2];
		}
		
        if(session()->has('login_id')){
			$checkrow = $this->Userlogin_model->check_login();
			if($checkrow == false){
				return redirect()->to(base_url().'/login');
			}
			if(!empty($segment) & $segment !== 'dashboard'){
				$rightrow = $this->Userlogin_model->check_right($segment);
				if($rightrow == false){
					return redirect()->to(base_url().'/dashboard');
				}	
			}
		}else{
			return redirect()->to(base_url().'login');
		}
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
?>
