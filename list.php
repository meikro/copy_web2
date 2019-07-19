<?php
ob_clean();
require_once('./inc/zhizhu.php');
require_once('./inc/function.php');
require_once('./inc/index.php');
ob_clean();
$get_neilist = get_neilist();
$cachefile_neiye = get_neiye();
if(is_file($cachefile_neiye)){
	$nr = file_get_contents($cachefile_neiye);
	$nr = wap($nr);
	echo $nr;
	exit();
	}

if($_GET['s']=="list.html"){
	$cachefile_nei = get_nei();
	$ny_title = "新闻中心";
	$file = file($get_neilist);
	$zongshu = count($file);
	$count = ceil(count($file)/10);
	$file = array_reverse($file); 
	$i = $_GET['i']*10;
	$file = array_slice($file,$i-10,10);
	for($b=1;$b<=$count;$b++){
		$fenye = $fenye.'<a href="/'.$lanmu[0].'/'.$b.'/list.html">'. $b.'</a>';
		}
	$fenye = '<li class="pages"><center>'.$fenye.' 合计'.$zongshu.'篇文章</center></li>';
	$wenzhang = implode($file)."\r\n".$fenye;
	ob_start();
	include_once $cachefile_nei;
	//载入模板
	$html=ob_get_contents();
	ob_clean();
	echo $html;
	exit();
}

$url = $_SERVER["REQUEST_URI"];
$url = explode('?', $url);
$url =$url[0];
$cachefile_nei = get_nei();
$nr = wz_api();
$ny_title = $nr['title'];
$wenzhang = $nr['nr'];
if(!$jianti){
	$ny_title = $chinese->gb2312_big5($ny_title);
	$wenzhang = $chinese->gb2312_big5($wenzhang);
	}
$date = date('Y-m-d H:i');
$list = '<li><a href="'.$url.'">'.$ny_title.'</a> <time>'.$date.'</time></li>';
$description= msubstr($wenzhang,mt_rand(90,300)) ;

ob_start();
include_once $cachefile_nei;
$html=ob_get_contents();
ob_clean();
echo $html;
if($ny_title){
	write($get_neilist,$list);
	write($cachefile_neiye,$html);
	}
exit();
?>