<!DOCTYPE html>
<html lang="en">

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
    <link rel="stylesheet" href="categories.css">
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
                        <a href="products.php">
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
                        <a href="orders.php">
                            <i class='bx bx-list-ul icon' ></i>
                            <span class="text nav-text">Order list</span>
                        </a>
                    </li>
                    
                    <li class="nav-link">
                        <a href="users.php">
                        <i class='bx bx-user icon' ></i>
                            <span class="text nav-text">Users</span>
                        </a>
                    </li>
                </ul>
            </div>
 
            <div class="bottom-content">
                <li class="">
                    <a href="#">
                        <i class='bx bx-log-out icon' ></i>
                        <span class="text nav-text">Logout</span>
                    </a>
                </li>
            </div>
        </div>

    </nav>

    <section class="home">
        <div class="header"> Categories</div>
        <div class="container">
            <div class="row" id="main">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Category</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            include("includes/connection.php");

                            // Fetch categories from the database
                            $sql_select_categories = "SELECT * FROM `categories`;";
                            $result_categories = mysqli_query($conn, $sql_select_categories);

                            // Check if there are categories to display
                            if (mysqli_num_rows($result_categories) > 0) {
                                while ($category = mysqli_fetch_assoc($result_categories)) {
                                    $category_id = $category['category_id'];
                                    $category_name = $category['category_name'];

                                    echo "<tr>
                                            <td>$category_id</td>
                                            <td>$category_name</td>
                                            <td>
                                                <div class='dropdown'>
                                                    <a class='nav-link dropdown-toggle nav-center' href='#' id='navbarDarkDropdownMenuLink' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
                                                        <i class='bx bx-dots-horizontal-rounded'></i>
                                                    </a>
                                                    <div class='dropdown-menu' aria-labelledby='navbarDarkDropdownMenuLink'>
                                                        <a class='dropdown-item' href='#'>Edit</a>
                                                        <a class='dropdown-item' href='#'>Delete</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>";
                                }
                            } /*else {
                                // Provide a message if there are no categories
                                echo "<tr>
                                        <td colspan='3'>No categories found.</td>
                                      </tr>";
                            }*/
                        ?>
                        <tr>
                            <?php 
                                if(isset($_GET['view'])) {
                                    include('includes/categories_view.php');
                                }
                                if(isset($_GET['insert'])) {
                                    include('includes/categories_insert.php');
                                }
                                ?>
                        </tr>
                    </tbody>
                </table>
                
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
    </script>

</body>
</html>
