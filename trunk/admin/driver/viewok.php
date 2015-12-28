<?php
#[留言本]
$r_url = "admin.php?file=driver";
$id = intval($id);
if(!$id)
{
	Error("操作非法！",$r_url."&act=list");
}
$array["ifcheck"] = intval($ifcheck);
$array["subject"] = $STR->safe($subject);
$array["user"] = $STR->safe($qguser);
$array["typeid"] = intval($cateid);
$array["content"] = $STR->safe($t_content);
$array["phone"] = $STR->safe($phone);
$array["email"] = $STR->safe($email);
$C_Driver = $CF->build("driver");
$rs = $C_Driver->GetBook("one","id='".$id."'");
if(!$rs)
{
	Error("找不到相关信息",$r_url."&act=list");
}
$array["postdate"] = $rs["postdate"];
$status = $C_Driver->UpdateBook($array,$id);
$status ? Error("留言内容编辑/回复成功！",$r_url."&act=list") : Error("更新失败",$r_url."&act=view&id=".$id);
?>