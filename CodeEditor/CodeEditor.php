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
				<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
				<!--<script src="http://www.jshint.com/get/jshint-2.1.4.js" ></script> -->
</head>
<script src="LAS/Home_LAS.js"></script>
<link href="Style_Template.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="CodeEditor/codemirror-3.14/theme/rubyblue.css">
<script>
html="<!-- DESCRIPTION/READ ME -->";
js="";
css="";
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
require_once("../Template.php");
?>
<div class="Matter">
<?php
if(!(isset($_POST['submit']))) {
$id=$_GET['id'];
if($id!='NewCode') {
$dbc = mysqli_connect('127.0.0.1', 'root', 'pass', 'CodeConnect')
or die('<span id="message">Error connecting to MySQL server.</span>');
$query = "SELECT * FROM CodeSave WHERE id='$id'";
$result = mysqli_query($dbc,$query);
$result = mysqli_fetch_row($result);
if(isset($result)) {
	$Owner= $result[0];
	$html = $result[1];
	$js = $result[2];
	$css = $result[3];	
	$ExtRes = json_decode($result[4]);
}
else {
	echo('<META HTTP-EQUIV="Refresh" Content="0; URL=http://127.0.0.1/CodeConnect/NewCode">');
}
}
}
if(isset($_POST['html'])|| isset($_POST['js'])|| isset($_POST['css'])|| isset($_POST['ExternalRes'])) {
	$html=$_POST['html']?$_POST['html']:$html;
	$js=$_POST['js']?$_POST['js']:$js;
	$css=$_POST['css']?$_POST['css']:$css;
	$ExtRes=$_POST['ExternalRes']?$_POST['ExternalRes']:$ExtRes;
	require_once("codeSave.php");
	}	
	$ExtRes=json_decode($_POST['ExternalRes']);
	foreach($ExtRes as $key => $value)
	{
	if($value=="js") 
	echo("<script src=" . $key . "></script>");
	else if($value=="css") 
	echo("<link rel='stylesheet' href=" . $key . "/>");
	}	
	echo '<style>' . $css . '</style>';
?>
<script>
<?php
if (($_POST['ExternalRes'])) {
?>
ExternalResource = <?php echo ($_POST['ExternalRes']); ?>;
<?php
}
?>
html = <?php echo json_encode($html);?>;
js = <?php echo json_encode($js);?>;
css = <?php echo json_encode($css);?>;
</script>
<?php	
?>
<style>
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
#Output
{
width: 600px;
height: 300px;
overflow-x: auto;
overflow-y: auto;
background-color: white;
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
</style>
<form action=<?php echo($_GET['id']);?> method="POST">
<input type="submit" name="submit" value="submit" >
<?php
if($_SESSION['Nick']==$Owner) {?>
<input type="submit" name="save" value="save">
<?php } ?>
<input type="button" name="Check" value="Check" onclick="check();"><br>
<?php if($html ||$js ||$css || $ExtRes) { ?><label>Output</label><div id="Output"><?php echo $html; ?></div><br><?php }?>
<label>HTML</label><textarea id="html" name="html"></textarea><br>
<label>JS</label><textarea id="js" name="js"></textarea><br>
<label>CSS</label><textarea id="css" name="css"></textarea><br>
<input type="hidden" id="ExternalRes" name="ExternalRes">
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
<div id="ExternalListDiv">
<ul id="Elist"><label><b><i>Add External Links:</i></b></label><input id="Einput" type="text"><img src="CodeEditor/plus.png" style="cursor:pointer;" onclick="Add_ExternalLink();">
<?php foreach($ExtRes as $key => $value)
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
<?php session_start();if(isset($_SESSION['Nick'])){ ?><textarea id="CommentInput" style="width:440px;resize: none;"></textarea><?php }else echo("<h4><i>Please Login to Comment</i></h4>");?>
<div class="CommentDisplay">
<span><b id="CommentUser">Karthik</b> posted on <b id="CommentTime">Tuesday 16:20:23</b></span>
<hr>
hello world!<br>
</div>
</div>
</div>
</body>
<?php
echo '<script>' . $js . '</script>';	
?>
<script>
function Add_Comment() {
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
var d=new Date();
d = new String(d);
var url="CodeEditor/CommentSubmit.php?Comment="+document.getElementById("CommentInput").value+"&Time=" + d.substring(0,d.length-15);
<?php
session_start();
$_SESSION['id']=$_GET['id']; 
?>
request.open("POST",url,true);
request.onreadystatechange = function () {

if (request.readyState == 4) {
							
				if (request.status == 200) {
				var pack = request.responseText;
				comments = pack.split(";;");		
				var i=0;
	while (document.getElementById('Comments').firstChild.nextSibling.nextSibling)
	document.getElementById('Comments').removeChild(document.getElementById('Comments').firstChild.nextSibling.nextSibling);
	while (comments[i])
	{
	Comment = comments[i].split(":::");
	var Nickname = Comment[0];
	var userNick=document.createElement('b');
	userNick.innerHTML=Nickname;	
	var comment =document.createElement('text');
	comment.innerHTML=Comment[2].replace("\n","<br>");
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
	i++;
}					
					}
		}
}
request.send(null);
	
	document.getElementById('CommentInput').value="";
}
function DeleteExtRes(img) {
	var li = img.parentNode;
	li.parentNode.removeChild(li);
}
function Add_ExternalLink() {
	var Elink=document.getElementById('Einput').value;
	var Etype = Elink.substring(Elink.length-3,Elink.length)==".js"?"js":Elink.substring(Elink.length-4,Elink.length)==".css"?"css":null;
	document.getElementById('Einput').value="";	
	if (Etype==null) {	
	return;	
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
window.onload = function () {
	Add_Comment();	
	Induce_LAS();
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
}
</script>
</html>