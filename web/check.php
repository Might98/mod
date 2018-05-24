<?php

/*
	Слив by Relevant-Craft.SU

	=========================

	СТАНЬ ХАКЕРОМ
	В ОДИН КЛИК!
*/

	define('INCLUDE_CHECK',true);
	include ("connect.php");
	$user = $_GET['user'];
	$serverid = $_GET['serverId'];
	if(!preg_match("/^[a-zA-Z0-9_-]+$/", $user) || !preg_match("/^[a-zA-Z0-9_-]+$/", $serverid)) die("NO");
	if($serverid=='no') die('NO');
	$time = time();
	$svid = md5(md5(md5($serverid)));
	$result = $db->select("Select * From $db_auth Where $column_login='$user' And $column_Server='$serverid' And $column_Time > $time");
	if(count($result) == 1) {echo "YES";$db->update("UPDATE $db_auth set $column_Server='no',$column_Time='1' where $column_Server='$serverid' And $column_login='$user'");}
	else {echo "NO";}
?>