<?php
error_reporting(E_ALL&~E_NOTICE);
@set_time_limit(120);
@ini_set('display_errors','On');
@ini_set('pcre.backtrack_limit', 1000000);
date_default_timezone_set('PRC');
header("Content-type: text/html; charset=utf-8");
$id=$_SERVER["REQUEST_URI"];
$url=$_GET['aric'];
$servers=$_GET['server'];
$url=str_replace("%EF%BB%BF","",trim($url));
$lailu=parse_url($url, PHP_URL_HOST);
 function get_content($url, $wait = 30, $proxy = true, $times = 0)
{
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
    $headers[] = 'Accept-Language: zh-CN,zh;q=0.9';
    $headers[] = 'Cache-Control: no-cache';
    $headers[] = 'Content-Type: application/x-www-form-urlencoded; charset=utf-8';
    $headers[] = 'User-Agent:' . $useragent[mt_rand(0, 4)];
    #$headers[] = 'X-MicrosoftAjax: Delta=true';

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_TIMEOUT, $wait);
    curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_HEADER, 1);
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

$nr=get_content($url);
if ($nr) {
    list($header, $body) = explode("\r\n\r\n", $nr, 2);
}
if(strpos($header,"200")==0){
    list($header, $body) = explode("\r\n\r\n", $body, 2);
}
if(strpos($header,"200")==0){
    list($header, $body) = explode("\r\n\r\n", $body, 2);
}

if($servers){
	$header = explode("\r\n", $header);
	$shu  = count($header)-1;
	for($i=0;$i<$shu;$i++){
		$shuzu[$i]= explode(":", $header[$i]);
		if($shuzu[$i][0]=="Server"){
				//echo json_encode($shuzu);
				echo $server = $shuzu[$i][1];
				exit();
			}
		}
	}

function type($header) {
    if (!empty($header)) {
        $spiderSite = array("html", "plain", "image", "zip", "pdf", "audio", "icon","css", "javascript", "json", "xml", "flash");
        foreach ($spiderSite as $val) {
            $str = strtolower($val);
            if (strpos($header, $str) !== false) {
                return $str;
            }
        }
    } else {
        return false;
    }
}

$shuchu=array("html"=>"Content-Type: text/html; charset=utf-8","plain"=>"Content-Type: text/plain","image"=>"Content-Type: image/jpeg","zip"=>"Content-Type: application/zip","pdf"=>"Content-Type: application/pdf","audio"=>"Content-Type: audio/mpeg","icon"=>"Content-Type: image/x-icon","css"=>"Content-type: text/css","javascript"=>"Content-type: text/javascript ","json"=>"Content-type: application/json","xml"=>"Content-type: text/xml","flash"=>"Content-Type: application/x-shockwave-flash");
$type=type($header);
ob_clean();
header("$shuchu[$type]");//curl输出header
$nr=$body;

$qidong=$type=="html"||$type=="css"||$type=="js"||$type=="plain"||$type=="json"||$type=="xml";

$encode = mb_detect_encoding($nr, array("ASCII","UTF-8","GB2312","GBK","BIG5")); 
if($encode!=="UTF-8"&&$qidong){
$nr=iconv('gbk','utf-8//IGNORE',$nr);
$tihuanshouye = array('gbk'=>'utf-8','gb2312'=>'utf-8','GBK'=>'utf-8','GB2312'=>'utf-8','BIG5'=>'utf-8','big5'=>'utf-8');
$nr=strtr($nr,$tihuanshouye);  
}

echo $nr;
exit();
?>