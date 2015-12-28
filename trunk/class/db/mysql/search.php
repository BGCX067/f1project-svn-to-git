<?php
#=====================================================================
#	Filename: class/db/mysql/msg.php
#	Note	: 内容信息表
#	Version : 3.0
#	Author  : qinggan
#	Update  : 2008-7-13
#=====================================================================
class C_Search
{
	var $DB;
	var $prefix = "yui_";
	var $orderby = "m.taxis DESC,m.id DESC";
	var $offset = 0;
	var $psize = 30;
	var $condition = "";
	#[构造函数]
	function __construct($DB,$prefix="yui_")
	{
		$this->DB = $DB;
		$this->prefix = $prefix;
	}

	function C_Search($DB,$prefix="yui_")
	{
		$this->__construct($DB,$prefix);
	}

	function Set($var,$value)
	{
		$this->$var = $value;
	}

	function GetSearch($condition="",$offset=0,$psize=30)
	{
		$condition = $condition ? " WHERE ".$condition : "";
		$sql = "SELECT m.*,c.catename FROM ".$this->prefix."msg m LEFT JOIN ".$this->prefix."category c ON m.cateid=c.id ".$condition;
		$sql.= " ORDER BY ".$this->orderby;
		$sql .= " LIMIT ".$this->offset.",".$this->psize;
		return $this->DB->GetAll($sql);
	}

	function GetCount($condition="")
	{
		$condition = $condition ? " WHERE ".$condition : "";
		$sql = "SELECT count(m.id) FROM ".$this->prefix."msg m LEFT JOIN ".$this->prefix."category c ON m.cateid=c.id ".$condition;
		return $this->DB->Count($sql);
	}
}
?>