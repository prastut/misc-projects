<?php 
$host="localhost";
$username="root";
$password="cambuzz";
$db_name="123456";
$con=mysqli_connect("$host", "$username", "$password","marathon");
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$email=$_POST['email'];


if ($result=mysqli_query($con,"SELECT * FROM registered_participants WHERE email ='".$email."'"))
  {
  
  echo "<html><body><center>";

  print '<img src="images/vitlogo.png" alt="Logo" />';
  print '<img src="images/logo.png" alt="Logo" />';
 

  echo "<h2><u>Your Registration Details </u></h2>";

  while ($row=mysqli_fetch_row($result))
    {
   		echo "<br>Name: ".$row[1];
   		echo "<br>Email: ".$row[2];
   		echo "<br>Mobile Number: ".$row[3];
   		echo "<br>City: ".$row[4];
   		echo "<br>College: ".$row[5];
   		echo "<br>Shirt Size: ".$row[6]."<br>";
		echo "<br>UTR Transaction ID: ".$row[7]."<br>";
    }

    print '<br><br><input type="button" value="Print Form" onclick="window.print()" />';
     echo "</body></html>";
  // Free result set
  mysqli_free_result($result);
}
mysqli_close($con);


?>

