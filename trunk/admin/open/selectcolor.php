<?php
#=========================================================================================
#	Filename: admin/open/selectcolor.php
#	Note	: 16进制常用代码值
#	Version : 3.0
#	Author  : qinggan
#	Update  : 2008-10-03
#=========================================================================================
$inputname = $STR->safe($inputname);
if(!$inputname)
{
	$inputname = $_SESSION["tmp_input_name"] ? $_SESSION["tmp_input_name"] : "style";
}
$_SESSION["tmp_input_name"] = $inputname;

$styleString = "000000,993300,333300,003300,003366,000080,333399,333333,800000,FF6600,808000,808080,008080,0000FF,666699,808080,FF0000,FF9900,99CC00,339966,33CCCC,3366FF,800080,999999,FF00FF,FFCC00,FFFF00,00FF00,00FFFF,00CCFF,993366,C0C0C0,FF99CC,FFCC99,FFFF99,CCFFCC,CCFFFF,99CCFF,CC99FF,FFFFFF";
$colorList = explode(",",$styleString);

$TPL->p("selectcolor","open");
?>