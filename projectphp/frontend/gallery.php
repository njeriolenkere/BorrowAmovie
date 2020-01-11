
<?php

/* session Hijackings
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

#first measurement is to change the settings in phpini which is not usually touched
#we change the 'session.cookie_httponly' to true, saying that the cookie can only be accessed via PHP
#this will prevent any Javascript attacks getting the cookie
ini_set('session.cookie_httponly', true);//only acceptrequest comming from HTTP, value is a bool(true or false)


#starts the sessions
session_start ();

#the second way of checking is matching the initial user to the session
#we do this by checking the 1§IP of the user that "made the session" and using it to check if it is
#truley him who is accessing the website/session.
#for this we simply use the global $_SERVER['REMOTE_ADDR']; to get the IP and then we check

if (isset($_SESSION['userip']) === false){//check if userIP is same or if its foregn
    
    #here we store the IP into the session 'userip'
    $_SESSION['userip'] = $_SERVER['REMOTE_ADDR'];//if user id is not set..remoteAddress
}

#now we check if the IP where the session is generated is the same as the IP of the current user

if ($_SESSION['userip'] !== $_SERVER['REMOTE_ADDR']){//IF session is not true to server just unset the session/destroy
    #if it is not the same, we just remove all session variables
    #this way the attacker will have no session
    session_unset(); //why do we unset and destroy?? why not just destroy or 
    session_destroy();
    
}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

#print_r($_FILES['upload']);
/*
 * The global $_FILES will contain all the uploaded file information. 
 * Its contents from the example form is as follows. Note that this assumes
 * the use of the file upload name userfile, as used in the example script above. 
 * This can be any name.
 * 
 * $_FILES['userfile']['name']
The original name of the file on the client machine.

$_FILES['userfile']['type']
The mime type of the file, if the browser provided this information. An example would be "image/gif". This mime type is however not checked on the PHP side and therefore don't take its value for granted.

$_FILES['userfile']['size']
The size, in bytes, of the uploaded file.

$_FILES['userfile']['tmp_name']
The temporary filename of the file in which the uploaded file was stored on the server.

$_FILES['userfile']['error']
The error code associated with this file upload.
 * 
 * 
 * Note:
Be sure your file upload form has attribute enctype="multipart/form-data" otherwise the file upload will not work.
 * 
 * 
 */

#important to only allow upload for files that don't affect your PHP code. (or only those files you need)
#after the user uploads the file, we basically run a few checks:

if (isset($_FILES['upload'])){
    //make an array list of files allowed.
    
    $allowedextensions = array('jpg', 'jpeg', 'gif', 'png');
    
    #now if the user uplaoded an allowed format, we want to know what format that was
    #the following variable will store the extension, all in lower-case
    #substr() is a function that takes only a portion of a string - we need only what comes after the dot
    #we need to get everything after the LAST dot, looking for the extension
    #strrpos returns the position of the last occurrence of a substring in a string
    #we use the file name and a dot to find the extension: strrpos($_FILES['upload']['name'], '.')
    #but we also need to add one space to ignore the dot, so we write +1 at the end.
    #strtolower function changes all capital letters to lower-string so JPG becomes jpg and it fits your whitelist
    #you should take the entire string and put it in 'strtolower'
    $extension = strtolower(substr($_FILES['upload']['name'], strrpos($_FILES['upload']['name'], '.') + 1));//string is name o file.Need to know what string you are looking for. start is afer dot. haysak is banch of data,
 //neddle is what you looking for.+1 skip the dot
//strtolower($string)//make string lower case
//substr($string, $start)//return a part of the string//take the dot and everything after it
//strpos($haystack, $allowextensions)//string's position// move after the dot and take it
#test by echoing out what you upload
    
    #test by echoing out what you upload
   
    
    #we create an array called 'error' to store all our errors, so we can later use them.
    $error = array ();//save all the errors commited(Strage)
    
    #here we do our first check, we basically want it to pass so we can upload.
    #if it does not pass, then we give an error.
    #we say, check to see if "externsions" can be found in our array "allowedextensions"
    #if the extension is NOT in the array, we return the error message (we actually add it into the array)
    if(in_array($extension, $allowedextensions) === false){//if exension is not allowed, exibit error.
        
        #add a new array entry thats gonna hold erros
        $error[] = 'This is not an image, upload is allowed only for images.';        
    }
    
    #it is also good to think about the size of the file you want to accept.
    #this is for images, so how big of an image would you like to accept?
    #this is in bytes, and 1000000 is actually 1 mb which is now our limit
    if($_FILES['upload']['size'] > 1000000){
        
        $error[]='The file exceeded the upload limit';
    }
    
    
    #now you do the 'final check' to see if there are no errors in the array.
    #if they array is empty = no errors have been written in it.
    #if there is something in the array 'errors' that means an error has occured and we should not upload
    
    if(empty($error)){//if its empty, do nothing#We check for errors that might disturb our code, and try to avoid them
        #if there are no errrors move the file to the desired file location?????
        
        
        #this is our starding point, in order to upload we need to move the file (uploaded file)
        #all the way to the location we want to store it.
        #But, before we do so it will be good to do all of the ABOVE written first
        #We check for errors that might disturb our code, and try to avoid them
        #if there are no errrors move the file to the desired file location
        move_uploaded_file($_FILES['upload']['tmp_name'], "uploadedfiles/{$_FILES['upload']['name']}");     
    } //$_FILES is global.'tperarary nema as it uploadsname' of the uploaded picture
   //move_upload if its empty
    
}


?>


<html>
    <head>
        <title>Upload</title>
 
        
        <meta charset="utf-8"/>
        <link rel="stylesheet" type="text/css" href="Lab4.css"/>
           </head>
            <div id="wrap">
            
            <?php include('header.php');
            include('config4.php');
            ?>
           <body>
               <div>
                   <?php 
                   //in the array[error check]
                   #Now we want to either upload the file or type an error
                   #what we do is basically  check if there's an array named 'error'
                   #and we check if it's empty. If it's empty that means no errors we found
                   #we should proceed with the upload.
                   if (isset($error)){
                       if (empty($error)){
                           
                           #here we give the user the chance to check the file right away. 
                           #this is just for testing purposes so we can see the file is there
                           #when the user clicks, it will open the folder "uploadedfiles" and look for filename
                         //files we uploaded and name
                           
                       } else {
                           #else, if there was an error, then it simply goes through the error array
                           #it prints out ALL errors in the array.
                           #you can have one or more errors. 
                           #e.g. File too big, AND not supported!
                           foreach ($error as $err){
                               echo $err;
                           }
                           
                       }
                   }
                   
                   ?>
               </div>
             <div class="lid">  
              <div>
                 <p  class="last"> </p>
                   
                   <form class="submit" action="" method="POST" enctype="multipart/form-data">
                       <input type="file" name="upload" /></br>
                       <input  type="submit" value="submit" />
                   </form>   

                    </td>
                </div> 
                      
                <p  class="last"> </p>
                <h4>Uploaded Pictures</h4>

    
           <!-- start gallery header --> <?php
   // Set a variable with the name of the gallery directory
   $galleryDir = 'uploadedfiles/';
   // Search the gallery directory for images
   foreach(glob("$galleryDir{*.jpg,*.gif,*.png,*.tif,*.jpeg}", GLOB_BRACE) as $photo) {
     // Loop this code for each image
     // Explode the image name (currently 'gallery/image.jpg') at '/'
     $imgName = explode("/", $photo);
     // Get the last part of the exploded image name (now 'image.jpg')
     $imgName = end($imgName);
     // Generate the HTML code to display each image in a grid
     
     echo "<a href='$photo' title='$imgName'>";
     echo "<div style='float:left; border:1px solid black; width:100px; height:120px; padding:10px; margin:10px; text-align:center;'>";
     echo "<img src='$photo' style='max-height:100px; max-width:100px;'><br><span>$imgName</span>";
     echo "</div>";
     echo "</a>";
   }
   ?>
              
                <footer>
              <?php include('footer.php');?> 

           </footer>                      
                                                
               </div>
           </body>
    
    
    
    
</html>
 