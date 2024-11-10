<?php
    function display($path) {
        $file = fopen($path,"r");
        while(!feof($file)) {
            $line = fgets($file);
            echo $line;
        }
        fclose($file);
    }


    display("../frontend/home.html");

    if ($_GET["Page"]=="Login") {
        display("../frontend/login.html");
    }

    else {
        echo "Error 404";
    }


