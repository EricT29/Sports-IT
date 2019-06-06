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
require('../model/customer_db.php');
?>

    <link rel="stylesheet" type="text/css" media="all" href="../list.css">

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            // generate password

            var charset = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
            var i;
            var password = "";
            var length = 15;
            var values = new Uint32Array(length);
            window.crypto.getRandomValues(values);
            for (i = 0; i < length; i++) {
                password += charset[values[i] % charset.length];
            }

            document.getElementById("password").value = password; // must have lowercase d in "Id"

            // generate customer code
            min = Math.ceil(10000000);
            max = Math.floor(99999999);
            var customerCode = Math.floor(Math.random() * (max - min + 1)) + min;

            document.getElementById("customerID").value = customerCode; // must have lowercase d in "Id"
        }, false);
    </script>

    <main>
        <h1 style="margin-left: 10px;">Add Customer</h1>

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
        $password = filter_input(INPUT_POST, 'password');
        ?>

        <form action="../customer_manager/customer_form_handler.php" method="post" id="add_customer_form">
            <div class="inputs">
                <input type="hidden" name="action" value="add_customer">

                <br>
                <label>*First Name:
                    <input id="name" type="text" name="firstName"/>
                </label>
                <br>

                <br>
                <label>Last Name:
                    <input type="text" name="lastName"/>
                </label>
                <br>

                <br>
                <label>Address:
                    <input type="text" name="address"/>
                </label>
                <br>

                <br>
                <label>City:
                    <input type="text" name="city"/>
                </label>
                <br>

                <br>
                <label>State:
                    <input type="text" name="state"/>
                </label>
                <br>

                <br>
                <label>Postal Code:
                    <input type="text" name="postalCode"/>
                </label>
                <br>

                <br>
                <label>Country Code:
                    <input type="text" name="countryCode"/>
                </label>
                <br>

                <br>
                <label>*Phone:
                    <input id="phone" type="text" name="phone"/>
                </label>
                <br>

                <br>
                <label>*Email:
                    <input id="email" type="text" name="email"/>
                </label>
                <br>

                <br>
                <label>Password:
                    <input id="password" type="password" name="password" readonly/>
                </label>
                <br>

                <br>
                <span style="font-size: smaller; ">
                <label>
                    Fields marked with an asterisk are required.
                </label>
                </span>
                <br>

                <input id="customerID" type="hidden" name="customerID"/>
            </div>

            <label>&nbsp;</label>
            <input type="submit" value="Submit" class="edit_btn"/>
        </form>

    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var phone = document.getElementById('phone');
            var phone_pattern = new RegExp(/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im);
            phone.addEventListener('keyup', function validate_number() {
                if (phone_pattern.test(phone.value)) {
                    phone.style.color = "black";
                } else {
                    phone.style.color = "red";
                }
            });

            phone.addEventListener('keyup', function validate_number_not_empty() {
                if (phone.value.length > 0) {
                    phone.placeholder = "";
                } else {
                    phone.placeholder = "Required!"
                }
            });

            var email = document.getElementById('email');
            var email_pattern = new RegExp(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/);
            email.addEventListener('keyup', function validate_email() {
                if (email_pattern.test(email.value)) {
                    email.style.color = "black";
                } else {
                    email.style.color = "red";
                }
            });

            email.addEventListener('keyup', function validate_email_not_empty() {
                if (email.value.length > 0) {
                    email.placeholder = "";
                } else {
                    email.placeholder = "Required!"
                }
            });

            var name = document.getElementById('name');
            name.addEventListener('keyup', function validate_name() {
                if (name.value.length > 0) {
                    name.placeholder = ""
                } else {
                    name.placeholder = "Required!"
                }
            });
        });
    </script>

<?php include '../view/footer.php'; ?>