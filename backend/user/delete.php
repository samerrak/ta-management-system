<!-- STATUS=0: EVERUTHING IS FINE -->
<!-- STATUS=1: ERROR OPENING THE FILES -->
<?php
    $id = $_POST["id"];
    $email = $_POST["email"];
    $user = $_POST["user"];

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
        header("Location: ../../frontend/sysop.html?error=2&user=" . $id . "&Page=userMan" );
        exit(0);
    }

    header("Location: ../../frontend/sysop.html??user=" . $id . "&Page=userMan");

?>