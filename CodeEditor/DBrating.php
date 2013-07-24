<?php
session_start();
if($_GET['id']!="NewCode") {
$id = $_GET['id'];
$rated=0;
$dbc = mysqli_connect('127.0.0.1', 'root', 'pass', 'CodeConnect')
or die('<span id="message">Error connecting to MySQL server.</span>');
$query="SELECT Rating FROM CodeSave WHERE id='$id'";
$result = mysqli_query($dbc,$query)
or die('<span id="message">Error connecting to MySQL server.</span>');
$result = mysqli_fetch_array($result);
$ratings = $result[0];
if(!isset($ratings)) {$ratings="";}
$temp = explode(';', $ratings,2);
$temp2 = explode('/',$temp[0]);
if($_GET['rating']!='null') {
$temp2[0] += $_GET['rating'];
$temp2[1]++;
}
$rated = $temp2[0]/$temp2[1];
$rated=round($rated,2);
$temp3 = $temp2[0] . '/' . $temp2[1];
$ratings = $temp3 . ';' . $temp[1];
if($_GET['rating']!='null') {
$ratings = $ratings . ';' . $_SESSION['Nick'];
$query ="UPDATE CodeSave SET Rating='$ratings'" .
"WHERE id='$id'";
$result = mysqli_query($dbc,$query)
or die('<span id="message">Error conndfdecting to MySQL server.</span>');
}
$raters= explode(';',$temp[1]);
$i=1;
while($raters[$i]) {
	if($_SESSION['Nick']==$raters[$i]||(!isset($_SESSION['Nick']))) {
	$rated.=";;break";
break;
}
$i++;
}
}
echo json_encode($rated);
?>