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
$Version = $array[4];
$html=$array[0];
$js = $array[2];
$css = $array[1];
if(!isset($array[5])||$Version) {
$html = json_decode($array[0]);
$js = json_decode($array[2]);
$css = json_decode($array[1]);
$i=1;
while(!isset($html[$Version-$i])&&$i<=$Version)
$i++;
$html = isset($html[$Version-$i])?$html[$Version-$i]:'';
$i=1;
while(!isset($js[$Version-$i])&&$i<=$Version)
$i++;
$js = isset($js[$Version-$i])?$js[$Version-$i]:'';
$i=1;
while(!isset($css[$Version-$i])&&$i<=$Version)
$i++;
$css = isset($css[$Version-$i])?$css[$Version-$i]:'';
}
$ExtRes=json_decode($array[3]);
	foreach($ExtRes as $key => $value)
	{
	if($value=="js") 
	echo("<script src=" . $key . "></script>");
	else if($value=="css") 
	echo("<link rel='stylesheet' href=" . $key . "/>");
	} 
echo '<style>' . $css . '</style>';
?>
</head>
<body>
<?php echo $html; ?>
</body>
<?php
echo '<script>' . $js . '</script>';	

?>
</html>