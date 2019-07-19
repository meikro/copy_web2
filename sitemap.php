<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<meta http-equiv="Cache-Control" content="no-transform"/>
<meta http-equiv="Content-Language" content="zh-CN" />
<meta name="viewport" content="width=device-width,user-scalable=no">
<title>网站地图</title>
<head>
<body>
<?php
error_reporting(0);
require_once('./inc/function.php');
#ob_clean();
$file = file_get_contents(get_neilist());
if($_SERVER["REQUEST_URI"]=='/sitemap.php'){
	gx();
}
echo $file;
?>
</body>
</html>