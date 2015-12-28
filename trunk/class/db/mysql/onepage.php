<?php
#=====================================================================
#	Filename: class/db/mysql/onepage.php
#	Note	: 单页面文档管理
#	Version : 3.0
#	Author  : qinggan
#	Update  : 2008-07-13
#=====================================================================
class C_Onepage
{
	var $DB;
	var $prefix = "yui_";
	var $table = "yui_onepage";
	var $fields = "*";
	var $orderby = "taxis ASC,id DESC";
	var $condition = "";
	#[构造函数]
	function __construct($DB,$prefix="yui_")
	{
		$this->DB = $DB;
		$this->prefix = $prefix;
		$this->table = $prefix."onepage";
	}

	function C_Onepage($DB,$prefix="yui_")
	{
		$this->__construct($DB,$prefix);
	}

	function Set($var,$value)
	{
		$this->$var = $value;
	}

	function GetOnepage($type="one",$offset=0,$psize=30)
	{
		$condition = $this->condition ? " WHERE ".$this->condition : "";
		$sql = "SELECT ".$this->fields." FROM ".$this->table." ".$condition;
		$sql.= " ORDER BY ".$this->orderby;
		if($type == "list")
		{
			$sql .= " LIMIT ".$offset.",".$psize;
			return $this->DB->GetAll($sql);
		}
		else
		{
			return $type == "one" ? $this->DB->GetOne($sql) : $this->DB->GetAll($sql);
		}
	}

	function SetOnepage($array,$id=0)
	{
		if($id)
		{
			$sql = "UPDATE ".$this->table." SET groupid='".$array["groupid"]."',subject='".$array["subject"]."',style='".$array["style"]."',content='".$array["content"]."',url='".$array["url"]."',taxis='".$array["taxis"]."',ifcheck='".$array["ifcheck"]."',tpl='".$array["tpl"]."' WHERE id='".$id."'";
			return $this->DB->Query($sql);
		}
		else
		{
			$sql = "INSERT INTO ".$this->table."(groupid,subject,style,content,url,taxis,ifcheck,tpl) VALUES('".$array["groupid"]."','".$array["subject"]."','".$array["style"]."','".$array["content"]."','".$array["url"]."','".$array["taxis"]."','".$array["ifcheck"]."','".$array["tpl"]."')";
			return $this->DB->Insert($sql);
		}
	}

	function DelOnepage($id)
	{
		if(!$id)
		{
			return false;
		}
		$sql = "DELETE FROM ".$this->table." WHERE id='".$id."'";
		return $this->DB->Query($sql);
	}

	function GetOnegroup($type="one")
	{
		$condition = $this->condition ? " WHERE ".$this->condition : "";
		$sql = "SELECT * FROM ".$this->prefix."onegroup ".$condition;
		$sql.= " ORDER BY id ASC";
		return $type == "one" ? $this->DB->GetOne($sql) : $this->DB->GetAll($sql);
	}

	function SetOnegroup($array,$id=0)
	{
		if($id)
		{
			$sql = "UPDATE ".$this->prefix."onegroup SET groupname='".$array["groupname"]."' WHERE id='".$id."'";
			return $this->DB->Query($sql);
		}
		else
		{
			$sql = "INSERT INTO ".$this->prefix."onegroup(groupname) VALUES('".$array["groupname"]."')";
			return $this->DB->Insert($sql);
		}
	}

	function DelOnegroup($id)
	{
		if(!$id)
		{
			return false;
		}
		$sql = "DELETE FROM ".$this->prefix."onegroup WHERE id='".$id."'";
		return $this->DB->Query($sql);
	}
}
?>