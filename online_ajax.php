<?php
session_start();
if(empty($_SESSION[sub1])){
	die('Error Occured');
}
	$con = mysqli_connect('localhost','root','','sw') or die('Error Occured');
	$qry = "select u2id from sw_connection where u1id = '$_SESSION[sub1]' and bool = '1';";
	$result = mysqli_query($con,$qry) or die('Error Occured');
	while($id = mysqli_fetch_assoc($result)){
		$qry = "select sw_city.c_name,sw_state.s_name,sw_country.cn_name,sw_picup.pic,sw_profession.profession,sw_workl.work_add,sw_detail.fname,sw_detail.lname,sw_detail.bio,sw_detail.dob from sw_detail,sw_picup,sw_city,sw_state,sw_country,sw_profession,sw_workl where sw_detail.c_id=sw_city.c_id and sw_detail.s_id = sw_state.s_id and sw_detail.cn_id = sw_country.cn_id and sw_detail.pic_id = sw_picup.pic_id and sw_detail.w_id = sw_profession.w_id and sw_detail.wl_id = sw_workl.wl_id and u_id = $id[u2id];";					
		$results = mysqli_query($con,$qry);
		$details = mysqli_fetch_assoc($results);
		$qry = "select u_id from sw_online where u_id = '$id[u2id]';";
		//echo $qry;
		$res = mysqli_query($con,$qry);
		if($stats = mysqli_fetch_assoc($res)){
			define('online','1');
			echo "<li><a href='prof.php?id=$id[u2id]'>$details[fname] $details[lname]</a></li>";}
		}
		$qry = "select u1id from sw_connection where u2id ='$_SESSION[sub1]'  and bool = '1';";
		$result = mysqli_query($con,$qry) or die('Error Occured');
		while($id = mysqli_fetch_assoc($result)){
			$qry = "select sw_city.c_name,sw_state.s_name,sw_country.cn_name,sw_picup.pic,sw_profession.profession,sw_workl.work_add,sw_detail.fname,sw_detail.lname,sw_detail.bio,sw_detail.dob from sw_detail,sw_picup,sw_city,sw_state,sw_country,sw_profession,sw_workl where sw_detail.c_id=sw_city.c_id and sw_detail.s_id = sw_state.s_id and sw_detail.cn_id = sw_country.cn_id and sw_detail.pic_id = sw_picup.pic_id and sw_detail.w_id = sw_profession.w_id and sw_detail.wl_id = sw_workl.wl_id and u_id = $id[u1id];";					
			$results = mysqli_query($con,$qry);
			$details = mysqli_fetch_assoc($results);
			$qry = "select u_id from sw_online where u_id = '$id[u1id]';";
			$res = mysqli_query($con,$qry);
			if($stats = mysqli_fetch_assoc($res)){
				define('online','1');
				echo "<li><a href='prof.php?id=$id[u1id]'>$details[fname] $details[lname]</a></li>";}				
			}
			if(!(defined('online'))){
				echo "No friend online";
			}
			mysqli_close($con);
		?>