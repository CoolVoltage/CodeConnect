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
Commit varchar(1000),
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
$repeated=true;
$query = "UPDATE CodeSave SET extres='$ExtRes',Description='$Descp' WHERE id = '$id'";
$result = mysqli_query($dbc,$query);
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
$repeated = (json_decode($result[0])==end($Result[0]))&&$repeated?true:false;
array_push($Result[0],json_decode($result[0]));
$Result[0]=json_encode($Result[0]);
$query1="UPDATE CodeSave SET html='$Result[0]' WHERE id='$id'"; 
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
$repeated = (json_decode($result[0])==end($Result[1]))&&$repeated?true:false;
array_push($Result[1],json_decode($result[0]));
$Result[1]=json_encode($Result[1]);
$query2="UPDATE CodeSave SET js='$Result[1]' WHERE id='$id'"; 
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
$repeated = (json_decode($result[0])==end($Result[2]))&&$repeated?true:false;
array_push($Result[2],json_decode($result[0]));
$Result[2]=json_encode($Result[2]);
$query3="UPDATE CodeSave SET css='$Result[2]' WHERE id='$id'";
if(!$repeated) {
		$result = mysqli_query($dbc,$query1)
		or die('<span id="message">Error queryidfng database.</span>');
		$result = mysqli_query($dbc,$query2)
		or die('<span id="message">Error queryidfng database.</span>');
		$result = mysqli_query($dbc,$query3)
		or die('<span id="message">Error queryidfng database.</span>');
		$Query_VersionUpdate = "INSERT INTO $id(html,js,css)" .
		"VALUES($html_push,$js_push,$css_push)";
		$result = mysqli_query($dbc,$Query_VersionUpdate)
		or die('<span id="message">Error queryidfng database.</span>');
		$query="UPDATE CodeSave SET Version=Version+1 WHERE id='$id'"; 
		$result = mysqli_query($dbc,$query)
		or die('<span id="message">Error queryidfng database.</span>');
		$commit_name=$_POST['save'];		
	$Result[3]++;
		$query="UPDATE $id SET Commit='$commit_name' WHERE version='$Result[3]'";
	$result=mysqli_query($dbc,$query);
echo $query;
}
}
echo('<META HTTP-EQUIV="Refresh" Content="2; URL=http://127.0.0.1/CodeConnect/'. $id . '">');
?>
<style>
.matter
{
display: none;
}
</style>
<?php
}
?>
