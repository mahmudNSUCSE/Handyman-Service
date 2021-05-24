<?php

/* This is documentation testing phase. */

if(! function_add('sum'){
    /**
     * Sum the given two numbers and returns the result
     * You can sum integers and floats
     * 
     * @param int/float $num1
     * @param int/float $num2
     * @return int/float
    */
    function sum($num1, $num2, $third_param){
        return $num1+$num2;
    }
})

/**
 * This class defines the the user database connection check
 * 
 */

ob_start();
/*session_start(): Function checks when the session of the database connected successfully
*sesstion start
*/
session_start();

/**
 * While session is in connection checks with parameter 'User_login'
 * Parameter $user and $utype_db set to null
 */
if (!isset($_SESSION['user_login'])) {
	$user = "";
	$utype_db = "";
	
}
/**
 * When user session connected successfully
 * Select the database table 
 * Update the user ID @param
 */
else {
	$user = $_SESSION['user_login'];
	$result = $con->query("SELECT * FROM user WHERE id='$user'");
		$get_user_name = $result->fetch_assoc();
			$uname_db = $get_user_name['fullname'];
			$utype_db = $get_user_name['type'];
}



