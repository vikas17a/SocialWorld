<?php
session_start();
if(empty($_SESSION[sub1])){
	die('Error Occured');
}
$con = mysqli_connect('localhost','root','','sw') or die('Error Occured');
$qry =  "select sw_pid.post,sw_pid.p_id,sw_post.d_ate,sw_post.t_ime,sw_post.usend_id from sw_pid,sw_post where sw_post.urev_id = '$_SESSION[sub1]' and sw_post.pid = sw_pid.p_id order by sw_post.d_ate desc, sw_post.t_ime desc;";
//echo $qry;
$result = mysqli_query($con,$qry) or die('Error Occured');
while($post = mysqli_fetch_assoc($result)){
	echo "<li><h5 style='float:left'>".$post[post]."</h5><a style='float:right' onclick='delete_post($post[p_id])' class='btn btn-1'>Delete</a><br><br>
            <time datetime='2012-11-08' class='date-1'>at $post[t_ime] on $post[d_ate]</time>";
			$qry = "select fname,lname from sw_detail where u_id = '$post[usend_id]';";
			$rs = mysqli_query($con,$qry);
			$name = mysqli_fetch_assoc($rs);
            echo"<div class='name-author'>quoted by $name[fname] $name[lname]</div><br></li>";
}
mysqli_close($con);
?>