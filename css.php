<?php
error_reporting(0);
require_once('./inc/coon.php');
require_once('./inc/function.php');ob_clean();
$cachefile=get_css();
if(is_file($cachefile)){
	header("Content-type: text/css; charset=utf-8");
	$shuchuneirong=file_get_contents($cachefile);
	echo $shuchuneirong;
	exit;
}

$nr=get_content($url);

$encode = mb_detect_encoding($nr, array("ASCII","UTF-8","GB2312","GBK","BIG5")); 
if($encode!=="UTF-8"){
$nr=iconv('GB2312','utf-8//IGNORE',$nr);
}
header("Content-type: text/css; charset=utf-8");
$nr= str_replace(top_domain($mubiao),$djym, $nr);
write($cachefile,$nr);
echo $nr;
exit;
?>