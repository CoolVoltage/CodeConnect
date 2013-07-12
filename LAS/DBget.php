<?php
$dbc = mysqli_connect('127.0.0.1', 'root', 'pass', 'CodeConnect')
or die('<span id="message">Error connecting to MySQL server.</span>');
$Nick = mysqli_real_escape_string($dbc, trim($_GET['Nick']));
$Pass = mysqli_real_escape_string($dbc, trim($_GET['Pass']));
$query = "SELECT * FROM UserInfo WHERE Nick='$Nick' AND Password=SHA('$Pass')";
$result = mysqli_query($dbc, $query)
or die('<span id="message">Error querying database.</span>');
$length = mysqli_num_rows($result);
if($length==1) {
session_start();
$_SESSION['Nick']=$Nick;
}
echo $length;
?>