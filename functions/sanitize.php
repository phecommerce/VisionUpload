<?php
function escape($string) {
    return htmlentities($string, ENT_QUOTES, 'UTF-8');
}

function checkString($string) {
	$msg = "";
	if (empty($string)){
		$msg .="- Error: String must not be empty";
	}
	
	if (strlen($string)<2) {
        $msg .="- Error: String must be more than 2 characters";
    }
   
    if (!preg_match("/^[a-z]$/", $string)) {
        $msg .="- Error: String must contain alphabetic characters only";
    }
      //Other tests here
	
	if (empty($msg)){
		$msg = "Valid string";
	}
	return $msg;
}
