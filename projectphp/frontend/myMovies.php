

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


include("config4.php");

?>
        
    <div class="lid">

       

            <h2> Reserved Movies</h2>

           

  





<?php
# This is the mysqli version

$searchtitle = "";
$searchproducer = "";

if (isset($_POST) && !empty($_POST)) {
# Get data from form
    $searchtitle = trim($_POST['searchtitle']);
    $searchproducer = trim($_POST['searchproducer']);
}

//  if (!$searchtitle && !$searchauthor) {
//    echo "You must specify either a title or an author";
//    exit();
//  }

$searchtitle = addslashes($searchtitle);
$searchproducer = addslashes($searchproducer);

# Open the database
@ $db = new mysqli($dbserver, $dbuser, $dbpass, $dbname);

if ($db->connect_error) {
    echo "could not connect: " . $db->connect_error;
    printf("<br><a href=index.php>Return to home page </a>");
    exit();
}

# Build the query. Users are allowed to search on title, author, or both
/*
//$query = " select title, producer, onloan, movieid from movies where onloan is true";
$query="select movieID,title, make, nameOfDirector, yearOfPremier from movie";
if ($searchtitle && !$searchproducer) { // Title search only
    $query = $query . " and title like '%" . $searchtitle . "%'";
}
if (!$searchtitle && $searchproducer) { // Author search only
    //$query = $query . " and producer like '%" . $searchproducer . "%'";
    $query = $query . " and nameOfDirector like '%" . $searchproducer . "%'";
}
if ($searchtitle && $searchproducer) { // Title and Author search
    $query = $query . " and title like '%" . $searchtitle . "%' and nameOfDirector like '%" . $searchproducer . "%'"; // unfinished
    //$query = $query . " and title like '%" . $searchtitle . "%' and producer like '%" . $searchproducer . "%'"; // unfinished
}*/

//echo "Running the query: $query <br/>"; # For debugging
        
$query="select movieID,title,make,nameOfDirector,yearofPremier from movie where onloan=true";
        



  # Here's the query using an associative array for the results
//$result = $db->query($query);
//echo "<p> $result->num_rows matching books found </p>";
//echo "<table border=1>";
//while($row = $result->fetch_assoc()) {
//echo "<tr><td>" . $row['bookid'] . "</td> <td>" . $row['title'] . "</td><td>" . $row['author'] . "</td></tr>";
//}
//echo "</table>";
 

# Here's the query using bound result parameters
    // echo "we are now using bound result parameters <br/>";
    $stmt = $db->prepare($query);
    $stmt->bind_result($movieid,$title,$make,$producer,$year);
    //$stmt->bind_result($title, $producer, $onloan, $movieid);
    $stmt->execute();
    
//    $stmt2 = $db->prepare("update onloan set 0 where bookid like ". $bookid);
//    $stmt2->bind_result($onloan, $bookid);
    

    echo '<table bgcolor="F44242" cellpadding="6" width="100%">';
    echo '<tr><b><td>ID</td><b> <td>Title</td><td>Make</td> <td>Producer</td> <td>Year</td><td>Reserved?</td> </b> <td>Return</td> </b></tr>';
    $onloan=Yes;
    while ($stmt->fetch()) {
        if($onloan==1)
            $onloan="Yes";
       
        echo "<tr>";
        echo "<td> $movieid </td><td> $title </td><td>$make</td><td> $producer </td><td>$year</td><td> $onloan </td>";
        echo '<td><a href="returnMovie.php?movieid=' . urlencode($movieid) . '">Return</a></td>';
        echo "</tr>";
        
    }
    echo "</table>";
    ?>




       <footer>
        <?php include ('footer.php');?>   
       </footer> 

        

     </div>
 </div>
 </div>


    </body>
    
</html>