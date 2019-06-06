<?php
session_set_cookie_params(3600, "/");

session_start(); // ready to go!
// Authenticate user
if (!isset($_SESSION['admin_id'])) {
    $_SESSION['login_error_msg'] = "You aren't authorized to view this page";
    header("location: ../errors/error.php"); // written by Eric M. Thompson
    exit; // prevent further execution, should there be more code that follows
}

include '../view/header.php';
include '../model/database.php';
require('../model/customer_db.php');
?>

    <link rel="stylesheet" type="text/css" media="all" href="../list.css">

    <main>
        <h1 style="margin-left: 10px;">Edit Customer</h1>

        <?php
        $customerID = filter_input(INPUT_POST, 'customerID', FILTER_VALIDATE_INT);
        $firstName = filter_input(INPUT_POST, 'firstName');
        $lastName = filter_input(INPUT_POST, 'lastName');
        $address = filter_input(INPUT_POST, 'address');
        $city = filter_input(INPUT_POST, 'city');
        $state = filter_input(INPUT_POST, 'state');
        $postalCode = filter_input(INPUT_POST, 'postalCode');
        $countryCode = filter_input(INPUT_POST, 'countryCode');
        $phone = filter_input(INPUT_POST, 'phone');
        $email = filter_input(INPUT_POST, 'email');
        ?>

        <form action="../customer_manager/customer_form_handler.php" method="post" id="edit_customer_form">
            <div class="inputs">
                <input type="hidden" name="action" value="edit_customer">
                <label>Code:
                    <input type="text" name="customerID" value="<?php echo $customerID; ?>"/>
                </label>
                <br>

                <br>
                <label>First Name:
                    <input type="text" name="firstName" value="<?php echo $firstName; ?>"/>
                </label>
                <br>

                <br>
                <label>Last Name:
                    <input type="text" name="lastName" value="<?php echo $lastName; ?>"/>
                </label>
                <br>

                <br>
                <label>Address:
                    <input type="text" name="address" value="<?php echo $address; ?>"/>
                </label>
                <br>

                <br>
                <label>City:
                    <input type="text" name="city" value="<?php echo $city; ?>"/>
                </label>
                <br>

                <br>
                <label>State:
                    <input type="text" name="state" value="<?php echo $state; ?>"/>
                </label>
                <br>

                <br>
                <label>Postal Code:
                    <input type="text" name="postalCode" value="<?php echo $postalCode; ?>"/>
                </label>
                <br>

                <br>
                <label>Country Code:
                    <input type="text" name="countryCode" value="<?php echo $countryCode; ?>"/>
                </label>
                <br>

                <br>
                <label>Phone:
                    <input type="text" name="phone" value="<?php echo $phone; ?>"/>
                </label>
                <br>

                <br>
                <label>Email:
                    <input type="text" name="email" value="<?php echo $email; ?>"/>
                </label>
                <br>
            </div>

            <label>&nbsp;</label>
            <input type="submit" value="Submit" class="edit_btn"/>
        </form>

    </main>
<?php include '../view/footer.php'; ?>