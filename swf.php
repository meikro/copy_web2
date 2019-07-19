<?php
error_reporting(0);
require_once('./inc/coon.php');
require_once('./inc/function.php');
ob_clean();
$filename=get_swf();
if(is_file($filename)){
	header('Content-type: application/x-shockwave-flash');
	$shuchuneirong=file_get_contents($filename);
	echo $shuchuneirong;
	exit;
}
$nr=get_content($url);

header('Content-type:application/x-shockwave-flash');
write($filename,$nr);
$fileres = file_get_contents($filename);
echo $fileres;
exit;
?>