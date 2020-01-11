
 <?php 
     session_start();       
//protection from XSS (CROSS-SITE SCRIPTING)code injection eg iframe
            include('config4.php');


?>

<html>

    <head>
    
        <title>Browse Movies</title>
        
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
           
 

<h3>Search our Movie Base</h3>
<hr>
<p>You may search by title, or by producer, or both</p><br>
<form action="browsedMovies.php" method="POST">
    <table bgcolor="#F44242" cellpadding="6">
        <tbody>
            <tr>
                <td>Title:</td>
                <td><INPUT type="text" name="searchtitle"></td>
            </tr>
            <tr>
                <td>Producer:</td>
                <td><INPUT type="text" name="searchproducer"></td>
            </tr>
            <tr>
                <td></td>
                <td><INPUT type="submit" name="submit" value="Submit"></td>
            </tr>
        </tbody>
    </table>
</form>

<h3>Movie List</h3>
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
    printf("<br><a href=index.php>Return to home page </a>"); //go here if unable to connect
    exit();
}

# Build the query. Users are allowed to search on title, author, or both

//$query = " select  movieid, title, producer, onloan FROM movies";//goes to database and finds this in queery.(In the order in Query eg bookid, tittle, author shoould stämma also in same order in bind_results)
$query="SELECT movie.movieID, movie.title,movie.make, movie.nameOfDirector, movie.yearOfPremier, gerne.gerneName, movie.onloan FROM `movie`
JOIN gerne_movie ON movie.movieID=gerne_movie.movieID
JOIN gerne ON gerne_movie.gerneID=gerne.gerneID ";
if ($searchtitle && !$searchproducer) { // Title search only
    $query.=" where title LIKE '%".$searchtitle."%' ";
    //$query = $query . " where title like '%" . $searchtitle . "%'"; //percenage means any character coming b4 or after eg SELECT bookid, author, title, onloan FROM `books` WHERE author LIKE "%Ngu%" presents all authors names' that has NGU
}
if (!$searchtitle && $searchproducer) { // Author search only
    $query.=" where nameOfDirector LIKE '%".$searchproducer."%'";
    //$query = $query . " where producer like '%" . $searchproducer . "%'";
}
if ($searchtitle && $searchproducer) { // Title and Author search
    $query.=" where title LIKE '%".$searchtitle."%' and nameOfDirector like '%".$searchproducer."%'";
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
    $stmt->bind_result($movieid,$title,$make,$producer,$year,$gerne,$onloan);
    //$stmt->bind_result($movieid, $title, $producer, $onloan);//whatever you is assigned in query(SHOULD BE TRANSLATED) then brought here and prepares it for execution. 
    $stmt->execute();

    echo '<table bgcolor="#F44242" cellpadding="10" width="100%">';
    echo '<tr><th>ID</th> <th>Title</th> <th>Producer</th> <th>Make</th> <th>Year</th> <th>Gerne</th> <th>Reserved?</th><th>Reserve</th>  </tr>';
    
    while ($stmt->fetch()) {
        //We don't want to show reseved numbers
        if ($onloan==0) //shows all book's status.  with integer thats equals 1(reserved) 0(return)
            $onloan="NO"; //IF the book is not onloan(reserved) say No else write yes
        else $onloan="YES";  
        echo "<tr>";
        echo "<td>$movieid</td> <td> $title </td><td> $producer </td> <td>$make</td> <td>$year</td> <td>$gerne</td> <td>$onloan</td>";
        if($onloan=="NO" && $loggedin){echo '<td><a href="reserveMovie.php?movieid=' . urlencode($movieid) . '"> Reserve </a></td>';}//if
        if(!$loggedin){echo "<td>(Sign in to reserve)</td>";}
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


