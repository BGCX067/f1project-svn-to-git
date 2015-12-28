<?php
#[留言本]
#[判断权限]
$r_url = "admin.php?file=book&act=list";
$C_Book = $CF->build("book");
$myidlist = $STR->safe($idlist);#[获取IDlist]
if(!$myidlist)
{
	Error("信息操作不正确",$r_url);
}
$qgtype = $STR->safe($qgtype);
if($qgtype == "delete")
{
	#[支持批量删除]
	$C_Book->DelBook($myidlist);
	Error("批量删除主题完成！",$r_url);
}
elseif($qgtype == "dcheck")
{
	$C_Book->IfcheckBook($myidlist,0);
	Error("批量 <span style='color:red;'>取消审核</span> 操作完成！",$r_url);
}
else
{
	$C_Book->IfcheckBook($myidlist,1);
	Error("批量 <span style='color:red;'>审核</span> 操作完成！",$r_url);
}
?>