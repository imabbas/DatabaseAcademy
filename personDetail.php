<?php
        require "dbutil.php";
        $db = DbUtil::loginConnection();

        $stmt = $db->stmt_init();

        if($stmt->prepare("(select f_name, l_name, email, salary from Teachers where f_name like ?)") or die(mysqli_error($db))) {
                $searchString = '%' . $_POST['first_name'] . '%';

                $stmt->bind_param("s", $searchString);
                $stmt->execute();
                $stmt->store_result();
                if($stmt->num_rows > 0) {
                  $stmt->bind_result($f_name, $l_name, $email, $salary);
                  echo "</br>";
                  echo "Results";
                  echo "<table border=1; width=450><th>Name</th><th>Email</th><th>Salary</th>\n";
                  while($stmt->fetch()) {
                          echo "<tr><td class='item'>$f_name $l_name</td><td>$email</td><td>$salary</td></tr>";
                  }
                  echo "</table>";
                  $stmt->close();
                } else{
                    $meme = $db->stmt_init();
                    if($meme->prepare("(select f_name, l_name, email, gpa, classes_taken from Students where f_name like ?)") or die(mysqli_error($db))) {
                            $searchString = '%' . $_POST['first_name'] . '%';

                            $meme->bind_param("s", $searchString);
                            $meme->execute();
                            $meme->store_result();
                            if($meme->num_rows > 0) {
                              $meme->bind_result($f_name, $l_name, $email, $gpa, $classes);
                              $string = strval($gpa);
                              echo "</br>";
                              echo "Results";
                              echo "<table border=1; width=450><th>Name</th><th>Email</th><th>GPA</th><th>Classes Taken</th>\n";
                              while($meme->fetch()) {
                                      echo "<tr><td class='item'>$f_name $l_name</td><td>$email</td><td>$string</td><td>$classes</td></tr>";
                              }
                              echo "</table>";
                              $meme->close();
                            }
                    }
                  }
        }

        $db->close();
?>
