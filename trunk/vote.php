<?php
#[投票页面]
require_once("global.php");
$id = intval($id);
#[如果不存在ID时，系统提示错误]
if(empty($id))
{
	Error("操作非法","index.php");
}
$C_Vote = $CF->build("vote");
$rs = $C_Vote->GetVote("one","id='".$id."' AND voteid='0'");
if(!$rs)
{
	Error("没有找到投票信息","index.php");
}
#[判断是否已投票]
$isvote = false;
if($_COOKIE["voteid"] && $_COOKIE["voteid"] == $id)
{
	$isvote = true;
}

$vote_subject = $rs["subject"];
$vote_type = $rs["vtype"];
unset($rs);
$act = $STR->safe($act);
#[判断是否已经投票了]
if($act == "submit")
{
	if($isvote)
	{
		Error("您已经投过票了","vote.php?id=".$id."&act=view");
	}
	#[增加统计]
	$ifvote_status = false;
	if($vote_type == "single")
	{
		$voteid = intval($voteid);#[投票ID]
		$C_Vote->AddVote($voteid,$id);
		$ifvote_status = true;
	}
	else
	{
		$array = array();
		foreach((is_array($voteid) ? $voteid : $array) AS $key=>$value)
		{
			$value = intval($value);
			if($value)
			{
				$C_Vote->AddVote($value,$id);
				$ifvote_status = true;
			}
		}
	}
	#[写入Cookie信息]
	if($ifvote_status)
	{
		setcookie("voteid",$id);
		Error("投票成功！","vote.php?id=".$id."&act=view");
	}
}
#[获取投票总人数]
$vote_width = 500;
$total_count = $C_Vote->SumVote($id);
$rs = $C_Vote->GetVote("all","voteid='".$id."'");
if(!$rs)
{
	Error("没有投票选项","index.php");
}
$vote_list = array();
foreach($rs AS $key=>$value)
{
	$value["bili"] = $total_count>0 ? round($value["vcount"]/$total_count,4) : 0;#[设置比例]
	$value["img_width"] = $value["bili"] * $vote_width;
	$value["bili"] = $value["bili"] * 100;#[显示百分比]
	if($vote_type == "pl")
	{
		$value["vote_input"] = "<input type='checkbox' name='voteid[]' value='".$value["id"]."'";
	}
	else
	{
		$value["vote_input"] = "<input type='radio' name='voteid' value='".$value["id"]."'";
	}
	if($value["ifcheck"])
	{
		$value["vote_input"] .= " checked";
	}
	$value["vote_input"] .= ">";
	$vote_list[] = $value;
}

#[定义题头]
$site_title = "主题：".$vote_subject." - ".$system["sitename"];

#[导航栏]
$lead_menu[0]["url"] = "vote.php?id=".$id;
$lead_menu[0]["name"] = "投票：".$vote_subject;

$TPL->p("vote");
REWRITE();
?>