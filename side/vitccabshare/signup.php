<?php require_once("session.php");?>
<?php require_once("functions.php");?>
<?php //require_once("connection.php");?>
<?php
	$nameErr = $regErr =$emailErr= $passwordErr=$mobileErr = "";
	include 'connection.php';
	//$n1=$r1=$m1=$e1="";
	if($_SERVER['REQUEST_METHOD']=='POST')
	{
		if(isset($_POST['name'])&&isset($_POST['regn'])&&isset($_POST['mobile'])&&isset($_POST['email'])&&isset($_POST['password'])&&isset($_POST['cpassword'])&&!empty($_POST['name'])&&!empty($_POST['regn'])&&!empty($_POST['mobile'])&&!empty($_POST['cpassword'])&&!empty($_POST['password'])&&!empty($_POST['email']))
		{
			//echo "form completed";
			$n=$_POST['name'];
			$r=$_POST['regn'];
			$e=$_POST['email'];
			$m=$_POST['mobile'];
			if (!preg_match("/^[a-zA-Z ]*$/",$n)) 
			{
                   $nameErr = "Only letters and white space allowed"; 
                   $_POST['name']="";
            }
           
			$r1= mysqli_real_escape_string($dbc,$r);
			$q=$q1=$q2="";
			$q=mysqli_query($dbc,"SELECT * FROM users WHERE registrationno='{$r1}'");
			$q = mysqli_fetch_array($q);
            if($q)
            	$regErr="The given registration number is already registered";

            $e1= mysqli_real_escape_string($dbc,$e);
			$q1=mysqli_query($dbc,"SELECT * FROM users WHERE email='{$e1}'");
			$q1 = mysqli_fetch_array($q1);
            if($q1)
            	$emailErr="The given email id  is already registered";


            $m1= mysqli_real_escape_string($dbc,$m);
			$q2=mysqli_query($dbc,"SELECT * FROM users WHERE mobileno='{$m1}'");
			$q2 = mysqli_fetch_array($q2);
            if($q2)
            	$mobileErr="The given mobile number is already registered";



            if (!preg_match("/^[789][0-9]{9}$/",$m)) 
			{
                   $mobileErr = "Invalid Mobile Number Format"; 
                  $_POST['mobile']="";
            }
            
            if (!filter_var($e, FILTER_VALIDATE_EMAIL)) 
            {
  				$emailErr = "Invalid email format"; 
  				$_POST['email']="";
			}
			
            $p=$_POST['password'];
            $cp=$_POST['cpassword'];
            if($p!=$cp)
            {
            	$passwordErr="Password Does Not match.";
            }

            $var=$r;
 			$var=strtolower($var);
			$var1=substr($var,2,5);
			$var2=substr($var,5,9);
		    if(((preg_match("/bce/",$var1))||(preg_match("/bme/",$var1))||(preg_match("/bee/",$var1))||(preg_match("/bec/",$var1))||(preg_match("/bcl/",$var1)))&&(intval($var)<"16"&&intval($var)>"10")&&(intval($var2)<"1300"&&intval($var2)>"999"))
		    	{
		    		$regErr.="";
		    		
		    	}
		    else
 				{
 					$regErr="Invalid Registration Number Format";
 					$_POST['regn']="";
 				}
 				$em="";
 			if($nameErr==""&&$mobileErr==""&&$regErr==""&&$passwordErr=="")
 			{
				mysqli_query($dbc,"INSERT INTO users(name,registrationno,email,mobileno,password) VALUES('{$n}','{$r}','{$e}','{$m}','{$p}')");
				//$_SESSION['name']=$n;
				//redirect_to('cab.php');
			    echo "done";
			    echo mysqli_affected_rows($dbc);
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
<head><title>Cab Share</title></head>
<body>
	<form method="post" action="signup.php">
	<br />
	<br />
	Name&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="name" maxlength="50" value="<?php echo isset($_POST['name'])?$_POST['name']:""; ?>">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $nameErr;?><br /><br />
	Registration Number&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="regn" maxlength="9" value="<?php echo isset($_POST['regn'])?$_POST['regn']:""; ?>">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $regErr;?><br /><br />
	Email&nbsp;&nbsp;&nbsp;&nbsp;<input type="email" name="email" maxlength="50" value="<?php echo isset($_POST['email'])?$_POST['email']:""; ?>">&nbsp;&nbsp;&nbsp;&nbsp;<br /><br />
	Mobile Number&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="mobile" maxlength="10" value="<?php echo isset($_POST['mobile'])?$_POST['mobile']:""; ?>">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $mobileErr;?><br /><br />
	Password&nbsp;&nbsp;&nbsp;&nbsp;<input type="password" name="password" maxlength="20">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $passwordErr;?><br /><br />
	Confirm Password&nbsp;&nbsp;&nbsp;&nbsp;<input type="password" name="cpassword" maxlength="20">&nbsp;&nbsp;&nbsp;&nbsp;
	 
	<br /><br />
	<br /><br /><input type="submit" name="button" value="submit">
	
	</form>

	
</body>
</html>