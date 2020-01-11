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
        
        <link rel="stylesheet" type="text/css" href="Lab4.css"/>

<header>
	 <div id="wrap">
         
    <div class="image">
    	 <div id="wrap">

        <div class="mainmenu">
         
             
        <a class="<?php echo ($current_page == 'main_login.php' || $current_page == '') ? 'active' : NULL ?>" href="main_login.php"> Admin Page</a>
           

          
     </div>
     </div>
 </div>
</div>
    </header>
            
          
</head>
<body>

</body>
</html>
