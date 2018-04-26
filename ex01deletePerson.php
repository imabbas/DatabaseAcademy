
<!DOCTYPE html>
<html><head>

<!-- SETUP -->
  <meta charset="utf-8">
    <script src="js/jquery-1.6.2.min.js" type="text/javascript"></script>
  <script src="js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <title>High School Directory</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <link rel="stylesheet" href=css/index.css>

</head>


<!-- BODY -->
<body background="img/home4.jpg" style="background-size: auto;">
<!-- NAV BAR -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="index.php">DatabaseAcademy</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="clubs.php">Clubs</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="courses.php">Courses</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="index.php">People</a>
          </li>
          <?php
          //The form, only displayed on condition
          session_start();
          if($_SESSION['user_type'] == "2")
          {
          ?>

         <li class="nav-item active">
            <a class="nav-link" href="insertPerson.php">Add Students</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="deletePerson.php">Delete Students</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="exportJSON.php">Export Student Info</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="insertGrade.php">Add Grade</a>
          </li>

        <?php
        }
        ?>

        </ul>
      </div>
      <form class="form-inline">
        <?php
          session_start();
          if($_SESSION['loggedin'] == "yes"){
            ?>
            <b> You are logged in as a <?php echo $_SESSION['type_name']; ?></b>
            <a href='logOut.php'>Logout</a>"
          <?php
          } else {
            echo "<br/><a href='login.php'>Login</a>";
          }
        ?>
      </form>
    </nav>


<?php

        // Create connection
        $link = new mysqli('stardock.cs.virginia.edu', 'CS4750asg8bz', 'spring2018', 'CS4750asg8bz');


        //see if exists
        $result = $link->query("SELECT f_name FROM Students where f_name='$_POST[f_name]' AND l_name='$_POST[l_name]' AND email='$_POST[email]' ");
        if($result->num_rows == 0) {
          echo "ERROR: Delete failed because record does not exist in the DB";
          $link->close();
        } 
        // else if it does exit, try to delete
        else {
          // Check connection
          if($link === false){
            die("ERROR: Could not connect. " . mysqli_connect_error());
          } 

          // sql to delete a record
          $sql = "DELETE FROM Students where f_name='$_POST[f_name]' AND l_name='$_POST[l_name]' AND email='$_POST[email]' ";

          if(mysqli_query($link, $sql)){
            echo "Record was deleted successfully.";
          } 
          else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
          }
          mysqli_close($link);
          
        }

?>


  </body>
</html>