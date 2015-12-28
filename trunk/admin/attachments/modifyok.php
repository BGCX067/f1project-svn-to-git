<?php
#=====================================================================
#	Filename: admin/attachments/modifyok.php
#	Note	: 更新附件信息成功
#	Version : 3.0
#	Author  : qinggan
#	Update  : 2008-6-28
#=====================================================================
$r_url = $_SESSION["return_url"] ? $_SESSION["return_url"] : "admin.php?file=attachments&act=list";
$id = intval($id);
if(!$id)
{
	Error("操作非法",$r_url);
}
$C_Upfile = $CF->build("upfile");
$condition = "id='".$id."'";
$rs = $C_Upfile->GetUpfile("one",$condition);
if(!$rs)
{
	Error("附件不存在",$r_url);
}
$tmpname = $STR->safe($tmpname);
if($tmpname == $rs["tmpname"])
{
	Error("名称一样，不用换名字",$r_url);
}
$ext = strtolower(substr($rs["filename"],-3));
if(strtolower(substr($tmpname,-3)) != $ext)
{
	if($ext == ".gz")
	{
		$ext = "tar.gz";
	}
	$tmpname .= ".".$ext;
}
$array["filetype"] = $rs["filetype"];
$array["tmpname"] = $tmpname;
$array["filename"] = $rs["filename"];
$array["folder"] = $rs["folder"];
$array["thumbfile"] = $rs["thumbfile"];
$array["markfile"] = $rs["markfile"];
$C_Upfile->SetUpfile($array,$id) ? Error("更新成功",$r_url) : Error("更新失败",$r_url);
?>