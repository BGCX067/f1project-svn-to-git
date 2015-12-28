<?php
#=====================================================================
#	Filename: class/html.class.php
#	Note	: 更新HTML
#	Version : 3.0
#	Author  : qinggan
#	Update  : 2008-08-21
#=====================================================================
CLASS AutoHtml
{
	var $content;
	var $siteurl;#[网站网址]
	var $urlArray;#[要替换的信息]
	var $rewrite = false; #[是否使用了url rewrite 功能]

	function __construct($siteurl="./",$urlRewrite=false)
	{
		$url = defined("SITE_URL") ? SITE_URL : $siteurl;
		if($url == "./")
		{
			$url = $this->get_siteurl();#[自动获取系统网址]
		}
		if(substr($url,-1) != "/")
		{
			$url .= "/";
		}
		$this->siteurl = $url;
		$this->rewrite = $urlRewrite;
	}

	#[兼容PHP4]
	function AutoHtml($siteurl="./",$urlRewrite=false)
	{
		$this->__construct($siteurl,$urlRewrite);
	}

	function SetContent($content)
	{
		$this->content = $content;
	}

	#[一个函数进行下面全部操作]
	function ToHtml($content="")
	{
		if($content)
		{
			$this->content = $content;
		}
		$this->geturl_array();
		$this->replace_url();
		$this->content = str_replace($this->siteurl.$this->siteurl,$this->siteurl,$this->content);
		return $this->content;#[返回rewrite的内容]
	}

	function geturl_array()
	{
		$this->urlarray = array();
		#[获取网址中的Url]
		preg_match_all("/(href|src|action|background)=[\"|'| ]{0,}(.*?)[\"|'| ]{1,}/is",$this->content,$this->urlarray);
		$this->urlarray = array_unique($this->urlarray[2]);
	}

	function replace_url()
	{
		$chkcount = count($this->urlarray);
		if($chkcount < 1)
		{
			return false;
		}
		#[开始网址替换]
		foreach($this->urlarray AS $key=>$value)
		{
			$value = trim($value);
			$old_value = $value;
			if(!$value || $value == "")
			{
				continue;
			}
			$chk_7 = substr(strtolower($value),0,7);
			#[判断是否有带http://]
			if($chk_7 == "http://" && substr(strtolower($value),0,strlen($this->siteurl)) != $this->siteurl)
			{
				continue;
			}
			#[判断是否是mailto:]
			if($chk_7 == "mailto:")
			{
				continue;
			}
			if(substr($value,0,2) == "./")
			{
				$value = substr($value,2);
			}
			#[to-rewrite-html]
			$value = $this->to_rewrite_url($value);
			#[替换，为了防止带分页的替换错误，这里进行三次替换]
			if($value != $old_value)
			{
				$this->str_replace_array($old_value,$value);
			}
		}
	}


	function global_replace($msg)
	{
		$msg = trim($msg);
		$old = $msg;
		if(!$msg || $msg == "")
		{
			return false;
		}
		if(substr(strtolower($msg),0,7) == "http://")
		{
			return false;
		}
		if(substr($msg,0,2) == "./")
		{
			$msg = substr($msg,2);
		}
		$msg = $this->siteurl.$msg;
		if($msg != $old)
		{
			$this->str_replace_array($old,$msg);
		}
		return true;
	}

	function str_replace_array($old,$new)
	{
		$this->content = str_replace("='".$old."'","='".$new."'",$this->content);
		$this->content = str_replace('="'.$old.'"','="'.$new.'"',$this->content);
		$this->content = str_replace("=".$old." ","=".$new." ",$this->content);
	}

	function to_rewrite_url($url,$qg_type="default")
	{
		#[判断参数类型]
		$chkurl = basename($url);
		#echo $chkurl."<br />";
		@$ext = strstr($chkurl,"?");
		if($ext)
		{
			@$chkurl = str_replace($ext,"",$chkurl);
		}
		#[首页，不支持任何参数]
		if($chkurl == "index.php")
		{
			$return_url = $this->siteurl."index.html";
		}#[home页]
		elseif($chkurl == "home.php")
		{
			if(!$ext)
			{
				$return_url = $this->siteurl."home.html";
			}
			else
			{
				$return_url = $this->siteurl.$url;
			}
		}#[列表页]
		elseif($chkurl == "list.php")
		{
			$ext_array = $this->url_ext_array($ext);
			$return_url = $this->siteurl."html/list";
			$return_url .= "/".$ext_array["id"];
			$ext_array["pageid"] = intval($ext_array["pageid"]);
			$ext_array["pageid"] = $ext_array["pageid"] >0 ? $ext_array["pageid"] : 1;
			#[如果有模板]
			$return_url .= "/".($ext_array["pageid"] == 1 ? "index" : $ext_array["pageid"]);
			$return_url .= ".html";
		}#[内容页]
		elseif($chkurl == "msg.php")
		{
			$ext_array = $this->url_ext_array($ext);
			$return_url = $this->siteurl."html";
			$tmplength = strlen($ext_array["id"]);
			#[这里是计算文件夹地址]
			if($tmplength>1)
			{
				$return_url .= "/".substr($ext_array["id"],0,2);
				if($tmplength>2)
				{
					if($tmplength>3)
					{
						$return_url .= "/".substr($ext_array["id"],2,2);
					}
					else
					{
						$return_url .= "/".substr($ext_array["id"],2);
					}
				}
				else
				{
					$return_url .= "/".$ext_array["id"];
				}
			}
			else
			{
				$return_url .= "/".$ext_array["id"];
			}
			$return_url .= "/".$ext_array["id"];#[这里是文件地址]
			$ext_array["pageid"] = intval($ext_array["pageid"]);
			$ext_array["pageid"] = intval($ext_array["pageid"]);
			if($ext_array["pageid"] && $ext_array["pageid"] != 0)
			{
				$return_url .= "-".$ext_array["pageid"];
			}
			$return_url .= ".html";
		}
		elseif($chkurl == "special.php")
		{
			$ext_array = $this->url_ext_array($ext);
			$return_url = $this->siteurl."html/special/".$ext_array["id"];
			$ext_array["pageid"] = intval($ext_array["pageid"]);
			if($ext_array["pageid"] && $ext_array["pageid"] != 0)
			{
				$return_url .= "-".$ext_array["pageid"];
			}
			$return_url .= ".html";
		}
		elseif($chkurl == "book.php")
		{
			$ext_array = $this->url_ext_array($ext);
			$return_url = $this->siteurl."html/book/";
			if($ext_array["act"] == "add")
			{
				$return_url .= "add";
			}
			elseif($ext_array["act"] == "addok")
			{
				$return_url .= "addok";
			}
			else
			{
				$ext_array["pageid"] = intval($ext_array["pageid"]);
				$ext_array["pageid"] = $ext_array["pageid"] >0 ? $ext_array["pageid"] : 1;
				#[如果有模板]
				$return_url .= ($ext_array["pageid"] == 1 ? "index" : $ext_array["pageid"]);
				if($ext_array["id"])
				{
					$return_url .= "-id".$ext_array["id"];
				}
			}
			$return_url .= ".html";
		}
		elseif($chkurl == "driver.php")
		{
			$ext_array = $this->url_ext_array($ext);
			$return_url = $this->siteurl."html/driver/";
			if($ext_array["act"] == "add")
			{
				$return_url .= "add";
			}
			elseif($ext_array["act"] == "addok")
			{
				$return_url .= "addok";
			}
			else
			{
				$ext_array["pageid"] = intval($ext_array["pageid"]);
				$ext_array["pageid"] = $ext_array["pageid"] >0 ? $ext_array["pageid"] : 1;
				#[如果有模板]
				$return_url .= ($ext_array["pageid"] == 1 ? "index" : $ext_array["pageid"]);
				if($ext_array["id"])
				{
					$return_url .= "-id".$ext_array["id"];
				}
			}
			$return_url .= ".html";
		}
		else
		{
			if(substr($url,0,1) == "#")
			{
				$return_url = $url;
			}
			else
			{
				$return_url = $this->siteurl.$url;
			}
		}
		if($qg_type != "default")
		{
			return $return_url;
		}
		else
		{
			if(file_exists(str_replace($this->siteurl,"",$return_url)) || $this->rewrite)
			{
				return $return_url;
			}
			else
			{
				return $this->siteurl.$url;
			}
		}
	}

	function url_ext_array($ext)
	{
		if(!$ext)
		{
			return false;
		}
		if(substr($ext,0,1) == "?")
		{
			$ext = substr($ext,1);
		}
		parse_str($ext,$array);
		return $array;
	}


	function set_siteurl($url)
	{
		$this->siteurl = $url;
	}

	function get_siteurl()
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

	function getThisFile()
	{
		$url = basename($_SERVER["PHP_SELF"]).($_SERVER["QUERY_STRING"] ? "?".$_SERVER["QUERY_STRING"] : "");
		$file = $this->to_rewrite_url($url,"html");
		$file = str_replace($this->siteurl,"",$file);
		return $file;
	}

	function CreateHtml()
	{
		#[取得当前的网址]
		$file = $this->getThisFile();
		if(substr($file,0,4) == "html" || $file == "home.html")
		{
			global $FS;
			$FS->Html($this->content,$file);
		}
		return true;
	}
}
?>