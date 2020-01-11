
<?php

include('config4.php');

$movieid = trim($_GET['movieid']); //gets book id and connects to db
echo '<INPUT type="hidden" name="movieid" value=' . $movieid . '>';

$movieid = trim($_GET['movieid']);      // From the hidden field
$movieid = addslashes($movieid);

@ $db = new mysqli($dbserver, $dbuser, $dbpass, $dbname);

    if ($db->connect_error) {
        echo "could not connect: " . $db->connect_error;
        printf("<br><a href=index.php>Return to home page </a>");
        exit();
    }
    
   echo $movieid;

    // Prepare an update statement and execute it
    $stmt = $db->prepare("UPDATE movie SET onloan=false WHERE movieID = ?");
    $stmt->bind_param('i', $movieid);
    $stmt->execute();
    printf("<br>Succesfully returned!");

    printf("<br><a href=browsedMovies.php>Search  Movies </a>");
    printf("<br><a href=myMovies.php>Return to Reserved Movies </a>");
    printf("<br><a href=index.php>Return to home page </a>");
    exit;

?>

    


