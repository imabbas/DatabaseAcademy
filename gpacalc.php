<?php
$fn = $_POST['f_name'];
$ln = $_POST['l_name'];
$g = (float)$_POST['grade'];

$con = new mysqli('stardock.cs.virginia.edu', 'CS4750asg8bz', 'spring2018', 'CS4750asg8bz');
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$sql="CALL recalc_GPA($fn, $ln, $g)" or die('could not calculate');
$result = $con -> prepare($sql) or die('could not prepare');
$result->setFetchMode(PDO::FETCH_ASSOC) or die("could not fetch");

while ($values = $result ->fetch())
{
  print "<pre>";
  print_r($values);
}

?>
