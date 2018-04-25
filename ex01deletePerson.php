<?php
        require "dbutil.php";
        $db = DbUtil::loginConnection();

        $stmt = $db->stmt_init();

        if($stmt->prepare("delete from Students where f_name = ? AND l_name = ?") or die(mysqli_error($db))) {
                $searchString = $_GET['searchField'];
                $searchString2 = $_GET['searchField2'];
                $stmt->bind_param("ss", $searchString, $searchString2);
                $stmt->execute();
                $stmt->bind_result($success);
                while($stmt->fetch()) {
                        echo "Deleted $searchString $searchString2 from the Database: $success";
                }

                $stmt->close();
        }

        $db->close();
?>
