<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
            include("includes/connection.php");

            $sql_select_categories = "SELECT * FROM `categories`;";
            $result_categories = mysqli_query($conn, $sql_select_categories);

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
            <td colspan=3><a href="categories.php?insert">+ Create New Category</a></td>
        </tr>
    </tbody>
</table>