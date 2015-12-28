<?php
#============================
#	Filename: phpok.qgmod.php
#	Note	: 自定义代码调用
#	Version : 2.0
#	Author  : qinggan
#	Update  : 2008-09-20
#============================
global $FS,$CF;
$cache_file = "data/cache/phpok_".$id.".php";#[缓存文件]
$check_status = false;
if($iscache)
{
	$check_status = CheckCache($cache_file);#[判断缓存文件的存储状态]
}
if($check_status)
{
	$phpok = $FS->Read($cache_file);
	return $phpok;
}
$C_Phpok = $CF->build("phpok");
$rs = $C_Phpok->GetPhpok("one","status='1' AND (id='".$id."' OR sign='".$id."')");
if(!$rs)
{
	return false;
}
$phpok = "<!-- ".$rs["subject"]." -->".$rs["content"];
unset($rs);
$FS->Write($phpok,$cache_file);
return $phpok;
?>