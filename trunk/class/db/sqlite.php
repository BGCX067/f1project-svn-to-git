<?php
#==================================================================================================
#	Filename: class/db/sqlite.php
#	Note	: 连接数据库类
#	Version : 3.0
#	Author  : qinggan
#	Update  : 2008-05-27
#==================================================================================================

#[类库sql]
class DB_SQL
{
	var $queryCount = 0;
	var $host;
	var $user;
	var $pass;
	var $data;
	var $conn;
	var $result;
	var $rsType = SQLITE_ASSOC;
	var $queryTimes = 0;#[查询时间]
	var $connTimes = 0;#[连接数据库时间]
	var $unbuffered = false;#[是否使用不使用结果缓存集查询功能，默认为不使用]
	var $dbconn = false;#[是否使用持久链接，true为启用，false为不使用]
	var $useWork = false;#[是否使用事务，默认关闭，建议在insert,update,delete时启用事务]

	#[构造函数]
	function __construct($dbhost="",$dbuser="",$dbpass="")
	{
		$this->host = $dbhost;
		$this->user = $dbuser;
		$this->pass = $dbpass;
	}

	#[兼容PHP4]
	function DB_SQL($dbhost="",$dbuser="",$dbpass="")
	{
		$this->__construct($dbhost,$dbuser,$dbpass);
	}

	#[连接数据库]
	function Connect($data="")
	{
		if(!$data)
		{
			return true;
		}
		$this->SelectDb($data);
	}

	function SelectDb($data="")
	{
		$database = $data ? $data : $this->data;
		if(!$database)
		{
			return false;
		}
		$this->data = $database;
		if(!file_exists($this->data))
		{
			die("NO DATA FILE");
		}
		$starttime = $this->TimeUsed();
		$func = $this->dbconn ? "sqlite_popen" : "sqlite_open";
		$this->conn = $func($this->data,0666,$error) or die($error);
		sqlite_busy_timeout($this->conn,10);#[限制超过30毫秒超解锁]
		#[设置使用UTF8编辑]
		sqlite_query($this->conn,"PRAGMA encoding = 'UTF-8'");
		$endtime = $this->TimeUsed();
		$this->connTimes += round($endtime - $starttime,5);#[连接数据库的时间]
	}

	#[关闭数据库连接，当您使用持续连接时该功能失效]
	function Close()
	{
		return @sqlite_close($this->conn);
	}

	function __destruct()
	{
		@session_write_close();#[关闭session写入]
		return $this->Close();
	}

	function Set($name,$value)
	{
		if($name == "rsType")
		{
			$value = $value == "NUM" ? SQLITE_NUM : SQLITE_ASSOC;
		}
		$this->$name = $value;
	}

	function Query($sql)
	{
		$starttime = $this->TimeUsed();
		if($this->useWork)
		{
			$this->result = $this->WorkQuery($sql);
		}
		else
		{
			$func = $this->unbuffered && @function_exists("sqlite_unbuffered_query") ? "sqlite_unbuffered_query" : "sqlite_query";
			$this->result = @$func($this->conn,$sql);
		}
		$this->queryCount++;
		$endtime = $this->TimeUsed();
		$this->queryTimes += round($endtime - $starttime,5);#[查询时间]
		if(!$this->result)
		{
			return false;
		}
		return $this->result;
	}

	#[开始使用事务]
	function StartWork()
	{
		sqlite_query($this->conn,"BEGIN TRANSACTION");#[开始启用事务]
		return true;
	}

	#[结束使用事务]
	function EndWork($status=true)
	{
		if($status)
		{
			sqlite_query($this->conn,"COMMIT TRANSACTION");#[提交事务]
			return true;
		}
		else
		{
			sqlite_query($this->conn,"ROLLBACK TRANSACTION");#[回滚事务]
			return false;
		}
	}

	function WorkQuery($sql)
	{
		sqlite_query($this->conn,"BEGIN TRANSACTION");#[开始启用事务]
		$this->result = @sqlite_query($sql);
		if($this->result)
		{
			sqlite_query($this->conn,"COMMIT TRANSACTION");#[提交事务]
			return $this->result;
		}
		else
		{
			sqlite_query($this->conn,"ROLLBACK TRANSACTION");#[回滚事务]
			return false;
		}
	}

	function GetAll($sql="",$primary="")
	{
		$result = $sql ? $this->Query($sql) : $this->result;
		if(!$result)
		{
			return false;
		}
		$starttime = $this->TimeUsed();
		while($rows = sqlite_fetch_array($result,$this->rsType))
		{
			if($primary && $rows[$primary])
			{
				$rs[$rows[$primary]] = $rows;
			}
			else
			{
				$rs[] = $rows;
			}
		}
		$endtime = $this->TimeUsed();
		$this->queryTimes += round($endtime - $starttime,5);#[查询时间]
		return ($rs ? $this->Decode($rs) : false);
	}

	function GetOne($sql="")
	{
		$starttime = $this->TimeUsed();
		$result = $sql ? $this->Query($sql) : $this->result;
		if(!$result)
		{
			return false;
		}
		$rows = sqlite_fetch_array($result,$this->rsType);
		$endtime = $this->TimeUsed();
		$this->queryTimes += round($endtime - $starttime,5);#[查询时间]
		return $this->Decode($rows);
	}

	function InsertId($sql="")
	{
		if($sql)
		{
			$rs = $this->GetOne($sql);
			return $rs;
		}
		else
		{
			return sqlite_last_insert_rowid($this->conn);
		}
	}

	function Insert($sql)
	{
		$this->Query($sql);
		$id = $this->InsertId();
		return $id;
	}

	function Count($sql="")
	{
		if($sql)
		{
			$this->Set("rsType","NUM");
			$this->Query($sql);
			$rs = $this->GetOne();
			$this->Set("rsType","ASSOC");
			return $rs[0];
		}
		else
		{
			$rsC = sqlite_num_rows($this->result);
			return $rsC;
		}
	}

	function NumFields($sql="")
	{
		if($sql)
		{
			$this->Query($sql);
		}
		return @sqlite_num_fields($this->result);
	}

	function ListTables()
	{
		$rs = $this->GetAll("SELECT tbl_name FROM sqlite_master WHERE type='table'");
		return $rs;
	}

	function TableName($table_list,$i)
	{
		return $table_list[$i];
	}

	function Encode($char)
	{
		if(!$char)
		{
			return false;
		}
		if(is_array($char))
		{
			foreach($char AS $key=>$value)
			{
				if($value)
				{
					$char[$key] = $this->Encode($value);
				}
			}
		}
		else
		{
			$char = sqlite_escape_string(stripslashes($char));
		}
		return $char;
	}

	function Decode($char)
	{
		if(!$char)
		{
			return false;
		}
		if(is_array($char))
		{
			foreach($char AS $key=>$value)
			{
				if($value)
				{
					$char[$key] = $this->Decode($value);
				}
			}
		}
		else
		{
			#$char = sqlite_escape_string($char);
			$char = str_replace("\'\'", "'", $char);
			$char = str_replace('\"', '"', $char);
		}
		return $char;
	}

	function GetVersion()
	{
		return sqlite_libversion($this->conn);
	}

	function TimeUsed()
	{
		$time = explode(" ",microtime());
		$used_time = $time[0] + $time[1];
		return $used_time;
	}

	#[兼容以前的操作，以下函数将在新版中放弃使用]
	function qgClose()
	{
		return $this->Close();
	}

	function qgQuery($sql,$type="ASSOC")
	{
		return $this->Query($sql,$type);
	}

	function qgGetAll($sql="",$primary="")
	{
		return $this->GetAll($sql,$primary);
	}

	function qgGetOne($sql="")
	{
		return $this->GetOne($sql);
	}

	function qgInsertID($sql="")
	{
		return $this->InsertId($sql);
	}

	function qgInsert($sql)
	{
		return $this->Insert($sql);
	}

	function qg_count($sql="")
	{
		return $this->Count($sql);
	}

	function qgCount($sql="")
	{
		return $this->Count($sql);
	}

	function qgNumFields($sql = "")
	{
		return $this->NumFields($sql);
	}

	function qgListFields($table)
	{
		return $this->ListFields($table);
	}

	function qgListTables()
	{
		return $this->ListTables();
	}

	function qgTableName($tablelist,$i)
	{
		return $this->TableName($table_ist,$i);
	}

	function qgEscapeString($char)
	{
		return $this->EscapeString($char);
	}
}
?>