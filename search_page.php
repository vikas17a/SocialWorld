<?php
session_start();
if(empty($_SESSION[sub1])){
	die('Error Occured');
}
$search = mysql_real_escape_string($_POST[search]);
$con = mysqli_connect('localhost','root','','sw');
$qry = "select ct_id from sw_pcategory where ct_name = '$search';";
$result = mysqli_query($con,$qry);
$id = mysqli_fetch_assoc($result);
$ct_id = $id[ct_id];
$qry = "select page_id,name,description,pic_id from sw_paged where name='$search' or description='$search' or ct_id = '$ct_id';";
$result = mysqli_query($con,$qry);
echo "<h5>Search Results</h5><ul>";
while($details = mysqli_fetch_assoc($result)){
	echo "&bull;<a href='page_prof.php?id=$details[page_id]' style='font-size:25px'> $details[name]</a><br>";
}
echo "</ul>";
mysqli_close($con);
?>