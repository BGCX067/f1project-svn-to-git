<?php
#=====================================================================
#	Filename: class/db/mysql/module.php
#	Note	: 调用模块里的复杂查询语句
#	Version : 3.0
#	Author  : qinggan
#	Update  : 2008-08-27
#=====================================================================
class C_Module
{
	var $DB;
	var $prefix;

	#[构造函数]
	function __construct($DB,$prefix="yui_")
	{
		$this->DB = $DB;
		$this->prefix = $prefix;
	}
	#[兼容PHP4操作]
	#[修正时间：2008-09-24]
	function C_Module($DB,$prefix="yui_")
	{
		$this->__construct($DB,$prefix);
	}

	function Set($var,$value)
	{
		$this->$var = $value;
	}

	#[取得文章数量]
	function GetMsgList($cateid="",$orderby="",$limit=10)
	{
		$sql = "SELECT m.*,c.catename FROM ".$this->prefix."msg m LEFT JOIN ".$this->prefix."category c ON m.cateid=c.id WHERE m.ifcheck='1'";
		if($cateid)
		{
			$sql .= " AND (c.id IN(".$cateid.") OR c.rootid IN(".$cateid.") OR c.parentid IN(".$cateid."))";
		}
		#[排序：news,hot,cold,vouch,best]
		if(strpos(",new,hot,cold,vouch,top,best,",",".$orderby.",") !== false)
		{
			$sqlOrderBy = "m.istop DESC,";
			if($orderby == "hot")
			{
				$sqlOrderBy .= "m.hits DESC,";
			}
			elseif($orderby == "cold")
			{
				$sqlOrderBy .= "m.hits ASC,";
			}
			elseif($orderby == "vouch")
			{
				$sqlOrderBy .= "m.isvouch DESC,";
			}
			elseif($orderby == "best")
			{
				$sqlOrderBy .= "m.isbest DESC,";
			}
			$sqlOrderBy .= "m.taxis DESC,m.postdate DESC,m.id DESC";
		}
		else
		{
			#[自定义的排序]
			$sqlOrderBy .= $this->_____OrderBy($orderby);
		}
		if($sqlOrderBy)
		{
			$sql .= " ORDER BY ".$sqlOrderBy;
		}
		$sql .= $limit>0 ? " LIMIT ".$limit : " LIMIT 10";
		return $this->DB->GetAll($sql);
	}

	#[这个函数仅限内部调用]
	function _____OrderBy($orderby,$table="m")
	{
		if(!$orderby)
		{
			return false;
		}
		$order_list = array();
		$array = explode(",",$orderby);
		foreach($array AS $key=>$value)
		{
			$value = trim($value);
			if($value)
			{
				$order_list[] = $table ? ($table.".".$value) : $value;
			}
		}
		if(count($order_list)<1)
		{
			return false;
		}
		return implode(",",$order_list);
	}
}
?>