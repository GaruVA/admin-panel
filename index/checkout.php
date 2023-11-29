<?php 
    session_start();
    if(!isset($_SESSION['user_name'])) {
      include('login.php');
    } else {
      include('payment.php');
    }
    /*
    session_unset();
    session_destroy();
    */
?>