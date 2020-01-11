<?php
    session_start();
    session_destroy();

    setcookie('user','etc',time()-7200);

    header("location: main_login.php");
    ?>
