<script>
Valid = {"RNick":false,"REmail":false,"RPass":false,"RRepass":false,"RCaptcha":false};
function Validate(source,patterns,errors) {
	var error="";	
	for (var i=0;i<patterns.length;++i) {
	if (patterns[i].test(source.value)) {
	Valid[source.id]=true;
	document.getElementById(source.id+'E').style.display="none";
document.getElementById(source.id+'E').innerHTML="";
source.style.borderColor="black";
}
	else {
	Valid[source.id]=false;
	error=errors[i];
	source.style.borderColor="red";
	break;
}
}
if (source.id=="RRepass") {
	error=source.value==document.getElementById('RPass').value?error:'Passwords dont match';
	if (error) {
	Valid[source.id]=false;
}
}
if (source.id=="RCaptcha") {
	error=source.value==captcha?error:"Captcha doesnt match";
	if (error) {
	Valid[source.id]=false;
	drawCanvas();
}
}
document.getElementById(source.id+'E').style.display="inline";
document.getElementById(source.id+'E').innerHTML=error;
}
function drawCanvas() {
	var canvas = document.getElementById("captcha");
	canvas.width=canvas.width;
	captcha="";
	var element=-1;
	while (captcha.length<=7)
	{
	element=Math.floor(Math.random()*100+1);
	if ((element>=65&&element<=90)||(element>=97&&element<=122)||(element>=48&&element<=57)) {
	captcha+= String.fromCharCode(element);
}
	}
	var ctx=canvas.getContext("2d");
	ctx.fillStyle="#606060";
ctx.fillRect(0,0,200,100);
ctx.font="30px Comic Sans MS";
ctx.strokeText(captcha,10,50);
var i=17;
while (i){
var y = Math.random()*100;
var x = Math.random()*200;
var ye = Math.random()*100;
var xe = Math.random()*200;
if ((Math.abs(xe-x)>30)||(Math.abs(ye-y)>30)) {
ctx.moveTo(x,y);
ctx.lineTo(xe,ye);
ctx.stroke();
i--;
}
}
}
function Submit() {
	var i;
	var submit = true
	for (i in Valid) {
	submit = Valid[i]?submit:false;
}
if (submit) {
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
var url="LAS/DBsubmit.php?Nick="+document.getElementById("RNick").value+"&Email="+document.getElementById("REmail").value+"&Pass="+document.getElementById("RPass").value;
request.open("POST",url,true);
request.onreadystatechange = function () {
if (request.readyState == 4) {
							
				if (request.status == 200) {
				document.getElementById('SignUpForm').style.display='none';
				document.getElementById('Replacement').innerHTML="You have successfully registered "+request.responseText+", Login to continue."	
				}
		}	
};
request.send(null);
}
}
</script>
<style>
#SignUp table input
{
border:2px solid;
border-radius:5px;
}
#Replacement
{
color: lightskyblue;
font-size: 150%;
}
.error
{
display: none;
color: red;
font-size: 75%;
}
</style>
<div id="Replacement"></div>
<table id="SignUpForm">
<tr><td><label>Choose a Nick</label></td><td><input type="text" id="RNick" name="RNick" onblur="Validate(this,[/^.{6,15}/,/\w/],['Should contain atleast 6 characters','Must be a alphanumeric']);" /></td><td><span id="RNickE" class="error"></span></td></tr>
<tr><td><label>Enter your Email</label></td><td><input type="text" id="REmail" name="REmail" onblur="Validate(this,[/^./,/^\w[\w\.\+\-]+[@]\w{2,}[.]\w{2,3}/,/@(?!(spambot|mailinator))/],['Cant be empty','Not a Valid Email','Not a Valid Domian']);"/></td><td><span id="REmailE" class="error"></span></td></tr>
<tr><td><label>Choose a Password</label></td><td><input type="password" id="RPass" name="RPass" onchange="document.getElementById('RRepass').value='';" onblur="Validate(this,[/^./,/\w{6,15}/],['Should contain atleast 6 characters','Must be a alphanumeric']);"/></td><td><span id="RPassE" class="error"></span></td></tr>
<tr><td><label>Enter Password Again</label></td><td><input type="password" id="RRepass" name="RRepass" onblur="Validate(this,[/^./],['Cant be Empty']);"/></td><td><span id="RRepassE" class="error"></span></td></tr>
<tr><td><canvas id="captcha" width="200px" height="100px" style="border:thin solid black;cursor:pointer;" onclick="drawCanvas();"></canvas></td><td><input id="RCaptcha" type="text" onblur="Validate(this,[/.+/],['Cant be empty(Click on the image to change it)']);"></td><td><span id="RCaptchaE" class="error"></span></td></tr>
<tr><td></td><td><input type="button" value="Sign Me Up"/ onclick="Submit();"></td></tr>
</table>