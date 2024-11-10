<!DOCTYPE html>
<html>
   <head>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <style>
         * {
         box-sizing: border-box;
         }
         [class*="col-"] {
         float: left;
         }
         .row:after {
         content: "";
         clear: both;
         display: table;
         }
         html, body {
         font-family: Arial;
         height: 100%;
         width: 100%;
         }
        .header1 {
            background-color: darkred;
            margin: 0px;
            padding: 0px;
            height: 30px;
            
        }
        .header1 p{
            margin: 0px;
            color: white;
        }
       
      
        table {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
  border: 1px solid #ddd;
}

th {
  text-align: center;
  padding: 8px;
    border: 1px solid #ddd;
}
        td{
            text-align: left;
  padding: 8px;
    border: 1px solid #ddd;
        }
        li{
            list-style-type:none;
            
        }
     
        
        
         .topnav {
         overflow: hidden;
         position: relative;
                margin:0px;
         }
          
        
        .topnav a:hover {
         background-color: #ddd;
         color: black;
         } 
          .topnav a {
         color: burlywood;
         padding: 14px 16px;
         text-decoration: none;
         font-size: 15px;
              padding-left: 0px;
             
         }
          .topnav a {
              display: none;}
        
         .topnav.responsive {position: relative;}
         
         .topnav.responsive a {
         float: none;
         display: block;
         text-align
          }
        
        [class*="col-"] {
         width: 100%;
         }
         @media only screen and (max-width: 700px) {
             .header1{
                 display: none;
             }
             .sidebar{
                 display:none;
             }
             
        }
        @media only screen and (min-width: 700px) {
         .col-s-1 {width: 8.33%;}
         .col-s-2 {width: 16.66%;}
         .col-s-3 {width: 25%;}
         .col-s-4 {width: 33.33%;}
         .col-s-5 {width: 41.66%;}
         .col-s-6 {width: 50%;}
         .col-s-7 {width: 58.33%;}
         .col-s-8 {width: 66.66%;}
         .col-s-9 {width: 75%;}
         .col-s-10 {width: 83.33%;}
         .col-s-11 {width: 91.66%;}
         .col-s-12 {width: 100%;}
            .sidebar{
             
                margin-top: 0px;
            margin-left: 0px;
            background-color: darkred;
            height: 100%;
            }
              .sidebar a {
            color: white;
            
        }
            .topnav{
                 display: none;
             }
            .head {
                display:none;
            }
         
         @media only screen and (min-width: 1300px) {
         .col-1 {width: 8.33%;}
         .col-2 {width: 16.66%;}
         .col-3 {width: 25%;}
         .col-4 {width: 33.33%;}
         .col-5 {width: 41.66%;}
         .col-6 {width: 50%;}
         .col-7 {width: 58.33%;}
         .col-8 {width: 66.66%;}
         .col-9 {width: 75%;}
         .col-10 {width: 83.33%;}
         .col-11 {width: 91.66%;}
         .col-12 {width: 100%;}
             .sidebar{
              
                margin-top: 0px;
            margin-left: 0px;
            background-color: darkred;
            height: 100%;
            }
               .sidebar a {
            color: white;
            
        }
             .topnav{
                 display: none;
             }
             .head {
                display:none;
            }
         }
    </style>
     <script>
         function myFunction() {
           var x = document.getElementById("myTopnav");
             console.log(x.className);
           if (x.className === "topnav") {
             x.className += " responsive";
           } else {
             x.className = "topnav";
           }
         }
         
         
              
         
      </script>
    <body>
       
        <!--contains TA with the current and past courses they have taught-->
        <div class="main col-12 col-s-12">
            <table>
            <tr>
                <th>TA Name</th>
                <th>Student ID</th>
                <th>Past Courses</th>
                <th>Current Courses</th>
                
                
            </tr>
       
        
        <?php

            
            
            //obtain information from TACohort.csv
                
            $file = fopen("../CSV/TAadmin/TACohort.csv", "r");
            $TAinfo = [];
            $TAcourses = [];
            $past = [];
            while(!feof($file)){
              
                $line = fgets($file);
                if (!empty($line)){
                    $separated = explode(",", $line);
                #info that changes per course:
                $term = $separated[0];
                $supervisor = $separated[6];
                $priority = $separated[7];
                $hours = $separated[8];
                $date_applied = $separated[9];
                $course = $separated[13];
                $notes = $separated[15];
                if ($term=="Winter 2022"){ //current courses they are assigned to
                    if (array_key_exists($separated[1], $TAcourses)) {
                        array_push($TAcourses[$separated[1]], [$term, $course, $supervisor, $priority, $hours, $date_applied, $notes]); //add to current course dictionary
                       
                    }
                    else{
                        $TAcourses[$separated[1]] = [[$term, $course, $supervisor, $priority, $hours, $date_applied, $notes]];    
                    }
                }
                else{
                    if (array_key_exists($separated[1], $past)) {
                        array_push($past[$separated[1]], [$term, $course, $supervisor, $priority, $hours, $date_applied, $notes]);
                    }
                    else{
                        $past[$separated[1]] = [[$term, $course, $supervisor, $priority, $hours, $date_applied, $notes]];  //if not current course, then it is a past course they have taught, add it to the past course dictionary  
                    }
                }
                
                
                #info that is the same per TA:
               
                    $ID = $separated[2];
                    $legal_name = $separated[3];
                    $email = $separated[4];
                    $grad = $separated[5];
                    $phone = $separated[11];
                    $degree = $separated[12];
                    $location = $separated[10];
                    $other_courses = $separated[14];
                    $TAinfo[$separated[1]] = [$ID, $legal_name, $email, $grad, $phone, $degree, $location, $other_courses];
    
                #print_r($TAinfo);
                #print_r($TAcourses[$separated[1]]);
                
	          # echo fgets($file) . "<br>";
                }
                
            }
                //iterate through dictionary and print infomation on screen
            foreach ($TAinfo as $key=>$value){
                if (!empty($TAcourses) && !empty($past)){  //if there is current and past courses, print both
                    $len = count($TAcourses[$key]); 
                
                echo "<tr>";
                echo "<td rowspan=$len>$key</td>";
                $ID = $TAinfo[$key][0];
                $legal_name = $TAinfo[$key][1];
                $email = $TAinfo[$key][2];
                $grad = $TAinfo[$key][3];
                $phone = $TAinfo[$key][4];
                $degree = $TAinfo[$key][5];
                $location = $TAinfo[$key][6];
                $other_courses = $TAinfo[$key][7];
                
                
                echo "<td rowspan=$len>$ID</td>";
                
                foreach ($past[$key] as $course) {
                    
                    
                    $term = $course[0];
                    $supervisor = $course[2];
                    $priority = $course[3];
                    $hours = $course[4];
                    $date_applied = $course[5];
                    $course = $course[1];
                 $notes = $course[6];
                     echo "<td rowspan=$len>";
                     echo "   
                        <li>Course: $course</il>
                        <li>Term: $term</il>
                        <li>Supervisor: $supervisor</il>
                        <li>Priority: $priority</il>
                        <li>Hours: $hours</il>
                        <li>Date Applied: $date_applied</il>
                        <li>Notes: $notes</il>
                        <br>
                        ";
                    echo "</td>";
                
                }
                $x=0;
                foreach ($TAcourses[$key] as $course) {
                    
                    
                    $term = $course[0];
                    $supervisor = $course[2];
                    $priority = $course[3];
                    $hours = $course[4];
                    $date_applied = $course[5];
                    $course = $course[1];
                 $notes = $course[6];
                    if ($x == 0) {
                        echo "<td>";
                   
                     echo "   

                        <li>Course: $course</il>
                        <li>Term: $term</il>
                        <li>Supervisor: $supervisor</il>
                        <li>Priority: $priority</il>
                        <li>Hours: $hours</il>
                        <li>Date Applied: $date_applied</il>
                        <li>Notes: $notes</il>
                        ";
                    echo "</td></tr>";
                    }
                    else{
                    echo "<tr><td>";
                   
                     echo "   

                        <li>Course: $course</il>
                        <li>Term: $term</il>
                        <li>Supervisor: $supervisor</il>
                        <li>Priority: $priority</il>
                        <li>Hours: $hours</il>
                        <li>Date Applied: $date_applied</il>
                        <li>Notes: $notes</il>
                        ";
                    echo "</td></tr>";
                    }
                    $x=1;
                }
                
                }
                
                
                else if (!empty($TAcourses)){ //if there are only current courses, no past courses
                    $len = count($TAcourses[$key]);
                    echo "<tr>";
                echo "<td rowspan=$len>$key</td>";
                $ID = $TAinfo[$key][0];
                $legal_name = $TAinfo[$key][1];
                $email = $TAinfo[$key][2];
                $grad = $TAinfo[$key][3];
                $phone = $TAinfo[$key][4];
                $degree = $TAinfo[$key][5];
                $location = $TAinfo[$key][6];
                $other_courses = $TAinfo[$key][7];
                
                
                echo "<td rowspan=$len>$ID</td>";
                
                
                $x=0;
                foreach ($TAcourses[$key] as $course) {
                    
                    
                    $term = $course[0];
                    $supervisor = $course[2];
                    $priority = $course[3];
                    $hours = $course[4];
                    $date_applied = $course[5];
                    $course = $course[1];
                 $notes = $course[6];
                    if ($x == 0) {
                        echo "<td>";
                   
                     echo "   

                        <li>Course: $course</il>
                        <li>Term: $term</il>
                        <li>Supervisor: $supervisor</il>
                        <li>Priority: $priority</il>
                        <li>Hours: $hours</il>
                        <li>Date Applied: $date_applied</il>
                        <li>Notes: $notes</il>
                        ";
                    echo "</td></tr>";
                    }
                    else{
                    echo "<tr><td>";
                   
                     echo "   

                        <li>Course: $course</il>
                        <li>Term: $term</il>
                        <li>Supervisor: $supervisor</il>
                        <li>Priority: $priority</il>
                        <li>Hours: $hours</il>
                        <li>Date Applied: $date_applied</il>
                        <li>Notes: $notes</il>
                        ";
                    echo "</td></tr>";
                    }
                    $x=1;
                }
                }
                
                
                
                else if (!empty($past)){ //if there are only past courses, no current course
                    $len = count($past[$key]);
                    echo "<tr>";
                echo "<td rowspan=$len>$key</td>";
                $ID = $TAinfo[$key][0];
                $legal_name = $TAinfo[$key][1];
                $email = $TAinfo[$key][2];
                $grad = $TAinfo[$key][3];
                $phone = $TAinfo[$key][4];
                $degree = $TAinfo[$key][5];
                $location = $TAinfo[$key][6];
                $other_courses = $TAinfo[$key][7];
                
                
                echo "<td rowspan=$len>$ID</td>";
                
                
                $x=0;
                foreach ($past[$key] as $course) {
                    
                    
                    $term = $course[0];
                    $supervisor = $course[2];
                    $priority = $course[3];
                    $hours = $course[4];
                    $date_applied = $course[5];
                    $course = $course[1];
                 $notes = $course[6];
                    if ($x == 0) {
                        echo "<td>";
                   
                     echo "   

                        <li>Course: $course</il>
                        <li>Term: $term</il>
                        <li>Supervisor: $supervisor</il>
                        <li>Priority: $priority</il>
                        <li>Hours: $hours</il>
                        <li>Date Applied: $date_applied</il>
                        <li>Notes: $notes</il>
                        ";
                    echo "</td></tr>";
                    }
                    else{
                    echo "<tr><td>";
                   
                     echo "   

                        <li>Course: $course</il>
                        <li>Term: $term</il>
                        <li>Supervisor: $supervisor</il>
                        <li>Priority: $priority</il>
                        <li>Hours: $hours</il>
                        <li>Date Applied: $date_applied</il>
                        <li>Notes: $notes</il>
                        ";
                    echo "</td></tr>";
                    }
                    $x=1;
                }
                }
           
               
               
               
            }
     
            fclose($file);
            ?>
                 </table>
            
        
        </div>
        
    </body>
</html>