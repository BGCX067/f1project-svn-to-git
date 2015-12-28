<?php
#=====================================================================
#	Filename: include/module/book.qgmod.php
#	Note	: 读取留言本信息
#	Version : 3.0
#	Author  : qinggan
#	Update  : 2008-09-18
#=====================================================================
$num = intval($num) ? intval($num) : 10;
$cache_file = "data/cache/book_".$num.".php";
$check_status = false;
if($iscache)
{
	$check_status = CheckCache($cache_file);#[判断缓存文件的存储状态]
}
if($check_status)
{
	include_once($cache_file);
	return $booklist;
}
global $DB,$FS,$CF;
$C_Book = $CF->build("book");
$booklist = $C_Book->GetBook("list","ifcheck='1'",0,$num);
if($booklist)
{
	$FS->Write($booklist,$cache_file,"booklist");
}
return $booklist;
?>