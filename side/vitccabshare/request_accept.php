<?php
	
	include "session.php";
	include "connection.php";
	$register1=$_POST['register1'];

					$register=$_SESSION['regn'];
					$register= mysqli_real_escape_string($dbc,$register);
	       		    $query2=mysqli_query($dbc,"SELECT request,buddy FROM users WHERE registrationno='$register'");
	        		$query2=mysqli_fetch_array($query2);
	        		$temp=$query2['request'];
					$request =unserialize($temp);


	    			$buddy =unserialize($query2['buddy']);
 					$count=count($buddy);
					$buddy[$count+1]=$register1;
					$key=array_search($register1, $request);
					unset($request[$key]);
					var_dump($request);
					$buddy =serialize($buddy);
					$request =serialize($request);
					$buddy= mysqli_real_escape_string($dbc,$buddy);
					$request= mysqli_real_escape_string($dbc,$request);
 					mysqli_query($dbc,"UPDATE users SET request='$request',buddy='$buddy' WHERE registrationno='$register'");
 					



 					
					$r1= mysqli_real_escape_string($dbc,$register1);
					$query1=mysqli_query($dbc,"SELECT request_sent,buddy FROM users WHERE registrationno='$r1'");
					$query1=mysqli_fetch_array($query1);

					$buddy=unserialize($query1['buddy']);
 					$count=count($buddy);
					$buddy[$count+1]=$register;
					$request_sent=unserialize($query1['request_sent']);
					$key=array_search($register, $request_sent);
					unset($request_sent[$key]);
					var_dump($request_sent);
					$buddy =serialize($buddy);
					$request_sent =serialize($request_sent);
					$buddy= mysqli_real_escape_string($dbc,$buddy);
					$request_sent= mysqli_real_escape_string($dbc,$request_sent);
 					mysqli_query($dbc,"UPDATE users SET request_sent='$request_sent',buddy='$buddy' WHERE registrationno='$r1'");

?>