<!DOCTYPE html>
<html>
<html lang="en">
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
            }}
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
       
        <!--the following are all the components of information being extracted from the database and printed on the screen-->
        <div class="main col-12 col-s-12" style="overflow-x:auto">
            <table>
            <tr>
                <th>TA Name</th>
                <th>Student ID</th>
                <th>Personal Information</th>
                
                <th>Student Rating</th>
                <th>Student Comments</th>
                <th>Professor's Comments</th>
                <th>Wish Listed</th>
                <th>Course Information</th>
                
            </tr>
           
        
        <?php
            $file = fopen("../CSV/TAadmin/CourseQuota.csv", "r") or die("Unable to open file!"); //use info from CourseQuota.csv to create NumTARequired.csv
            $TAcourses = [];
         
          while(!feof($file)){
          
                $line = fgets($file);
              
                if (!empty($line)){
                    $separated = explode(",", $line);
                    #info that changes per course:
                    $term = $separated[0];
                    $course = $separated[1];
                    $students = $separated[5];
                    $TAquota = $separated[6];
                    $numTA = intval(intval($students)/intval($TAquota)); //divide student enrollment by TA quota
                    $TAcourses[$course] = [$term, $course, $numTA];  
                }
            }
                fclose($file);
                $file = fopen("../CSV/TAadmin/NumTARequired.csv", "w"); //create new file containing term, course, and number of TA required per course
                foreach ($TAcourses as $key=>$value){
                    //store all variables as a list
                    $stringline = ""; //temporary string used to concatenate variables
                    foreach($value as $word){ //iterate through the list and concatenate each variable with a comma
                        $stringline .= $word . ",";
                    }
                    $finalstring = substr_replace($stringline, "", -1); //remove last comma from string
                    fwrite($file, $finalstring . "\n"); //add string to csv file with a new line
                }
                
                 fclose($file);


            $ratings = fopen("../CSV/TAmanager/TAscore.csv", "r"); //TA rating from students
            $TArating = [];
            while(!feof($ratings)){
              
            $line = fgets($ratings);
                if (!empty($line)){
                     $separated = explode(",", $line);
            
            $name = $separated[0];
            $rating = $separated[3];
            $comment = $separated[4];
            $comment = substr($comment, 13);
                 if (array_key_exists($name, $TArating)) {
                    array_push($TArating[$name], [$rating, $comment]); //store all information into a dictionary and calculate the average for rating
                }
                else{
                    $TArating[$name] = [[$rating, $comment]];    
                }
                }
           
                
            }
            
            fclose($ratings);
            
            $prof = fopen("../CSV/TAadmin/TAperformancelog.csv", "r"); //performance log given by professor
            $profcomment = [];
            while(!feof($prof)){
              
                $line = fgets($prof);
                if (!empty($line)){
                $separated = explode(",", $line);
            
                $name = $separated[2];
               
                $comment = $separated[3];
                 if (array_key_exists($name, $profcomment)) {
                    array_push($profcomment[$name], $comment); //print each comment given by professors
                }
                else{
                    $profcomment[$name] = [$comment];    
                }
                }
            }
            
            fclose($prof);
                
            $wish = fopen("../CSV/TAadmin/TAwishlist.csv", "r"); //print if this TA is on the wishlist of a professor for a certain class
            $wishlist = [];
            while(!feof($wish)){
              
                $line = fgets($wish);
                if (!empty($line)){
                $separated = explode(",", $line);
                $semester = $separated[0];
                $course = $separated[1];
                $prof = $separated[2];
                $name = $separated[3];
                 if (array_key_exists($name, $wishlist)) {
                    array_push($wishlist[$name], [$prof, $semester, $course]);
                }
                else{
                    $wishlist[$name] = [[$prof, $semester, $course]];    
                }
              }
            }
            
            fclose($wish);
                
                
            $file = fopen("../CSV/TAadmin/TACohort.csv", "r"); //prints all the information regarding the TA
            $TAinfo = [];
            $TAcourses = [];
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
                if (array_key_exists($separated[1], $TAcourses)) {
                    array_push($TAcourses[$separated[1]], [$term, $course, $supervisor, $priority, $hours, $date_applied, $notes]); //store all information as a dictionary with the TA name being the key and the courses as a list
                }
                else{
                    $TAcourses[$separated[1]] = [[$term, $course, $supervisor, $priority, $hours, $date_applied, $notes]];    
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
            foreach ($TAinfo as $key=>$value){
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
                $other_courses = $TAinfo[$key][7]; //print personal information of TA to screen
                
                
                echo "<td rowspan=$len>$ID</td>";
                 echo "<td rowspan=$len>
                   
                  
                    <li>Legal Name: $legal_name</il> 
                    <li>Email: $email</il>
                    <li>Grad/Ugrad: $grad</il>
                    <li>Phone: $phone</il>
                    <li>Degree: $degree</il>
                    <li>Location: $location</il>
                    <li>Other Courses: $other_courses</il>
                 
                    </td>";
                
                #TArating and comments
                $avg_rate = 0;
                $num = 0;
                foreach ($TArating[$key] as $rating){
                    $avg_rate = $avg_rate + $rating[0];
                    $num = $num + 1;
                }
                $avg_rate = $avg_rate/$num;
                echo "<td rowspan=$len>$avg_rate</td>";
                echo "<td rowspan=$len>";
                $x=1;
                foreach ($TArating[$key] as $rating){
                    echo "Comment $x:";
                    echo "<li>$rating[1]</li><br>";
                    $x=$x+1;
                }
                echo "</td>";
                
                
                #prof's comments
                echo "<td rowspan=$len>";
                $x=1;
                foreach ($profcomment[$key] as $comment){
                    echo "Comment $x:";
                    echo "<li>$comment</li><br>";
                    $x=$x+1;
                }
                echo "</td>";
                
                echo "<td rowspan=$len>";
                foreach ($wishlist[$key] as $wish){
                    echo "<li>Professor: $wish[0]</li>";
                    echo "<li>Semester: $wish[1]</li>";
                    echo "<li>Course: $wish[2]</li><br>";
                }
                echo "</td>";
                
                $x=0;
                foreach ($TAcourses[$key] as $course) {
                    
                    
                    $term = $course[0];
                    $supervisor = $course[2];
                    $priority = $course[3];
                    $hours = $course[4];
                    $date_applied = $course[5];
                    $thiscourse = $course[1];
                    $notes = $course[6]; //print all courses currently and previously taught by TA
                    if ($x == 0) {
                        echo "<td>";
                   
                     echo "   

                        <li>Course: $thiscourse</il>
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

                        <li>Course: $thiscourse</il>
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
     
            fclose($file);
            ?>
                 </table>
            
        
        </div>
        
    </body>
</html>