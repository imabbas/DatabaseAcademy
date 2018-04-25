
<?php

require "dbutil.php";
$db = DbUtil::loginConnection();

  //connect to database
  $connection = mysqli_connect("CS", "user", "password", "db", "port");

  //run the store proc
  $result = mysqli_query($db,
     "CALL recalc_GPA") or die("Query fail: " . mysqli_error());

  while ($row = mysqli_fetch_array($result)){
      echo $row[0] . " - " . + $row[1];
  }

?>
