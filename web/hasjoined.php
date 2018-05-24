<?php
	define('INCLUDE_CHECK',true);
	include ("connect.php");
	$user = $_GET['username'];
	$serverid = $_GET['serverId'];
	///$db->insert("INSERT INTO `cheaters` (id,name,data) VALUES  (NULL,'$user','$serverid')");
	$bad = array('error' => "Bad login",'errorMessage' => "Bad login");
	if(!preg_match("/^[a-zA-Z0-9_-]+$/", $user) || !preg_match("/^[a-zA-Z0-9_-]+$/", $serverid)) exit(json_encode($bad));
	if($serverid=='no') die('NO');
	$time = time();
	$svid = md5(md5(md5($serverid)));
	$result = $db->select("Select * From $db_auth Where $column_login='$user' And $column_Server='$serverid' And $column_Time > $time");
	if(count($result) == 1) {
		$db->update("UPDATE $db_auth set $column_Server='no',$column_Time='1' where $column_Server='$serverid' And $column_login='$user'");
		$time = time();
        $base64 = '{"timestamp":"'.$time.'","profileId":"'.md5($user).'","profileName":"'.$user.'","isPublic":true,"textures":{"SKIN":{"url":"http://'.$skinpath.'/'.$user.'.png"}}}';
         echo '{"id":"'.md5($user).'","name":"'.$user.'","properties":[{"name":"textures","value":"'.base64_encode($base64).'","signature":""}]}';
	}
	else {exit(json_encode($bad));}
?>