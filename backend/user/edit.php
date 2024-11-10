<?php

    $first = $_POST["firstName"];
    $last = $_POST["lastName"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $id = $_POST["studentId"];
    $callerId= $_POST["id"];
    $courses = $_POST["courses"];
    $user = $_POST["user"];

    parseCourses();

    if ($user == "sysop")
        $csv = "../../CSV/login/SYSOP_login.csv";
    else if ($user == "prof")
        $csv = "../../CSV/login/PROF_login.csv";
    else if ($user == "admin")
        $csv = "../../CSV/login/ADMIN_login.csv";
    else if ($user == "ta")
        $csv = "../../CSV/login/TA_login.csv";
    else if ($user == "student")
        $csv = "../../CSV/login/STU_login.csv";
    else {
        header("Location: ../../frontend/sysop.html?error=2&user=" . $callerId . "&Page=userMan" );
        exit(0);
    }

    $path = "../../CSV/login/";

    if (($fp = fopen($csv,'r')) !== FALSE) {
        $temp_table = fopen( $path . 'table_temp.csv','w');

        while (($data = fgetcsv($fp, 1000)) !== FALSE){
            if($data[0] == $email){ 
                continue;
            }
            fputcsv($temp_table,$data);
        }

        fclose($fp);
        fclose($temp_table);
        rename($path . "table_temp.csv", $csv);

        chmod($csv, 0777);
    } else {
        header("Location: ../../frontend/sysop.html?error=2&user=" . $callerId . "&Page=userMan" );
        exit(0);
    }

    if (($fp = fopen($csv, "r")) !== FALSE) {
        while (($data = fgetcsv($fp, 1000, ",")) !== FALSE)
        {
            if($data[0] == $email || $data[4] == $id) {
                header("Location: ../../frontend/sysop.html?error=1&user=" . $callerId . "&Page=userMan" );
                fclose($fp);
                exit(0);
            }
        }
        fclose($fp);
    } else {
        header("Location: ../../frontend/sysop.html?error=2&user=" . $callerId . "&Page=userMan" );
        exit(0);
    }

    if (($fp = fopen($csv, "a")) !== FALSE) {
        $line = array($email, $password, $first, $last,  $id, $courses);
        parseCourses();
        fputcsv($fp, $line);
        fclose($fp);
        header("Location: ../../frontend/sysop.html?user=" . $callerId . "&Page=userMan" );
        exit(0);
    } else {
        header("Location: ../../frontend/sysop.html?error=2&user=" . $callerId . "&Page=userMan" );
        exit(0);
    }

    function parseCourses() {
        $user = $_POST["user"];
        $courses = $_POST["courses"];
        $coursefile = "../../CSV/courses/courses.csv";
        $callerId= $_POST["id"];
    
    
        if (($hp = fopen($coursefile, "r")) !== FALSE) { //parse courses.csv
            $array = preg_split ("/\,/", $courses);
            while (($coursedata = fgetcsv($hp, 1000, ",")) !== FALSE) { //line by line
                for ($i = 0; $i < count($array); $i++) {
                    if($array[$i] == $coursedata[1]) {
                        array_splice($array, $i, 1);
                    }
                }
            }
            fclose($hp);
            if(count($array) !== 0) {
                $id=
                header("Location: ../../frontend/sysop.html?error=1&user=" . $callerId . "&Page=userMan" );
                exit(0);
            }
    
        } else {
            header("Location: ../../frontend/sysop.html?error=2&user=" . $callerId . "&Page=userMan" );
            exit(0);
        }
    }
?>