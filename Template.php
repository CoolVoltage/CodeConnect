<?php
session_start();
?>
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
</div>
<?php
}
?>
</div>

</div>

<div id="SignUp">
<?php
require_once("LAS/SignUp.php");
?>	
</div>
<div id="Sheet"></div>
