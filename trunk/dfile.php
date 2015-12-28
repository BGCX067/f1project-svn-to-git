<?php
#[下载附件]
require_once("global.php");
$id = intval($id);
if(!$id)
{
	Error("操作非法","index.php");
}

$C_Upfile = $CF->build("upfile");
$rs = $C_Upfile->GetUpfile("one","id='".$id."'");
if(!$rs)
{
	Error("没有找到相关附件记录信息","index.php");
}
if(!file_exists($rs["folder"].$rs["filename"]))
{
	Error("附件不存在！","index.php");
}

#[计算文件大小]
$filesize = filesize($rs["folder"].$rs["filename"]);

function phead($string, $replace = true, $http_response_code = 0)
{
	$string = str_replace(array("\r", "\n"), array('', ''), $string);
	if(empty($http_response_code) || PHP_VERSION < '4.3' )
	{
		@header($string, $replace);
	}
	else
	{
		@header($string, $replace, $http_response_code);
	}
	if(preg_match('/^\s*location:/is', $string))
	{
		exit;
	}
}
function chk_mime_type($filename="")
{
	if(!$filename)
	{
		return false;
	}
	$name = explode(".",$filename);
	$count = count($name);
	$type = strtolower($name[$count-1]);
	if(!$type)
	{
		return false;
	}
	#--------------
	global $FS;
	$mimetype = $FS->Read("include/mime.txt");
	$mimetype = str_replace("\r","",$mimetype);
	$mimelist = explode("\n",$mimetype);
	$mlist = array();
	foreach((is_array($mimelist) ? $mimelist : array()) AS $key=>$value)
	{
		$value = trim($value);
		if($value)
		{
			$msg = array();
			$msg = explode(" ",$value);
			$msg_left = trim($msg[0]);
			$msg_right = trim($msg[1]);
			if($msg_left && $msg_right)
			{
				$mlist[$msg_left] = $msg_right;
			}
		}
	}
	unset($mimetype,$mimelist);
	if(!array_key_exists($type,$mlist))
	{
		return false;
	}
	return $mlist[$type];
}
ob_end_clean();
phead("Date: ".gmdate("D, d M Y H:i:s", $rs["postdate"])." GMT");
phead("Last-Modified: ".gmdate("D, d M Y H:i:s", $rs["postdate"])." GMT");
phead("Content-Encoding: none");
phead("Content-Disposition: attachment; filename=".rawurlencode($rs["tmpname"]));
phead("Content-Length: ".$filesize);
phead("Accept-Ranges: bytes");
@readfile($rs["folder"].$rs["filename"]);
@flush();
@ob_flush();
?>