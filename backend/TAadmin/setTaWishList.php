<?php 

    $course = $_POST["course"];
    $taName = $_POST["taName"];
    $id = $_POST["id"];
    $user= $_POST["user"];
    $csvWish = "../../CSV/TAadmin/TAwishlist.csv";
    $csvCourse = "../../CSV/courses/courses.csv";

    $arr = explode(",", $course);

    echo $arr[0];
    

    if (($fp = fopen($csvCourse, "r")) !== FALSE) {
        while (($data = fgetcsv($fp, 1000, ",")) !== FALSE) {
                if($data[0] == $arr[0]) {
                    $result=$data;
                }
        }
        fclose($fp);
    } else {
        header("Location: ../../frontend/" . $user . ".html?user=" . $id . "&Page=taMan&error=2");
    }


    if (($fp = fopen($csvWish, "a+")) !== FALSE) {
        $subArr = explode("_", $arr[0]);
        $line = array($subArr[0] . " " . $subArr[1], $arr[1] , $result[2], $taName);
        fputcsv($fp, $line);
        fclose($fp);

        header("Location: ../../frontend/" . $user . ".html?user=" . $id . "&Page=taMan");
                  
        exit(0);
    } else {
        header("Location: ../../frontend/" . $user . ".html?user=" . $id . "&Page=taMan&error=2");
        exit(0);
    }

?>