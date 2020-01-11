
 <?php 
            session_start();
//protection from XSS (CROSS-SITE SCRIPTING)code injection eg iframe
            include('config4.php');

if(!$loggedin){header("Location: main_login.php");}
?>

<html>

    <head>
    
        <title>Browse Books</title>
        
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
                    
                    <div>
                
                       <hr>
           
 



<h3>Movie delete </h3>
<hr>
<?php
# This is the mysqli version

$searchtitle = "";
$searchproducer = "";

if (isset($_POST) && !empty($_POST)) {//if its empy...
# Get data from form
    $searchtitle = trim($_POST['searchtitle']);//if searched by title
    $searchproducer = trim($_POST['searchproducer']);//if searched by author(removes spaces?)
}

//  if (!$searchtitle && !$searchauthor) {
//    echo "You must specify either a title or an author";
//    exit();
//  }

$searchtitle = addslashes($searchtitle);//(whats difference btw addlashes and  trim?)//deletes spaces(trim)//adds slashes incase of apostrofies(addslashes)
$searchproducer = addslashes($searchproducer);


$searchtitle = htmlentities($searchtitle);//this protects the var from XSS (CROSS-SITE SCRIPTING)code injection eg iframe
$searchproducer = htmlentities($searchproducer);//this protects the var from XSS (CROSS-SITE SCRIPTING)code injection eg iframe

# Open the database
@ $db = new mysqli($dbserver, $dbuser, $dbpass, $dbname);//why do we use not $db= mysql_$connect() diff?

if ($db->connect_error) {
    echo "could not connect: " . $db->connect_error;
    header("location: index.php"); //go here if unable to connect
    exit();
}

# Build the query. Users are allowed to search on title, author, or both

//$query = " SELECT  movieid, title, producer FROM movies";//goes to database and finds this in queery.(In the order in Query eg bookid, tittle, author shoould stämma also in same order in bind_results)
$query = " SELECT  movieid, title, make, nameOfDirector, yearOfPremier FROM movie";
if ($searchtitle && !$searchproducer) { // Title search only
    $query = $query . " where title like '%" . $searchtitle . "%'"; //percenage means any character coming b4 or after eg SELECT bookid, author, title, onloan FROM `books` WHERE author LIKE "%Ngu%" presents all authors names' that has NGU
}
if (!$searchtitle && $searchproducer) { // Author search only
    $query = $query . " where nameOfDirector like '%" . $searchproducer . "%'";
    // = $query . " where producer like '%" . $searchproducer . "%'";
}
if ($searchtitle && $searchproducer) { // Title and Author search
    $query = $query . " where title like '%" . $searchtitle . "%' and nameOfDirector like '%" . $searchproducer . "%'"; // unfinished
    //$query = $query . " where title like '%" . $searchtitle . "%' and producer like '%" . $searchproducer . "%'"; // unfinished
}
// 
//echo "Running the query: $query <br/>"; # For debugging


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
    $stmt->bind_result($movieid, $title, $make, $producer,$year);//whatever you is assigned in query(SHOULD BE TRANSLATED) then brought here and prepares it for execution. 
    $stmt->execute();

    echo '<table bgcolor="#dddddd" cellpadding="10" width="100%">';
    echo '<tr><th>ID</th> <th>Title</th> <th>Make</th> <th>Producer</th> <th>Year</th> <th>Reserve</th></tr>';
    while ($stmt->fetch()) {
        //We don't want to show reseved numbers
        
        echo "<tr>";
        echo "<td>$movieid</td> <td> $title </td><td>$make</td><td> $producer </td><td>$year</td> ";
        echo '<td><a href="delete.php?movieid=' . urlencode($movieid) . '"> Delete </a></td>';
        echo "</tr>";
    }
    echo "</table>";
    ?>



                       
                    
                </div>
            
           

            <div>
             
          <footer>
              
            <?php include('footer.php');?>  
          </footer>
            

        
        </div>
    
    </body>

</html>


