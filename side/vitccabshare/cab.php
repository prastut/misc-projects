<?php require_once("session.php");?>
<?php require_once("functions.php");?>
<?php
	if(!isset($_SESSION['regn']))
		redirect_to('login.php');
	else
	{
		echo "<h1>welcome</h1><form action='logout.php' method='post'><input type='submit' name='button' value='logout'></form>";
		 $r=$_SESSION['regn'];
	}

	$Err ="";
	include 'connection.php';
	if($_SERVER['REQUEST_METHOD']=='POST')
	{
		if(isset($_POST['ftime'])&&isset($_POST['date'])&&isset($_POST['travel'])&&isset($_POST['comments'])&&!empty($_POST['ftime'])&&!empty($_POST['date'])&&!empty($_POST['travel'])&&!empty($_POST['comments']))
		{
			//echo "form completed";
			//$n=$_POST['name'];
			//$r=$_POST['regn'];
			//$m=$_POST['mobile'];
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
			$d=$_POST['date'];
			$ft=$_POST['ftime'];
			
			$c=$_POST['comments'];
			
            $r1= mysqli_real_escape_string($dbc,$r);
			$q=mysqli_query($dbc,"SELECT * FROM travel WHERE registrationno='{$r1}'");
			$q = mysqli_fetch_array($q);
            if($q)
            	$Err="Your account already has one feed.You can edit them or delete it to make new.";
           
            //$r=$_SESSION['regn'];
 			if($Err=="")
 			{
			  mysqli_query($dbc,"INSERT INTO travel(registrationno,airport,train,ftime,date1,comments) VALUES('{$r}','{$a}','{$t}','{$ft}','{$d}','{$c}')");
			  echo mysqli_affected_rows($dbc);
 			  echo "done";

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

<html>
	<head>
		<title>Cab Share</title>
		
	</head>
<body>
	<form method="post" action="cab.php">
	<br />
	<br />
	<!--Name&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="name" maxlength="50">&nbsp;&nbsp;&nbsp;&nbsp;<?php  $nameErr;?><br /><br />
	Registration Number&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="regn" maxlength="9">&nbsp;&nbsp;&nbsp;&nbsp;<?php  $regErr;?><br /><br />
	Mobile Number&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="mobile" maxlength="10">&nbsp;&nbsp;&nbsp;&nbsp;<?php  $mobileErr;?><br /><br />
	-->
	<?php  echo $Err;?>
	<input type="radio" name="travel" value="airport" checked>Airport<br /><br />
	<input type="radio" name="travel" value="train">Railway Station<br /><br/>
    Date<input type="date" name="date" id="date" min="<?php date_default_timezone_set('Asia/Calcutta'); echo date('d-m-Y\TH:i:s'); ?>" value="<?php echo isset($_POST['date'])?$_POST['date']:""; ?>" required/>
	<br /><br/>Time<input type="time" name="ftime" value="<?php echo isset($_POST['ftime'])?$_POST['ftime']:""; ?>"><br /><br/>
	
	<br /><br />Comments <br /><textarea name="comments" rows="10" cols="50" maxlength="80" ></textarea>

	<br /><br /><input type="submit" name="button" value="submit">
	</form>

	<br />
	<br />
	<br />
	Railway Station
	<br />
	<iframe src="train.php" width="1000" height="200"></iframe>
	<br />
	<br />
	<br />
	Airport
	<br />
	<iframe src="airport.php" width="1000" height="200"></iframe>
</body>
</html>