<?php
    $id = $_POST["id"];
    $email = $_POST["email"];
    $user =  $_POST["user"];

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
        header("Location: ../../frontend/sysop.html?error=2&user=" . $id . "&Page=userMan" );
        exit(0);
    }

    if (($open = fopen($csv, "r")) !== FALSE) {
        while (($data = fgetcsv($open, 1000, ",")) !== FALSE) {
            
            if ($data[0] == $email){
                fclose($open);
                header("Location: ../../frontend/sysop.html?user=" . $id . "&Page=userMan&data=" . $data[0] .  "," . $data[1] .  "," . $data[2] .  "," . $data[3] .  "," . $data[4] .  "," . $user .  "," . $data[5]);
                exit(0);             
            }
        }
        header("Location: ../../frontend/sysop.html?error=1&user=" . $id . "&Page=userMan" );
        fclose($open);
    } else
        header("Location: ../../frontend/sysop.html?error=2&user=" . $id . "&Page=userMan" );

?>