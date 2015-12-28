<?php
#[网站首页]
#[网站封面信息]
require_once("global.php");

$site_title = $system["sitename"];
$TPL->p("home");
REWRITE();
?>