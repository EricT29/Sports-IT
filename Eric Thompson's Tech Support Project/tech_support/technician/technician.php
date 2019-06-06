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
?>

    <!DOCTYPE html>
    <link rel="stylesheet" type="text/css" media="all" href="../admin/admin.css">

    <div class="btn-group">
        <h1>Manage Your Incidents</h1>
        <button id="create_btn"> Create Incidents</button>
        <button id="display_btn"> Display Incidents</button>
    </div>

    <script>
        var btn = document.getElementById('create_btn');
        btn.addEventListener('click', function () {
            document.location.href = '../incident_manager/technician_incident_add.php';
        });

        var btn = document.getElementById('display_btn');
        btn.addEventListener('click', function () {
            document.location.href = '../incident_manager/technician_incident_list.php';
        });
    </script>

<?php include '../view/footer.php'; ?>