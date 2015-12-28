<?php
#=====================================================================
#	Filename: include/db/mysql/category_mysql.class.php
#	Note	: 管理员信息管理
#	Version : 3.0
#	Author  : qinggan
#	Update  : 2008-05-04
#=====================================================================
class C_Category
{
	var $DB;
	var $prefix = "yui_";
	var $table;
	var $fields = "*";

	#[构造函数]
	function __construct($DB,$prefix="yui_")
	{
		$this->DB = $DB;
		$this->prefix = $prefix;
		$this->table = $prefix."category";
	}

	function C_Category($DB,$prefix="yui_")
	{
		$this->__construct($DB,$prefix);
	}

	function Set($var,$value)
	{
		$this->$var = $value;
	}

	function GetCategory($type="list",$condition="",$offset=0,$psize=30)
	{
		$condition = $condition ? " WHERE ".$condition : "";
		$sql = "SELECT ".$this->fields." FROM ".$this->table." ".$condition;
		$sql.= " ORDER BY catetype ASC,taxis ASC,id DESC";
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

	function SetCategory($array,$id=0)
	{
		if($id)
		{
			$sql = "UPDATE ".$this->table." SET rootid='".$array["rootid"]."',";
			$sql.= "parentid='".$array["parentid"]."',";
			$sql.= "catename='".$array["catename"]."',";
			$sql.= "catestyle='".$array["catestyle"]."',";
			$sql.= "taxis='".$array["taxis"]."',tpl_index='".$array["tpl_index"]."',";
			$sql.= "tpl_list='".$array["tpl_list"]."',tpl_msg='".$array["tpl_msg"]."',";
			$sql.= "ifcheck='".$array["ifcheck"]."',";
			$sql.= "keywords='".$array["keywords"]."',";
			$sql.= "description='".$array["description"]."',";
			$sql.= "note='".$array["note"]."',";
			$sql.= "psize='".$array["psize"]."' WHERE id='".$id."'";
			return $this->DB->Query($sql);
		}
		else
		{
			$sql = "INSERT INTO ".$this->table;
			$sql.= "(catetype,rootid,parentid,catename,catestyle,";
			$sql.= "taxis,tpl_index,tpl_list,tpl_msg,ifcheck,psize,";
			$sql.= "keywords,description,note)";
			$sql.= " VALUES('".$array["catetype"]."','".$array["rootid"]."',";
			$sql.= "'".$array["parentid"]."','".$array["catename"]."',";
			$sql.= "'".$array["catestyle"]."','".$array["taxis"]."',";
			$sql.= "'".$array["tpl_index"]."','".$array["tpl_list"]."',";
			$sql.= "'".$array["tpl_msg"]."',";
			$sql.= "'".$array["ifcheck"]."','".$array["psize"]."',";
			$sql.= "'".$array["keywords"]."','".$array["description"]."','".$array["note"]."')";
			return $this->DB->Insert($sql);
		}
	}

	Function DelCategory($id)
	{
		$sql = "DELETE FROM ".$this->table." WHERE id='".$id."'";
		return $this->DB->query($sql);
	}

	Function GetCateTypeList()
	{
		$array["article"] = "文章";
		$array["picture"] = "图片";
		$array["download"] = "下载";
		$array["product"] = "产品";
		return $array;
		/*$rslist = $this->DB->GetAll("DESCRIBE ".$this->table);
		if(!$rslist)
		{
			return false;
		}
		foreach($rslist AS $key=>$value)
		{
			if($value["Field"] == "catetype")
			{
				$type = $value["Type"];
			}
		}
		if(!$type)
		{
			return false;
		}
		$type = str_replace("'","",$type);
		$type = preg_replace("/enum\((.+?)\)/is","\\1",$type);
		if(!$type)
		{
			return false;
		}
		return explode(",",$type);*/
	}

	#[更新父子分类ID]
	Function UpdateCateSon($id,$rootid,$parentid)
	{
		if(!$id)
		{
			return false;
		}
		$sql = "UPDATE ".$this->table." SET rootid='".$rootid."',";
		$sql.= "parendid='".$parentid."' WHERE id='".$id."'";
		return $this->DB->Query($sql);
	}

	Function UpdateCateParent($id,$parentid)
	{
		if(!$id)
		{
			return false;
		}
		$sql = "UPDATE ".$this->table." SET parendid='".$parentid."'";
		$sql.= " WHERE parendid='".$id."'";
		return $this->DB->Query($sql);
	}

	Function UpdateCateRoot($rootid,$parentid)
	{
		$sql = "UPDATE ".$this->table." SET rootid='".$rootid."' WHERE parentid IN(".$parentid.")";
		return $this->DB->Query($sql);
	}
}
?>