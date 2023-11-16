<?php
include("connection.php");
if(isset($_POST["add"])){
    $cat_name=$_POST["cat_name"];
    $sql="INSERT INTO `categories` (`category_name`) VALUES ('$cat_name');";
    $result=mysqli_query($conn,$sql);
    if($result){
        echo "<script>alert('Category has been Added!')</script>";
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


