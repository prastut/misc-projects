<?php
				

					include "session.php";
					include "connection.php";
					$register1=$_POST['register1'];

					$register=$_SESSION['regn'];
					$register= mysqli_real_escape_string($dbc,$register);
	       		    $query2=mysqli_query($dbc,"SELECT request FROM users WHERE registrationno='$register'");
	        		$query2=mysqli_fetch_array($query2);
	        		$temp=$query2['request'];
					$request =unserialize($temp);

					$key=array_search($register1, $request);
					unset($request[$key]);
					var_dump($request);
					$request =serialize($request);
					$request= mysqli_real_escape_string($dbc,$request);
 					mysqli_query($dbc,"UPDATE users SET request='$request' WHERE registrationno='$register'");
 					



 					$r1=$register1;
					$r1= mysqli_real_escape_string($dbc,$r1);
					$query1=mysqli_query($dbc,"SELECT request_sent FROM users WHERE registrationno='$r1'");
					$query1=mysqli_fetch_array($query1);
					$request_sent=unserialize($query1['request_sent']);
					$key=array_search($register, $request_sent);
					unset($request_sent[$key]);
					var_dump($request_sent);
					$request_sent =serialize($request_sent);
					$request_sent= mysqli_real_escape_string($dbc,$request_sent);
 					mysqli_query($dbc,"UPDATE users SET request_sent='$request_sent' WHERE registrationno='$r1'");
 					
?>