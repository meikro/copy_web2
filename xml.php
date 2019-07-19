<?php
error_reporting(0);
require_once('./inc/coon.php');
require_once('./inc/function.php');
ob_clean();
$cachefile=get_xml();
if(is_file($cachefile)){
	header("Content-Type:text/xml");
	$shuchuneirong=file_get_contents($cachefile);
	echo $shuchuneirong;
	exit;
}
$nr=get_content($url);

$encode = mb_detect_encoding($nr, array("ASCII","UTF-8","GB2312","GBK","BIG5")); 
if($encode!=="UTF-8"){
$nr=iconv('gbk','utf-8//IGNORE',$nr);
}
$nr= str_replace(top_domain($mubiao),$djym, $nr);
$nr= str_replace($tihuanci,$beitihuanci, $nr);
header("Content-Type:text/xml");
write($cachefile,$nr);
echo $nr;
exit;
?>