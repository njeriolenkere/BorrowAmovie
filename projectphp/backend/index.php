
<?php
session_start();
include "config4.php";
if(!$loggedin){header("Location: main_login.php");}

?>
<!DOCTYPE html>

<html>

    <head>
    
        <title>admins</title>
        
        <meta name="Movie Lovers" content="Movies of all gernes"/>
        
        <meta charset="utf-8"/>
        
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
        
        <link rel="stylesheet" type="text/css" href="Lab4.css"/>
        
    </head>
    
    <body>
    
        <div id="wrap">
            
            <?php include('header.php');?>
            
            
            
                <div class="lid">
               <h4> Welcome to Admin Page! </h4>
                
                 <img class="about us" src="admin.png" alt="topicture" width="30%" height="5%">
          <footer>
           <?php include('footer.php');?>    

          </footer>
               

            
            
            
      
  </div>    
</div>
    
    </body>

</html>