<?php if(!defined("PHPOK_SET")){exit("Access Denied");}?>
<!-- inc:inc.head -->
<!-- 站内公告页模板 -->
<div align="center">
<div id="body">
<div class="table">

	<div id="left"><!-- inc:inc.left --></div>

	<div id="right">
		<!-- $rslist AS $key=>$value -->
		<div>
			<div class="global_sub"><div class="incbg"><a name="{:$value[id]}"></a><a href="notice.php?id={:$value[id]}#{:$value[id]}">{:$value[subject]}</a></div></div>
			<div class="border_no_top">
				<div style="padding:5px;">
					<div>{:$value[content]}</div>
					<div align="right">{:date("Y-m-d H:i:s",$value[postdate])}</div>
				</div>
			</div>
			<div class="space_between"><div class="space_between"></div></div>
		</div>
		<!-- end -->
	</div>
	<div class="clear"></div>

</div>
</div>
</div>

<!-- inc:inc.foot -->