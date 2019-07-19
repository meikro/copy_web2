<?php
function bianma($nr){
	$encode = mb_detect_encoding($nr, array("ASCII","UTF-8","GB2312","GBK","BIG5")); 
	if($encode!=="UTF-8"){
		$nr=iconv('gbk','utf-8//IGNORE',$nr);
		$tihuanshouye = array('gbk'=>'utf-8','gb2312'=>'utf-8','GBK'=>'utf-8','GB2312'=>'utf-8','BIG5'=>'utf-8','big5'=>'utf-8');
		$nr=strtr($nr,$tihuanshouye);  
		}
	return $nr;
	}
function link_tj_js($nr){
	global $mubiao,$dj,$beitihuan,$tihuanci;
	$nr= preg_replace("@hm.baidu.com(.*?)('|\")@is","hm.baidu.com$1ar'", $nr);
	$nr= str_replace("cnzz.com","cnzz.co", $nr);
	$nr= str_replace('users.51.la','user.51.la', $nr);
	$nr= str_replace('"//','"http://', $nr);
	$nr= str_replace("'//","'http://", $nr);
	//统计处理


	$nr= str_replace("background='","background='/", $nr);
	$nr= str_replace("background=\"","background=\"/", $nr);
	$nr= str_replace("href='","href='/", $nr);
	$nr= str_replace("href=\"","href=\"/", $nr);
	$nr= str_replace("src='","src='/", $nr);
	$nr= str_replace("src=\"","src=\"/", $nr);

	$nr= str_replace("background='/http","background='http", $nr);
	$nr= str_replace("background=\"/http","background=\"http", $nr);
	$nr= str_replace("href='/http","href='http", $nr);
	$nr= str_replace("href=\"/http","href=\"http", $nr);
	$nr= str_replace("src='/http","src='http", $nr);
	$nr= str_replace("src=\"/http","src=\"http", $nr);

	$nr= str_replace("background='//","background='/", $nr);
	$nr= str_replace("background=\"//","background=\"/", $nr);
	$nr= str_replace("href='//","href='/", $nr);
	$nr= str_replace("href=\"//","href=\"/", $nr);
	$nr= str_replace("src='//","src='/", $nr);
	$nr= str_replace("src=\"//","src=\"/", $nr);

	$nr= str_replace($beitihuan,$tihuanci,$nr);
    $nr= str_replace(top_domain($mubiao),$dj, $nr);
	$nr=preg_replace('@<a (?!(rel=|>).*)(.*?)href="http@is','<a $2rel="nofollow" href="http',$nr);
	$nr=preg_replace("@<a (?!(rel=|>).*)(.*?)href='http@is","<a $2rel='nofollow' href='http",$nr);

	$nr= str_replace('"http://www.'.$dj,'"/', $nr);
	$nr= str_replace("'http://www.".$dj,"'/", $nr);
	$nr= str_replace('"http://'.$dj,'"/', $nr);
	$nr= str_replace("'http://".$dj,"'/", $nr);
	$nr= str_replace('"//','"/', $nr);
	$nr= str_replace("'//","'/", $nr);
	$nr= str_replace('<option','<option rel="nofollow"', $nr);
	$nr= str_replace('rel="nofollow" href="http://www.'.$dj,'href="http://www.'.$dj, $nr);
	$nr= str_replace("rel='nofollow' href='http://www.".$dj,"href='http://www.".$dj, $nr);

	$yuan=array('/iPhone/i','/eval/i','/ipod/i','/android/i','/ios/i','/phone/i','/webos/i','/mobile/i','/ucweb/i','/midp/i','/windows ce/i','/location/i','/ipad/i',"/marquee/i");
	$hou=array('iphones','evals','ipods','androids','ioses','phones','weboses','mobiles','ucwebs','midps','windows ces','locations','ipads',"");
	$nr= preg_replace($yuan,$hou, $nr);
	//js处理
	return $nr;
	}

function tihuan($nr){
	global $name,$sy,$http;
	$nr= str_replace(array('href="/"',"href='/'","http://",'xmlns="https://',"xmlns='https://"),array('href="/index.html"',"href='/index.html'",$http,'xmlns="http://',"xmlns='https://"),$nr);
	if($sy){
		api_add($name);
		}
	return $nr;
	}

function cachefile($nr){
	$cachefile_ganrao=get_ganrao();
	$cachefile=get_xiaotou();
	if(!is_file($cachefile_ganrao)){
		write($cachefile_ganrao,ganrao());
		}
	if(!is_file($cachefile)){
		write($cachefile,$nr);
		}
	}
function cachefile_list($nr){
	$cachefile_nei=get_nei();
	if(!is_file($cachefile_nei)){
		write($cachefile_nei,$nr);
		}
	}

function wap($nr){
	global $dqurl,$m_url,$sy,$title,$gjz,$miaoshu,$bot,$beitihuan,$tihuanci;
			//$bot = 1;
	if($sy){
		$nr=preg_replace("@<title>(.*?)</title>@is","<title>".$title."</title>",$nr);

		if($gjz){
			$nr=preg_replace('@<meta([^>]*?)(name="keywords"|name=\'keywords\')([^>]*?)>@is','<meta name="keywords" content="'.$gjz.'" />',$nr);
			}
		if($miaoshu){
			$nr=preg_replace('@<meta([^>]*?)(name="description"|name=\'description\')([^>]*?)>@is','<meta name="description" content="'.$miaoshu.'" />',$nr);
			}
		}
	$nr= str_replace($beitihuan,$tihuanci,$nr);

	$shuchushouji='<link rel="canonical" href="'.$dqurl.'"/>
<meta name="mobile-agent" content="format=[wml|xhtml|html5];url='.$m_url.'" />
<link href="'.$m_url.'" rel="alternate" media="only screen and (max-width: 640px)" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<meta http-equiv="Cache-Control" content="no-transform" />';
//指定手机版
	$nr=str_replace("</title>","</title>\r\n".$shuchushouji,$nr);
	if($bot){
		$ganrao = file_get_contents(get_ganrao());
		$listcha = file_get_contents(get_sy());
		$nr=preg_replace("@<body(.*?)>@is","<body$1>".$ganrao.$listcha,$nr);
		$nr=preg_replace("@</body(.*?)>@is","<a href='/sitemap.html'>网站地图</a>\r\n"."<body$1>",$nr);
		}
	return $nr;
}


function xinchuli($nr){
	global $dqurl,$m_url,$sy,$title,$gjz,$miaoshu,$bot,$beitihuan,$tihuanci;
			//$bot = 1;
	if($sy){
		$nr=preg_replace("@<title>(.*?)</title>@is","<title>".$title."</title>",$nr);

		if($gjz){
			$nr=preg_replace('@<meta([^>]*?)(name="keywords"|name=\'keywords\')([^>]*?)>@is','<meta name="keywords" content="'.$gjz.'" />',$nr);
			}
		if($miaoshu){
			$nr=preg_replace('@<meta([^>]*?)(name="description"|name=\'description\')([^>]*?)>@is','<meta name="description" content="'.$miaoshu.'" />',$nr);
			}
		}
	$nr= str_replace($beitihuan,$tihuanci,$nr);
	if($bot){
		$ganrao = file_get_contents(get_ganrao());
		$listcha = file_get_contents(get_sy());
		$nr=preg_replace("@<body(.*?)>@is","<body$1>".$ganrao.$listcha,$nr);
		$nr=preg_replace("@</body(.*?)>@is","<a href='/sitemap.html'>网站地图</a>\r\n"."<body$1>",$nr);
		}
	return $nr;
}

function wz_api(){
	global $name;
	$url_api = "http://173.82.197.114:22055/xinban/MongoDB.php?name=".$name."&s=".mt_rand(5,20);
	$resultx = get_content_nr($url_api);
	$result = json_decode($resultx, true);
	if($result==""){
		header("HTTP/1.1 404 Not Found");
		header("Status: 404 Not Found");
		exit();
	}
	return $result;
}