<?php
	//error_reporting( E_ALL&~E_NOTICE );
	session_start();
	//
	$n1 = $_SESSION["id"];
	$n2 = $_SESSION["name"];
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>start page</title>
<script src='jquery-1.7.2.min.js'></script>

<style type="text/css"> 
<!-- 
<link rel="stylesheet" type="text/css" href="mainstyle.css">
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
<div class="div1">

</div>

<!-- sign-in, join, fitness -->
<div class="div2">
	<div id="greetid" class="div21"> 
	
	
	</div>	
	<div class="div22"> 
		<div style="float: left; height:90%; width:30%;font-size:30px;margin-left:20%;" align="center">
			
		</div>
	
		<div style="float: right; height:100%; width:30%;">
				<button type="button" onclick="addbook()">add book</button>
				<button type="button" onclick="sortbook()">sort book</button>
				<button type="button" onclick="mycollection()">my collection</button>
		</div>
	</div>
</div>

<!--  -->
<div class="div3">
	<div id="books" style = "width:600;height:300px;overflow-x:auto;overflow-y:auto;float:left;"> 
		
	</div>
</div>


<script type="text/javascript">
	
  function showbooks(){
	  //alert("plan table");
	  var page = "showbooks";
	  var id = "<?php echo $n1;?>";
	  //alert(name + ", ");
			$.ajax({
				url:'controller.php',
				data:{"page":page, "id":id},
				dataType:'JSON',
				type:'post',
				success:function(data){
					//sdata = data;
					//
					//
					var isbn = data['isbn'];
					var title = data['title'];
					var author = data['author'];					
					var image = data['image'];
					var mark = data['mark'];
					//alert(title[0] + ", " + title[1]);
					var str = "";
					var len = title.length;
					//alert(len);
					var i = 0;
					
					while(i < len){						
						str = str + bookLayout(title[i], author[i], isbn[i], image[i], mark[i]);
						i++;
					}
					
					var bookdiv = document.getElementById("books");
					bookdiv.innerHTML = str;
					
					var greetid = document.getElementById("greetid");
					greetid.innerHTML = "Main Page<br/>" + "hello, " + "<?php echo $n1;?>";
					
					//alert(str);
				},
				error:function(response){
					//alert("error");
				}
			});
	  //alert(sdata + ", show table");
  }
  
  function bookLayout(title, author, isbn, image, mark){
	  var str = "";
	  if(mark == 1){
		  str = str + "<a href='book.php?bookid=" + isbn + "'>";
		  str = str + "<div style='width:200px;height:120px;border:solid 3px #00f;float:left;margin:5px 5px 5px 5px;'>";
		  str = str + "title: " + title + "<br/>";
		  str = str + "author: " + author + "<br/>";
		  str = str + "isbn: " + isbn + "<br/>";
		  var img = "<img src='" + image + "' width='60' height='60'>" + "<br/>";		  
		  str = str + img;
		  str = str + "read";
		  str = str + "</div>";
		  str = str + "</a>";
	  }else{
		  str = str + "<a href='book.php?bookid=" + isbn + "'>";
		  str = str + "<div style='width:200px;height:120px;border:solid 3px #f00;float:left;margin:5px 5px 5px 5px;'>";
		  str = str + "title: " + title + "<br/>";
		  str = str + "author: " + author + "<br/>";
		  str = str + "isbn: " + isbn + "<br/>";
		  var img = "<img src='" + image + "' width='60' height='60'>" + "<br/>";		  
		  str = str + img;
		  str = str + "unread";
		  str = str + "</div>";
		  str = str + "</a>";
	  }
	  
	  return str;
  }
  
  
  function addbook(){
	  alert("add");
	  
	  var url = "controller.php";
	  var str = "";
	  str = str + "<form action='" + url + "' method='post' enctype='multipart/form-data'>";
	  str = str + "<p>title<input type='text' name='title' /></p>";
	  //the author id the user who upload it
	  //str = str + "<p>author<input type='text' name='author' /></p>";
	  str = str + "<p>isbn<input type='text' name='isbn' /></p>";
	  str = str + "<input id='img01' type='file' accept='image/png,image/jpeg' name='img'/>";
	  str = str + "<input type='hidden' name='page' value='addbook'/>";
	  str = str + "<input type='submit' value='submit' />";
	  str = str + "</form>";
	  
	  var bookdiv = document.getElementById("books");
	  bookdiv.innerHTML = str;
  }
  
  function bookdetail(){
	  
  }
  
  function sortbook(){
	  alert("sort");
  }
  
  function mycollection(){
	  alert("collection");
	  var page = "collection";
	  var id = "<?php echo $n1;?>";
	  var name = "<?php echo $n2;?>";
	  
	  //alert(name + ", ");
			$.ajax({
				url:'controller.php',
				data:{"page":page, "id":id},
				dataType:'JSON',
				type:'post',
				success:function(data){
					//sdata = data;
					
					var isbn = data['isbn'];
					var title = data['title'];
					var author = data['author'];					
					var image = data['image'];
					var mark = data['mark'];
					//alert(title[0] + ", " + title[1]);
					var str = "";
					var len = title.length;
					//alert(len);
					var i = 0;
					
					while(i < len){						
						str = str + bookLayout(title[i], author[i], isbn[i], image[i], mark[i]);
						i++;
					}
					
					var bookdiv = document.getElementById("books");
					bookdiv.innerHTML = str;
					
					var greetid = document.getElementById("greetid");
					greetid.innerHTML = "Collection Page<br/>" + "hello, " + "<?php echo $n1;?>";
					
					//alert(str);
				},
				error:function(response){
					//alert("error");
				}
			});
	  
  }
  
  function comment(){
	  
  }
  
  window.onload=showbooks();
</script>

</body>
</html>