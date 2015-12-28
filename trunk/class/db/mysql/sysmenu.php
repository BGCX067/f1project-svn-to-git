<?php
#=====================================================================
#	Filename: include/db/mysql/adminer_mysql.class.php
#	Note	: 管理员信息管理
#	Version : 3.0
#	Author  : qinggan
#	Update  : 2008-05-04
#=====================================================================
class C_Sysmenu
{
	var $DB;
	var $prefix = "yui_";
	var $table;

	#[构造函数]
	function __construct($DB,$prefix="yui_")
	{
		$this->DB = $DB;
		$this->prefix = $prefix;
		$this->table = $prefix."sysmenu";
	}

	function C_Sysmenu($DB,$prefix="yui_")
	{
		$this->__construct($DB,$prefix);
	}

	function GetSysmenu($type="list",$condition="",$offset=0,$psize=30)
	{
		$condition = $condition ? " WHERE ".$condition : "";
		$sql = "SELECT * FROM ".$this->table." ".$condition;
		$sql.= " ORDER BY taxis ASC,id DESC";
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

	function SetSysmenu($array,$id=0)
	{
		if($id)
		{
			$sql = "UPDATE ".$this->table." SET rootid='".$array["rootid"]."',";
			$sql.= "parentid='".$array["parentid"]."',name='".$array["name"]."',";
			$sql.= "menu_url='".$array["menu_url"]."',";
			$sql.= "taxis='".$array["taxis"]."',status='".$array["status"]."' WHERE id='".$id."'";
			return $this->DB->Query($sql);
		}
		else
		{
			$sql = "INSERT INTO ".$this->table."(rootid,parentid,name,menu_url,taxis,";
			$sql.= "status) VALUES('".$array["rootid"]."','".$array["parentid"]."','".$array["name"]."',";
			$sql.= "'".$array["menu_url"]."','".$array["taxis"]."',";
			$sql.= "'".$array["status"]."')";
			return $this->DB->Insert($sql);
		}
	}

	function DelSysmenu($id)
	{
		$sql = "DELETE FROM ".$this->table." WHERE id='".$id."'";
		return $this->DB->query($sql);
	}
}
?>