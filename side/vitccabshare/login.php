<?php require_once("session.php");?>
<?php require_once("connection.php");?>
<?php require_once("functions.php");?>
<?php
	$Err="";
	//include 'connection.php';
	//$n1=$r1=$m1=$e1="";
	if($_SERVER['REQUEST_METHOD']=='POST')
	{

		if(isset($_POST['password1'])&&isset($_POST['regn1'])&&!empty($_POST['password1'])&&!empty($_POST['regn1']))
		{
			$r=$_POST['regn1'];
			$r1= mysqli_real_escape_string($dbc,$r);
			$p=$_POST['password1'];
			$q1=mysqli_query($dbc,"SELECT * FROM users WHERE registrationno='{$r1}' LIMIT 1");
			$q = mysqli_fetch_array($q1);
			if($q)
			{
				if($q['password']==$p)
				{
					$_SESSION['regn']=$q['registrationno'];
					redirect_to('cab.php');
				}
				else
				{
					$Err="Incorrect Password";
				}
			}
			else
			{
				$Err="Registration Number not found";
				$_POST['regn1']="";
			}
			
		}
		else
		{
			echo "please complete the form";
		}
	}
	else
	{
		echo "no form submitted";
	}
?>
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
<form action="login.php" method="post">
<p>Enter Your Registration Number <input type="text" name="regn1" value="<?php echo isset($_POST['regn1'])?$_POST['regn1']:""; ?>"></p><br />
<p>Enter Your Password <input type="password" name="password1"><?php echo $Err;?></p>
<br /><br /><br />
<p><input type="submit" name="submit1" value="login"></p>
</form>
<br />
<br />
<br />
<br />
<br />
<br />
<p><a href="signup.php">Signup</a></p>
</body>
</html>