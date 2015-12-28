<?php
#[留言本]
require_once("global.php");
$C_Book = $CF->build("book");
if($act == "add")
{
	$site_title = "添加留言 - 留言本 - ".$system["sitename"];
	#[向导栏]
	$lead_menu[0]["url"] = "book.php";
	$lead_menu[0]["name"] = "留言本";
	$lead_menu[1]["url"] = "book.php?act=add";
	$lead_menu[1]["name"] = "添加留言";
}
elseif($act == "addok")
{
	$subject = $STR->safe($subject);
	$content = $STR->safe($content);
	if(!$subject)
	{
		Error("主题不能为空","book.php?act=add");
	}
	if(!$content)
	{
		Error("内容不能为空","book.php?act=add");
	}
	$user_name = $STR->safe($qgusername);
	$email = $STR->safe($email);
	if(!$user_name)
	{
		Error("用户名称不能为空","book.php?act=add");
	}
	if(!$email)
	{
		Error("邮箱不能为空","book.php?act=add");
	}
	if(!ereg("^[-a-zA-Z0-9_\.]+\@([0-9A-Za-z][0-9A-Za-z-]+\.)+[A-Za-z]{2,5}$",$email))
	{
		Error("邮箱格式不正确","book.php?act=add");
	}
	#[是否审核]
	$ifcheck = 0;#[设为未审核，只能管理员在后台设置审核后前台才能看到]
	$phone = $STR->safe($phone);
	$address = $STR->safe($address);
	#[入库]
	$array["user"] = $user_name;
	$array["subject"] = $subject." | 电话:".$phone ." | 地址:".$address;
	$array["content"] = $content;
	$array["postdate"] = $system_time;
	$array["email"] = $email;
	$array["ifcheck"] = $ifcheck;
	$C_Book->InsertBook($array);
	Error("留言发布成功，需要经过管理员审核才能看到！","book.php?act=list");
}
else
{
	$id = intval($id);
	$condition = "ifcheck='1'";
	if($id)
	{
		$condition .= " AND id<='".$id."'";
	}
	$count = $C_Book->CountBook($condition);
	$url = "book.php?act=list";
	$psize = 4;
	$pageid = intval($pageid);
	$pagelist = page($url,$count,$psize,$pageid);
	$offset = $pageid>0 ? ($pageid-1)*$psize : 0;
	$rs = $C_Book->GetBook("list",$condition,$offset,$psize);
	$book_list = array();
	if(!$rs) $rs = array();
	foreach($rs AS $key=>$value)
	{
		$postdate_format = $system["timeformat"] ? $system["timeformat"] : "Y-m-d";
		$value["postdate"] = date($postdate_format,$value["postdate"]);
		$value["altSubject"] = $value["subject"];
		$booklength = intval($system["booklength"])>0 ? intval($system["booklength"]) : 30;
		$value["subject"] = $STR->cut($value["subject"],$booklength);
		$value["content"] = preg_replace("/<(.*?)>/is","",$value["content"]);
		$book_list[] = $value;
	}
	unset($rs);
	#[标题头]
	$site_title = "留言本 - ".$system["sitename"];
	#[向导栏]
	$lead_menu[0]["url"] = "book.php";
	$lead_menu[0]["name"] = "留言本";
}
$TPL->p("book");
REWRITE();
?>