<?php
	//error_reporting( E_ALL&~E_NOTICE );
	session_start();
	//
	$n1 = $_SESSION["id"];
	$n2 = $_SESSION["name"];
	
	$bookid = $_GET["bookid"];
	//$author = "germany";
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
	book detail<br/>
	hello, <?php echo $n1;?>
	</div>	
	<div class="div22"> 
		<div style="float: left; height:90%; width:30%;font-size:30px;margin-left:20%;" align="center">
			
		</div>
	
		<div style="float: right; height:100%; width:30%;">
				<?php 
					if($n1 == $author){
						echo "<button type='button' onclick='modifyinfo()'>modify info</button>";
					}
				?>
				
				<!-- 
				<button type="button" onclick="addcoment()">add comment</button>
				-->
				<button type="button" onclick="addcol()">add collection</button>
				<button type="button" onclick="mark()">mark read</button>
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
	  var page = "book";
	  var id = "<?php echo $n1;?>";
	  var bookid = "<?php echo $bookid;?>";
	  //alert(name + ", ");
			$.ajax({
				url:'controller.php',
				data:{"page":page, "bookid":bookid},
				dataType:'JSON',
				type:'post',
				success:function(data){
					//sdata = data;
					//
					var title = data['title'][0];
					var author = data['author'][0];
					var image = data['image'][0];
					var mark = data['mark'][0];
					var comment = data['comment'];
					//alert(title[0] + ", " + title[1]);
					var str = "";
					str = str + bookLayout(title, author, bookid, image, mark);
					str = str + "<br/>comments: <br/>";
					var len = comment.length;
					//alert(len);
					var i = 0;
					
					//
					str = str + "<input type='text' name='comment' id='mycomment'>";
					str = str + "<button onclick='addcoment()' >comment</button>";
					str = str + "<br/>";
					while(i < len){	
						str = str + commentLayout(comment[i]);
						i++;
					}
					
					var bookdiv = document.getElementById("books");
					bookdiv.innerHTML = str;
					
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
  
  function commentLayout(comment){
	  var str = "";
	  str = str + comment;
	  str = str + "<br/>";
	  return str;	  
  }
  
  function modifyinfo(){
	  alert('modify');
	  var url = "controller.php";
	  var str = "";
	  str = str + "<form action='" + url + "' method='post' enctype='multipart/form-data'>";
	  str = str + "<p>title<input type='text' name='title' /></p>";
	  //
	  //str = str + "<p>author<input type='text' name='author' /></p>";
	  str = str + "<p>isbn<input type='text' name='isbn' /></p>";
	  str = str + "<input id='img01' type='file' accept='image/png,image/jpeg' name='img'/>";
	  str = str + "<input type='hidden' name='page' value='modifybook'/>";
	  str = str + "<input type='submit' value='submit' />";
	  str = str + "</form>";
	  
	  var bookdiv = document.getElementById("books");
	  bookdiv.innerHTML = str;	  
  }
  
  function addcoment(){	  
	  //var bookdiv = document.getElementById("books");
	  //bookdiv.innerHTML = str;
	  var inputValue = document.getElementById("mycomment").value;

	  var page = "addcomment";
	  var id = "<?php echo $n1;?>";
	  var bookid = "<?php echo $bookid;?>";
	  alert(name + ", " + bookid);
			$.ajax({
				url:'controller.php',
				data:{"page":page, "bookid":bookid, "author":id, "comment":inputValue},
				dataType:'JSON',
				type:'post',
				success:function(data){
					alert(data);
				},
				error:function(response){
					alert("error");
				}
			});	  
	  
	  showbooks();

  }
  
  function addcol(){
	  alert('col');
	  var page = "addcollection";
	  var id = "<?php echo $n1;?>";
	  var bookid = "<?php echo $bookid;?>";
	  alert(id + ", " + bookid);
			$.ajax({
				url:'controller.php',
				data:{"page":page, "bookid":bookid, "author":id},
				dataType:'JSON',
				type:'post',
				success:function(data){
					alert(data);
				},
				error:function(response){
					alert("error");
				}
			});	  
  }
  
  function mark(){
	  alert('mark');
	  var page = "mark";
	  var id = "<?php echo $n1;?>";
	  var bookid = "<?php echo $bookid;?>";
	  alert(id + ", " + bookid);
			$.ajax({
				url:'controller.php',
				data:{"page":page, "bookid":bookid, "author":id},
				dataType:'JSON',
				type:'post',
				success:function(data){
					alert(data);
				},
				error:function(response){
					alert("error");
				}
			});
  }
  
  window.onload=showbooks();
</script>

</body>
</html>