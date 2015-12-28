<?php
ob_start();
#[计时开始]
$start_time = explode(" ",microtime());
$start_time = $start_time[0] + $start_time[1];
header("Content-Type:text/html;charset=utf-8");
define("START_TIME",$start_time);
define("PHPOK_SET", TRUE);
define("SYSTEM_ROOT","./");
set_include_path(SYSTEM_ROOT);
#[加载配置文件]
require_once(SYSTEM_ROOT."/config.php");
require_once(SYSTEM_ROOT."/version.php");

#[是否启用调试]
$viewbug ? error_reporting(E_ALL & ~E_NOTICE) : error_reporting(0);

#[加载字符串处理类]
require_once(SYSTEM_ROOT."/class/string.php");
$STR = new PHPOK_STRING(false,false,false);

$magic_quotes_gpc = get_magic_quotes_gpc();
@extract($STR->format($_POST));
@extract($STR->format($_GET));
if(!$magic_quotes_gpc)
{
	$_FILES = $STR->format($_FILES);
}
#[加载文件处理操作]
require_once(SYSTEM_ROOT."/class/file.php");
$FS = new files();
#[加载数据库]
require_once(SYSTEM_ROOT."/class/db/".$dbType.".php");
$DB = new DB_SQL($dbHost,$dbUser,$dbPass);
$DB->Connect($dbData);

#[加载工厂类]
require_once(SYSTEM_ROOT."/class/factory.php");
$CF = new C_Factory($DB,$prefix,$dbType);

#[启用数据库SESSION]
require_once(SYSTEM_ROOT."/class/db/".$dbType."/session.php");



#[加载常用函数信息]
require_once(SYSTEM_ROOT."/include/global.func.php");

#[加载网站常规选项]
if(!file_exists(SYSTEM_ROOT."/data/system.php"))
{
	echo "Not Set System.";
	exit;

}
include_once(SYSTEM_ROOT."/data/system.php");

if(!$system["siteurl"] || substr(strtolower($msg),0,7) != "http://")
{
	#[计算URL]
	$__siteurl = GetSystemUrl();
	if($system["urlseo"] == "urlseo")
	{
		#[判断URL]
		if(substr($__siteurl,-5) == ".php/")
		{
			$tmparray = explode("/",$__siteurl);
			$count = count($tmparray)-2;
			$__siteurl = "";
			for($i=0;$i<$count;$i++)
			{
				$__siteurl .= $tmparray[$i]."/";
			}
			unset($tmparray);
		}
	}
	$system["siteurl"] = $__siteurl;
}
#[定义网址]
define("SITE_URL",$system["siteurl"]);

#[计算当前时间]
if(function_exists("date_default_timezone_set"))
{
	if(!$system["timezone"])
	{
		$system["timezone"] = "8";
	}
	date_default_timezone_set("Etc/GMT".intval($system["timezone"]));
	$system_time = $system_now = time() + $system["timerevise"];

}
else
{
	 $system_time = $system_now = mktime(gmdate("H")+$system["timezone"],gmdate("i")+$system["timerevise"],gmdate("s"),gmdate("m"),gmdate("d"),gmdate("Y"));
}

#[模板信息参数]
require_once(SYSTEM_ROOT."/class/tpl.php");
$TPL = new QG_C_TEMPLATE();
$TPL->set("tplid",1);
$TPL->set("tpldir","templates/default");
$TPL->set("cache","data/yui_tplc");
$TPL->set("phpdir","");
$TPL->set("ext","tpl.php");#[模板扩展，为了保护程序，设置为php以保证数据的安全]
$TPL->set("autorefresh",true);
$TPL->set("autoimg",true);

#[加载模块]
include_once(SYSTEM_ROOT."/include/mod.func.php");


#[判断URLSEO]
if($system["urlseo"] == "urlseo")
{
	$__GetUrl = $_SERVER["REQUEST_URI"];
	if(strpos($__GetUrl,"/list.php/") !== false)
	{
		$__ExplodeUrl = explode("/list.php/",$__GetUrl);
		$__ExtendsUrl = $__ExplodeUrl[1] ? str_replace(".html","",$__ExplodeUrl[1]) : Error("操作非法","index.php");
		unset($__ExplodeUrl);
		$__ExtendsList = explode("-",$__ExtendsUrl);
		$id = $__ExtendsList[0];
		$pageid = $__ExtendsList[1] ? intval($__ExtendsList[1]) : 0;
		unset($__ExtendsList);
	}
	if(strpos($__GetUrl,"/msg.php/") !== false)
	{
		$__ExplodeUrl = explode("/msg.php/",$__GetUrl);
		$__ExtendsUrl = $__ExplodeUrl[1] ? str_replace(".html","",$__ExplodeUrl[1]) : Error("操作非法","index.php");
		$id = intval($__ExtendsUrl);
		unset($__ExtendsUrl);
	}
	if(strpos($__GetUrl,"/special.php/") !== false)
	{
		$__ExplodeUrl = explode("/special.php/",$__GetUrl);
		$__ExtendsUrl = $__ExplodeUrl[1] ? str_replace(".html","",$__ExplodeUrl[1]) : Error("操作非法","index.php");
		$id = intval($__ExtendsUrl);
		unset($__ExtendsUrl);
	}
	if(strpos($__GetUrl,"/book.php/") !== false)
	{
		$__ExplodeUrl = explode("/book.php/",$__GetUrl);
		$__ExtendsUrl = $__ExplodeUrl[1] ? str_replace(".html","",$__ExplodeUrl[1]) : Error("操作非法","index.php");
		unset($__ExplodeUrl);
		$__ExtendsList = explode("-",$__ExtendsUrl);
		$act = $__ExtendsList[0];
		$pageid = $__ExtendsList[1] ? intval($__ExtendsList[1]) : 0;
		$id = $__ExtendsList[2] ? str_replace("id","",$__ExtendsList[2]) : 0;
		unset($__ExtendsList);
	}
	if(strpos($__GetUrl,"/driver.php/") !== false)
	{
		$__ExplodeUrl = explode("/driver.php/",$__GetUrl);
		$__ExtendsUrl = $__ExplodeUrl[1] ? str_replace(".html","",$__ExplodeUrl[1]) : Error("操作非法","index.php");
		unset($__ExplodeUrl);
		$__ExtendsList = explode("-",$__ExtendsUrl);
		$act = $__ExtendsList[0];
		$pageid = $__ExtendsList[1] ? intval($__ExtendsList[1]) : 0;
		$id = $__ExtendsList[2] ? str_replace("id","",$__ExtendsList[2]) : 0;
		unset($__ExtendsList);
	}
}
?>