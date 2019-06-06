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
require('../model/customer_db.php');
?>

    <link rel="stylesheet" type="text/css" media="all" href="../list.css">

    <main>
        <h1>Customer List</h1>

        <section>
            <!-- display a table of customers -->
            <table>
                <tr>
                    <th>Code</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Postal Code</th>
                    <th>Country Code</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                </tr>
                <?php
                $customers = get_customers();
                foreach ($customers as $customer) :
                    ?>

                    <tr>
                        <td><?php echo $customer['customerID']; ?></td>
                        <td><?php echo $customer['firstName']; ?></td>
                        <td><?php echo $customer['lastName']; ?></td>
                        <td><?php echo $customer['address']; ?></td>
                        <td><?php echo $customer['city']; ?></td>
                        <td><?php echo $customer['state']; ?></td>
                        <td><?php echo $customer['postalCode']; ?></td>
                        <td><?php echo $customer['countryCode']; ?></td>
                        <td><?php echo $customer['email']; ?></td>
                        <td><?php echo $customer['phone']; ?></td>

                        <td>
                            <form action="../customer_manager/customer_form_handler.php" method="post">
                                <input type="hidden" name="action"
                                       value="delete_customer">

                                <input type="hidden" name="customerID"
                                       value="<?php echo $customer['customerID']; ?>">

                                <input type="submit" value="Delete">
                            </form>
                        </td>

                        <td>
                            <form action="customer_edit.php" method="post">
                                <input type="hidden" name="customerID"
                                       value="<?php echo $customer['customerID']; ?>">

                                <input type="hidden" name="firstName"
                                       value="<?php echo $customer['firstName']; ?>">

                                <input type="hidden" name="lastName"
                                       value="<?php echo $customer['lastName']; ?>">

                                <input type="hidden" name="address"
                                       value="<?php echo $customer['address']; ?>">

                                <input type="hidden" name="city"
                                       value="<?php echo $customer['city']; ?>">

                                <input type="hidden" name="state"
                                       value="<?php echo $customer['state']; ?>">

                                <input type="hidden" name="postalCode"
                                       value="<?php echo $customer['postalCode']; ?>">

                                <input type="hidden" name="countryCode"
                                       value="<?php echo $customer['countryCode']; ?>">

                                <input type="hidden" name="email"
                                       value="<?php echo $customer['email']; ?>">

                                <input type="hidden" name="phone"
                                       value="<?php echo $customer['phone']; ?>">
                                <input type="submit" value="Edit">
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <p class="last_paragraph">
                <button id="add_customer_btn">Add customer</button>
            </p>

            <script>
                var btn = document.getElementById('add_customer_btn');
                btn.addEventListener('click', function () {
                    document.location.href = '../customer_manager/customer_add.php';
                });
            </script>
        </section>
    </main>
<?php include '../view/footer.php'; ?>