<?php
#=====================================================================
#	Filename: class/db/mysql/msg.php
#	Note	: 内容信息表
#	Version : 3.0
#	Author  : qinggan
#	Update  : 2008-7-13
#=====================================================================
class C_Msg
{
	var $DB;
	var $prefix = "yui_";
	var $table;
	var $fields = "*";
	var $orderby = "taxis DESC,id DESC";
	var $offset = 0;
	var $psize = 10;
	var $condition = "";
	var $tableMsg = "yui_content";
	#[构造函数]
	function __construct($DB,$prefix="yui_")
	{
		$this->DB = $DB;
		$this->prefix = $prefix;
		$this->table = $prefix."msg";
		$this->tableMsg = $prefix."content";
	}

	function C_Msg($DB,$prefix="yui_")
	{
		$this->__construct($DB,$prefix);
	}

	function Set($var,$value)
	{
		$this->$var = $value;
	}

	function GetMsg($type="one")
	{
		$condition = $this->condition ? " WHERE ".$this->condition : "";
		$sql = "SELECT ".$this->fields." FROM ".$this->table." ".$condition;
		$sql.= " ORDER BY ".$this->orderby;
		if($type == "list")
		{
			$sql .= " LIMIT ".$this->offset.",".$this->psize;
			return $this->DB->GetAll($sql);
		}
		else
		{
			return $type == "one" ? $this->DB->GetOne($sql) : $this->DB->GetAll($sql);
		}
	}

	function GetMsgC($id)
	{
		if(!$id)
		{
			return false;
		}
		
		/* 查询yui_content与yui_msg
		SELECT yui_content.content, yui_msg.postdate, yui_msg.subject
		FROM yui_content, yui_msg
		WHERE yui_content.id = "11"
		AND yui_msg.id = "11"
		LIMIT 0 , 30
		*/
		
	
		$sql = "SELECT " .$this->tableMsg.".content,".$this->table.".postdate,".$this->table.".subject FROM ".$this->tableMsg."," .$this->table." WHERE " .$this->tableMsg.".id='".$id."' and ".$this->table.".id='".$id."'";

		//"SELECT content FROM ".$this->tableMsg." WHERE id='".$id."'";
		$rs = $this->DB->GetOne($sql);
		
		return $rs;
	}

	function GetCount()
	{
		$condition = $this->condition ? " WHERE ".$this->condition : "";
		$sql = "SELECT ".$this->fields." FROM ".$this->table." ".$condition;
		return $this->DB->Count($sql);
	}

	function SetMsg($array,$id=0)
	{
		if($id)
		{
			$sql = "UPDATE ".$this->table." SET cateid='".$array["cateid"]."',subject='".$array["subject"]."',style='".$array["style"]."',author='".$array["author"]."',postdate='".$array["postdate"]."',tplfile='".$array["tplfile"]."',hits='".$array["hits"]."',taxis='".$array["taxis"]."',thumb='".$array["thumb"]."',istop='".$array["istop"]."',isvouch='".$array["isvouch"]."',isbest='".$array["isbest"]."',ifcheck='".$array["ifcheck"]."',clou='".$array["clou"]."',url='".$array["url"]."',mark='".$array["mark"]."',standard='".$array["standard"]."',number='".$array["number"]."',m_price='".$array["m_price"]."',s_price='".$array["s_price"]."',promotions='".$array["promotions"]."',softsize='".$array["softsize"]."',softlang='".$array["softlang"]."',softsystem='".$array["softsystem"]."',softdemo='".$array["softdemo"]."',softadmin='".$array["softadmin"]."',softemail='".$array["softemail"]."',softother='".$array["softother"]."',softlicense='".$array["softlicense"]."' WHERE id='".$id."'";
			$status_1 = $this->DB->Query($sql);
			#[更新详细信息表]
			$sql = "UPDATE ".$this->tableMsg." SET cateid='".$array["cateid"]."',content='".$array["content"]."' WHERE id='".$id."'";
			$status_2 = $this->DB->Query($sql);
			if($status_1 && $status_2)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			$sql = "INSERT INTO ".$this->table."(cateid,subject,style,author,postdate,tplfile,hits,taxis,thumb,istop,isvouch,isbest,ifcheck,clou,url,mark,standard,number,m_price,s_price,promotions,softsize,softlang,softsystem,softdemo,softadmin,softemail,softother,softlicense) VALUES('".$array["cateid"]."','".$array["subject"]."','".$array["style"]."','".$array["author"]."','".$array["postdate"]."','".$array["tplfile"]."','".$array["hits"]."','".$array["taxis"]."','".$array["thumb"]."','".$array["istop"]."','".$array["isvouch"]."','".$array["isbest"]."','".$array["ifcheck"]."','".$array["clou"]."','".$array["url"]."','".$array["mark"]."','".$array["standard"]."','".$array["number"]."','".$array["m_price"]."','".$array["s_price"]."','".$array["promotions"]."','".$array["softsize"]."','".$array["softlang"]."','".$array["softsystem"]."','".$array["softdemo"]."','".$array["softadmin"]."','".$array["softemail"]."','".$array["softother"]."','".$array["softlicense"]."')";
			$insert_id = $this->DB->Insert($sql);
			if($insert_id)
			{
				$sql = "INSERT INTO ".$this->tableMsg."(id,cateid,content) VALUES('".$insert_id."','".$array["cateid"]."','".$array["content"]."')";
				if(!$this->DB->Query($sql))
				{
					$this->DB->Query("DELETE FROM ".$this->table." WHERE id='".$insert_id."'");
					return false;
				}
				else
				{
					return true;
				}
			}
			else
			{
				return false;
			}

		}
	}

	function DelMsg($id)
	{
		$sql = "DELETE FROM ".$this->table." WHERE id='".$id."'";
		$this->DB->Query($sql);
		$sql = "DELETE FROM ".$this->tableMsg." WHERE id='".$id."'";
		$this->DB->Query($sql);
		return true;
	}

	function Query($sql)
	{
		return $this->DB->Query($sql);
	}

	#[得到当前最大的排序]
	function GetMaxTaxis()
	{
		$sql = "SELECT max(taxis) AS taxis FROM ".$this->table;
		$rs = $this->DB->GetOne($sql);
		return $rs["taxis"];
	}

	#[累加点击率]
	function AddHits($id)
	{
		if(!$id) return false;
		$sql = "UPDATE ".$this->table." SET hits=hits+1 WHERE id='".$id."'";
		return $this->DB->Query($sql);
	}
}
?>