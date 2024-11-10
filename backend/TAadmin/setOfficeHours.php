<?php 

    $course = $_POST["course"];
    $id = $_POST["id"];
    $dayOfWeek = $_POST["dayOfWeek"];
    $from = $_POST["timeOHF"];
    $to = $_POST["timeOHT"];
    $role = $_POST["role"];
    $location = $_POST["location"];
    $user= $_POST["user"];
    
    $csv = "../../CSV/TAadmin/officeHours.csv";

    if (($fp = fopen($csv, "a")) !== FALSE) {
        
        $arr = explode(",", $course);
        $line = array($arr[0], $arr[1], $id, $dayOfWeek,  $from, $to, $role, $location, $user);
        fputcsv($fp, $line);
        fclose($fp);

        header("Location: ../../frontend/" . $user . ".html?user=" . $id . "&Page=taMan");
            
        exit(0);
    } else {
        header("Location: ../../frontend/" . $user . ".html?user=" . $id . "&Page=taMan&error=2");
        exit(0);
    }

?>