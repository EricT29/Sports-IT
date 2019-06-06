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
require('../model/incident_db.php');
?>

    <link rel="stylesheet" type="text/css" media="all" href="../list.css">

    <main>
        <h1 style="margin-left: 10px;">Edit Incident</h1>

        <?php
        $incident['incidentID'] = filter_input(INPUT_POST, 'incidentID');
        $incident['customerID'] = filter_input(INPUT_POST, 'customerID');
        $incident['productCode'] = filter_input(INPUT_POST, 'productCode');
        $incident['techID'] = filter_input(INPUT_POST, 'techID');
        $incident['dateOpened'] = filter_input(INPUT_POST, 'dateOpened');
        $incident['dateClosed'] = filter_input(INPUT_POST, 'dateClosed');
        $incident['title'] = filter_input(INPUT_POST, 'title');
        $incident['description'] = filter_input(INPUT_POST, 'description');
        ?>

        <form action="../incident_manager/incident_form_handler.php" method="post" id="edit_incident_form">
            <div class="inputs">
                <input type="hidden" name="action" value="edit_incident">

                <input type="hidden" name="techID" value="<?php echo $incident['incidentID']; ?>"/>

                <br>
                <label>Customer:
                    <input type="text" name="customerID" value="<?php echo $incident['customerID']; ?>" readonly/>
                </label>
                <br>

                <br>
                <label>Product:
                    <input type="text" name="productCode" value="<?php echo $incident['productCode']; ?>" readonly/>
                </label>
                <br>

                <br>
                <label>Technician:
                    <input type="text" name="technician"
                           value="<?php echo get_technician_name_by_ID($incident['techID']); ?>" readonly/>
                </label>
                <br>

                <input type="hidden" name="techID" value="<?php echo $incident['techID']; ?>"/>

                <br>
                <label>Date Opened:
                    <input type="text" name="dateOpened" value="<?php echo $incident['dateOpened']; ?>" readonly/>
                </label>
                <br>

                <br>
                <label>Date Closed:
                    <input type="text" name="dateClosed" value="<?php echo $incident['dateClosed']; ?>" readonly/>
                </label>
                <br>

                <br>
                <label>Title:
                    <input type="text" name="title" value="<?php echo $incident['title']; ?>"/>
                </label>
                <br>

                <br>
                <label>Description:
                    <input type="text" name="description" value="<?php echo $incident['description']; ?>"/>
                </label>
                <br>
            </div>

            <label>&nbsp;</label>
            <input type="submit" value="Submit" class="edit_btn"/>
        </form>

    </main>
<?php include '../view/footer.php'; ?>