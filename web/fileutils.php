<?php

/*
	Слив by Relevant-Craft.SU

	=========================

	СТАНЬ ХАКЕРОМ
	В ОДИН КЛИК!
*/

	///Загрузка ресурса с сервера Mojang
	function download($file){
		list($s1,$s2) = explode("/",$file);
		if(strlen($s1)!=2 || strlen($s2)!=40 || !preg_match("/^[a-zA-Z0-9]+$/", $s1) || !preg_match("/^[a-zA-Z0-9]+$/", $s2)) die("NO");
		$url = "clients/assets_cache/objects/".$file;
		if(file_exists($url)){
			if (ob_get_level()) {ob_end_clean();}
			readfile($url);
			exit();
		} else {
			die("NO");
		}
	}
	/*
	function download($file){
		$url = "http://resources.download.minecraft.net/".$file;
		if (ob_get_level()) {ob_end_clean();}
		$content = file_get_contents($url);
		echo $content;
	}
	*/
	function loadAssetList($version){
		$result = "";
		$result.=makeAss("legacy").makeAss($version);
		return $result;
	}
	///Формирование списка ресурсов по версии игры
	function makeAss($version){
		global $db;
		$time = time();
		if($version=='0') return "";
		if(!preg_match("/^[a-zA-Z0-9.]+$/", $version)) return "";
		$file = "clients/assets_cache/".$version.".txt";
		if(!file_exists($file)) return "";
		return file_get_contents("clients/assets_cache/".$version.".txt");
	}
	///Определение ОС
	function os($os){
		if($os==0) return "linux";
		if($os==1) return "solaris";
		if($os==2) return "windows";
		if($os==3) return "osx";
		return "null";
	}
	///Обновление недостающих библиотек (только для админа)
	function updateLibs(){
		global $db;
		$db->delete("TRUNCATE TABLE k773_libraries");
		$fp=opendir("clients/versions/");
		$i=0;
		while($file=readdir($fp)) {
			if(file_exists("clients/versions/".$file."/".$file.".json")){
				$fil = "clients/versions/".$file."/".$file.".json";
				$data = file_get_contents($fil);
				$json_a=json_decode($data,true);
				$array = $json_a['libraries'];
				foreach($array as $key => $value){
					if(isset($value['natives'])){
						foreach($value['natives'] as $ke => $va){
							$arr = explode(":",$value['name']);
							$allowed = "0";
							$disallowed = "0";
							$allowed_ver = "0";
							$disallowed_ver = "0";
							if(isset($value['rules'])){
								$ar = $value['rules'];
								foreach($ar as $k => $v){
									if(isset($v['os']) && $v['action']=='allow'){
										$allowed = $v['os']['name'];
										if(isset($v['os']['version'])) $allowed_ver=str_replace(array("\\","d$","^"),array("","?",""),$v['os']['version']);
									}
									if(isset($v['os']) && $v['action']=='disallow'){
										$disallowed = $v['os']['name'];
										if(isset($v['os']['version'])) $disallowed_ver=str_replace(array("\\","d$","^"),array("","?",""),$v['os']['version']);
									}
								}
							}
							$name = str_replace(".","/",$arr[0])."/".$arr[1]."/".$arr[2]."/".$arr[1]."-".$arr[2]."-".$va.".jar";
							if (strpos($name,'${arch}') !== false) {
								$name1 = str_replace('${arch}','32',$name);
								$name2 = str_replace('${arch}','64',$name);
								if(file_exists("clients/libraries/".$name1)){
									$md5 = md5_file("clients/libraries/".$name1);
									$size = filesize("clients/libraries/".$name1);
									$i++;
									$db->insert("INSERT INTO `k773_libraries`(`id`, `name`, `md5`, `size`, `version`, `allowed`, `disallowed`,`native`,`arch`) VALUES (NULL,'$name1','$md5','$size','$file','$allowed','$disallowed','$ke',32)");
								} else {
									echo "libraries/".$name1.":>0:>1";
								}
								if(file_exists("clients/libraries/".$name2)){
									$md5 = md5_file("clients/libraries/".$name2);
									$size = filesize("clients/libraries/".$name2);
									$i++;
									$db->insert("INSERT INTO `k773_libraries`(`id`, `name`, `md5`, `size`, `version`, `allowed`, `disallowed`,`native`,`arch`) VALUES (NULL,'$name2','$md5','$size','$file','$allowed','$disallowed','$ke',64)");
								} else {
									echo "libraries/".$name2.":>0:>1";
								}
							} else {
								if(file_exists("clients/libraries/".$name)){
									$md5 = md5_file("clients/libraries/".$name);
									$size = filesize("clients/libraries/".$name);
									$i++;
									$db->insert("INSERT INTO `k773_libraries`(`id`, `name`, `md5`, `size`, `version`, `allowed`, `disallowed`,`native`) VALUES (NULL,'$name','$md5','$size','$file','$allowed','$disallowed','$ke')");
								} else {
									echo "libraries/".$name.":>0:>1";
								}
							}
						}
					} else {
						$arr = explode(":",$value['name']);
						$name = str_replace(".","/",$arr[0])."/".$arr[1]."/".$arr[2]."/".$arr[1]."-".$arr[2].".jar";
						$allowed = "0";
						$disallowed = "0";
						$allowed_ver = "0";
						$disallowed_ver = "0";
						if(isset($value['rules'])){
							$ar = $value['rules'];
							foreach($ar as $k => $v){
								if(isset($v['os']) && $v['action']=='allow'){
									$allowed = $v['os']['name'];
									if(isset($v['os']['version'])) $allowed_ver=str_replace(array("\\","d$","^"),array("","?",""),$v['os']['version']);
								}
								if(isset($v['os']) && $v['action']=='disallow'){
									$disallowed = $v['os']['name'];
									if(isset($v['os']['version'])) $disallowed_ver=str_replace(array("\\","d$","^"),array("","?",""),$v['os']['version']);
								}
							}
						}
						if(file_exists("clients/libraries/".$name)){
									$md5 = md5_file("clients/libraries/".$name);
									$size = filesize("clients/libraries/".$name);
									$i++;
									$db->insert("INSERT INTO `k773_libraries`(`id`, `name`, `md5`, `size`, `version`, `allowed`, `disallowed`,`native`) VALUES (NULL,'$name','$md5','$size','$file','$allowed','$disallowed','0')");
						} else {
									echo "libraries/".$name.":>0:>1";
						}
					}
				}
			}
		}
		echo $i." files loaded";
	}
	///Парсинг списка загружаемых библиотек///
	function jsonParsing($version,$os,$arch){
		$file = "clients/versions/".$version."/".$version.".json";
		if(!file_exists($file)) return check("clients/natives");	
		$data = file_get_contents($file);
		$json_a=json_decode($data,true);
		$array = $json_a['libraries'];
		$result = "";
		$result.=addfile("clients/versions/".$version."/".$version.".jar");
		$result.=addfile("clients/assets/indexes/legacy.json");
		$result.=addfile("clients/assets/indexes/".$version.".json");
		$result.=check("clients/natives");
		$nedost = "";
		foreach($array as $key => $value){
			$allow = true;
			if(isset($value['rules'])){
				$ar = $value['rules'];
				foreach($ar as $k => $v){
					if(isset($v['os']) && $v['action']=='allow'){
						if($os!=$v['os']['name']){
							$allow = false;
						}
					}
					if(isset($v['os']) && $v['action']=='disallow'){
						if($os==$v['os']['name']){
							$allow = false;
						}
					}
				}
			}
			if($allow){
				$arr = explode(":",$value['name']);
				$f = "clients/libraries/".str_replace(".","/",$arr[0])."/".$arr[1]."/".$arr[2]."/".$arr[1]."-".$arr[2].".jar";
				if(isset($value['natives'])){
						if(isset($value['natives'][$os])){
						 $f = "clients/libraries/".str_replace(".","/",$arr[0])."/".$arr[1]."/".$arr[2]."/".$arr[1]."-".$arr[2]."-".str_replace('${arch}',$arch,$value['natives'][$os]).".jar";
						}
				}
				if(file_exists($f)){
					if(isset($value['natives'])){
						$result.= addfile($f);
					} else{
						$result.= addfile($f);
					}
				} else {
					$nedost.=str_replace("clients/libraries/","",$f).":>0:>1<:>";
				}
			}
		}
		if($nedost!="") {
			echo($nedost);return "";
		}
	    $result.=check("clients/assets/virtual");
		return $result;
	}
	///Парсинг списка загружаемых библиотек///
	function authParsing($version,$os,$arch){
		$file = "clients/versions/".$version."/".$version.".json";
		if(!file_exists($file)) return "";
		$data = file_get_contents($file);
		$json_a=json_decode($data,true);
		$array = $json_a['libraries'];
		$result = "";
		foreach($array as $key => $value){
			$allow = true;
			if(isset($value['rules'])){
				$ar = $value['rules'];
				foreach($ar as $k => $v){
					if(isset($v['os']) && $v['action']=='allow'){
						if($os!=$v['os']['name']){
							$allow = false;
						}
					}
					if(isset($v['os']) && $v['action']=='disallow'){
						if($os==$v['os']['name']){
							$allow = false;
						}
					}
				}
			}
			if($allow){
				$arr = explode(":",$value['name']);
				$f = "clients/libraries/".str_replace(".","/",$arr[0])."/".$arr[1]."/".$arr[2]."/".$arr[1]."-".$arr[2].".jar";
				if(isset($value['natives'])){
						if(isset($value['natives'][$os])){
						 $f = "clients/libraries/".str_replace(".","/",$arr[0])."/".$arr[1]."/".$arr[2]."/".$arr[1]."-".$arr[2]."-".str_replace('${arch}',$arch,$value['natives'][$os]).".jar";
						}
				}
				if(file_exists($f)){
						$result.= putfile($f);
				}
			}
		}
		return $result;
	}
	function putfile($file){
		if(file_exists($file)) return md5_file($file).filesize($file).","; else return "";
	}
	function getVersion($client){
	   global $prefs;
	   $arr = $prefs['servers'];
	   for($i=0;$i<count($arr);$i++){
	          $serv = explode(",",$arr[$i]);
			  if($client==$serv[3]) return $serv[4];
	   }
	   return "";
	}
	///Парсинг аргументов по версии игры///
	function jsonArgs($version){
		$file = "clients/versions/".$version."/".$version.".json";
		if(!file_exists($file)) return "0<:>0";
		$data = file_get_contents($file);
		$json_a=json_decode($data,true);
		$assets = "0";
		if(isset($json_a['assets'])) $assets = $json_a['assets'];
		$result =  $json_a['mainClass']."<:>".$assets;	
		return $result;
	}
	///MD5 файла без FileNotFoundExcaption///
	function md($s1){
		if(file_exists($s1)) return md5_file($s1); else return "0";
	}
	///Сбор массива файлов///
	function check($folder){
		global $form,$client;$fp=opendir($folder);
		while($file=readdir($fp)) {
        if(is_file($folder."/".$file) && !endsWith($file,".sha")) {
			$files.=addfile($folder."/".$file);
        }elseif($file!="." && $file!=".." && is_dir($folder."/".$file)){$files.=check($folder."/".$file);}
		}
		closedir($fp);
		return str_replace(' ','%20',$files);
	}
	///Сбор данных о файле///
	function addfile($s1){
		global $client;
		if(!file_exists($s1)) return "";
		$name = "/".str_replace('clients/','',$s1);
		$md5 = md5_file($s1);
		$size = filesize($s1);
		return $name.":>".$md5.":>".$size."<:>";
	}
	///Сбор данных о файле///
	function addfile2($s1){
		global $client;
		if(!file_exists($s1)) return "";
		$name = "/".str_replace('clients/','',$s1);
		$md5 = md5_file($s1);
		$size = filesize($s1);
		return $name.":>".$md5.":>".$size.":>NATIVE<:>";
	}
?>