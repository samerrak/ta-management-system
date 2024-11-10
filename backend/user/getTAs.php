<?php 
    $tafile = "../../CSV/login/TA_login.csv";
    $user = $_POST['user'];

    $result = array();

    if (($hp = fopen($tafile, "r")) !== FALSE) { 
        while (($taData = fgetcsv($hp, 1000, ",")) !== FALSE) {      
                array_push( $result, $taData);
        }
    } else {
        echo json_encode("ERROR");
        exit(0);
    }

    echo json_encode($result);
?>