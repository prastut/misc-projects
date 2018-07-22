<?php require_once("session.php");?>
<?php
include("connection.php");
//$_SESSION['regn1']="";
$r=mysqli_query($dbc,"SELECT * FROM travel ORDER BY date1,ftime ASC");
$r3=$_SESSION['regn'];
$r3= mysqli_real_escape_string($dbc,$r3);
$query3=mysqli_query($dbc,"SELECT buddy,request,request_sent FROM users WHERE registrationno='$r3'");
$query3=mysqli_fetch_array($query3);
echo "<table>";
while($row = mysqli_fetch_array($r))
{
	
	
	if($row['train']=='1'&&$row['registrationno']!=$_SESSION['regn'])
	{
		$r1=$row['registrationno'];
		$myarray[]=$r1;
	
	
	$r1= mysqli_real_escape_string($dbc,$r1);
	$r2=mysqli_query($dbc,"SELECT name FROM users WHERE registrationno='$r1'");
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
	$reg=$row['registrationno'];
	$val="Send Buddy Request"; 
	$request=unserialize($query3['request']);
	$request_sent=unserialize($query3['request_sent']);
	$buddy=unserialize($query3['buddy']);
	if (is_array($request_sent))
	{
		
	if (in_array($reg,$request_sent))
	{
		$val="Delete Request";
	}
    }
	
    if(is_array($request))
    {
	if(in_array($reg,$request))
	{
		$val="Respond to Request";
	}
	}

	$flag=0;
	 if(is_array($buddy))
    {
	if(in_array($reg,$buddy))
	{
		$flag++;
	}
	}
	
	if($flag==0)
	{
	echo "<td><form class='button'><input type='text' class='text' style='display:none' value='$reg'><input id='$reg' type='submit' value='$val'/></form></td></tr>";
	
	}
	else
	{
		echo "<td>You are buddies</td></tr>";
	}
	$regis=$_SESSION['regn'];
}

}
echo "</table>";
	/*$string1="'/"."/'";
	$string2="'/".$regis."/'";
	echo $r2['request_sent'];
	echo $string1."<br />";
	echo $string2."<br />";
	if (preg_match($string2,$r2['request_sent'])) :
  		{
  			$flag1++;
  			echo "yes1";
  		}
	endif;

	$string3="'/"."/'";
	$string4="'/".$regis."/'";

	echo $string3."<br />";
	echo $string4."<br />";
	if (preg_match($string4,$r2['request'])) :
  		{
  			$flag2++;
  			echo "yes2";
  		}
	endif;
	*//*
	$s1=unserialize($r2['request_sent']);
 if (is_array($s1) || is_object($s1))
 {
	
	foreach($s1 as $value1)
	{
		if($regis==$value1)
			{
				$flag1++;
				break;
			}
	}
 }

	$s2=unserialize($r2['request']);

if (is_array($s2) || is_object($s2))
 {
	foreach ($s2 as $value2)
	{
		if($regis==$value2)
		{
			$flag2++;
			break;
		}

	}
 }
	

	if($flag2!=0)
	{
		$val="Request Sent";
	}
	else if($flag1!=0)
	{
		$val="Respond to the request";
	}
	else
	{
	if(isset($_POST['regno']))
	{
	if($_POST['regno']==$row['registrationno'])
		$val="Request Sent";
	else
		$val="Send Buddy Request";
	}
	}
	$name=$row['registrationno'];
	echo "<td><form><button id='$k' value='$name'>Send Buddy Request</button></form></td>";
	echo "</tr>";

	
		   
	$k++;
    }
}
echo "</table>";


	if($_SERVER['REQUEST_METHOD']=='POST')
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
	/*if($_SERVER['REQUEST_METHOD']=='POST')
	{
			echo "hello";
			
	        $register=$_SESSION['regn'];
			$register= mysqli_real_escape_string($dbc,$register);
			$query1=mysqli_query($dbc,"SELECT request_sent FROM users WHERE registrationno='$register'");
			$query1=mysqli_fetch_array($query1);
			$request_sent =unserialize($query1['request_sent']);
			$count=count($request_sent);
			$request_sent[$count+1]=$_SESSION['regn1'];
			print_r($request_sent);
			$request_sent =serialize($request_sent);
		    mysqli_query($dbc,"UPDATE users SET request_sent='$request_sent' WHERE registrationno='$register'");


		    $regn1=$_SESSION['regn1'];
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

<html>
<head>

<script type='text/javascript'>var register=[];
			var k=0;</script>
<style type='text/css'>
table
{
	border:2px solid black;

}
td
{
	border:2px solid black;
	padding-left: 30px;
	padding-right:30px;
}


</style>
</head>
<body>

    <div id="result"></div>
	<script  src="HTTP://code.jquery.com/jquery-1.9.1.min.js"></script>
	
	<script type="text/javascript">
		
		
		$(document).ready(function(){
			
			


			
		
			$('.button').on('submit',function()
			{
				var text=$(this).children(".text").val();
				
				if($("#"+text).val()=='Send Buddy Request')
				{
					$("#"+text).val("Delete Request");
					$.post("request_sending.php",{'register1':text},function(){});

				}
				else
				{
					$("#"+text).val("Send Buddy Request");
					$.post("request_delete.php",{'register1':text},function(){});
				}
				
				
				return false;
				
			});
			
		});
		/*function loadxml()
		{
			
			$.post('train1.php',function(data){
				k="fuck";
				var str="<table>";
				var count=0;
				$(data).find('database').each(function(){
					var registrationno="";
					var name="";
					var date="";
					var time="";
					var comments="";
					$(this).find('registrationno').each(function(){
						registrationno=$(this).text();
					});
					$(this).find('name').each(function(){
						name=$(this).text();
					});
					$(this).find('date').each(function(){
						date=$(this).text();
					});
					$(this).find('time').each(function(){
						time=$(this).text();
					});
					$(this).find('comments').each(function(){
						comments=$(this).text();
					});
					register.push(registrationno);
					k++;

					//str+='<tr><td>'+name+'</td><td>'+registrationno+'</td><td>'+date+'</td><td>'+time+'</td><td>'+comments+'</td><td>'+
					//"<button class='button' >Send Buddy Request</button>"+'</td></tr>';
					count++;
				
					//alert(register[k-1]);
					
				});
				str+='</table>';
				//alert(register[0]);
				//document.write(str);
				$('#result').html(str);
			});
		}*/
	</script>
</body>
</html>