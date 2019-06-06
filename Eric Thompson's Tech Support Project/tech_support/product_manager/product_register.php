<?php
session_set_cookie_params(3600, "/");

session_start(); // ready to go!
// Authenticate user
if (!isset($_SESSION['customerID'])) {
    $_SESSION['login_error_msg'] = "You aren't authorized to view this page";
    header("location: ../errors/error.php");
    exit; // prevent further execution, should there be more code that follows
}

include '../view/header.php';
include '../model/database.php';
require('../model/product_db.php');
?>

    <main>
        <h1>Register Product</h1>

        <label> Customer:
            <?php echo $_SESSION['customer_name']; ?>
        </label>
        <br>

        <form action="../product_manager/product_form_handler.php" method="post" id="register_product_form">
            <div class="inputs">
                <input type="hidden" name="action" value="register_product">

                <br>
                <label> Product:
                    <?php $products = get_products(); ?>
                    <select name="productCode">
                        <?php foreach ($products as $product) : ?>
                            <option value="<?php echo $product['productCode']; ?>">
                                <?php echo $product['name']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </label>
                <br>

                <input type="hidden" name="customerID" value=<?php echo $_SESSION['customerID'] ?>>

                <input type="hidden" name="registrationDate" value=<?php echo date('Y-m-d H:i:s') ?>>

                <br>
                <label>&nbsp;</label>
                <input type="submit" value="Submit" class="edit_btn" style="float: left;"/>

            </div>
        </form>
    </main>
<?php include '../view/footer.php'; ?>