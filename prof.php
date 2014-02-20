<!DOCTYPE html>
<html lang="en">
	<head>
	<title>Home</title>
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
	    
	<script type="text/javascript">if($(window).width()>1024){document.write("<"+"script src='js/jquery.preloader.js'></"+"script>");}	</script>
	<script>		
		 jQuery(window).load(function() {	
		 $x = $(window).width();		
	if($x > 1024)
	{			
	jQuery("#content .row").preloader();}	
	
	jQuery(".list-blog li:last-child").addClass("last"); 
	jQuery(".list li:last-child").addClass("last"); 

	
    jQuery('.spinner').animate({'opacity':0},1000,'easeOutCubic',function (){jQuery(this).css('display','none')});	
  		  }); 
					
	</script>
	<script>
		function submit_post(){
			var post;
			post = document.getElementById('post').value;
			post = (encodeURIComponent(post));
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
					document.getElementById("post").value = "";
				}
			}		
			xmlhttp.open("POST","post_1.php",true);
			xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlhttp.send("post="+post);
		}
		
		function delete_post(id){
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
					alert(xmlhttp.responseText);
				}
			}		
			xmlhttp.open("POST","delete.php",true);
			xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlhttp.send("id="+id);
			
		}
		function friend_request(id){
		
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
					window.location="prof.php?id="+id;
				}
			}		
			xmlhttp.open("POST","friend.php",true);
			xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlhttp.send("id="+id);
			
		}
		
		function send_message(id){}
		
	</script>
	
	<script>
	function Ajax(){
	var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
			try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
			try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}	
			catch (e){
				alert("No AJAX!?");
			return false;
			}
		}
	}

	xmlHttp.onreadystatechange=function(){
		if(xmlHttp.readyState==4){
			document.getElementById('posting_here').innerHTML=xmlHttp.responseText;
			setTimeout('Ajax()',1000);
		}
	}
	xmlHttp.open("GET","post_here_1.php",true);
	xmlHttp.send(null);
}

window.onload=function(){
setTimeout('Ajax()',10000);
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
	$_SESSION[advanced]=$_GET[id];
	//$u_id = $_SESSION[sub1];
	//$email = $_SESSION[sub2];
	$con = mysqli_connect('localhost','root','','sw') or die('Error Occured #2');
	$qry = "select sw_city.c_name,sw_state.s_name,sw_country.cn_name,sw_picup.pic,sw_profession.profession,sw_workl.work_add,sw_detail.fname,sw_detail.lname,sw_detail.bio,sw_detail.dob from sw_detail,sw_picup,sw_city,sw_state,sw_country,sw_profession,sw_workl where sw_detail.c_id=sw_city.c_id and sw_detail.s_id = sw_state.s_id and sw_detail.cn_id = sw_country.cn_id and sw_detail.pic_id = sw_picup.pic_id and sw_detail.w_id = sw_profession.w_id and sw_detail.wl_id = sw_workl.wl_id and u_id = $_GET[id];";
	$result = mysqli_query($con,$qry) or die('Error Occured');
	$detail = mysqli_fetch_assoc($result);
	//echo "<pre>";
	//print_R($detail);
	//echo "</pre>";
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
				<li><a href="message.php">Message</a></li>
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
        <article class="span8">
         <div class="inner-1">         
          <ul class="list-blog">
            <li style="height:200px">  <div>
            <div style="float:left"><!--h3>Welcome</h3--><h4><?php $nmee = $detail[fname];  echo $detail[fname]." ".$detail[lname];?></h4></div>  
            <div style="float:right;height:150px"><img style="height:130px" src="file/<?php echo $detail[pic];?>" alt="Profile Pic"></div></div><br><br><br><br><br>
                <br>       <br>
            <p style='float:left'><?php echo $detail[profession]." at ".$detail[work_add];?><br>Born on : <?php echo $detail[dob];?> <br>From : <?php echo $detail[c_name].", ".$detail[s_name].", ".$detail[cn_name];?></p> <br>
			<?php 
				$con = mysqli_connect('localhost','root','','sw');
				
				$qry = "select u2id from sw_connection where u1id = '$_GET[id]' and bool = '0' and u2id = '$_SESSION[sub1]';";
				$result = mysqli_query($con,$qry);
				while($detail = mysqli_fetch_assoc($result)){
					if($detail[u2id] == $_SESSION[sub1]){
						define('request',1);
						break;
					}
				}
				
				$qry = "select u1id from sw_connection where u1id = '$_SESSION[sub1]' and bool = '0' and u2id = '$_GET[id]';";
				$result = mysqli_query($con,$qry);
				while($detail = mysqli_fetch_assoc($result)){
					if($detail[u1id] == $_SESSION[sub1]){
						define('requestsent',1);
						break;
					}
				}
				
				$qry = "select u1id from sw_connection where u2id='$_GET[id]' and bool = '1' and u1id = '$_SESSION[sub1]';";
				$result= mysqli_query($con,$qry);
				while($detail = mysqli_fetch_assoc($result)){
					if($detail[u1id] == $_SESSION[sub1]){
						define('friend','1');
						break;
					}
				}
				
				$qry = "select u2id from sw_connection where u1id = '$_GET[id]' and bool = '1' and u2id = '$_SESSION[sub1]';";
				$result = mysqli_query($con,$qry);
				while($detail = mysqli_fetch_assoc($result)){
					if($detail[u2id] == $_SESSION[sub1]){
						define('friend','1');
						break;
					}
				}
				if(defined('friend')){?><a class="btn btn-1" style='float:right' href="message.php">Send Message</a><br></li><br> <?php }?>
			<?php 
				if(defined('friend')){
				?>
			<textarea placeholder="Whats in your mind?" style="width:600px;height:80px" id="post"></textarea><br>
			<a class="btn btn-1" onclick="submit_post()">Publish</a><?php }
			else if(defined('request')){ ?>
			</li><br><a class="btn btn-1" id="frnd" onclick="friend_request(<?php echo $_GET[id]?>)">Respond to Friend Request</a>
			<?php }else if(defined('requestsent')){ ?>
				</li><br><a class="btn btn-1" id="frnd">Request Sent</a>
			<?php }else{?>
				</li><br><a class="btn btn-1" id="frnd" onclick="friend_request(<?php echo $_GET[id]?>)">Add Friend</a>
			<?php }?>
			<div id="posting_here">
           <?php
		session_start();
		if(empty($_SESSION[sub1])){
			die('Error Occured');
		}
		$con = mysqli_connect('localhost','root','','sw') or die('Error Occured');
		$qry =  "select sw_pid.post,sw_pid.p_id,sw_post.d_ate,sw_post.t_ime,sw_post.usend_id from sw_pid,sw_post where sw_post.urev_id = '$_GET[id]' and sw_post.pid = sw_pid.p_id order by sw_post.d_ate desc, sw_post.t_ime desc;";
			//echo $qry;
		$result = mysqli_query($con,$qry) or die('Error Occured');
		while($post = mysqli_fetch_assoc($result)){
			echo "<li><h5 style='float:left'>".$post[post]."</h5><br><br>
            <time datetime='2012-11-08' class='date-1'>at $post[t_ime] on $post[d_ate]</time>";
			$qry = "select fname,lname from sw_detail where u_id = '$post[usend_id]';";
			$rs = mysqli_query($con,$qry);
			$name = mysqli_fetch_assoc($rs);
            echo"<div class='name-author'>quoted by $name[fname] $name[lname]</div>
           </li>";
		}
		mysqli_close($con);
		?>
            </div>                     
          </ul>
          </div>  
        </article>
		<?php if(defined('friend')){ ?>
		<article style='float:right;width:380px'><br><br><br>
		<name style='font-size:28px'>Pictures of <?php echo $nmee;?></name><hr>
		<ul class="portfolio clearfix">
		<?php
			$con = mysqli_connect('localhost','root','','sw');
			$qry = "select p_ath,f_id from sw_upload where u_id = '$_GET[id]';";
			//echo $qry;
			$result = mysqli_query($con,$qry);
			while($path = mysqli_fetch_assoc($result)){
				echo "<li class='box'><a href='upload/$path[p_ath]' class='magnifier'><img style='width:100px;height:70px' alt='' src='upload/$path[p_ath]'></a><br></li>";
			}
			echo "<li></li>";
			?>
		</ul>
		</article>
		<?php } ?>
        
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