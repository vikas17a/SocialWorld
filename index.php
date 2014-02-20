<!DOCTYPE html>
<html lang="en">
	<head>
	<title>SocialWorld</title>
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
	<link rel="stylesheet" href="css/kwicks-slider.css" type="text/css" media="screen">
	<!--link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'-->
	<script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/superfish.js"></script>
	<script type="text/javascript" src="js/jquery.flexslider-min.js"></script>
	<script type="text/javascript" src="js/jquery.kwicks-1.5.1.js"></script>
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
		if(!empty($_SESSION[inc])){
			header('Location:complete.php');
		}
		if(!(empty($_SESSION[sub1]) || empty($_SESSION[sub2]))){
			header('Location:index-3.php');
		}
		$flag = FALSE;
		$flag2 = FALSE;
		if(isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['email']) && isset($_POST['day']) && isset($_POST['month']) && isset($_POST['year']) && isset($_POST['password']) && isset($_POST['repassword']) && isset($_POST['sex'])){
			$fname = addslashes(trim(strip_tags($_POST['fname'])));
			$lname = addslashes(trim(strip_tags($_POST['lname'])));
			$email = addslashes(trim(strip_tags($_POST['email'])));
			$sex = addslashes(trim(strip_tags($_POST['sex'])));
			$dy = range(1,31);
			$mon = array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
			$yr = range(1980,1995);
			if(!(empty($_POST['day']) || empty($_POST['month']) || empty($_POST['year']))){
				if((in_array($_POST[day],$dy) && in_array($_POST[month],$mon) && in_array($_POST[year],$yr))){
					$date = $_POST['day']."-".$_POST['month']."-".$_POST['year'];
				}
				else{
					die('Error Occured');
				}
			}
			else{
				$date = "";
			}
			$password = addslashes(trim(strip_tags($_POST['password'])));
			$repassword = addslashes(trim(strip_tags($_POST['repassword'])));	
			if(!(empty($fname) || empty($lname) || empty($email) || empty($date) || empty($password) || empty($repassword) || empty($sex))){
				if(($sex != 'M') && ($sex != 'F')){
					$flag=TRUE;
				}
				else{
					$flag=FALSE;
					include_once 'classes/norm_reg.php';
					$con = mysqli_connect('localhost','root','','sw') or die('Error Occured #0');
					$db = new regUser();
					if($password == $repassword){
						if($db->validate($email)){
							if($db->validate_pwd($password)){
								$password = sha1($password);
								$qry = "INSERT INTO sw_ulogin VALUES('','$email','$password','free');";
								mysqli_query($con,$qry) or die('Error Occured #1');
								$qry = "Select u_id from sw_ulogin where email='$email';";
								$result = mysqli_query($con,$qry) or die('Error Occured #2');
								$id = mysqli_fetch_assoc($result);
								mysqli_close($con);
								session_start();
								$_SESSION['sub1']=addslashes(trim(strip_tags($fname)));
								$_SESSION['sub2']=addslashes(trim(strip_tags($lname)));
								$_SESSION['sub3']=addslashes(trim(strip_tags($email)));
								$_SESSION['sub4']=$id['u_id'];
								$_SESSION['sub5']=$date;
								$_SESSION['sub6']=$sex;
								header('location:index-4.php'); 
							}
							else{
								define('pwd','1');
								
							}
						}
						else{
							define('email','1');
							
						}
					}
					else{
						define('match','1');
						
					}
				}
			}
			else{
					$flag=TRUE;
			}
		}
		else{
			$flag=FALSE;
		}
		
		if(isset($_POST['email_log']) && isset($_POST['password_log'])){
			$email_log = $_POST['email_log'];
			$password_log = $_POST['password_log'];
			if(!(empty($email_log) || empty($password_log))){
				$flag2=FALSE;
				include_once 'classes/norm_reg.php';
				$db = new regUser();
				if($db->validate($email_log)){
					$con = mysqli_connect('localhost','root','','sw') or die('Error Occured #2');
					$password = sha1(trim(stripslashes(strip_tags($_POST['password_log']))));
					$qry = "SELECT u_id from sw_ulogin where email = '$_POST[email_log]' and password = '$password';";
					$result = mysqli_query($con,$qry) or die('Error Occured #3');
					$id = mysqli_fetch_assoc($result);
					$u_id = $id[u_id];
					if(empty($u_id)){
							define('incorrect','1');
							
					}
					else{
						$qry = "select u_id from sw_detail where u_id = '$u_id';";
						$result = mysqli_query($con,$qry) or die('Error Occured #3');
						$id = mysqli_fetch_assoc($result);
						$n_id = $id[u_id];
						if(empty($n_id)){
							session_Start();
							$_SESSION[sub1] = $u_id;
							$_SESSION[sub2]  = $email_log;
							$_SESSION[inc] = "TRUE";
							
							header('Location:complete.php');
						}
						else{
							session_start();
							$_SESSION[sub1]=$u_id;
							$_SESSION[sub2]=$email_log;
							echo 'Redirecting to your account';
							header('Location:index-3.php');
						}
						
					}
				}
				else{
					echo "<b style='color:#e85356'>Email is not a valid email address</b>";
				}
			}
			else{
				$flag2=TRUE;
			}
		}
		else{
			$flag2=FALSE;
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
                <li class="active"><a href="index.php">Home</a></li>
				<li><a href="#">Login</a></li>
                <li class="sub-menu"><a href="#">Account</a>
                      <ul>
                    <li><a href="#">Free </a></li>
                    <li><a href="#">Silver</a></li>
                    <li><a href="#">Gold</a></li>
                  </ul>
                    </li>
                <li><a href="index-1.html">About us</a></li>
                <li><a href="#">Policy</a></li>
                
              </ul>
                </div>
          </div>
            </div>
      </div>
        </div>
  </div>
    </header>
<div class="bg-content">
      <div class="container">
    <div class="row">
          <div class="span12"> 
        <!--============================== slider =================================-->
        <span id="responsiveFlag"></span>
		<br><br>
        <div class="block-slogan">
              <h2>Welcome!</h2>
              <div>
            <p>Social World is about to connect people around the world. We provide you with three types of membership try our services and get connected. Registration is free and will be free for forever, you can upgrade your account any time you want.</p>
          </div>
            </div>
		
		<div class="flexslider">
              <ul class="slides">
			<li> <img src="img/img/05.jpg" alt="" style="height:393px;width:770px"> </li>
            <li > <img src="img/img/01.jpg" alt=""  style="height:393px;width:770px"> </li>
            <li> <img src="img/img/02.jpg" alt="" style="height:393px;width:770px"> </li>
            <li> <img src="img/img/03.jpg" alt="" style="height:393px;width:770px"> </li>
            <li> <img src="img/img/04.jpg" alt="" style="height:393px;width:770px"> </li>
            
			
          </ul>
            </div>
        
      </div>
        </div>
  </div>
    </div>  
      <!--============================== content =================================-->
		<div class="container clearfix"><br><div style="float:left">
		<h3 style='color:#e85356'>Registration</h3><hr>
		<form method="POST" action=<?php echo $_SERVER['PHP_SELF'];?>>
		<table style='border:none;text-align:left'>
		<tr>
			<th><label for="fname">Name :</label></th><th><input type="text" name="fname" id="fname" style='width:90px' placeholder="First Name"><input type="text" name="lname" placeholder="Last Name" style='width:100px'></th>
		</tr>
		<tr>
			<th><label for="email">Email :</label></th><th><input type="email" name="email" id="fname" placeholder="Email"></th>
		</tr>
		<tr>
			<th><label for='sex'>Sex :</label></th><th><select name='sex'><option value='M'>Male</option><option value='F'>Female</option></select></th>
		</tr>
		<tr>
			<th><label for="dob">Date of Birth : </label></th><th><select name="day" style="width:56px"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option></select><select name="month" style='width:70px'><option value="Jan">Jan</option><option value="Feb">Feb</option><option value="Mar">Mar</option><option value="Apr">Apr</option><option value="May">May</option><option value="Jun">Jun</option><option value="Jul">Jul</option><option value="Aug">Aug</option><option value="Sep">Sep</option><option value="Oct">Oct</option><option value="Nov">Nov</option><option value="Dec">Dec</option></select><select name="year" style='width:95px'><option value="1980">1980</option><option value="1981">1982</option><option value="1983">1984</option><option value="1985">1985</option><option value="1986">1986</option><option value="1987">1987</option><option value="1988">1988</option><option value="1989">1989</option><option value="1990">1990</option><option value="1991">1991</option><option value="1992">1992</option><option value="1993">1993</option><option value="1994">1994</option><option value="1995">1995</option></select></th>
		</tr>
		<tr>
			<th><label for="password">Password : </label></th><th><input type="password" name="password" id="password" placeholder="Enter Password"></th>
		</tr>
		<tr>
			<th><label for="repassword">Re-type Password : </label></th><th><input type="password" name="repassword" id="repassword" placeholder="Re-Enter Password"></th>
		</tr>
		</table>
		<input type="submit" class="buttons-wrapper btn btn-1" value="Register"><?php if($flag){echo " &nbsp; &nbsp;<b style='color:#e85356'>Please fill all the fields</b>";} else if(defined('pwd')){ echo "<b style='color:#e85356'> Password must be greater than 5 characters</b>"; } else if(defined('pwd')){ echo "<b style='color:#e85356'> Please enter a valid email address</b>"; } else if(defined('match')){echo "<b style='color:#e85356'> Password do not match</b>";}?>
		</form></div>
		
		<div id="login" style="width:347px;float:left;margin:auto auto auto 180px;">
		<h3 style='color:#e85356'>Login</h3><hr>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
		<table style='border:none;text-align:left'>
		<tr>
			<th><label for="email">Email :</label></th><th><input type="email" name="email_log" id="fname" placeholder="Email"></th>
		</tr>
		
		<tr>
			<th><label for="password">Password : </label></th><th><input type="password" name="password_log" id="password" placeholder="Enter Password"></th>
		</tr>
		</table>
		<input type="submit" class="buttons-wrapper btn btn-1" value="Login"><?php if($flag2 == TRUE){echo "&nbsp; &nbsp; <b style='color:#e85356'>Please fill all the fields</b>'";} else if(defined('incorrect')){echo "<b style='color:#e85356'> Incorrect Credentials</b>";}?>
		</form></div>
		
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