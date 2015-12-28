<?php
#=====================================================================
#	Filename: class/db/mysql/driver.php
#	Note	: 留言信息操作
#	Version : 3.0
#	Author  : qinggan
#	Update  : 2008-07-13
#=====================================================================
class C_Driver
{
	var $DB;
	var $table;
	var $prefix;
	var $fields = "*";
	#[初始化]
	function __construct($DB,$prefix="yui_")
	{
		$this->DB = $DB;
		$this->prefix = $prefix;
		$this->table = $prefix."driver";
	}

	#[兼容PHP4操作]
	function C_Book($DB,$prefix="yui_")
	{
		$this->__construct($DB,$prefix);
	}

	function Set($var,$value)
	{
		$this->$var = $value;
	}

	#[获取管理员数据]
	function GetBook($type="one",$condition="",$offset=0,$psize=30)
	{
		$sql = "SELECT ".$this->fields." FROM ".$this->table." ";
		if($condition)
		{
			$sql .= " WHERE ".$condition;
		}
		$sql .= " ORDER BY postdate DESC,id DESC";
		if($type == "one")
		{
			$rs = $this->DB->GetOne($sql);#[取得信息]
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
	function UpdateBook($array,$id=0)
	{
		if(!$id)
		{
			return false;
		}
		$sql = "UPDATE ".$this->table." SET user='".$array["user"]."',subject='".$array["subject"]."',content='".$array["content"]."',postdate='".$array["postdate"]."',email='".$array["email"]."',ifcheck='".$array["ifcheck"]."',phone='".$array["phone"]."' WHERE id='".$id."'";
		return $this->DB->Query($sql);
	}

	#[添加]
	function InsertBook($array)
	{
		if(!$array || !is_array($array))
		{
			return false;
		}
		$sql = "INSERT INTO ".$this->table."(user,subject,content,postdate,phone,email,ifcheck,holder) VALUES ('".$array["user"]."','".$array["subject"]."','".$array["content"]."','".$array["postdate"]."','".$array["phone"]."','".$array["email"]."','".$array["ifcheck"]."','".$array["IsNotDriver"]."')";
		return $this->DB->Insert($sql);
	}

	function DelBook($id)
	{
		if(!$id)
		{
			return false;
		}
		$ext = strpos($id,",") !== false ? " id IN(".$id.")" : " id='".$id."'";
		$sql = "DELETE FROM ".$this->table." WHERE ".$ext;
		return $this->DB->Query($sql);
	}

	#[更新状态]
	function IfcheckBook($id,$ifcheck=0)
	{
		if(!$id)
		{
			return false;
		}
		$ext = strpos($id,",") !== false ? " id IN(".$id.")" : " id='".$id."'";
		$sql = "UPDATE ".$this->table." SET ifcheck='".$ifcheck."' WHERE ".$ext;
		return $this->DB->Query($sql);
	}

	function CountBook($condition="")
	{
		$sql = "SELECT count(id) AS c FROM ".$this->table;
		if($condition)
		{
			$sql.= " WHERE ".$condition;
		}
		return $this->DB->Count($sql);
	}
	
	function Query($sql)
	{
		return $this->DB->Query($sql);
	}
}
?>