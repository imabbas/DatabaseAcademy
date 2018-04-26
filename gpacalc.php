<?php
$fn = $_POST['f_name'];
$ln = $_POST['l_name'];
$g = floatval($_POST['grade']);

$con = new mysqli('stardock.cs.virginia.edu', 'CS4750asg8bz', 'spring2018', 'CS4750asg8bz');
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}


$sql="CALL recalc_GPA('$fn', '$ln', $g)";

if (!mysqli_query($con,$sql))
{
  die(header("location:addGrade.php?valid0=true&reason=failure"));
}

else{
  header("location:addGrade.php?valid1=true&reason=success");
}


?>
