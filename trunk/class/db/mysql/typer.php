<?php
#=====================================================================
#	Filename: class/db/mysql/typer.php
#	Note	: 单页面－自定义链接－播放器分组管理
#	Version : 3.0
#	Author  : qinggan
#	Update  : 2008-12-18
#=====================================================================
class C_Typer
{
	var $DB;
	var $prefix;
	var $condition;

	#[构造函数]
	function __construct($DB,$prefix="yui_")
	{
		$this->DB = $DB;
		$this->prefix = $prefix;
	}

	#[兼容PHP4操作]
	function C_Typer($DB,$prefix="yui_")
	{
		$this->__construct($DB,$prefix);
	}

	function Set($var,$value)
	{
		$this->$var = $value;
	}


	#[取得文章数量]
	function GetTyper($type="one",$condition="",$offset=0,$psize=30)
	{
		$fields = $type == "num" ? "count(id)" : "*";
		$sql = "SELECT ".$fields." FROM ".$this->prefix."typer ";
		if($condition)
		{
			$sql .= " WHERE ".$condition;
		}
		if($type == "num")
		{
			return $this->DB->Count($sql);
		}
		$sql.= " ORDER BY types ASC,id DESC ";
		if($type == "one")
		{
			return $this->DB->GetOne($sql);
		}
		elseif($type == "list")
		{
			$sql.= " LIMIT ".$offset.",".$psize;
			return $this->DB->GetAll($sql);
		}
		else
		{
			return $this->DB->GetAll($sql);
		}
	}

	#[更新或添加链接]
	function SetTyper($array,$id=0)
	{
		if($id)
		{
			$sql= "UPDATE ".$this->prefix."typer SET types='".$array["types"]."',sign='".$array["sign"]."',name='".$array["name"]."',tpl='".$array["tpl"]."' WHERE id='".$id."'";
			return $this->DB->Query($sql);
		}
		else
		{
			$sql = "INSERT INTO ".$this->prefix."typer(types,sign,name,tpl) VALUES('".$array["types"]."','".$array["sign"]."','".$array["name"]."','".$array["tpl"]."')";
			return $this->DB->Insert($sql);
		}
	}

	#[删除链接]
	function DelTyper($id)
	{
		if(!$id)
		{
			return false;
		}
		$sql = "DELETE FROM ".$this->prefix."typer WHERE id='".$id."'";
		return $this->DB->Query($sql);
	}

	#[取得单页面的组]
	function GetTyperOnepage($type="all")
	{
		#
	}
}
?>