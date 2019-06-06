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
include '../model/database.php';
require('../model/product_db.php');
?>

    <link rel="stylesheet" type="text/css" media="all" href="../list.css">

    <main>
        <h1 style="margin-left: 10px;">Edit Product</h1>

        <?php
        $product['productCode'] = filter_input(INPUT_POST, 'productCode');
        $product['name'] = filter_input(INPUT_POST, 'name');
        $product['version'] = filter_input(INPUT_POST, 'version');
        $product['releaseDate'] = filter_input(INPUT_POST, 'releaseDate');
        ?>

        <form action="../product_manager/product_form_handler.php" method="post" id="edit_product_form">
            <div class="inputs">
                <input type="hidden" name="action" value="edit_product">
                <label>Code:
                    <input type="text" name="productCode" value="<?php echo $product['productCode']; ?>"/>
                </label>
                <br>

                <br>
                <label>Name:
                    <input type="text" name="name" value="<?php echo $product['name']; ?>"/>
                </label>
                <br>

                <br>
                <label>Version:
                    <input type="text" name="version" value="<?php echo $product['version']; ?>"/>
                </label>
                <br>

                <br>
                <label>Release Date:
                    <input type="text" name="releaseDate" value="<?php echo $product['releaseDate']; ?>"/>
                </label>
                <br>
            </div>

            <label>&nbsp;</label>
            <input type="submit" value="Submit" class="edit_btn"/>
        </form>

    </main>
<?php include '../view/footer.php'; ?>