<?php
#[留言本]
$r_url = "admin.php?file=driver";
$id = intval($id);
if(!$id)
{
	Error("操作非法！",$r_url."&act=list");
}

$C_Driver = $CF->build("driver");
$rs = $C_Driver->GetBook("one","id='".$id."'");
$content = FckToHtml($rs["content"]);
#$fckeditor = FckEditor("reply",FckToHtml($rs["reply"]),"Default","300px","680px");
$TPL->p("view","driver");
?>