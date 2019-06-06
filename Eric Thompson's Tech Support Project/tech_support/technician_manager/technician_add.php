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
        <h1 style="margin-left: 10px;">Add Technician</h1>

        <?php
        $techID = filter_input(INPUT_POST, 'techID', FILTER_VALIDATE_INT);
        $firstName = filter_input(INPUT_POST, 'firstName');
        $lastName = filter_input(INPUT_POST, 'lastName');
        $email = filter_input(INPUT_POST, 'email');
        $phone = filter_input(INPUT_POST, 'phone');
        ?>

        <script>
            document.addEventListener('DOMContentLoaded', function () {

                // generate password

                var charset = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
                var i;
                var password = "";
                var length = 15;
                values = new Uint32Array(length);
                window.crypto.getRandomValues(values);
                for (i = 0; i < length; i++) {
                    password += charset[values[i] % charset.length];
                }

                document.getElementById("password").value = password; // must have lowercase d in "Id"

                // generate technician code
                min = Math.ceil(10000000);
                max = Math.floor(99999999);
                var techID = Math.floor(Math.random() * (max - min + 1)) + min;

                document.getElementById("techID").value = techID; // must have lowercase d in "Id"
            }, false);
        </script>

        <form action="../technician_manager/technician_form_handler.php" method="post" id="add_technician_form">
            <div class="inputs">
                <input type="hidden" name="action" value="add_technician">

                <br>
                <label>First Name:
                    <input type="text" name="firstName"/>
                </label>
                <br>

                <br>
                <label>Last Name:
                    <input type="text" name="lastName"/>
                </label>
                <br>

                <br>
                <label>Email:
                    <input type="text" name="email"/>
                </label>
                <br>

                <br>
                <label>Phone:
                    <input type="text" name="phone"/>
                </label>
                <br>

                <br>
                <label>Password:
                    <input id="password" type="password" name="password" readonly/>
                </label>
                <br>

                <input id="techID" type="hidden" name="techID"/>
            </div>

            <label>&nbsp;</label>
            <input type="submit" value="Submit" class="edit_btn"/>
        </form>

    </main>
<?php include '../view/footer.php'; ?>