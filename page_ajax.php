<?php
session_start();
if(empty($_SESSION[sub1])){
	die('Error Occured');
}
echo "<h3>Pages Created by you </h3><ul>";

$con = mysqli_connect('localhost','root','','sw');
$qry = "select sw_paged.name,sw_paged.page_id from sw_paged,sw_page where sw_page.u_id = '$_SESSION[sub1]' and sw_page.page_id= sw_paged.page_id;";
$result = mysqli_query($con,$qry);
while($name = mysqli_fetch_assoc($result)){
	echo "&bull;<a href='page_prof.php?id=$name[page_id]' style='font-size:25px'> $name[name]</a><br><br>";
}
echo "</ul>";
mysqli_close($con);?>