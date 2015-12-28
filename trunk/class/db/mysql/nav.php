<?php
#=====================================================================
#	Filename: class/db/mysql/nav.php
#	Note	: 投票管理
#	Version : 3.0
#	Author  : qinggan
#	Update  : 2008-09-20
#=====================================================================
class C_Nav
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
		$this->table = $prefix."nav";
	}

	#[兼容PHP4操作]
	Function C_Nav($DB,$prefix="yui_")
	{
		$this->__construct($DB,$prefix);
	}

	Function Set($var,$val)
	{
		$this->$var = $val;
	}

	#[获取附件数据]
	Function GetNav($type="one",$condition="",$offset=0,$psize=30)
	{
		$sql = "SELECT ".$this->fields." FROM ".$this->table." ";
		if($condition)
		{
			$sql .= " WHERE ".$condition;
		}
		$sql .= " ORDER BY taxis ASC,id DESC ";
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
	Function SetNav($array,$id=0)
	{
		if($id)
		{
			$sql = "UPDATE ".$this->table." SET name='".$array["name"]."',css='".$array["css"]."'";
			$sql.= ",url='".$array["url"]."',target='".$array["target"]."',taxis='".$array["taxis"]."'";
			$sql.= " WHERE id='".$id."'";
			return $this->DB->Query($sql);
		}
		else
		{
			$sql = "INSERT INTO ".$this->table."(name,css,url,target,taxis) VALUES(";
			$sql.= "'".$array["name"]."','".$array["css"]."','".$array["url"]."'";
			$sql.= ",'".$array["target"]."','".$array["taxis"]."')";
			return $this->DB->Insert($sql);
		}
	}

	Function DelNav($id)
	{
		if(!$id)
		{
			return false;
		}
		$sql = "DELETE FROM ".$this->table." WHERE id='".$id."'";
		return $this->DB->Query($sql);
	}

	Function NumNav($condition="")
	{
		$condition = $condition ? " WHERE ".$condition : "";
		$sql = "SELECT count(id) FROM ".$this->table." ".$condition;
		return $this->DB->Count($sql);
	}
}
?>