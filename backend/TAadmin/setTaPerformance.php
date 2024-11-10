<?php 

    $course = $_POST["course"];
    $taName = $_POST["taName"];
    $note = $_POST["note"];
    $user= $_POST["user"];
    
    $csv = "../../CSV/TAadmin/TAperformancelog.csv";

    if (($fp = fopen($csv, "a+")) !== FALSE) {
        
        $arr = explode(",", $course);
        $subArr = explode("_", $arr[0]);
        $line = array($subArr[0] . " " . $subArr[1] , $arr[1], $taName,  $note);
        fputcsv($fp, $line);
        fclose($fp);

        header("Location: ../../frontend/" . $user . ".html?user=" . $id . "&Page=taMan");
                  
        exit(0);
    } else {
        header("Location: ../../frontend/" . $user . ".html?user=" . $id . "&Page=taMan&error=2");
        exit(0);
    }

?>