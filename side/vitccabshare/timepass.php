<?php
include("session.php");
include("connection.php");
//$_SESSION['regn1']="";
$r=mysqli_query($dbc,"SELECT * FROM travel ORDER BY date1,ftime ASC");
$xml='<table1>';
while($row = mysqli_fetch_array($r))
{
	
	
	if($row['train']=='1'&&$row['registrationno']!=$_SESSION['regn'])
	{
		
		$r1=$row['registrationno'];
		$r1= mysqli_real_escape_string($dbc,$r1);
		$r2=mysqli_query($dbc,"SELECT name,request,request_sent FROM users WHERE registrationno='$r1'");
		$r2=mysqli_fetch_array($r2);
		$date = date_create($row['date1']);
		$date=date_format($date, 'd-m-Y');
		$xml.='<database>'.'<registrationno>'.$row['registrationno'].'</registrationno>'.'<name>'.$r2['name'].'</name>'.'<date>'.$date.'</date>'.'<time>'.$row['ftime'].'</time>'.'<comments>'.$row['comments'].'</comments>'.'</database>'.'\n';
	/*$r1=$row['registrationno'];
	$r1= mysqli_real_escape_string($dbc,$r1);
	$r2=mysqli_query($dbc,"SELECT name,request,request_sent FROM users WHERE registrationno='$r1'");
	$r2=mysqli_fetch_array($r2);
	$n=$r2['name'];
	echo "<tr>";
	echo "<td>".$n."</td>";
	echo "<td>".$row['registrationno']."</td>";
	//echo "<td>".$row['mobileno']."</td>";
	$date = date_create($row['date1']);
	echo "<td>".date_format($date, 'd-m-Y')."</td>";
	echo "<td>".$row['ftime']."</td>";
	echo "<td>".$row['comments']."</td>";
	$val="Send Buddy Request"; 

	$regis=$_SESSION['regn'];
	$flag1=0;
	$flag2=0;
	
	
	$name=$row['registrationno'];
	echo "<td><form><button id='$k' value='$name'>Send Buddy Request</button></form></td>";
	echo "</tr>";*/

	
		   
	
    }
}

$xml.='</table1>';
echo $xml;

	/*if($_SERVER['REQUEST_METHOD']=='POST')
	{
			echo "hello";
			
	        $register=$_SESSION['regn'];
			$register= mysqli_real_escape_string($dbc,$register);
			$query1=mysqli_query($dbc,"SELECT request_sent FROM users WHERE registrationno='$register'");
			$query1=mysqli_fetch_array($query1);
			$request_sent =unserialize($query1['request_sent']);
			$count=count($request_sent);
			$request_sent[$count+1]=$_POST['regno'];
			print_r($request_sent);
			$request_sent =serialize($request_sent);
		    mysqli_query($dbc,"UPDATE users SET request_sent='$request_sent' WHERE registrationno='$register'");


		    $regn1=$_POST['regno'];
			$query2=mysqli_query($dbc,"SELECT request,request_no FROM users WHERE registrationno='$regn1'");
			$query2=mysqli_fetch_array($query2);
			$query2['request_no']++;
			$request =unserialize($query2['request']);
			$count=count($request);
			$request[$count+1]=$register;
			print_r($request);
			$request =serialize($request);
			$temp=$query2['request_no'];
		    mysqli_query($dbc,"UPDATE users SET request='$request',request_no='$temp' WHERE registrationno='$regn1'");
	}		    
	
		   

mysqli_close($dbc);*/
?>


