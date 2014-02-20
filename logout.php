<?php
session_start();
ignore_user_abort(true);
$con = mysqli_connect('localhost','root','','sw');
$qry = "delete from sw_online where u_id = $_SESSION[sub1];";
mysqli_query($con,$qry);
mysqli_close($con);
session_unset();
session_destroy();
header('Location: index.php');
?>