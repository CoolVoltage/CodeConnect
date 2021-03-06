<html>
<head>
<title>CodeConnect</title>
</head>
<link href="Style_Template.css" rel="stylesheet" type="text/css" />
<script>
window.onload = function () {
	Induce_LAS();
}
</script>
<script src="LAS/Home_LAS.js"></script>
<style>
.Links
{
color: black;
font-style: italic;
font-weight: bold;
font-family: Comic Sans MS;
}
#CodeDisplay table td,th
{
border:thin solid lightsteelblue;
padding: 10px;
}
#CodeDisplay
{
position: absolute;
left: 20%;
}
#CodeDisplay table
{
border-collapse: collapse;
}
.one
{
background-color: #007BA7;
}
.two
{
background-color: lightblue;
}
#DisplayOptions span
{
background-color: #ccc;
    -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
    border-radius:6px;
    color: #fff;
    font-family: 'Oswald';
    font-size: 15px;
    text-decoration: none;
    cursor: pointer;
     border:none;
		padding: 1px;
		margin-left: 5px;
}
#DisplayOptions span:hover {
    border: none;
    background:red;
    box-shadow: 5px 5px 5px #777;

}
th:nth-child(1)
{
width: 100px;
}
th:nth-child(3)
{
width: 100px;
}
th:nth-child(2)
{
width: 500px;
}
</style>
<script>
var current_Display='Date';
function Change_Display(object) {
 document.getElementById('By' + current_Display).style.display="none";
 current_Display = object.id;
 document.getElementById('By' + current_Display).style.display="block"; 	
}
</script>
<body>
<?php 
require_once("../Template.php");
$dbc = mysqli_connect('127.0.0.1','root','pass','CodeConnect');
$query = "SELECT * FROM CodeSave";
$GenResult = mysqli_query($dbc,$query)
or die('dsg');
//order by date,rating,most commented,id,need help
$i=-1;
$OrderByDate =[];
while($OrderByDate[]=mysqli_fetch_row($GenResult)) {
$i++;
}
$OrderByRating=$OrderByDate;
for($j=0;$j<$i+1;$j++) {
$temp4=0;
$temp5=$j;
$temp7=0;
$temp6;	
	//echo 'yo';
	for($k=$j;$k<$i+1;$k++) {
$temp3 = explode(';', $OrderByRating[$k][7],2);
$temp2 = explode('/',$temp3[0]);
$rated = $temp2[0]/$temp2[1];
if($rated>$temp4) {
	$temp4=$rated;
	$temp5=$k;
	$temp7=$temp2[1];
}
if(($rated==$temp4)&&($temp2[1]>$temp7)) {
$temp4=$rated;
	$temp5=$k;
	$temp7=$temp2[1];
}
}
$temp6=$OrderByRating[$j];
	$OrderByRating[$j]=$OrderByRating[$temp5];
	$OrderByRating[$temp5]=$temp6;
}
$OrderByComments=$OrderByDate;
for($j=0;$j<$i+1;$j++) {
$temp4=1;
$temp5=$j;
$temp6;	
	for($k=$j;$k<$i+1;$k++) {
$temp3 = explode(';;', $OrderByComments[$k][6]);
$count = sizeof($temp3);
if($count>$temp4) {
	$temp4=$count;
	$temp5=$k;
}
}
$temp6=$OrderByComments[$j];
	$OrderByComments[$j]=$OrderByComments[$temp5];
	$OrderByComments[$temp5]=$temp6;
}
?>
<div class="Matter">
<a class='Links' href="/CodeConnect/NewCode">Create a New Code!</a>
<a class='Links' style="float:right;" href="/CodeConnect/Chat">Enter ChatRoom!</a>
<br>
<div id="CodeDisplay">
<div id="DisplayOptions"><span id="Rating" onclick="Change_Display(this);">Highest Rated</span><span id="Date" onclick="Change_Display(this);">Recently Added</span><span id="Popularity" onclick="Change_Display(this);">Most Popular</span><span id="UserId" onclick="Create_DisplayList();">Search By Nick : </span><input type="text" id="Search_Nick"></div>
<br>
<table id="ByDate">
<tr class="one"><th>Nick</th><th>Description</th><th>Rating</th></tr>
<?php
//echo $OrderByDate[1][5];
while($i>=0)
{
$temp3 = explode(';', $OrderByDate[$i][7],2);
$temp2 = explode('/',$temp3[0]);
$rated = $temp2[0]/$temp2[1];
$rated=round($rated,2);
$class = $i%2?'one':'two';
echo("<tr  style='cursor:pointer' onmouseover='this.style.color=" . '"red"' . "' onmouseout='this.style.color=" . '"black"' . "' onclick=window.location.assign('" . $OrderByDate[$i][5] . "') class=$class><td>" . $OrderByDate[$i][0] . "</td><td>" . $OrderByDate[$i][8] . "</td><td>$rated</td></tr>");
$i--;
}
?>
</table>
<table id="ByRating" style="display:none">
<tr class="one"><th>Nick</th><th>Description</th><th style="color:gold">Rating</th></tr>
<?php
//echo $OrderByDate[1][5];
$i++;
while($i!=$j)
{
$temp3 = explode(';', $OrderByRating[$i][7],2);
$temp2 = explode('/',$temp3[0]);
$rated = $temp2[0]/$temp2[1];
$rated=round($rated,2);
$class = $i%2?'one':'two';
echo("<tr  style='cursor:pointer' onmouseover='this.style.color=" . '"red"' . "' onmouseout='this.style.color=" . '"black"' . "' onclick=window.location.assign('" . $OrderByRating[$i][5] . "') class=$class><td>" . $OrderByRating[$i][0] . "</td><td>" . $OrderByRating[$i][8] . "</td><td>$rated</td></tr>");
$i++;
}
?>
</table>
<table id="ByPopularity" style="display:none">
<tr class="one"><th>Nick</th><th>Description</th><th style="color:gold">Rating</th></tr>
<?php
//echo $OrderByDate[1][5];
$i=0;
while($i!=$j)
{
$temp3 = explode(';', $OrderByComments[$i][7],2);
$temp2 = explode('/',$temp3[0]);
$rated = $temp2[0]/$temp2[1];
$rated=round($rated,2);
$class = $i%2?'one':'two';
echo("<tr  style='cursor:pointer' onmouseover='this.style.color=" . '"red"' . "' onmouseout='this.style.color=" . '"black"' . "' onclick=window.location.assign('" . $OrderByComments[$i][5] . "') class=$class><td>" . $OrderByComments[$i][0] . "</td><td>" . $OrderByComments[$i][8] . "</td><td>$rated</td></tr>");
$i++;
}
?>
</table>
<table id="ByUserId" style="display:none"><tr class="one"><th style="color:gold">Nick</th><th>Description</th><th>Rating</th></tr></table>
</div>
</div>
</body>
<?php
$i=0;
while($OrderByDate[$i]) {
$OrderByNick[] = json_encode($OrderByDate[$i]);
$i++;
}
?>
<script>
var OrderByDate = <?php echo json_encode($OrderByNick); ?>;
OrderByDate = eval(OrderByDate);
function Create_DisplayList() {
	var Search_Nick = document.getElementById('Search_Nick').value;	
	if (Search_Nick) {
	OrderByNick = [];
	var table = document.getElementById('ByUserId');	
	for (i=0;i<OrderByDate.length;++i) {
	OrderByDate[i] = eval(OrderByDate[i]);
	if (OrderByDate[i][0]==Search_Nick) {
	OrderByNick.push(OrderByDate[i]);
}
}
}
	else {
	return;
}
while (document.getElementById('ByUserId').firstChild.nextSibling)
document.getElementById('ByUserId').removeChild(document.getElementById('ByUserId').firstChild.nextSibling);
for (i=0;i<OrderByNick.length;++i) {
//echo("<tr  style='cursor:pointer' onmouseover='this.style.color=" . '"red"' . "' onmouseout='this.style.color=" . '"black"' . "' onclick=window.location.assign('" . $OrderByComments[$i][5] . "') class=$class><td>" . $OrderByComments[$i][0] . "</td><td>" . $OrderByComments[$i][8] . "</td><td>$rated</td></tr>");	
var tr=document.createElement('tr');
tr.style.cursor='pointer';
tr.onmouseover = function () {
	this.style.color='red';
}
tr.onmouseout = function () {
	this.style.color='black';
}
var temp_id=document.createAttribute('Code_id');
temp_id.value=OrderByNick[i][5];
tr.setAttributeNode(temp_id);
tr.onclick = function(){window.location.assign(this.getAttribute('Code_id'));}
tr.className=i%2?'one':'two';
var td1=document.createElement('td');
td1.innerHTML=OrderByNick[i][0];
var td2=document.createElement('td');
td2.innerHTML=OrderByNick[i][8];
var temp = OrderByNick[i][7].split(";;");
var temp1=temp[0].split("/");
var rated = temp1[0]/temp1[1];
var td3=document.createElement("td");
rated= rated?rated:0;
td3.innerHTML=rated;
tr.appendChild(td1);
tr.appendChild(td2);
tr.appendChild(td3);
document.getElementById('ByUserId').appendChild(tr);
}

Change_Display(document.getElementById('UserId'));
}
</script>
</html>