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
include '../model/database.php';
require('../model/incident_db.php');
?>

<link rel="stylesheet" type="text/css" media="all" href="../list.css">

<main>
    <h1 style="margin-left: 10px;">Update Incident</h1>

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
            <input type="hidden" name="action" value="technician_edit_incident">

            <input type="hidden" name="incidentID" value="<?php echo $incident['incidentID']; ?>"/>

            <input type="hidden" name="techID" value="<?php echo $_SESSION['technician_id']; ?>"/>

            <input type="hidden" name="dateOpened" value="<?php echo $incident['dateOpened']; ?>"/>

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
            <label>Date Opened:
                <input type="text" value="<?php echo $incident['dateOpened']; ?>" readonly/>
            </label>
            <br>

            <br>
            <label>Date Closed:
                <input type="text" id="dateClosed" name="dateClosed" value="<?php echo $incident['dateClosed']; ?>"
                       readonly/>
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

        <label>&nbsp</label>
        <input type="submit" value="Update" class="update_btn"/>

        <input type="submit" id="close_btn" value="Close" class="close_btn"/>
    </form>

</main>
<?php include '../view/footer.php'; ?>

<script>
    var btn = document.getElementById('close_btn');
    var dateClosed = document.getElementById('dateClosed');

    if (dateClosed.value.length > 0) {
        btn.style.display = "none";
    } else {
        btn.addEventListener('click', function () {
            dateClosed.value = <?php echo json_encode(date('Y-m-d H:i:s')); ?>;
        });
    }
</script>