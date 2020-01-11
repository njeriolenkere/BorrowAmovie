<?php
session_start();
include("config4.php");

if (isset($_GET['submit'])) {
    // We know the borrower so go ahead and check the book out
    # Get data from form
    $movieid = trim($_GET['movieid']);      // From the hidden field
    $movieid = addslashes($movieid);

    # Open the database using the "librarian" account
    @ $db = new mysqli($dbserver, $dbuser, $dbpass, $dbname);

    if ($db->connect_error) {
        echo "could not connect: " . $db->connect_error;
       header("location: index.php");
        exit();
    }

    // Prepare an update statement and execute it
    
        //$stmt = $db->prepare("DELETE FROM movies WHERE movieid = ? ");
        $stmt=$db->prepare("DELETE FROM movie WHERE movieID=?");
        $stmt->bind_param('i', $movieid);
        $response = $stmt->execute();
        printf("<br>Movie deleted!");
        header("location: browsedMovies.php");
        //header("location: index.php");
    
    
    exit;
}

// We don't have a borrower id yet so present a form to get one,
// then post back using a hidden field to pass through the bookid
// which came from the hand-crafted URL query string on the book
// search page
?>

<!DOCTYPE html>

<html>
    
    <head>

        <title>My Moviess</title>

        <meta charset="utf-8"/>

        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

        <link rel="stylesheet" type="text/css" href="Lab4.css"/>

    </head>

    <body>

    <div id="wrap">

        <?php 
        
        include('header.php');




?>
        
    <div class="lid">

       

    <h3>Delete Movie</h3>
<hr>
<form action="delete.php" method="GET">
    Are you sure you want to delete movie?
    <?php
    $movieid = trim($_GET['movieid']);
    echo '<INPUT type="hidden" name="movieid" value=' . $movieid . '>';
    ?>
    <INPUT type="submit" name="submit" value="Continue">
</form>


       <footer>
        <?php include ('footer.php');?>   
       </footer> 

        

     </div>
 </div>
 </div>


    </body>
    
</html>