

<?php
        require "dbutil.php";
        $db = DbUtil::loginConnection();

        $stmt = $db->stmt_init();

        if($stmt->prepare("Select a.class_name, a.subject, a.credits, b.f_name, b.l_name FROM (select Class.class_name, Class.subject, Class.credits, Teaches_class.teacher_email from Class JOIN Teaches_class ON Class.class_name=Teaches_class.class_name) as a JOIN Teachers as b ON a.teacher_email = b.email WHERE a.class_name like ?;") or die(mysqli_error($db))) {
                $searchString = '%' . $_GET['searchField'] . '%';
                $stmt->bind_param("s", $searchString);
                $stmt->execute();
                $stmt->bind_result($class_name, $subject, $credits, $f_name, $l_name);
                echo "<table border=1; width=900><th>Class Name</th><th>Subject</th><th>Credits</th><th>Teacher Name</th>\n";
                while($stmt->fetch()) {
                        echo "<tr><td>$class_name</td><td>$subject</td><td>$credits</td><td>$f_name $l_name</td></tr>";
                }
                echo "</table>";
        
                $stmt->close();
        }
        
        $db->close();
?> 
