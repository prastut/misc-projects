<?php require_once("functions.php");?>
<?php
 require_once("session.php");
unset($_SESSION['regn']); 
session_destroy(); 
redirect_to('index.php');
 ?>