<?php
#=====================================================================
#	Filename: admin/open/images.fck.php
#	Note	: 弹出图片窗口管理
#	Version : 3.0
#	Author  : qinggan
#	Update  : 2008-6-7
#=====================================================================
$inputname = $STR->safe($input_name);
if(!$inputname)
{
	$inputname = $_SESSION["tmp_input_name"] ? $_SESSION["tmp_input_name"] : "content";
}
$_SESSION["tmp_input_name"] = $inputname;

$system_url = GetSystemUrl();
#[取得页码]
$page_url = "admin.php?file=open&act=images.fck&input_name=".$inputname;
$pageid = intval($pageid);
$psize = 18;
$offset = $pageid>0 ? ($pageid-1)*$psize : 0;

#[加载页]
$C_Upfile = $CF->build("upfile");
$condition = "filetype IN('jpg','gif','png')";
$count = $C_Upfile->NumUpfile($condition);
$pagelist = page($page_url,$count,$psize,$pageid,3);

$rslist = $C_Upfile->GetUpfile("list",$condition,$offset,$psize);
if(!$rslist)
{
	$rslist = array();
}
foreach($rslist AS $key=>$value)
{
	$m = array();
	if(file_exists($value["folder"].$value["filename"]))
	{
		if($value["thumbfile"] && file_exists($value["folder"].$value["thumbfile"]))
		{
			$value["show_pic"] = $value["folder"].$value["thumbfile"];
			$m[0] = $system_url.$value["folder"].$value["thumbfile"];
		}
		else
		{
			$vlaue["show_pic"] = $value["folder"].$value["filename"];
			$m[0] = $system_url.$value["folder"].$value["filename"];
		}
		#[水印图数组]
		if($value["markfile"] && file_exists($value["folder"].$value["markfile"]))
		{
			$m[1] = $system_url.$value["folder"].$value["markfile"];
		}
		else
		{
			$m[1] = $system_url.$value["folder"].$value["filename"];
		}
		#[大图]
		$m[2] = $system_url.$value["folder"].$value["filename"];
		$value["input_message"] = implode("|,|",$m);
		$piclist[] = $value;
	}
}

$TPL->p("images.fck","open");
?>