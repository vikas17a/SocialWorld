<?php
session_start();
if((empty($_SESSION[sub1]) && empty($_SESSION[sub2]))){
		die('Error Occured');
	}
$con = mysqli_connect('localhost','root','','sw') or die('Error Occured');
$qry =  "select sw_pid.post,sw_pid.p_id,sw_ppost.d_ate,sw_ppost.t_ime,sw_ppost.u_id from sw_pid,sw_ppost where sw_ppost.page_id = '$_SESSION[page_id]' and sw_ppost.p_id = sw_pid.p_id order by sw_ppost.t_ime desc;";
$result = mysqli_query($con,$qry) or die('Error Occured');
while($post = mysqli_fetch_assoc($result)){
	echo "<li><h5 style='float:left'>".$post[post]."</h5>";if($_SESSION[sub1] == $post[u_id]){echo"<a style='float:right' onclick='delete_post($post[p_id])' class='btn btn-1'>Delete</a><br><br>";}else{echo"<br><br>";}
            echo "<time datetime='2012-11-08' class='date-1'>at $post[t_ime] on $post[d_ate]</time>";
	$qry = "select fname,lname from sw_detail where u_id = '$post[u_id]';";
	$rs = mysqli_query($con,$qry);
	$name = mysqli_fetch_assoc($rs);
    echo"<div class='name-author'>quoted by $name[fname] $name[lname]</div>
    </li>";
	}
mysqli_close($con);
?>