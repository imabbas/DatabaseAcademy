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

<!-- JAVASCRIPT STUFF -->
  <script>

  $(document).ready(function() {

    $( "#LastNinput" ).change(function() {

      $.ajax({
        url: 'ex01searchCourses.php',
        data: {searchField: $( "#LastNinput" ).val()},
        success: function(data){
          $('#LastNresult').html(data);
          meme()
        }
      });
    });

  });


  </script>
</head>


<!-- BODY -->
<body background="img/courses.jpg" style="background-size: auto;">
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
            <a class="nav-link" href="addGrade.php">Add Student Grade</a>
          </li>

        <?php
        }
        ?>

        <?php
          session_start();
          if($_SESSION['user_type'] == "1")
          {
          ?>

         <li class="nav-item active">
            <a class="nav-link" href="insertMember.php">Join Club</a>
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
            <font color="white"> You are logged in as a <?php echo $_SESSION['type_name']; ?></font>
            &nbsp;
            &nbsp;
            &nbsp;
            <a href='logOut.php'>Logout</a>"
          <?php
          } else {
            echo "<br/><a href='login.php'>Login</a>";
          }
        ?>
      </form>
    </nav>


    <div class="background">

      <h1 class="text-center" style="margin-top:50px;">Databases Academy Courses</h1>

      <div id="search-bar" style="text-align:center;">
        <input class="form-control-center" id="LastNinput" type="search" size="100" placeholder="Search for students, teachers, and parents" style="width:500px">
      </div>

      </br>
      <div id ="resultWrapper" style="text-align: center;">
        <div id="LastNresult" style="height:100; overflow-y:auto; display: inline-block;"></div>
      </div>
      </br>
      </br>
      </br>
      </br>

    </div>

    <script type="text/javascript">( function(){ window.SIG_EXT = {}; } )()</script></body></html>


  </body>
</html>
