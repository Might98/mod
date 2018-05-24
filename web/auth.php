<?php


/*
	Слив by Relevant-Craft.SU

	=========================

	СТАНЬ ХАКЕРОМ
	В ОДИН КЛИК!
*/


////   O'MineGuard [v1.6] by Konstantin773////
define('INCLUDE_CHECK',true);
include("connect.php");
list($key,$data) = explode("::", $_GET['data']);
///расшифровываем данные///
list($login, $authkey, $client) = explode("::", decrypt($data,$key));
if(!file_exists("clients/".$client)) die("Клиент не существует!");
if (!ctype_digit($login) or !ctype_digit($authkey) or strlen($authkey)!=32) die ("Неверные данные!");  	
$row = $db->select("SELECT * FROM $db_auth WHERE $column_id='$login'") or die("Ключ авторизации недействителен!");
if(count($row)==0) die("Ключ авторизации недействителен!");
if($row[0][$column_SesId]!=$authkey) die("Ключ авторизации недействителен!");
///шифруем сессию///
$sessi = gsd();
$version = getVersion($client);
$os = $row[0][$column_os];
$hashes = strtolower(check('clients/'.$client).authParsing($version,$os).addfile("launcher.jar"));
$gashes = explode(",", $hashes);
sort($gashes);
$salt = kep(md5(implode("",$gashes).$sessi));
$temp = time()+$stime;
$time = time();
$db->update("UPDATE $db_auth SET $column_salt='$salt', $column_Time='$temp', lastserver='$client', lasttime='$time' WHERE $column_id = '$login'");
$dlticket = md5($login);
die("$sessi");	
	///Функции///
	function getVersion($client){
	   global $prefs;
	   $arr = $prefs['servers'];
	   for($i=0;$i<count($arr);$i++){
	          $serv = explode(",",$arr[$i]);
			  if($client==$serv[3]) return $serv[4];
	   }
	   return "";
	}
	function gsd()
	{
		srand(time());
		$randNum = rand(100, 999).rand(100, 999).rand(1000, 9999).rand(10000, 99999).rand(10000, 99999).rand(10000, 99999).rand(10000, 99999).rand(10,99);
		return $randNum;
	}
	///Определение ОС
	function os($os){
		if($os==0) return "linux";
		if($os==1) return "solaris";
		if($os==2) return "windows";
		if($os==3) return "osx";
		return "null";
	}
	function authParsing($version,$oss){
		global $db;
		list($os,$vers,$arch,$java) = explode(",",$oss);
		$os = os($os);
		$sel = $db->select("SELECT * from k773_libraries where version='$version' and ((allowed='0' and disallowed='0') or (allowed='$os' and disallowed='0') or (allowed='0' and disallowed!='$os') or (allowed='0' and disallowed!='$os')) and (native='0') and (arch='0' or arch='$arch')");
		$count = count($sel);
		$result="";
		if($count>0){
			$result.= putfile("clients/versions/".$version."/".$version.".jar");
			for($i=0;$i<$count;$i++){
				$allow = true;
				if($allow){
					$result.=$sel[$i]['md5'].$sel[$i]['size'].",";
				}
			}
		} else {}
		return $result;
	}
	function putfile($file){
		if(file_exists($file)) return md5_file($file).filesize($file).","; else return "";
	}
	function addfile($file){
		if(file_exists($file)) return md5_file($file).filesize($file).","; else return "";
	}
	function startsWith($haystack, $needle){
		return $needle === "" || strpos($haystack, $needle) === 0;
	}
	function check($folder){
		$fp = scandir($folder);		
		for($i=0; $i < sizeof($fp); $i++)
		{ 
		if(is_file($folder."/".$fp[$i]) && substr($fp[$i], -4) != ".sha" && (substr($fp[$i], -4) == ".zip" || substr($fp[$i], -4) == ".jar" || substr($fp[$i], -4) == ".dll" || substr($fp[$i], -3) == ".so" || substr($fp[$i], -8) == ".litemod" || substr($fp[$i], -7) == ".jnilib")) {
            
		$files.=addfile($folder."/".$fp[$i]);
        }elseif($fp[$i]!="." && $fp[$i]!=".." && is_dir($folder."/".$fp[$i]) && $fp[$i]!="texturepacks" && $fp[$i]!="resourcepacks"){$files.=check($folder."/".$fp[$i]);}
		}
		return str_replace(' ','%20',$files);
	}
	function kep($text)
	{
		$res = "";
		for ($i = 0; $i < strlen($text); $i++) $res .= arr(arr(ord($text{$i})));
		$res = substr($res, 0);
		return $res;
	}
	function arr($text)
	{ $s = array_sum(str_split($text));
	  return $s;}
	function code($hex){
		$string='';
		for ($i=0; $i < strlen($hex)-1; $i+=2){
			$string .= chr(hexdec($hex[$i].$hex[$i+1]));
		}
		return $string;
	}
	function decrypt($sStr, $sKey) {
		$decrypted= mcrypt_decrypt(MCRYPT_RIJNDAEL_128,$sKey, code($sStr), MCRYPT_MODE_ECB);
		$dec_s = strlen($decrypted); 
		$padding = ord($decrypted[$dec_s-1]); 
		$decrypted = substr($decrypted, 0, -$padding);
		return $decrypted;
	}
?>