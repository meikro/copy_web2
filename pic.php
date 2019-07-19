<?php
error_reporting(0);
require_once('./inc/coon.php');
require_once('./inc/function.php');
$cachefile=get_jpg();
ob_clean();
if(is_file($cachefile)){
	header('Content-type: image/jpeg');
	$shuchuneirong=file_get_contents($cachefile);
	echo $shuchuneirong;
	exit;
}
$nr=get_content($url);
header('Content-type: image/jpeg');
write($cachefile,$nr);
$fileres = file_get_contents($cachefile);
echo $fileres;
exit();
?>