<?php 
namespace App\Validations;

class CustomRules {
	function gst_check (string $str, string &$error = null) : bool {
		/* if(!preg_match("/^(0[1-9]|[1-2][0-9]|3[0-5])([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}([a-zA-Z0-9]){1}([a-zA-Z]){1}([0-9]){1}?$/", $str)) {
			 return false;
		} else{
            return true;
        } */
		return true;
	}
}
?>