<?php
#=====================================================================
#	Filename: class/db/sqlite/notice.php
#	Note	: 站内公告
#	Version : 3.0
#	Author  : qinggan
#	Update  : 2008-05-30
#=====================================================================
class C_Notice
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
		$this->table = $prefix."notice";
	}

	#[兼容PHP4操作]
	Function C_Notice($DB,$prefix="yui_")
	{
		$this->__construct($DB,$prefix);
	}

	Function Set($var,$val)
	{
		$this->$var = $val;
	}

	#[获取公告数据]
	Function GetNotice($type="one",$condition="",$offset=0,$psize=30)
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

	#[添加或更新公告]
	Function SetNotice($array,$id=0)
	{
		if($id)
		{
			$sql = "UPDATE ".$this->table." SET subject='".$array["subject"]."',url='".$array["url"]."'";
			$sql.= ",style='".$array["style"]."'";
			$sql.= ",content='".$array["content"]."',postdate='".$array["postdate"]."' WHERE id='".$id."'";
			return $this->DB->Query($sql);
		}
		else
		{
			$sql = "INSERT INTO ".$this->table."(subject,url,style,content,postdate) VALUES(";
			$sql.= "'".$array["subject"]."','".$array["url"]."'";
			$sql.= ",'".$array["style"]."'";
			$sql.= ",'".$array["content"]."','".$array["postdate"]."')";
			return $this->DB->Insert($sql);
		}
	}

	Function DelNotice($id)
	{
		if(!$id)
		{
			return false;
		}
		$sql = "DELETE FROM ".$this->table." WHERE id='".$id."'";
		return $this->DB->Query($sql);
	}
}
?>