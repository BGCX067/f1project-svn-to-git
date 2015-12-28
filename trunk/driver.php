<?php 
require_once("global.php");
$C_Driver = $CF->build("driver");

if($act == "add")
{
	$site_title = "预约试驾  - ".$system["sitename"];
	#[向导栏]
	$lead_menu[0]["url"] = "driver.php";
	$lead_menu[0]["name"] = "预约试驾";
	$lead_menu[1]["url"] = "driver.php?act=add";
	$lead_menu[1]["name"] = "添加留言";
}
elseif($act == "addok")
{
	$subject = $STR->safe($subject);
	$content = $STR->safe($content);
	$phone = $STR->safe($phone);
	$IsNotDriver = $STR->safe($IsNotDriver);
	if(!$subject)
	{
		Error("主题不能为空","driver.php?act=add");
	}
	$user_name = $STR->safe($qgusername);
	 $email = $STR->safe($email);
	if(!$user_name)
	{
		Error("用户名称不能为空","driver.php?act=add");
	}
	if(!$phone)
	{
		Error("电话不能为空","driver.php?act=add");
	}
	if(!ereg("^[-a-zA-Z0-9_\.]+\@([0-9A-Za-z][0-9A-Za-z-]+\.)+[A-Za-z]{2,5}$",$email))
	{
		Error("邮箱格式不正确","driver.php?act=add");
	}
	#[是否审核]
	$ifcheck = 0;#[设为未审核，只能管理员在后台设置审核后前台才能看到]
	#[入库]
	$array["user"] = $user_name;
	$array["subject"] = $subject;
	$array["content"] = $content;
	$array["postdate"] = $system_time;
	$array["email"] = $email;
	$array["phone"] = $phone;
	$array["IsNotDriver"] = $IsNotDriver;
	$array["ifcheck"] = $ifcheck;
	$C_Driver->InsertBook($array);

	Error("预约已经提交！","driver.php?act=list");
}

#[标题头]
	$site_title = "预约试驾 - ".$system["sitename"];

$TPL->p("driver");
REWRITE();

?>