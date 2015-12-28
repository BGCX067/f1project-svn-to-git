<?php
#===========================================================
#	Filename: class/urlseo.html.php
#	Note	: URL 优化 继承 html.php
#	Version : 3.0
#	Author  : qinggan
#	Update  : 2008-12-18
#===========================================================
CLASS UrlSeo extends AutoHtml
{
	var $content;
	var $siteurl;#[网站网址]
	var $urlArray;#[要替换的信息]
	var $seo = false; #[是否使用了url rewrite 功能]

	function __construct($siteurl="./",$seo=false)
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
		#[判断URL]
		if(substr($url,-5) == ".php/")
		{
			$tmparray = explode("/",$url);
			$count = count($tmparray)-2;
			$url = "";
			for($i=0;$i<$count;$i++)
			{
				$url .= $tmparray[$i]."/";
			}
			unset($tmparray);
		}
		$this->siteurl = $url;
		$this->seo = $urlRewrite;
	}

	#[兼容PHP4]
	function UrlSeo($siteurl="./",$seo=false)
	{
		$this->__construct($siteurl,$seo);
	}

	#[基于PHP的URLSEO]
	function to_rewrite_url($url)
	{
		#[判断参数类型]
		$chkurl = basename($url);
		@$ext = strstr($chkurl,"?");
		if($ext)
		{
			@$chkurl = str_replace($ext,"",$chkurl);
		}
		#[首页，不支持任何参数]
		if($chkurl == "list.php")
		{
			$ext_array = $this->url_ext_array($ext);
			$return_url = $this->siteurl."list.php/".$ext_array["id"];
			$ext_array["pageid"] = intval($ext_array["pageid"]);
			$ext_array["pageid"] = $ext_array["pageid"] >0 ? $ext_array["pageid"] : 1;
			#[如果有模板]
			$return_url .= "-".$ext_array["pageid"];
			$return_url .= ".html";
			return $return_url;
		}#[内容页]
		elseif($chkurl == "msg.php")
		{
			$ext_array = $this->url_ext_array($ext);
			$return_url = $this->siteurl."msg.php/".$ext_array["id"];
			$return_url .= ".html";
			return $return_url;
		}
		elseif($chkurl == "special.php")
		{
			$ext_array = $this->url_ext_array($ext);
			$return_url = $this->siteurl."special.php/".$ext_array["id"];
			$return_url .= ".html";
			return $return_url;
		}
		elseif($chkurl == "book.php")
		{
			$ext_array = $this->url_ext_array($ext);
			$return_url = $this->siteurl."book.php/";
			if($ext_array["act"])
			{
				$return_url .= $ext_array["act"];
			}
			else
			{
				$return_url .= "list";
			}
			$ext_array["pageid"] = intval($ext_array["pageid"]);
			$ext_array["pageid"] = $ext_array["pageid"] >0 ? $ext_array["pageid"] : 1;
			#[如果有模板]
			$return_url .= "-".$ext_array["pageid"];
			if($ext_array["id"])
			{
				$return_url .= "-id".$ext_array["id"];
			}
			$return_url .= ".html";
			return $return_url;
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
			return $return_url;
		}
	}
}
?>