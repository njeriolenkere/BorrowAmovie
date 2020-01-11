
 <?php 
          session_start();  
//protection from XSS (CROSS-SITE SCRIPTING)code injection eg iframe
            include('config4.php');
if(!$loggedin){header("Location: main_login.php");}

?>

<html>

    <head>
    
        <title>add Movie</title>
        
        <meta charset="utf-8"/>
    
    
        <link rel="stylesheet" type="text/css" href="Lab4.css"/>
    
    </head>
    
    <body>
    
        <div id="wrap">

        
            <?php 
            
            include('header.php');


?>
    
          
            
                <div class="lid">
                    
                    <div>
                


<?php
        
 # Open the database using the "librarian" account
@ $db = new mysqli($dbserver, $dbuser, $dbpass, $dbname);

    if ($db->connect_error) {
        echo "could not connect: " . $db->connect_error;
        header("location: index.php");
        exit();
    }

                        
if (isset($_POST['newmovietitle'])) {
    // This is the postback so add the book to the database
    # Get data from form
    $newmovietitle = trim($_POST['newmovietitle']);
    $newmovieproducer = trim($_POST['newmovieproducer']);
    $newmoviemake = trim($_POST['newmoviemake']);
    $newmovieyear = trim($_POST['newmovieyear']);
    $newmoviegenre=trim($_POST['newmoviegenre']);
    //$newmovieisbn = trim($_POST['newmovieisbn']);

    //if (!$newmovietitle || !$newmovieproducer || !$newmovieisbn) {//if book title or author isnt entered, they must enter it
    if(!$newmovietitle || !$newmovieproducer || !$newmoviemake || !$newmovieyear){
        //printf("You must specify both a title, producer and isbn!");
        printf("You must specify a title, make, producer and year");
        header("location: index.php");
        exit();
    }

    $newmovietitle = addslashes($newmovietitle);//if the title or book has an apostrophe or wierd characters
    $newmovieproducer = addslashes($newmovieproducer);
    $newmoviemake = addslashes($newmoviemake);
    $newmovieyear = addslashes($newmovieyear);
    $newmoviegenre = addslashes($newmoviegenre);
    //$newmovieisbn = addslashes($newmovieisbn);

    $newmovietitle = htmlentities($newmovietitle);//this protects the var from XSS (CROSS-SITE SCRIPTING)code injection eg iframe
    $newmovieproducer = htmlentities($newmovieproducer);
    $newmoviemake = htmlentities($newmoviemake);
    $newmovieyear = htmlentities($newmovieyear);
    $newmoviegenre = htmlentities($newmoviegenre);
    //$newmovieisbn = htmlentities($newmovieisbn);

   
    // Prepare an insert statement and execute it(`bookID`, `title`, `isbn`, `pageCount`, `edition`, `year`, `publisher`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7])
    //$stmt = $db->prepare("INSERT INTO movies(title, producer, isbn) VALUES (?, ?, ? )");//why not adding ISBN?
    $stmt=$db->prepare("INSERT INTO movie(title, make, nameOfDirector, yearOfPremier) VALUES(?,?,?,?)");
    
    //$stmt->bind_param('ssi', $newmovietitle, $newmovieproducer, $newmovieisbn);//ssi=string(is , string, string(isbn is an integer)
    $stmt->bind_param('sssi',$newmovietitle,$newmoviemake,$newmovieproducer,$newmovieyear);
    $stmt->execute();
    $stmt=$db->prepare("select movieID from movie where title='".$newmovietitle."' and nameOfDirector='".$newmovieproducer."'");
    $stmt->bind_result($movieid);
    $stmt->execute();
    while($stmt->fetch()){
        
        $newmovieid=$movieid;
    
    }//
    $stmt=$db->prepare("insert into gerne_movie(gerneID,movieID) values(?,?)");
    $stmt->bind_param('ii',$newmoviegenre,$newmovieid);
    $stmt->execute();
    printf("<br>Movie Added!");
    header("location: browsedMovies.php");
    //header("location: index.php");
    exit;
}
                        
if(isset($_POST['newgenre'])){
    $newgenre=htmlentities(addslashes(trim($_POST['newgenre'])));
    $stmt=$db->prepare("insert into gerne(gerneName) values(?)");
    $stmt->bind_param('s',$newgenre);
    $stmt->execute();
    printf("<br />Genre added!");
    header("Location: addmovie.php");
}//

// Not a postback, so present the book entry form
?>

<h3>Add a new Movie</h3>
<hr>
All values required!
<form action="addmovie.php" method="POST">
    <table bgcolor="#bdc0ff" cellpadding="6">
        <tbody>
            <tr>
                <td>Title:</td>
                <td><INPUT type="text" name="newmovietitle"></td>
            </tr>
            <tr>
                <td>Producer:</td>
                <td><INPUT type="text" name="newmovieproducer"></td>
            </tr>
            <tr><td>Make:</td>
                <td><select name="newmoviemake">
                    <option value="film">film</option>
                    <option value="series">series</option>
                    </select>
                </td>
            </tr>
            <tr><td>Year:</td>
                <td><input type="number" name="newmovieyear" value="2017" /></td>
            </tr>
            <tr><td>Genre:</td>
                <td><select name="newmoviegenre">
                    <?php
                    $query="select gerneID,gerneName from gerne order by gerneName asc";
                    $stmt=$db->prepare($query);
                    $stmt->bind_result($genreid,$genre);
                    $stmt->execute();
                    while($stmt->fetch()){
                        
                        echo "<option value='".$genreid."'>".$genre."</option>";
                        
                    }//
                    ?>
                    </select> <a href="#addgenre">+ New Genre</a></td>
            </tr>
            <!--<td>ISBN:</td>
                <td><INPUT type="number" name="newmovieisbn"></td>
            </tr>-->
            <tr>
                <td></td>
                <td><INPUT type="submit" name="submit" value="Add Movie"></td>
            </tr>
        </tbody>
    </table>
</form><hr />
            <a name="addgenre"></a>
                        <form method="post" action="addmovie.php">
                            
                            <table bgcolor="#bdc0ff" cellpadding="6">
        <tbody>
            <tr>
                <td>Genre:</td>
                <td><INPUT type="text" name="newgenre"></td>
                    <td><button type="submit" name="submit">Add Genre</button></td>
            </tr></tbody></table>
                            
                        </form>

                    
                </div>
            
           

            <div>
             
          <footer>
              
            <?php include('footer.php');?>  
          </footer>
            

        
        </div>
    
    </body>

</html>
