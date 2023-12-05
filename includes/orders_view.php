<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Invoice</th>
            <th>Status</th>
            <th>Amount</th>
            <th>Payment</th>
            <th style='text-align: center'>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $sql_select_orders = "SELECT * FROM `renthub_orders`;";
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
                            <td>$order_invoice</td>
                            <td>$order_status</td>
                            <td>$order_amount</td>
                            <td>$order_payment</td>
                            <td style='text-align: center'>
                                <a href='orders.php?edit=$order_id'><i class='fa-solid fa-chevron-right' style='color: #000000a1;font-size: 13px;'></i></i></a>
                            </td>
                        </tr>";
                }
            } 
        ?>
    </tbody>
</table>