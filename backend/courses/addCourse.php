<?php 
    $id = $_POST["userId"];
    $term = $_POST["term"];
    $month = $_POST["month"];
    $code = $_POST["code"];
    $name = $_POST["name"];

    $csv = "../../CSV/courses/courses.csv";

    $str_arr = explode ("-", $month);
    $time = $term . "_" . $str_arr[0] . "_" . $str_arr[1];

    if (($fp = fopen($csv, "r")) !== FALSE) {
        while (($data = fgetcsv($fp, 1000, ",")) !== FALSE)
        {
            if($data[1] == $code && $data[0] = $time) {
                header("Location: ../../frontend/sysop.html?error=1&user=" . $id . "&Page=addCou" );
                fclose($fp);
                exit(0);
            }
        }
        fclose($fp);
    } else {
        header("Location: ../../frontend/sysop.html?error=2&user=" . $id . "&Page=addCou" );
        exit(0);
    }

    if (($fp = fopen($csv, "a")) !== FALSE) {
        $str_arr = explode ("-", $month);
        $line = array($time, $code, $name);
        fputcsv($fp, $line);
        fclose($fp);
        header("Location: ../../frontend/sysop.html?user=" . $id . "&Page=addCou" );
        fclose($fp);
    } else
    header("Location: ../../frontend/sysop.html?error=2&user=" . $id . "&Page=addCou" );

?>