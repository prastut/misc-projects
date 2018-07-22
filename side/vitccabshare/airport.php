<?php require_once("session.php");?>
<?php
include("connection.php");
//$_SESSION['regn1']="";
$r=mysqli_query($dbc,"SELECT * FROM travel ORDER BY date1,ftime ASC");
echo "<table>";
while($row = mysqli_fetch_array($r))
{
	
	
	if($row['airport']=='1'&&$row['registrationno']!=$_SESSION['regn'])
	{
		$r1=$row['registrationno'];
		$myarray[]=$r1;
	
	
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
	$reg=$row['registrationno'];
	$val="Send Buddy Request"; 
	$request=unserialize($r2['request']);
	$request_sent=unserialize($r2['request_sent']);
	if (is_array($request))
	{
		
	if (in_array($_SESSION['regn'],$request))
	{
		$val="Delete Request";
	}
    }
	
    if(is_array($request_sent))
    {
	if(in_array($_SESSION['regn'],$request_sent))
	{
		$val="Respond to Request";
	}
	}
	
	
	echo "<td><form class='button'><input type='text' class='text' style='display:none' value='$reg'><input id='$reg' type='submit' value='$val'/></form></td></tr>";
	$regis=$_SESSION['regn'];
}

}
echo "</table>";
	
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
			//loadxml();
			//alert('hello');
			


			
		
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