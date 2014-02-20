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
	<script>/*
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
			
		}*/
		function delete_up(path){
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
					window.location='uploads.php';
				}
			}		
			xmlhttp.open("POST","delete_up.php",true);
			xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlhttp.send("id="+path);
			
		}
	</script>
	
	<script>/*
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
	xmlHttp.open("GET","post_here.php",true);
	xmlHttp.send(null);
}

window.onload=function(){
setTimeout('Ajax()',10000);
}*/
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
	$qry = "select sw_city.c_name,sw_state.s_name,sw_country.cn_name,sw_picup.pic,sw_profession.profession,sw_workl.work_add,sw_detail.fname,sw_detail.lname,sw_detail.bio,sw_detail.dob from sw_detail,sw_picup,sw_city,sw_state,sw_country,sw_profession,sw_workl where sw_detail.c_id=sw_city.c_id and sw_detail.s_id = sw_state.s_id and sw_detail.cn_id = sw_country.cn_id and sw_detail.pic_id = sw_picup.pic_id and sw_detail.w_id = sw_profession.w_id and sw_detail.wl_id = sw_workl.wl_id and u_id = $u_id;";
	$result = mysqli_query($con,$qry) or die('Error Occured');
	$detail = mysqli_fetch_assoc($result);
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
                <li ><a href="index-3.php">Home</a></li>
				<li><a href="index-2.php">Friends</a></li>
				<li class="active"><a href="uploads.php">Uploads</a></li>
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
<?php
				if(empty($_FILES[file])){
					define('jjjp','1');
				}
				else{
					if($_FILES[file][type] == "image/jpeg"){
						$con = mysqli_connect('localhost','root','','sw');
						$stamp = time().$_FILES[file][name];
						$name = $_FILES[file][name];
						move_uploaded_file($_FILES[file][tmp_name],"upload/".$stamp) or die('Error Occured');
						$qry = "insert into sw_upload values('','$name','1','$stamp',current_date(),current_time(),'$_SESSION[sub1]');";
						mysqli_query($con,$qry);
						mysqli_close($con);
					}
					else{
						echo 'File format not supported (Upload an jpeg format)';
					
					}
					
				}
			?>    
  <!--============================== content =================================-->      
   <div id="content"><div class="ic"></div>
    <div class="container">
          <div class="row">
       
         <div class="inner-1">         
          <ul class="list-blog">
            <li style="height:200px">  <div>
            <div style="float:left"><h4><?php echo $detail[fname]." ".$detail[lname];?></h4></div>  
            <div style="float:right;height:150px"><img style="height:130px" src="file/<?php echo $detail[pic];?>" alt="Profile Pic"></div></div><br><br><br><br><br>
             <p><?php echo $detail[bio];?></p>  <hr style='color:#e85356'>
			<h3 style='color:#e85356'>Uploaded Pictures</h3></li>
				<ul class="portfolio clearfix">
		   <!--li class="box"><a href="img/image-blank.png" class="magnifier" ><img alt="" src="img/page3-img5.jpg"></a></li> 
           <li class="box"><a href="img/image-blank.png" class="magnifier" ><img alt="" src="img/page3-img6.jpg"></a></li> 
           <li class="box"><a href="img/image-blank.png" class="magnifier" ><img alt="" src="img/page3-img7.jpg"></a></li> 
           <li class="box"><a href="img/image-blank.png" class="magnifier" ><img alt="" src="img/page3-img8.jpg"></a></li> 
           <li class="box"><a href="img/image-blank.png" class="magnifier" ><img alt="" src="img/page3-img9.jpg"></a></li> 
           <li class="box"><a href="img/image-blank.png" class="magnifier" ><img alt="" src="img/page3-img10.jpg"></a></li> 
           <li class="box"><a href="img/image-blank.png" class="magnifier" ><img alt="" src="img/page3-img11.jpg"></a></li> 
           <li class="box"><a href="img/image-blank.png" class="magnifier" ><img alt="" src="img/page3-img12.jpg"></a></li><li></li--> 
			<?php
				$con = mysqli_connect('localhost','root','','sw');
				$qry = "select p_ath,f_id from sw_upload where u_id = '$_SESSION[sub1]';";
				//echo $qry;
				$result = mysqli_query($con,$qry);
				while($path = mysqli_fetch_assoc($result)){
					echo "<li class='box'><a href='upload/$path[p_ath]' class='magnifier'><img style='width:300px;height:200px' alt='' src='upload/$path[p_ath]'></a><br><a class='btn' onclick=delete_up($path[f_id])>Delete</a></li>";
				}
				echo "<li></li>";
			?>
			
			</ul><br>
			
			<h3 style='color:#e85356'>Upload New Pictures</h3><hr>
			<form method="POST" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF'];?>">
			<fieldset>
				<?php if(defined('jjjp')) {?>
			<name style='font-size:18px'>Upload jpeg format file</name>
			<?php }?>
				<label for='file'>Upload your picture</label><input type='file' name='file' id='file'>
				<button class="btn btn1">Upload</button>
			</fieldset>
			</form>
			
          </ul>
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