<?php
	//Start session
	session_start();
	
	//Check whether the session variable SESS_MEMBER_ID is present or not
	if(!isset($_SESSION['ID']) || (trim($_SESSION['ID']) == '')) {
		header("location: ../");
		exit();
	}
?>