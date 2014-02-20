<?php
session_start();
if((empty($_SESSION[sub1]) && empty($_SESSION[sub2]))){
	header('Location');
}
else{
	$u_id = $_SESSION[sub1];
	$pwd = stripslashes(strip_tags(trim($_POST['old'])));
	$np = stripslashes(strip_tags(trim($_POST['np'])));
	$rnp = stripslashes(strip_tags(trim($_POST['rnp'])));
	if(strlen($np) < 6){
		die('Password length less than 6');
	}
	if($np != $rnp){
		die('Password do not match');
	}
	$pwd = sha1($pwd);
	$np = sha1($np);
	$con = mysqli_connect('localhost','root','','sw') or die('Error Occured');
	$qry = "select password from sw_ulogin where u_id = '$u_id';";
	
	$results = mysqli_query($con,$qry) or die('Error Occured');
	$pwd_r = mysqli_fetch_assoc($results);
	
	if( $pwd != $pwd_r[password] ){
		die('Password Incorrect');
	}
	$qry = "update sw_ulogin set password = '$np' where u_id = '$u_id' and password = '$pwd';";
	mysqli_query($con,$qry) or die('Incorrect Password');
	mysqli_close($con);
	echo 'Password Updated';
}
?>