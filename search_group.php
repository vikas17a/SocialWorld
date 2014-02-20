<?php
session_Start();
if(empty($_SESSION[sub1])){
	die('Error Occured');
}
$con = mysqli_connect('localhost','root','','sw');
$qry = "select ct_id from sw_pcategory where ct_name = '$_POST[search]';";
//echo $qry;
$result = mysqli_query($con,$qry);
$id = mysqli_fetch_assoc($result);
$ct_id = $id[ct_id];
$qry = "select gp_name,g_id from sw_group where gp_name = '$_POST[search]' or ct_id = '$ct_id';";
//echo $qry;
$result = mysqli_query($con,$qry);
echo "<h5>Search Results</h5><ul>";
while($detail = mysqli_fetch_assoc($result)){
	echo "<li><h3><a href='grp.php?id=$detail[g_id]'>$detail[gp_name]</a></h3></li><br>";
}
echo "</ul>";
mysqli_close($con);
?>