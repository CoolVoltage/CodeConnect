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
$ExtRes=$ExtRes?json_encode($ExtRes):'';
$html = json_encode(array($html));
$js = json_encode(array($js));
$css = json_encode(array($css));
$query = "INSERT INTO CodeSave(nick,html,js,css,extres,id,Rating,Description,Version)" .
"VALUES ('$nick','$html','$js','$css','$ExtRes','$id','0/0','$Descp','1')";
}
else {
$query="SELECT * FROM CodeSave WHERE id ='$id'";
$result = mysqli_query($dbc,$query);
$result = mysqli_fetch_row($result);
$Version = $result[9];
$result[1]=json_decode($result[1]);
$result[2]=json_decode($result[2]);
$result[3]=json_decode($result[3]);
$i=1;
while(!isset($result[1][$Version-$i])&&$i<=$Version)
$i++;
if($result[1][$Version-$i]!=$html)
$result[1][$Version] = $html;
$i=1;
while(!isset($result[2][$Version-$i])&&$i<=$Version)
$i++;
if($result[2][$Version-$i]!=$js)
$result[2][$Version] =$js;
$i=1;
while(!isset($result[3][$Version-$i])&&$i<=$Version)
$i++;
if($result[3][$Version-$i]!=$css)
$result[3][$Version] = $css;
$id=$_GET['id'];
$html = json_encode($result[1]);
$js = json_encode($result[2]);
$css = json_encode($result[3]);
$query = "UPDATE CodeSave SET html='$html',js='$js',css='$css',extres='$ExtRes',Description='$Descp',Version=Version+1 WHERE id = '$id'";
echo sizeof($result[2]);
echo $query;
}

$result = mysqli_query($dbc,$query)
or die('<span id="message">Error queryidfng database.</span>');
echo('<META HTTP-EQUIV="Refresh" Content="0; URL=http://127.0.0.1/CodeConnect/'. $id . '">');
}
?>
