<?php
$dbc = mysqli_connect('127.0.0.1', 'root', 'pass', 'CodeConnect')
or die('<span id="message">Error connecting to MySQL server.</span>');
$Nick = mysqli_real_escape_string($dbc, trim($_GET['Nick']));
$query = "SELECT * FROM UserInfo WHERE Nick='$Nick'";
$Result = mysqli_query($dbc, $query)
or die('<span id="message">Error querying database.</span>');  
$temp = mysqli_fetch_row($Result);
if(preg_match('/^.{6,15}/',$_GET['Nick']) && preg_match('/\w/',$_GET['Nick']) && preg_match('/^\w[\w\.\+\-]+[@]\w{2,}[.]\w{2,3}/',$_GET['Email']) && preg_match('/@(?!(spambot|mailinator))/',$_GET['Email']) && preg_match('/\w{6,15}/',$_GET['Pass'])&&$_GET['Pass']==$_GET['RePass']&&(!is_array($temp)))
{
$Nick = mysqli_real_escape_string($dbc, trim($_GET['Nick']));
$Email = mysqli_real_escape_string($dbc, trim($_GET['Email']));
$Pass = mysqli_real_escape_string($dbc, trim($_GET['Pass']));
$query = "INSERT INTO UserInfo(Nick,Email,Password,Notification)" .
"VALUES ('$Nick','$Email',SHA('$Pass'),'')";
$result = mysqli_query($dbc, $query)
or die('<span id="message">Error querying database.</span>');
echo $_GET['Nick'];
}
else {
if(is_array($temp))
{
echo('uerror');
}
else {
echo('error');
}
}
?>