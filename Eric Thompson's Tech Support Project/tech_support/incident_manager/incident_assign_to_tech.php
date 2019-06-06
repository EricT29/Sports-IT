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
require('../model/incident_db.php');

$incident['title'] = filter_input(INPUT_POST, 'title');
$incident['incidentID'] = filter_input(INPUT_POST, 'incidentID');
?>

    <link rel="stylesheet" type="text/css" media="all" href="../list.css">

    <main>
        <h1>Technician List</h1>

        <td> Incident: <?php echo $incident['title']; ?></td>
        <br>

        <section>
            <!-- display a table of technicians -->
            <table>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Number Assigned</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                </tr>
                <?php
                $technicians = get_technicians();
                foreach ($technicians as $technician) :
                    ?>

                    <tr>
                        <td><?php echo $technician['firstName'] . " " . $technician['lastName']; ?></td>
                        <td><?php echo $technician['email']; ?></td>
                        <td><?php echo $technician['phone']; ?></td>
                        <td><?php echo get_count_of_assigned_incidents($technician['techID']); ?></td>

                        <td>
                            <form action="../incident_manager/incident_form_handler.php" method="post">
                                <input type="hidden" name="action"
                                       value="assign_to_tech">

                                <input type="hidden" name="techID"
                                       value="<?php echo $technician['techID']; ?>">

                                <input type="hidden" name="incidentID"
                                       value="<?php echo $incident['incidentID']; ?>">

                                <input type="submit" value="Select">
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </section>
    </main>
<?php include '../view/footer.php'; ?>