<?php
session_Start();
if(empty($_SESSION[sub1])){
	die('Error Occured');
}
if(empty($_SESSION[g_id])){
	die('Error Occured');
}
$con = mysqli_connect('localhost','root','','sw');
$qry = "insert into sw_gjoin values('$_SESSION[g_id]','$_SESSION[sub1]',current_date(),current_time());";
mysqli_query($con,$qry);
mysqli_close($con);

?>