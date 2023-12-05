<?php 
    if(isset($_GET["edit"])) {
        $order_id = $_GET["edit"];
        $sql_select_order = "SELECT * FROM `renthub_orders` WHERE order_id=$order_id;";
        $result_select_order = mysqli_query($conn,$sql_select_order);
        $row_select_order = mysqli_fetch_assoc($result_select_order);
        $user_id = $row_select_order["user_id"];
        $order_invoice = $row_select_order["order_invoice"];
        $order_status = $row_select_order["order_status"];
        $order_amount = $row_select_order["order_amount"];
        $order_payment = $row_select_order["order_payment"];
        $sql_select_delivery = "SELECT * FROM `renthub_delivery` WHERE order_id=$order_id;";
        $result_select_delivery = mysqli_query($conn,$sql_select_delivery);
        $row_select_delivery = mysqli_fetch_assoc($result_select_delivery);
        $delivery_firstname = $row_select_delivery["delivery_firstname"];
        $delivery_lastname = $row_select_delivery["delivery_lastname"];
        $delivery_address = $row_select_delivery["delivery_address"];
        $delivery_address_state = $row_select_delivery["delivery_address_state"];
        $delivery_address_city = $row_select_delivery["delivery_address_city"];
        $delivery_contact = $row_select_delivery["delivery_contact"];
    }
    if(isset($_POST["update"])) {
        $new_order_status = $_POST["order_status"];
        $new_order_payment = $_POST["order_payment"];
        $sql_update_order="UPDATE `renthub_orders` SET order_status='$new_order_status',order_payment='$new_order_payment' WHERE order_id='$order_id'";
        $result_update_order = mysqli_query($conn,$sql_update_order);
        if ($result_update_order) {
            echo "<script>alert('Order updated successfully.'); window.location.href = 'orders.php?view';</script>";
        } else {
            echo "<script>alert('Error: Unable to order the user at the moment. Please try again later.');</script>";
        }
    }
?>


<form action="" method="post" enctype="multipart/form-data" class="p-4">
    <h2 class="mb-4">Order Info</h2>
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="order_invoice" class="form-label">Invoice:</label>
            <input type="text" id="order_invoice" name="order_invoice" value="<?php echo $order_invoice?>" class="form-control" required disabled>
        </div>

        <div class="col-md-6">
        <label for="order_status" class="form-label">Status:</label>
        <select id="order_status" name="order_status" class="form-select" required>
            <?php
                    if($order_status == 'pending') {
                        echo "<option value='pending' selected>pending</option>";
                    } else {
                        echo "<option value='pending'>pending</option>";
                    }
                    if($order_status == 'shipped') {
                        echo "<option value='shipped' selected>shipped</option>";
                    } else {
                        echo "<option value='shipped'>shipped</option>";
                    }
                    if($order_status == "delivered") {
                        echo "<option value='delivered' selected>delivered</option>";
                    } else {
                        echo "<option value='delivered'>delivered</option>";
                    }
                    if($order_status == "cancelled") {
                        echo "<option value='cancelled' selected>cancelled</option>";
                    } else {
                        echo "<option value='cancelled'>cancelled</option>";
                    }
            ?>
        </select>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
        <label for="order_amount" class="form-label">Amount:</label>
        <input type="number" id="order_amount" name="order_amount" value="<?php echo $order_amount?>" class="form-control" required disabled>
        </div>
        <div class="col-md-6">
        <label for="order_payment" class="form-label">Payment:</label>
        <select id="order_payment" name="order_payment" class="form-select" required>
            <?php
                    if($order_payment == 'true') {
                        echo "<option value='true' selected>true</option>";
                    } else {
                        echo "<option value='true'>true</option>";
                    }
                    if($order_payment == 'false') {
                        echo "<option value='false' selected>false</option>";
                    } else {
                        echo "<option value='false'>false</option>";
                    }
            ?>
        </select>
        </div>
    </div>
    <h2 class="mb-4 mt-5">Delivery Info</h2>
    <div class="row mb-3">
        <div class="col-md-6">
        <label for="delivery_firstname" class="form-label">First Name:</label>
        <input type="text" id="delivery_firstname" name="delivery_firstname" value="<?php echo $delivery_firstname?>" class="form-control" required disabled>
        </div>
        <div class="col-md-6">
        <label for="delivery_lastname" class="form-label">Last Name:</label>
        <input type="text" id="delivery_lastname" name="delivery_lastname" value="<?php echo $delivery_lastname?>" class="form-control" required disabled>
        </div>
    </div>

    <div class="mb-3">
        <label for="delivery_address" class="form-label">Address:</label>
        <input type="text" id="delivery_address" name="delivery_address" value="<?php echo $delivery_address?>" class="form-control" required disabled>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
        <label for="delivery_address_state" class="form-label">State:</label>
        <input type="text" id="delivery_address_state" name="delivery_address_state" value="<?php echo $delivery_address_state?>" class="form-control" required disabled>
    </div>

    <div class="col-md-6">
        <label for="delivery_address_city" class="form-label">City:</label>
        <input type="text" id="delivery_address_city" name="delivery_address_city" value="<?php echo $delivery_address_city?>" class="form-control" required disabled>
    </div>
    </div>

    <div class="mb-3">
        <label for="delivery_contact" class="form-label">Contact No:</label>
        <input type="text" id="delivery_contact" name="delivery_contact" value="<?php echo $delivery_contact?>" class="form-control" required disabled>
    </div>
    <div class="buttons">
    <a href="orders.php?view" class="left"><i class="fa-solid fa-arrow-left"></i> Back</a>
    <button type="submit" name="update" class="btn btn-custom">UPDATE ORDER</button>
    <a href="orders.php?delete=<?php echo $order_id?>" class="btn btn-danger">Delete Order</a>
    </div>
</form>