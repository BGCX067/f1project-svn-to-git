<?php
#=====================================================================
#	Filename: admin/attachments/umark.php
#	Note	: 批量更新水印图片
#	Version : 3.0
#	Author  : qinggan
#	Update  : 2008-08-16
#=====================================================================
$r_url = "admin.php?file=attachments&act=list";
$id = $STR->safe($id);
if(!$id)
{
	Error("操作非法",$r_url);
}
$k = intval($k);
$f_url = "admin.php?file=attachments&act=umark&id=".$id;

$id_array = explode(",",$id);
$count = count($id_array);

if(($k+1)>$count)
{
	Error("批量水印更新完毕",$r_url);
}

$updateId = $id_array[$k];
if($updateId)
{
	$condition = "id='".$updateId."'";
	$C_Upfile = $CF->build("upfile");
	$rs = $C_Upfile->GetUpfile("one",$condition);
	if(!$rs)
	{
		$f_url .= "&k=".($k+1);
		Error("没有找到相关资源，正在转到下一张图片进行更新",$f_url);
	}
	if(file_exists($rs["folder"].$rs["filename"]) && ($rs["filetype"] == "jpg" || $rs["filetype"] == "gif" || $rs["filetype"] == "png"))
	{
		$rs["markfile"] = $GD->mark($rs["folder"].$rs["filename"]);
		#[更新SQL数据库]
		$C_Upfile->SetUpfile($rs,$updateId);
	}
	$tiMsg = "共需要更新 <span style='color:red;'>".$count."</span> 个被选中的文件，已经更新到第 <span style='color:red;'>".($k+1)."</span> 个，请稍候...";
	Error($tiMsg,$f_url."&k=".($k+1));
}
Error("操作成功",$r_url);
?>