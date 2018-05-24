<?php
define('INCLUDE_CHECK',true);
include 'connect.php';
///if($u==1) $class = "a.class";
$f = file_get_contents("var.class");
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
echo sh($pd."<:>".$classname."<:>".$method);
function sh($string){
    $hex='';
    for ($i=0; $i < strlen($string); $i++){
        $hex .= dechex(ord($string[$i]));
    }
    return $hex;
}
function hs($hex){
	$string='';
	for ($i=0; $i < strlen($hex)-1; $i+=2){
		$string .= chr(hexdec($hex[$i].$hex[$i+1]));
	}
	return $string;
}
function st($text){
	$res = "";
	for ($i = 0; $i < strlen($text); $i++) {
	if(ord($text{$i})>127) $res .= "-".(256-ord($text{$i})).","; else $res .= ord($text{$i}) . ",";}
	$res = substr($res, 0, -1);
	return $res;
}
?>