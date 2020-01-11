<?php

@session_start();

include('config4.php');

 //if this statements is correct active if ts not its null
?>

<!DOCTYPE html>
<html>
<head>
    <title>head</title>
   
          <meta charset="utf-8"/>
        
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
        
        <link rel="stylesheet" type="text/css" href="Lab4.css"/>

<header>
         
    <div class="image">

        <div class="mainmenu">
         
             
        <a class="<?php echo ($current_page == 'index.php' || $current_page == '') ? 'active' : NULL ?>" href="index.php"> Home</a>
           

           <a class="<?php echo ($current_page == 'aboutUs.php') ? 'active' : NULL ?>" href="aboutUs.php">About us</a>
            
         <a class="<?php echo ($current_page == 'browsedMovies.php') ? 'active' : NULL ?>" href="browsedMovies.php">Search Movies</a>

         <?php if($loggedin){?><a class="<?php echo ($current_page == 'myMovies.php') ? 'active' : NULL ?>" href="myMovies.php">Reserved Movies</a><?php }?>
            
        <a class="<?php echo ($current_page == 'gallery.php') ? 'active' : NULL ?>" href="gallery.php"> Gallery</a>

        <a class="<?php echo ($current_page == 'sitemap.php') ? 'active' : NULL ?>" href="sitemap.php">Site Map</a>

        <?php if($loggedin){?><a class="<?php echo ($current_page == 'logoutG.php') ? 'active' : NULL ?>" href="logoutG.php">Logged in as <?php echo $_SESSION['username'];?> | Log Out</a><?php }?>
        
        <?php if(!$loggedin){?><a class="<?php echo ($current_page == 'main_loginG.php') ? 'active' : NULL ?>" href="main_loginG.php">Log In</a><?php }?>
    </div>
</div>
</div>
    </header>
            
          
</head>
<body>

</body>
</html>

