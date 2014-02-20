<?php

session_Start();
if(empty($_SESSION[sub1])){
	die('Error Occured');
}
if(empty($_POST[id])){
	die('Error Occured');
}
$con = mysqli_connect('localhost','root','','sw');
$qry = "select bool from sw_connection where u2id = '$_SESSION[sub1]' and u1id = '$_POST[id]';";
$result = mysqli_query($con,$qry);
if($id = mysqli_fetch_assoc($result)){
	if($id[bool] == 0){
		$qry = "update sw_connection set bool = '1' where u2id = '$_SESSION[sub1]' and u1id = '$_POST[id]';";
		mysqli_query($con,$qry);
		mysqli_close($con);
	}
}
else{
	$qry = "insert into sw_connection values('$_SESSION[sub1]','$_POST[id]','0');";
	mysqli_query($con,$qry);
	mysqli_close($con);
}
?>