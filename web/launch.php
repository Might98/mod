<?php

/*
	Слив by Relevant-Craft.SU

	=========================

	СТАНЬ ХАКЕРОМ
	В ОДИН КЛИК!
*/

	define('INCLUDE_CHECK',true);
	include("connect.php");
	include("fileutils.php");
	include("utils.php");
	if(isset($_GET['errs'])){
		$arr=explode("<>",$_GET['errs']);
		$login = clear($arr[0]);$pass = clear($arr[1]);
		if(!in_array($login,$debmode)) die("Неа");
		$row = $db->select("SELECT $column_User,$column_Pass FROM $db_table WHERE $column_User='$login'");
		if(count($row)==0) die('Неверный логин или пароль');
		$realPass = $row[0][$column_Pass];
		$user = $row[0][$column_User];
		$checkPass = md5(md5($pass));
		if(!strcmp($realPass,$checkPass) == 0 || !$realPass) {
		   if($brute_check) {$time1=time()+$brute_time;$db->insert("INSERT INTO $brute_table (hwid,time) VALUES ('$hwid','$time1')");}
		   die("Неверный логин или пароль!");
		}
		updateLibs();
	}
	if(isset($_GET['rata'])){
		echo updateLibs();
	}
	if(count($_GET)==0) prefs();
	if(count($_GET)!=1) die('NO');
	///вызовы функций///
	if(isset($_GET['data'])){login($_GET['data']);}
	if(isset($_GET['assets'])){echo loadAssetList(clear2($_GET['assets']));}
	if(isset($_GET['vata'])){protect();}
	if(isset($_GET['assetload'])){download($_GET['assetload']);exit();}
	if(isset($_GET['monitor'])){monitor($_GET['monitor']);}
	if(isset($_GET['ver'])){if($_GET['ver']!=md("launcher.jar")) die("NO"); else die("YES");}
	
	///Функции///
	function login($s1){
		global $db,$debmode,$brute_check,$brute_table,$ip,$ac,$db_table,$column_User,$column_Pass,$column_HWID,$column_HWID2,$column_Priv,$crypt,$brute_time,$bancheck,$db_auth,$column_login,$column_os,$column_arch,$column_SesId,$column_salt,$column_id,$prefs;
		///Разбор и проверка массива данных///
		if (!preg_match("/^[a-zA-Z0-9_-]+$/", $s1)) die('Неверный аргумент!');
		$arr=explode("<>",h2s($s1));
		///if(count($arr)!=4) die('Неверное число аргументов');
		$login 		= 	clear($arr[0]);
		$postPass	=	$arr[1];
		$client 	= 	clear($arr[2]);
		$os	= 	clear2(h2s($arr[3]));
		$hwid	= 	clear($arr[4]);
		if(count($arr)==6) $changes	= 	clear2($arr[5]);
		if(strlen($login)<3 or strlen($login)>16) die('Неверная длина логина! Допустимо от 3 до 16 символов');
		if(strlen($postPass)<3 or strlen($postPass)>40 or strlen($hwid)!=32) die("Неверная длина пароля! Допустимо от 3 до 40 символов");
		if (!preg_match("/^[a-zA-Z0-9_-]+$/", $login) or !preg_match("/^[a-zA-Z0-9_-]+$/", $hwid) or !ctype_digit($client)) die('Обнаружены запрещенные сиволы!');
		if(ctype_digit($login)) die('Ники из цифр запрещены!');
		if(strlen($client)==1) {$ar = explode(",",$prefs['servers'][$client]);$client = $ar[3];$version = $ar[4];}
		if (!file_exists("clients/".$client)) die("Клиент не существует!");
		if($brute_check) brute($hwid);
		///проверка HWID на наличие в таблице банов///
		$q2 = $db->select("SELECT * from $db_auth where $column_HWID='$hwid' AND banned='1'");
		if(count($q2)>0){die("Ваш ПК забанен! HWID: ".$hwid);}
		$lg = strtolower($login);
		if($bancheck){
			$tmm = time();
			$q = $db->select("SELECT * from banlist where name='$lg' and type=0 and (temptime=0 or temptime>$tmm)");
			if(count($q)!=0){die("Ваш аккаунт забанен модератором: ".$q[0]['admin'].". Причина: ".$q[0]['reason']);}
		}
		///Авторизация игрока///
		$row = $db->select("SELECT $column_User,$column_Pass FROM $db_table WHERE $column_User='$login'");
		if(count($row)==0) die('Неверный логин или пароль');
		$realPass = $row[0][$column_Pass];
		$user = $row[0][$column_User];///выдаем игроку логин из таблицы///
		$checkPass = md5(md5($postPass));
		if(!strcmp($realPass,$checkPass) == 0 || !$realPass) {
		   if($brute_check) {$time1=time()+$brute_time;$db->insert("INSERT INTO $brute_table (hwid,time) VALUES ('$hwid','$time1')");}
		   die("Неверный логин или пароль!");
		}
		///Ключ клиентской авторизации///
		$ses = gsd();
		///Исключение///
		///Получаем данные игрока из таблицы///
		$qu = $db->select("SELECT * from $db_auth where $column_login='$login'");
		///Если данные есть - обновляем ключ авторизации, иначе создаем строку данных игрока
		if(count($qu)==1) $db->update("UPDATE $db_auth set $column_SesId='$ses',$column_HWID2='$hwid',$column_os='$os',$column_salt='enter' where $column_login='$login'"); else {
			if($hwid=='5bc8b3c903b946f2a5931f4fcdf84f34' || $hwid=='9ba31d46f02abc923a0bacaafa0b1381') $hwid = 'abc';
			$q = $db->select("SELECT * from $db_auth where $column_HWID='$hwid'");
			if(count($q)>=$ac && $hwid!='abc') {$db->insert("INSERT INTO errors (id,login,hwid) VALUES(NULL,'$login','$hwid')"); die('Исчерпан лимит аккаунтов для вашего ПК!');}
			$db->insert("INSERT INTO $db_auth (id,$column_login,$column_os,$column_SesId,$column_HWID,$column_salt) VALUES  (NULL,'$login','$os','$ses','$hwid','first')");
			$qu = $db->select("SELECT * from $db_auth where $column_login='$login'");
		}
		$id = $qu[0][$column_id];
		if(isset($changes)) $db->insert("INSERT INTO `cheaters` (id,name,data) VALUES  (NULL,'$login','$changes')");
		///Привязка к железу///
		if($qu[0][$column_Priv]==1 and $hwid!=$qu[0][$column_HWID]) die('Аккаунт привязан по железу!');
		die(s2h("$user<:>$ses<:>$id<:>".jsonArgs($version)."<br>".check("clients/natives").parsing($version,$os).check("clients/".$client)));
	}
	function parsing($version,$oss){
		global $db;
		list($os,$vers,$arch,$java) = explode(",",$oss);
		$os = os($os);
		$sel = $db->select("SELECT * from k773_libraries where version='$version' and ((allowed='0' and disallowed='0') or (allowed='$os' and disallowed='0') or (allowed='0' and disallowed!='$os') or (allowed='0' and disallowed!='$os')) and (native='0' or native='$os') and (arch='0' or arch='$arch')");
		$count = count($sel);
		$result="";
		//if($version='1.6.4' and $os='osx') return check("clients/natives").check("clients/libs");
		if($count>0){
			/////////////////
			if(startsWith($version,'1.6') || startsWith('1.6',$version)) $result.=addfile("clients/assets.pkg");
			/////////////////
			$result.=check("clients/assets/virtual");
			$result.=addfile("clients/versions/".$version."/".$version.".jar");
			$result.=addfile("clients/assets/indexes/legacy.json");
			$result.=addfile("clients/assets/indexes/".$version.".json");
			for($i=0;$i<$count;$i++){
				$allow = true;
				if($allow){
					if($sel[$i]['native']=='0') $result.="libraries/".$sel[$i]['name'].":>".$sel[$i]['md5'].":>".$sel[$i]['size']."<:>";
					else if($sel[$i]['native']==$os) $result.="libraries/".$sel[$i]['name'].":>".$sel[$i]['md5'].":>".$sel[$i]['size'].":>NATIVE<:>";
				}
			}
		} else {}
		return $result;
	}
	///Массив новостей///
	function news(){
		global $db,$cnews;
		if(!$cnews) return 'no';
		$result = $db->select("SELECT * FROM `dle_post` ORDER BY `id` DESC LIMIT 6");
		$news = '';
		for($i = 0, $size = count($result); $i < $size; ++$i){
		$title =  iconv("utf-8", "windows-1251",strip_tags($result[$i]['date'])); 
		$full_story =  iconv("utf-8", "windows-1251",$result[$i]['title']);
		$news.=$title.':>'.$full_story.'<:>';
		}
		$news = str_replace("\\","",$news);
		
		return $news;
	}
	///Массив списка игроков///
	function players(){
		global $db,$prefs,$cplayers,$cache;
		$time = time();
		$q = $db->select("SELECT * from cachepl where type='list' and time>$time");
		if(count($q)==1) {return $q[0]['list'];}
		else{
		require 'lib/MinecraftQuery.class.php';
		$siz = count($prefs['servers']);
		$result = "";
		for($i=0;$i<$siz;$i++){
			if(!$cplayers) $result.="no"; else{
			$res = "";
			$data =  explode(',',$prefs['servers'][$i]);
			$ind = $i+1;
			$Query = new MinecraftQuery( );
			try{
				$Query->Connect( $data[1], $data[2] );
				if(($Players = $Query->GetPlayers()) !== false ) {
				foreach( $Players as $Player ){$res .= htmlspecialchars( $Player ).',';}
				}			
			}catch( MinecraftQueryException $e ){ $res .= 'no';}
			if($res=="") $res = "no";
			}
			$result.= $res.":";
		}
		$time1 = $time+$cache;
		$db->update("UPDATE cachepl set list='$result',time='$time1' where type='list'");
		return $result;
		}
	}
	///Мониторинг сервера///
	function monitor($i){
		global $db,$prefs,$cplayers,$cache;
		$time = time();
		$q = $db->select("SELECT * from cachepl where type='status' and time>$time");
		if(count($q)==1) {$n = explode(",",$q[0]['list']); die($n[$i]);}
		else{
		require 'lib/MinecraftQuery.class.php';
		$res = "";
		for($a = 0, $size = count($prefs['servers']); $a < $size; ++$a) {
		$Query = new MinecraftQuery( );
		try{
		    $data =  explode(',',$prefs['servers'][$a]);
			$Query->Connect( $data[1], $data[2] );
			if(($inf = $Query->GetInfo()) !== false ) {
				 $res.= $inf['Players'].'/'.$inf['MaxPlayers'];
			} else {$res.= 'Откл';}		
			}catch( MinecraftQueryException $e ){ $res .= '';}
			$res.=",";
		}
		$time1 = $time+$cache;
		$db->update("UPDATE cachepl set list='$res',time='$time1' where type='status'");
		$n = explode(",",$res);die($n[$i]);
		}
	}
	///Проверка на брут
	function brute($hwid){
		global $db,$brute_time;
		$time = time();
		$q0 = $db->delete("DELETE from brute where time < $time");
		$q1 = $db->select("SELECT time from brute where hwid='$hwid'");
		if(count($q1)!=0) {$f1 = $q1[0]['time']-$time;die("Защита от подбора паролей! Подождите $f1 секунд!");}
	}
	//Массив настроек///
	function prefs(){
		global $prefs,$design;
		$s1 = "";
		foreach ($prefs as $key => $value){
		    $s1.=s2h($key)."=>";
			foreach ($value as $subkey => $subvalue){
		      $s1.=s2h($subkey)."=".s2h($subvalue).":";
			}
			$s1.="==";			
		}
		foreach ($design as $key => $value){
		    $s1.=s2h($key)."=>";
			foreach ($value as $subkey => $subvalue){
		      $s1.=s2h($subkey)."=".s2h($subvalue).":";
			}
			$s1.="==";			
		}
		$s1.=s2h('news').'=>'.s2h('0').'='.s2h(news()).':==';
		$s1.=s2h('players').'=>'.s2h('0').'='.s2h(players()).':==';
		die($s1);
	}
?>
