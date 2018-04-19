<html>
  <head>
    <meta charset="utf-8">
    <script src="js/jquery-1.6.2.min.js" type="text/javascript"></script>
          <script src="js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
    <title>High School Directory</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <link rel="stylesheet" href=css/index.css>
    <link rel="stylesheet" href=css/login.css>

  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="index.html">DatabaseAcademy</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="clubs.html">Clubs</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="courses.html">Courses</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="index.html">People</a>
          </li>
        </ul>
      </div>
      <form class="form-inline">
        <a id="loginButton"class="btn btn-outline-success my-2 my-sm-0" href="login.html">Login</a>
        <a id="registerButton" class="btn btn-outline-success my-2 my-sm-0" href="register.html">Register</a>

      </form>
    </nav>
  </body>
</html>


<?php
        require "dbutil.php";
        $db = DbUtil::loginConnection();

        $stmt = $db->stmt_init();

        if($stmt->prepare("select class_name from Class where class_name like ?") or die(mysqli_error($db))) {
                $searchString = '%' . $_GET['searchField'] . '%';
                $stmt->bind_param("s", $searchString);
                $stmt->execute();
                $stmt->bind_result($f_name, $l_name);
                echo "<table border=1><th>Class Name</th>\n";
                while($stmt->fetch()) {
                        echo "<tr><td>$class_name</td></tr>";
                }
                echo "</table>";
        
                $stmt->close();
        }
        
        $db->close();
?> 
