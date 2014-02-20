<!DOCTYPE html>
<html lang="en">
<head>
    <title>Search results</title>
    <meta charset="utf-8">  
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
    <meta name="description" content="Your description">
    <meta name="keywords" content="Your keywords">
    <meta name="author" content="Your name">    
    <link rel="stylesheet" href="css/bootstrap.css" type="text/css" media="screen">
    <link rel="stylesheet" href="css/responsive.css" type="text/css" media="screen">
    <link rel="stylesheet" href="css/style.css" type="text/css" media="screen">
     <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="search/search.js"></script>
 	<script type="text/javascript" src="js/superfish.js"></script>
	<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>	
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
<div id="head" style='float:left;font-family:tahoma;'><a style='color:#e85356;font-size:50px'>S</a><a style='color:black;font-size:45px'>ocial</a><a style='color:#e85356;font-size:50px'>W</a><a style='color:black;font-size:45px'>orld</a><p>lets get connceted....</p></div>            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse_">Menu <span class="icon-bar"></span> </a>
            <div class="nav-collapse nav-collapse_  collapse">
                  <ul class="nav sf-menu">
                <li><a href="index-3.php">Home</a></li>
                <li><a href="index-2.php">Friends</a></li>
                <li><a href="edit.php">Edit</a></li>
                <li><a href="page.php">Pages</a></li>
                <li class='active'><a href="#">Search</a></li>
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
<section id="content">
  <div class="container">
    <div class="row">
    	<div class="span12">
            <h3></h3>
			<div class="clear"></div>
         <ul class="portfolio clearfix">
			<?php
				$con = mysqli_connect('localhost','root','','sw');
				$name =stripslashes(strip_tags(trim($_GET[s]))) ;
				if(empty($name)){
					echo('Please enter a name');
				}
				else{
					$qry = "select * from sw_detail where fname like '%$name%';";
					$result = mysqli_query($con,$qry);
					while($details = mysqli_fetch_assoc($result)){
						$qry = "select pic from sw_picup where pic_id = $details[pic_id];";
						$results =mysqli_query($con,$qry);
						$detail = mysqli_fetch_assoc($results);
						echo "<li class='box'><a href='prof.php?id=$details[u_id]'><div><img alt='$details[fname]' src='file/$detail[pic]' style='height:210px;width:210px'><br><br><name style='color:#e85356;font-size:20px'>$details[fname] $details[lname]</name></div></a></li>";
					}
				}
				mysqli_close($con);
			?>
		            </ul> 
      
		</div>  
    </div>        

</div>  
</section>
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
<div class="privacy pull-left">&copy; 2013 <a href="">SocialWorld.com</a> </div>  </div>
    </footer>
<script type="text/javascript" src="js/bootstrap.js"></script>
</body>
</html>