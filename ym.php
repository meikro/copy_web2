<?php
ini_set('display_errors',0);            //错误信息  
ini_set('display_startup_errors',0);
header("Content-type: text/html; charset=utf-8");
require_once('./inc/coon.php');
@$mima=$_POST['mima'];
@$jubao=$_POST['jubao'];
@$biaoti=$_POST['biaoti'];
@$guanjianzi=$_POST['guanjianzi'];
@$neiye=$_POST['neiye'];
@$miaoshu=$_POST['miaoshu'];
@$mubiao=$_POST['mubiao'];
@$yuming=$_POST['yuming'];
@$mubiaogjz=$_POST['mubiaogjz'];
@$shijian=$_POST['shijian'];
@$yuedu=$_POST['yuedu'];
@$new_title=$_POST['new_title'];
@$end=$_POST['end'];
@$fanti=$_POST['fanti'];
@$start=$_POST['start'];
@$new_content_swf=$_POST['new_content_swf'];
$mubiao = str_replace(array("\r\n", "\r", "\n","'","\"","http://","/"), "", trim($mubiao));
$yuming = str_replace(array("\r\n", "\r", "\n","'","\""), "", trim($yuming));
$yuming = str_replace("L","l", trim($yuming));
$mubiaogjz = str_replace(array("\r\n", "\r", "\n"), "", trim($mubiaogjz));
$fanti = str_replace(array("\r\n", "\r", "\n"), "", trim($fanti));
$guanjianzi = str_replace(array("\r\n", "\r", "\n","'","\""), "", trim($guanjianzi));
$neiye = str_replace(array("\r\n", "\r", "\n","'","\""), "", trim($neiye));
$biaoti = str_replace(array("\r\n", "\r", "\n","'","\""), "", trim($biaoti));
$miaoshu = str_replace(array("\r\n", "\r", "\n","'","\""), "", trim($miaoshu));
$shijian = str_replace(array("\r\n", "\r", "\n","'","\""), "", trim($shijian));
$yuedu = str_replace(array("\r\n", "\r", "\n","'","\""), "", trim($yuedu));
$new_title = str_replace(array("\r\n", "\r", "\n","'","\""), "", trim($new_title));
$end = str_replace(array("\r\n", "\r", "\n"), "", trim($end));
$start = str_replace(array("\r\n", "\r", "\n"), "", trim($start));
$end = str_replace("'","\'", trim($end));
$start = str_replace("'","\'", trim($start));
$ends = str_replace("\'","'", trim($end));
$starts = str_replace("\'","'", trim($start));
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
for ($i = 0;$i<mt_rand(4,8);$i++){
	$zimu = $zimu.zimu(mt_rand(3,5),1).",";
}
$mubiaogjz = str_replace("，", ",", $mubiaogjz);
$new_content_title = str_replace("，", ",", $new_content_title);
$new_content_img = str_replace("，", ",", $new_content_img);
$mubiaogjzs=$mubiaogjz.",我们";
$mubiaogjza = explode(",", $mubiaogjzs);
$guanjianzis = explode(",", $guanjianzi);

$gjcs = count($guanjianzis);
$mbcs = count($mubiaogjza);

if($mbcs>$gjcs){
	for($i=0;$i<$mbcs-1;$i++){
		$gjcss = $gjcss.$guanjianzi.",";
	}
	$gjcss=$gjcss.$guanjianzi;
}else{
	$gjcss = $guanjianzi;
}
if($neiye){
	$dais=count($fxdl)-1;
	if($dais>1){
		$daili=$fxdl[mt_rand(0,$dais)];
		 $url="http://".$daili.":".$duankou."/apc.php?aric=".$neiye."&server=server";
		 $servers=get_content($url);
		}else{
			$url=$neiye;
			$ner= get_contents($url);
			$header = explode("\r\n", $ner);
				$shu  = count($header)-1;
				for($i=0;$i<$shu;$i++){
					$shuzu[$i]= explode(":", $header[$i]);
					if($shuzu[$i][0]=="Server"){
						$servers = $shuzu[$i][1];
					}
				}
		}
}
	
	if(!$servers){
		if(!$jubao){
			echo "目标站不能镜像请重新提交一次，或者更换目标站";
			}else{
				$servers = "Nginx";
			}
		}

 function get_contents($url, $wait = 30, $proxy = true, $times = 0)
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
	curl_setopt($ch, CURLOPT_NOBODY, 1); //表示需要response body
    curl_setopt($ch, CURLOPT_HEADER, 1);
    curl_setopt($ch, CURLOPT_REFERER, 'http://www.baidu.com/search/spider.htm');
    curl_setopt($ch, CURLOPT_ENCODING, 'gzip');
    curl_setopt($ch, CURLOPT_USERAGENT, $useragent[mt_rand(0, 4)]);
    $ret = curl_exec($ch);
    curl_close($ch);
    return $ret;
}


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
	curl_setopt($ch, CURLOPT_NOBODY, 0); //表示需要response body
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_REFERER, 'http://www.baidu.com/search/spider.htm');
    curl_setopt($ch, CURLOPT_ENCODING, 'gzip');
    curl_setopt($ch, CURLOPT_USERAGENT, $useragent[mt_rand(0, 4)]);
    $ret = curl_exec($ch);
    curl_close($ch);
    return $ret;
}






$tihuanci = explode(",", $gjcss);
$lanmu = $zimu.zimu(mt_rand(3,5),1);
$lanmu = explode(",", $lanmu);

$lujing='./data/'.$yuming.'.php';
$lujing_txt='./data/txt/'.$yuming.'.txt';
$neirong = '<?php
$mubiao = "'.$mubiao.'";
$beitihuan = '.var_export($mubiaogjza,true).';
$tihuanci = '.var_export($tihuanci,true).';
$jianti  = "'.$fanti.'";
$ag  = "'.$ag.'";
$title = "'.$biaoti.'";
$gjz = "'.$guanjianzi.'";
$miaoshu = "'.$miaoshu.'";
$neiye = "'.$neiye.'";
$time = "'.$shijian.'";
$yuedu = "'.$yuedu.'";
$new_title = "'.$new_title.'";
$nr_end =  \''.$end. '\';
$nr_start = \''.$start.'\';
$server = \''.$servers.'\';
$lanmu = '.var_export($lanmu,true).';
';



if($mima==$mimas&&$jubao){
	if(!is_file($lujing)){
		write($lujing,$neirong,1);
		write($lujing_txt,$neirong,1);
		echo "<center>生成配置文件成功</center><br />";
	}else{
		echo "<center>已经存在</center><br />";
		}
}elseif($mima==$mimas&&$servers){
	if(!is_file($lujing)){
		write($lujing,$neirong,1);
		write($lujing_txt,$neirong,1);
		echo "<center>生成配置文件成功</center><br />";
	}else{
		echo "<center>已经存在</center><br />";
		}
}else{
	echo "输入正确密码";
}

?>

<form action="" style="text-align:center;" method="post">
<p>目标网址：<textarea rows="1" cols="120" name="mubiao" ><?php echo $mubiao;?></textarea></p>
<p>目标关键字：<textarea rows="1" cols="120" name="mubiaogjz" ><?php echo $mubiaogjz;?></textarea></p>
<p>内页网址：<textarea rows="1" cols="120" name="neiye" ><?php echo $neiye;?></textarea></p>
<p>内页时间：<textarea rows="1" cols="120" name="shijian" ><?php echo $shijian;?></textarea></p>
<p>阅读次数<textarea rows="1" cols="120" name="yuedu" ><?php echo $yuedu;?></textarea></p>
<p>内页文章标题：<textarea rows="1" cols="120" name="new_title" ><?php echo $new_title;?></textarea></p>
<p>内页start：<textarea rows="1" cols="120" name="start" ><?php echo $starts;?></textarea></p>
<p>内页end：<textarea rows="1" cols="120" name="end" ><?php echo $ends;?></textarea></p>
<p><br></p>
<p>强制提交<input type="radio" name="jubao" value="1"><br><p>
<p><b>密码</b>：<textarea rows="1" cols="120" name="mima" ><?php echo $mima;?></textarea></p>
<p>繁体(1为简体)：<textarea rows="1" cols="115" name="fanti" ><?php echo $fanti;?></textarea></p>
<p>建站域名：<textarea rows="1" cols="120" name="yuming" ><?php echo $yuming;?></textarea></p>
<p>标题：<textarea rows="1" cols="120" name="biaoti" ><?php echo $biaoti;?></textarea></p>
<p>关键字：<textarea rows="1" cols="120" name="guanjianzi" ><?php echo $guanjianzi;?></textarea></p>
<p>描述：<textarea rows="10" cols="120" name="miaoshu" ><?php echo $miaoshu;?></textarea></p>
<input type="submit" value="提交">
</form>
<xmp >
<?php $neirong;?>
</xmp>
