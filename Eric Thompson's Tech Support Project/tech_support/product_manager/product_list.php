<?php
session_set_cookie_params(3600, "/");

session_start(); // ready to go!
// Authenticate user
if (!isset($_SESSION['admin_id'])) {
    $_SESSION['login_error_msg'] = "You aren't authorized to view this page";
    header("location: ../errors/error.php");
    exit; // prevent further execution, should there be more code that follows
}

include '../view/header.php';
require('../model/product_db.php');
?>

    <link rel="stylesheet" type="text/css" media="all" href="../list.css">

    <main>
        <h1>Product List</h1>

        <section>
            <!-- display a table of products -->
            <table>
                <tr>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Version</th>
                    <th>Release Date</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                </tr>
                <?php
                $products = get_products();
                foreach ($products as $product) :
                    ?>

                    <tr>
                        <td><?php echo $product['productCode']; ?></td>
                        <td><?php echo $product['name']; ?></td>
                        <td><?php echo $product['version']; ?></td>
                        <td><?php echo $product['releaseDate']; ?></td>

                        <td>
                            <form action="product_form_handler.php" method="post">
                                <input type="hidden" name="action"
                                       value="delete_product">

                                <input type="hidden" name="productCode"
                                       value="<?php echo $product['productCode']; ?>">

                                <input type="submit" value="Delete">
                            </form>
                        </td>

                        <td>
                            <form action="product_edit.php" method="post">
                                <input type="hidden" name="productCode"
                                       value="<?php echo $product['productCode']; ?>">

                                <input type="hidden" name="name"
                                       value="<?php echo $product['name']; ?>">

                                <input type="hidden" name="version"
                                       value="<?php echo $product['version']; ?>">

                                <input type="hidden" name="releaseDate"
                                       value="<?php echo $product['releaseDate']; ?>">

                                <input type="submit" value="Edit">
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <p class="last_paragraph">
                <button id="add_product_btn">Add Product</button>
            </p>

            <script>
                var btn = document.getElementById('add_product_btn');
                btn.addEventListener('click', function () {
                    document.location.href = '../product_manager/product_add.php';
                });
            </script>
        </section>
    </main>
<?php include '../view/footer.php'; ?>