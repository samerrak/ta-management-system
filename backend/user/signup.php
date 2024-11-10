<!-- STATUS=0: EVERYTHING IS FINE -->
<!-- STATUS=1: ERROR OPENING THE FILES -->
<!-- STATUS=2: USER ALREADY EXISTS -->
<!-- STATUS=2: USER ALREADY EXISTS -->
<?php
$first = $_POST["firstName"];
$last = $_POST["lastName"];
$email = $_POST["email"];
$password = $_POST["password"];
$studentId = $_POST["studentId"];
$courses = $_POST["courses"];
$user = $_POST["user"];
$page = $_POST["page"];


if ($user == "sysop") {
    $csv = "../../CSV/login/SYSOP_login.csv";
    $id = $_POST["userId"];
}
else if ($user == "prof")
    $csv = "../../CSV/login/PROF_login.csv";
else if ($user == "admin")
    $csv = "../../CSV/login/ADMIN_login.csv";
else if ($user == "ta")
    $csv = "../../CSV/login/TA_login.csv";
else if ($user == "student")
    $csv = "../../CSV/login/STU_login.csv";
else {
    if($page == "sysop") {
        $id = $_POST["userId"];
        header("Location: ../../frontend/sysop.html?error=2&user=" . $id . "&Page=userMan" );
    } else {
        header("Location: ../../frontend/register.html?error=2&Page=" . $user);
    }
    exit(0);
}

if (($courses == ""|| $first == "" || $last == "" || $email == "" || $password == "" || $studentId == "")) {
    if($page == "sysop") {
        $id = $_POST["userId"];
        header("Location: ../../frontend/sysop.html?error=1&user=" . $id . "&Page=userMan" );
    } else {
        header("Location: ../../frontend/register.html?error=1&Page=" . $user);
    }
    exit(0);
}



if (($fp = fopen($csv, "r")) !== FALSE) {
    while (($data = fgetcsv($fp, 1000, ",")) !== FALSE)
    {
        if($data[0] == $email || $data[4] == $studentId) {
            if($page == "sysop") {
                $id = $_POST["userId"];
                header("Location: ../../frontend/sysop.html?error=1&user=" . $id . "&Page=userMan" );
            } else {
                header("Location: ../../frontend/register.html?error=1&Page=" . $user);
            }
            fclose($fp);
            exit(0);
        }
    }
    fclose($fp);
} else {
    if($page == "sysop") {
        $id = $_POST["userId"];
        header("Location: ../../frontend/sysop.html?error=2&user=" . $id . "&Page=userMan" );
    } else {
        header("Location: ../../frontend/register.html?error=2&Page=" . $user);
    }
    exit(0);
}

if (($fp = fopen($csv, "a")) !== FALSE) {
    $line = array($email, $password, $first, $last,  $studentId, $courses);
    parseCourses();
    fputcsv($fp, $line);
    fclose($fp);

    if($page == "sysop") {
        $id = $_POST["userId"];
        header("Location: ../../frontend/sysop.html?user=" . $id . "&Page=userMan" );
    } else {
        header("Location: ../../frontend/login.html?Page=" . $user);
    }
    exit(0);
} else {
    if($page == "sysop") {
        $id = $_POST["userId"];
        header("Location: ../../frontend/sysop.html?error=2&user=" . $id . "&Page=userMan" );
    } else {
        header("Location: ../../frontend/register.html?error=2&Page=" . $user);
    }
    exit(0);
}



function parseCourses() {
    $user = $_POST["user"];
    $courses = $_POST["courses"];
    $coursefile = "../../CSV/courses/courses.csv";


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
            $page = $_POST["page"];
            if($page == "sysop") {
                $id = $_POST["userId"];
                header("Location: ../../frontend/sysop.html?error=1&user=" . $id . "&Page=userMan" );
            } else {
                header("Location: ../../frontend/register.html?error=1&Page=" . $user);
            }
            exit(0);
        }

    } else {
        header("Location: ../../frontend/login.html?error=2&Page=" . $user);
        exit(0);
    }
}

?>