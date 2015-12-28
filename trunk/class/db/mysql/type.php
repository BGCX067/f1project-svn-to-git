<?php
#=====================================================================
#	Filename: class/db/mysql/type.php
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

	function GetTyper

	#[取得文章数量]
	function GetLink($type="one",$condition="",$offset=0,$psize=30)
	{
		$sql = "SELECT * FROM ".$this->prefix."typer ".$condition;
		$sql.= " ORDER BY typeid ASC,taxis ASC,id DESC ";
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
	function SetLink($array,$id=0)
	{
		if($id)
		{
			$sql= "UPDATE ".$this->prefix."link SET typeid='".$array["typeid"]."',name='".$array["name"]."',url='".$array["url"]."',picture='".$array["picture"]."',taxis='".$array["taxis"]."',width='".$array["width"]."',height='".$array["height"]."' WHERE id='".$id."'";
			return $this->DB->Query($sql);
		}
		else
		{
			$sql = "INSERT INTO ".$this->prefix."link(typeid,name,url,picture,taxis,width,height) VALUES('".$array["typeid"]."','".$array["name"]."','".$array["url"]."','".$array["picture"]."','".$array["taxis"]."','".$array["width"]."','".$array["height"]."')";
			return $this->DB->Insert($sql);
		}
	}

	#[删除链接]
	function DelLink($id)
	{
		if(!$id)
		{
			return false;
		}
		$sql = "DELETE FROM ".$this->prefix."link WHERE id='".$id."'";
		return $this->DB->Query($sql);
	}

	#[取得数量]
	function NumLink()
	{
		$sql = "SELECT count(id) FROM ".$this->prefix."link";
		if($this->condition)
		{
			$sql .= " WHERE ".$this->condition;
		}
		return $this->DB->Count($sql);
	}

	#[获取链接组，如果有ID的话，就得到一条链接，否则得到全部]
	function GetGroup($id=0)
	{
		$sql = "SELECT * FROM ".$this->prefix."linktype";
		if($id)
		{
			$sql .= " WHERE id='".$id."'";
			return $this->DB->GetOne($sql);
		}
		else
		{
			$sql .= " ORDER BY id DESC";
			return $this->DB->GetAll($sql);
		}
	}

	#[更新组]
	function SetGroup($typename,$id=0)
	{
		if(!$typename)
		{
			return false;
		}
		if($id)
		{
			$sql = "UPDATE ".$this->prefix."linktype SET typename='".$typename."' WHERE id='".$id."'";
			return $this->DB->Query($sql);
		}
		else
		{
			$sql = "INSERT INTO ".$this->prefix."linktype(typename) VALUES('".$typename."')";
			return $this->DB->Insert($sql);
		}
	}

	#[删除组]
	function DelGroup($id)
	{
		if(!$id)
		{
			return false;
		}
		$sql = "DELETE FROM ".$this->prefix."linktype WHERE id='".$id."'";
		return $this->DB->Query($sql);
	}
}
?>