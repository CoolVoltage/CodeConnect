function toggle_form() {
	document.getElementById('Sheet').style.display=document.getElementById('Sheet').style.display=="none"?"block":"none";
	document.getElementById('SignUp').style.display=document.getElementById('SignUp').style.display=="none"?"block":"none";
}
function Check_Login() {
if (document.getElementById("Nick").value && document.getElementById('password').value) {
try {
request = new XMLHttpRequest();
} catch (tryMS) {
	try {
		request = new ActiveXObject("Msxm12.XMLHTTP");
	} catch (otherMS) {
		try {
			request = new ActiveXObject("Microsoft.XMLHTTP");
		}	catch (failed) 
		{request = null;
	}
}
}
var url="LAS/DBget.php?Nick="+document.getElementById("Nick").value+"&Pass="+document.getElementById("password").value;
request.open("POST",url,true);
request.onreadystatechange = function () {
if (request.readyState == 4) {
							
				if (request.status == 200) {
				if (request.responseText==1) {
				location.reload();				
				/*document.getElementById('LoginFields').style.display="none";
				document.getElementById('NickDisplay').style.display="block"
				document.getElementById('NickSpan').innerHTML="Welcome <b><i>"+document.getElementById("Nick").value+'</i></b>';*/
				
}
				else {
				document.getElementById('ELogin').innerHTML='Error in Field Values';
				document.getElementById('ELogin').style.display="inline";
}
				}
		}	
};
request.send(null);
}
else {
	document.getElementById('ELogin').innerHTML='Cant leaves field(s) empty';
	document.getElementById('ELogin').style.display="inline";
}	
}
function Induce_LAS() {
/*if (session) {
				document.getElementById('LoginFields').style.display="none";
				document.getElementById('NickDisplay').style.display="block"
				document.getElementById('NickSpan').innerHTML="Welcome <b><i>"+session+'</i></b>';		
}*/
	drawCanvas();
	document.getElementById('Sheet').style.display="none";
	document.getElementById('SignUp').style.display="none";
	document.getElementById('Sheet').onclick = toggle_form;
}