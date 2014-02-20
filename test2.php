<html>
<head>
<Script Language=JavaScript>
<!-- Hide
function rusure() {
if (confirm("Are you sure you want to close Me?"))
	{ 
	window.close();
return true;
	}
else {
	
      return false; }
   
}
// end hide -->
</script>
</head>
<body onUnload="rusure();">
<form><input type="button" value="close" onclick="window.close();"></form><p>

<a href="JavaScript:rusure();">Close Me</a>