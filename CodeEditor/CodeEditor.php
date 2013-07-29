<html>
<head>
<title>CodeConnect-CodeEditor</title>
<script src="CodeEditor/codemirror-3.14/lib/codemirror.js"></script>
				<link rel="stylesheet" href="CodeEditor/codemirror-3.14/lib/codemirror.css">
				<script src="CodeEditor/codemirror-3.14/mode/htmlmixed/htmlmixed.js"></script>
				<script src="CodeEditor/codemirror-3.14/mode/xml/xml.js"></script>
		      <script src="CodeEditor/codemirror-3.14/mode/javascript/javascript.js"></script>
    			<script src="CodeEditor/codemirror-3.14/mode/css/css.js"></script>
    			<script src="CodeEditor/codemirror-3.14/mode/vbscript/vbscript.js"></script>
    			<script src="CodeEditor/codemirror-3.14/addon/edit/matchbrackets.js"></script>    
				<script src="CodeEditor/codemirror-3.14/addon/edit/closebrackets.js"></script> 
				<script src="CodeEditor/jquery.js"></script>
		<script src="CodeEditor/jshint-2.1.4.js" ></script> 
</head>
<script src="LAS/Home_LAS.js"></script>
<link href="Style_Template.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="CodeEditor/codemirror-3.14/theme/rubyblue.css">
<script>
ExternalResource = {};
</script>
<script>
function check() {
	var code=Editor.getValue();
	var success = JSHINT(code);
	var msg="";	
	if (!success) {
	var error = JSHINT.data();
	for(var i=0;i<error.errors.length;++i)
	{
		var temp = document.getElementsByClassName('CodeMirror-code');
		var lines = temp[1].getElementsByTagName("div");		
		var line = lines[(error.errors[i].line-1)*3];
		line.style.backgroundColor="red";
}
	}
}

</script>
<body>
<?php
$html="<!-- DESCRIPTION/READ ME -->";
$js="//Use Check to validate your javascript code";
$css="";
$id=$_GET['id'];
if($id!='NewCode'&&!isset($_POST['save'])) {
$dbc = mysqli_connect('127.0.0.1', 'root', 'pass', 'CodeConnect')
or die('<span id="message">Error connecting to MySQL server.</span>');
$query = "SELECT * FROM CodeSave WHERE id='$id'";
$result = mysqli_query($dbc,$query);
$Result = mysqli_fetch_row($result);
if(isset($Result)) {
	$Owner= $Result[0];
	if(!($_POST['Version']==''&&isset($_POST['Version']))||!(isset($_POST['Html_Version'])&& $_POST['Html_Version']=='')||!(isset($_POST['Js_Version'])&& $_POST['Js_Version']=='')||!(isset($_POST['Css_Version'])&& $_POST['Css_Version']=='')) {
	$Vhtml = json_decode($Result[1]);
	$Vjs = json_decode($Result[2]);
	$Vcss = json_decode($Result[3]);	
	$ExtRes =$Result[4];
	$Descp = $Result[8];
	$Count_Versions_Html = $Vhtml[$Result[9]-1];
	$Count_Versions_Js = $Vjs[$Result[9]-1];	
	$Count_Versions_Css = $Vcss[$Result[9]-1];
	//echo $Count_Versions_Html;
	$Count_Versions = (isset($_POST['Version'])&& $_POST['Version']!='')?$_POST['Version']:$Result[9];	
	$Vhtml= (isset($_POST['Html_Version'])&& $_POST['Html_Version']!='')?$Vhtml[$_POST['Html_Version']-1]:$Vhtml[$Count_Versions-1];
	$Vjs=(isset($_POST['Js_Version'])&& $_POST['Js_Version']!='')?$Vjs[$_POST['Js_Version']-1]:$Vjs[$Count_Versions-1];
	$Vcss=(isset($_POST['Css_Version'])&& $_POST['Css_Version']!='')?$Vcss[$_POST['Css_Version']-1]:$Vcss[$Count_Versions-1];
	$query = "SELECT html FROM $id WHERE version='$Vhtml'";
	$result=mysqli_query($dbc,$query);
	$Html=mysqli_fetch_row($result);
	//$html=json_encode($result[0]);
	$query = "SELECT js FROM $id WHERE version='$Vjs'";
	$result=mysqli_query($dbc,$query);
	$Js=mysqli_fetch_row($result);
	//$js=json_encode($result[0]);
	$query = "SELECT css FROM $id WHERE version='$Vcss'";
	$result=mysqli_query($dbc,$query);
	$Css=mysqli_fetch_row($result);
	//$css=json_encode($result[0]);
	}
}
else {
	echo('<META HTTP-EQUIV="Refresh" Content="0; URL=http://127.0.0.1/CodeConnect/NewCode">');
}
}
//$Version = (!isset($_POST['Version']))?$Result[9]:$_POST['Version'];
require_once("../Template.php");
?>
<div class="Matter">
<?php
//if(isset($_POST['html'])|| isset($_POST['js'])|| isset($_POST['css'])|| isset($_POST['ExternalRes'])) {
	//echo((!isset($_POST['Version'])&&isset($_POST['submit'])));	
	$html=((isset($_POST['Html_Version'])&&$_POST['Html_Version']=='')&&(isset($_POST['Version'])&&$_POST['Version']=='')||($_GET['id']=='NewCode'&&(isset($_POST['submit'])|| isset($_POST['save']))))?$_POST['html']:(isset($Html[0])?$Html[0]:$html);	
	$js=((isset($_POST['Js_Version'])&&$_POST['Js_Version']=='')&&(isset($_POST['Version'])&&$_POST['Version']=='')||($_GET['id']=='NewCode'&&(isset($_POST['submit'])|| isset($_POST['save']))))?$_POST['js']:(isset($Js[0])?$Js[0]:$js);
	$css=((isset($_POST['Css_Version'])&&$_POST['Css_Version']=='')&&(isset($_POST['Version'])&&$_POST['Version']=='')||($_GET['id']=='NewCode'&&(isset($_POST['submit'])|| isset($_POST['save']))))?$_POST['css']:(isset($Css[0])?$Css[0]:$css);
	$Descp = isset($_POST['Description'])?$_POST['Description']:$Descp;
	if(!isset($ExtRes)) {	
	$ExtRes=$_POST['ExternalRes'];
	//}	
	//$ExtRes=isset($_POST['ExternalRes'])?$_POST['ExternalRes']:$ExtRes;
	}
require_once("codeSave.php");
$Ext = json_decode($ExtRes);		
	?>
<script>
<?php

if ($ExtRes!='') {
	//$ExtRes = json_encode($ExtRes);
?>
ExternalResources = <?php echo $ExtRes; ?>;
ExternalResource = eval(ExternalResources);
<?php
}
?>
html = <?php echo json_encode($html);?>;
js = <?php echo json_encode($js);?>;
css = <?php echo json_encode($css);?>;
version = eval(<?php echo json_encode($Version);?>);
</script>
<?php if((!isset($_POST['submit'])||(isset($_POST['Version'])&&$_POST['Version']!=''))&&$_GET['id']!='NewCode') { 
/*$temp=0;
$temp_version = $Version-1;
foreach($css as $key => $value)
{
if($key>=$temp_version) {
	$css= $key==$temp_version?$value:$css;
	break;
}
if($key>=$temp)
$temp=$key;
$css=$value;
}
$temp=0;
foreach($html as $key => $value)
{
if($key>=$temp_version) {
	$html= $key==$temp_version?$value:$html;
	break;
}
if($key>=$temp)
$temp=$key;
$html=$value;
}
$temp=0;
foreach($js as $key => $value)
{
if($key>=$temp_version) {
	$js= $key==$temp_version?$value:$js;
	break;
}
if($key>=$temp)
$temp=$key;
}
//echo $value;
*/?>
<script>
/*html = <?php echo json_encode($Html[0]);?>;
js = <?php echo json_encode($Js[0]);?>;
css = <?php echo json_encode($Css[0]);?>;*/
</script>
<?php } 
?>
<?php	
/*if((!isset($_POST['submit'])||(isset($_POST['Version'])&&$_POST['Version']!=''))&&$_GET['id']!='NewCode') {
$iframe = [$Html[0],$Css[0],$Js[0],$_POST['ExternalRes'],$Version,$_POST['submit']];
}
else{*/
$iframe = [$html,$css,$js,$_POST['ExternalRes'],$Version,$_POST['submit']];
//}
//print_r($iframe);
$iframeid = rand(10000, 99999);
session_start();
while(isset($_SESSION[$iframeid]))
$iframeid = rand(10000, 99999);
$_SESSION['"$iframeid"']=$iframe;
?>
<style>
#Description
{
width: 450px;
height: 100px;
background-color: lightblue;
padding: 10px;
font-family: Times;
font-weight: bold;
overflow: auto;
border-radius:10px;
}
#iframe
{
border-radius:10px;
width: 600px;
height: 300px;
}
textarea
{
overflow-y: auto;
}
.CodeMirror
{
width: 600px;
height: 300px;
border-radius:20px;
font-size: 75%;
}
.Lineerror
{
background-color: red;
}
form
{
float: right;
}
#Elist
{
list-style-type: none;
}
#Elist li a
{
color: black;
font-style: italic;
}
#Elist li img
{
width:13px;
padding-left: 5px;
cursor: pointer;
}
#ExternalListDiv
{
	width: 400px;
overflow: hidden;
border: thin solid lightcoral;
border-radius:10px;
background-color: lightgoldenrodyellow;
}
#Comments 
{
width: 460px;
border-radius:10px;
background-color: lightblue;
padding-left: 5px;
padding-top: 5px;
padding-bottom: 5px;
}
.CommentDisplay
{
	border-radius:10px;
padding-left:5px;
padding-top: 5px;
padding-right: 2px;
padding-bottom: 5px;
margin-top: 5px;
margin-bottom: 5px;
width: 440px;
background-color: white;
margin-left: auto;
margin-right: auto;
font-size: 75%;
border:thin solid aqua;
line-height: 14px;
}
.cbutton
{
background-color: #ccc;
    -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
    border-radius:6px;
    color: #fff;
    font-family: 'Oswald';
    font-size: 15px;
    text-decoration: none;
    cursor: pointer;
     border:none;
}
.cbutton:hover {
    border: none;
    background:red;
    box-shadow: 5px 5px 5px #777;

}
#Rating img
{
width: 30px;
height: 30px;
}
</style>
<form name="MyForm" action=<?php echo($_GET['id']);?> method="POST">
<input class="cbutton" id="submit" type="submit" name="submit" value="Submit" >
<?php
if(($_SESSION['Nick']==$Owner||$_GET['id']=="NewCode") && isset($_SESSION['Nick']))  {?>
<input class="cbutton" type="submit" name="save" value="Save">
<?php } if($_SESSION['Nick']) { ?><input class="cbutton" type="button" value="Fork" onclick="document.MyForm.action='NewCode';document.getElementById('submit').click();"> <?php } ?>
<input class="cbutton" type="button" name="Check" value="Check" onclick="check();">
<div id="Version_Controller">
<?php
if($_GET['id']!='NewCode') {
	echo("<label>Version:</label>");
	$temp = $Result[9];		
	echo(isset($_POST['Version'])?($_POST['Version']?$_POST['Version']:'Edit in Progress'):$temp);	
		echo("<select name='Version' onchange=document.getElementById('submit').click()>");
		echo("<option value=''></option>");	
		while($temp) {
			echo("<option value='$temp'>$temp</option>");
			$temp--;
		}
	echo("</select>");
	echo("<label>HTML:</label>");
	echo(isset($_POST['Html_Version'])?($_POST['Html_Version']?$_POST['Html_Version']:''):$Count_Versions_Html);
	echo("<select name='Html_Version'>");
		echo("<option value=''></option>");	
		while($Count_Versions_Html) {
			echo("<option value='$Count_Versions_Html'>$Count_Versions_Html</option>");
			$Count_Versions_Html--;
		}
	echo("</select>");

	echo("<label>JS:</label>");
	echo(isset($_POST['Js_Version'])?($_POST['Js_Version']?$_POST['Js_Version']:''):$Count_Versions_Js);
	echo("<select name='Js_Version'>");
		echo("<option value=''></option>");	
		while($Count_Versions_Js) {
			echo("<option value='$Count_Versions_Js'>$Count_Versions_Js</option>");
			$Count_Versions_Js--;
		}
	echo("</select>");

	echo("<label>CSS:</label>");
	echo(isset($_POST['Css_Version'])?($_POST['Css_Version']?$_POST['Css_Version']:''):$Count_Versions_Css);
	echo("<select name='Css_Version'>");
		echo("<option value=''></option>");	
		while($Count_Versions_Css) {
			echo("<option value='$Count_Versions_Css'>$Count_Versions_Css</option>");
			$Count_Versions_Css--;
		}
	echo("</select>");
}
?>

</div>
<hr>
<?php if($html ||$js ||$css || $ExtRes) { ?><iframe id="iframe" src="CodeEditor/iframe.php?iframeid=<?php echo $iframeid; ?>"></iframe><br><?php }?>
<label>HTML</label><textarea id="html" name="html"></textarea><br>
<label>JS</label><textarea id="js" name="js"></textarea><br>
<label>CSS</label><textarea id="css" name="css"></textarea><br>
<input type="hidden" id="ExternalRes" name="ExternalRes">
<input type="hidden" id="Describe" name="Description" value="Description"> 
<script>
 var mixedMode = {
        name: "htmlmixed",
        scriptTypes: [{matches: /\/x-handlebars-template|\/x-mustache/i,
                       mode: null},
                      {matches: /(text|application)\/(x-)?vb(a|script)/i,
                       mode: "vbscript"}]
      };
      editor = CodeMirror.fromTextArea(document.getElementById("html"), {mode: mixedMode, tabMode: "indent",lineNumbers:true,matchBrackets:true,autoCloseBrackets:true});
      editor.setValue(html);
      editor.setOption("theme","rubyblue");
      Editor = CodeMirror.fromTextArea(document.getElementById("js"), {mode: "javascript", tabMode: "indent",lineNumbers:true,matchBrackets:true,autoCloseBrackets:true});
      Editor.setValue(js);
      Editor.setOption("theme","rubyblue");
      EDitor = CodeMirror.fromTextArea(document.getElementById("css"), {mode: "css", tabMode: "indent",lineNumbers:true,matchBrackets:true,autoCloseBrackets:true});
 		EDitor.setValue(css);     
 		EDitor.setOption("theme","rubyblue");
</script>
</form>
<div id="Description">
Description
</div>
<?php
if($_GET['id']=="NewCode"||$_SESSION['Nick']==$Owner) {
echo("<span id='EditDescp' onclick='EditDesp()' style='color:blue;font-size:70%;cursor:pointer'><u>Edit</u></span>");
}
?>
<hr>
<?php
if($_SESSION['Nick']&&$_GET['id']!='NewCode') {
?>
<div id="Rating"><img src="CodeEditor/Wstar.png" alt="" ><img src="CodeEditor/Wstar.png" alt="" ><img src="CodeEditor/Wstar.png" alt="" ><img src="CodeEditor/Wstar.png" alt="" ><img src="CodeEditor/Wstar.png" alt="" ></div>
<?php
}
else {
	if(!isset($_SESSION['Nick'])) 
echo('<span id="Rating_login" style="color:black;font-size:15px;"><i><b>Please Login to Rate</b></i></span><br>');
	else 
echo('<span id="Rating_login" style="color:black;font-size:15px;"><i><b>Please Save to Rate</b></i></span><br>');
}
?>
<div><b><span id="Rated" style="color:gold;font-size:20px;"></span><div id="SRated" style="overflow:hidden;width:96px;"><img src="CodeEditor/5star.png" style="height:20px;" alt="" ></div></b></div>
<hr>
<div id="ExternalListDiv">
<ul id="Elist"><label><b><i>Add External Links:</i></b></label><input id="Einput" type="text"><img src="CodeEditor/plus.png" style="cursor:pointer;" onclick="Add_ExternalLink();">
<?php foreach($Ext as $key => $value)
{
?>
<li><a href=<?php echo $key ?> target="_blank"><?php echo($key);?></a><img src="CodeEditor/close.jpeg" onclick="DeleteExtRes(this);"></li>
<?php
}
?>
</ul>
</div>
<br>
<br>
<hr>
<div id="Comments">
<?php session_start();if($_GET['id']=="NewCode"){echo("<h4><i>Save to Comment</i></h4>"); } else if(isset($_SESSION['Nick'])){ ?><textarea id="CommentInput" style="width:440px;resize: none;"></textarea><?php }else echo("<h4><i>Please Login to Comment</i></h4>");?>
</div>
</div>
</body>
<script>
function EditDesp() {
	document.getElementById("Description").innerHTML= prompt("Please Enter Description","Description");
	document.getElementById("Describe").value=document.getElementById("Description").innerHTML;
}
<!-- -----------------------COMMENT-------------------------- -->
function Add_Comment() {
	//alert(document.getElementById("CommentInput").value);
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
var d=new Date();
d = new String(d);
var temp = document.getElementById("CommentInput")?document.getElementById("CommentInput").value.replace(/\n/g, '<br />'):null;
var url="CodeEditor/CommentSubmit.php?Comment="+temp+"&Time=" + d.substring(0,d.length-15) + "&id=" + <?php echo json_encode($_GET['id']); ?>;
Request.open("POST",url,true);
Request.onreadystatechange = function () {

if (Request.readyState == 4) {
				if (Request.status == 200) {
					
				var pack = Request.responseText;
				comments = pack.split(";;");		
	while (document.getElementById('Comments').firstChild.nextSibling.nextSibling)
	document.getElementById('Comments').removeChild(document.getElementById('Comments').firstChild.nextSibling.nextSibling);
	for(var i=0;i<comments.length-1;++i)
	{
	Comment = comments[i].split(":::");
	var Nickname = Comment[0];
	var userNick=document.createElement('b');
	userNick.innerHTML=Nickname;	
	var comment =document.createElement('text');
	comment.innerHTML=Comment[2];
	var span = document.createElement('span');
	var time = document.createElement('b');
	time.innerHTML=Comment[1];
	var txt = document.createElement('text');
	txt.innerHTML=" posted on ";
	span.appendChild(userNick);	
	span.appendChild(txt);
	span.appendChild(time);
	var hr = document.createElement('hr');
	span.appendChild(hr);
	span.appendChild(comment);	
	var div = document.createElement('div');
	div.className="CommentDisplay";
	div.appendChild(span);
	document.getElementById('Comments').appendChild(div);
}					
					}
		}
}
Request.send(null);
	if (document.getElementById('CommentInput')) {
	document.getElementById('CommentInput').value="";
}
}
<!-- -----------------------Ext Res-------------------------- -->
function DeleteExtRes(img) {
	var li = img.parentNode;
	var linc= img.previousSibling.innerHTML;
	delete ExternalResource[linc];
	li.parentNode.removeChild(li);
	document.getElementById('ExternalRes').value=JSON.stringify(ExternalResource);
}
function Add_ExternalLink() {
	var Elink=document.getElementById('Einput').value;
	if (Elink) {
	var Etype = Elink.substring(Elink.length-3,Elink.length)==".js"?"js":Elink.substring(Elink.length-4,Elink.length)==".css"?"css":null;
	document.getElementById('Einput').value="";		
	if (Etype==null) {	
	return;	
}
}
var listlink = document.createElement('a');
listlink.href=Elink;
listlink.innerHTML=Elink;
listlink.target="_blank";	
var listitem = document.createElement('li');
listitem.appendChild(listlink);
var closeimg= document.createElement('img');
closeimg.src="CodeEditor/close.jpeg";
closeimg.onclick=function () {
	DeleteExtRes(closeimg);
}
listitem.appendChild(closeimg);
document.getElementById('Elist').appendChild(listitem);	
ExternalResource[Elink]=Etype;
document.getElementById('ExternalRes').value=JSON.stringify(ExternalResource);
}
<!-- -----------------------RATING-------------------------- -->
function updateRating(rating) {
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
var url="CodeEditor/DBrating.php?rating="+rating+"&id="+'<?php echo $_GET['id']; ?>';
request.open("POST",url,true);
request.onreadystatechange = function () {
if (request.readyState == 4) {
				if (request.status == 200) {
					var rating=request.responseText;
					var rated = rating.split(";;");
					if (rated[1]=='break"') {
					rated[0]+='"';
				}
					rated[0]=eval(rated[0]);							
					if (rated[0]!=0) {
					document.getElementById('Rated').innerHTML=rated[0];			
					}
					document.getElementById('SRated').style.width=96/5*rated[0];		
					if (rated[1]=='break"') {
						if (document.getElementById('Rating')) {
					document.getElementById('Rating').innerHTML="";
}			}
				}
		}
}
request.send(null);
}

</script>

<script>
function Rating_star() {
	clicked=false;
	$("#Rating img").hover(function () {
	this.src="CodeEditor/Ostar.png"	
	img=this;	
	while (img)
	{	img.src="CodeEditor/Ostar.png";
		img=img.previousSibling;
	}
	img=this.nextSibling;
	while (img)
	{
	img.src="CodeEditor/Wstar.png"
	img=img.nextSibling;
	}
},function () {
	if (!clicked) {
	img = document.getElementById('Rating').firstChild;
	while (img)
	{
		img.src="CodeEditor/Wstar.png";
		img= img.nextSibling;
	}
}
});
	$("#Rating img").click(function () {
	clicked=true;
	img=this;
	var i=0;
	while (img)
	{
	img=img.previousSibling;
	i++;
	}
	document.getElementById('Rating').innerHTML="We appreciate your rating!Thank You!";
	updateRating(i);
});
}
window.onload = function () {
	Add_Comment();	
	Induce_LAS();
	updateRating('null');	
	Rating_star();
	$("#Einput").keydown(function (e){
    if(e.keyCode == 13){
        Add_ExternalLink();
    }
});
	
	$("#CommentInput").keydown(function (e){
    if(e.keyCode == 13 && e.shiftKey){      
        Add_Comment();
    }
});
document.getElementById('ExternalRes').value=JSON.stringify(ExternalResource);

document.getElementById('Description').innerHTML= <?php echo json_encode($Descp);?>;
document.getElementById('Describe').value=document.getElementById('Description').innerHTML;
}
</script>
<style>
body
{
color: black;
}
</style>
</html>
