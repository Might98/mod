<?php

/*
	���� by Relevant-Craft.SU

	=========================

	����� �������
	� ���� ����!
*/

	define('INCLUDE_CHECK',true);
	include("connect.php");
	list($user, $data) = explode("::", $_GET['data']);
	if(!ctype_digit($user)) die("�������� ������!");
	///������� ���������� �����///
	$d1 = $db->select("SELECT * from $db_auth where $column_id='$user'");
	if(count($d1)!=1) die("�������� ������!");
	if($d1[0][$column_Time] < $time) die("����� ����� ����� �������!");
	///�������������� ������///
	list($salt, $serverid) = explode("::", decrypt($data,substr($d1[0][$column_salt],0,16)));
	$time = time();
	///��������� ������ �� ������������ ����������///
	if(empty($salt) || !ctype_digit($salt) || strlen($salt) != 32 ||  $d1[0][$column_salt]!=$salt || empty($serverid) || strlen($user) > 16 || !preg_match("/^[a-zA-Z0-9_-]+$/", $user) || !preg_match("/^[a-zA-Z0-9_-]+$/", $serverid))
	{
		$db->insert("INSERT INTO errors (id,login,hwid) VALUES(NULL,'$user','fail')");
		file_put_contents('bad.log', $user.",".$salt.",".$d1[0][$column_salt]."\n", FILE_APPEND);
		die ("��������� �������, ������������� ���!");
	}
	echo "ok";
	///������ ������ ���������� �� ���� �������(������ �������� ��)///
	$temp = $time+$stime;
	$db->update("Update $db_auth SET $column_Server='$serverid', $column_salt='no', $column_Time='$temp' Where $column_salt='$salt' And $column_id='$user'");
	///�������///
	function code($hex){
		$string='';
		for ($i=0; $i < strlen($hex)-1; $i+=2){
			$string .= chr(hexdec($hex[$i].$hex[$i+1]));
		}
		return $string;
	}
	function clear($s1){
	    return str_replace(array("'",'"','\\','<','>','$','%','/','.'),'',$s1);
	}
	function decrypt($sStr, $sKey) {
		$decrypted= mcrypt_decrypt(MCRYPT_RIJNDAEL_128,$sKey, code($sStr), MCRYPT_MODE_ECB);
		$dec_s = strlen($decrypted); 
		$padding = ord($decrypted[$dec_s-1]); 
		$decrypted = substr($decrypted, 0, -$padding);
		return $decrypted;
	}
?>