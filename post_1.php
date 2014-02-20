<?php
session_start();
if(empty($_SESSION[sub1])){
	echo('Error Occured');
}
$con = mysqli_connect('localhost','root','','sw') or die('Error Occured');
$post = mysql_real_escape_string(addslashes(($_POST[post])));
$qry = "select p_id from sw_pid where post = '$post';";
if($result = mysqli_query($con,$qry)){
	if($id = mysqli_fetch_assoc($result)){
		$p_id = $id[p_id];
	}
	else{
		$qry = "INSERT INTO sw_pid value('','$post');";
		mysqli_query($con,$qry);
		$qry = "SELECT p_id from sw_pid where post = '$post';";
		$result = mysqli_query($con,$qry);
		$id = mysqli_fetch_assoc($result);
		$p_id = $id[p_id];
	}
	$qry = "insert into sw_post values('$_SESSION[sub1]', '$_SESSION[advanced]','$p_id',current_date(),current_time());";
	mysqli_query($con,$qry);
}
mysqli_close($con);
?>