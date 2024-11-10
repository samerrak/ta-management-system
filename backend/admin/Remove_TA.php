<?php
if ($_POST)
{
    $url = $_POST["url"];
    $term = $_POST["term"];
    $cour = $_POST["cour"];
    $name = $_POST["name"];
    $id = $_POST["id"];
    $hours = $_POST["hours"];
    $email = $_POST["email"];
    $file = fopen("../../CSV/login/TA_login.csv", "r") or die("Unable to open file!");
    $TAexists = 0;
    while (!feof($file))
    {

        $line = fgets($file);
        $separated = explode(",", $line);
        if (!empty($line))
        {

            #info that changes per course:
            $fname = $separated[2];
            $lname = $separated[3];
            $fullname = $fname . " " . $lname;
            if ($fullname == $name)
            { //checks if the TA being added is a valid TA
                $TAexists = 1;
            }

        }
    }
    if ($TAexists == 0)
    {
        fclose($file);
        header("Location:" . $url . "&Page=removeTA&Notfound=0");
        exit();

    }

    fclose($file);

    $file = fopen("../../CSV/courses/courses.csv", "r") or die("Unable to open file!");
    $courseexists = 0;
    while (!feof($file))
    {

        $line = fgets($file);
        $separated = explode(",", $line);
        if (!empty($line))
        {

            #info that changes per course:
            $thiscourse = $separated[1];

            if ($thiscourse == $cour)
            { //checks if the course the TA added to exists
                $courseexists = 1;
            }

        }
    }
    if ($courseexists == 0)
    {
        fclose($file);
        header("Location:" . $url . "&Page=removeTA&Notfound=0");
        exit();
    }

    fclose($file);

    $file = fopen("../../CSV/TAadmin/TACohort.csv", "r");
    $temp = fopen("../../CSV/TAadmin/Temp.csv", "w"); //create a new file to rewrite TACohort.csv with the updated information
    

    while (!feof($file))
    {

        $line = fgets($file);
        $separated = explode(",", $line);
        if (!empty($line))
        {

            #info that changes per course:
            $term1 = $separated[0];
            $name1 = $separated[1];
            $course1 = $separated[13];
            if ($term1 == $term && $name1 == $name && $course1 == $cour)
            {
                continue;
            }
            else
            {
                fwrite($temp, $line);
            }
        }

    }
    fclose($temp);
    fclose($file);
    rename("../../CSV/TAadmin/Temp.csv", "../../CSV/TAadmin/TACohort.csv"); //change names of the updated file to TACohort.csv
    $file = fopen("../../CSV/TAadmin/NumTARequired.csv", "r"); //update NumTARequired.csv
    $temp = fopen("../../CSV/TAadmin/Temp.csv", "w");

    while (!feof($file))
    {

        $line = fgets($file);
        $separated = explode(",", $line);
        if (!empty($line))
        {

            #info that changes per course:
            $term1 = $separated[0];
            $course1 = $separated[1];
            $num = $separated[2];
            $num = str_replace("\n", "", $num);

            if ($term1 == $term && $course1 == $cour)
            {
                $value = [$term1, $course1, $num + 1]; //add 1 to the number of TAs required
                $stringline = ""; //temporary string used to concatenate variables
                foreach ($value as $word)
                { //iterate through the list and concatenate each variable with a comma
                    $stringline .= $word . ",";
                }
                $finalstring = substr_replace($stringline, "", -1); //remove last comma from string
                fwrite($temp, $finalstring . "\n");
            }
            else
            {
                fwrite($temp, $line);
            }
        }

    }
    fclose($temp);
    fclose($file);
    rename("../../CSV/TAadmin/Temp.csv", "../../CSV/TAadmin/NumTARequired.csv");
}
if (!empty($name))
{
    header("Location:" . $url . "&Page=removeTA&Name=" . $name . "&Courses=" . $cour . "&term=" . $term);
}

?>
