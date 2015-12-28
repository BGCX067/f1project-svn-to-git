<?php
#=====================================================================
#	Filename: admin/open/mark.php
#	Note	: 弹出图片窗口管理
#	Version : 3.0
#	Author  : qinggan
#	Update  : 2008-07-13
#=====================================================================
$inputname = $STR->safe($input_name);
if(!$inputname)
{
	$inputname = $_SESSION["tmp_input_name"] ? $_SESSION["tmp_input_name"] : "mark";
}
$_SESSION["tmp_input_name"] = $inputname;

#[取得页码]
$page_url = "admin.php?file=open&act=mark&input_name=".$inputname;
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
	$m = "";
	if(file_exists($value["folder"].$value["filename"]))
	{
		if($value["thumbfile"] && file_exists($value["folder"].$value["thumbfile"]))
		{
			$value["show_pic"] = $value["folder"].$value["thumbfile"];
		}
		else
		{
			$vlaue["show_pic"] = $value["folder"].$value["filename"];
		}
		if($value["markfile"] && file_exists($value["folder"].$value["markfile"]))
		{
			$value["val"] = $value["folder"].$value["markfile"]."|,|".$value["folder"].$value["filename"];
		}
		else
		{
			$vlaue["val"] = $value["folder"].$value["filename"];
		}
		$piclist[] = $value;
	}
}

$TPL->p("mark","open");
?>