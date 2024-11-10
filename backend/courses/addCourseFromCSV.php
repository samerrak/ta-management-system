<?php 
    $id = $_POST["userId"];

    $target_dir = "/../../uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    echo $target_file;
    
    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
      echo "Sorry, your file is too large.";
      $uploadOk = 0;
    }
    
    // Allow certain file formats
    if($fileType != "csv") {
      echo "Sorry, only CSV files are allowed.";
      $uploadOk = 0;
    }
    
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file has been uploaded.";
      } else {
        echo "Sorry, there was an error uploading your file.";
      }
    }


    // $csv = "../../CSV/courses/courses.csv";

    // if (($fp = fopen($csv, "r")) !== FALSE) {
    //     while (($data = fgetcsv($fp, 1000, ",")) !== FALSE)
    //     {
    //         if($data[1] == $code || $data[2] == $name) {
    //             header("Location: ../../frontend/sysop.html?error=1&user=" . $id . "&Page=addCou" );
    //             fclose($fp);
    //             exit(0);
    //         }
    //     }
    //     fclose($fp);
    // } else {
    //     header("Location: ../../frontend/sysop.html?error=2&user=" . $id . "&Page=addCou" );
    //     exit(0);
    // }

    // if (($fp = fopen($csv, "a")) !== FALSE) {
    //     $line = array($term . "," . $month, $code, $name);
    //     fputcsv($fp, $line);
    //     fclose($fp);
    //     header("Location: ../../frontend/sysop.html?user=" . $id . "&Page=addCou" );
    //     fclose($fp);
    // } else
    // header("Location: ../../frontend/sysop.html?error=2&user=" . $id . "&Page=addCou" );

?>