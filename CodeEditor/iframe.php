<html>
<head>
<style>
body
{
background-color: white;
}
</style>
<?php
$iframeid = $_GET['iframeid'];
session_start();
$array = $_SESSION['"$iframeid"']; 
echo '<style>' . $array[1] . '</style>';
?>
</head>
<body>
<?php echo $array[0]; ?>
</body>
<?php
echo '<script>' . $array[2] . '</script>';	
$ExtRes=json_decode($array[3]);
	foreach($ExtRes as $key => $value)
	{
	if($value=="js") 
	echo("<script src=" . $key . "></script>");
	else if($value=="css") 
	echo("<link rel='stylesheet' href=" . $key . "/>");
	}
?>
</html>