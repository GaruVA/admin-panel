<?php 
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
  <link rel="stylesheet" href="cart.css">
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
          <a href="#" class="nav-icon"><i class="fa-solid fa-user" style="color: #f4f0f0;"></i></a>
        </div>
      </div>
    </div>
  </nav>

  <!------------>

  <section class="home">
      <div class="container">
        <div class="row" id="main">
      <table>
    <thead>
        <tr>
            <th>Product</th>
            <th>Quantity</th>
            <th>Price</th>
            <th style="text-align: center">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $total_price = 0;

            $cart_query = "SELECT * FROM cart WHERE ip_address = '$ip_address'";
            $result = mysqli_query($conn, $cart_query);

            while ($row = mysqli_fetch_assoc($result)) {
              $product_id = $row['product_id'];
              $quantity = $row['quantity'];

              $product_query = "SELECT * FROM products WHERE product_id = '$product_id'";
              $result_product = mysqli_query($conn, $product_query);
              $row_product = mysqli_fetch_assoc($result_product);
              $product_name = $row_product['product_name'];
              $product_image = $row_product['product_image'];
              $product_price = $row_product['product_price'];
              $product_price_quantity = $product_price * $quantity;
            

              echo "<tr>
                      <td><img src='admin_panel/includes/product_images/$product_image' alt='$product_name' height='40px'>&nbsp;&nbsp;&nbsp;$product_name</td>
                      <td>
                      <form>
                      <button type='submit' name='cart' value='$product_id' onclick='decrementQuantity($product_id)'>-</button>
                      <input type='number' id='$product_id' name='quantity' min='1' value=$quantity>
                      <button type='submit' name='cart' value='$product_id' onclick='incrementQuantity($product_id)'>+</button>
                      </form>
                      </td>
                      <td>$$product_price_quantity</td>
                      <td>
                          <div class='dropdown'>
                              <a class='nav-link dropdown-toggle nav-center' href='#' id='navbarDarkDropdownMenuLink' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
                                  <i class='bx bx-dots-horizontal-rounded'></i>
                              </a>
                              <div class='dropdown-menu' aria-labelledby='navbarDarkDropdownMenuLink'>
                                  <a class='dropdown-item' href='#'>Edit</a>
                                  <a class='dropdown-item' href='cart.php?delete=$product_id'>Delete</a>
                              </div>
                          </div>
                      </td>
                    </tr>";
            }	

            if(isset($_GET['cart']) && isset($_GET['quantity'])) {
                $product_id = $_GET['cart'];
                $quantity = $_GET['quantity'];
                $sql_update_cart = "UPDATE `cart` SET quantity=$quantity WHERE ip_address='$ip_address' AND product_id=$product_id;";
                $result_update_cart = mysqli_query($conn, $sql_update_cart);
                echo "<script>window.location.href = 'cart.php';</script>";
                exit;
            }

            if(isset($_GET['delete'])) {
              $product_id = $_GET['delete'];
              $sql_delete_cart = "DELETE FROM `cart` WHERE ip_address = '$ip_address' AND product_id = $product_id;";
              $result_update_cart = mysqli_query($conn, $sql_delete_cart);
              echo "<script>window.location.href = 'cart.php';</script>";
              exit;
          }

        ?>
        
        <tr>
            <td style="text-align: left"><a href="products.php"><i class="fa-solid fa-arrow-left"></i> Continue Shopping</a></td>
            <td colspan=3 style="text-align: right">
              Total:
              <div class="price">$
                  <?php
                      $total_price = 0;

                      $cart_query = "SELECT * FROM cart WHERE ip_address = '$ip_address'";
                      $result = mysqli_query($conn, $cart_query);

                      while ($row = mysqli_fetch_assoc($result)) {
                        $product_id = $row['product_id'];
                        $quantity = $row['quantity'];

                        $product_query = "SELECT product_price FROM products WHERE product_id = '$product_id'";
                        $result_product = mysqli_query($conn, $product_query);
                        $row_product_price = mysqli_fetch_assoc($result_product);
                        $total_price += $row_product_price['product_price'] * $quantity;
                      }	

                      echo $total_price;
                  ?>
              </div>
              <a href="products.php" class="btn btn-custom" style="color: #f4f0f0"><i class="fa-solid fa-cart-shopping" style="color: #f4f0f0;"></i> Checkout</a>
          </td>
        </tr>
    </tbody>
</table>
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


  <script>
        function incrementQuantity(inputId) {
            document.getElementById(inputId).stepUp();
        }

        function decrementQuantity(inputId) {
            document.getElementById(inputId).stepDown();
        }

  </script>
</body>

</html>