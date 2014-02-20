<!DOCTYPE html>
<html lang="en">
	<head>
	<title>Freinds</title>
	<meta charset="utf-8">
	<link rel="icon" href="img/favicon.ico" type="image/x-icon">
	<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
	<meta name="description" content="Your description">
	<meta name="keywords" content="Your keywords">
	<meta name="author" content="Your name">
	<link rel="stylesheet" href="css/bootstrap.css" type="text/css" media="screen">
	<link rel="stylesheet" href="css/responsive.css" type="text/css" media="screen">
	<link rel="stylesheet" href="css/style.css" type="text/css" media="screen">
	<link rel="stylesheet" href="css/touchTouch.css" type="text/css" media="screen">
	<!--link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'-->
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/superfish.js"></script>
    <script type="text/javascript" src="js/jquery.easing.1.3.js"></script>    
    <script type="text/javascript" src="js/touchTouch.jquery.js"></script> 
    
	<script type="text/javascript">if($(window).width()>1024){document.write("<"+"script src='js/jquery.preloader.js'></"+"script>");}	</script>
	<script>		
		 jQuery(window).load(function() {	
		 $x = $(window).width();		
	if($x > 1024)
	{			
	jQuery("#content .row").preloader();    }			 
	 jQuery('.magnifier').touchTouch();
		 jQuery('.spinner').animate({'opacity':0},1000,'easeOutCubic',function (){jQuery(this).css('display','none')});	
  		  }); 
					
	</script>
	<script>
		function add_friend(id){
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
					window.location = "index-3.php";
				}
			}		
			xmlhttp.open("POST","friend_add.php",true);
			xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlhttp.send("id="+id);
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
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse_">Menu <span class="icon-bar"></span> </a>
            <div class="nav-collapse nav-collapse_  collapse">
                  <ul class="nav sf-menu">
                <li><a href="index-3.php">Home</a></li>
                <li class="active"><a href="index-2.html">Friends</a>
                      
                    </li>
                <li><a href="edit.php">Edit</a></li>
                <li><a href="uploads.php">Uploads</a></li>
                <li><a href="page.php">Pages</a></li>
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
      <div id="content"><div class="ic"></div>
    <div class="container">
          <div class="row">
        <article class="span12">
        <h3>Friends</h3>
         </article>
        <div class="clear"></div>
         <ul class="portfolio clearfix">
			<?php
				$con = mysqli_connect('localhost','root','','sw') or die('Error Occured');
				$qry = "select u2id from sw_connection where u1id = '$_SESSION[sub1]' and bool = '1';";
				$result = mysqli_query($con,$qry) or die('Error Occured');
				while($id = mysqli_fetch_assoc($result)){
					define('exist','1');
					$qry = "select sw_city.c_name,sw_state.s_name,sw_country.cn_name,sw_picup.pic,sw_profession.profession,sw_workl.work_add,sw_detail.fname,sw_detail.lname,sw_detail.bio,sw_detail.dob from sw_detail,sw_picup,sw_city,sw_state,sw_country,sw_profession,sw_workl where sw_detail.c_id=sw_city.c_id and sw_detail.s_id = sw_state.s_id and sw_detail.cn_id = sw_country.cn_id and sw_detail.pic_id = sw_picup.pic_id and sw_detail.w_id = sw_profession.w_id and sw_detail.wl_id = sw_workl.wl_id and u_id = $id[u2id];";					
					$results = mysqli_query($con,$qry);
					$details = mysqli_fetch_assoc($results);
					echo "<div><li class='box'><a href='prof.php?id=$id[u2id]'><img alt='$details[fname]' src='file/$details[pic]' style='height:150px;width:180px'></a><br><name style='color:#e85356;font-size:20px'>$details[fname] $details[lname]</name></li></div>";
				}
			
				$qry = "select u1id from sw_connection where u2id ='$_SESSION[sub1]'  and bool = '1';";
				$result = mysqli_query($con,$qry) or die('Error Occured');
				while($id = mysqli_fetch_assoc($result)){
					define('exists','1');
					$qry = "select sw_city.c_name,sw_state.s_name,sw_country.cn_name,sw_picup.pic,sw_profession.profession,sw_workl.work_add,sw_detail.fname,sw_detail.lname,sw_detail.bio,sw_detail.dob from sw_detail,sw_picup,sw_city,sw_state,sw_country,sw_profession,sw_workl where sw_detail.c_id=sw_city.c_id and sw_detail.s_id = sw_state.s_id and sw_detail.cn_id = sw_country.cn_id and sw_detail.pic_id = sw_picup.pic_id and sw_detail.w_id = sw_profession.w_id and sw_detail.wl_id = sw_workl.wl_id and u_id = $id[u1id];";					
					$results = mysqli_query($con,$qry);
					$details = mysqli_fetch_assoc($results);
					echo "<div><li class='box'><a href='prof.php?id=$id[u1id]'><img alt='$details[fname]' src='file/$details[pic]' style='height:150px;width:180px'></a><br><name style='color:#e85356;font-size:20px'>$details[fname] $details[lname]</name></li></div>";					
				}
				if(!(defined('exist') || defined('exists'))){
					echo "<p style='margin-left:30px'> No friends</p>";
				}
				echo "</ul><article class='span12'><h3>New Requests</h3>";
				$qry = "select u1id from sw_connection where u2id ='$_SESSION[sub1]' and bool ='0';";
				$result = mysqli_query($con,$qry);
				while($id = mysqli_fetch_assoc($result)){
					define('super','1');
					$qry = "select sw_city.c_name,sw_state.s_name,sw_country.cn_name,sw_picup.pic,sw_profession.profession,sw_workl.work_add,sw_detail.fname,sw_detail.lname,sw_detail.bio,sw_detail.dob from sw_detail,sw_picup,sw_city,sw_state,sw_country,sw_profession,sw_workl where sw_detail.c_id=sw_city.c_id and sw_detail.s_id = sw_state.s_id and sw_detail.cn_id = sw_country.cn_id and sw_detail.pic_id = sw_picup.pic_id and sw_detail.w_id = sw_profession.w_id and sw_detail.wl_id = sw_workl.wl_id and u_id = $id[u1id];";					
					$results = mysqli_query($con,$qry);
					$details = mysqli_fetch_assoc($results);
					echo "<div><a href='prof.php?id=$id[u1id]' style='float:left'><img alt='$details[fname]' src='file/$details[pic]' style='height:150px;width:180px'><br><name style='color:#e85356;font-size:20px'>$details[fname] $details[lname]</name></div></a><a class='btn btn-1' onclick='add_friend($id[u1id])' style='float:right'>Accept</a><br>";					
				}
				if(!(defined('super'))){
					echo "<p> No Friend Request</p>";
				}
				echo "</article>";
				mysqli_close($con);				
			?>
                               
           <!--li class="box"><a href="img/image-blank.png" class="magnifier" ><img alt="" src="img/page3-img16.jpg"></a></li-->                       
            </ul> 
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