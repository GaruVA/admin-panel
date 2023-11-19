<?php
    include("connection.php");
    if(isset($_POST["submit"])){
        $product_name = $_POST["product_name"];
        $product_price = $_POST["product_price"];
        $product_category = $_POST["product_category"];
        $product_desc = $_POST["product_desc"];
        $product_image1 = $_FILES["product_image1"]["name"];
        $product_image2 = $_FILES["product_image2"]["name"];
        $product_image3 = $_FILES["product_image3"]["name"];
        $product_tmpimage1 = $_FILES["product_image1"]["tmp_name"];
        $product_tmpimage2 = $_FILES["product_image2"]["tmp_name"];
        $product_tmpimage3 = $_FILES["product_image3"]["tmp_name"];
        $product_keywords = $_POST["product_keywords"];

        if($product_name == "" or $product_price == "" or $product_category == "" or $product_desc == "" or $product_image1 == "" or $product_image2 == "" or $product_image3 == "" or $product_keywords == ""){
            echo "<script>alert('Error: Please fill all the avaiable fields.')</script>";
        } else {
            $sql_check_duplicate = "SELECT * FROM `products` WHERE product_name='$product_name';";
            $result_duplicate_check = mysqli_query($conn, $sql_check_duplicate);
            $row_count = mysqli_num_rows($result_duplicate_check);

            if ($row_count != 0) {
                echo "<script>alert('Error: This product already exists. Please choose a different product.')</script>";
            } else {
                move_uploaded_file($product_tmpimage1, "C:/xampp/htdocs/Assignment-Website/admin_panel/includes/product_images/$product_image1");
                move_uploaded_file($product_tmpimage2, "C:/xampp/htdocs/Assignment-Website/admin_panel/includes/product_images/$product_image2");
                move_uploaded_file($product_tmpimage3, "C:/xampp/htdocs/Assignment-Website/admin_panel/includes/product_images/$product_image3");
                $sql_insert_category = "INSERT INTO `products` (product_name,product_price,category_id,product_desc,product_image1,product_image2,product_image3,product_keywords,data,status) VALUES ('$product_name','$product_price','$product_category','$product_desc','$product_image1','$product_image2','$product_image3','$product_keywords',NOW(),'true');";
                $result_insert = mysqli_query($conn, $sql_insert_category);

                if ($result_insert) {
                    echo "<script>alert('Success: Product \"$product_name\" has been added.'); window.location.href = 'products.php?view';</script>";
                } else {
                    echo "<script>alert('Error: Unable to add the product at the moment. Please try again later.')</script>";
                }
            }
        }
    }
?>
<form action="#" method="post" enctype="multipart/form-data" class="p-4">
    <h2 class="mb-4">Create New Product</h2>
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="productName" class="form-label">Product Name:</label>
            <input type="text" id="productName" name="product_name" class="form-control" required>
        </div>

        <div class="col-md-4">
            <label for="price" class="form-label">Price:</label>
            <input type="number" id="price" name="product_price" class="form-control" required>
        </div>

        <div class="col-md-4">
            <label for="category" class="form-label">Category:</label>
            <select id="category" name="product_category" class="form-select" required>
                <?php
                include("includes/connection.php");

                $sql_select_categories = "SELECT * FROM `categories`;";
                $result_categories = mysqli_query($conn, $sql_select_categories);
    
                if (mysqli_num_rows($result_categories) > 0) {
                    while ($category = mysqli_fetch_assoc($result_categories)) {
                        $category_id = $category['category_id'];
                        $category_name = $category['category_name'];
    
                        echo "<option value=$category_id>$category_name</option>";
                    }
                }
                ?>
            </select>
        </div>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Description:</label>
        <textarea id="description" name="product_desc" rows="4" class="form-control" required></textarea>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <label for="image1" class="form-label">Image 1:</label>
            <input type="file" id="image1" name="product_image1" class="form-control" accept="image/*" required>
        </div>

        <div class="col-md-6">
            <label for="image2" class="form-label">Image 2:</label>
            <input type="file" id="image2" name="product_image2" class="form-control" accept="image/*" required>
        </div>
    </div>

    <div class="mb-3">
        <label for="image3" class="form-label">Image 3:</label>
        <input type="file" id="image3" name="product_image3" class="form-control" accept="image/*" required>
    </div>

    <div class="mb-3">
        <label for="keywords" class="form-label">Keywords (comma-separated):</label>
        <input type="text" id="keywords" name="product_keywords" class="form-control" required>
    </div>

    <button type="submit" name="submit" class="btn btn-custom">Insert Product</button>
</form>

