<?php if(!defined("PHPOK_SET")){exit("Access Denied");}?>
<!-- inc:inc.head -->
<div align="center">
<div id="body">
<div class="table">

	<div id="left"><!-- inc:inc.left --></div>

	<div id="right">
		<div class="global_sub">{:$vote_subject}</div>
		<div class="border_no_top">
			<div style="padding:5px;">
				<!-- if($isvote || $act == "view") -->
					<!-- $vote_list AS $key=>$value -->
					<div class="vote_list">{:$value[subject]} [{:$value[vcount]}]</div>
					<div class="vote_img"><img src="images/voteline.gif" border="0" width="{:$value[img_width]}" height="13px" align="absmiddle"> （{:$value[bili]}%）</div>
					<div class="space_between"><img src="images/blank.gif" border="0" width="1" height="1"></div>
					<!-- end -->
				<!-- else -->
				<div style="display:none;"><form method="post" action="vote.php?id={:$id}&act=submit"></div>
					<!-- $vote_list AS $key=>$value -->
					<div class="vote_list">{:$value[vote_input]} {:$value[subject]}</div>
					<div class="space_between"><img src="images/blank.gif" border="0" width="1" height="1"></div>
					<!-- end -->
					<div class="vote_list"><div align="center"><input type="submit" value="投 票"></div></div>
				<div style="display:none;"></form></div>
				<!-- end -->
			</div>
		</div>
	</div>
	<div style="clear:both;height:0px;"></div>

</div>
</div>
</div>


<!-- inc:inc.foot -->