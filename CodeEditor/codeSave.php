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
$ExtRes=json_encode($ExtRes);
$query = "INSERT INTO CodeSave(nick,html,js,css,extres,id,Rating,Description)" .
"VALUES ('$nick','$html','$js','$css','$ExtRes','$id','0/0','$Descp')";
}
else {
$id=$_GET['id'];
$query = "UPDATE CodeSave SET html='$html',js='$js',css='$css',extres='$ExtRes',Description='$Descp' WHERE id = '$id'";
}

$result = mysqli_query($dbc,$query)
or die('<span id="message">Error queryidfng database.</span>');
echo('<META HTTP-EQUIV="Refresh" Content="0; URL=http://127.0.0.1/CodeConnect/'. $id . '">');
}
?>
