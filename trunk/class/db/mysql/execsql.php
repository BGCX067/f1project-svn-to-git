<?php
#=====================================================================
#	Filename: class/db/mysql/execsql.php
#	Note	: 查询复杂的SQL语句，如带有联合等的模询
#	Version : 3.0
#	Author  : qinggan
#	Update  : 2008-08-27
#=====================================================================
class C_Execsql
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
	#[更新时间：2008-09-24]
	function C_Execsql($DB,$prefix="yui_")
	{
		$this->__construct($DB,$prefix);
	}

	function Set($var,$value)
	{
		$this->$var = $value;
	}

	#[取得数量]
	function GetList($sql,$offset=0,$psize=30)
	{
		#[执行检测]
		if(!$sql)
		{
			return false;
		}
		$sql .= " LIMIT ".$offset.",".$psize;
		return $this->DB->GetAll($sql);
	}
	#[取得全部]
	function GetAll($sql)
	{
		if(!$sql)
		{
			return false;
		}
		return $this->DB->GetAll($sql);
	}

	#[只取得一条信息]
	function GetOne($sql)
	{
		if(!$sql)
		{
			return false;
		}
		return $this->DB->GetOne($sql);
	}

	#[取得数量]
	function GetNum($sql)
	{
		if(!$sql)
		{
			return false;
		}
		return $this->DB->Count($sql);
	}
}
?>