<?php
#[后台通用页信息]
ob_start();

#[定义PHPOK_SET为TRUE]
define("PHPOK_SET", TRUE);

#[开始计时]
$st = explode(" ",microtime());
$st = $st[0] + $st[1];
define("STARTTIME",$st);
unset($st);
#[强制使用UTF-8编码]
header("Content-type: text/html; charset=utf-8");
#[设置include_path]
define("SYSTEM_ROOT",".");
set_include_path(SYSTEM_ROOT);
#[加载配置文件]
require_once(SYSTEM_ROOT."/config.php");
#[是否启用调试]
$viewbug ? error_reporting(E_ALL & ~E_NOTICE) : error_reporting(0);
#[配置返回资料是否自动加入反斜线当溢出字符，设置为0关闭该功能]
set_magic_quotes_runtime(0);
#[设置默认时间，适用于系统默认]
#[如果已配置相关语言包并配置，该变量值会被重置]
$system_time = $systemTime = time();

#[加载版本库]
#[版本头仅限于判断版本，无其他意义]
include_once(SYSTEM_ROOT."/version.php");

#[加载字符串处理类]
require_once(SYSTEM_ROOT."/class/string.php");
$STR = new PHPOK_STRING(false,false,false);

#[格式化Get,Post,Cookie参数]
$magic_quotes_gpc = get_magic_quotes_gpc();
@extract($STR->format($_POST));
@extract($STR->format($_GET));
if(!$magic_quotes_gpc)
{
	$_FILES = $STR->format($_FILES);
}

#[加载数据库]
require_once(SYSTEM_ROOT."/class/db/".$dbType.".php");
$DB = new DB_SQL($dbHost,$dbUser,$dbPass);
$DB->Connect($dbData);

#[加载工厂类]
require_once(SYSTEM_ROOT."/class/factory.php");
$CF = new C_Factory($DB,$prefix,$dbType);

#[加载session，session存放在不同数据库，有不同的安全机制，因此在这里特别设置]
$t_sfile = SYSTEM_ROOT."/class/db/".$dbType."/session.php";
$d_sfile = SYSTEM_ROOT."/class/session.php";
file_exists($t_sfile) ? include_once($t_sfile) : include($d_sfile);
unset($t_sfile,$d_sfile);

#[文件操作类]
include_once(SYSTEM_ROOT."/class/file.php");
$FS = new files();

#[加载常用函数]
include_once(SYSTEM_ROOT."/include/admin.func.php");

#[加载模板配置]
require_once(SYSTEM_ROOT."/class/tpl.php");
$TPL = new QG_C_TEMPLATE();
#[设置TPL参数]
$TPL->set("tplid",1);
$TPL->set("tpldir","templates/admin");
$TPL->set("cache","data/admin_tplc");
$TPL->set("phpdir","");
$TPL->set("ext","htm");
$TPL->set("autorefresh",true);
$TPL->set("autoimg",true);

#[获取系统用到的两个重要参数,file及act]
#[这两个参数是系统专用，贯穿整个后台]
#[兼容大部分的写作习惯]
$SysFile = $sysfile = $sys_file = $sysFile = $STR->safe($file);
$SysAct = $sysact = $sys_act = $sysAct = $STR->safe($act);


#[判断加载的验证码，要求系统支持GD库]
if($isCheckCode && function_exists("imagecreate") && $SysAct == "chkcode")
{
	ob_clean();
	SetCheckCodes();
	exit;
}

#[判断是否退出操作]
if($sysact == "logout")
{
	session_destroy();
	Error("管理员正常退出","admin.php?act=login");
}
elseif($sysact == "loginok")
{
	if(!$username || !$password)
	{
		Error("用户名或密码或认证码为空...","admin.php?act=login");
	}
	#[认证码功能]
	if(function_exists("imagecreate") && $isCheckCode)
	{
		if(!$chk)
		{
			Error("验证码不能为空！","admin.php?act=login");
		}
		$chk = md5(strtolower($chk));
		if($chk != $_SESSION["qgLoginChk"])
		{
			Error("认证码输入不正确！","admin.php?act=login");
		}
	}
	$_SESSION["qgLoginChk"]="";
	$C_Admin = $CF->build("admin");
	$rs = $C_Admin->GetAdmin("one","user='".$username."' AND pass='".md5($password)."'");
	if($rs)
	{
		$_SESSION["admin"] = $rs;
		Error("管理员 <strong>".$username."</strong> 登录后台...","admin.php");
	}
	else
	{
		session_destroy();
		Error("管理员账号或密码不正确...","admin.php?act=login");
	}
}


if($_SESSION["admin"]["user"] && $_SESSION["admin"]["pass"])
{
	#[这里是弹出窗口的设置]
	$incfile = $STR->safe(rawurldecode($_GET["incfile"]));
	if($incfile)
	{
		$site_title = "欢迎进入弹窗页";
		$iframe_height = intval($_GET["iframe_height"]);
		$inputname = $STR->safe($_GET["inputname"]);
		$subtype = intval($_GET["subtype"]);
		if(!$iframe_height)
		{
			$iframe_height = 124;
		}
		$TPL->p("open.index.sys");
		exit;
	}


	if(!$sysfile && !$incfile)
	{
		$TPL->p("frame");
		exit;#[中止]
	}

	include_once(SYSTEM_ROOT."/data/system.php");
	#[设置时间]
	if(function_exists("date_default_timezone_set"))
	{
		if(!$system["timezone"])
		{
			$system["timezone"] = "8";
		}
		date_default_timezone_set("Etc/GMT".intval($system["timezone"]));
		$system_time = $systemTime = $system_now = time() + $system["timerevise"];
	}
	else
	{
		$t["h"] = gmdate("H") + $system["timezone"];
		$t["i"] = gmdate("i") + $system["timerevise"];
		$system_time = $systemTime = $system_now = mktime($t["h"],$t["i"],gmdate("s"),gmdate("m"),gmdate("d"),gmdate("Y"));
	}
	include_once("class/upload.php");
	$system["filestype"] = $system["filestype"] ? $system["filestype"] : "jpg,png,gif,rar,zip";
	$savefolder = $system["filesave"] ? date($system["filesave"],$system_time) : "";
	$UP = new UPLOAD("upfiles/".$savefolder,$system["filestype"]);
	unset($savefolder);#[注销变量]
	include_once("class/gd.php");
	$GD = new PHPOK_GD($system["isgd"],$system["gdquality"]);
	if(!$sysfile)
	{
		Error("操作非法");
		exit;
	}


	$t_sysact = $sysact && file_exists(SYSTEM_ROOT."/admin/".$sysfile."/".$sysact.".php") ? $sysact : $sysfile;
	$t_sysact_file = SYSTEM_ROOT."/admin/".$sysfile."/".$t_sysact.".php";
	if(file_exists($t_sysact_file))
	{
		include_once($t_sysact_file);
	}
	else
	{
		$include_file = SYSTEM_ROOT."/admin/".$sysfile.".php";
		file_exists($include_file) ? include_once($include_file) : Error("找不到相关文件");
	}
	exit;
}
else
{
	$TPL->p("login.sys");
	exit;
}
?>