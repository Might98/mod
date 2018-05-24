<?php

/*
	Слив by Relevant-Craft.SU

	=========================

	СТАНЬ ХАКЕРОМ
	В ОДИН КЛИК!
*/

	///генерация 32х-значной сессии///
	function gsd()
	{
		srand(time());
		$randNum = rand(10000000000000, 99999999999999).rand(10000000000000000, 99999999999999999).rand(0,9);
		return $randNum;
	}
	
	///преобразование из hex в строку///
	function h2s($hex){
		$string='';
		for ($i=0; $i < strlen($hex)-1; $i+=2){
			$string .= chr(hexdec($hex[$i].$hex[$i+1])-4);
		}
		return $string;
	}
	///преобразование из строки в hex///
	function s2h($string){
		$str = urlencode($string);
		$hex='';
		for ($i=0; $i < strlen($str); $i++){$hex .= dechex(ord($str[$i])+4);}
		return strtolower($hex);
	}
	///проверка принадлежности строки началу другой строки///
	function startsWith($haystack, $needle){
		return $needle === "" || strpos($haystack, $needle) === 0;
	}
	///проверка принадлежности строки концу другой строки///
	function endsWith($haystack, $needle){
		return $needle === "" || substr($haystack, -strlen($needle)) === $needle;
	}
	///удаление запрещенных символов из строки///
	function clear($s1){
	    return str_replace(array("'",'"','\\','<','>','$','%','/','.'),'',$s1);
	}
	///удаление запрещенных символов из строки///
	function clear2($s1){
	    return str_replace(array("'",'"','\\','<','>','%'),'',$s1);
	}
	///загрузка клиентской защиты///
	function protect(){
	    global $class,$classname,$method;
		$f = file_get_contents($class);
		$as = explode(",",st($f));
		$at = $as;
		$nd = array();
		for ($a = 0; $a < count($as); $a++) {
			$nd[$at[$a]] = $nd[$at[$a]].$a.",";
		}
		$pd = "";
		ksort($nd);
		foreach ($nd as $key => $value){
			$pd .= $key.":".$value.";";
		}
		die($pd);
	}
	function st($text){
		$res = "";
		for ($i = 0; $i < strlen($text); $i++) {
		if(ord($text{$i})>127) $res .= "-".(256-ord($text{$i})).","; else $res .= ord($text{$i}) . ",";}
		$res = substr($res, 0, -1);
		return $res;
	}
	///шифрование строки по ключу///
	function encrypt($input, $key) {
		$size = mcrypt_get_block_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_ECB); 
		$input = pkcs5_pad($input, $size); 
		$td = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', MCRYPT_MODE_ECB, ''); 
		$iv = mcrypt_create_iv (mcrypt_enc_get_iv_size($td), MCRYPT_RAND); 
		mcrypt_generic_init($td, $key, $iv); 
		$data = mcrypt_generic($td, $input); 
		mcrypt_generic_deinit($td); 
		mcrypt_module_close($td); 
		$data = base64_encode($data); 
		return $data; 
	} 

	function pkcs5_pad ($text, $blocksize) { 
		$pad = $blocksize - (strlen($text) % $blocksize); 
		return $text . str_repeat(chr($pad), $pad); 
	} 
	///дешифрование строки по ключу///
	function decrypt($sStr, $sKey) {
		$decrypted= mcrypt_decrypt(
			MCRYPT_RIJNDAEL_128,
			$sKey, 
			base64_decode($sStr), 
			MCRYPT_MODE_ECB
		);
		$dec_s = strlen($decrypted); 
		$padding = ord($decrypted[$dec_s-1]); 
		$decrypted = substr($decrypted, 0, -$padding);
		return $decrypted;
	}
?>