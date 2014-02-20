<?php
session_start();
if(empty($_SESSION[sub1])){
	die('Error Occured');
}
if(empty($_POST[id])){
	die('Error');
}
$con = mysqli_connect('localhost','root','','sw') or die('Error Occured');
$qry = "delete from sw_post where urev_id = '$_SESSION[sub1]' and pid = '$_POST[id]';";
mysqli_query($con,$qry) or die('Error Occured');
mysqli_close($con);
echo 'Deleted';
?>