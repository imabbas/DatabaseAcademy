<?php
// Always start this first

$db_user = "CS4750asg8bz";
$db_pass = "spring2018";
$db_host = "stardock.cs.virginia.edu"; // DB Host
$db_name = "CS4750asg8bz"; // DB Schema

require "dbutil.php";
$db = DbUtil::loginConnection();

session_start();

if ( ! empty( $_POST ) ) {
  
    if ( isset( $_POST['email'] ) && isset( $_POST['password'] ) ) {

        $stmt = $db->stmt_init();

        if($stmt->prepare("(select id from Students where password = ? and email = ?) UNION (select id from Teachers where password = ? and email = ?) UNION (select id from Parent where password = ? and email = ?)") or die(mysqli_error($db))) {
                $stmt->bind_param("ssssss", $_POST['password'], $_POST['email'], $_POST['password'], $_POST['email'], $_POST['password'], $_POST['email']);
                $stmt->execute();
                echo($stmt->num_rows);
                $stmt->bind_result($user_type);
                $count = 0;
                while($stmt->fetch()) {
                  $count++;
                }
                if ($count > 0){
                  $_SESSION['user_type'] = $user_type;
                  if($_SESSION['user_type'] == "1"){
                    $_SESSION['type_name'] = "Student";
                  }
                  else if ($_SESSION['user_type'] == "2"){
                    $_SESSION['type_name'] = "Teacher";
                  }
                  else {
                    $_SESSION['type_name'] = "Parent";
                  }
                  $_SESSION['user_id'] = $_POST['email'];
                  $_SESSION['loggedin'] = "yes";
                  echo("logged in");
                  header('location:index.php');
                }
                else{
                  echo("login failed");
                  die(header("location:login.php?valid=true&reason=email/pass"));
                }
                
                $stmt->close();
        }
        
     
      }
    }

?>
