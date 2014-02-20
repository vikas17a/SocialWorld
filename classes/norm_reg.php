<?php

class regUser{

	function validate($email){
		if(!(filter_var($email, FILTER_VALIDATE_EMAIL))){
			return FALSE;
		}
		else{
			return TRUE;
		}
	}
	function validate_pwd($password){
		if(strlen($password)<6){
			return false;
		}
		else{
			return TRUE;
		}
	}
}
?>