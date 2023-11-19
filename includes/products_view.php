<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Image</th>
            <th>Price</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
            include("includes/connection.php");

            $sql_select_products = "SELECT * FROM `products`;";
            $result_products = mysqli_query($conn, $sql_select_products);

            if (mysqli_num_rows($result_products) > 0) {
                while ($product = mysqli_fetch_assoc($result_products)) {
                    $product_id = $product['product_id'];
                    $product_name = $product['product_name'];
                    $product_image = $product['product_image1'];
                    $product_price = $product['product_price'];
                    $product_status = $product['status'];

                    echo "<tr>
                            <td>$product_id</td>
                            <td>$product_name</td>
                            <td><img src='includes/product_images/$product_image' alt='$product_name' height='40px'></td>
                            <td>$product_price</td>
                            <td>$product_status</td>
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
            <td colspan=6><a href="products.php?insert">+ Create New Product</a></td>
        </tr>
    </tbody>
</table>