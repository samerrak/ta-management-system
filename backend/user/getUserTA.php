<?php 
    $tafile = "../../CSV/login/TA_login.csv";
    $coursefile = "../../CSV/courses/courses.csv";
    $user = $_POST['user'];

    $result = array();

    if (($hp = fopen($tafile, "r")) !== FALSE) { 
        while (($taData = fgetcsv($hp, 1000, ",")) !== FALSE) {      
            if($taData[4] == $user) {
                $result = explode(",", $taData[5]);
                break;
            }
        }
    } else {
        echo json_encode("ERROR");
        exit(0);
    }

    $json = array();

    if (($hp = fopen($coursefile, "r")) !== FALSE) { //parse courses.csv
        while (($coursedata = fgetcsv($hp, 1000, ",")) !== FALSE) { //line by line        
            for ($i = 0; $i < count($result); $i++) {
                if($result[$i] == $coursedata[1]) {
                    array_push($json, $coursedata);
                    array_splice($result, $i, 1);
                }
            }
        }
        fclose($hp);
        echo json_encode($json);
        exit(0);

    } else {
        echo json_encode("ERROR");
        exit(0);
    }
?>