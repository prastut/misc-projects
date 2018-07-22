<?php
include "session.php";
include "connection.php";
	$register1=$_POST['register1'];
	


			$register=$_SESSION['regn'];
			$register= mysqli_real_escape_string($dbc,$register);
			$query1=mysqli_query($dbc,"SELECT request_sent FROM users WHERE registrationno='$register'");
			$query1=mysqli_fetch_array($query1);
			$request_sent =unserialize($query1['request_sent']);
			$count=count($request_sent);
			$request_sent[$count+1]=$register1;
			print_r($request_sent);
			$request_sent =serialize($request_sent);
		    mysqli_query($dbc,"UPDATE users SET request_sent='$request_sent' WHERE registrationno='$register'");


		    
			$query2=mysqli_query($dbc,"SELECT request,request_no FROM users WHERE registrationno='$register1'");
			$query2=mysqli_fetch_array($query2);
			$query2['request_no']++;
			$request =unserialize($query2['request']);
			$count=count($request);
			$request[$count+1]=$register;
			print_r($request);
			$request =serialize($request);
			$temp=$query2['request_no'];
		    mysqli_query($dbc,"UPDATE users SET request='$request',request_no='$temp' WHERE registrationno='$register1'");
?>