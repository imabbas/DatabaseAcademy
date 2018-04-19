<?php
         require "dbutil.php";
         $db = DbUtil::loginConnection();

         $stmt = $db->stmt_init();

        if($stmt->prepare("(select f_name, l_name from Parent where f_name like ? or l_name like ?) UNION (select f_name, l_name from Teachers where f_name like ? or l_name like ?) UNION (select f_name, l_name from Students where f_name like ? or l_name like ?)") or die(mysqli_error($db))) {
                $searchString = '%' . $_GET['searchField'] . '%';
                $stmt->bind_param(s, $searchString);
                $stmt->execute();
                $stmt->bind_result($f_name, $l_name);
                echo "<table border=1><th>First Name</th><th>Last Name</th>\n";
                while($stmt->fetch()) {
                        echo "<tr><td>$f_name</td><td>$l_name</td></tr>";
                }
                echo "</table>";
        
                $stmt->close();
        }
        
        $db->close();
?> 
