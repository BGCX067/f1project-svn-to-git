<?php
function chk_id($id,$url="",$msg="操作非法")
{
	$id = intval($id);
	if(!$id || $id == 0)
	{
		Error($msg,$url);
	}
	return true;
}
function Error($msg="操作错误",$url="",$time=1)
{
	global $TPL;
	if($url)
	{
		$TPL->set_var("errmsg",$msg);
		$TPL->set_var("url",$url);
		$TPL->set_var("time",$time);
		$TPL->p("error.sys");
	}
	else
	{
		$TPL->set_var("errmsg",$msg);
		$TPL->p("errmsg.sys");
	}
	exit;
}

function Foot()
{
	global $DB,$debug,$FS;
	global $TPL;
	global $dbType;
	$e = explode(" ",microtime());
	$e = $e[0] + $e[1];
	$time_used = round($e - STARTTIME,5);
	$debugmsg = "Processed in ".$time_used." second(s), ".@$DB->queryCount." ".(@$DB->queryCount>1 ? "queries" : "query").", ".intval(@$FS->readCount)." file(s)";
	$debugmsg.= ", ".$dbType." ".($DB->connTimes + $DB->queryTimes)." second(s)";
	return $debugmsg;
}

function FckEditor($var="",$content="",$toolbar="Default",$height="370px",$width="690px")
{
	include_once(SYSTEM_ROOT."/class/fckeditor.php");
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
	$fck->Width = $width ? $width : "543px";
	$fck->Height = $height ? $height : "300px";
	$fck->Config['EnableXHTML'] = true;
    $fck->Config['EnableSourceXHTML'] = true;
	return $fck->CreateHtml();
}

function SafeHtml($msg = "")
{
	global $STR;
	return $STR->safe($msg);
}

function page($url,$total=0,$psize=30,$pageid=0,$halfPage=5,$is_select=true)
{
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
		$returnlist[$array_m]["name"] = " 首页 ";
		$returnlist[$array_m]["status"] = 0;
		if($pageid > 1)
		{
			$array_m++;
			$returnlist[$array_m]["url"] = $url."&pageid=".($pageid-1);
			$returnlist[$array_m]["name"] = " 上页 ";
			$returnlist[$array_m]["status"] = 0;
		}
	}
	if($halfPage>0)
	{
		#[添加中间项]
		for($i=$pageid-$halfPage,$i>0 || $i=0,$j=$pageid+$halfPage,$j<$totalPage || $j=$totalPage;$i<$j;$i++)
		{
			$l = $i + 1;
			$array_m++;
			$returnlist[$array_m]["url"] = $url."&pageid=".$l;
			$returnlist[$array_m]["name"] = $l;
			$returnlist[$array_m]["status"] = ($l == $pageid) ? 1 : 0;
		}
	}
	if($is_select)
	{
		if($halfPage <1)
		{
			$halfPage = 5;
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
	}
	#[添加尾项]
	if($pageid < $totalPage)
	{
		$array_m++;
		$returnlist[$array_m]["url"] = $url."&pageid=".($pageid+1);
		$returnlist[$array_m]["name"] = " 下页 ";
		$returnlist[$array_m]["status"] = 0;
	}
	$array_m++;
	if($pageid != $totalPage)
	{
		$returnlist[$array_m]["url"] = $url."&pageid=".$totalPage;
		$returnlist[$array_m]["name"] = " 尾页 ";
		$returnlist[$array_m]["status"] = 0;
	}
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
	if($is_select)
	{
		$msg .= "<td><select onchange=\"tourl('".$url."&pageid='+this.value)\">".implode("",$select_option)."</option></select></td>";
	}
	$msg .= "</tr></table>";
	unset($returnlist);
	return $msg;
}

function CutString($string,$length=10,$dot="…")
{
	global $STR;
	return $STR->cut($string,$length,$dot);
}

function Utf2gb($utfstr)
{
	global $STR;
	return $STR->charset($utfstr,"UTF-8","GBK");
}

function gb2utf8($gbstr)
{
	global $STR;
	return $STR->charset($utfstr,"GBK","UTF-8");
}

function FckToHtml($msg)
{
	if(!$msg)
	{
		return false;
	}
	$url = GetSystemUrl();
	$msg = str_replace($url,"",$msg);
	$imgArray = array();
	preg_match_all("/src=[\"|'| ]((.*)\.(gif|jpg|jpeg|bmp|png|swf))/isU",$msg,$imgArray);
	$imgArray = array_unique($imgArray[1]);
	$count = count($imgArray);
	if($count < 1)
	{
		return $msg;
	}
	foreach($imgArray AS $key=>$value)
	{
		$value = trim($value);
		if(strpos($value,"http://") === false && $value)
		{
			$msg = str_replace($value,$url.$value,$msg);
		}
	}
	return $msg;
}

function FckHtml($msg="",$script=false,$iframe=false,$style=false)
{
	global $STR;
	$STR->set("script",$script);
	$STR->set("iframe",$iframe);
	$STR->set("style",$style);
	return $STR->html($msg);
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

function SetCheckCodes()
{
	$x_size=90;
	$y_size=30;
	if(function_exists("imagecreate"))
	{
		$aimg = imagecreate($x_size,$y_size);
		$back = imagecolorallocate($aimg, 255, 255, 255);
		$border = imagecolorallocate($aimg, 0, 0, 0);
		imagefilledrectangle($aimg, 0, 0, $x_size - 1, $y_size - 1, $back);
		$txt="0123456789";
		$txtlen=strlen($txt);

		$thetxt="";
		for($i=0;$i<4;$i++)
		{
			$randnum=mt_rand(0,$txtlen-1);
			$randang=mt_rand(-20,20);	//文字旋转角度
			$rndtxt=substr($txt,$randnum,1);
			$thetxt.=$rndtxt;
			$rndx=mt_rand(2,7);
			$rndy=mt_rand(0,9);
			$colornum1=($rndx*$rndx*$randnum)%255;
			$colornum2=($rndy*$rndy*$randnum)%255;
			$colornum3=($rndx*$rndy*$randnum)%255;
			$newcolor=imagecolorallocate($aimg, $colornum1, $colornum2, $colornum3);
			imageString($aimg,5,$rndx+$i*21,5+$rndy,$rndtxt,$newcolor);
		}
		unset($txt);
		$thetxt = strtolower($thetxt);
		$_SESSION["qgLoginChk"] = md5($thetxt);#[写入session中]
		@session_write_close();#[关闭session写入]
		imagerectangle($aimg, 0, 0, $x_size - 1, $y_size - 1, $border);

		$newcolor="";
		$newx="";
		$newy="";
		$pxsum=100;	//干扰像素个数
		for($i=0;$i<$pxsum;$i++)
		{
			$newcolor=imagecolorallocate($aimg, mt_rand(0,254), mt_rand(0,254), mt_rand(0,254));
			imagesetpixel($aimg,mt_rand(0,$x_size-1),mt_rand(0,$y_size-1),$newcolor);
		}
		header("Pragma:no-cache");
		header("Cache-control:no-cache");
		header("Content-type: image/png");
		imagepng($aimg);
		imagedestroy($aimg);
		exit;
	}
}

function format_filesize($filesize = 0)
{
	global $STR;
	return $STR->num_format($filesize);
}

function admin_dir()
{
	global $FS;
	$list = $FS->Dir("admin");#[获取管理员菜单]
	$mylist = array();
	$string = ",iframe,open,ajax,";
	foreach($list AS $key=>$value)
	{
		$m = basename($value);
		if(is_dir($value) && strpos($string,",".$m.",") === false)
		{
			$mylist[] = $m;
		}
	}
	return $mylist;
}

function admin_file($dir="")
{
	global $FS;
	$list = $FS->Dir($dir);
	$mylist = array();
	foreach($list AS $key=>$value)
	{
		$m = strtolower(basename($value));
		$m = substr($m,0,-4);
		if(is_file($value))
		{
			$mylist[] = $m;
		}
	}
	return $mylist;
}
?>