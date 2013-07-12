<?php
if(isset($_POST['save']))
{
	echo 'yo';
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
or die('<span id="message">Error querying database.</span>');
$length = mysqli_num_rows($result);
}while($length==1);
}
else {
$id=$_GET['id'];
}
$nick = $_SESSION['Nick'];
$query = "INSERT INTO CodeSave(nick,html,js,css,extres,id)" .
"VALUES ('$nick','$html','$js','$css','$ExtRes','$id')";
$result = mysqli_query($dbc,$query)
or die('<span id="message">Error querying database.</span>');
echo('<META HTTP-EQUIV="Refresh" Content="0; URL=http://127.0.0.1/CodeConnect/'. $id . '">');
}
?>
