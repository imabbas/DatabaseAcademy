<?php
 $con = new mysqli('stardock.cs.virginia.edu', 'CS4750asg8bz', 'spring2018', 'CS4750asg8bz');
 // Check connection
 if (mysqli_connect_errno())
 {
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
 }
 // Form the SQL query (an INSERT query)
 $sql="INSERT INTO Students (f_name, l_name, email, gpa, password)
 VALUES
 ('$_POST[f_name]','$_POST[l_name]','$_POST[email]','$_POST[gpa]','$_POST[password]')";

 if (!mysqli_query($con,$sql))
 {
 die(header("location:insertPerson.php?valid0=true&reason=failure"));
 //die('Error: ' . mysqli_error($con));
 }
 header("location:insertPerson.php?valid1=true&reason=success");
 mysqli_close($con);
?> 
