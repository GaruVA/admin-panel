<?php 
    session_start();
    if(isset($_SESSION['user_email'])) {
      header("Location: products.php");
      exit();
    }
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" href="img/1.png">
<title>Rent Hub | Sign Up</title>
<!-- Use the correct Bootstrap and Popper.js versions -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script> 
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<link rel="stylesheet" href="login.css">
<script src="https://kit.fontawesome.com/d5f76a1949.js" crossorigin="anonymous"></script>
</head>

<body>

<!-- navbar -->
<nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
    <div class="container">
      <a class="navbar-brand fs-4" href="#">
        <img src="icons/white.png" alt="" width="70">
      </a>
      <button class="navbar-toggler shadow-none border-0" type="button" data-bs-toggle="collapse"
        data-bs-target="#navbarID" aria-controls="navbarID" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarID">
        <ul class="navbar-nav mx-auto">
          <li class="nav-item"><a class="nav-link active nav-center" aria-current="page" href="index.html">Home</a></li>
          <li class="nav-item"><a class="nav-link nav-center" href="products.php">Products</a></li>
          <li class="nav-item"><a class="nav-link nav-center" href="#">About</a></li>
          <li class="nav-item"><a class="nav-link nav-center" href="Contact.html">Contact</a></li>
        </ul>
        <div class="nav-link nav-center right">
          <form action="products.php" method="get">
            <input type="search" name="search_product" placeholder="Search..." autocomplete="off">
          </form>
          <a href="cart.php" class="nav-icon">
            <i class="fa-solid fa-cart-shopping" style="color: #f4f0f0;"></i>
            <div class="cart-number">
              <?php
                $sql_select_cart = "SELECT * FROM `cart` WHERE ip_address='$ip_address';";
                $result_select_cart = mysqli_query($conn, $sql_select_cart);
                echo mysqli_num_rows($result_select_cart);
              ?>
            </div>
          </a>
          <a href="login.php" class="nav-icon"><i class="fa-solid fa-user" style="color: #f4f0f0;"></i></a>
        </div>
      </div>
    </div>
  </nav>

<!--Form-->
<section class="home">
  <div class="container">
    <div class="row" id="main">
      <div class="col-md-6" id="left">
        <img src="image/login.avif" alt="" width="100%" height="750px" style="border-radius: 5px;">
      </div>
      <div class="col-md-6" id="right">
        <h1>Sign Up</h1>
        <form action="" method="POST" enctype="multipart/form-data">
        <div class="half">
          <div class="input-field">
            <input type="text" name="user_firstname" id="user_firstname" placeholder=" " required="required">
            <label for="user_firstname">First Name</label>
          </div>
          <div class="input-field">
            <input type="text" name="user_lastname" id="user_lastname" placeholder=" " required="required">
            <label for="user_lastname">Last Name</label>
          </div>
          </div>
          <div class="input-field">
            <input type="email" name="user_email" id="user_email" placeholder=" " required="required">
            <label for="user_email">Email</label>
          </div>
          <div class="input-field">
            <input type="password" name="conf_user_password" id="conf_user_password" placeholder=" " required="required">
            <label for="conf_user_password">Password</label>
          </div>
          <div class="input-field">
            <input type="password" name="user_password" id="user_password" placeholder=" " required="required">
            <label for="user_password">Confirm Password</label>
          </div>
          <div class="input-field">
            <input type="text" name="user_address" id="user_address" placeholder=" " required="required">
            <label for="user_address">Address</label>
          </div>
          <div class="half">
          <div class="input-field">
            <input type="text" name="user_address_state" id="user_address_state" placeholder=" " required="required">
            <label for="user_address_state">State</label>
          </div>
          <div class="input-field">
          <input type="text" name="user_address_city" id="user_address_city" placeholder=" " required="required">
            <label for="user_address_city">City</label>
          </div>
          </div>
          <div class="input-field">
            <input type="text" name="user_contact" id="user_contact" placeholder=" " required="required">
            <label for="user_contact">Contact No</label>
          </div>
          <div class="button-area">
            <div class="row">
            <div class="col-md-6">
              <button type="submit" name="signup" value=" ">Sign Up</button>
            </div>
            <div class="mt-4 ">
               <p> Already have an account? <a href="login.php">Log In</a> </p>
              </div>
          </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</section><!--
<footer><div class="main">
  <div class="logo">
    <div class="item heading"><img src="icons/white.png" alt="" width="70"></div>
    <div class="item">Exploring new horizons, one destination at a time.</div>
  </div>
  <div class="support">
    <div class="item heading">SUPPORT</div>
    <div class="item"><a href="#" class="text-white" style="text-decoration: none;">Terms & Conditions</a></div>
    <div class="item"><a href="#" class="text-white" style="text-decoration: none;">Privacy</a></div>
    <div class="item"><a href="#" class="text-white" style="text-decoration: none;">Cookie Preferences</a></div>
  </div>
  <div class="contactus">
    <div class="item heading">CONTACT US</div>
    <div class="item"><i class="fas fa-home mr-3"></i> Padukka, Gallage Mawatha</div>
    <div class="item"><i class="fas fa-envelope mr-3"></i> renthub@gmail.com</div>
    <div class="item"><i class="fas fa-phone mr-3"></i> +94 11919903</div>
    <div class="item"><i class="fas fa-Location-arrow mr-3"></i> 203 Pitipana, Homagam</div>
  </div>
</div>
  <ul class="list-unstyled list-inline item">
    <li class="list-inline-item">
      <a href="#" class="btn-floating btn-sm text-white"><i class="fab fa-facebook"></i></a>
    </li>
    <li class="list-inline-item">
      <a href="#" class="btn-floating btn-sm text-white"><i class="fab fa-twitter"></i></a>
    </li>
    <li class="list-inline-item">
      <a href="#" class="btn-floating btn-sm text-white"><i class="fab fa-google"></i></a>
    </li>
    <li class="list-inline-item">
      <a href="#" class="btn-floating btn-sm text-white"><i class="fab fa-linkedin-in"></i></a>
    </li>
  </ul>
  <hr>
  <div class="text-center item">Copyright @2023 - All Rights Reserved by RentHub</div>
</footer>-->
</body>
</html>

<!--php code-->
<?php
if(isset($_POST['signup'])){
  $user_firstname = $_POST['user_firstname'];
  $user_lastname = $_POST['user_lastname'];
  $user_email = $_POST['user_email'];
  $user_password = $_POST['user_password'];
  $conf_user_password = $_POST['conf_user_password'];
  $user_password_hash = password_hash($conf_user_password, PASSWORD_DEFAULT);
  $user_address = $_POST['user_address'];
  $user_address_state = $_POST['user_address_state'];
  $user_address_city = $_POST['user_address_city'];
  $user_contact = $_POST['user_contact'];



  //select query
  $select_query="SELECT * FROM `users` WHERE user_email='$user_email'";
  $result=mysqli_query($conn,$select_query);
  $rows_count=mysqli_num_rows($result);
  if($rows_count>0){
    echo "<script>alert('Email already exist')</script>";
  }else if($user_password!=$conf_user_password){
    echo "<script>alert('Password does not match')</script>";
  }else{
    //insert_query
    $insert_query="INSERT INTO `users` (user_firstname,user_lastname,user_email,user_password,user_address,user_address_state,user_address_city,user_contact,user_ip,user_type) VALUES ('$user_firstname','$user_lastname','$user_email','$user_password_hash','$user_address','$user_address_state','$user_address_city','$user_contact','$ip_address','user')";
    $sql_execute=mysqli_query($conn,$insert_query);
    $_SESSION['user_email']=$user_email;
    echo "<script>alert('Signup Successful')</script>";
    $sql_select_cart="SELECT * FROM `cart` WHERE ip_address='$ip_address'";
    $result_select_cart=mysqli_query($conn,$sql_select_cart);
    if(mysqli_num_rows($result_select_cart) > 0){
      echo "<script>alert('You have items in your cart')</script>";
      echo "<script>window.open('cart.php','_self')</script>";
    }else{
      echo "<script>window.open('products.php', '_self')</script>";
    }
  }
}

?> 