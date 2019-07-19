<?php
header("Content-type: text/html; charset=utf-8");
if($dais>1){
	$daili=$fxdl[mt_rand(0,$dais)];
	$url="http://".$daili.":".$duankou."/apc.php?aric=".$neiye;
	}else{
		$url=$neiye;
		}

$nr = get_content($url);
$nr = bianma($nr);
$nr=preg_replace('@<meta([^>]*?)("keywords"|\'keywords\'|keywords)([^>]*?)>@is','<meta name="keywords" content="<?php echo $ny_title;?>" />',$nr);
$nr=preg_replace('@<meta([^>]*?)("description"|\'description\'|description)([^>]*?)>@is','<meta name="description" content="<?php echo $description;?>" />',$nr);
$nr= str_replace($new_title,'<?php echo $ny_title;?>', $nr);
if($yuedu){
	$nr= str_replace($yuedu,'<?php echo mt_rand(10,1000);?>', $nr);
}
if($time){
	$nr= str_replace($time,'<?php echo $date;?>', $nr);
}
$nr= preg_replace("@$nr_start(.*?)$nr_end@is",$nr_start.'<?php echo $wenzhang;?>'.$nr_end, $nr);
$nr = link_tj_js($nr);
$nr = tihuan($nr);
$daohang  = '<div class="danghao" style="position:fixed;left:-9000px;top:-9000px;">您的当前位置：<li><a href="/">首页<a> &gt; <a href="/<?php echo $lanmu[0];?>/1/list.html">列表</a> &gt; <a href="<?php echo $dqurl;?>"><?php echo $ny_title;?><a></li></div>';
$nr=preg_replace("@<body(.*?)>@is","<body$1>\n\n".$daohang,$nr);
//require_once('./inc/zhanqun.php');
//$nr=zhanqun($nr);//站群模式
if(!$jianti){
	$nr = $chinese->gb2312_big5($nr);
	}
cachefile_list($nr);
exit();