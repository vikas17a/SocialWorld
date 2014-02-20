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
			xmlhttp.open("POST","post.php",true);
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
	</script>
	
	<script>
	function Ajax(){
	var xmlHttp;
	var xml;
	try{	
		xmlHttp=new XMLHttpRequest();
		xml=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
			try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
			xml=new ActiveXObject("Msxml2.XMLHTTP");// Internet Explorer
		}
		catch (e){
			try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
				xml=new ActiveXObject("Microsoft.XMLHTTP");
			}	
			catch (e){
				alert("No AJAX!?");
			return false;
			}
		}
	}
	xml.onreadystatechange=function(){
		if(xml.readyState==4){
			document.getElementById('online').innerHTML=xml.responseText;
			setTimeout('Ajax()',1000);
		}
		
	}
	xml.open("GET","online_ajax.php",true);
	xml.send(null);

	xmlHttp.onreadystatechange=function(){
		if(xmlHttp.readyState==4){
			document.getElementById('posting_here').innerHTML=xmlHttp.responseText;
			setTimeout('Ajax()',1000);
		}
	}
	xmlHttp.open("GET","post_here.php",true);
	xmlHttp.send(null);
}

window.onload=function(){
setTimeout('Ajax()',1000);
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
	$u_id = $_SESSION[sub1];
	$email = $_SESSION[sub2];
	$con = mysqli_connect('localhost','root','','sw') or die('Error Occured #2');
	$qry = "select sw_city.c_name,sw_detail.sex,sw_state.s_name,sw_country.cn_name,sw_picup.pic,sw_profession.profession,sw_workl.work_add,sw_detail.fname,sw_detail.lname,sw_detail.bio,sw_detail.dob from sw_detail,sw_picup,sw_city,sw_state,sw_country,sw_profession,sw_workl where sw_detail.c_id=sw_city.c_id and sw_detail.s_id = sw_state.s_id and sw_detail.cn_id = sw_country.cn_id and sw_detail.pic_id = sw_picup.pic_id and sw_detail.w_id = sw_profession.w_id and sw_detail.wl_id = sw_workl.wl_id and u_id = $u_id;";
	$result = mysqli_query($con,$qry) or die('Error Occured');
	$detail = mysqli_fetch_assoc($result);
	
	$qry= "insert into sw_online values('$_SESSION[sub1]',current_date(),current_time());";
	mysqli_query($con,$qry);
	mysqli_close($con);
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
                <li class="active"><a href="index-3.php">Home</a></li>
				<li><a href="index-2.php">Friends</a></li>
				<li><a href="uploads.php">Uploads</a></li>
				<li><a href="group.php">Groups</a></li>
                <li ><a href="edit.php">Edit</a></li>
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
        <article class="span8">
         <div class="inner-1">         
          <ul class="list-blog">
            <li style="height:200px">  <div>
            <div style="float:left"><h3>Welcome</h3><h4><?php echo $detail[fname]." ".$detail[lname];?></h4></div>  
            <div style="float:right;height:150px"><img style="height:130px" src="file/<?php echo $detail[pic];?>" alt="Profile Pic"></div></div><br><br><br><br><br>
                <br>       <br>
            <p style='float:left;font-size:18px'><?php if($detail[sex] == 'M'){ echo 'Male'; }else{ echo 'Female';} ?><br><?php echo $detail[profession]." at ".$detail[work_add];?><br>Born on : <?php echo $detail[dob];?> <br>From : <?php echo $detail[c_name].", ".$detail[s_name].", ".$detail[cn_name];?></p></li>  <br>
            <textarea placeholder="Whats in your mind?" style="width:600px;height:80px" id="post"></textarea><br>
			<a class="btn btn-1" onclick="submit_post()">Publish</a>
			<div id="posting_here" style='width:1000px'>
           <?php
		session_start();
		if(empty($_SESSION[sub1])){
			die('Error Occured');
		}
		$con = mysqli_connect('localhost','root','','sw') or die('Error Occured');
		$qry =  "select sw_pid.post,sw_pid.p_id,sw_post.d_ate,sw_post.t_ime,sw_post.usend_id from sw_pid,sw_post where sw_post.urev_id = '$_SESSION[sub1]' and sw_post.pid = sw_pid.p_id order by sw_post.d_ate desc, sw_post.t_ime desc;";
			
		$result = mysqli_query($con,$qry) or die('Error Occured');
		while($post = mysqli_fetch_assoc($result)){
			echo "<li><h5 style='float:left'>".$post[post]."</h5><a style='float:right' onclick='delete_post($post[p_id])' class='btn btn-1'>Delete</a><br><br>
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
        <article class="span4">
          <h3 class="extra">Search Friends</h3>
          <form id="search" action="search.php" method="GET" accept-charset="utf-8" >
            <div class="clearfix">
              <input type="text" name="s" onBlur="if(this.value=='') this.value=''" onFocus="if(this.value =='' ) this.value=''" placeholder="Search your freinds" >
              <a href="#" onClick="document.getElementById('search').submit()" class="btn btn-1">Search</a> </div>
          </form>
          <h3>Online Freinds</h3>(Go <a href="#">offline</a>)
          <ul class="list extra extra1" id='online'><?php
				include_once 'online_ajax.php';
			?>		                       
      </ul>
          
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