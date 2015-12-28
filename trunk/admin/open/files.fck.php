<?php
#==================================================================================================
#	Filename: admin/open/files.fck.php
#	Note	: 弹出文件窗口管理
#	Version : 3.0
#	Author  : qinggan
#	Update  : 2008-06-03
#==================================================================================================
$inputname = $STR->safe($inputname);
if(!$inputname)
{
	$inputname = $_SESSION["tmp_input_name"] ? $_SESSION["tmp_input_name"] : "content";
}
$_SESSION["tmp_input_name"] = $inputname;

#[取得页码]
$page_url = "admin.php?file=open&act=files.fck&input_name=".$inputname;
$pageid = intval($pageid);
$psize = 18;
$offset = $pageid>0 ? ($pageid-1)*$psize : 0;

#[加载页]
$C_Upfile = $CF->build("upfile");
$count = $C_Upfile->NumUpfile();
$pagelist = page($page_url,$count,$psize,$pageid,0);

$rslist = $C_Upfile->GetUpfile("list","",$offset,$psize);
if(!$rslist)
{
	$rslist = array();
}
$TPL->p("files.fck","open");
?>