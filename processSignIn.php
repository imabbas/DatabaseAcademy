<?php include 'dbconnect.php';?>

<?php


session_start();
if(isset($_POST['submit']))
{
 $email=$_POST['email'];
 $password=$_POST['password'];
 
   $checkEmail =  $connect->query("SELECT email from Students WHERE email = '$email' and password = '$password'");
   if ($checkEmail->num_rows > 0)
   {
    $_SESSION['login']='confirmed';
    echo 'Log in Success'
    header('location:index.html');
   }
   else
   {
    echo 'Failed to Log In'
    die(header("location:signIn.php?valid=true&reason=email/pass"));
   }
}



?>