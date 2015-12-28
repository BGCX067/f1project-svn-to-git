<?php
#[留言本]
$r_url = "admin.php?file=book";
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
$array["reply"] = $STR->html($content);
$array["replydate"] = $replydate ? strtotime($replydate) : $system_now;
$array["email"] = $STR->safe($email);
$C_Book = $CF->build("book");
$rs = $C_Book->GetBook("one","id='".$id."'");
if(!$rs)
{
	Error("找不到相关信息",$r_url."&act=list");
}
$array["postdate"] = $rs["postdate"];
$status = $C_Book->UpdateBook($array,$id);
$status ? Error("留言内容编辑/回复成功！",$r_url."&act=list") : Error("更新失败",$r_url."&act=view&id=".$id);
?>