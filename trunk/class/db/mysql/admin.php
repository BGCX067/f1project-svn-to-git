<?php
#=====================================================================
#	Filename: class/db/mysql/admin.php
#	Note	: 管理员数据库相关操作
#	Version : 3.0
#	Author  : qinggan
#	Update  : 2008-09-24
#=====================================================================
class C_Admin
{
	var $DB;
	var $table;
	var $prefix;
	#[初始化]
	function __construct($DB,$prefix="yui_")
	{
		$this->DB = $DB;
		$this->prefix = $prefix;
		$this->table = $prefix."admin";
	}

	#[兼容PHP4操作]
	function C_Admin($DB,$prefix="yui_")
	{
		$this->__construct($DB,$prefix);
	}

	#[获取管理员数据]
	function GetAdmin($type="one",$condition="",$offset=0,$psize=30)
	{
		$sql = "SELECT * FROM ".$this->table." ";
		if($condition)
		{
			$sql .= " WHERE ".$condition;
		}
		if($type == "one")
		{
			$rs = $this->DB->GetOne($sql);#[取得管理员信息]
		}
		elseif($type == "list")
		{
			$sql .= " LIMIT ".$offset.",".$psize;
			$rs = $this->DB->GetAll($sql);
		}
		elseif($type == "all")
		{
			$rs = $this->DB->GetAll($sql);
		}
		else
		{
			return false;
		}
		if(!$rs)
		{
			return false;
		}
		return $rs;
	}

	#[更新管理员]
	function UpdateAdmin($array,$id=0)
	{
		if(!$id)
		{
			return false;
		}
		$sql = "UPDATE ".$this->table." SET typer='".$array["typer"]."',user='".$array["user"]."'";
		$sql.= ",pass='".$array["pass"]."',email='".$array["email"]."',modulelist='".$array["modulelist"]."'";
		$sql.= " WHERE id='".$id."'";
		return $this->DB->Query($sql);
	}

	#[添加管理员]
	function InsertAdmin($array)
	{
		if(!$array || !is_array($array))
		{
			return false;
		}
		$sql = "INSERT INTO ".$this->table."(typer,user,pass,email,modulelist) VALUES(";
		$sql.= "'".$array["typer"]."','".$array["user"]."','".$array["pass"]."',";
		$sql.= "'".$array["email"]."','".$array["modulelist"]."')";
		return $this->DB->Query($sql);
	}

	function DelAdmin($id)
	{
		if(!$id)
		{
			return false;
		}
		$sql = "DELETE FROM ".$this->table." WHERE id='".$id."'";
		return $this->DB->Query($sql);
	}

	#[更新管理员密码]
	function PassAdmin($newpass,$id)
	{
		$sql = "UPDATE ".$this->table." SET pass='".$newpass."' WHERE id='".$id."'";
		return $this->DB->Query($sql);
	}
}
?>