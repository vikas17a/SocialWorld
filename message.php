<!DOCTYPE html>
<html lang="en">
<head>
    <title>Message</title>
    <meta charset="utf-8">  
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
    <meta name="description" content="Your description">
    <meta name="keywords" content="Your keywords">
    <meta name="author" content="Your name">    
    <link rel="stylesheet" href="css/bootstrap.css" type="text/css" media="screen">
    <link rel="stylesheet" href="css/responsive.css" type="text/css" media="screen">
    <link rel="stylesheet" href="css/style.css" type="text/css" media="screen">
    <!--link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'-->
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
	function send_message(id){
		var msg;
		msg = document.getElementById('text').value;
		msg = encodeURIComponent(msg);
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
					document.getElementById('text').value = "";
				}
			}		
			xmlhttp.open("POST","send_message.php",true);
			xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlhttp.send("id="+id+"&msg="+msg);
	
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
			document.getElementById('here').innerHTML=xmlHttp.responseText;
			setTimeout('Ajax()',1000);
		}
	}
	xmlHttp.open("GET","msg.php",true);
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
		if(empty($_SESSION[sub1]) || empty($_SESSION[advanced])){
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
                <li><a href="index-2.php">Freinds</a></li>
                <li><a href="edit.php">Edit</a></li>
                <li><a href="page.php">Page</a></li>
                <li class="active"><a href="#">Message</a></li>
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
				$qry = "select fname,lname from sw_detail where u_id = '$_SESSION[advanced]';";
				$result = mysqli_query($con,$qry);
				$detail = mysqli_fetch_assoc($result);
		 ?>
		 <div style="float:left">
			<h3>Send Message</h3> <?php 
				echo "to <name style='color:#e85356'>".$detail[fname]." ".$detail[lname]."</name><br>";
			?>
			<textarea style="height:50px;width:500px" id="text"></textarea><br><a class="btn btn-1" onclick="send_message(<?php echo $_SESSION[advanced];?>)">Send</a>
			<br><br><br></div>
		 <div style="width:500px">
			<h3>Messages</h3>
			<div id="here">
			<?php
				
				//echo "from <name style='color:#e85356'>".$detail[fname]." ".$detail[lname]."</name><br>";
				$qry = "select fname from sw_detail where u_id = '$_SESSION[sub1]';";
				$result = mysqli_query($con,$qry);
				$details = mysqli_fetch_assoc($result);
				$qry = "select sw_message.message,sw_message.d_ate,sw_message.t_ime,sw_message.usend,sw_message.urev_id from sw_message where sw_message.urev_id in ('$_SESSION[sub1]','$_SESSION[advanced]') and sw_message.usend in ('$_SESSION[advanced]','$_SESSION[sub1]') order by sw_message.d_ate desc, sw_message.t_ime desc limit 10;";
				$msg = mysqli_query($con,$qry);
				while($mssg = mysqli_fetch_assoc($msg)){
				echo "<hr><message style='color:'>$mssg[message]</message> &nbsp; &nbsp;&nbsp;"; if($mssg[usend] == $_SESSION[advanced]){echo "by  <name style='color:#e85356'>$detail[fname]</name> &nbsp;&nbsp; $mssg[t_ime]<br>";}else{ echo "by <name style='color:#e85356'>$details[fname]</name>&nbsp;&nbsp; $mssg[t_ime]<br>";} }
				mysqli_close($con);
			?>
			</div>
			</div>
			
			
			<?php
				
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