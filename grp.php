<?php
	session_start();
	if(empty($_SESSION[sub1])){
		header('Location:index.php');
	}
	if(empty($_GET[id])){
		die('Error Occured');
	}
	$_SESSION[g_id] = $_GET[id];
	$con = mysqli_connect('localhost','root','','sw');
	$qry = "select sw_group.gp_name,sw_group.g_id,sw_picup.pic,sw_group.descr from sw_group,sw_picup where sw_group.pic_id = sw_picup.pic_id and sw_group.g_id = '$_SESSION[g_id]';";
	//echo $qry;
	$result = mysqli_query($con,$qry) or die('Error Occured');
	$detail = mysqli_fetch_assoc($result);
	$qry = "select u_id from sw_gjoin where g_id ='$_SESSION[g_id]' and u_id = '$_SESSION[sub1]';";
	$result = mysqli_query($con,$qry);
	if($u_id = mysqli_fetch_assoc($result)){
		define('sw','1');
	}
	mysqli_close($con);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
	<title>Group</title>
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
					//alert(xmlhttp.responseText);
					document.getElementById("post").value = "";
				}
			}		
			xmlhttp.open("POST","gpost.php",true);
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
			xmlhttp.open("POST","gdelete.php",true);
			xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlhttp.send("id="+id);
			
		}
		function join_group(id){
			//alert(id);
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
					window.location="grp.php?id="+id;
					document.getElementById("on_click").innerHTML = "Joined";
				}
			}		
			xmlhttp.open("POST","join_grp.php",true);
			xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlhttp.send("id="+id);
		}
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
			document.getElementById('post_here').innerHTML=xmlHttp.responseText;
			setTimeout('Ajax()',1000);
		}
	}
	xmlHttp.open("GET","gpost_here.php",true);
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
				<li><a href="uploads.php">Uploads</a></li>
				<li class='active'><a href="group.php">Groups</a></li>
                
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
        
         <div class="inner-1" style='height:240px'>         
          <ul class="list-blog">
            <li style="height:180px">  <div>
            <div style="float:left"><h4><?php echo "$detail[gp_name]";?></h4><p><?php echo "$detail[descr]"?></p></div>
			
            <div style="float:right;height:150px"><img style="height:130px" src="group/<?php echo $detail[pic];?>" alt="Profile Pic"><?php if(!(defined('sw'))){ ?><a class='btn btn-1' id='on_click' onclick='join_group(<?php echo $_SESSION[g_id]; ?>)'>Join Group</a><?php }else{ ?><a class='btn btn-1' href='#'>Joined</a> <?php }?></div></div>
              </li><li></li>
			  </ul>
            </div>
				<?php if(defined('sw')){ ?>
				<div style='float:left'>
				<textarea placeholder="Whats in your mind?" style="width:600px;height:80px" id="post"></textarea><br>
			<a class="btn btn-1" onclick="submit_post()">Publish</a><?php } ?><div id='post_here'><?php 

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
					
				</div>
				</div>
				<div style='float:right;width:180px'>
				<name style='font-size:30px'>Users Joined<hr></name>
				<?php 
					$con = mysqli_connect('localhost','root','','sw');
					$qry = "select sw_detail.fname,sw_detail.lname,sw_picup.pic from sw_gjoin,sw_detail,sw_picup where sw_gjoin.g_id = '$_SESSION[g_id]' and sw_detail.u_id = sw_gjoin.u_id and sw_detail.pic_id = sw_picup.pic_id;";
					$result = mysqli_query($con,$qry);
					while($detail = mysqli_fetch_assoc($result)){
						echo "<li style='display:block'><img src='file/$detail[pic]' style='width:30px;float:left'><name>&nbsp; $detail[fname] $detail[lname]</name></li><br>";
					}
					mysqli_close($con);
				?>
				<!--li style='display:block'><img src='file/avtar.jpg' style='width:30px;height:30px;float:left'><name>&nbsp;</name> Joiner 1</li><br>	
				<li style='display:block'><img src='file/avtar.jpg' style='width:30px;height:30px;float:left'><name>&nbsp;</name> Joiner 1</li><br>	
				<li style='display:block'><img src='file/avtar.jpg' style='width:30px;height:30px;float:left'><name>&nbsp;</name> Joiner 1</li><br>	
				<li style='display:block'><img src='file/avtar.jpg' style='width:30px;height:30px;float:left'><name>&nbsp;</name> Joiner 1</li><br-->	

				
				
				
				
				
				</div>
        
          </div>  
        
        
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