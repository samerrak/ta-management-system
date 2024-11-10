<?php

$function = $_POST["function"];

if ($function = "rateaTA")
{
    $url = $_POST["url"];
    $TAfirst = $_POST["TAfirst"];
    $TAlast = $_POST["TAlast"];
    $course = $_POST["course"];
    $term = $_POST["term"];
    $score = $_POST["score"];
    $comment = $_POST["comment"];
    $values = $TAfirst . " " . $TAlast . "," . $course . "," .  $term . "," .  $score . "," . $comment. ",". "\n";
    $csv = fopen("../../CSV/TAmanager/TAscore.csv","a+" );
    $cs2 ="../../CSV/login/TA_login.csv";
    $cs3 = "../../CSV/courses/courses.csv";
    $z = 0;

    if (($open = fopen($cs3, "r")) !== FALSE) {
        while (($data = fgetcsv($open, 1000, ",")) !== FALSE) {
            if ($data[1] == $course) {
                $z++;
            }
        }
        fclose($open);
    }


    if ($z > 1)
        $z = 1;


    if (($open2 = fopen($cs2, "r")) !== FALSE) {
        while (($data2 = fgetcsv($open2, 1000, ",")) !== FALSE) {
            if ($data2[2] == $TAfirst && $data2[3] == $TAlast) {
                $z++;
            }
        }
        fclose($open2);
    }



    if ($z >= 2) {
        fwrite($csv, $values);
        fclose($csv);
        echo $url;
        echo $TAlast;
        header("Location:" . $url . "&Page=rateTA");
    }
    else
        header("Location:" . $url . "?error=2&us");






}
?>



