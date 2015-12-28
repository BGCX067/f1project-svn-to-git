<?php
#============================
#	Filename: qgmod.func.php
#	Note	: 模块管理
#	Version : 2.0
#	Author  : qinggan
#	Update  : 2008-03-04
#============================
#[获取留言本信息]
#[num：显示的数量]
#[iscache：是否启用缓存，默认为是，下同]
function QGMOD_BOOK($num=10,$iscache=true)
{
	include(SYSTEM_ROOT."/include/module/book.qgmod.php");
	return $booklist;
}

#[获取专题/单页面信息]
#[special_id：专题/单页面ID号，不能为空]
#[iscache：是否启用缓存，默认为是，下同]
function QGMOD_SPECIAL($special_id,$iscache=true)
{
	include(SYSTEM_ROOT."/include/module/special.qgmod.php");
	return $special;
}

#[专题组下面的单页面]
#[groupid：分组ID]
#[iscache：是否启用缓存，默认为是]
function QGMOD_SPECIAL_LIST($groupid,$iscache=true)
{
	include(SYSTEM_ROOT."/include/module/spelist.qgmod.php");
	return $spelist;
}

#[播放器，具体可参考模板：inc.picplayer.tpl.php]
function QGMOD_PLAYER()
{
	include(SYSTEM_ROOT."/include/module/picplayer.qgmod.php");
	return $playerlist;
}

#[调用通知信息]
#[title_length：标题长度，0表示不限制]
#[msg_length：内容长度，去除HTML，图片等功能，0不限制非HTML的内容长度]
#[limit：限制条数，默认10]
#[iscache：是否启用缓存，默认为是]
function QGMOD_NOTICE($title_length=0,$msg_length=0,$limit=10,$iscache=true)
{
	include(SYSTEM_ROOT."/include/module/notice.qgmod.php");
	return $notice;
}
#[调用列表信息]
#[cateid：分类ID，多个分类ID用英文逗号隔开，自动获取其子分类的内容]
#[cateid支持article,picture,download,product四个参数，将会调用该类型的信息]
#[length：标题长度限制]
#[orderby：排序，支持 news,hot,cold,vouch,best 五个基本参数，支持基本的SQL排序参数]
#[orderby 同时支持自定义排序，前提是您得熟悉相应的数据库表字段]
#[limit：限制条数，默认10]
#[iscache：是否启用缓存，默认为是]
function QGMOD_MSGLIST($cateid,$length=60,$orderby="",$limit=10,$iscache=true)
{
	include(SYSTEM_ROOT."/include/module/msglist.qgmod.php");
	//var_dump($list);
	
	return $list;
}

#[显示友情链接]
#[groupid：组ID]
#[type：支持 all,pic,txt 三个类型]
#[iscache：是否启用缓存，默认为是]
function QGMOD_LINK($groupid,$type="pic",$iscache=true)
{
	include(SYSTEM_ROOT."/include/module/link.qgmod.php");

	return $list;
}

#[调用自定义代码]
#[id：自定义代码ID]
#[iscache：是否启用缓存，默认为是]
function QGMOD_AD($id,$iscache=true)
{
	return QGMOD_PHPOK($id,$iscache);
}

function QGMOD_PHPOK($id,$iscache=true)
{
	include(SYSTEM_ROOT."/include/module/phpok.qgmod.php");
	return $phpok;
}

#[读取指定的分类ID信息]
#[cateid：分类ID，多个分类ID用英文逗号隔开]
#[type：类型，仅支持onepage和category两类]
#[iscache：是否启用缓存，默认为是]
function QGMOD_CATELIST($cateid,$type="onepage",$iscache=true)
{
	include(SYSTEM_ROOT."/include/module/catelist.qgmod.php");
	return $catelist;
}

#[根据分类ID得到下级相关菜单，支持二级菜单显示]
#[cateid：分类ID]
#[iscache：是否启用缓存，默认为是]
#[rs：当前分类ID的数据，默认为否]
#[rslist是否有提供可排列的数据，默认为否]
function QGMOD_CATEGORY($cateid,$iscache=true,$rs=false,$rslist=false)
{
	include(SYSTEM_ROOT."/include/module/category.qgmod.php");
	return $catelist;
}

#[根据父类ID，得到下一级的子类ID列表]
#[cateid：分类ID]
#[iscache：是否启用缓存，默认为是]
function QGMOD_SONCATE($cateid,$iscache=true)
{
	include(SYSTEM_ROOT."/include/module/soncate.qgmod.php");
	return $catelist;
}

#[投票统计]
#[vote_id：投票ID号]
#[iscache：是否启用缓存，默认为是]
function QGMOD_VOTE($vote_id,$iscache=true)
{
	include("include/module/vote.qgmod.php");
	return $vote;
}

#[显示上一主题和下一主题插件]
#[id为当前主题的ID]
#[cateid为当前主题ID对应的分类ID]
#[type为类型，下一主题用N,上一主题用P，注意要用大写]
#[limit指数量，默认是1，建议不要大于5]
#[iscache指是否启用缓存，默认为是]
#[说明，因为上下主题功能若使用缓存会造成缓存文件太多，从而影响性能]
#[为了解决此问题，该功能使用的缓存是单独出来的一个文件夹，并根据文件长度进行分层级文件夹存储]
#[最多支持三级文件夹存储，对百万级别的缓存有了比较好的实现]
function QGMOD_NP($id=0,$cateid=0,$type="N",$limit=1,$iscache=true)
{
	include("include/module/np.qgmod.php");
	return $rslist;
}


#[显示导航信息]
function QGMOD_NAV()
{
	global $DB,$FS;
	if(file_exists("data/nav.php"))
	{
		include("data/nav.php");
	}
	else
	{
		global $CF;
		$C_Nav = $CF->build("nav");
		$qgnav = $C_Nav->GetNav("all");
		$FS->Write($qgnav,"data/nav.php","qgnav");
	}
	return $qgnav;
}

#[旧版的导航栏信息]
function QGMOD_HEAD()
{
	return QGMOD_NAV();
}

#[页脚统计]
function QGMOD_FOOT()
{
	global $DB,$FS;
	$end_time = explode(" ",microtime());
	$end_time = $end_time[0] + $end_time[1];
	$time_used = round($end_time - START_TIME,5);#[计算消耗时间]
	unset($end_time);
	$sqlCount = $DB->queryCount;
	$fileCount = $FS->readCount;
	$sql_count = $sqlCount > 1 ? $sqlCount." queries" : $sqlCount." query";
	$file_count = $fileCount > 1 ? $fileCount." files" : $fileCount." file";
	unset($DB,$FS,$sqlCount,$fileCount);
	$debugmsg = "Processed in ".$time_used." second(s), ".$sql_count.", ".$file_count;
	return $debugmsg;
}
?>