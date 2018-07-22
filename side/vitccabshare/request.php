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
		if(isset($_POST['pass'])&&isset($_POST['travel'])&&!empty($_POST['pass'])&&!empty($_POST['travel']))
		{
			$r1= mysqli_real_escape_string($dbc,$r);
			$p=$_POST['pass'];
			if($_POST['travel']=='airport')
			{
				$t=0;
				$a=1;
			}
			else
			{
				$t=1;
				$a=0;
			}
			$q=mysqli_query($dbc,"SELECT password FROM users WHERE registrationno='$r1'");
			$q=mysqli_fetch_array($q);
			if($q)
			{
				if($q['password']==$p)
				{
					mysqli_query($dbc,"UPDATE travel SET train='$t',airport='$a' WHERE registrationno='$r1'");
					echo "Destination Updated";
				}
			}
		}
		if(isset($_POST['date'])&&isset($_POST['passd'])&&!empty($_POST['date'])&&!empty($_POST['passd']))
		{
			$r1= mysqli_real_escape_string($dbc,$r);
			$p=$_POST['passd'];
			$d=$_POST['date'];
			
			$q=mysqli_query($dbc,"SELECT password FROM users WHERE registrationno='$r1'");
			$q=mysqli_fetch_array($q);
			if($q)
			{
				if($q['password']==$p)
				{
					mysqli_query($dbc,"UPDATE travel SET date1='$d' WHERE registrationno='$r1'");
					echo "Date updated";
				}
			}
		}
		if(isset($_POST['time'])&&isset($_POST['passt'])&&!empty($_POST['time'])&&!empty($_POST['passt']))
		{
			$r1= mysqli_real_escape_string($dbc,$r);
			$p=$_POST['passt'];
			$t=$_POST['time'];

		
			
			$q=mysqli_query($dbc,"SELECT password FROM users WHERE registrationno='$r1'");
			$q=mysqli_fetch_array($q);
			if($q)
			{
				if($q['password']==$p)
				{
					mysqli_query($dbc,"UPDATE travel SET time='$t' WHERE registrationno='$r1'");
					echo "Time updated";
				}
			}
		}
		if(isset($_POST['comments'])&&isset($_POST['passc'])&&!empty($_POST['comments'])&&!empty($_POST['passc']))
		{
			$r1= mysqli_real_escape_string($dbc,$r);
			$p=$_POST['passc'];
			$c=$_POST['comments'];

			$q=mysqli_query($dbc,"SELECT password FROM users WHERE registrationno='$r1'");
			$q=mysqli_fetch_array($q);
			if($q)
			{
				if($q['password']==$p)
				{
					mysqli_query($dbc,"UPDATE travel SET comments='$c' WHERE registrationno='$r1'");
					echo "Comments updated";
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


<p>Change Destination</p><br />
<div>
	<form action="settings.php" method="post">
		<input type="radio" name="travel" value="airport" checked>Airport<br />
	    <input type="radio" name="travel" value="train">Railway Station<br />
	    Password<input type="password" name="pass"><br />
		<input type="submit" name="submit1" value="submit"><br />
	</form>
</div>
<br /><br /><br />
<p>Change Date</p>
<br />
<div>
	<form action="settings.php" method="post">
		Enter Date<input type="date" name="date" id="date" min="<?php date_default_timezone_set('Asia/Calcutta'); echo date('d-m-Y\TH:i:s'); ?>" required/><br />
		Password<input type="password" name="passd"><br />
		<input type="submit" name="submit2" value="submit"><br />
	</form>
</div>
<br /><br /><br />
<p>Change Time</p>
<br />
<div>
	<form action="settings.php" method="post">
		Enter Time<input type="time" name="time"><br />
	    Password<input type="password" name="passt"><br />
	    <input type="submit" name="submit3" value="submit"><br />
		
	</form>
</div>
<br /><br /><br />
<p>Change comments</p>
<br />
<div>
	<form action="settings.php" method="post">
		Enter new Comments <br /><textarea name="comments" rows="10" cols="50" maxlength="80" ></textarea><br />
	    Password<input type="password" name="passc"><br />
		<input type="submit" name="submit4" value="submit"><br />
	</form>
</div>
<br /><br /><br />
<p>Delete Feed</p>
<br />
<div>
	
</div>
</body>
</html>