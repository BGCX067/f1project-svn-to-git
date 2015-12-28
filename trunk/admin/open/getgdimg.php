<?php
#=========================================================================================
#	Filename: admin/open/style.php
#	Note	: 主题用到的样式管理器
#	Version : 3.0
#	Author  : qinggan
#	Update  : 2008-6-7
#=========================================================================================
$inputname = $STR->safe($inputname);
if(!$inputname)
{
	$inputname = $_SESSION["tmp_input_name"] ? $_SESSION["tmp_input_name"] : "style";
}
$_SESSION["tmp_input_name"] = $inputname;

$tmplist = $FS->Dir("images");
if($tmplist)
{
	foreach($tmplist AS $key=>$value)
	{
		if(is_file($value))
		{
			$rslist[] = $value;
		}
	}
}
$TPL->p("getgdimg","open");
?>