<?php
#==================================================================================================
#	Filename: class/db/mysql/vote.php
#	Note	: 投票管理
#	Version : 3.0
#	Author  : qinggan
#	Update  : 2008-08-21
#==================================================================================================
class C_Vote
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
		$this->table = $prefix."vote";
	}

	#[兼容PHP4操作]
	Function C_Vote($DB,$prefix="yui_")
	{
		$this->__construct($DB,$prefix);
	}

	Function Set($var,$val)
	{
		$this->$var = $val;
	}

	#[获取附件数据]
	Function GetVote($type="one",$condition="",$offset=0,$psize=30)
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
	Function SetVote($array,$id=0)
	{
		if($id)
		{
			$sql = "UPDATE ".$this->table." SET subject='".$array["subject"]."',vtype='".$array["vtype"]."'";
			$sql.= ",vcount='".$array["vcount"]."',ifcheck='".$array["ifcheck"]."'";
			$sql.= " WHERE id='".$id."'";
			return $this->DB->Query($sql);
		}
		else
		{
			$sql = "INSERT INTO ".$this->table."(voteid,subject,vtype,vcount,ifcheck) VALUES(";
			$sql.= "'".$array["voteid"]."','".$array["subject"]."','".$array["vtype"]."'";
			$sql.= ",'".$array["vcount"]."','".$array["ifcheck"]."')";
			return $this->DB->Insert($sql);
		}
	}

	Function DelVote($id)
	{
		if(!$id)
		{
			return false;
		}
		$sql = "DELETE FROM ".$this->table." WHERE id='".$id."' OR voteid='".$id."'";
		return $this->DB->Query($sql);
	}

	Function NumVote($condition="")
	{
		$condition = $condition ? " WHERE ".$condition : "";
		$sql = "SELECT count(id) FROM ".$this->table." ".$condition;
		return $this->DB->Count($sql);
	}

	Function CountVote($voteid)
	{
		$sql = "SELECT sum(vcount) vcount FROM ".$this->table." WHERE voteid='".$voteid."'";
		$rs = $this->DB->GetOne($sql);
		return intval($rs["vcount"]);
	}

	#[id是指投票的ID]
	#[voteid是指该投票对应的主题ID]
	Function AddVote($id,$voteid)
	{
		$sql = "UPDATE ".$this->table." SET vcount=vcount+1 WHERE voteid='".$voteid."' AND id='".$id."'";
		return $this->DB->Query($sql);
	}

	#[得到投票的总数量]
	Function SumVote($id)
	{
		if(!$id) return false;
		$sql = "SELECT sum(vcount) AS qgcount FROM ".$this->table." WHERE voteid='".$id."'";
		$rs = $this->DB->GetOne($sql);
		return intval($rs["qgcount"]);
	}
}
?>