<?php
session_start();
?>
<script src="CodeEditor/jquery.js"></script>
<div class="Matter">
<a href="/CodeConnect"><img src="Home/logo.png" style="margin-top:-40px;" height="200px" ></a>
<div id="LoginBox">
<?php
if(!isset($_SESSION['Nick'])) {
?>
<table id="LoginFields">
<tr><td><label>Nick</label></td><td><input type="text" id="Nick" /></td></tr>
<tr><td><label>Password</label></td><td><input type="password" id="password" /></td></tr>
<tr><td><input type="button" value="Login" name="Login" id="Login" onclick="Check_Login();"></td><td><input type="button" value="Register" id="Register" onclick="toggle_form();"></td></tr>
</table>
<span id="ELogin" class="error"></span>
<?php
}
else {
?>
<div id="NickDisplay" style="display:block;">
<span id="NickSpan">Welcome <?php echo $_SESSION['Nick']; ?></span><br>
<a href="LAS/Logout.php"><i>Sign Out</i></a>
<?php
$dbc = mysqli_connect('127.0.0.1', 'root', 'pass', 'CodeConnect')
or die('<span id="message">Error connecting to MySQL server.</span>');
$Nick = $_SESSION['Nick'];
$query="SELECT Notification FROM UserInfo WHERE Nick = '$Nick'";
$result = mysqli_query($dbc,$query);
$notification = mysqli_fetch_row($result);
if(isset($notification[0])&&$notification[0]!='') {
$notification = $notification[0];
if(isset($Owner)&&isset($_GET['id'])) {
	if($Owner==$Nick) {	
	$Notification = str_replace(',' . $_GET['id'],"", $notification);
	$Notification = str_replace($_GET['id'],"", $Notification);
	$notification=$Notification;
}
}
$count_notifications = explode(',',$notification);
$notification = array_count_values($count_notifications);
$count_notifications = sizeof(array_unique($count_notifications));
if(sizeof($count_notifications)>0) {	
?>
<div id="Notification_alert" style="color:red;cursor:pointer;"><?php echo $count_notifications-1 ?> New Notifications</div>
<?php
}
}
echo('</div>');
echo('<div id="Notification_list" style="display:none;">');
foreach($notification as $key => $value) {
	if($key!='') {
	echo("<a href='$key' onclick='Remove_Notification(this);' target='_blank'>$value new comments in $key<hr></a>");					
		} }
echo('<span style="font-size:10px">New Tabs are opened.</span>');
echo('</div>');
}
if(isset($Notification)) {
$query="UPDATE UserInfo SET Notification='$Notification' WHERE Nick='$Nick'";
$result = mysqli_query($dbc,$query); 
}
?>
<script>
$('#Notification_alert').click(function(){document.getElementById('Notification_list').style.display=document.getElementById('Notification_list').style.display=="none"?"block":"none";});
function Remove_Notification(source) {
	document.getElementById('Notification_list').removeChild(source);
	document.getElementById('Notification_alert').innerHTML="Notifications";
}
</script>
</div>

</div>

<div id="SignUp">
<?php
require_once("LAS/SignUp.php");
?>	
</div>
<div id="Sheet"></div>
