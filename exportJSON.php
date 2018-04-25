

<?php  
	
    require "dbutil.php";
    $db = DbUtil::loginConnection();

    $stmt = $db->stmt_init();

    if($stmt->prepare("select email, f_name, l_name, classes_taken from Students") or die(mysqli_error($db))) {
        $stmt->execute();
        $stmt->bind_result($email, $f_name, $l_name, $classes);
        $json_data=array(); //create the array
        while($stmt->fetch()) {
        	$json_array['email']=$email;
			$json_array['f_name']=$f_name;  
		    $json_array['l_name']=$l_name;  
		    $json_array['classes_taken']=$classes;  
		    array_push($json_data,$json_array);  
        }
        $stmt->close();
    }

    $db->close();

	//built in PHP function to encode the data in to JSON format  
	json_encode($json_data);  

    //desired output filename
    $download_file_name = "raw.json";
    
    //control the download using PHP header functions (force binary file download)
    header("Content-Type: application/octet-stream");
    header("Content-Transfer-Encoding: Binary");
    header("Content-disposition: attachment; filename=\"$download_file_name\""); 
    
    //built in PHP function to encode the data in to JSON format
    echo json_encode($json_data);
  
?> 
