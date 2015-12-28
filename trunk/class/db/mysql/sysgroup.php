<?php
#=====================================================================
#	Filename: class/db/sqlite/sysgroup.php
#	Note	: 系统组管理
#	Version : 3.0
#	Author  : qinggan
#	Update  : 2008-6-29
#=====================================================================
class C_Sysgroup
{
	var $DB;
	var $table;
	var $tableExt;
	var $prefix;
	#[初始化]
	Function __construct($DB,$prefix="yui_")
	{
		$this->DB = $DB;
		$this->prefix = $prefix;
		$this->table = $prefix."sysgroup_main";
		$this->tableExt = $prefix."sysgroup_ext";
	}

	#[兼容PHP4操作]
	Function C_Sysgroup($DB,$prefix="yui_")
	{
		$this->__construct($DB,$prefix);
	}

	Function Set($var,$val)
	{
		$this->$var = $val;
	}

	#[获取系统组数据]
	Function GetSysgMain($type="one",$condition="",$offset=0,$psize=30)
	{
		$sql = "SELECT * FROM ".$this->table." ";
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

	#[获取扩展组数据]
	Function GetSysgExt($type="one",$condition="",$offset=0,$psize=30)
	{
		$sql = "SELECT * FROM ".$this->tableExt." ";
		if($condition)
		{
			$sql .= " WHERE ".$condition;
		}
		$sql .= " ORDER BY taxis ASC,gid DESC,id DESC ";
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

	#[添加或更新组主表结构信息]
	Function SetSysgMain($array,$id=0)
	{
		if($id)
		{
			$sql = "UPDATE ".$this->table." SET name='".$array["name"]."',sign='".$array["sign"]."',status='".$array["status"]."' WHERE id='".$id."'";
			return $this->DB->Query($sql);
		}
		else
		{
			$sql = "INSERT INTO ".$this->table."(name,sign,status) VALUES('".$array["name"]."','".$array["sign"]."','".$array["status"]."')";
			return $this->DB->Insert($sql);
		}
	}

	#[添加或更新扩展组信息]
	Function SetSysgExt($array,$id=0)
	{
		if($id)
		{
			$sql = "UPDATE ".$this->tableExt." SET name='".$array["name"]."',qgtype='".$array["qgtype"]."',qgvalue='".$array["qgvalue"]."',qgoption='".$array["qgoption"]."',status='".$array["status"]."',width='".$array["width"]."',height='".$array["height"]."',isneed='".$array["isneed"]."',taxis='".$array["taxis"]."' WHERE id='".$id."'";
			return $this->DB->Query($sql);
		}
		else
		{
			$sql = "INSERT INTO ".$this->tableExt."(gid,name,qgtype,qgvalue,qgoption,status,width,height,isneed,taxis) VALUES('".$array["gid"]."','".$array["name"]."','".$array["qgtype"]."','".$array["qgvalue"]."','".$array["qgoption"]."','".$array["status"]."','".$array["width"]."','".$array["height"]."','".$array["isneed"]."','".$array["taxis"]."')";
			return $this->DB->Insert($sql);
		}
	}

	#[取得系统组数量]
	Function NumSysgMain($condition="")
	{
		$condition = $condition ? " WHERE ".$condition : "";
		$sql = "SELECT count(id) FROM ".$this->table." ".$condition;
		return $this->DB->Count($sql);
	}

	#[取得扩展组数量]
	Function NumSysgExt($condition="")
	{
		$condition = $condition ? " WHERE ".$condition : "";
		$sql = "SELECT count(id) FROM ".$this->tableExt." ".$condition;
		return $this->DB->Count($sql);
	}

	#[删除系统组操作]
	Function DelSysgroup($id)
	{
		if(!$id)
		{
			return false;
		}
		#[删除主表的设置]
		$sql = "DELETE FROM ".$this->table." WHERE id='".$id."'";
		$this->DB->Query($sql);
		#[删除副表的相关信息设置]
		$sql = "DELETE FROM ".$this->tableExt." WHERE gid='".$id."'";
		$this->DB->Query($sql);
		return true;
	}

	#[删除扩展组操作]
	Function DelSysgExt($id)
	{
		if(!$id)
		{
			return false;
		}
		$sql = "DELETE FROM ".$this->tableExt." WHERE id='".$id."'";
		return $this->DB->Query($sql);
	}

	#[更新扩展组排序]
	Function UpateExtTaxis($id,$taxis=255)
	{
		if(!$id)
		{
			return false;
		}
		$sql = "UPDATE ".$this->tableExt." SET taxis='".$taxis."' WHERE id='".$id."'";
		return $this->DB->Query($sql);
	}
}
?>