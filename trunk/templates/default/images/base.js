activateMenu = function(nav,style) {

    /* currentStyle restricts the Javascript to IE only */
	//if (document.all && document.getElementById(nav).currentStyle) {  
	if (!document.getElementById(nav)) {
		return;
	}
	if(style) { var _style = style; }
	
	var navroot = document.getElementById(nav);
	
	/* Get all the list items within the menu */
	var lis=navroot.getElementsByTagName("LI");  
	for (i=0; i<lis.length; i++) {		
		/* If the LI has another menu level */
		//if(lis[i].lastChild.tagName=="UL"){
		//if(lis[i].getElementsByTagName("ul")[0].tagName=="UL"){
		/* assign the function to the LI */
		lis[i].onmouseover=function() {			
			/* display the inner menu */
			//this.lastChild.style.display="block";
			//if(this.getElementsByTagName("ul")[0]){ alert(this.getElementsByTagName("ul")[0].style.display); }
			if(this.getElementsByTagName("ul")[0]){
				this.getElementsByTagName("ul")[0].style.display="block";
			}
		}
		lis[i].onmouseout=function() {                       
			//this.lastChild.style.display="none";
			if(this.getElementsByTagName("ul")[0]){
				if(this.getElementsByTagName("ul")[0].className == _style){
					return;
				} else {
					this.getElementsByTagName("ul")[0].style.display="none";
				}
			}
		}
	}
	//}
//}
}
window.onload = function(e) {
	  activateMenu('site-menu');
	  activateMenu('side-services','show');
	  activateMenu('foot-menu');
	  activateMenu('dealers-home');
}



function qgcheckaddbook()
{
	var username = $("qgusername").value;
	var email = $("email").value;
	if(!username)
	{
		alert("姓名不能为空！");
		$("qgusername").focus();
		return false;
	}
	if(!email)
	{
		alert("邮箱不能为空！");
		$("email").focus();
		return false;
	}
	var str_reg=/^\w+((-\w+)|(\.\w+))*\@{1}\w+\.{1}\w{2,4}(\.{0,1}\w{2}){0,1}/ig;
	if (email.search(str_reg) == -1)
	{
		alert("邮箱格式正确！");
		$("email").value = "";
		$("email").focus();
		return false;
	}
	var subject = $("subject").value;
	if(!subject)
	{
		alert("主题不允许为空！");
		$("subject").focus();
		return false;
	}
	var content = $("content").value;
	if(!content)
	{
		alert("留言内容不允许为空！");
		return false;
	}
	$("qgsubmit").disabled = true;
	return true;
}