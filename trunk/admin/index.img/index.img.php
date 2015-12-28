<?php
#[首页前台图片播放管理]
$qgarray = array(1,2,3,4,5,6,7,8,9);#[数组]
if($sysAct == "set")
{
	$imgarray = $urlarray = array();
	$content = $FS->Read("data/pic_player.php");#[读取图片信息]
	if($content)
	{
		$g_array = explode("\n",$content);
		$g_count = count($g_array);
		if($g_count>0)
		{
			foreach($g_array AS $key=>$value)
			{
				$m = $key+1;
				$value = trim($value);
				$v = explode("|||",$value);
				$imgarray[$m] = $v[0];
				$urlarray[$m] = $v[1];
			}
		}
	}
	$TPL->p("index.img","index.img");
}
elseif($sysAct == "setok")
{
	$sql_array = array();
	foreach($qgarray AS $key=>$value)
	{
		$my_img = $my_url = "";
		$my_img = $STR->safe($_POST["img_".$value]);
		$my_url = $STR->safe($_POST["url_".$value]);
		if($my_img)
		{
			$sql_array[$key] = $my_img."|||".$my_url;
		}
	}
	$content = implode("\n",$sql_array);
	$FS->Write($content,"data/pic_player.php");#[存放图片轮播]
	Error("图片播放器信息已经更新完毕！","admin.php?file=index.img&act=set");
}
?>