<?php require_once("session.php"); include 'connection.php';?>

<!DOCTYPE html>
<html>
<head>
	<title>Cab Share</title>
	
	<style type="text/css">
		a
		{
			text-decoration: none;
			padding-left:25px;
			
		}
		p
		{
			margin-left: 520px;
		}
	</style>
</head>
<body>
<?php 
if(!isset($_SESSION['regn']))
{
	echo '<p><a href="login.php">Login!</a>         <a href="signup.php">Signup</a></p>';
}
else
{
	echo "<h1>welcome</h1><form action='logout.php' method='post'><input type='submit' name='button' value='logout'></form>";
}
?>

<br />
<br />
<br />
<?php
if(isset($_SESSION['regn']))
{
	echo '<p><a href="settings.php">Account Settings</a></p>';
}
?>
<br />
<br />
<br />
<?php
if(isset($_SESSION['regn']))
{
	echo '<p><a href="request.php">Feed Settings</a></p>';
}
?>
<br />
<br />
<br />
<?php
if(isset($_SESSION['regn']))
{
			$register=$_SESSION['regn'];
			$register= mysqli_real_escape_string($dbc,$register);
	        $query2=mysqli_query($dbc,"SELECT request,request_no,buddy FROM users WHERE registrationno='$register'");
	        $query2=mysqli_fetch_array($query2);
			$count=$query2['request_no'];
			if($count>0)
				echo $count." new notifications"."<br />";
			else
				echo "Notification<br />";
			$temp=$query2['request'];
			$request =unserialize($temp);
			$count=0;
			mysqli_query($dbc,"UPDATE users SET request_no='$count' WHERE registrationno='$register'");
			if (is_array($request) || is_object($request))
 			{
				foreach ($request as $value)
				{
					
						$r= mysqli_real_escape_string($dbc,$value);
						$query1=mysqli_query($dbc,"SELECT name FROM users WHERE registrationno='$r'");
						$query1=mysqli_fetch_array($query1);
						$para='p'.$value;
						echo "<p id='$para'>".$query1['name']." ( ".$value." )"." has sent you a buddy request.<br /></p>";
						$str1="accept".$r;
						$str2="delete".$r;
						$name=$query1['name'];
						//echo "<form action='index.php' method='post'><input type='text' name='regno' style='display:none;'value='$value'><input type='submit' name='accept' value='Accept'></form>"."       "."<input type='text' name='regno' style='display:none;'value='$value'><form action='index.php' method='post'><input type='submit' name='delete' value='Delete Request'></form><br />";
						echo "<form class='button1'><input type='text' style='display:none;' value='$name' id='$r'><input type='text' class='text' style='display:none' value='$r'><input id='$str1' type='submit' value='Accept Request'/></form><form class='button2'><input type='text' class='text' style='display:none' value='$r'><input id='$str2' type='submit' value='Delete Request'/></form>";
				}
		    }

		    mysqli_query($dbc,"UPDATE users SET request_no='$count' WHERE registrationno='$register'");

		    /*if($_SERVER['REQUEST_METHOD']=='POST')
 			{
 				if(isset($_POST['accept']))
 				{
 					$buddy =unserialize($query2['buddy']);
 					$count=count($buddy);
					$buddy[$count+1]=$_POST['regno'];
					$key=array_search($_POST['regno'], $request);
					unset($request[$key]);
					var_dump($request);
					$buddy =serialize($buddy);
					$request =serialize($request);
					$buddy= mysqli_real_escape_string($dbc,$buddy);
					$request= mysqli_real_escape_string($dbc,$request);
 					mysqli_query($dbc,"UPDATE users SET request='$request',buddy='$buddy' WHERE registrationno='$register'");
 					



 					$r1=$_POST['regno'];
					$r1= mysqli_real_escape_string($dbc,$r1);
					$query1=mysqli_query($dbc,"SELECT request_sent,buddy,name FROM users WHERE registrationno='$r1'");
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

 					
 				}
 				if(isset($_POST['delete']))
 				{
					$key=array_search($_POST['regno'], $request);
					unset($request[$key]);
					var_dump($request);
					$request =serialize($request);
					$request= mysqli_real_escape_string($dbc,$request);
 					mysqli_query($dbc,"UPDATE users SET request='$request' WHERE registrationno='$register'");
 					



 					$r1=$_POST['regno'];
					$r1= mysqli_real_escape_string($dbc,$r1);
					$query1=mysqli_query($dbc,"SELECT request_sent,buddy FROM users WHERE registrationno='$r1'");
					$query1=mysqli_fetch_array($query1);
					$request_sent=unserialize($query1['request_sent']);
					$key=array_search($register, $request_sent);
					unset($request_sent[$key]);
					var_dump($request_sent);
					$request_sent =serialize($request_sent);
					$request_sent= mysqli_real_escape_string($dbc,$request_sent);
 					mysqli_query($dbc,"UPDATE users SET request_sent='$request_sent' WHERE registrationno='$r1'");
 					echo "delete<br />";
 				}
 			}*/
}

?>
<br />
<br />
<br />
<p><a href="cab.php">Enter The News Feed</a></p>
<br />
<br />
<br />
<p><a href="request.php">Delete</a></p>






<script  src="HTTP://code.jquery.com/jquery-1.9.1.min.js"></script>
	
	<script type="text/javascript">
		
		
		$(document).ready(function(){
			
		
			$('.button1').on('submit',function()
			{
				alert('hello');
				var text=$(this).children(".text").val();
				var name=$("#"+text).val();
				
					$("#accept"+text).hide();
					$("#delete"+text).hide();
					$('#p'+text).text('You and '+name+' are now travel buddies.');
					$.post("request_accept.php",{'register1':text},function(){});
					
				return false;
				
			});



			$('.button2').on('submit',function()
			{
				var text=$(this).children(".text").val();
				var name=$("#"+text).val();
				
					$("#accept"+text).hide();
					$("#delete"+text).hide();
					$('#p'+text).text('Request Deleted');
					$.post("request_reject.php",{'register1':text},function(){});
					
				return false;
				
			});

		});
		
	</script>
</body>
</html>