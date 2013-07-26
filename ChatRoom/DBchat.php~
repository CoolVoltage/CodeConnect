<?php
session_start();
$usr = $_SESSION['Nick'];
$msg = $_GET['matter'];
if(isset($usr)&&isset($msg)&&$msg!='') {
$msg=str_ireplace("fuck","****",$msg);
$msg=str_ireplace("suck","****",$msg);
$msg=str_ireplace("bitch","*****",$msg);
$msg=str_ireplace("cunt","****",$msg);
$xml = simplexml_load_file("chat.xml"); 
$sxe = new SimpleXMLElement($xml->asXML());
$person = $sxe->addChild("CHAT");
$person->addChild("USER", $usr);
$person->addChild("MESSAGE", $msg);
$sxe->asXML("chat.xml"); 
}
echo($sxe);
?>