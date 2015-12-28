<?php
$r_url = "admin.php?file=driver";
#[留言列表]
$psize = 30;
$pageid = intval($pageid);
$offset = $pageid>0 ? ($pageid-1)*$psize : 0;
$page_url = "admin.php?file=driver&act=list";
$keywords = $STR->safe($keywords);
$condition = "1=1";
if($keywords)
{
	$page_url .= "&keywords=".rawurlencode($keywords);
	$condition .= " AND subject LIKE '%".$keywords."%'";
}
$ifcheck = intval($ifcheck);
if($ifcheck)
{
	$page_url .= "&ifcheck=".$ifcheck;
	if($ifcheck == 1)
	{
		$condition .= " AND ifcheck=1";
	}
	else
	{
		$condition .= " AND ifcheck=0";
	}
}

$C_Driver = $CF->build("driver");
$bcount = $C_Driver->CountBook($condition);
$booklist = $C_Driver->GetBook("list",$condition,$offset,$psize);
$pagelist = page($page_url,$bcount,$psize,$pageid);#[获取页数信息]
$TPL->p("list","driver");
?>