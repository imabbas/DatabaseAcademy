
<?php
        require "dbutil.php";
        $db = DbUtil::loginConnection();

        $stmt = $db->stmt_init();

        if($stmt->prepare("select a.club_name, a.description, b.f_name, b.l_name FROM (select Club.club_name, Club.description, Sponsors_club.teacher_email from Club JOIN Sponsors_club ON Club.club_name = Sponsors_club.club_name) as a JOIN Teachers as b on a.teacher_email = b.email WHERE a.club_name like ?") or die(mysqli_error($db))) {
                $searchString = '%' . $_GET['searchField'] . '%';
                $stmt->bind_param("s", $searchString);
                $stmt->execute();
                $stmt->bind_result($club_name, $desc, $f_name, $l_name);
                echo "<table border=1; width=700><th>Club Name</th><th>Description</th><th>Sponsor</th>\n";
                while($stmt->fetch()) {
                        echo "<tr><td>$club_name</td><td>$desc</td><td>$f_name $l_name</td></tr>";
                }
                echo "</table>";
        
                $stmt->close();
        }
        
        $db->close();
?> 
