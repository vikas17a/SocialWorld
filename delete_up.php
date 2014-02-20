<?php

session_start();
if(empty($_SESSION[sub1])){
	die('Error Occured');
}
if(is_numeric($_POST[id])){
	$con = mysqli_connect('localhost','root','','sw');
	$qry = "select p_ath from sw_upload where f_id = '$_POST[id]' and u_id = '$_SESSION[sub1]';";
	//echo $qry;
	$result = mysqli_query($con,$qry);
	while($id = mysqli_fetch_assoc($result)){
		unlink("upload/$id[p_ath]");
	}
	$qry = "delete from sw_upload where f_id = '$_POST[id]';";
	mysqli_query($con,$qry) or die('Error Occured');
	mysqli_close($con);
	echo 'Deleted';
}
?>