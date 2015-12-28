<?php
#==================================================================================================
#	Filename: class/db/sqlite/upfile.php
#	Note	: 附件数据库
#	Version : 3.0
#	Author  : qinggan
#	Update  : 2008-6-7
#==================================================================================================
class C_Upfile
{
	var $DB;
	var $table;
	var $prefix;
	var $fields = "*";#[查询的字段，默认是星号]
	#[初始化]
	Function __construct($DB,$prefix="yui_")
	{
		$this->DB = $DB;
		$this->prefix = $prefix;
		$this->table = $prefix."upfiles";
	}

	#[兼容PHP4操作]
	Function C_Upfile($DB,$prefix="yui_")
	{
		$this->__construct($DB,$prefix);
	}

	Function Set($var,$val)
	{
		$this->$var = $val;
	}

	#[获取附件数据]
	Function GetUpfile($type="one",$condition="",$offset=0,$psize=30)
	{
		$sql = "SELECT ".$this->fields." FROM ".$this->table." ";
		if($condition)
		{
			$sql .= " WHERE ".$condition;
		}
		$sql .= " ORDER BY id DESC ";
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

	#[添加或更新附件]
	Function SetUpfile($array,$id=0)
	{
		if($id)
		{
			$sql = "UPDATE ".$this->table." SET filetype='".$array["filetype"]."',tmpname='".$array["tmpname"]."'";
			$sql.= ",filename='".$array["filename"]."',folder='".$array["folder"]."'";
			$sql.= ",thumbfile='".$array["thumbfile"]."',markfile='".$array["markfile"]."' WHERE id='".$id."'";
			return $this->DB->Query($sql);
		}
		else
		{
			$sql = "INSERT INTO ".$this->table."(filetype,tmpname,filename,folder,postdate,thumbfile,markfile) VALUES(";
			$sql.= "'".$array["filetype"]."','".$array["tmpname"]."','".$array["filename"]."'";
			$sql.= ",'".$array["folder"]."','".$array["postdate"]."'";
			$sql.= ",'".$array["thumbfile"]."','".$array["markfile"]."')";
			return $this->DB->Insert($sql);
		}
	}

	Function DelUpfile($id)
	{
		if(!$id)
		{
			return false;
		}
		$sql = "DELETE FROM ".$this->table." WHERE id='".$id."'";
		return $this->DB->Query($sql);
	}

	Function NumUpfile($condition="")
	{
		$condition = $condition ? " WHERE ".$condition : "";
		$sql = "SELECT count(id) FROM ".$this->table." ".$condition;
		return $this->DB->Count($sql);
	}
}
?>