<?php
    $coursefile = "../../CSV/courses/courses.csv";
    $sizecourse = sizeof($courses);

    $result = array();

    if (($hp = fopen($coursefile, "r")) !== FALSE) { 
        while (($coursedata = fgetcsv($hp, 1000, ",")) !== FALSE) {        
            array_push($result, $coursedata);
        }
        fclose($hp);
        echo json_encode($result);
    } else {
        echo "ERROR";
    }

?>