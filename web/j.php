<?php
	define('INCLUDE_CHECK',true);
	include ("connect.php");	  
	@$user = $_GET['user'];
	$bad = array('error' => "Bad login",'errorMessage' => "Bad login1");
	if (!preg_match("/^[a-zA-Z0-9_-]+$/", $user)){
			exit(json_encode($bad));
	}
	$ok = array('id' => md5($user), 'name' => $user);
	echo json_encode($ok);
?>