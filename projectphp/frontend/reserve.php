<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

          
// Get the title of the book we're reserving (from the URL)
            $reservedmovie = urldecode($_GET['reservation']);
            session_start();
            if (!isset($_SESSION['reservedmovielist']))
                $reservedmovielist = "";
            else
                $reservedmovielist = $_SESSION['reservedmovielist'];
// The list is maintained as a single string
// with the titles separated by slashes
            $reservedmovielist = $reservedmovielist . "/" . $reservedmovie;
            $_SESSION['reservedmovielist'] = $reservedmovielist;
            
            
            
            echo "Thank you.<br>\"$reservedmovie\" has been added to your reservation list";
            echo "<br><a href=index.php>Return to home page</a>";
            ?>