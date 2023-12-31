<?php
    session_start();
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
  <link rel="icon" href="icons/white.png">
  <title>RentHub | Home</title>
  <!-- Use the correct Bootstrap and Popper.js versions -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
  <link rel="stylesheet" href="index.css">
  <script src="https://kit.fontawesome.com/d5f76a1949.js" crossorigin="anonymous"></script>
</head>

<body>

  <!-- navbar -->

  <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
    <div class="container">
      <a class="navbar-brand fs-4" href="index.php">
        <img src="icons/white.png" alt="" width="70">
      </a>
      <button class="navbar-toggler shadow-none border-0" type="button" data-bs-toggle="collapse"
        data-bs-target="#navbarID" aria-controls="navbarID" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarID">
        <ul class="navbar-nav mx-auto">
          <li class="nav-item"><a class="nav-link active nav-center" aria-current="page" href="index.php">Home</a></li>
          <li class="nav-item"><a class="nav-link nav-center" href="products.php">Products</a></li>
          <li class="nav-item"><a class="nav-link nav-center" href="about.php">About</a></li>
          <li class="nav-item"><a class="nav-link nav-center" href="contact.php">Contact</a></li>
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
          <?php
            if(!isset($_SESSION['user_email'])) {
              echo "<a href='login.php' class='nav-icon'>";
            }else{
              echo "<a href='user_area/index.php' class='nav-icon'>";
            }
          ?>
          <i class="fa-solid fa-user" style="color: #f4f0f0;"></i></a>
        </div>
      </div>
    </div>
  </nav>

  <!-- Carousel -->

  <section class="home">
    <div id="carouselExampleIndicators" class="carousel slide">
      <div class="carousel-controls">

        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
            aria-current="true" aria-label="Slide 1" style="background-image: url(image/1.jpg);"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"
            style="background-image: url(image/7.jpeg);"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"
            style="background-image: url(image/1.jpeg);"></button>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
          data-bs-slide="prev">
          <i class="fa-solid fa-arrow-left" style="color: #fcfcfc;"></i>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
          data-bs-slide="next">
          <i class="fa-solid fa-arrow-right" style="color: #fcfdfd;"></i>
        </button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active" style="background-image: url(image/1.jpg);">
          <div class="container">
            <h2>Luxury Vehicles</h2>
            <p>Beyond transportation, it's an experience.</p>
          </div>
        </div>
        <div class="carousel-item" style="background-image: url(image/7.jpeg);">
          <div class="container">
            <h2>DSLR Camera</h2>
            <p>Affordable camera rentals, Endless memories</p>
          </div>
        </div>
        <div class="carousel-item" style="background-image: url(image/1.jpeg);">
          <div class="container">
            <h2>Wedding Dress</h2>
            <p>Bridal bliss on a boudget..!</p>
          </div>
        </div>
      </div>

    </div>
  </section>



  <!-- cards -->

  <div class="container-fluid mx-auto">
    <h1 class="toprate text-center py4 mt-5"><b>R E C O M M E N D E D &nbsp;&nbsp; P R O D U C T S</b></h1>

    <div class="row g-4 mt-4 logo ">
      <div class="col-md-3 logos">
        <div class="card">
          <img src="image/cannon.jpeg" alt="..." class="">
          <div class="card-body">
            <h5 class="card-title"><b>Cannon Camera</b></h5>
            <p class="card-text"><i>Capture life's moments with professional quality. Rent our top-tier cameras for
                stunning photos and videos. Unleash your creativity with a camera rental today.</i></p>

            
          </div>
        </div>
      </div>
      <div class="col-md-3 logos">
        <div class="card">
          <img src="image/Western Bridal Dresses.jpg" alt="..." class="">
          <div class="card-body">
            <h5 class="card-title"><b>Western Bridal Dresses</b></h5>
            <p class="card-text"><i>Experience elegance without the price tag! Rent your dream bridal dress today.
                Stunning designs, budget-friendly. Explore our collection now</i></p>

            
          </div>
        </div>
      </div>
      <div class="col-md-3 logos">
        <div class="card">
          <img src="image/BMW cars.jpg" alt="..." class="">
          <div class="card-body">
            <h5 class="card-title"><b>BMW Cars</b></h5>
            <p class="card-text"><i>Explore the freedom of car rental! Drive with ease and convenience. Find your perfect ride at competitive rates. Discover new horizons</i></p>

            
          </div>
        </div>
      </div>
    </div>
    <div class="row g-4 mt-4 mb-5">
      <div class="col-md-3">
        <div class="card">
          <img src="image/apartment.jpeg" alt="..." class="">
          <div class="card-body">
            <h5 class="card-title"><b>Apartments </b></h5>
            <p class="card-text"><i>Dream apartment for rent: Spacious, modern, affordable, prime location, top amenities, vibrant community. Schedule a viewing today!</i></p>

          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card">
          <img src="image/JBL.jpg" alt="..." class="">
          <div class="card-body">
            <h5 class="card-title"><b>JBL Speakers</b></h5>
            <p class="card-text"><i>Experience powerful sound with JBL speaker rental! Perfect for events, parties, and
                presentations. High-quality audio guaranteed.</i></p>

          </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="card">
          <img src="image/Mens suit.jpg" alt="..." class="">
          <div class="card-body">
            <h5 class="card-title"><b>Mens Suit</b></h5>
            <p class="card-text"><i>Dress to impress without the stress. Elevate your style with our premium suit rentals. From weddings to special occasions, rent the perfect suit and make a statement.</i></p>

          </div>
        </div>
      </div>
    </div>


  </div>
  <div class="container border-bottom border-dark"></div>



  <div class="container-fluid mx-auto">
    <h1 class="toprate text-center py4 mt-5"><b>F E A T U R E D &nbsp;&nbsp;&nbsp;  P R O D U C T S</b></h1>
  

  <br>

  <div class="row row-cols-1 row-cols-md-4 g-4">
    <div class="col">
      <div class="card h-100">
        <img src="image/Double-Breasted Suit .jpg" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title"><b>Double-Breasted Suit </b></h5>
          <p class="card-text">Double-breasted suits exude timeless elegance and sophistication. Featuring two columns
            of buttons, they offer a classic, refined look for formal occasions and business attire.</p>
        </div>
        
      </div>
    </div>
    <div class="col">
      <div class="card h-100">
        <img src="image/Canon R5.jpg" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title"><b>Canon R5</b></h5>
          <p class="card-text">A groundbreaking mirrorless camera, the Canon EOS R5, is designed for professionals with its 45 MP resolution, 8K video capabilities, and exceptional performance, setting new industry standards.</p>
        </div>
        
      </div>
    </div>
    <div class="col">
      <div class="card h-100">
        <img src="image/Mercedes Benz S-Class.jpg" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title"><b>Mercedes Benz S-Class</b></h5>
          <p class="card-text">The Mercedes-Benz S-Class redefines luxury and innovation. With cutting-edge technology,
            elegant design, and unrivaled performance, it's the epitome of automotive excellence.</p>
        </div>
       
      </div>
    </div>
  </div>
</div>
  <br><br>



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
  


  <script src="index.js"></script>
</body>

</html>
