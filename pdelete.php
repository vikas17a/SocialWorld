<?php
session_start();
if(empty($_SESSION[sub1])){
	die('Error Occured');
}
if(empty($_POST[id])){
	die('Error');
}
$con = mysqli_connect('localhost','root','','sw') or die('Error Occured');
$qry = "delete from sw_ppost where page_id = '$_SESSION[page_id]' and p_id = '$_POST[id]' and u_id = '$_SESSION[sub1]';";
mysqli_query($con,$qry) or die('Error Occured');
mysqli_close($con);
?>