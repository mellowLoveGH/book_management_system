<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>start page</title>

<style type="text/css"> 
<!-- 
<link rel="stylesheet" type="text/css" href="indexstyle.css">
--> 
	.{
		padding:0;
		margin:0;
	}
	.div1{
		height:50px;
		border:5px solid grey;
		
	}
	.div2{
		height:120px;
		border:5px solid grey;
	}
	.div3{
		height:320px;
		border:5px solid grey;
	}
	.div21{
		position:relative;
		width:20%;
		height:100%;
		float:left;
		border:5px solid grey;
	}
	.div22{
		position:relative;
		width:75%;
		height:100%;
		float:right;
		border:5px solid grey;
	}	
</style> 

</head>

<body>
<div class="div1" style="background-color:#00FFFF;">
	
</div>

<!-- login-in, registration -->
<div class="div2">
	<div class="div21"> 
	Login
	</div>
	
	<div class="div22"> 
	</div>
</div>

<!-- about us, picture -->
<div class="div3">	
	<div class="div31">
	<button type="button" onclick="login()">login</button>
	<button type="button" onclick="registration()">registration</button>
	</div>
	
	<div class="div32" id="slideContent">
	</div>
	
</div>

	<script type="text/javascript">
	  
	  window.onload=function(){
		  
	  }
	  
	  function login(){
		  alert("login");
		  var page = "login.php";
		  page = "controller.php";
		  
		  var sc = document.getElementById("slideContent");
		  var str = "";
		  str = str + "<form action='" + page + "' method='post'>";
		  //
		  str = str + "<input type='hidden' name='page' value='login' />";
		  str = str + "name: <input type='text' name='name' /> <br/>";
		  str = str + "Password: <input type='text' name='password' /> <br/>";
		  str = str + "<input type='submit' value='Submit' /> <br/>";
		  str = str + "</form>";
		  sc.innerHTML = str;
	  }
	  
	  function registration(){
		  alert("registration");
		  var page = "registration.php";
		  page = "controller.php";
		  
		  var sc = document.getElementById("slideContent");
		  var str = "";
		  str = str + "<form action='" + page + "' method='post'>";
		  //
		  str = str + "<input type='hidden' name='page' value='registration'/>";
		  str = str + "Name: <input type='text' name='name' /> <br/>";
		  str = str + "Password: <input type='text' name='password' /> <br/>";
		  str = str + "Confirmation: <input type='text' name='confirmation' /> <br/>";
		  //str = str + "Date: <input type='text' name='date' /> <br/>";
		  str = str + "<input type='submit' value='Submit' /> <br/>";
		  str = str + "</form>";
		  sc.innerHTML = str;
	  }  
	</script>

</body>
</html>