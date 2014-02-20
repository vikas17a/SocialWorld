<?php
session_start();
if((empty($_SESSION[sub1]) && empty($_SESSION[sub2]))){
		die('Error Occured');
}
$con = mysqli_connect('localhost','root','','sw');
$qry = "select fname,lname from sw_detail where u_id = '$_SESSION[advanced]';";
$result = mysqli_query($con,$qry);
$detail = mysqli_fetch_assoc($result);
//echo "from <name style='color:#e85356'>".$detail[fname]." ".$detail[lname]."</name><br>";
$qry = "select fname from sw_detail where u_id = '$_SESSION[sub1]';";
$result = mysqli_query($con,$qry);
$details = mysqli_fetch_assoc($result);
$qry = "select sw_message.message,sw_message.d_ate,sw_message.t_ime,sw_message.usend,sw_message.urev_id from sw_message where sw_message.urev_id in ('$_SESSION[sub1]','$_SESSION[advanced]') and sw_message.usend in ('$_SESSION[advanced]','$_SESSION[sub1]') order by sw_message.d_ate desc, sw_message.t_ime desc limit 10;";
//echo $qry;
$msg = mysqli_query($con,$qry);
while($mssg = mysqli_fetch_assoc($msg)){
echo "<hr><message style='color:'>$mssg[message]</message> &nbsp; &nbsp;&nbsp;"; if($mssg[usend] == $_SESSION[advanced]){echo "by  <name style='color:#e85356'>$detail[fname]</name> &nbsp;&nbsp; $mssg[t_ime]<br>";}else{ echo "by <name style='color:#e85356'>$details[fname]</name>&nbsp;&nbsp; $mssg[t_ime]<br>";} }
mysqli_close($con);
?>