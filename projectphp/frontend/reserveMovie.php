<?php


include ('config4.php');


$movieid = trim($_GET['movieid']);
echo '<INPUT type="hidden" name="movieid" value=' . $movieid . '>'; //gets book id and connects to db

$movieid = trim($_GET['movieid']);      // From the hidden field
$movieid = addslashes($movieid);

@ $db = new mysqli($dbserver, $dbuser, $dbpass, $dbname);

    if ($db->connect_error) {
        echo "could not connect: " . $db->connect_error;
        printf("<br><a href=index.php>Return to home page </a>");
        exit();
    }
    
   echo "You are reserving movie with the ID:"           .$movieid;

    // Prepare an update statement and execute it
    $stmt = $db->prepare("UPDATE movie SET onloan=1 WHERE movieID = ?");//update book table and set online. The question ark is when the user clicks on reserve. In the db, 
    $stmt->bind_param('i', $movieid); //the parameters being sent in.. i for intergegar
    $stmt->execute();

   

    printf("<br>Movie Reserved!");

    printf("<br><a href=browsedMovies.php>Search Movies </a>");
    printf("<br><a href=myMovies.php>Return to Reserved Movies </a>");
    printf("<br><a href=index.php>Return to home page </a>");
    exit;
    

