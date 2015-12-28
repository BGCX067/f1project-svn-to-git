<?php
#=====================================================================
#	Filename: filename.php
#	Note	: 说明文档
#	Version : 3.0
#	Author  : qinggan
#	Update  : 2008-07-13
#=====================================================================
$id = intval($id);
$sign = $STR->safe($sign);
if(!$sign)
{
	echo "error";
	exit;
}
$chk = "abcdefghijklmnopqrstuvwxyz0123456789_";
$tmparray = array();
$tmplength = strlen($sign);
for($i=0;$i<$tmplength;$i++)
{
	$tmparray[$i] = $sign{$i};
}
if(!$tmparray)
{
	echo "error";
	exit;
}
#[检测标识符是否正常]
foreach($tmparray AS $key=>$value)
{
	if(strpos($chk,strtolower($value)) === false)
	{
		echo "forbid";
		exit;
	}
}
if(strpos("1234567890",substr(trim($sign),0,1)) !== false)
{
	echo "forbid";
	exit;
}
$C_Phpok = $CF->build("phpok");
$condition = $id ? "id!='".$id."' AND sign='".$sign."'" : "sign='".$sign."'";
$rs = $C_Phpok->GetPhpok("one",$condition);
if($rs)
{
	echo "used";
	exit;
}
echo "ok";
?>