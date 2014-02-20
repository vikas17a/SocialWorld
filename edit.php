<!DOCTYPE html>
<html lang="en">
	<head>
	<title>Update</title>
	<meta charset="utf-8">
	<link rel="icon" href="img/favicon.ico" type="image/x-icon">
	<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
	<meta name="description" content="Your description">
	<meta name="keywords" content="Your keywords">
	<meta name="author" content="Your name">
	<link rel="stylesheet" href="css/bootstrap.css" type="text/css" media="screen">
	<link rel="stylesheet" href="css/responsive.css" type="text/css" media="screen">
	<link rel="stylesheet" href="css/style.css" type="text/css" media="screen">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/superfish.js"></script>
	<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
	<script src="js/forms.js"></script>
	<script>		
   jQuery(window).load(function() {	
    jQuery('.spinner').animate({'opacity':0},1000,'easeOutCubic',function (){jQuery(this).css('display','none')});	
   }); 
					
	</script>
	<script>
		function change_pwd(){
			var old,np,rnp;
			old = document.getElementById("oldpass").value;
			np = document.getElementById("newpass").value;
			rnp = document.getElementById("renewpass").value;
			if (window.XMLHttpRequest)
				{// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp=new XMLHttpRequest();
			}
			else
				{// code for IE6, IE5
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange=function()
			{
				if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{
					document.getElementById("response").innerHTML=xmlhttp.responseText;
					document.getElementById("oldpass").value = "";
					document.getElementById("newpass").value = "";
					document.getElementById("renewpass").value = "";
				}
			}		
			xmlhttp.open("POST","change.php",true);
			xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlhttp.send("old="+old+"&np="+np+"&rnp="+rnp);
			}
					</script>
	<!--[if lt IE 8]>
  		<div style='text-align:center'><a href="http://www.microsoft.com/windows/internet-explorer/default.aspx?ocid=ie6_countdown_bannercode"><img src="http://www.theie6countdown.com/img/upgrade.jpg"border="0"alt=""/></a></div>  
 	<![endif]-->
	<!--[if (gt IE 9)|!(IE)]><!-->
	<!--<![endif]-->
	<!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>    
    <link rel="stylesheet" href="css/ie.css" type="text/css" media="screen">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400' rel='stylesheet' type='text/css'>
  <![endif]-->
	</head>

	<body>
	<?php
	session_start();
	if((empty($_SESSION[sub1]) && empty($_SESSION[sub2]))){
		header('Location:index.php');
	}
	?>
	
	
	<div class="spinner"></div>
<!--============================== header =================================-->
<header>
      <div class="container clearfix">
    <div class="row">
          <div class="span12">
        <div class="navbar navbar_">
              <div class="container"><br>
            <div id="head" style='float:left;font-family:tahoma;'><a style='color:#e85356;font-size:50px'>S</a><a style='color:black;font-size:45px'>ocial</a><a style='color:#e85356;font-size:50px'>W</a><a style='color:black;font-size:45px'>orld</a><p>lets get connceted....</p></div>
            <a class="btn btn-navbar btn-navbar_" data-toggle="collapse" data-target=".nav-collapse_">Menu <span class="icon-bar"></span> </a>
            <div class="nav-collapse nav-collapse_  collapse">
                  <ul class="nav sf-menu">
                <li><a href="index-3.php">Home</a></li>
				<li><a href="index-2.php">Friends</a></li>
                <li class="active"><a href="#">Edit</a>
                   
                    </li>
                <li><a href="page.php">Pages</a></li>
                <li><a href="uploads.php">Uploads</a></li>
                <li><a href="logout.php">Logout</a></li>
                
              </ul>
                </div>
          </div>
            </div>
      </div>
        </div>
  </div>
    </header>
<div class="bg-content"> 
      <!--============================== content =================================-->
      <div id="content">
    <div class="container">
          <div class="row">
        <article class="span8">
		
				
				
              <div class="inner-1">
			  <ul class="list-blog">
			  <li>
			  </li>
			  <li>
					
			  		<h4 style="color:grey">Change Password</h4>
					<input type="password" placeholder="Old Password" name="oldpass" id="oldpass"><br>
					<input type="password" placeholder="New Password" name="newpass" id="newpass"><br>
					<input type="password" placeholder="Re-type New Password" name="renewpass" id="renewpass"><br>
					<button class="btn btn-1" onclick="change_pwd()">Change Password</button>&nbsp;<b id="response"></b>
			
				</li>
				<li>
					<form enctype="multipart/form-data" method="POST">
					<h4 style="color:grey">Upload your Picture</h4>
					<input type="file" name="pic" style="background-color:white"><input class="btn btn-1" type="submit" value="Upload Your Pic">
					</form><?php 
					if(isset($_FILES)){
						if($_FILES['pic']['type'] == "image/jpeg"){
							$stamp=time().$_FILES['file']['name'].".jpeg";
							move_uploaded_file($_FILES['pic']['tmp_name'], "file/".$stamp);
							$con = mysqli_connect('localhost','root','','sw');
							$qry = "INSERT INTO sw_picup VALUES('','$stamp');";
							mysqli_query($con,$qry) or die('Error Occured');
							$qry = "SELECT pic_id from sw_picup where pic = '$stamp';";
							$result = mysqli_query($con,$qry) or die('Error Occured');
							$row = mysqli_fetch_assoc($result) or die('Error Occured');
							$pic_id = $row[pic_id];
							$qry = "update sw_detail set pic_id = '$pic_id' where u_id = '$_SESSION[sub1]';";
							mysqli_query($con,$qry) or die('Error Occured');
							mysqli_close($con);
							echo 'Image uploaded';
						}
						else{
							echo '<b>Upload a jpeg file</b>';
						}
					}
					?>
				</li>
			<li>  
			  
            <form  method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
					<h4 style="color:grey">Update your Details</h4>
					
                  
                    <input type="text" placeholder="City" name="city">
                  
                
                
                    <input type="text" placeholder="State" name="state">
                
                
                    <input type="text" placeholder="Country where you live" name="country">
				
					<br>
					<input type="text" placeholder="Working as" name='work_as'>
					<input type="text" placeholder="Working at" name='work_in'>
					
					<br>
                
                    <textarea name="bio" style="width:430px;height:150px" placeholder="About your self"></textarea>
				
            <div class="buttons-wrapper"> <a class="btn btn-1" data-type="reset">Clear</a><input type="submit" value="Update" style='background-color:#e85356;color:white;height:30px;width:80px;border:none;'></div>
            
                </form>
				<?php 
					$con = mysqli_connect('localhost','root','','sw') or die('Error Occured #2');
				if(!empty($_POST[city])){
					$qry = "select c_id from sw_city where c_name = '$_POST[city]';";
					$result = mysqli_query($con,$qry) or die('Error Occured #3_a');
					$id=mysqli_fetch_assoc($result);
					$c_id = $id[c_id];
					if(empty($c_id)){
						$qry = "INSERT INTO sw_city value('','$_POST[city]');";
						mysqli_query($con,$qry) or die('Error Occured #3a');
						$qry = "SELECT c_id from sw_city where c_name = '$_POST[city]';";
						$result = mysqli_query($con,$qry) or die('Error Occured #3b');
						$id = mysqli_fetch_assoc($result);
						$c_id = $id[c_id];
					}
					$qry = "update sw_detail set c_id = '$c_id' where u_id = '$_SESSION[sub1]';";
					mysqli_query($con,$qry) or die('Error Occured');
				}
				if(!empty($_POST[state])){
					//echo 'hello';
					$qry = "select s_id from sw_state where s_name = '$_POST[state]';";
					$result = mysqli_query($con,$qry) or die('Error Occured #3c');
					$id = mysqli_fetch_assoc($result);
					$s_id = $id[s_id];
					if(empty($s_id)){
						$qry = "INSERT INTO sw_state value('','$_POST[state]');";
						mysqli_query($con,$qry) or die('Error Occured #3d');
						$qry = "SELECT s_id from sw_state where s_name = '$_POST[state]';";
						$result = mysqli_query($con,$qry) or die('Error Occured #3e');
						$id = mysqli_fetch_assoc($result);
						$s_id = $id[s_id];
					}
					$qry = "update sw_detail set s_id = '$s_id' where u_id ='$_SESSION[sub1]';";
					mysqli_query($con,$qry) or die('Error Occured');
				}
				if(!empty($_POST[country])){
					$qry = "select cn_id from sw_country where cn_name='$_POST[country]';";
					$result = mysqli_query($con,$qry) or die('Error Occured #3f');
					$id = mysqli_fetch_assoc($result);
					$cn_id = $id[cn_id];
					if(empty($cn_id)){
						$qry = "INSERT INTO sw_country value('','$_POST[country]');";
						mysqli_query($con,$qry) or die('Error Occured #3g');
						$qry = "SELECT cn_id from sw_country where cn_name = '$_POST[country]';";
						$result = mysqli_query($con,$qry) or die('Error Occured #3h');
						$id = mysqli_fetch_assoc($result);
						$cn_id = $id[cn_id];
					}
					$qry = "update sw_detail set cn_id = '$cn_id' where u_id = '$_SESSION[sub1]';";
					mysqli_query($con,$qry) or die('Error Occured');
				}
				if(!empty($_POST[work_as])){
					$qry = "select w_id from sw_profession where profession = '$_POST[work_as]';";
					$result = mysqli_query($con,$qry) or die('Error Occured #3i');
					$id = mysqli_fetch_assoc($result);
					$w_id = $id[w_id];
					if(empty($w_id)){
						$qry = "INSERT INTO sw_profession value('','$_POST[work_as]');";
						mysqli_query($con,$qry) or die('Error Occured #3j');
						$qry = "select w_id from sw_profession where profession = '$_POST[work_as]';";
						$result = mysqli_query($con,$qry) or die('Error Occured #3k');
						$id = mysqli_fetch_assoc($result);
						$w_id = $id[w_id];
					}
					$qry = "update sw_detail set w_id = '$w_id' where u_id = '$_SESSION[sub1]';";
					mysqli_query($con,$qry) or die('Error Occured');
				}
				if(!empty($_POST[work_in])){
					$qry = "select wl_id from sw_workl where work_add = '$_POST[work_in]';";
					$result = mysqli_query($con,$qry) or die('Error Occured #3f');
					$id = mysqli_fetch_assoc($result);
					$wl_id = $id[wl_id];
					if(empty($wl_id)){
						$qry = "INSERT INTO sw_workl value('','$_POST[work_in]');";
						mysqli_query($con,$qry) or die('Error Occured #3g');
						$qry = "SELECT wl_id from sw_workl where work_add = '$_POST[work_in]';";
						$result = mysqli_query($con,$qry) or die('Error Occured #3h');
						$id = mysqli_fetch_assoc($result);
						$wl_id = $id[wl_id];
					}
					$qry = "update sw_detail set wl_id = '$wl_id' where u_id = '$_SESSION[sub1]';";
					mysqli_query($con,$qry);
				}
				if(!empty($_POST[bio])){
					$qry = "update sw_detail set bio = '$_POST[bio]' where u_id = '$_SESSION[sub1]';";
					mysqli_query($con,$qry) or die('Error Occured');
				}
				mysqli_close($con);
							
				?>
				
				</ul>
          </div>
            </article>
        
      </div>
        </div>
  </div>
    </div>

<!--============================== footer =================================-->
<footer>
      <div class="container clearfix">
    <ul class="list-social pull-right">
          <li><a class="icon-1" href="#"></a></li>
          <li><a class="icon-2" href="#"></a></li>
          <li><a class="icon-3" href="#"></a></li>
          <li><a class="icon-4" href="#"></a></li>
        </ul>
    <div class="privacy pull-left">&copy; 2013 <a href="">SocialWorld.com</a> </div>
  </div>
    </footer>
<script type="text/javascript" src="js/bootstrap.js"></script>
</body>
</html>