//menu_2006
var dh="";
var lj="";
var menu_left="";
var banner="";
var ejlj ="*****";
var ejmc ="*****";
var sjlj = "*****";
var sjmc ="*****";
var ss;
ss=page.split("-");
pinzhong ="";
if (pinpai.indexOf("RX-8")>0) {
  pinzhong ="_rx8";
}
//预览
if (ss[0]=="0") {
  ejlj ="#*#****";
  ejmc ="预览页面*预览页面****";
  if (ss[1]=="1") {
    sjlj = "*#****";
    sjmc = "*预览页面****";
  }
}

//走进XXXX
if (ss[0]=="1") {
  ejlj ="about.aspx*about.aspx*job.aspx*address.aspx**";
  ejmc ="走进"+name+"*公司概况*诚聘英才*联系我们**";
  if (ss[1]=="1") {
    sjlj = "*about.aspx*report.aspx*personnel.aspx*disposal.aspx*";
    sjmc = "*公司概况*公司荣誉*优秀员工*公司展厅*";
  }
  if (ss[1]=="2") {
    sjlj = "*job.aspx*forjob.aspx***";
    sjmc ="*诚聘英才*在线简历***";
  }
  if (ss[1]=="3") {
    sjlj = "*address.aspx****";
    sjmc ="*联系我们****";
  }
}
//新闻中心
if (ss[0]=="2") {
  ejlj ="news.aspx*news.aspx*market.aspx***";
  ejmc ="快讯*市场快讯*促销活动***";
  if (ss[1]=="1") {
    sjlj = "*news.aspx****";
    sjmc ="*市场快讯****";
  }
  if (ss[1]=="2") {
    sjlj = "*market.aspx****";
    sjmc ="*促销活动****";
  }
}

//购车指南
if (ss[0]=="3") {
  ejlj ="buy.aspx*buy.aspx*buyknow.aspx*credit.aspx**";
  ejmc ="购车指南*车型展示*帮您选车*购车信贷**";
  if (ss[1]=="1") {
    sjlj = "*buy.aspx****";
    sjmc ="*车型展示****";
  }
  if (ss[1]=="2") {
    sjlj = "**buyknow.aspx*book.aspx*drive.aspx*";
    sjmc ="**购车常识*在线预定*预约试驾*";
  }
  if (ss[1]=="3") {
    sjlj = "*credit.aspx**creditfor.aspx**";
    sjmc ="*贷款常识**贷款服务**";
  }
}

//全心管家式服务
if (ss[0]=="4") {
  ejlj ="serve.aspx*serve.aspx*servicing.aspx*insure.aspx**";
  ejmc ="全心管家式服务*服务承诺*维修服务*增值服务**";
  if (ss[1]=="1") {
    sjlj = "*serve.aspx****";
    sjmc ="*服务承诺****";
  }
  if (ss[1]=="2") {
    sjlj = "*servicing.aspx*servictime.aspx*servicsave.aspx*http://www.faw-mazda.com/service/annex.aspx target=_blank*";
    sjmc ="*维修流程*维修时间*汽车救援*备件查询*";
  }
  if (ss[1]=="3") {
    sjlj = "*insure.aspx*insurefor.aspx*insurereport.aspx*beauty.aspx*";
    sjmc ="*保险理赔*保险代理*报险程序*汽车美容*";
  }
}

//车友俱乐部
if (ss[0]=="5") {
  ejlj ="club.aspx*club.aspx*ploynews.aspx***";
  ejmc ="车友俱乐部*俱乐部章程*车友活动***";
  if (ss[1]=="1") {
    sjlj = "*club.aspx*login.aspx***";
    sjmc ="*俱乐部章程*会员注册***";
  }
  if (ss[1]=="2") {
    sjlj = "*ploynews.aspx*ploy.aspx*story.aspx**";
    sjmc ="*最新活动*活动回顾*车主故事**";
  }
  if (ss[1]=="3") {
    sjlj = "*magazine.aspx****";
    sjmc ="*生活杂志****";
  }
}

//网站信息
if (ss[0]=="6") {
  ejlj ="map.aspx*map.aspx****";
  ejmc ="网站信息*网站信息****";
  if (ss[1]=="1") {
    sjlj = "*map.aspx*link.aspx*http://www.faw-mazda.com/ target=_blank*http://www.faw-mazda.com/admin/ target=_blank*";
    sjmc ="*网站地图*友情链接*企业网站*信息管理*";
  }
}

var ss1;
ss1 = ejlj.split("*");
var ejljz =new Array(ss1[0],ss1[1],ss1[2],ss1[3],ss1[4],ss1[5]);
var ss2;
ss2 = ejmc.split("*");
var ejmcz =new Array(ss2[0],ss2[1],ss2[2],ss2[3],ss2[4],ss2[5]);
var ss3;
ss3 = sjlj.split("*");
var sjljz =new Array(ss3[0],ss3[1],ss3[2],ss3[3],ss3[4],ss3[5]);
var ss4;
ss4 = sjmc.split("*");
var sjmcz =new Array(ss4[0],ss4[1],ss4[2],ss4[3],ss4[4],ss4[5]);


//栏目导航
//dh = "<a href="+ejljz[0]+">"+ejmcz[0]+"</a> - <a href="+ejljz[ss[1]]+">"+ejmcz[ss[1]]+"</a>";
if (ejljz[1]!="") {
  dh +="<a href=\""+ejljz[1]+"\"";
  if (ss[1]=="1") {
    dh += " class=\"blue\"";
  }
  dh +=">"+ejmcz[1]+"</a>";
}
if (ejljz[2]!="") {
  dh +=" | <a href=\""+ejljz[2]+"\"";
  if (ss[1]=="2") {
    dh += " class=\"blue\"";
  }
  dh +=">"+ejmcz[2]+"</a>";
}
if (ejljz[3]!="") {
  dh +=" | <a href=\""+ejljz[3]+"\"";
  if (ss[1]=="3") {
    dh += " class=\"blue\"";
  }
  dh +=">"+ejmcz[3]+"</a>";
}
if (ejljz[4]!="") {
  dh +=" | <a href=\""+ejljz[4]+"\"";
  if (ss[1]=="4") {
    dh += " class=\"blue\"";
  }
  dh +=">"+ejmcz[4]+"</a>";
}
if (ejljz[5]!="") {
  dh +=" | <a href=\""+ejljz[5]+"\"";
  if (ss[1]=="5") {
    dh += " class=\"blue\"";
  }
  dh +=">"+ejmcz[5]+"</a>";
}

//栏目内链接
if (sjmcz[1]!="") {
  lj += "<a href="+sjljz[1]+">";
  if (ss[2]=="1") {
    lj += "<img src=\"http://www.faw-mazda.com/shop/page/lm"+ss[0]+"-"+ss[1]+"-1on.jpg\" border=0></a>";
  } else {
    lj += "<img src=\"http://www.faw-mazda.com/shop/page/lm"+ss[0]+"-"+ss[1]+"-1.jpg\" border=0></a>";
  }
}
if (sjmcz[2]!="") {
  lj += "<a href="+sjljz[2]+">";
  if (ss[2]=="2") {
    lj += "<img src=\"http://www.faw-mazda.com/shop/page/lm"+ss[0]+"-"+ss[1]+"-2on.jpg\" border=0></a>";
  } else {
    lj += "<img src=\"http://www.faw-mazda.com/shop/page/lm"+ss[0]+"-"+ss[1]+"-2.jpg\" border=0></a>";
  }
}
if (sjmcz[3]!="") {
  lj += "<a href="+sjljz[3]+">";
  if (ss[2]=="3") {
    lj += "<img src=\"http://www.faw-mazda.com/shop/page/lm"+ss[0]+"-"+ss[1]+"-3on.jpg\" border=0></a>";
  } else {
    lj += "<img src=\"http://www.faw-mazda.com/shop/page/lm"+ss[0]+"-"+ss[1]+"-3.jpg\" border=0></a>";
  }
}
if (sjmcz[4]!="") {
  lj += "<a href="+sjljz[4]+">";
  if (ss[2]=="4") {
    lj += "<img src=\"http://www.faw-mazda.com/shop/page/lm"+ss[0]+"-"+ss[1]+"-4on.jpg\" border=0></a>";
  } else {
    lj += "<img src=\"http://www.faw-mazda.com/shop/page/lm"+ss[0]+"-"+ss[1]+"-4.jpg\" border=0></a>";
  }
}
if (sjmcz[5]!="") {
  lj += "<a href="+sjljz[5]+">";
  if (ss[2]=="5") {
    lj += "<img src=\"http://www.faw-mazda.com/shop/page/lm"+ss[0]+"-"+ss[1]+"-5on.jpg\" border=0></a>";
  } else {
    lj += "<img src=\"http://www.faw-mazda.com/shop/page/lm"+ss[0]+"-"+ss[1]+"-5.jpg\" border=0></a>";
  }
}

//BANNER
banner = "<object classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" ";
banner += "codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0\" ";
banner += "width=\"516\" height=\"126\"><param name=\"movie\" value=\"http://www.faw-mazda.com/shop/flash/shop02"+pinzhong+".swf\"><param ";
banner += "name=\"quality\" value=\"high\"><embed src=\"http://www.faw-mazda.com/shop/flash/shop02"+pinzhong+".swf\" quality=\"high\" ";
banner += "pluginspage=\"http://www.macromedia.com/go/getflashplayer\" type=\"application/x-shockwave-flash\" ";
banner += "width=\"516\" height=\"126\"></embed></object>";

//MENU
menu_left = "<object classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" ";
menu_left += "codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0\" ";
menu_left += "width=\"228\" height=\"570\"><param name=\"movie\" value=\"flash/shop01.swf\"><param name=\"quality\" ";
menu_left += "value=\"high\"><param name=\"FlashVars\" value=\"names=走进"+name+"\"><embed src=\"shop/flash/shop01.swf\" ";
menu_left += "flashvars=\"names=走进"+name+"\" quality=\"high\" ";
menu_left += "pluginspage=\"http://www.macromedia.com/go/getflashplayer\" ";
menu_left += "type=\"application/x-shockwave-flash\" width=\"228\" height=\"570\"></embed></object>";