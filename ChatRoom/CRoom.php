<html>
</head>
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Chat</title>
<link href="Style_Template.css" rel="stylesheet" type="text/css" />
<script>
not_changed=0;
not_busy =true;
function startinterval(cal)
{	
box=document.getElementById("box");
	
try {
Request = new XMLHttpRequest();
} catch (tryMS) {
	try {
		Request = new ActiveXObject("Msxm12.XMLHTTP");
	} catch (otherMS) {
		try {
			Request = new ActiveXObject("Microsoft.XMLHTTP");
		}	catch (failed) 
		{Request = null;
	}
}
}

var url = "ChatRoom/chat.xml";
Request.open("GET",url,true);
Request.onreadystatechange = getchat;
Request.send(null);
}
function getchat() {
	
	if (Request.readyState == 4) {
							
				if (Request.status == 200) 	
	{
	xml = Request.responseXML.documentElement;
	tag = xml.getElementsByTagName("CHAT");
 box=document.getElementById("box");
		if (not_changed!=tag.length) {
			not_changed=tag.length;
	while(box.firstChild)
box.removeChild(box.firstChild);
	for(var i=0;i<tag.length;++i)
{
nam = tag[i].getElementsByTagName("USER");
nameprint = nam[0].firstChild.nodeValue;
mess = tag[i].getElementsByTagName("MESSAGE");
nod=mess[0].firstChild;
messprint="";
while(nod)
{	messprint = messprint + nod.nodeValue;
	nod = mess[0].nextSibling;
}
if(nameprint)
{
//messag = nameprint + " : " + messprint;  
nameprint +=" : ";
spanU = document.createElement("span");
spanU.innerHTML = nameprint;
spanU.className="UserSpan";
spanM = document.createElement("span");
spanM.innerHTML = messprint;
spanM.className="MessageSpan";
box.appendChild(spanU);
box.appendChild(spanM);
brea = document.createElement("br");
box.appendChild(brea);
}
}		
}
$('#box').scrollTop(document.getElementById('box').scrollHeight);
}
if (not_busy) {
	setTimeout(looper,2000);
}
}
}
function sendmessage(cal)
{	
	document.getElementById("chat_button").disabled='disabled';
txt ="";
	 
	if(cal)
	{
	msg = document.getElementById("msg").value;		
	}
	else {
	{
	msg="empty";	
	}
}
	try {
smessage = new XMLHttpRequest();
} catch (tryMS) {
	try {
		smessage = new ActiveXObject("Msxm12.XMLHTTP");
	} catch (otherMS) {
		try {
			smessage = new ActiveXObject("Microsoft.XMLHTTP");
		}	catch (failed) 
		{smessage = null;
	}
}
}
not_busy=false;
var url = "ChatRoom/DBchat.php?matter="+msg;
smessage.open("GET",url,true);
smessage.onreadystatechange = clearchat;
smessage.send(null);
}
function clearchat() {

	if (smessage.readyState == 4) {
						
				if (smessage.status == 200) 	
	{
	document.getElementById("msg").value="";
	//setTimeout(function () {
	not_busy=true;
	looper();
	document.getElementById("chat_button").disabled='';
//},4000); 
	}
	}
	
}
window.onload = function () {
	Induce_LAS();	
	$("#msg").keydown(function (e){
    if(e.keyCode == 13){
        document.getElementById('chat_button').click();
    }
});
}
</script>
<script src="LAS/Home_LAS.js"></script>
<script src="CodeEditor/jquery.js"></script>
<style>
.UserSpan
{
color: red;
}
.MessageSpan
{
color: green;
}
#ChatBox
{
padding: 2px;
position: absolute;
width: 1000px;
height: 400px;
background-color: black;
}
.chatclass
{
bottom: 0px;
position: absolute;
}
#chat_button
{
	width: 100px;
right: 0px;
}
#box
{
	height: 370px;
overflow-y: auto;
word-wrap: break-word;
}
</style>
</head>
<body>
<?php
require_once("../Template.php");
session_start();
$usr=$_SESSION['Nick'];
$usr = '"' . $usr . '"';
if(isset($_SESSION['Nick']))
{
?>
<div class="Matter">
<h3 style="color:red">Using abusive and unparlimentary words may lead to ban!</h3>
<div id="ChatBox">
<div id="box">
<script type="text/javascript" >
looper();
function looper() {	
startinterval(0);
}
</script>
</div>
<input style="width:900px;" class="chatclass" id="msg" type="text" name="message"/>
<?php
echo("<input class='chatclass' id='chat_button' type='button' value='Enter' onclick='sendmessage($usr);'/>");
}
else {
echo('<META HTTP-EQUIV="Refresh" Content="0; URL=http://127.0.0.1/CodeConnect/">');
}
?>
</div>
</div>
</body>
</html>