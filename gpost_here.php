<?php
session_start();
if((empty($_SESSION[sub1]) && empty($_SESSION[sub2]))){
		die('Error Occured');
}
$con = mysqli_connect('localhost','root','','sw') or die('Error Occured');
$qry =  "select sw_pid.post,sw_pid.p_id,sw_gpost.d_ate,sw_gpost.t_ime,sw_gpost.u_id from sw_pid,sw_gpost where sw_gpost.g_id = '$_SESSION[g_id]' and sw_gpost.p_id = sw_pid.p_id order by sw_gpost.t_ime desc, sw_gpost.d_ate desc;";
$result = mysqli_query($con,$qry) or die('Error Occured');
echo "<ul class='list-blog'>";
while($post = mysqli_fetch_assoc($result)){
	echo "<li><h5 style='float:left'>".$post[post]."</h5>";if($_SESSION[sub1] == $post[u_id]){echo"<a style='float:right' onclick='delete_post($post[p_id])' class='btn btn-1'>Delete</a><br><br>";}else{echo"<br><br>";}
            echo "<time datetime='2012-11-08' class='date-1'>at $post[t_ime] on $post[d_ate]</time>";
	$qry = "select fname,lname from sw_detail where u_id = '$post[u_id]';";
	$rs = mysqli_query($con,$qry);
	$name = mysqli_fetch_assoc($rs);
    echo"<div class='name-author'>quoted by $name[fname] $name[lname]</div>
    </li>";
	}
echo "</ul>";
mysqli_close($con);
?>