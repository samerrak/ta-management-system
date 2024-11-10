<?php
if ($_POST)
{
    $url = $_POST["url"];
    $cour = $_POST["cour"];
    $numTA = 0;
    $file = fopen("../../CSV/TAadmin/NumTARequired.csv", "r"); //output the number of TAs still required for this course
    while (!feof($file))
    {

        $line = fgets($file);
        $separated = explode(",", $line);
        if (!empty($line))
        {

            #info that changes per course:
            $course1 = $separated[1];
            $num = $separated[2];
            if ($cour == $course1)
            {
                $numTA = $num;
            }
        }
    }

    fclose($file);

    $file = fopen("../../CSV/TAadmin/TACohort.csv", "r"); //read information from TACohort.csv
    $TA = [];
    $courses = [];
    $allcourses = '';
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
            {

                if (array_key_exists($course, $courses))
                {
                    array_push($courses[$course], $separated[1]);
                }
                else
                {
                    $courses[$course] = [$separated[1]];
                }
            }
        }

    }
    #info that is the same per TA:
    //output all the TA names associated with the course searched
    $x = 0;
    foreach ($courses as $key => $value)
    {
        if ($key == $cour)
        {
            $x = 1;
        }
    }
    if ($x == 1)
    {
        foreach ($courses[$cour] as $names)
        {

            $allcourses = $allcourses . $names . ",";

        }
    }
    else
    {
        fclose($file);
        header("Location:" . $url . "&Page=searchCourse&Notfound=0");
    }
    $numTA = (string)$numTA;
    $numTA = str_replace("\n", "", $numTA);
    if ($x == 1)
    {
        fclose($file);
        header("Location:" . $url . "&Page=searchCourse&Name=" . $cour . "&num=" . $numTA . "&Courses=" . $allcourses);
    }

}
?>
