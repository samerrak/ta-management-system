<?php
if ($_POST)
{
    $url = $_POST["url"];
    $name = $_POST["name"];
    $file = fopen("../../CSV/TAadmin/TACohort.csv", "r"); //read information from TACohort.csv
    $TA = [];
    $courses = [];
    while (!feof($file))
    {

        $line = fgets($file);
        if (!empty($line))
        {
            $separated = explode(",", $line);
            #info that changes per course:
            $term = $separated[0];
            $course = $separated[13];
            if ($term == "Winter 2022")
            { //print the current courses this TA is teaching
                if (array_key_exists($separated[1], $TA))
                {
                    array_push($TA[$separated[1]], $course);
                }
                else
                {
                    $TA[$separated[1]] = [$course];
                }

            }
        }

    }
    $allcourses = "";

    $x = 0;
    foreach ($TA as $key => $value)
    {
        if ($key == $name)
        {
            $x = 1;
        }
    }
    if ($x == 1)
    {
        foreach ($TA[$name] as $courses)
        {
            $allcourses = $allcourses . $courses . ",";
        }
    }
    else
    {
        fclose($file);
        header("Location:" . $url . "&Page=searchTA&Notfound=0");
    }
    if ($x == 1)
    {
        fclose($file);
        header("Location:" . $url . "&Page=searchTA&Name=" . $name . "&Courses=" . $allcourses);
    }

}
?>
