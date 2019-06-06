<?php
session_set_cookie_params(3600, "/");

session_start(); // ready to go!
// Authenticate user
if (!isset($_SESSION['technician_id'])) {
    $_SESSION['login_error_msg'] = "You aren't authorized to view this page";
    header("location: ../errors/error.php");
    exit; // prevent further execution, should there be more code that follows
}

include '../view/header.php';
require('../model/incident_db.php');
?>

    <link rel="stylesheet" type="text/css" media="all" href="../list.css">

    <main>
        <h1>My Assigned Incidents</h1>

        <section>
            <!-- display a table of products -->
            <table>
                <tr>
                    <th>Code</th>
                    <th>Customer</th>
                    <th>Product</th>
                    <th>Date Opened</th>
                    <th>Date Closed</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                </tr>
                <?php
                $incidents = get_incidents_by_TechID($_SESSION['technician_id']);
                foreach ($incidents as $incident) :
                    ?>

                    <tr>
                        <td><?php echo $incident['incidentID']; ?></td>
                        <td><?php echo get_customer_email_by_ID($incident['customerID']); ?></td>
                        <td><?php echo $incident['productCode']; ?></td>
                        <td><?php echo $incident['dateOpened']; ?></td>
                        <td><?php echo $incident['dateClosed']; ?></td>
                        <td><?php echo $incident['title']; ?></td>
                        <td><?php echo $incident['description']; ?></td>

                        <td>
                            <form action="technician_incident_edit.php" method="post">
                                <input type="hidden" name="incidentID"
                                       value="<?php echo $incident['incidentID']; ?>"/>

                                <input type="hidden" name="customerID"
                                       value="<?php echo $incident['customerID']; ?>"/>

                                <input type="hidden" name="productCode"
                                       value="<?php echo $incident['productCode']; ?>"/>

                                <input type="hidden" name="dateOpened"
                                       value="<?php echo $incident['dateOpened']; ?>"/>

                                <input type="hidden" name="dateClosed"
                                       value="<?php echo $incident['dateClosed']; ?>"/>

                                <input type="hidden" name="title"
                                       value="<?php echo $incident['title']; ?>"/>

                                <input type="hidden" name="description"
                                       value="<?php echo $incident['description']; ?>"/>

                                <input type="submit" value="Update">
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </section>
    </main>
<?php include '../view/footer.php'; ?>