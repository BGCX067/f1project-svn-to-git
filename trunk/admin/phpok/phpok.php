<?php
#============================
#	Filename: admin/phpok/phpok.php
#	Note	: 自定义代码管理系统
#	Version : 2.0
#	Author  : qinggan
#	Update  : 2008-09-03
#============================
$C_Phpok = $CF->build("phpok");
if($sysact == "add" || $sysact == "modify")
{
	if($sysact == "modify")
	{
		$id = intval($id);
		if(!$id)
		{
			Error("操作非法...","admin.php?file=phpok&act=list");
		}
		$rs = $C_Phpok->GetPhpok("one","id='".$id."'");
		$content = FckToHtml($rs["content"]);
	}
	else
	{
		$content = "";
		$rs["status"] = 1;
	}
	$fckeditor = FckEditor("content",$content,"Default","300px","100%");
}
elseif($sysact == "viewok")
{
	$r_url = "admin.php?file=phpok&act=list";
	$id = intval($id);
	$array["subject"] = $STR->safe($subject);
	$STR->Set("script",true);
	$STR->Set("iframe",true);
	$STR->Set("style",true);
	$array["content"] = $STR->html($content);
	$array["status"] = intval($status);
	$array["sign"] = $STR->safe($sign);
	$tishi = "自定义代码";
	if(!$id)
	{
		$tishi .= "创建";
		$tishi .= $C_Phpok->SetPhpok($array) ? "成功" : "失败";		
	}
	else
	{
		$tishi .= "更新";
		$tishi .= $C_Phpok->SetPhpok($array,$id) ? "成功" : "失败";
	}
	Error($tishi,$r_url);
}
elseif($sysact == "delete")
{
	$r_url = "admin.php?file=phpok&act=list";
	$id = intval($id);
	if(!$id)
	{
		Error("操作非法...",$r_url);
	}
	$C_Phpok->DelPhpok($id);
	Error("自定义代码删除成功，请更新缓存…",$r_url);
}
elseif($sysact == "check")
{
	$r_url = "admin.php?file=phpok&act=list";
	$id = intval($id);
	if(!$id)
	{
		Error("操作非法...",$r_url);
	}
	$rs = $C_Phpok->GetPhpok("one","id='".$id."'");
	if(!$rs)
	{
		Error("找不到相关信息",$r_url);
	}
	if($rs["status"] == 0 || !$rs["status"])
	{
		$ifcheck = 1;
		$msg = "成功设置自定义代码为正常状态！";
	}
	else
	{
		$ifcheck = 0;
		$msg = "成功设置自定义代码为锁定状态！";
	}
	$C_Phpok->Status($ifcheck,$id);
	Error($msg,$r_url);
}
else
{
	#[自定义代码列表]
	$psize = 30;
	$pageid = intval($pageid);
	$offset = $pageid>0 ? ($pageid-1)*$psize : 0;
	$page_url = "admin.php?file=phpok&act=list";
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
			$condition .= " AND status>0";
		}
		else
		{
			$condition .= " AND status=0";
		}
	}
	$count = $C_Phpok->NumPhpok($condition);
	$adlist = $C_Phpok->GetPhpok("list",$condition,$offset,$psize);
	$pagelist = page($page_url,$count,$psize,$pageid);#[获取页数信息]
}
$TPL->p("phpok","phpok");
?>