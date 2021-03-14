<?php 
$servername = "localhost";
$username = "root";
$password = "1234";
$DB = "bookMgt";
$tablename = "";
//
$current_date = date('Ymd');
if (empty($_POST['page'])) {
	echo "<script>alert('".$current_date."');</script>";
	include("login.php");
	
	
}else{		
	require('Model.php');
	
	$page = $_POST['page'];
	if($page == "login"){
		echo "<script>alert('login')</script>";
		$tablename = "user";
		$n1 = -1;
		$n2 = $_POST['name'];
		$n3 = $_POST['password'];	
		//check
		$conn = connectDB($servername, $username, $password);
		
		if(user_select1DB($conn, $tablename, $n3,$n3)){			
			session_start();
			$_SESSION["name"] = $n2;
			$_SESSION["password"] = $n3;
			//get the id
			$n1 = user_select2DB($conn, $tablename, $n1,$n2);
			//
			$_SESSION["id"] = $n1;
			closeDB($conn);
			
			echo "<script>alert('login')</script>";
			include('mainpage.php');
		}else{
			closeDB($conn);
			echo "<script>alert('name or password is wrong')</script>";
			include("login.php");
		}
		
		//echo "".$n1.", ".$n2;
	}else if($page == "registration"){
		
		$tablename = "user";
		$n1 = $_POST['name'];
		$n2 = $_POST['password'];
		$n3 = $_POST['confirmation'];
		
		if($n2 == $n3){
			$conn = connectDB($servername, $username, $password);
			user_insertDB($conn, $tablename, $n1,$n2);
			closeDB($conn);
			
			echo "<script>alert('registration')</script>";
		}else{
			echo "<script>alert('confirmation is wrong')</script>";
		}
		
		//echo "".$n1.", ".$n2.", ".$n3;
		include('login.php');
	}else if($page == "showbooks"){
		$tablename = "book";		
		$n1 = $_POST['id'];
		//connect DB, book table for all table, readbook for read book
		$conn = connectDB($servername, $username, $password);
		$data = book_selectDB($conn, $tablename, $n1);
		closeDB($conn);		
		echo json_encode($data);
	}else if($page == "book"){		
		//info
		$n1 = $_SESSION["id"];
		$n2 = $_POST['name'];		
		$n3 = $_POST['bookid'];
		
		//get book details
		$tablename = "book";
		$conn = connectDB($servername, $username, $password);
		$data = book_selectoneDB($conn, $tablename, $n3);
		//get comments
		$data['comment'] = comment_selectDB($conn, $tablename, $n3);
		closeDB($conn);
		
		echo json_encode($data);
	}else if($page == "addbook"){
		$n1 = $_POST['isbn'];
		$n2 = $_POST['title'];
		$n3 = $_POST['id'];
		//$n2 = $_POST['author'];		
		//$n4 = $_POST['author'];
		
		$imgname = $_FILES['img']['name'];
		$tmp = $_FILES['img']['tmp_name'];
		//define('ROOT',dirname(__FILE__).'/');
		$root = "C:/my_software/apache_place/working_place/htdocs/bookMgt/";
		$filepath = $root.'img/'.$n2."_".$n3."_".$imgname;
		
		$n4 = $filepath;
		if(move_uploaded_file($tmp,$filepath)){
			echo "<script>alert('yes')</script>";
			//write to DB
			$conn = connectDB($servername, $username, $password);
			$tablename = "book";
			book_insertDB($conn, $tablename, $n1,$n2,$n3,$n4);
			closeDB($conn);				
		}else{
			echo "<script>alert('no')</script>";
		}		
		
		echo "<script>alert('$n1, $n2, $n3, $filepath')</script>";
		include('mainpage.php');
	}else if($page == "collection"){
		$tablename = "book";
		$n1 = $_POST['id'];
		
		$conn = connectDB($servername, $username, $password);
		$data = colbook_selectDB($conn, $tablename, $n1);
		closeDB($conn);	
		
		echo json_encode($data);
	}else if($page == "addcomment"){
		//echo "<script>alert('hello')</script>";
		$n1 = $_POST['author'];
		$n2 = $_POST['bookid'];
		$n3 = $_POST['comment'];
		
		//write into DB
		$tablename = "comment";
		$conn = connectDB($servername, $username, $password);
		comment_insertDB($conn, $tablename, $n1,$n2,$n3);
		closeDB($conn);	
		
		echo json_encode(1);
	}else if($page == "addcollection"){
		//echo "<script>alert('hello')</script>";
		$n1 = $_POST['author'];
		$n2 = $_POST['bookid'];
		
		//write into DB
		$tablename = "colbook";
		$conn = connectDB($servername, $username, $password);
		colbook_insertDB($conn, $tablename, $n1,$n2);
		closeDB($conn);	
		
		echo json_encode(2);
	}else if($page == "modifybook"){
		$n1 = $_POST['isbn'];
		$n2 = $_POST['title'];
		$n3 = $_POST['id'];
		//$n4 = $_POST['author'];
		
		$imgname = $_FILES['img']['name'];
		$tmp = $_FILES['img']['tmp_name'];
		//define('ROOT',dirname(__FILE__).'/');
		$root = "C:/my_software/apache_place/working_place/htdocs/bookMgt/";
		$filepath = $root.'img/'.$n2."_".$n3."_".$imgname;
		
		$n4 = $filepath;
		if(move_uploaded_file($tmp,$filepath)){
			echo "<script>alert('yes')</script>";
			//write to DB
			$conn = connectDB($servername, $username, $password);
			$tablename = "book";
			book_updateDB($conn, $tablename, $n1,$n2,$n3,$n4);
			closeDB($conn);			
		}else{
			echo "<script>alert('no')</script>";
		}
		
		echo "<script>alert('$n1, $n2, $n3, $filepath')</script>";
		include('mainpage.php');
	}else if($page == "mark"){
		//echo "<script>alert('hello')</script>";
		$n1 = $_POST['author'];
		$n2 = $_POST['bookid'];		
		
		//write into DB
		$tablename = "readbook";
		$conn = connectDB($servername, $username, $password);
		readbook_insertDB($conn, $tablename, $n1,$n2,1);
		closeDB($conn);	
		
		echo json_encode(3);
	}else{
		
		echo "<script>alert('name or password is wrong, please login');</script>";
		include("login.php");
	}
	
}


?>