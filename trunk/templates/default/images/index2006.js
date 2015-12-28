//index_2006
var index01 ="";
var index02 ="";
var index03 ="";
pinzhong ="";

if (pinpai.indexOf("RX-8")>0) {
  pinzhong ="_rx8";
}


//index01
index01 ="<object classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" ";
index01 +="codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0\" ";
index01 +="width=\"555\" height=\"330\">";
index01 +="<param name=\"movie\" value=\"http://www.faw-mazda.com/shop/flash/index01"+pinzhong+".swf\">";
index01 +="<param name=\"quality\" value=\"high\">";
index01 +="<embed src=\"http://www.faw-mazda.com/shop/flash/index01"+pinzhong+".swf\" quality=\"high\" ";
index01 +="pluginspage=\"http://www.macromedia.com/go/getflashplayer\" ";
index01 +="type=\"application/x-shockwave-flash\" width=\"555\" height=\"330\">";
index01 +="</embed></object>";

//index02

index02 ="<object classid=\"clsid:d27cdb6e-ae6d-11cf-96b8-444553540000\" ";
index02 +="codebase=\"http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0\" ";
index02 +="width=\"211\" height=\"340\">";
index02 +="<param name=\"allowScriptAccess\" value=\"sameDomain\">";
index02 +="<param name=\"movie\" value=\"flash/index02.swf\">";
index02 +="<param name=\"quality\" value=\"high\">";
index02 +="<param name=\"bgcolor\" value=\"#ffffff\">";
index02 +="<param name=\"menu\" value=\"false\">";
index02 +="<param name=wmode value=\"opaque\">";

//index02 +="<param name=\"FlashVars\" value=\"names=走进"+name+"&tel1="+selltel+"&tel2="+serve+"\">";
index02 +="<param name=\"FlashVars\" value=\"names=走进"+name+"&tel1="+selltel+"&tel2="+serve+"&netUrl="+netUrl+"\">";
index02 +="<embed src=\"flash/index02.swf\" wmode=\"opaque\" ";
//index02 +="FlashVars=\"names=走进"+name+"&tel1="+selltel+"&tel2="+serve+"\" ";
index02 +="FlashVars=\"names=走进"+name+"&tel1="+selltel+"&tel2="+serve+"&netUrl="+netUrl+"\" ";
index02 +="menu=\"false\" bgcolor=\"#ffffff\" quality=\"high\" width=211 height=340 allowScriptAccess=\"sameDomain\" ";
index02 +="type=\"application/x-shockwave-flash\" pluginspage=\"http://www.macromedia.com/go/getflashplayer\">";
index02 +="</embed></object>";

//index03
index03 ="<object classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" ";
index03 +="odebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0\" ";
index03 +="width=\"211\" height=\"196\">";
index03 +="<param name=\"movie\" value=\"http://www.faw-mazda.com/shop/flash/index03"+pinzhong+".swf\">";
index03 +="<param name=\"quality\" value=\"high\">";
index03 +="<embed src=\"http://www.faw-mazda.com/shop/flash/index03"+pinzhong+".swf\" quality=\"high\" ";
index03 +="pluginspage=\"http://www.macromedia.com/go/getflashplayer\" ";
index03 +="type=\"application/x-shockwave-flash\" width=\"211\" height=\"196\">";
index03 +="</embed></object>";
