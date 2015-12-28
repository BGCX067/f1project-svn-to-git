<?php
#[留言本]
$r_url = "admin.php?file=book";
$id = intval($id);
if(!$id)
{
	Error("操作非法！",$r_url."&act=list");
}
$C_Book = $CF->build("book");
$rs = $C_Book->GetBook("one","id='".$id."'");
$content = FckToHtml($rs["reply"]);
#$fckeditor = FckEditor("reply",FckToHtml($rs["reply"]),"Default","300px","680px");
$TPL->p("view","book");
?>