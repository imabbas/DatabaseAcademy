<?php
// Always start this first

$db_user = "CS4750asg8bz";
$db_pass = "spring2018";
$db_host = "stardock.cs.virginia.edu"; // DB Host
$db_name = "CS4750asg8bz"; // DB Schema

require "dbutil.php";
$db = DbUtil::loginConnection();



session_start();

echo $_POST['email'];

if ( ! empty( $_POST ) ) {
    echo("here first ");
    if ( isset( $_POST['email'] ) && isset( $_POST['password'] ) ) {
        // Getting submitted user data from database

        echo("here second ");
        //$stmt = $db->stmt_init();

        $stmt = $db->stmt_init();

        if($stmt->prepare("(select email from Students where password = ?) UNION (select email from Teachers where password = ?) UNION (select email from Parent where password = ?)") or die(mysqli_error($db))) {
                $stmt->bind_param("sss", $_POST['password'], $_POST['password'], $_POST['password']);
                $stmt->execute();
                //$stmt->bind_result($f_name, $l_name);
                echo($stmt->num_rows);
                $stmt->bind_result($name);
                echo("heres the name :");
                $count = 0;
                while($stmt->fetch()) {
                  $count++;
                  echo "$name";
                }

                if ($count > 0){
                  $_SESSION['user_id'] = $email;
                  echo("logged in");
                  header('location:index.html');
                }
                else{
                  echo("login failed");
                  die(header("location:login.php?valid=true&reason=email/pass"));
                }
                
                $stmt->close();
        }
        
        $db->close();
     
      }
    }

?>
