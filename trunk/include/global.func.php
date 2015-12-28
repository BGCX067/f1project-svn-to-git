<?php
#[常用函数管理]
function Error($msg="操作错误",$url="",$time=2)
{
	global $DB,$system;
	global $TPL;
	$TPL->set_var("error_msg",$msg);
	$TPL->set_var("error_time",$time);
	$TPL->set_var("error_url",$url);
	$TPL->p("error");
	REWRITE();
}

function qgheader($url="home.php")
{
	global $TPL;
	$url = $url ? $url : "home.php";
	ob_end_clean();
	header("Location:".$url);
	exit;
}

function ErrorMsg($msg="操作不正确")
{
	Error($msg);
}

#[检测缓存文件是否超时]
function CheckCache($filename)
{
	global $system;
	global $system_time;
	if(!$filename)
	{
		return false;
	}
	$system["mintime"] = $system["mintime"] ? intval($system["mintime"]) : 0;
	if(!file_exists($filename))
	{
		return false;
	}
	if(!$system["maxtime"] || $system["maxtime"] < 1)
	{
		return false;
	}
	if((@filemtime($filename) + rand($system["mintime"],$system["maxtime"])) <= $system_time)
	{
		return false;
	}
	return true;
}

#[管理无限级别分类]
function menu_list($catelist,$cateid,$array=array())
{
	foreach($catelist AS $key=>$value)
	{
		if($value["id"] == $cateid)
		{
			$array[$key] = $value;
			$array = menu_list($catelist,$value["parentid"],$array);
		}
	}
	return $array;
}

#[根据当前分类得到子分类ID]
function get_son_list($catelist,$cateid,$array=array())
{
	foreach($catelist AS $key=>$value)
	{
		if($value["parentid"] == $cateid)
		{
			$array[$key] = $value["id"];
			$array = get_son_list($catelist,$value["id"],$array);
		}
	}
	return $array;
}

function page($url,$total=0,$psize=30,$pageid=0,$halfPage=5)
{
	global $langs;
	if(empty($psize))
	{
		$psize = 30;
	}
	#[添加链接随机数]
	if(strpos($url,"?") === false)
	{
		$url = $url."?qgrand=phpok";
	}
	#[共有页数]
	$totalPage = intval($total/$psize);
	if($total%$psize)
	{
		$totalPage++;#[判断是否存余，如存，则加一
	}
	#[如果分页总数为1或0时，不显示]
	if($totalPage<2)
	{
		return false;
	}
	#[判断分页ID是否存在]
	if(empty($pageid))
	{
		$pageid = 1;
	}
	#[判断如果分页ID超过总页数时]
	if($pageid > $totalPage)
	{
		$pageid = $totalPage;
	}
	#[Html]
	$array_m = 0;
	if($pageid > 0)
	{
		$returnlist[$array_m]["url"] = $url;
		$returnlist[$array_m]["name"] = "首页";
		$returnlist[$array_m]["status"] = 0;
		if($pageid > 1)
		{
			$array_m++;
			$returnlist[$array_m]["url"] = $url."&pageid=".($pageid-1);
			$returnlist[$array_m]["name"] = "上一页";
			$returnlist[$array_m]["status"] = 0;
		}
	}
	#[添加中间项]
	for($i=$pageid-$halfPage,$i>0 || $i=0,$j=$pageid+$halfPage,$j<$totalPage || $j=$totalPage;$i<$j;$i++)
	{
		$l = $i + 1;
		$array_m++;
		$returnlist[$array_m]["url"] = $url."&pageid=".$l;
		$returnlist[$array_m]["name"] = $l;
		$returnlist[$array_m]["status"] = ($l == $pageid) ? 1 : 0;
	}
	#[添加select里的中间项]
	for($i=$pageid-$halfPage*3,$i>0 || $i=0,$j=$pageid+$halfPage*3,$j<$totalPage || $j=$totalPage;$i<$j;$i++)
	{
		$l = $i + 1;
		$select_option_msg = "<option value='".$l."'";
		if($l == $pageid)
		{
			$select_option_msg .= " selected";
		}
		$select_option_msg .= ">".$l."</option>";
		$select_option[] = $select_option_msg;
	}
	#[添加尾项]
	if($pageid < $totalPage)
	{
		$array_m++;
		$returnlist[$array_m]["url"] = $url."&pageid=".($pageid+1);
		$returnlist[$array_m]["name"] = "下一页";
		$returnlist[$array_m]["status"] = 0;
	}
	$array_m++;
	$returnlist[$array_m]["url"] = $url."&pageid=".$totalPage;
	$returnlist[$array_m]["name"] = "尾页";
	$returnlist[$array_m]["status"] = 0;
	#[内容组成html]
	#[组织样式]
	$msg = "<table class='pagelist'><tr><td class='n'>".$total."/".$psize."</td>";
	foreach($returnlist AS $key=>$value)
	{
		if($value["status"])
		{
			$msg .= "<td class='m'>".$value["name"]."</td>";
		}
		else
		{
			$msg .= "<td class='n'><a href='".$value["url"]."'>".$value["name"]."</a></td>";
		}
	}
	#$msg .= "<td class='n'><select onchange=\"window.location='".$url."&pageid='+this.value+''\">".implode("",$select_option)."</option></select></td>";
	$msg .= "</tr></table>";
	unset($returnlist);
	return $msg;
}



function SafeHtml($msg="")
{
	global $STR;
	return $STR->safe($msg);
}

function FckHtml($msg="",$script=false,$iframe=false,$style=false)
{
	global $STR;
	$STR->set("script",$script);
	$STR->set("iframe",$iframe);
	$STR->set("style",$style);
	return $STR->html($msg);
}

function CutString($string,$length=10,$dot="…")
{
	global $STR;
	return $STR->cut($string,$length,$dot);
}

function FckEditor($var="",$content="",$toolbar="",$height="",$width="100%")
{
	include_once("./class/fckeditor.class.php");
	$var = $var ? $var : "content";
	$fck = new FCKeditor($var) ;//获得一个变量信息
	$sBasePath = $_SERVER['PHP_SELF'] ;
	$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "_samples" ) ) ;
	$fck->BasePath = $sBasePath."include/editor/";
	$fck->Value = $content;
	$fck->Config['AutoDetectLanguage'] = false;
	$fck->Config['DefaultLanguage'] = "zh-cn";
	$fck->Config['ToolbarStartExpanded'] = true;
	$fck->ToolbarSet = "Default";
	$fck->Width = $width;
	$fck->Height = $height;
	$fck->Config['EnableXHTML'] = true;
    $fck->Config['EnableSourceXHTML'] = true;
	return $fck->CreateHtml();
}

function Utf2gb($utfstr)
{
	global $STR;
	return $STR->charset($utfstr,"UTF-8","GBK");
}

function GetSystemUrl()
{
	$myurl = "http://".str_replace("http://","",$_SERVER["SERVER_NAME"].":".$_SERVER['SERVER_PORT']);
	$docu = $_SERVER["PHP_SELF"];
	$array = explode("/",$docu);
	$count = count($array);
	if($count>1)
	{
		foreach($array AS $key=>$value)
		{
			$value = trim($value);
			if($value)
			{
				if(($key+1) < $count)
				{
					$myurl .= "/".$value;
				}
			}
		}
	}
	$myurl .= "/";
	return $myurl;
}

function FOOT($tplfile)
{
	global $TPL;
	#[引入页脚信息]
	$TPL->p($tplfile);
	REWRITE();
}


function ContentPageArray($content,$url,$pageid=0)
{
	$page_content = explode("[:page:]",$content);
	$pageid = intval($pageid);
	if($pageid < 1)
	{
		$pageid = 1;
	}
	$page_total = count($page_content);
	$pagelist = page($url,$page_total,1,$pageid);#[获取分页的数组]
	$content = $page_content[($pageid-1)];
	$content = preg_replace("/<div/isU","<p style='margin-top:0px;margin-bottom:0px;padding:0px;'",$content);
	$content = preg_replace("/<\/div>/isU","</p>",$content);
	return array($content,$pagelist);
}

function REWRITE()
{
	global $urlRewrite,$system,$siteurl;
	global $AH;
	if($system["urlseo"] && !$AH)
	{
		include_once(SYSTEM_ROOT."/class/html.php");
		if($system["urlseo"] == "urlrewrite")
		{
			$AH = new AutoHtml("./",true);
		}
		else
		{
			$AH = new AutoHtml("./",false);
		}
	}
	if($system["urlseo"] == "urlseo")
	{
		include_once(SYSTEM_ROOT."/class/extends/urlseo.html.php");
		$US = new UrlSeo("./",true);
		$content = ob_get_contents();
		ob_end_clean();
		$content = $US->ToHtml($content);
		echo $content;
		ob_end_flush();
		exit;
	}
	elseif($system["urlseo"] == "urlrewrite")
	{
		$content = ob_get_contents();
		ob_end_clean();
		$content = $AH->ToHtml($content);
		echo $content;
		ob_end_flush();
		exit;
	}
}
?>