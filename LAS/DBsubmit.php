<?php
$dbc = mysqli_connect('127.0.0.1', 'root', 'pass', 'CodeConnect')
or die('<span id="message">Error connecting to MySQL server.</span>');
$Nick = mysqli_real_escape_string($dbc, trim($_GET['Nick']));
$Email = mysqli_real_escape_string($dbc, trim($_GET['Email']));
$Pass = mysqli_real_escape_string($dbc, trim($_GET['Pass']));
$query = "INSERT INTO UserInfo(Nick,Email,Password)" .
"VALUES ('$Nick','$Email',SHA('$Pass'))";
$result = mysqli_query($dbc, $query)
or die('<span id="message">Error querying database.</span>');
echo $_GET['Nick'];
?>