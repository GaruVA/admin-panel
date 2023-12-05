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
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="image/white.png">
  <title>RentHub</title>
  <!-- Use the correct Bootstrap and Popper.js versions -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
  <link rel="stylesheet" href="checkout.css">
  <script src="https://kit.fontawesome.com/d5f76a1949.js" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
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
                $sql_select_cart = "SELECT * FROM `renthub_cart` WHERE ip_address='$ip_address';";
                $result_select_cart = mysqli_query($conn, $sql_select_cart);
                echo mysqli_num_rows($result_select_cart);
              ?>
            </div>
          </a>
          <a href='user_area/index.php' class='nav-icon'><i class="fa-solid fa-user" style="color: #f4f0f0;"></i></a>
        </div>
      </div>
    </div>
  </nav>

  <!------------>

  <section class="home">
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
            <div class="row" id="main">
              <table>
                <thead>
                  <tr>
                      <th>Product</th>
                      <th>Quantity</th>
                      <th>Price</th>
                  </tr>
                </thead>
                <tbody>
                    <?php
                        $total_price = 0;

                        $cart_query = "SELECT * FROM `renthub_cart` WHERE ip_address = '$ip_address'";
                        $result = mysqli_query($conn, $cart_query);

                        while ($row = mysqli_fetch_assoc($result)) {
                          $product_id = $row['product_id'];
                          $quantity = $row['quantity'];

                          $product_query = "SELECT * FROM `renthub_products` WHERE product_id = '$product_id'";
                          $result_product = mysqli_query($conn, $product_query);
                          $row_product = mysqli_fetch_assoc($result_product);
                          $product_name = $row_product['product_name'];
                          $product_image = $row_product['product_image'];
                          $product_price = $row_product['product_price'];
                          $product_price_quantity = $product_price * $quantity;
                          $total_price += $product_price_quantity;
                        

                          echo "<tr>
                                  <td>$product_name</td>
                                  <td>$quantity</td>
                                  <td>Rs. $product_price_quantity</td>
                                </tr>";
                        }	
                    ?>
                </tbody>
              </table>
            </div>
            <div id="main2">
              <div class="heading">DELIVER TO</div>
                <ul class="details">
                  <?php
                    $user_ip=getIPAddress();
                    $sql_select_user="SELECT * FROM `renthub_users` WHERE user_ip='$user_ip'";
                    $result_select_user = mysqli_query($conn, $sql_select_user);
                    $row_select_user = mysqli_fetch_assoc($result_select_user);
                    $user_firstname = $row_select_user["user_firstname"]; 
                    $user_lastname = $row_select_user["user_lastname"]; 
                    $user_contact = $row_select_user["user_contact"];
                    $user_address = $row_select_user["user_address"];
                    $user_address_city = $row_select_user["user_address_city"];
                    $user_address_state = $row_select_user["user_address_state"];
                  ?>
                </ul>
                <form action="orders.php" method="post">
                  <div class="row mb-3 mt-3">
                      <div class="col-md-6">
                          <label for="firstname" class="form-label">First Name:</label>
                          <input type="text" id="firstname" name="delivery_firstname" value="<?php echo $user_firstname;?>" class="form-control" required>
                      </div>

                      <div class="col-md-6">
                          <label for="lastname" class="form-label">Last Name:</label>
                          <input type="lastname" id="price" name="delivery_lastname" value="<?php echo $user_lastname;?>" class="form-control" required>
                      </div>
                  </div>

                  <div class="mb-3">
                      <label for="address" class="form-label">Address:</label>
                      <input type="text" id="address" name="delivery_address" value="<?php echo $user_address;?>" class="form-control" required>
                  </div>

                  <div class="row mb-3">
                      <div class="col-md-6">
                          <label for="addressstate" class="form-label">State:</label>
                          <input type="text" id="addressstate" name="delivery_address_state" value="<?php echo $user_address_state;?>" class="form-control" required>
                      </div>

                      <div class="col-md-6">
                          <label for="addresscity" class="form-label">City:</label>
                          <input type="text" id="addresscity" name="delivery_address_city" value="<?php echo $user_address_city;?>" class="form-control" required>
                      </div>
                  </div>

                  <div class="mb-3">
                      <label for="contact" class="form-label">Contact No:</label>
                      <input type="text" id="contact" name="delivery_contact" value="<?php echo $user_contact;?>" class="form-control" required>
                  </div>
                  <input type="submit" id="submit-form" name="submit" value="submit" style="display: none"/>
              </form>
            </div>
          </div>
          <div class="col-lg-4">
            
            <div class="bottom">
              <div class="right">
              <div class="price-container">
                  Sub Total:
                  <div class="price">Rs.
                      <?php
                          echo $total_price;
                      ?>
                    </div>
                </div>
                <div class="price-container">
                  Shipping: 
                  <div class="price">Rs. 
                    <?php
                      $shipping = 300;
                      echo $shipping;
                    ?> 
                  </div>
                </div>
                <div class="price-container">
                  Total: 
                  <div class="price">Rs. <?php echo $total_price+$shipping;?> </div>
                </div>
                <div class="buttons">
                  <a href="https://www.paypal.com" class="btn btn-custom">Pay Now</a>
                  <label for="submit-form" tabindex="0" class="btn btn-custom">Cash on Delivery</label>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>  
    </div>
  </section>

  <!-- Footer -->

  <footer class="footerbg text-white pt-5 pb-4">
    <div class="container text-center text-md-left">
      <div class="row text-center text-md-left">

        <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
          <h5 class="text-uppercase mb-4 mr-3 font-weight-bold">
            <img src="icons/white.png" alt="" width="70">
          </h5>
          <p>Exploring new horizons, one destination at a time.</p>

        </div>

        <div class="col-md-2 col-lg-2 col-xl-3 mx-auto mt-3">
          <h5 class="text-uppercase mb-4 font-weight-bold"><b>Support</b></h5>
          <p>
            <a href="#" class="text-white" style="text-decoration: none;">Terms & Conditions</a>
          </p>
          <p>
            <a href="#" class="text-white" style="text-decoration: none;">Privacy</a>
          </p>
          <p>
            <a href="#" class="text-white" style="text-decoration: none;">Cookie Preferences</a>
          </p>
        </div>

        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
          <h5 class="text-uppercase mb-4 font-weight-bold"><b>Contact Us</b></h5>
          <p>
            <i class="fas fa-home mr-3"></i> Padukka, Gallage Mawatha
          </p>
          <p>
            <i class="fas fa-envelope mr-3"></i> renthub@gmail.com
          </p>
          <p>
            <i class="fas fa-phone mr-3"></i> +94 11919903
          </p>
          <p>
            <i class="fas fa-Location-arrow mr-3"></i> 203 Pitipana, Homagama
          </p>
        </div>
      </div>
      <ul class="list-unstyled list-inline">
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
    </div>
    <hr class="mb-4">

    <p class="text-center">Copyright @2023 - All Rights Reserved by RentHub</p>

  </footer>
</body>
</html>
