<?php
session_start();
$comment = $_GET['Comment'];
$time = $_GET['Time'];
$Nick = $_SESSION['Nick'];
$id = $_GET['id'];
if($id!="NewCode") {
$dbc = mysqli_connect('127.0.0.1', 'root', 'pass', 'CodeConnect')
or die('<span id="message">Error connecting to MySQL server.</span>');
$query="SELECT Comments FROM CodeSave WHERE id='$id'";
$result = mysqli_query($dbc,$query)
or die('<span id="message">Error connecting to MySQL server.</span>');
$result = mysqli_fetch_array($result);
$comments = $result[0];
if(isset($Nick)&&$comment) {
if(!isset($comments)) {$comments="";}
$comments = $comments . $Nick . ':::' . $time . ':::' . $comment . ';;';
//echo $comments;
$query ="UPDATE CodeSave SET Comments='$comments'" .
"WHERE id='$id'";
$result = mysqli_query($dbc,$query)
or die('<span id="message">Error conndfdecting to MySQL server.</span>');
}
}
echo(json_encode($comments));
?>