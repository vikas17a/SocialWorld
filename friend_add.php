<?php
session_start();
if(empty($_SESSION[sub1])){
	die('Error Occured');
}
if(empty($_POST[id])){
	die('Error Occured');
}
$con = mysqli_connect('localhost','root','','sw');
$qry = "update sw_connection set bool = '1' where u2id = '$_SESSION[sub1]' and u1id = '$_POST[id]';";
mysqli_query($con,$qry);
mysqli_close($con);
?>