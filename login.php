
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="css/login.css">


<div class="container">
  <div class="row">
    <div class="Absolute-Center is-Responsive">
      <div id="logo-container">
        <a id="logo-text" href="index.php" >DatabaseAcademy</a>
      </div>
      <div class="col-sm-12 col-md-10 col-md-offset-1">
        <!-- PROCESS SIGN IN -->
        <form method="post" action="processSignIn.php" id="loginForm">
          <div class="form-group input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
            <!-- email -->
            <input class="form-control" type="text" name='email' placeholder="email"/>
          </div>
          <div class="form-group input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
            <!-- password -->
            <input class="form-control" type="password" name='password' placeholder="password"/>
          </div>
          <div class="form-group">
            <?php $reasons = array ("email/pass" => "That email/password combination is not in our database, please try again");
                        if (isset($_GET["valid"])) {
                          echo $reasons[$_GET["reason"]];
                        }
            ?>

             <input class="btn btn-primary btn-block" type="submit" name="submit" value="Submit">
          </div>

        </form>
      </div>
    </div>
  </div>
</div>


</div>
