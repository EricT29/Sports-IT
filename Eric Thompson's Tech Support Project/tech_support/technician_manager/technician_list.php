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
require('../model/technician_db.php');
?>

    <link rel="stylesheet" type="text/css" media="all" href="../list.css">

    <main>
        <h1>Technician List</h1>

        <section>
            <!-- display a table of technicians -->
            <table>
                <tr>
                    <th>Code</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                </tr>
                <?php
                $technicians = get_technicians();
                foreach ($technicians as $technician) :
                    ?>

                    <tr>
                        <td><?php echo $technician['techID']; ?></td>
                        <td><?php echo $technician['firstName']; ?></td>
                        <td><?php echo $technician['lastName']; ?></td>
                        <td><?php echo $technician['email']; ?></td>
                        <td><?php echo $technician['phone']; ?></td>

                        <td>
                            <form action="../technician_manager/technician_form_handler.php" method="post">
                                <input type="hidden" name="action"
                                       value="delete_technician">

                                <input type="hidden" name="techID"
                                       value="<?php echo $technician['techID']; ?>">

                                <input type="submit" value="Delete">
                            </form>
                        </td>

                        <td>
                            <form action="technician_edit.php" method="post">
                                <input type="hidden" name="techID"
                                       value="<?php echo $technician['techID']; ?>">

                                <input type="hidden" name="firstName"
                                       value="<?php echo $technician['firstName']; ?>">

                                <input type="hidden" name="lastName"
                                       value="<?php echo $technician['lastName']; ?>">

                                <input type="hidden" name="email"
                                       value="<?php echo $technician['email']; ?>">

                                <input type="hidden" name="phone"
                                       value="<?php echo $technician['phone']; ?>">
                                <input type="submit" value="Edit">
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <p class="last_paragraph">
                <button id="add_tech_btn">Add Technician</button>
            </p>

            <script>
                var btn = document.getElementById('add_tech_btn');
                btn.addEventListener('click', function () {
                    document.location.href = '../technician_manager/technician_add.php';
                });
            </script>
        </section>
    </main>
<?php include '../view/footer.php'; ?>