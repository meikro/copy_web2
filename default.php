<?php
error_reporting(0);
$t1 = microtime(true);
require_once('./inc/zhizhu.php');
require_once('./inc/function.php');
require_once('./inc/index.php');
$cachefile=get_xiaotou();
ob_clean();
if($sy){
	require_once('./inc/config.php');
}
if(is_file($cachefile)){
	$nr = file_get_contents($cachefile);
	$nr = xinchuli($nr);
	echo $nr;
	if(gengxin()){
		gx();
	}
	$t2 = microtime(true);
	echo '<!--耗时'.round($t2-$t1,3).'秒<//br>-->';
	exit();
}
$nr = get_content($url);
$nr = bianma($nr);
$nr = link_tj_js($nr);
$nr = tihuan($nr);
//require_once('./inc/zhanqun.php');
//$nr=zhanqun($nr);//站群模式
$nr = wap($nr);
if(!$jianti){
	$nr = $chinese->gb2312_big5($nr);
}
echo $nr;
cachefile($nr);
if($sy){
	require_once('./inc/mb.php');
}
if(gengxin()){
	gx();
}
$t2 = microtime(true);
echo '<!--耗时'.round($t2-$t1,3).'秒<//br>-->';
exit();
?>