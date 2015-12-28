<?php
#[投票管理]
if($sysact == "add")
{
	$vote_array = array(0,1,2,3,4,5,6,7,8,9);#[创建数组]
}
elseif($sysact == "addok")
{
	$r_url = "admin.php?file=vote&act=add";
	$o_url = "admin.php?file=vote&act=list";
	$array = array();
	$array["subject"] = $STR->safe($subject);
	if(!$array["subject"])
	{
		Error("投票主题不能为空！",$r_url);
	}
	$array["vtype"] = $STR->safe($vtype);
	if($array["vtype"] != "single" && $array["vtype"] != "pl")
	{
		$array["vtype"] == "pl";
	}
	$vtype = $array["vtype"];
	$array["voteid"] = 0;
	$array["ifcheck"] = 1;
	$array["vcount"] = 0;
	$C_Vote = $CF->build("vote");
	#[写入主题]
	$id = $C_Vote->SetVote($array);
	if(!$id)
	{
		Error("写入失败....",$r_url);
	}
	#[写入选项]
	$vote_array = array(0,1,2,3,4,5,6,7,8,9);#[创建数组]
	foreach($vote_array AS $key=>$value)
	{
		$array = array();
		$array["subject"] = $STR->safe($_POST["subject_".$value]);
		$array["ifcheck"] = isset($_POST["ifcheck_".$value]) ? 1 : 0;
		$array["vcount"] = intval($_POST["hits_".$value]);
		$array["vtype"] = $vtype;
		$array["voteid"] = $id;
		if($array["subject"])
		{
			$C_Vote->SetVote($array);
		}
	}
	Error("新投票已经添加成功！",$o_url);
}
elseif($sysact == "modify")
{
	$r_url = "admin.php?file=vote&act=list";
	$id = intval($id);
	if(!$id)
	{
		Error("操作非法！",$r_url);
	}
	$vote_array = array(0,1,2,3,4,5,6,7,8,9);#[创建数组]
	$C_Vote = $CF->build("vote");
	$rs = $C_Vote->GetVote("one","id='".$id."' AND voteid='0'");
	if(!$rs)
	{
		Error("操作不正确，无法取得数据！",$r_url);
	}
	$rslist = $C_Vote->GetVote("all","voteid='".$id."'");
}
elseif($sysact == "modifyok")
{
	$r_url = "admin.php?file=vote&act=list";
	$id = intval($id);
	if(!$id)
	{
		Error("操作非法！",$r_url);
	}
	$r_url = "admin.php?file=vote&act=modify&id=".$id;
	$subject = $STR->safe($subject) ? $STR->safe($subject) : Error("投票主题不能为空",$r_url);
	$vtype = $STR->safe($vtype);
	$C_Vote = $CF->build("vote");
	#[更新选项]
	$rslist = $C_Vote->GetVote("all","voteid='".$id."'");
	foreach($rslist AS $key=>$value)
	{
		$tmpArray = array();
		$tmpArray["subject"] = $STR->safe($_POST["vsubject_".$value["id"]]);
		$tmpArray["vcount"] = intval($_POST["vhits_".$value["id"]]);
		$tmpArray["ifcheck"] = isset($_POST["vifcheck_".$value["id"]]) ? 1 : 0;
		$tmpArray["voteid"] = $id;
		$tmpArray["vtype"] = $vtype;
		if($tmpArray["subject"])
		{
			$C_Vote->SetVote($tmpArray,$value["id"]);
		}
		else
		{
			$C_Vote->DelVote($value["id"]);
		}
	}
	$vsubject ="";
	$vote_array = array(0,1,2,3,4,5,6,7,8,9);#[创建数组]
	foreach($vote_array AS $key=>$value)
	{
		$tmpArray = array();
		$tmpArray["subject"] = $STR->safe($_POST["subject_".$value]);
		$tmpArray["ifcheck"] = isset($_POST["ifcheck_".$value]) ? 1 : 0;
		$tmpArray["vcount"] = intval($_POST["hits_".$value]);
		$tmpArray["voteid"] = $id;
		$tmpArray["vtype"] = $vtype;
		if($vsubject)
		{
			$C_Vote->SetVote($tmpArray);
		}
	}
	$array = array();
	$array["subject"] = $subject;
	$array["vtype"] = $vtype;
	$array["vcount"] = $C_Vote->CountVote($id);#[取得投票用户总数]
	$array["voteid"] = 0;
	$array["ifcheck"] = 1;
	$C_Vote->SetVote($array,$id);
	Error("投票选项更新成功！","admin.php?file=vote&act=list");
}
elseif($sysact == "delete")
{
	$r_url = "admin.php?file=vote&act=list";
	$id = intval($id);
	if(!$id)
	{
		Error("操作非法！","admin.php?file=vote&act=list");
	}
	$C_Vote = $CF->build("vote");
	$C_Vote->DelVote($id) ? Error("投票删除成功",$r_url) : Error("投票删除失败",$r_url);
}
else
{
	$C_Vote = $CF->build("vote");
	$rslist = $C_Vote->GetVote("all","voteid='0'");
}
$TPL->p("vote","vote");
?>