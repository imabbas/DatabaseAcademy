<!DOCTYPE html>
<html><head>

<!-- SETUP -->
  <meta charset="utf-8">
    <script src="js/jquery-1.6.2.min.js" type="text/javascript"></script> 
  <script src="js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
  <title>High School Directory</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <link rel="stylesheet" href=css/index.css>

<!-- JAVASCRIPT STUFF -->
  <script>
  $(document).ready(function() {
    $( "#LastNinput" ).change(function() {
    
      $.ajax({
        url: 'ex01searchPersons.php', 
        data: {searchField: $( "#LastNinput" ).val()},
        success: function(data){
          $('#LastNresult').html(data); 
        
        }
      });
    });
    
  });
  </script>
</head>


<!-- BODY -->
<body>
<!-- NAV BAR -->
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
        <?php 
          session_start();
          if($_SESSION['loggedin'] == "yes"){
            echo "You are logged in as "; 
            echo $_SESSION['user_id'];
            echo "<br/><a href='logOut.php'>Logout</a>";
          } else {
            echo "<br/><a href='login.php'>Login</a>";
          }
        ?>


      </form>
    </nav>

<!-- CAROUSEL STUFF -->
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">

      <div class="form-group col-sm-4 col-sm-offset-4"><h1 class="text-center" style:"position:absolute;">Databases Academy People</h1>
        
        <div class="input-group input-group-lg center-block">
          <!-- SEARCH INPUT -->
          <input class="form-control" id="LastNinput" type="search" size=100 placeholder="Search for students, teachers, and parents">
        </div>

        </br>
        </br>
        </br>
        <!-- RESULTS -->
        <div id="LastNresult"></div>
        
      </div>

      <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
      </ol>

      <div class="carousel-inner">
        <div class="carousel-item active" >
          <img class="d-block w-100" src="img/home2.jpg" alt="First slide" style="">
        </div>
      </div>

      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>

      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>

    </div>

<!-- SCRIPT STUFF -->
<!--     <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js" integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl" crossorigin="anonymous"></script> -->
    <script type="text/javascript">( function(){ window.SIG_EXT = {}; } )()</script></body></html>


  </body>
</html>


