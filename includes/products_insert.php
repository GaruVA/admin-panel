<?php
    include("connection.php");
    if(isset($_POST["create"])){
        $category_name = $_POST["category_name"];

        $sql_check_duplicate = "SELECT * FROM `categories` WHERE category_name='$category_name';";
        $result_duplicate_check = mysqli_query($conn, $sql_check_duplicate);
        $row_count = mysqli_num_rows($result_duplicate_check);

        if ($row_count != 0) {
            echo "<script>alert('Error: This category already exists. Please choose a different category.')</script>";
        } else {
            $sql_insert_category = "INSERT INTO `categories` (category_name) VALUES ('$category_name');";
            $result_insert = mysqli_query($conn, $sql_insert_category);

            if ($result_insert) {
                echo "<script>alert('Success: Category \"$category_name\" has been added.'); window.location.href = 'categories.php?view';</script>";
            } else {
                echo "<script>alert('Error: Unable to add the category at the moment. Please try again later.')</script>";
            }
        }
    }
?>
<form action="#" method="post" enctype="multipart/form-data" class="p-4">
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="productName" class="form-label">Product Name:</label>
            <input type="text" id="productName" name="productName" class="form-control" required>
        </div>

        <div class="col-md-4">
            <label for="price" class="form-label">Price:</label>
            <input type="number" id="price" name="price" class="form-control" required>
        </div>

        <div class="col-md-4">
            <label for="category" class="form-label">Category:</label>
            <select id="category" name="category" class="form-select" required>
                <option value="electronics">Electronics</option>
                <option value="clothing">Clothing</option>
                <option value="books">Books</option>
                <!-- Add more categories as needed -->
            </select>
        </div>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Description:</label>
        <textarea id="description" name="description" rows="4" class="form-control" required></textarea>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <label for="image1" class="form-label">Image 1:</label>
            <input type="file" id="image1" name="image1" class="form-control" accept="image/*" required>
        </div>

        <div class="col-md-6">
            <label for="image2" class="form-label">Image 2:</label>
            <input type="file" id="image2" name="image2" class="form-control" accept="image/*">
        </div>
    </div>

    <div class="mb-3">
        <label for="image3" class="form-label">Image 3:</label>
        <input type="file" id="image3" name="image3" class="form-control" accept="image/*">
    </div>

    <div class="mb-3">
        <label for="keywords" class="form-label">Keywords (comma-separated):</label>
        <input type="text" id="keywords" name="keywords" class="form-control">
    </div>

    <button type="submit" class="btn btn-custom">Insert Product</button>
</form>

