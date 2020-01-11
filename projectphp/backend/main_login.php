<?php
session_start ();

/* SQL injection.prevention
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

#this function is for older PHP versions that use Magic Quotes.
#
//    function escapestring($input) {
//    if (get_magic_quotes_gpc()) {
//    $input = stripslashes($input);
//    }
//
//    @ $db = new mysqli('localhost', 'root', '', 'testinguser');
//
//
//    return mysqli_real_escape_string($db, $input);
//
//    }//paswordhashig= hash is the blender for passwords..(password+hash=bits and pieces blended in. fROM THIS )

include "config4.php";

@ $db = new mysqli($dbserver, $dbuser, $dbpass, $dbname);//CONNECTING WITH DB testnguser

if ($db->connect_error) {
    echo "could not connect: " . $db->connect_error;
    printf("<br><a href=index.php>Return to home page </a>");
    exit();
}

    #the mysqli_real_espace_string function helps us solve the SQL Injection
    #it adds forward-slashes in front of chars that we can't store in the username/pass
    #in order to excecute a SQL Injection you need to use a ' (apostrophe)
    #Basically we want to output something like \' in front, so it is ignored by code and processed as text

if (isset($_POST['username'], $_POST['userpass'])) {
    #with statement under we're making it SQL Injection-proof
    $uname = mysqli_real_escape_string($db, $_POST['username']);//escape specal characters(escapes) prevent SQL injection
    //(escapes 2 parameters)goes in db then checks


    
    #without function, so here you can try to implement the SQL injection
    #various types to do it, either add ' -- to the end of a username, which will comment out
    #or simply use 
    #' OR '1'='1' #
    #$uname = $_POST['username'];
    
    #here we hash the password, and we want to have it hashed in the database as well
    #optimally when you create a user (through code) you simply send a hash
    #hasing can be done using different methods, MD5, SHA1 etc.
    
    $upass = sha1($_POST['userpass']);//create userpassword variable.. SHA1 blends the pasword into small pices
 
    
    #just to see what we are selecting, and we can use it to test in phpmyadmin/heidisql
    //echo $uname;
    //echo '<br>';
    //echo $upass;
    //echo "SELECT * FROM user WHERE username = '{$uname}' AND userpass = '{$upass}'";
    //$query = ("INSERT INTO username($uname) VALUES ('{$uname}')");
    
    $query = ("SELECT user.userID,user.userName FROM `user` WHERE userName='{$uname}' AND userPass='{$upass}' AND groupID=1");//groupID=1 is for admins only
    //select all where username==uname and userpassword==upasword
        
    
    $stmt = $db->prepare($query);//prepares
    $stmt->bind_result($userid,$username);
    $stmt->execute();//executes
    $stmt->store_result(); //puts the results here
    
    while($stmt->fetch()){
        
        $time=intval(time()*3600*24*3650);
        
        setcookie('user',$userid,$time);
        
        $_SESSION['username']=$username;
        
    }//
    
    #here we create a new variable 'totalcount' just to check if there's at least
    #one user with the right combination. If there is, we later on print out "access granted"
    $totalcount = $stmt->num_rows();
    
    if(isset($_COOKIE['user'])){header("Location: browsedMovies.php");}//if
    
}
?>

<!DOCTYPE >
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>
 
</title>
    
    <body>
    
        <div id="wrap">

            
         
            <?php



include('login.php');

 //if this statements is correct active if ts not its null
?>
          
            
                <div class="lid">
                    


</head>
<body>



                   <?php
        
        
        
        if (isset($totalcount)) {//icheck it out(if the total count is entered)
            if ($totalcount == 0) {
                echo '<h2>Oppsy you can\'t break in here!</h2>';
            } else {
               header("location: index.php");//header redirects user to location of file upload.
            }
        }
        ?>
       
                
                <form method="POST" action="main_login.php">
                            
                           
                            
                            <table cellpadding="20" cellspacing="0" width="100%">
                            
                                <tr>

                                
                                    <td width="50%" valign="top">
                                    
                                        <label for="name">Username</label><br />
                                        
                                        <input id="name" type="text" name="username" required="" />
                                        
                                        <br /><br />
                                        
                                        <label for="Password">Password</label><br />
                                        
                                        <input type="Password" id="Password" name="userpass" required="" />
                                    
                                    </td>
                                    
                                    <td width="50%" valign="top">
                                    
                                    
                                        
                                        <input type="submit" value="Log In" required="" />
                                    
                                    </td>
                                
                                </tr>
                            
                            </table>
                            
                        </form>  
       
           
           <footer>
              <?php include('footer.php');?> 

           </footer> 
       </div>
            
        </div>
        </div>
        </div>
    </body>

</html>