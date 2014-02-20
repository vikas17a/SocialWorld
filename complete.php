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
	<!--link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'-->
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/superfish.js"></script>
	<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
	<script src="js/forms.js"></script>
	<script>		
   jQuery(window).load(function() {	
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
		if((empty($_SESSION['sub1']) && empty($_SESSION['inc']))){
			//echo $_SESSION[sub1];
			session_unset();
			session_destroy();
			header('Location:index.php');
		}
		else{
			unset($_SESSION['inc']);
			if(!(empty($_POST['fname']) || empty($_POST['lname']) || empty($_POST['sex']) || empty($_POST['city']) || empty($_POST['city']) || empty($_POST['country']) || empty($_POST['work_as']) || empty($_POST['work_in']) || empty($_POST['bio']))){
				//echo 'Please wait while we redirect';
				$fname = addslashes(trim(strip_tags($_POST['fname'])));
				$lname = addslashes(trim(strip_tags($_POST['lname'])));
				$sex = addslashes(trim(strip_tags($_POST['sex'])));
				$city = addslashes(trim(strip_tags($_POST['city'])));
				$state = addslashes(trim(strip_tags($_POST['state'])));
				$country = addslashes(trim(strip_tags($_POST['country'])));
				$work_as = addslashes(trim(strip_tags($_POST['work_as'])));
				$work_in = addslashes(trim(strip_tags($_POST['work_in'])));
				$bio = addslashes(trim(strip_tags($_POST['bio'])));
				if(($sex != 'M') && ($sex != 'F')){
					die('Error Occured');
				}
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
					define('date','1');
				}
				if(!(defined('date'))){
					$con = mysqli_connect('localhost','root','','sw') or die('Error Occured #2');
					$qry = "select c_id from sw_city where c_name = '$_POST[city]';";
					$result = mysqli_query($con,$qry) or die('Error Occured #3_a');
					$id=mysqli_fetch_assoc($result);
					$c_id = $id[c_id];
					if(empty($c_id)){
						$qry = "INSERT INTO sw_city values('','$_POST[city]');";
						mysqli_query($con,$qry) or die('Error Occured #3a');
						$qry = "SELECT c_id from sw_city where c_name = '$_POST[city]';";
						$result = mysqli_query($con,$qry) or die('Error Occured #3b');
						$id = mysqli_fetch_assoc($result);
						$c_id = $id[c_id];
					}
					$qry = "select s_id from sw_state where s_name = '$_POST[state]';";
					$result = mysqli_query($con,$qry) or die('Error Occured #3c');
					$id = mysqli_fetch_assoc($result);
					$s_id = $id[s_id];
					if(empty($s_id)){
						$qry = "INSERT INTO sw_state values('','$_POST[state]');";
						mysqli_query($con,$qry) or die('Error Occured #3d');
						$qry = "SELECT s_id from sw_state where s_name = '$_POST[state]';";
						$result = mysqli_query($con,$qry) or die('Error Occured #3e');
						$id = mysqli_fetch_assoc($result);
						$s_id = $id[s_id];
					}
					$qry = "select cn_id from sw_country where cn_name='$_POST[country]';";
					$result = mysqli_query($con,$qry) or die('Error Occured #3f');
					$id = mysqli_fetch_assoc($result);
					$cn_id = $id[cn_id];
					if(empty($cn_id)){
						$qry = "INSERT INTO sw_country values('','$_POST[country]');";
						mysqli_query($con,$qry) or die('Error Occured #3g');
						$qry = "SELECT cn_id from sw_country where cn_name = '$_POST[country]';";
						$result = mysqli_query($con,$qry) or die('Error Occured #3h');
						$id = mysqli_fetch_assoc($result);
						$cn_id = $id[cn_id];
					}
					$qry = "select w_id from sw_profession where profession = '$_POST[work_as]';";
					$result = mysqli_query($con,$qry) or die('Error Occured #3i');
					$id = mysqli_fetch_assoc($result);
					$w_id = $id[w_id];
					if(empty($w_id)){
						$qry = "INSERT INTO sw_profession values('','$_POST[work_as]');";
						mysqli_query($con,$qry) or die('Error Occured #3j');
						$qry = "select w_id from sw_profession where profession = '$_POST[work_as]';";
						$result = mysqli_query($con,$qry) or die('Error Occured #3k');
						$id = mysqli_fetch_assoc($result);
						$w_id = $id[w_id];
					}
					$qry = "select wl_id from sw_workl where work_add = '$_POST[work_in]';";
					$result = mysqli_query($con,$qry) or die('Error Occured #3f');
					$id = mysqli_fetch_assoc($result);
					$wl_id = $id[wl_id];
					if(empty($wl_id)){
						$qry = "INSERT INTO sw_workl values('','$_POST[work_in]');";
						mysqli_query($con,$qry) or die('Error Occured #3g');
						$qry = "SELECT wl_id from sw_workl where work_add = '$_POST[work_in]';";
						$result = mysqli_query($con,$qry) or die('Error Occured #3h');
						$id = mysqli_fetch_assoc($result);
						$wl_id = $id[wl_id];
					}
					$qry = "INSERT INTO sw_detail values('$_SESSION[sub1]','$_POST[sex]','$c_id','$s_id','$cn_id','1','$bio','$fname','$lname','$w_id','$wl_id','$date');";
					mysqli_query($con,$qry) or die('Error Occured ##details');
					mysqli_close($con);
					echo 'Registered';
					header('Location:index-3.php');
				}
			}
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
                <li class="active"><a href="index-4.php">Home</a></li>
				<li><a href="index-2.html">Friends</a></li>
                <li class="sub-menu"><a href="#">Edit</a>
                   
                    </li>
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
      <div id="content">
    <div class="container">
          <div class="row">
        <article class="span8">
              <h3>Update your Details</h3>
              <div class="inner-1">
            <form  method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
					<input type='text' placeholder='First Name' name='fname'>
					
					<input type='text' placeholder='Last Name' name='lname'><br>
					
					<select name='sex'><option value='M'>Male</option><option value='F'>Female</option></select><br>
                  
					<select name="day" style="width:56px"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option></select><select name="month" style='width:70px'><option value="Jan">Jan</option><option value="Feb">Feb</option><option value="Mar">Mar</option><option value="Apr">Apr</option><option value="May">May</option><option value="Jun">Jun</option><option value="Jul">Jul</option><option value="Aug">Aug</option><option value="Sep">Sep</option><option value="Oct">Oct</option><option value="Nov">Nov</option><option value="Dec">Dec</option></select><select name="year" style='width:95px'><option value="1980">1980</option><option value="1981">1982</option><option value="1983">1984</option><option value="1985">1985</option><option value="1986">1986</option><option value="1987">1987</option><option value="1988">1988</option><option value="1989">1989</option><option value="1990">1990</option><option value="1991">1991</option><option value="1992">1992</option><option value="1993">1993</option><option value="1994">1994</option><option value="1995">1995</option></select>
				  
                    <br><input type="text" placeholder="City" name="city">
                  
                
                
                    <input type="text" placeholder="State" name="state">
                
                
                    <input type="text" placeholder="Country where you live" name="country">
				
					<br>
					
					<input type="text" placeholder="Working as" name='work_as'>
					<input type="text" placeholder="Working at" name='work_in'>
					
					<br>
                
                    <textarea name="bio" style="width:430px;height:150px" placeholder="About your self"></textarea>
				
            <div class="buttons-wrapper"> <a class="btn btn-1" data-type="reset">Clear</a><input type="submit" value="Update" style='background-color:#e85356;color:white;height:30px;width:80px;border:none;'></div>
            
                </form>
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