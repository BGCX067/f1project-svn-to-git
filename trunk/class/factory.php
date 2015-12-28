<?php
#=========================================================================================
#	Filename: class/factory.php
#	Note	: 工厂类文件
#	Version : 3.0
#	Author  : qinggan
#	Update  : 2008-6-9
#=========================================================================================
class C_Factory
{
	var $DB;
	var $prefix;
	var $sqltype;

	function __construct($DB,$prefix="yui_",$sqltype="mysql")
	{
		$this->DB = $DB;
		$this->prefix = $prefix;
		$this->sqltype = $sqltype;
	}

	function C_Factory($DB,$prefix="yui_",$sqltype="mysql")
	{
		$this->__construct($DB,$prefix,$sqltype);
	}

	function build($file)
	{
		include_once(SYSTEM_ROOT."/class/db/".$this->sqltype."/".$file.".php");
		$class_name = "C_".ucfirst($file);
		return new $class_name($this->DB,$this->prefix);
	}
}
?>