<?php
    session_start();
    if(!isset($_SESSION['user_email'])) {
      header("Location: login.php");
      exit();
    }
    /*
    session_unset();
    session_destroy();
    */

    include("admin_panel/includes/connection.php");

    function getIPAddress() {  
       if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
                  $ip = $_SERVER['HTTP_CLIENT_IP'];  
          }  

      elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
                  $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
       }  
      else{  
               $ip = $_SERVER['REMOTE_ADDR'];  
       }  
       return $ip;  
    } 
    $ip_address = getIPAddress();

    $sql_select_user = "SELECT * FROM `renthub_users` WHERE user_ip = '$ip_address'";
    $result_select_user = mysqli_query($conn, $sql_select_user);
    $row_select_user= mysqli_fetch_assoc($result_select_user);
    $user_id = $row_select_user["user_id"];


    $total_price = 0;

    $cart_query = "SELECT * FROM `renthub_cart` WHERE ip_address = '$ip_address'";
    $result = mysqli_query($conn, $cart_query);

    while ($row = mysqli_fetch_assoc($result)) {
      $product_id = $row['product_id'];
      $quantity = $row['quantity'];

      $product_query = "SELECT product_price FROM `renthub_products` WHERE product_id = '$product_id'";
      $result_product = mysqli_query($conn, $product_query);
      $row_product_price = mysqli_fetch_assoc($result_product);
      $total_price += $row_product_price['product_price'] * $quantity;
    }	

    $order_invoice = mt_rand();
    $order_status = "pending";
    $order_amount= $total_price;
    $order_payment = "false";

    $sql_insert_order = "INSERT INTO `renthub_orders` (user_id,order_invoice,order_status,order_amount,order_payment,order_date) VALUES ($user_id,$order_invoice,'$order_status',$order_amount,'$order_payment',NOW());";
    $result_insert_order = mysqli_query($conn, $sql_insert_order);
    $sql_delete_cart="DELETE FROM `renthub_cart` WHERE ip_address='$ip_address';";
    $result_delete_cart= mysqli_query($conn, $sql_delete_cart);
    echo "<script>alert('Order is submited Successfully')</script>";

    if(isset($_POST['submit'])){
      $firstname= $_POST['delivery_firstname'];
      $lastname= $_POST['delivery_lastname'];
      $address= $_POST['delivery_address'];
      $city= $_POST['delivery_address_city'];
      $state= $_POST['delivery_address_state'];
      $contact = $_POST['delivery_contact'];
      $sql_select_order = "SELECT  * FROM `renthub_orders` WHERE order_invoice=$order_invoice && user_id=$user_id;";
      $result_select_order = mysqli_query($conn, $sql_select_order);
      $row_select_order = mysqli_fetch_assoc($result_select_order);
      $order_id = $row_select_order["order_id"];
      $sql_insert_delivery = "INSERT INTO `renthub_delivery` (order_id,delivery_firstname,delivery_lastname,delivery_address,delivery_address_city,delivery_address_state,delivery_contact) VALUES ($order_id,'$firstname','$lastname','$address','$city','$state','$contact');";
      $result_update = mysqli_query($conn, $sql_insert_delivery);
    }
    echo "<script>window.location.href = 'index.php'</script>";
?>
