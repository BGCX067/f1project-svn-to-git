<?php
#==================================================================================================
#	Filename: class/session.php
#	Note	: 将SESSION存放在数据库中
#	Version : 3.0
#	Author  : qinggan
#	Update  : 2008-05-27
#==================================================================================================
if(!defined("PHPOK_SET"))
{
	exit("Access Denied");
}

CLASS SESSION
{
	var $DB;
	var $table;
	var $sessid;
	var $systemTime;

	Function __construct()
	{
		global $DB,$prefix;
		global $system_time;
		$this->DB = $DB;
		$this->table = $prefix."session";
		$this->systemTime = $system_time ? $system_time : time();
	}

	#[兼容PHP4]
	Function SESSION()
	{
		$this->__construct();
	}

	Function Open($save_path,$session_name)
	{
		return true;
	}

	Function Close()
	{
		return true;
	}

	Function Read($sid)
	{
		$this->sessid = $sid;
		$rs = $this->DB->GetOne("SELECT * FROM ".$this->table." WHERE id='".$sid."'");
		if(!$rs)
		{
			$sql = "INSERT INTO ".$this->table."(id,data,lasttime) VALUES('".$sid."','','".$this->systemTime."')";
			$this->DB->Query($sql);
			return false;
		}
		else
		{
			if(!$rs["data"])
			{
				return false;
			}
			return $rs["data"];
		}
	}

	Function Write($sid,$data)
	{
		$this->DB->queryCount++;
		$this->DB->Query("UPDATE ".$this->table." SET data='".$data."',lasttime='".$this->systemTime."' WHERE id='".$sid."'");
		return true;
	}

	function Destory($sid)
	{
		$this->DB->Query("DELETE FROM ".$this->table." WHERE id='".$sid."'");
		return true;
	}

	function Gc()
	{
		$this->DB->Query("DELETE FROM ".$this->table." WHERE lasttime+1800<'".$this->systemTime."'");
		return true;
	}

	function sessid()
	{
		return $this->sessid;
	}

	function __destruct()
	{
		return true;
	}
}
$SESSION = new SESSION();
session_set_save_handler(
	array($SESSION,"Open"),
	array($SESSION,"Close"),
	array($SESSION,"Read"),
	array($SESSION,"Write"),
	array($SESSION,"Destory"),
	array($SESSION,"Gc")
);
session_start();
?>