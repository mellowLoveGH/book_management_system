<?php
	$servername = "localhost";
	$username = "root";
	$password = "1234";
	$DB = "bookMgt";
	$tablename = "user";
	
	error_reporting( E_ALL&~E_NOTICE );
	
	
	 // connect server
	 function connectDB($servername, $username, $password){		 
		$conn = new mysqli($servername, $username, $password);
		if ($conn->connect_error) {
			die("cannot connect server: " . $conn->connect_error);
		}
		$sql = "use ".$DB;
		$conn->query($sql);
		return $conn;
	 }	 
	 
	 //close DB
	 function closeDB($conn){
		 $conn->close();
	 }
	 
	 //user
	 function user_insertDB($conn, $tablename, $n1,$n2){
		$p1 = "name";
		$p2 = "password";
		$sql = "insert into ".$tablename." ($p1, $p2) values ('$n1','$n2');";
		
		if ($conn->query($sql) === TRUE) {
			echo "insert successfully!";
			echo '<br>';
		}else{
			echo "bug";
			echo '<br>';
		}
	 }	
	 //check
	 function user_select1DB($conn, $tablename, $n1,$n2){
		$sql = "SELECT * FROM user where name='".$n1."' and password='".$n2."'";
		$result = $conn->query($sql);
		if ($result->num_rows <= 0) {
			return false;
		}
		return true;
	 }
	 //get id
	 function user_select2DB($conn, $tablename, $n1,$n2){
		$sql = "SELECT * FROM user where name='".$n1."' and password='".$n2."'";
		$result = $conn->query($sql);
		if ($result->num_rows == 1) {
			$row = $result->fetch_assoc();
			
			return $row["id"];
		}
		return -1;
	 }
	 
	 //readbook
	 function readbook_insertDB($conn, $tablename, $n1,$n2,$n3){
		$p1 = "userid";
		$p2 = "bookid";
		$p3 = "mark";
		$sql = "insert into readbook values ($n1,'$n2', $n3)";
		
		if ($conn->query($sql) === TRUE) {
			
		}else{
			
		}
	 }
	 function readbook_checkDB($conn, $tablename, $n1,$n2){
		$sql = "SELECT * FROM readbook where userid=".$n1." and bookid='".$n2."'";
		$result = $conn->query($sql);
		if ($result->num_rows <= 0) {
			return false;
		}
		return true;
	 }
	 function readbook_deleteDB($conn, $tablename, $n1, $n2){
		$sql = "delete FROM ".$tablename." where userid=".$n1." and bookid='".$n2."'";
		if ($conn->query($sql) === TRUE) {
			
		}
	 }	 
	 
	 //book
	 function book_insertDB($conn, $tablename, $n1,$n2,$n3,$n4){
		$p1 = "isbn";
		$p2 = "title";
		$p3 = "authorid";
		$p4 = "img";
		$sql = "insert into book values ('$n1','$n2', $n3, '$n4')";
		
		if ($conn->query($sql) === TRUE) {
			
		}else{
			
		}
	 }	 
	 function book_selectDB($conn, $tablename, $n1){
		$sql = "select * FROM book";
		$result = $conn->query($sql);
		//
		$data = array();
		$data['title'] = array();
		$data['author'] = array();
		$data['isbn'] = array();
		$data['image'] = array();
		$data['mark'] = array();
		
		if ($result->num_rows > 0) {
			$i = 0;
			
			while($row = $result->fetch_assoc()) {
				$data['isbn'][$i] = $row['isbn'];
				$data['title'][$i] = $row['title'];
				$data['author'][$i] = $row['authorid'];				
				$data['image'][$i] = $row['img'];
				if(readbook_checkDB($conn, $tablename, $n1,$row['isbn'])){
					$data['mark'][$i] = 1;				
				}else{
					$data['mark'][$i] = 0;
				}				
				
				$i++;
			}
			
		}
		return $data;
	 }	 
	 function book_selectoneDB($conn, $tablename, $n1){
		$sql = "select * FROM book where isbn='".$n1."' ";
		$result = $conn->query($sql);
		//
		$data = array();
		$data['title'] = array();
		$data['author'] = array();
		$data['isbn'] = array();
		$data['image'] = array();
		$data['mark'] = array();
		$data['comment'] = array();
		
		if ($result->num_rows > 0) {
			$i = 0;
			
			while($row = $result->fetch_assoc()) {
				$data['isbn'][$i] = $row['isbn'];
				$data['title'][$i] = $row['title'];
				$data['author'][$i] = $row['authorid'];				
				$data['image'][$i] = $row['img'];
				if(readbook_checkDB($conn, $tablename, $n1,$row['isbn'])){
					$data['mark'][$i] = 1;				
				}else{
					$data['mark'][$i] = 0;
				}	
				$i++;
			}			
		}
		return $data;
	 }
	 function book_deleteDB($conn, $tablename, $n1){
		$sql = "delete FROM book where isbn='".$n1."'";
		if ($conn->query($sql) === TRUE) {
			
		}
	 }
	 function book_updateDB($conn, $tablename, $n1,$n2,$n3,$n4){
		//book_deleteDB($conn, $tablename, $n1);
		//book_insertDB($conn, $tablename, $n1,$n2,$n3,$n4);
		$p1 = "isbn";
		$p2 = "title";
		$p3 = "authorid";
		$p4 = "img";
		
		$sql = "update book set $p2='".$n2."' where isbn='".$n1."'";
		$conn->query($sql);
		$sql = "update book set $p3=".$n3." where isbn='".$n1."'";
		$conn->query($sql);
		$sql = "update book set $p4='".$n4."' where isbn='".$n1."'";
		$conn->query($sql);
	 }
	 
	 //colbook
	 function colbook_insertDB($conn, $tablename, $n1,$n2){
		$p1 = "userid";
		$p2 = "bookid";
		$sql = "insert into colbook values ($n1,'$n2')";		
		if ($conn->query($sql) === TRUE) {
			
		}else{
			
		}
	 }	 
	 function colbook_selectDB($conn, $tablename, $n1){
		$data = array();
		$data['title'] = array();
		$data['author'] = array();
		$data['isbn'] = array();
		$data['image'] = array();
		$data['mark'] = array();
		
		$sql = "select isbn, title, userid, img from book t1, colbook t2 where t1.isbn = t2.bookid and userid=".$n1;
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			$i = 0;
			
			while($row = $result->fetch_assoc()) {
				$data['isbn'][$i] = $row['isbn'];
				$data['title'][$i] = $row['title'];
				$data['author'][$i] = $row['userid'];				
				$data['image'][$i] = $row['img'];
				if(readbook_checkDB($conn, $tablename, $n1,$row['isbn'])){
					$data['mark'][$i] = 1;				
				}else{
					$data['mark'][$i] = 0;
				}	
				$i++;
			}			
		}
		
		return $data;
	 }
	 function colbook_deleteDB($conn, $tablename, $n1, $n2){
		$sql = "delete FROM colbook where userid=".$n1." and bookid='".$n2."'";
		if ($conn->query($sql) === TRUE) {
			
		}
	 }	 
	 
	 //comment
	 function comment_insertDB($conn, $tablename, $n1,$n2,$n3){
		$p1 = "userid";
		$p2 = "bookid";
		$p3 = "content";
		$sql = "insert into comment values ($n1,'$n2', '$n3');";
		
		if ($conn->query($sql) === TRUE) {
			
		}else{
			
		}
	 }	 
	 function comment_selectDB($conn, $tablename, $n1){
		 $comment = array();
		 //$sql = "select name, content FROM ".$tablename."  where isbn='".$n1."' ";
		 $sql = "select name, content from user t1, comment t2 where t1.id = t2.userid and bookid ='".$n1."'";
		 $result = $conn->query($sql);
		 if ($result->num_rows > 0) {
			$i = 0;
			
			while($row = $result->fetch_assoc()) {
				$comment[$i] = $row['name'] + " : " + $row['content'];
				$i++;
			}			
		 }
		 return $comment;
	 }	 
	 function comment_deleteDB($conn, $tablename, $n1, $n2){
		$sql = "delete FROM comment where userid=".$n1." and bookid='".$n2."'";
		if ($conn->query($sql) === TRUE) {
			
		}
	 }
	 
	 
	 
?>