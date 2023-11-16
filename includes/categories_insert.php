<?php
include("connection.php");
if(isset($_POST["add"])){
    $cat_name = $_POST["cat_name"];

    $sql_check_duplicate = "SELECT * FROM `categories` WHERE category_name='$cat_name';";
    $result_duplicate_check = mysqli_query($conn, $sql_check_duplicate);
    $row_count = mysqli_num_rows($result_duplicate_check);

    if ($row_count != 0) {
        echo "<script>alert('Error: This category already exists. Please choose a different category.')</script>";
    } else {
        $sql_insert_category = "INSERT INTO `categories` (category_name) VALUES ('$cat_name');";
        $result_insert = mysqli_query($conn, $sql_insert_category);

        if ($result_insert) {
            echo "<script>alert('Success: Category \"$cat_name\" has been added.'); window.location.href = 'categories.php?view';</script>";
        } else {
            echo "<script>alert('Error: Unable to add the category at the moment. Please try again later.')</script>";
        }
    }
}
?>

<td>
</td>
<td>
    <form method="post" action="">
        <input type="text" name="cat_name" placeholder=" Enter Category Name">
        <input type="submit" id="submit-form" class="hidden" name="add">
    </form>
</td>
<td style="text-align: left;">
    <label for="submit-form" tabindex="0" class="smbtn">Add</label>
</td>


