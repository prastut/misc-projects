<?php require_once("session.php");?>
<?php require_once("functions.php");?>
<?php

	if(!isset($_SESSION['regn']))
		redirect_to('index.php');
	else
	{
		echo "<h1>welcome</h1><form action='logout.php' method='post'><input type='submit' name='button' value='logout'></form>";
		 $r=$_SESSION['regn'];
	}

	if($_SERVER['REQUEST_METHOD']=='POST')
	{
		include 'connection.php';
		if(isset($_POST['pass'])&&isset($_POST['npass'])&&isset($_POST['cnpass'])&&!empty($_POST['pass'])&&!empty($_POST['npass'])&&!empty($_POST['cnpass']))
		{
			$r1= mysqli_real_escape_string($dbc,$r);
			$p=$_POST['pass'];
			$np=$_POST['npass'];
			$cnp=$_POST['cnpass'];
			$q=mysqli_query($dbc,"SELECT password FROM users WHERE registrationno='$r1'");
			$q=mysqli_fetch_array($q);
			if($q)
			{
				if($q['password']==$p && $np==$cnp)
				{
					mysqli_query($dbc,"UPDATE users SET password='$np' WHERE registrationno='$r1'");
					echo "Password updated";
				}
			}
		}
		if(isset($_POST['name'])&&isset($_POST['passn'])&&!empty($_POST['name'])&&!empty($_POST['passn']))
		{
			$r1= mysqli_real_escape_string($dbc,$r);
			$p=$_POST['passn'];
			$n=$_POST['name'];
			
			$q=mysqli_query($dbc,"SELECT password FROM users WHERE registrationno='$r1'");
			$q=mysqli_fetch_array($q);
			if($q)
			{
				if($q['password']==$p)
				{
					mysqli_query($dbc,"UPDATE users SET name='$n' WHERE registrationno='$r1'");
					echo "Name updated";
				}
			}
		}
		if(isset($_POST['email'])&&isset($_POST['passe'])&&!empty($_POST['email'])&&!empty($_POST['passe']))
		{
			$r1= mysqli_real_escape_string($dbc,$r);
			$p=$_POST['passe'];
			$e=$_POST['email'];


			$e1= mysqli_real_escape_string($dbc,$e);
			$q1=mysqli_query($dbc,"SELECT * FROM users WHERE email='{$e1}'");
			$q1=mysqli_num_rows($q1);
		
			
			$q=mysqli_query($dbc,"SELECT password FROM users WHERE registrationno='$r1'");
			$q=mysqli_fetch_array($q);
			if($q)
			{
				if($q['password']==$p && $q1==0)
				{
					mysqli_query($dbc,"UPDATE users SET email='$e' WHERE registrationno='$r1'");
					echo "Email updated";
				}
				else
				{
					if($q1!="0")
						echo "email is already registered";
					else
						echo "Incorrect Password";
				}
			}
		}
		if(isset($_POST['mobile'])&&isset($_POST['passm'])&&!empty($_POST['mobile'])&&!empty($_POST['passm']))
		{
			$r1= mysqli_real_escape_string($dbc,$r);
			$p=$_POST['passm'];
			$m=$_POST['mobile'];

			$m1= mysqli_real_escape_string($dbc,$m);
			$q1=mysqli_query($dbc,"SELECT * FROM users WHERE mobileno='{$m1}'");
			$q1=mysqli_num_rows($q1);
		
			
			$q=mysqli_query($dbc,"SELECT password FROM users WHERE registrationno='$r1'");
			$q=mysqli_fetch_array($q);
			if($q)
			{
				if($q['password']==$p && $q1==0)
				{
					mysqli_query($dbc,"UPDATE users SET mobileno='$m' WHERE registrationno='$r1'");
					echo "mobile number updated";
				}
				else
				{
					if($q1!="0")
						echo "mobile is already registered";
					else
						echo "Incorrect Password";
				}
			}
			
		}
	}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Cab Share</title>
</head>
<body>


<p>Change Password</p><br />
<div>
	<form action="settings.php" method="post">
		Enter Current Password<input type="password" name="pass"><br />
		Enter new Password<input type="password" name="npass"><br />
		Confirm new Password<input type="password" name="cnpass"><br />
		<input type="submit" name="submit1" value="submit"><br />
	</form>
</div>
<br /><br /><br />
<p>Change name</p>
<br />
<div>
	<form action="settings.php" method="post">
		Enter new name<input type="text" name="name"><br />
		Password<input type="password" name="passn"><br />
		<input type="submit" name="submit2" value="submit"><br />
	</form>
</div>
<br /><br /><br />
<p>Change email id</p>
<br />
<div>
	<form action="settings.php" method="post">
		Enter new Email ID<input type="text" name="email"><br />
	    Password<input type="password" name="passe"><br />
	    <input type="submit" name="submit3" value="submit"><br />
		
	</form>
</div>
<br /><br /><br />
<p>Change mobile no</p>
<br />
<div>
	<form action="settings.php" method="post">
		Enter new mobile no<input type="text" name="mobile"><br />
	    Password<input type="password" name="passm"><br />
		<input type="submit" name="submit4" value="submit"><br />
	</form>
</div>
<br /><br /><br />
</body>
</html>