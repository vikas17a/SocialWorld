<?php
session_starT();
if(empty($_SESSION[sub1])){
	die('Error Occured');
}
if(empty($_SESSION[advanced])){
	die('Error Occured');
}
if($_POST[id] != $_SESSION[advanced]){
	die('Error Occured');
}
if(empty($_POST[msg])){
	die('Error Occured');
}

$msg =  mysql_real_escape_string(htmlentities(addslashes(strip_tags(trim($_POST[msg])))));
$con = mysqli_connect('localhost','root','','sw');
$qry = "insert into sw_message values('$_SESSION[sub1]','$_SESSION[advanced]','$msg',current_date(),current_time());";
mysqli_query($con,$qry);
mysqli_close($con);

?>