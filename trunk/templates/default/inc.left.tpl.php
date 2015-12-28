<?php if(!defined("PHPOK_SET")){exit("Access Denied");}?>
<!-- if($catelist) -->
		<!-- $catelist AS $key=>$value -->
		<li><a id="side-1"  href="{:$value[url]}" {:$value[target]} style="{:$value[style]}">{:$value[subject]}</a></li>
		<!-- end -->
	<!-- run:unset($catelist) -->
<!-- end -->