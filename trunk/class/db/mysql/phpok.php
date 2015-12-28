<?php
#=====================================================================
#	Filename: class/db/mysql/phpok.php
#	Note	: 自定义代码使用
#	Version : 3.0
#	Author  : qinggan
#	Update  : 2008-09-03
#=====================================================================
class C_Phpok
{
	var $DB;
	var $prefix = "yui_";
	var $fields = "*";

	#[构造函数]
	function __construct($DB,$prefix="yui_")
	{
		$this->DB = $DB;
		$this->prefix = $prefix;
	}

	#[兼容PHPOK4操作]
	#[修正时间：2008-09-24]
	function C_Phpok($DB,$prefix="yui_")
	{
		$this->__construct($DB,$prefix);
	}

	function fields($val)
	{
		$this->fields = $val;
	}

	function GetPhpok($type="one",$condition="",$offset=0,$psize=30)
	{
		$sql = "SELECT ".$this->fields." FROM ".$this->prefix."phpok";
		if($condition)
		{
			$sql .= " WHERE ".$condition;
		}
		$sql .= " ORDER BY id DESC";
		if($type == "one")
		{
			return $this->DB->GetOne($sql);
		}
		elseif($type == "list")
		{
			$sql .= " LIMIT ".$offset.",".$psize;
			return $this->DB->GetAll($sql);
		}
		else
		{
			return $this->DB->GetAll($sql);
		}
	}

	function NumPhpok($condition="")
	{
		$sql = "SELECT ".$this->fields." FROM ".$this->prefix."phpok";
		if($condition)
		{
			$sql .= " WHERE ".$condition;
		}
		return $this->DB->Count($sql);
	}

	function SetPhpok($array,$id=0)
	{
		if($id)
		{
			$sql = "UPDATE ".$this->prefix."phpok SET sign='".$array["sign"]."',subject='".$array["subject"]."',content='".$array["content"]."',status='".$array["status"]."' WHERE id='".$id."'";
			return $this->DB->Query($sql);
		}
		else
		{
			$sql = "INSERT INTO ".$this->prefix."phpok(sign,subject,content,status) VALUES('".$array["sign"]."','".$array["subject"]."','".$array["content"]."','".$array["status"]."')";
			return $this->DB->Query($sql);
		}
	}

	function DelPhpok($id)
	{
		if(!$id)
		{
			return false;
		}
		$sql = "DELETE FROM ".$this->prefix."phpok WHERE id='".$id."'";
		return $this->DB->Query($sql);
	}

	function StatusPhpok($status,$id)
	{
		if(!$id)
		{
			return false;
		}
		$status = intval($status);
		$sql = "UPDATE ".$this->prefix."phpok SET status='".$status."' WHERE id='".$id."'";
		return $this->DB->Query($sql);
	}
}
?>