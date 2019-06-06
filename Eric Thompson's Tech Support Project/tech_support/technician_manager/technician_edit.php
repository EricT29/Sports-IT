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
require('../model/technician_db.php');
?>

    <link rel="stylesheet" type="text/css" media="all" href="../list.css">

    <main>
        <h1 style="margin-left: 10px;">Edit Technician</h1>

        <?php
        $techID = filter_input(INPUT_POST, 'techID', FILTER_VALIDATE_INT);
        $firstName = filter_input(INPUT_POST, 'firstName');
        $lastName = filter_input(INPUT_POST, 'lastName');
        $email = filter_input(INPUT_POST, 'email');
        $phone = filter_input(INPUT_POST, 'phone');
        ?>

        <form action="../technician_manager/technician_form_handler.php" method="post" id="edit_technician_form">
            <div class="inputs">
                <input type="hidden" name="action" value="edit_technician">
                <label>Code:
                    <input type="text" name="techID" value="<?php echo $techID; ?>"/>
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
                <label>Email:
                    <input type="text" name="email" value="<?php echo $email; ?>"/>
                </label>
                <br>

                <br>
                <label>Phone:
                    <input type="text" name="phone" value="<?php echo $phone; ?>"/>
                </label>
                <br>
            </div>

            <label>&nbsp;</label>
            <input type="submit" value="Submit" class="edit_btn"/>
        </form>

    </main>
<?php include '../view/footer.php'; ?>