<?php
error_reporting(0);
require_once('./inc/coon.php');
require_once('./inc/function.php');
ob_clean();
$cachefile=get_js();
if(is_file($cachefile)){
header('Content-type: application/x-javascript; charset=utf-8');
	$shuchuneirong=file_get_contents($cachefile);
	echo $shuchuneirong;
	exit;
}
$nr=get_content($url);
$encode = mb_detect_encoding($nr, array("ASCII","UTF-8","GB2312","GBK","BIG5")); 
if($encode!=="UTF-8"){
$nr=iconv('gbk','utf-8//IGNORE',$nr);
}
$nr= preg_replace("@hm.baidu.com(.*?)('|\")@is","hm.baidu.com$1ar'", $nr);
$nr= str_replace("cnzz.com","cnzz.co", $nr);
$nr= str_replace('users.51.la','user.51.la', $nr);
header('Content-type: application/x-javascript; charset=utf-8');
$nr= str_replace(top_domain($mubiao),$djym, $nr);
$yuan=array('/iPhone/i','/ipod/i','/android/i','/ios/i','/phone/i','/webos/i','/mobile/i','/ucweb/i','/midp/i','/windows ce/i','/window.location.href/i','/ipad/i');
$hou=array('iphones','ipods','androids','ioses','phones','weboses','mobiles','ucwebs','midps','windows ces','window.locations.href','ipads');
$nr= preg_replace($yuan,$hou, $nr);
$nr= str_replace($tihuanci,$beitihuanci, $nr);
write($cachefile,$nr);
echo $nr;
exit;
?>