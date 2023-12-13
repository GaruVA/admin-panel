<?php 
    session_start();
    if(!isset($_SESSION['user_email']) || !isset($_SESSION['user_type'])) {
        header("Location: login.php");
        exit();
    }
    include("includes/connection.php");

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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script> 
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://kit.fontawesome.com/d5f76a1949.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <nav class="sidebar close">
        <header>
            <div class="image-text">
                <span class="image">
                    <img src="../icons/white.png" alt="">
                </span>

                <div class="text logo-text">
                    <span class="name">Admin Panel</span>
                </div>
            </div>
            <i class='bx bx-menu toggle'></i>
        </header>

        <div class="menu-bar">
            <div class="menu">
                <ul class="menu-links">
                    <li class="nav-link">
                        <a href="index.php">
                            <i class='bx bx-home-alt icon' ></i>
                            <span class="text nav-text">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="products.php?view">
                            <i class='bx bx-box icon' ></i>
                            <span class="text nav-text">Products</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="categories.php?view">
                        <i class='bx bx-category icon' ></i>
                            <span class="text nav-text">Categories</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="orders.php?view">
                            <i class='bx bx-list-ul icon' ></i>
                            <span class="text nav-text">Order list</span>
                        </a>
                    </li>
                    
                    <li class="nav-link">
                        <a href="users.php?view">
                        <i class='bx bx-user icon' ></i>
                            <span class="text nav-text">Users</span>
                        </a>
                    </li>
                </ul>
            </div>
 
            <div class="bottom-content">
                <li class="">
                    <a href="logout.php">
                        <i class='bx bx-log-out icon' ></i>
                        <span class="text nav-text">Logout</span>
                    </a>
                </li>
            </div>
        </div>

    </nav>

    <section class="home">
        <div class="header"> Dashboard</div>
        <div class="container">
            <div id="main">
                <div class="row">
                <div class="col-md-3">
                        <div class="card">
                            <div>
                            <p>Categories</p>
                                <h2> <?php $sql_select_category="SELECT * FROM `renthub_categories`";
                                                $result_select_category=mysqli_query($conn, $sql_select_category);
                                                $num_select_category=mysqli_num_rows($result_select_category);      
                                                echo $num_select_category;?>
                                </h2>
                                
                            </div>
                            <a href='categories.php?view'><i class='fa-solid fa-chevron-right' style='color: #000000a1;font-size: 13px;'></i></a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div>
                            <p>Products</p>
                                <h2> <?php $sql_select_products="SELECT * FROM `renthub_products`";
                                                $result_select_products=mysqli_query($conn, $sql_select_products);
                                                $num_select_products=mysqli_num_rows($result_select_products);      
                                                echo $num_select_products;?>
                                </h2>
                                
                            </div>
                            <a href='products.php?view'><i class='fa-solid fa-chevron-right' style='color: #000000a1;font-size: 13px;'></i></a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div>
                            <p>Orders</p>
                                <h2> <?php $sql_select_orders="SELECT * FROM `renthub_orders`";
                                                $result_select_orders=mysqli_query($conn, $sql_select_orders);
                                                $num_select_orders=mysqli_num_rows($result_select_orders);      
                                                echo $num_select_orders;?>
                                </h2>
                                
                            </div>
                            <a href='orders.php?view'><i class='fa-solid fa-chevron-right' style='color: #000000a1;font-size: 13px;'></i></a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div>
                            <p>Users</p>
                                <h2> <?php $sql_select_users="SELECT * FROM `renthub_users`";
                                                $result_select_users=mysqli_query($conn, $sql_select_users);
                                                $num_select_users=mysqli_num_rows($result_select_users);      
                                                echo $num_select_users;?>
                                </h2>
                                
                            </div>
                            <a href='users.php?view'><i class='fa-solid fa-chevron-right' style='color: #000000a1;font-size: 13px;'></i></a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="table-header">Most Recent Orders</div>
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sql_select_orders = "SELECT * FROM `renthub_orders` WHERE order_status='pending' ORDER BY order_date DESC LIMIT 5;";
                                $result_select_orders = mysqli_query($conn, $sql_select_orders);
                    
                                if (mysqli_num_rows($result_select_orders) > 0) {
                                    while ($order = mysqli_fetch_assoc($result_select_orders)) {
                                        $order_id = $order['order_id'];
                                        $order_invoice = $order['order_invoice'];
                                        $order_status = $order['order_status'];
                                        $order_amount = $order['order_amount'];
                                        $order_payment = $order['order_payment'];
                                        echo "<tr>
                                                <td>$order_id</td>
                                                <td>$order_status</td>
                                            </tr>";
                                    }
                                } 
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-6">
                <div class="table-header">Most Ordered Users</div>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Num of Orders</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sql_select_user_orders_num = "SELECT * FROM `renthub_user_orders_num` ORDER BY orders_num DESC LIMIT 5;";
                            $result_select_user_orders_num = mysqli_query($conn, $sql_select_user_orders_num);

                            if (mysqli_num_rows($result_select_user_orders_num) > 0) {
                                while ($row_select_user_orders_num = mysqli_fetch_assoc($result_select_user_orders_num)) {
                                    $user_id = $row_select_user_orders_num['user_id'];
                                    $orders_num = $row_select_user_orders_num['orders_num'];

                                    $sql_select_users = "SELECT * FROM `renthub_users` WHERE user_id=$user_id;";
                                    $result_select_users = mysqli_query($conn, $sql_select_users);
                                    $row_select_user = mysqli_fetch_assoc($result_select_users);
                                    $user_email = $row_select_user['user_email'];

                                    echo "<tr>
                                            <td>$user_id</td>
                                            <td>$orders_num</td>
                                        </tr>";
                                }
                            }
                        ?>
                    </tbody>
                </table>
                </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        const body = document.querySelector('body'),
      sidebar = body.querySelector('nav'),
      toggle = body.querySelector(".toggle");


toggle.addEventListener("click" , () =>{
    sidebar.classList.toggle("close");
})

const xValues = ["VEHICLES", "CAMERA", "APPAREL", "SECURITY", "ENTERTAINMENT"];
const yValues = [55, 49, 44, 24, 35];
const barColors = ["red", "green","blue","orange","brown"];

new Chart("myChart", {
  type: "line",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
      text: "sales"
    }
  }
});
    </script>

</body>
</html>
