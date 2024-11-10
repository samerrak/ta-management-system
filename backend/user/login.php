<?php
function find(){
    $email = $_POST["email"];
    $password = $_POST["password"];
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
        header("Location: ../../frontend/login.html?error=2&Page=" . $user);
        exit(0);
    }

    if (($open = fopen($csv, "r")) !== FALSE) {
       while (($data = fgetcsv($open, 1000, ",")) !== FALSE) {
           if ($data[0] == $email && $data[1] == $password){
                fclose($open);
                if ($user == "sysop") {
                    header("Location: ../../frontend/sysop.html?user=" . $data[4]);
                    exit(0);
                } else if ($user == "prof") {
                    header("Location: ../../frontend/prof.html?user=" . $data[4]);
                    exit(0);
                } else if ($user == "admin") {
                    header("Location: ../../frontend/admin.html?user=" . $data[4]);
                    exit(0);
                } else if ($user == "ta") {
                    header("Location: ../../frontend/ta.html?user=" . $data[4]);
                    exit(0);
                } else if ($user == "student") {
                    header("Location: ../../frontend/student.html?user=" . $data[4]);
                    exit(0);
                } else {
                    header("Location: ../../frontend/login.html?error=2&Page=" . $user);
                    exit(0);
                }  
            }
        }
        header("Location: ../../frontend/login.html?error=1&Page=" . $user);
        fclose($open);
    } else
        header("Location: ../../frontend/login.html?error=2&Page=" . $user);
}

find();

?>