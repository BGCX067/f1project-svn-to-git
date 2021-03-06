<?php
#=====================================================================
#	Filename: class/gd.php
#	Note	: 缩略/水印图生成，使用缩放法
#	Version : 3.0
#	Author  : qinggan
#	Update  : 2008-10-13
#=====================================================================
class PHPOK_GD
{
	#[是否使用GD生成水印或缩略图]
	var $isgd = true;
	var $quality = 80;#[图片质量]
	#[新图片的宽度和高度]
	var $width = 160;
	var $height = 120;
	#[补白处理]
	#[border：边框]
	#[color：边框的颜色]
	#[bgcolor：背景色，不要带#号，仅支持16进制]
	#[bgimg：背景图片，默认是空值]
	#[padding：间隔]
	var $border = 1;
	var $color = "DDDDDD";
	var $bgcolor = "";
	var $bgimg = "";
	var $padding = 5;
	#[版权处理]
	#[iscopyright：是否启用版权]
	#[mark：版权图片，如果使用图片版权，请在这里设置]
	#[position：版权放置的位置，默认是bottom-right]
	#[transparence：透明度，默认是80]
	var $iscopyright = true;
	var $mark = "yui.jpg";
	var $position = "bottom-right";
	var $transparence = 80;
	#[可用于整个图片要调用变量]
	var $filepath = "";
	var $imginfo;#[图片数据]
	#[是否使用裁剪法来生成缩略图]
	var $iscut = false;
	#[如果水印图文件已经存在，是否覆盖]
	var $isrecover = true;

	function __construct($isgd=1,$quality=80)
	{
		$this->isgd = $isgd && function_exists("imagecreate") ? true : false;
		$this->quality = intval($quality);
		if(!$this->quality) $this->quality = 80;
	}

	#[兼容PHP4操作]
	function PHPOK_GD($isgd=1,$quality=80)
	{
		$this->__construct($isgd,$quality);
	}

	#[参数设置]
	function Set($var,$val="")
	{
		$this->$var = $val;
	}

	function isgd($isgd=true)
	{
		$this->isgd = $isgd ? true : false;
	}

	#[设置补白操作]
	function Filler($border=1,$color="DDDDDD",$bgcolor="",$bgimg="",$padding=0)
	{
		$this->border = $border;
		$this->color = strlen($color) == 6 ? $color : "DDDDDD";
		$this->bgcolor = strlen($bgcolor) == 6 ? $bgcolor : "";
		$this->bgimg = $bgimg && file_exists($bgimg) ? $bgimg : "";
		$this->padding = intval($padding);
	}

	#[设置版权]
	function CopyRight($mark="qinggan.jpg",$position="bottom-right",$transparence=80)
	{
		$this->mark = $mark && file_exists($mark) ? $mark : "";
		$this->position = $this->_check_position($position);
		$this->transparence = $transparence;
	}

	#[设置新图片的宽度和高度值]
	function SetWH($width=160,$height=120)
	{
		$this->width = $width ? $width : 160;
		$this->height = $height ? $height : 120;
	}

	#[设置是否使用裁剪法来生成缩略图]
	function SetCut($iscut=false)
	{
		$this->iscut = $iscut ? true : false;
	}

	#[判断是否写入版权]
	function iscopyright($iscopyright=true)
	{
		$this->iscopyright = $iscopyright ? true : false;
	}

	#[判断是否覆盖新图片]
	function isrecover($isrecover=true)
	{
		$this->isrecover = $isrecover ? true : false;
	}

	#

	#[根据提供图片生成新图片]
	#[source：源图必须含有路径]
	#[newpic：新图只能使用源图的路径]
	#[width：新图片的宽度]
	#[height：新图片的高度]
	function Create($source="",$newpic="",$width="",$height="")
	{
		if(!$this->isgd) return false;
		if(!file_exists($source)) return false;
		#[判断文件是否合法，不合法直接跳出]
		$chkext = strtolower(substr(basename($source),-3));
		if(strpos(",jpg,png,gif,",",".$chkext.",") === false) return false;
		$this->filepath = substr($source,0,-(strlen(basename($source))));
		if($newpic)
		{
			$newpic = str_replace(".jpg","",$newpic);
			$newpic = str_replace(".gif","",$newpic);
			$newpic = str_replace(".png","",$newpic);
		}
		$newpic = $this->_cc_picname($newpic);
		$this->imginfo = $this->GetImgInfo($source);#[取得图片的基本信息]
		#[判断新文件名是否存在，存在即再重命名一下]
		$recover = $this->isrecover;
		if(file_exists($this->filepath."/".$newpic.".".$this->imginfo["ext"]) && !$recover)
		{
			$newpic .= "_".substr(md5(rand(0,9999)),9,16);
		}
		#[设置新图的高度]
		$width = intval($width);
		$height = intval($height);
		if($width && $height)
		{
			$this->SetWH($width,$height);
		}
		else
		{
			$this->width = $width ? $width : $this->width;
			$this->height = $height ? $height : $this->height;
		}
		#[根据大图获取能生成的实际小图]
		$getPicWH = $this->iscut ? $this->_cutimg() : $this->_get_newpicWH();
		if(!$getPicWH) return false;
		#[计算整个新图片的宽度和高度]
		$allpicheight = $this->height + ($this->padding*2) + ($this->border ? 2 : 0);
		$allpicwidth = $this->width + ($this->padding*2) + ($this->border ? 2 : 0);
		#[开始画图]
		return $this->_create_img($source,$newpic,$allpicwidth,$allpicheight,$getPicWH);
	}

	#[获取图片的相关数据]
	function GetImgInfo($picture="")
	{
		if(!$picture || !file_exists($picture)) return false;
		$infos = getimagesize($picture);
		$info["width"] = $infos[0];
		$info["height"] = $infos[1];
		$info["type"] = $infos[2];
		#[强制设置图片的类型]
		$info["ext"] = $infos[2] == 1 ? "gif" : ($infos[2] == 2 ? "jpg" : "png");
		#[设置图片的名称]
		$info["name"] = substr(basename($picture),0,strrpos(basename($picture),"."));
		return $info;
	}

	#[判断设置的位置是否正确]
	function _check_position($position="")
	{
		if(!$position) return "bottom-right";
		$position = strtolower($position);
		$check = ",top-left,top-middle,top-right";
		$check.= ",middle-left,middle-middle,middle-right";
		$check.= ",bottom-left,bottom-middle,bottom-right,";
		if(strpos($check,",".$position.",") !== false)
		{
			return $position;
		}
		else
		{
			return "bottom-right";
		}
	}

	#[判断或创建一个新的图片名称]
	function _cc_picname($name="",$length=10)
	{
		$length = intval($length);
		if($length<5)
		{
			$length = 5;
		}
		$newname = true;#[检测名称是否合法，不合法时将自动重新命名]
		if($name)
		{
			$newname = false;#[改变状态，设为不重命名]
			#$name = str_replace(strstr(".",$name),"",$name);
			$name = strtolower($name);#[全部变成小写的]
			$w = "abcdefghijklmnopqrstuvwxyz_0123456789";
			$length = strlen($name);
			if($length<1)
			{
				$newname = true;
			}
			else
			{
				for($i=0;$i<$length;$i++)
				{
					if(strpos($w,$name[$i]) === false)
					{
						$newname = true;#[检测到这一步，说明新文件名中带有不合法的字符，将重新命名]
					}
				}
			}
		}
		if($newname || !$name)
		{
			$string = md5(rand(0,9999)."-".rand(0,9999)."-".rand(0,9999));
			$name = substr($string,rand(0,(32-$length)),10);
		}
		return $name;
	}

	#[根据已提供的信息计算出新图的相关参数]
	function _get_newpicWH()
	{
		$info = ($this->imginfo["width"] && $this->imginfo["height"])  ? $this->imginfo : false;
		if(!$info) return false;
		#$phpok_width = $this->width > $info["width"] ? $info["width"] : $this->width;
		#$phpok_height = $this->height > $info["height"] ? $info["height"] : $this->height;
		#[判断原图和新图的宽高比的大小比例，以确定使用哪个为基准]
		$rate_width = $info["width"]/$this->width;
		$rate_height = $info["height"]/$this->height;
		if($rate_width>$rate_height)
		{
			$array["width"] = $this->width;
			$array["height"] = round(($this->width*$info["height"])/$info["width"]);
		}
		else
		{
			$array["height"] = $this->height;
			$array["width"] = round(($info["width"]*$this->height)/$info["height"]);
		}
		$array["tempx"] = $this->imginfo["width"];
		$array["tempy"] = $this->imginfo["height"];
		$array["srcx"] = 0;
		$array["srcy"] = 0;
		return $array;
	}

	#[将十六进制转成RGB格式]
	function _to_rgb($color="")
	{
		if(!$color) return false;
		if(strlen($color) != 6) return false;
		$color = strtolower($color);
		$array["red"] = hexdec(substr($color,0,2));
		$array["green"] = hexdec(substr($color,2,2));
		$array["blue"] = hexdec(substr($color,4,2));
		return $array;
	}

	function _create_img($source,$newpic,$width,$height,$getpicWH)
	{
		$truecolor = function_exists("imagecreatetruecolor") ? true : false;
		if($truecolor)
		{
			$img = imagecreatetruecolor($width,$height);
		}
		else
		{
			$img = imagecreate($width,$height);
		}
		#[颜色转成十进制]
		$bg = $this->_to_rgb($this->bgcolor);
		$bg["red"] = $bg["red"] ? $bg["red"] : 0;
		$bg["green"] = $bg["green"] ? $bg["green"] : 0;
		$bg["blue"] = $bg["blue"] ? $bg["blue"] : 0;
		$bgfill = imagecolorallocate($img,$bg["red"],$bg["green"],$bg["blue"]);
		#[填充背景色]
		imagefill($img,0,0,$bgfill);
		#[判断是否有背景框]
		if($this->bgimg)
		{
			$nbg_picImg = $this->_get_imgfrom($this->bgimg);
			$nbg_picInfo = $this->GetImgInfo($this->bgimg);
			imagecopy($img,$nbg_picImg,0,0,0,0,$nbg_picInfo["width"],$nbg_picInfo["height"]);
		}
		#[在图片上画－线条]
		if($this->border)
		{
			$bc = $this->_to_rgb($this->color);
			$bc["red"] = $bc["red"] ? $bc["red"] : 0;
			$bc["green"] = $bc["green"] ? $bc["green"] : 0;
			$bc["blue"] = $bc["blue"] ? $bc["blue"] : 0;
			#[设置距形框的颜色值]
			$bcolor = imagecolorallocate($img,$bc["red"],$bc["green"],$bc["blue"]);
			#[画一距矩形框]
			imagerectangle($img,0,0,$width-1,$height-1,$bcolor);
		}
		#[被框架的图片的位置]
		$picX = ($width-$getpicWH["width"])/2;
		$picY = ($height-$getpicWH["height"])/2;
		#[采集原图样本信息]
		$tmpImg = $this->_get_imgfrom($source);
		if(!$tmpImg) return false;
		if($truecolor)
		{
			imagecopyresampled($img,$tmpImg,$picX,$picY,$getpicWH["srcx"],$getpicWH["srcy"],$getpicWH["width"],$getpicWH["height"],$getpicWH["tempx"],$getpicWH["tempy"]);
		}
		else
		{
			imagecopyresized($img,$tmpImg,$picX,$picY,$getpicWH["srcx"],$getpicWH["srcy"],$getpicWH["width"],$getpicWH["height"],$getpicWH["tempx"],$getpicWH["tempy"]);
		}
		#[判断是否要求写入版权图片]
		if($this->iscopyright && $this->mark)
		{
			$npicImg = $this->_get_imgfrom($this->mark);
			$npicInfo = $this->GetImgInfo($this->mark);
			$getPosition = $this->_set_position($npicInfo,$width,$height);
			imagecopymerge($img,$npicImg,$getPosition["x"],$getPosition["y"],0,0,$npicInfo["width"],$npicInfo["height"],$this->transparence);
		}
		#[如果新图片存在，则删除新图片]
		$newpicfile = $this->filepath.$newpic.".".$this->imginfo["ext"];
		if(file_exists($newpicfile))
		{
			@unlink($newpicfile);
		}
		#[写入数据]
		$this->_write_imgto($img,$newpicfile,$this->imginfo["type"]);
		imagedestroy($tmpImg);
		imagedestroy($img);
		#[销毁相框]
		if($this->bgimg)
		{
			imagedestroy($nbg_picImg);
		}
		#[销毁版权的图片]
		if($npicImg)
		{
			imagedestroy($npicImg);
		}
		return basename($newpicfile);#[返回生成的图片名称]
	}

	#[获取图片数据流信息]
	function _get_imgfrom($pic)
	{
		$info = $this->GetImgInfo($pic);
		if($info["type"] == 1 && function_exists("imagecreatefromgif"))
		{
			$img = imagecreatefromgif($pic);
		}
		elseif($info["type"] == 2 && function_exists("imagecreatefromjpeg"))
		{
			$img = imagecreatefromjpeg($pic);
		}
		elseif($info["type"] == 3 && function_exists("imagecreatefrompng"))
		{
			$img = imagecreatefrompng($pic);
		}
		else
		{
			$img = "";
		}
		return $img;
	}

	function _write_imgto($temp_image,$newfile,$info_type)
	{
		if($info_type == 1)
		{
			imagegif($temp_image,$newfile);
		}
		elseif($info_type == 2)
		{
			imagejpeg($temp_image,$newfile,$this->quality);
		}
		elseif($info_type == 3)
		{
			imagepng($temp_image,$newfile);
		}
		else
		{
			#[如果不存在这些条件，那将文件改为png的缩略图]
			$newfile = $newfile.".png";
			if(file_exists($newfile))
			{
				unlink($newfile);
			}
			imagepng($temp_image,$newfile);
		}
	}

	function _set_position($npicInfo,$width,$height)
	{
		if(!$npicInfo) return array("x"=>0,"y"=>0);
		$x = $this->border ? 1 : 0;
		$y = $this->border ? 1 : 0;
		if($this->position == "top-left")
		{
			$x = $this->border ? 1 : 0;
			$y = $this->border ? 1 : 0;
		}
		elseif($this->position == "top-middle")
		{
			if($npicInfo["width"] < $width)
			{
				$x = ($width - $npicInfo["width"])/2 - ($this->border ? 1 : 0);
			}
		}
		elseif($this->position == "top-right")
		{
			if($npicInfo["width"] < $width)
			{
				$x = $width - $npicInfo["width"] - ($this->border ? 1 : 0);
			}
		}
		elseif($this->position == "middle-left")
		{
			if($npicInfo["height"] < $height)
			{
				$y = ($height - $npicInfo["height"])/2 - ($this->border ? 1 : 0);
			}
		}
		elseif($this->position == "middle-middle")
		{
			if($npicInfo["height"] < $height)
			{
				$y = ($height - $npicInfo["height"])/2 - ($this->border ? 1 : 0);
			}
			if($npicInfo["width"] < $width)
			{
				$x = ($width - $npicInfo["width"])/2 - ($this->border ? 1 : 0);
			}
		}
		elseif($this->position == "middle-right")
		{
			if($npicInfo["height"] < $height)
			{
				$y = ($height - $npicInfo["height"])/2 - ($this->border ? 1 : 0);
			}
			if($npicInfo["width"] < $width)
			{
				$x = $width - $npicInfo["width"] - ($this->border ? 1 : 0);
			}
		}
		elseif($this->position == "bottom-left")
		{
			if($npicInfo["height"] < $height)
			{
				$y = $height - $npicInfo["height"] - ($this->border ? 1 : 0);
			}
		}
		elseif($this->position == "bottom-middle")
		{
			if($npicInfo["height"] < $height)
			{
				$y = $height - $npicInfo["height"] - ($this->border ? 1 : 0);
			}
			if($npicInfo["width"] < $width)
			{
				$x = ($width - $npicInfo["width"])/2 - ($this->border ? 1 : 0);
			}
		}
		else
		{
			if($npicInfo["height"] < $height)
			{
				$y = $height - $npicInfo["height"] - ($this->border ? 1 : 0);
			}
			if($npicInfo["width"] < $width)
			{
				$x = $width - $npicInfo["width"] - ($this->border ? 1 : 0);
			}
		}
		return array("x"=>$x,"y"=>$y);
	}

	#[使用裁剪法根据已提供的信息计算出新图的相关参数]
	function _cutimg()
	{
		$width = $this->width;
		$height = $this->height;
		$info_width = $this->imginfo["width"];
		$info_height = $this->imginfo["height"];
		$info["width"] = $info_width;
		$info["height"] = $info_height;
		$rate_width = $width / $info["width"];
		$rate_height = $height / $info["height"];
		if($info["width"] >= $width && $info["height"] > $height)
		{
			if($info["width"] > $info["height"])
			{
				$tempx = $width / $rate_height;
				$tempy = $info["height"];
				$srcx = ($info["width"] - $tempx) / 2;
				$srcy = 0;
			}
			else
			{
				$tempx = $info["width"];
				$tempy = $height / $rate_width;
				$srcx = 0;
				$srcy = ($info["height"] - $tempy) / 2;
			}
		}
		else
		{
			if($info["width"] > $info["height"])
			{
				$tempx = $width;
				$tempy = $info["height"];
				$srcx = ($info["width"] - $tempx) / 2;
				$srcy = 0;
			}
			else
			{
				$tempx = $info["width"];
				$tempy = $height;
				$srcx = 0;
				$srcy = ($info["height"] - $tempy) / 2;
			}
		}
		$array["height"] = $this->height;
		$array["width"] = $this->width;
		$array["tempx"] = $tempx;
		$array["tempy"] = $tempy;
		$array["srcx"] = $srcx;
		$array["srcy"] = $srcy;
		return $array;
	}

	#[兼容旧版操作]
	function thumb($filename,$width="",$height="")
	{
		global $system;
		if($system)
		{
			#[判断使用的方法，裁剪法或缩放法]
			$iscut = $system["gdthumbtype"] ? true : false;
			$this->SetCut($iscut);
			#[设置补白操作]
			$border = $system["thumbborder"] ? 1 : 0;
			$color = $system["thumbcolor"] ? $system["thumbcolor"] : "000000";
			$bgcolor = $system["thumbbgcolor"] ? $system["thumbbgcolor"] : "FFFFFF";
			$bgimg = $system["thumbbgimg"] && file_exists($system["thumbbgimg"]) ? $system["thumbbgimg"] : "";
			$padding = intval($system["thumbpadding"]);
			$this->Filler($border,$color,$bgcolor,$bgimg,$padding);
			#[设置版权操作]
			$iscopyright = $system["thumbiscopyright"] ? true : false;
			$this->iscopyright($iscopyright);
			$picture = $system["thumbcopyright"];
			$position = $system["thumbposition"];
			$transpance = intval($system["thumbtranspance"]) > 0 ? intval($system["thumbtranspance"]) : 60;
			$this->CopyRight($picture,$position,$transpance);
			#[设置缩略图的宽度和高度]
			//$thumbwidth = $system["thumbwidth"] ? $system["thumbwidth"] : 130;
			//$thumbheight = $system["thumbheight"] ? $system["thumbheight"] : 130;
			
			$infos = getimagesize($filename);
			$thumbwidth = $infos[0];
			$thumbheight = $infos[1];
			$this->SetWH($thumbwidth,$thumbheight);
		}
		$newfile = "thumb_".basename($filename);
		return $this->Create($filename,$newfile,$width,$height);
	}

	#[生成水印图片]
	function mark($filename,$width="",$height="")
	{
		global $system;
		if($system)
		{
			#[判断使用的方法，裁剪法或缩放法]
			$iscut = $system["gdmarktype"] ? true : false;
			$this->SetCut($iscut);
			#[设置补白操作]
			$border = $system["markborder"] ? 1 : 0;
			$color = $system["markcolor"] ? $system["markcolor"] : "000000";
			$bgcolor = $system["markbgcolor"] ? $system["markbgcolor"] : "FFFFFF";
			$bgimg = $system["markbgimg"] && file_exists($system["markbgimg"]) ? $system["markbgimg"] : "";
			$padding = intval($system["markpadding"]);
			$this->Filler($border,$color,$bgcolor,$bgimg,$padding);
			#[设置版权操作]
			$iscopyright = $system["markiscopyright"] ? true : false;
			$this->iscopyright($iscopyright);
			$picture = $system["markcopyright"];
			$position = $system["markposition"];
			$transpance = intval($system["marktranspance"]) > 0 ? intval($system["marktranspance"]) : 60;
			$this->CopyRight($picture,$position,$transpance);
			#[设置水印图的宽度和高度]
			$markwidth = $system["markwidth"] ? $system["markwidth"] : 450;
			$markheight = $system["markheight"] ? $system["markheight"] : 450;
			$this->SetWH($markwidth,$markheight);
		}
		$this->iscopyright(true);#[使用水印]
		$newfile = "mark_".basename($filename);
		return $this->Create($filename,$newfile,$width,$height);
	}
}
?>