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
  <link rel="stylesheet" href="Products.css">
  <script src="https://kit.fontawesome.com/d5f76a1949.js" crossorigin="anonymous"></script>
</head>

<body>

  <!-- navbar -->

  <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
    <div class="container">
      <div class="row">
      <div class="col-xl-12">
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
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle nav-center" href="#" id="navbarDarkDropdownMenuLink" role="button"
              data-bs-toggle="dropdown" aria-expanded="false">
              Category
            </a>
            <div class="dropdown-menu">
              <?php
                  include("admin_panel/includes/connection.php");

                  $sql_select_categories = "SELECT * FROM `categories`;";
                  $result_categories = mysqli_query($conn, $sql_select_categories);

                  if (mysqli_num_rows($result_categories) > 0) {
                      while ($category = mysqli_fetch_assoc($result_categories)) {
                          $category_id = $category['category_id'];
                          $category_name = $category['category_name'];

                          echo "<a class='dropdown-item' href='#'>$category_name</a>";
                      }
                  }
              ?>
            </div>
          </li>
          <li class="nav-item"><a class="nav-link nav-center" href="#">About</a></li>
          <li class="nav-item"><a class="nav-link nav-center" href="Contact.html">Contact</a></li>
        </ul>
        <div class="nav-link nav-center">

          <from action="">
            <input type="search" placeholder="Search...">
          </from>
          <a class="nav-icon"><i class="far fa-user" style="color: #f4f0f0;"></i></a>

        </div>
      </div>
      </div>
      <div class="col-xl-12">
      <div class="collapse navbar-collapse" id="navbarID">
        <ul class="navbar-nav mx-auto">
        <?php
            include("admin_panel/includes/connection.php");

            $sql_select_categories = "SELECT * FROM `categories`;";
            $result_categories = mysqli_query($conn, $sql_select_categories);

            if (mysqli_num_rows($result_categories) > 0) {
                while ($category = mysqli_fetch_assoc($result_categories)) {
                    $category_id = $category['category_id'];
                    $category_name = $category['category_name'];

                    echo "<li class='nav-item'><a class='nav-link nav-center' href='#'>$category_name</a></li>";
                }
            }
        ?>
        </ul>
      </div>
      </div>
      </div>
    </div>
    
  </nav>
  

  <!------------>

  <div class="products">
  <div class = "container">
        <div class = "row">
            <div class="col text-center my-4">
            <h1 class="toprate text-center"><b>P R O D U C T &nbsp;&nbsp; C A T E G O R Y</b></h1>
            </div>
        </div>
        <div class="row g-4 logo">
          <?php
            include("admin_panel/includes/connection.php");

            $sql_select_products = "SELECT * FROM `products` order by rand();";
            $result_products = mysqli_query($conn, $sql_select_products);

            if (mysqli_num_rows($result_products) > 0) {
                while ($product = mysqli_fetch_assoc($result_products)) {
                    $product_id = $product['product_id'];
                    $product_name = $product['product_name'];
                    $product_image = $product['product_image1'];
                    $product_price = $product['product_price'];
                    $product_status = $product['status'];
                    $product_desc= $product['product_desc'];

                    echo "
                        <div class='col-md-3 logos'>
                          <div class='card'>
                            <img src='admin_panel/includes/product_images/$product_image' alt='$product_name'>
                            <div class='card-body'>
                              <h5 class='card-title'><b>$product_name</b></h5>
                              <p class='card-text'><i>$product_desc</i></p>
                                  <a href='#' class='btn btn-primary'>Add to Cart</a>
                              <a href='#' class='btn btn-secondary'>View More</a>
                              
                            </div>
                          </div>
                        </div>";
                }
            }
          ?>
    </div>
  </div>
  </div>

  <!------------------------------------------------>

  

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
            <i class="fas fa-Location-arrow mr-3"></i> 203 Pitipana, Homagam
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


  <script src="Camera.js"></script>
</body>

</html>