<?php
        require "dbutil.php";
        $db = DbUtil::loginConnection();

        $stmt = $db->stmt_init();

        if($stmt->prepare("(select f_name, l_name, salary from Teachers where f_name like ?)") or die(mysqli_error($db))) {
                $searchString = '%' . $_POST['first_name'] . '%';

                $stmt->bind_param("s", $searchString);
                $stmt->execute();
                $stmt->bind_result($f_name, $l_name, $salary);
                echo "</br>";
                echo "Results";
                echo "<table border=1; width=450><th>Name</th><th>Salary</th>\n";
                while($stmt->fetch()) {
                        echo "<tr><td class='item'>$f_name $l_name</td><td> $salary</td></tr>";
                }
                echo "</table>";

                $stmt->close();
        }

        $db->close();
?>
