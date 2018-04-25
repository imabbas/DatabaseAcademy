

<?php
        require "dbutil.php";
        $db = DbUtil::loginConnection();

        $stmt = $db->stmt_init();

        if($stmt->prepare("select class_name, subject, credits from Class where class_name like ?") or die(mysqli_error($db))) {
                $searchString = '%' . $_GET['searchField'] . '%';
                $stmt->bind_param("s", $searchString);
                $stmt->execute();
                $stmt->bind_result($class_name, $subject, $credits);
                echo "<table border=1; width=450><th>Class Name</th><th>Subject</th><th><Credits></th>\n";
                while($stmt->fetch()) {
                        echo "<tr><td>$class_name</td><td>$subject</td><td>$credits</td></tr>";
                }
                echo "</table>";
        
                $stmt->close();
        }
        
        $db->close();
?> 
