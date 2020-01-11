<?php


include('config4.php');

 //if this statements is correct active if ts not its null
?>

<!DOCTYPE html>
<html>
<head>
    <title>head</title>
   
          <meta charset="utf-8"/>
        
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
        
        <link rel="stylesheet" type="text/css" href="project.css"/>

<header>
         
    <div class="image">

        <div class="mainmenu">
         
             
        <a class="<?php echo ($current_page == 'index.php' || $current_page == '') ? 'active' : NULL ?>" href="index.php"> Home</a>
           
            <?php if($loggedin){?>
          <a class="<?php echo ($current_page == 'browsedMovies.php') ? 'active' : NULL ?>" href="browsedMovies.php">Movie List</a> 
        
        
         <a class="<?php echo ($current_page == 'addmovie.php') ? 'active' : NULL ?>" href="addmovie.php">Add Movie</a>

         <a class="<?php echo ($current_page == 'deletemovie.php') ? 'active' : NULL ?>" href="deletemovie.php">Delete Movie</a>

         <a class="<?php echo ($current_page == 'gallery.php') ? 'active' : NULL ?>" href="gallery.php">Gallery</a>
            
        <a class="<?php echo ($current_page == 'logout.php') ? 'active' : NULL ?>" href="logout.php">Logged in as <?php echo $_SESSION['username'];?> | Log Out</a><?php }?>
            
        <?php if(!$loggedin){?><a class="<?php echo ($current_page == 'main_login.php') ? 'active' : NULL ?>" href="main_login.php">Login</a><?php }?>
            
    </div>
</div>
</div>
    </header>
            
          
</head>
<body>

</body>
</html>

