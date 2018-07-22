<?php session_start(); 
//include_once $_SERVER['DOCUMENT_ROOT'] . '/hackathon/Register/securimage/securimage.php';

if(isset($_POST["submit"]) && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['mobileno']) && isset($_POST["city"]) && isset($_POST["college"]) && isset($_POST["shirtsize"]) && isset($_POST["tid"]))
{


$host="localhost";
$username="root";
$password="cambuzz";
$db_name="marathon";
$con=mysql_connect("$host", "$username", "$password")or die("cannot connect to server"); 
mysql_select_db("$db_name")or die("cannot select DB");



$name=$_POST['name'];
$email=$_POST['email'];
$mobileno=$_POST['mobileno'];
$address=$_POST["city"];
$college=$_POST["college"];
$shirtsize=$_POST["shirtsize"];
$trans=$_POST["tid"];


$sqlrand=mysql_query("SELECT * FROM registered_participants WHERE email ='".$email."'",$con);
$emailcount=mysql_num_rows($sqlrand);



if($emailcount==0){
	/*
do{
$to=$email;

$subject="Your confirmation link here";

$message = '<html><head><style>p{font-size:20px;}</style></head><body>';
$message .= '<a href="http://www.androidamaze.in"><img src="http://androidamaze.in/hackathon/Register/dist/images/post.jpg" alt="posterimage" height="150" width="700"></a><br>';
$message .= '<p>';
$message .= 'Hi <b>'.$name.'</b>,<br>';
$message .= 'Thank you for registering!<br>This is to confirm  your registration for the forthcoming android amaze event.<br>We are happy that you chose to be a part of this intriguing event to set records.<br>';
$message .= 'Your registration details,<br>';
$message .= 'Registration ID: <b>'.$rand_id.'</b><br>';
$message .= 'Password : <b>'.$pass.'</b> <br>';
$message .= 'Please keep this Registration ID and password safely till the completion of the Event.<br><br>';

$message .= "<p>Click <a href='http://www.androidamaze.in/hackathon/Register/verification.php?passkey=$confirm_code'>here</a> to verify your account.</p>";

$message .= 'We request you to constantly check your mail for any updates on the event.We look forward to see you at the event.';

$message .= 'If any queries, mail us at <a href="mailto:androidamaze@vit.ac.in">androidamaze@vit.ac.in</a> and <br>kindly visit our Facebook page-
<a href="https://www.facebook.com/android.amaze">https://www.facebook.com/android.amaze</a><br>';
$message .= '<br>with Regards,<br> ANDROIDAMAZE TEAM<br>';
$message .= '</p>';
$message .= "</body></html>";

$headers = "From: androidamaze@vit.ac.in\r\n";
$headers .= 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8' . "\r\n"; 

$sentmail = mail($to,$subject,$message,$headers);
}while(!$sentmail);
if($sentmail){
//if (filter_var($email, FILTER_VALIDATE_EMAIL)) {  
	*/
$sql="INSERT INTO registered_participants(name, email, mobileno,city,college,shirtsize,tid)VALUES('$name', '$email', '$mobileno','$address','$college','$shirtsize','$trans')";
$result=mysql_query($sql);


echo "<html><body><h2>Successfully Registered<br>You will be redirected in 10 seconds.</h2><br> ";
echo "<h2><u>Your Registration Details:</u> </h2><br>Name: ".$name."<br>Email ID: ".$email."<br>Mobile Number: ".$mobileno."<br>City: ".$address;
echo "<br>College: ".$college."<br>Shirt Size: ".$shirtsize."<br>NEFT UTR Number: ".$trans;
echo "</body></html>";
header("Refresh: 9; 'http://vit.6te.net/Techno/site/print.html'");
//}
}
else {
echo "email already exist Try again!";
}//mail
//if($result)
//{header("Location: success.html");
//}else{header("Location: error.html");}//insert
//}else{echo "email already exist Try again!";header("Location: exist.html");}//email



}

?>