<?php
#=====================================================================
#	Filename: class/catetree.php
#	Note	: 无限分类组
#	Version : 3.0
#	Author  : qinggan
#	Update  : 2008-07-12
#=====================================================================
Class CateTree
{
	var $qgArray = array();#[设置数组]
	var $qgTree = array();#[格式化后的数组]
	var $space = " 　　";#[不同级别的分格，默认是中文两个汉字]
	var $son_id = array();

	#[构造函数]
	function __construct($array="")
	{
		$this->qgArray = ($array && is_array($array)) ? $array : array();
	}

	function CateTree($array="")
	{
		$this->__construct($array);
	}


	function Set($var,$value)
	{
		$this->$var = $value;
	}

	function Tree($parentid=0,$space="")
	{
		foreach($this->qgArray AS $key=>$value)
		{
			if($parentid == $value["parentid"])
			{
				$value["space"] = $space;
				$this->qgTree[] = $value;
				$this->Tree($value["id"],$space.$this->space);
			}
		}
		return $this->qgTree;
	}

	function SonId($parentid)
	{
		if($parentid)
		{
			$this->son_id[$parentid] = $parentid;
		}
		foreach($this->qgArray AS $key=>$value)
		{
			if($value["parentid"] == $parentid)
			{
				$this->son_id[$value["id"]] = $value["id"];
				$this->SonId($value["id"]);
			}
		}
		return $this->son_id;
	}
}
?>