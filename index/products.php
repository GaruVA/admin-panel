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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
  <link rel="stylesheet" href="products.css">
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
          <li class="nav-item"><a class="nav-link active nav-center" aria-current="page" href="#">Home</a></li>
          <li class="nav-item"><a class="nav-link nav-center" href="#">Products</a></li>
          <li class="nav-item"><a class="nav-link nav-center" href="#">About</a></li>
          <li class="nav-item"><a class="nav-link nav-center" href="Contact.html">Contact</a></li>
        </ul>
        <div class="nav-link nav-center right">
          <form action="" method="get">
            <input type="search" name="search_product" placeholder="Search..." autocomplete="off">
          </form>
          <a href="cart.php" class="nav-icon">
            <i class="fa-solid fa-cart-shopping" style="color: #f4f0f0;"></i>
            <div class="cart-number">
              <?php
                $ip_address = getIPAddress();
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
  <nav class="navbar navbar-expand navbar-dark navbar-custom fixed-top nav-categories">
    <div class="container">
      <div class="collapse navbar-collapse">
        <ul class="navbar-nav mx-auto">
        <li class='nav-item'><a class='nav-link nav-center' href='products.php'>All</a></li>
          <?php
              $sql_select_categories = "SELECT * FROM `categories`;";
              $result_categories = mysqli_query($conn, $sql_select_categories);

              if (mysqli_num_rows($result_categories) > 0) {
                  while ($category = mysqli_fetch_assoc($result_categories)) {
                      $category_id = $category['category_id'];
                      $category_name = $category['category_name'];

                      echo "<li class='nav-item'><a class='nav-link nav-center' href='products.php?category=$category_id'>$category_name</a></li>";
                  }
              }
          ?>
        </ul>
      </div>
    </div>
  </nav>

  <!------------>

  <div class="products">
  <div class = "container">
            <?php
              include("admin_panel/includes/connection.php");
              if(!isset($_GET["category"]) && !isset($_GET["search_product"])){
                $sql_select_categories = "SELECT * FROM `categories`;";
                $result_categories = mysqli_query($conn, $sql_select_categories);

                if (mysqli_num_rows($result_categories) > 0) {
                    while ($category = mysqli_fetch_assoc($result_categories)) {
                        $category_id = $category['category_id'];
                        $category_name = $category['category_name'];

                        
                        $sql_select_products = "SELECT * FROM `products` WHERE category_id=$category_id;";
                        $result_products = mysqli_query($conn, $sql_select_products);

                        if (mysqli_num_rows($result_products) > 0) {
                          echo "<h1 class='h1 text-center text-dark pageHeaderTitle'>$category_name</h1>";
                          while ($product = mysqli_fetch_assoc($result_products)) {
                              $product_id = $product['product_id'];
                              $product_name = $product['product_name'];
                              $product_image = $product['product_image'];
                              $product_price = $product['product_price'];
                              $product_desc = $product['product_desc'];
                              $product_status = $product['status'];
          
                              echo "<article class='card dark blue'>
                              <a class='card__img_link' href='#'>
                                  <img class='card__img' src='admin_panel/includes/product_images/$product_image' alt=$product_name />
                              </a>
                              <div class='card__text'>
                                  <h1 class='card__title blue'><a href='#'>$product_name</a></h1>
                                  
                                  <div class='card__bar'></div>
                                  <div class='card__preview-txt'>$product_desc</div>
                                  <ul class='card__tagbox'>
                                      <li class='tag__item'><i class='fas fa-tag mr-2'></i>$$product_price/hr</li>
                                      <li class='tag__item'>
                                      <button onclick='decrementQuantity($product_id)'>-</button>
                                      <form>
                                      <input type='submit' id='submit$product_id' name='cart' value='$product_id' style='display: none'>
                                      <input type='number' id='$product_id' name='quantity' min='1' value='1'>
                                      </form>
                                      <button onclick='incrementQuantity($product_id)'>+</button>
                                      <li class='tag__item play blue'>
                                          <label for='submit$product_id'><i class='fa-solid fa-cart-shopping'></i> Add to cart</label>
                                      </li>
                                  </ul>
                              </div>
                          </article>";
                          }
                      }
                    }
                }
              } elseif(isset($_GET["category"])) {
                $category_id = $_GET["category"];
                $sql_select_categories = "SELECT * FROM `categories` WHERE category_id=$category_id;";
                $sql_select_products = "SELECT * FROM `products` WHERE category_id=$category_id;";
                $result_products = mysqli_query($conn, $sql_select_products);
                $result_categories = mysqli_query($conn, $sql_select_categories);

                if (mysqli_num_rows($result_products) > 0) {
                  $category = mysqli_fetch_assoc($result_categories);
                  $category_name = $category["category_name"];
                  echo "<h1 class='h1 text-center text-dark pageHeaderTitle'>$category_name</h1>";
                  while ($product = mysqli_fetch_assoc($result_products)) {
                      $product_id = $product['product_id'];
                      $product_name = $product['product_name'];
                      $product_image = $product['product_image'];
                      $product_price = $product['product_price'];
                      $product_desc = $product['product_desc'];
                      $product_status = $product['status'];
  
                      echo "<article class='card dark blue'>
                      <a class='card__img_link' href='#'>
                          <img class='card__img' src='admin_panel/includes/product_images/$product_image' alt=$product_name />
                      </a>
                      <div class='card__text'>
                          <h1 class='card__title blue'><a href='#'>$product_name</a></h1>
                          
                          <div class='card__bar'></div>
                          <div class='card__preview-txt'>$product_desc</div>
                          <ul class='card__tagbox'>
                              <li class='tag__item'><i class='fas fa-tag mr-2'></i>$$product_price/hr</li>
                              <li class='tag__item'>
                              <button onclick='decrementQuantity($product_id)'>-</button>
                              <form>
                              <input type='submit' id='submit$product_id' name='cart' value='$product_id' style='display: none'>
                              <input type='number' id='$product_id' name='quantity' min='1' value='1'>
                              </form>
                              <button onclick='incrementQuantity($product_id)'>+</button>
                              <li class='tag__item play blue'>
                                  <label for='submit$product_id'><i class='fa-solid fa-cart-shopping'></i> Add to cart</label>
                              </li>
                          </ul>
                      </div>
                  </article>";
                  }
              }
              } elseif(isset($_GET["search_product"])) {
                $search_product = $_GET["search_product"];
                $sql_select_products = "SELECT * FROM `products` WHERE product_keywords like '%$search_product%';";
                $result_products = mysqli_query($conn, $sql_select_products);

                if (mysqli_num_rows($result_products) > 0) {
                  echo "<h1 class='h1 text-center text-dark pageHeaderTitle'>Searched for: $search_product</h1>";
                  while ($product = mysqli_fetch_assoc($result_products)) {
                      $product_id = $product['product_id'];
                      $product_name = $product['product_name'];
                      $product_image = $product['product_image'];
                      $product_price = $product['product_price'];
                      $product_desc = $product['product_desc'];
                      $product_status = $product['status'];
  
                      echo "<article class='card dark blue'>
                      <a class='card__img_link' href='#'>
                          <img class='card__img' src='admin_panel/includes/product_images/$product_image' alt=$product_name />
                      </a>
                      <div class='card__text'>
                          <h1 class='card__title blue'><a href='#'>$product_name</a></h1>
                          
                          <div class='card__bar'></div>
                          <div class='card__preview-txt'>$product_desc</div>
                          <ul class='card__tagbox'>
                              <li class='tag__item'><i class='fas fa-tag mr-2'></i>$$product_price/hr</li>
                              <li class='tag__item'>
                              <button onclick='decrementQuantity($product_id)'>-</button>
                              <form>
                              <input type='submit' id='submit$product_id' name='cart' value='$product_id' style='display: none'>
                              <input type='number' id='$product_id' name='quantity' min='1' value='1'>
                              </form>
                              <button onclick='incrementQuantity($product_id)'>+</button>
                              <li class='tag__item play blue'>
                                  <label for='submit$product_id'><i class='fa-solid fa-cart-shopping'></i> Add to cart</label>
                              </li>
                          </ul>
                      </div>
                  </article>";
                  }
                }
              }  
              
              if(isset($_GET['cart']) && isset($_GET['quantity'])) {
                $ip_address = getIPAddress();
                $product_id = $_GET['cart'];
                $quantity = $_GET['quantity'];
                $sql_select_cart = "SELECT * FROM `cart` WHERE ip_address='$ip_address' AND product_id=$product_id;";
                $result_select_cart = mysqli_query($conn, $sql_select_cart);
        
                if (mysqli_num_rows($result_select_cart) > 0) {
                    $cart = mysqli_fetch_assoc($result_select_cart);
                    $cart_quantity = $cart["quantity"];
                    $new_quantity = $cart_quantity + $quantity;
                    $sql_update_cart = "UPDATE `cart` SET quantity=$new_quantity WHERE ip_address='$ip_address' AND product_id=$product_id;";
                    $result_update_cart = mysqli_query($conn, $sql_update_cart);
                } else {
                    $sql_insert_cart = "INSERT INTO `cart` (product_id,ip_address,quantity) VALUES ($product_id,'$ip_address',$quantity);";
                    $result_insert_cart = mysqli_query($conn, $sql_insert_cart);
                }
        
                $referrer = $_SERVER['HTTP_REFERER'];
        
                echo "<script>window.location.href = '$referrer';</script>";
                exit;
            }
            ?> 
  </div>
  </div>

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