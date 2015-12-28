<?php
#[网站封面信息]
header("Location:home.php");
exit;
require_once("global.php");


$site_title = $system["sitename"];
$TPL->p("index");
REWRITE();
?>