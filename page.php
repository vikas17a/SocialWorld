<!DOCTYPE html>
<html lang="en">
<head>
    <title>Pages</title>
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
	<script>
		function search_page(){
		var search;
		search = document.getElementById('search').value;
		search = encodeURIComponent(search);
	
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
					
					document.getElementById('result').innerHTML=xmlhttp.responseText;
				}
			}		
			xmlhttp.open("POST","search_page.php",true);
			xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlhttp.send("search="+search);}
		
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
			document.getElementById('pages').innerHTML=xmlHttp.responseText;
			setTimeout('Ajax()',1000);
		}
	}
	xmlHttp.open("GET","page_ajax.php",true);
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
                <li class='active'><a href="page.php">Page</a></li>
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
		 <div style='float:right' id="pages">
		 <h3>Pages Created by you </h3>
		 <ul>
		 <?php
			$con = mysqli_connect('localhost','root','','sw');
			$qry = "select sw_paged.name,sw_paged.page_id from sw_paged,sw_page where sw_page.u_id = '$_SESSION[sub1]' and sw_page.page_id= sw_paged.page_id;";
			$result = mysqli_query($con,$qry);
			while($name = mysqli_fetch_assoc($result)){
				echo "&bull;<a href='page_prof.php?id=$name[page_id]' style='font-size:25px'> $name[name]</a><br><br>";
			}
			echo "<ul>";
			mysqli_close($con);
			
		 ?>
		
		
		 
		
		</div>
		<div style='float:left'>
		<h3>Create A New Page</h3>
		<form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>" enctype='multipart/form-data'>
		<fieldset>
			<input type='text' placeholder='Name of Page' name='name' id='name'>
			<input type='text' placeholder='Category' name='ctg' id='ctg'><br>
			<textarea placeholder='Description of your page' name='desc' id='desc' style='width:428px;height:200px'></textarea><br>
			<name style='color:#e85356'>Upload Page Picture</name><input type='file' name='file' id='file'><br>
			<button class="btn" type='submit'>Create Page</button>
			<?php 
				if(!(empty($_POST[name]) || empty($_POST[ctg]))){
					$name = mysql_real_escape_string(htmlentities(addslashes($_POST[name])));
					$ctg = mysql_real_escape_string(htmlentities(addslashes($_POST[ctg])));
					$desc = mysql_real_escape_string(htmlentities(addslashes($_POST[desc])));
					echo $_FILES[file][type];
					if($_FILES[file][type] != 'image/jpeg'){
						echo "<b style='color:'>Please upload an jpeg extension</b>";
					}
					else{
						$con = mysqli_connect('localhost','root','','sw');
						$stamp=time().$_FILES['file']['name'];
						move_uploaded_file($_FILES[file][tmp_name], "file/".$stamp) or die('Error Occured');
						$qry = "insert into sw_picup values('','$stamp');";
						mysqli_query($con,$qry);
						$qry = "select pic_id from sw_picup where pic = '$stamp';";
						$result = mysqli_query($con,$qry);
						$id = mysqli_fetch_assoc($result);
						$pic_id = $id[pic_id];
						$qry = "select ct_id from sw_pcategory where ct_name = '$ctg';";
						$result = mysqli_query($con,$qry);
						if($id = mysqli_fetch_assoc($result)){
							$ct_id = $id[ct_id];
						}
						else{
							$qry = "insert into sw_pcategory values('','$ctg');";
							mysqli_query($con,$qry);
							$qry = "select ct_id from sw_pcategory where ct_name = '$ctg';";
							$result = mysqli_query($con,$qry);
							$id = mysqli_fetch_assoc($result);
							$ct_id = $id[ct_id];
						}
						$qry = "insert into sw_paged values('','$name','$ct_id','$desc','$pic_id');";
						mysqli_query($con,$qry);
						$qry = "select page_id from sw_paged where pic_id = '$pic_id';";
						$result = mysqli_query($con,$qry);
						$id = mysqli_fetch_assoc($result);
						$page_id = $id[page_id];
						$qry = "insert into sw_page values('$page_id','$_SESSION[sub1]');";
						mysqli_query($con,$qry);
						mysqli_close($con);
						echo "<b style='color:'>Page created</b>";
					}
				}
				else{
					echo "<b style='color:'>Please complete fields</b>";
				}
			?>
		</fieldset>
		</form>
		<br>
		<br>
		<br>
		</ul>
		</div>
		<div style='margin-left:30px'>
		<h3>Search Pages</h3>
		<input type='text' name='search' id='search' placeholder='Search Pages' style='width:400px'><button class="btn" onclick="search_page()">Search</button>
		</div>
		<div id="result" style='margin-left:30px'>
		
		</div>
		</div>
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