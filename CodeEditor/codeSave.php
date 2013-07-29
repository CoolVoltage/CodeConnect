<?php
if(isset($_POST['save']))
{
	$nick = $_SESSION['Nick'];
$dbc = mysqli_connect('127.0.0.1', 'root', 'pass', 'CodeConnect')
or die('<span id="message">Error connecting to MySQL server.</span>');
if($_GET['id']=="NewCode") {
do {
$id="";
$i=rand(7,10);
while($i) {
	$id .=chr(rand(97,122));
	$i--;
}
$query = "SELECT * FROM CodeSave WHERE id='$id'";
$result = mysqli_query($dbc, $query)
or die('<span id="message">Error queryidfsdfng database.</span>');
$length = mysqli_num_rows($result);
}while($length==1);
$ExtRes=$ExtRes!='{}'?json_encode($ExtRes):'{}';
$query="CREATE TABLE $id (
version int(20) NOT NULL auto_increment,
html varchar(4294967295),
js varchar(4294967295),
css varchar(4294967295),
PRIMARY KEY(version)
) ";
$result = mysqli_query($dbc,$query);
$html = json_encode($html);
$js = json_encode($js);
$css = json_encode($css);
$query="INSERT INTO $id (html,js,css)" .
"VALUES ($html,$js,$css)";
echo $query;
$result = mysqli_query($dbc,$query)
or die('sdg');
$Vhtml = json_encode(array(1));
$Vjs = json_encode(array(1));
$Vcss = json_encode(array(1));
$query = "INSERT INTO CodeSave(nick,html,js,css,extres,id,Rating,Description,Version)" .
"VALUES ('$nick','$Vhtml','$Vjs','$Vcss','$ExtRes','$id','0/0','$Descp','1')";
$result = mysqli_query($dbc,$query)
or die('<span id="message">Error queryidfng database.</span>');
}
else {
$Query ="SELECT html,js,css,Version FROM CodeSave WHERE id='$id'";
$Result=mysqli_query($dbc,$Query);
$Result = mysqli_fetch_row($Result);
$js = json_encode($js);
$html = json_encode($html);
$css = json_encode($css);
$query="SELECT version FROM $id WHERE html=$html";
$result = mysqli_query($dbc,$query);
$result = mysqli_fetch_row($result);
if(isset($result)) {
$html_push='null';
}
else {
	$result[0]=$Result[3]+1;
	$html_push=$html;
	 	}
$Result[0]=json_decode($Result[0]);
array_push($Result[0],json_decode($result[0]));
$Result[0]=json_encode($Result[0]);
$query="UPDATE CodeSave SET html='$Result[0]' WHERE id='$id'"; 
$result = mysqli_query($dbc,$query)
or die('<span id="message">Error queryidfng database.</span>');
$query="SELECT version FROM $id WHERE js=$js";
$result = mysqli_query($dbc,$query);
$result = mysqli_fetch_row($result);
if(isset($result)) {
$js_push='null';
}
else {
	$result[0]=$Result[3]+1;
	$js_push=$js;
}
$Result[1]=json_decode($Result[1]);
array_push($Result[1],json_decode($result[0]));
$Result[1]=json_encode($Result[1]);
//echo json_decode($result[0]);
$query="UPDATE CodeSave SET js='$Result[1]' WHERE id='$id'"; 
//echo $query;
$result = mysqli_query($dbc,$query)
or die('<span id="message">Error queryidfng database.</span>');
$query="SELECT version FROM $id WHERE css=$css";
$result = mysqli_query($dbc,$query);
$result = mysqli_fetch_row($result);
if(isset($result)) {
$css_push='null';
}
else {
	$result[0]=$Result[3]+1;
	$css_push=$css;
	}
$Result[2]=json_decode($Result[2]);
array_push($Result[2],json_decode($result[0]));
$Result[2]=json_encode($Result[2]);
$query="UPDATE CodeSave SET css='$Result[2]' WHERE id='$id'";
$result = mysqli_query($dbc,$query)
or die('<span id="message">Error queryidfng database.</span>');
$Query_VersionUpdate = "INSERT INTO $id(html,js,css)" .
"VALUES($html_push,$js_push,$css_push)";
//echo $Query_VersionUpdate;
$result = mysqli_query($dbc,$Query_VersionUpdate)
or die('<span id="message">Error queryidfng database.</span>');
if($html_push!='null'||$css_push!='null'||$js_push!='null') {
$query="UPDATE CodeSave SET Version=Version+1 WHERE id='$id'"; 
$result = mysqli_query($dbc,$query)
or die('<span id="message">Error queryidfng database.</span>');
}
}
echo('<META HTTP-EQUIV="Refresh" Content="0; URL=http://127.0.0.1/CodeConnect/'. $id . '">');
}
?>
