<?php // written by Eric M. Thompson
session_set_cookie_params(3600, "/");

session_start(); // ready to go!
// Authenticate user
if (!isset($_SESSION['admin_id'])) {
    $_SESSION['login_error_msg'] = "You aren't authorized to view this page";
    header("location: ../errors/error.php");
    exit; // prevent further execution, should there be more code that follows
}
include '../view/header.php';
?>

    <!DOCTYPE html>
    <link rel="stylesheet" type="text/css" media="all" href="admin.css">
    <div class="btn-group">
        <h1>Management</h1>
        <button id="techs_btn"> Manage Technicians</button>
        <button id="products_btn"> Manage Products</button>
        <button id="customers_btn"> Manage Customers</button>
    </div>

    <script>
        var btn = document.getElementById('techs_btn');
        btn.addEventListener('click', function () {
            document.location.href = '../technician_manager/technician_list.php';
        });

        var btn = document.getElementById('products_btn');
        btn.addEventListener('click', function () {
            document.location.href = '../product_manager/product_list.php';
        });

        var btn = document.getElementById('customers_btn');
        btn.addEventListener('click', function () {
            document.location.href = '../customer_manager/customer_list.php';
        });
    </script>

    <div class="btn-group">
        <h1>Incidents</h1>
        <button id="create_btn"> Create Incidents</button>
        <button id="assign_btn"> Assign Incidents</button>
        <button id="display_btn"> Display Incidents</button>
    </div>

    <script>
        var btn = document.getElementById('create_btn');
        btn.addEventListener('click', function () {
            document.location.href = '../incident_manager/incident_add.php';
        });

        var btn = document.getElementById('assign_btn');
        btn.addEventListener('click', function () {
            document.location.href = '../incident_manager/incident_assign.php';
        });

        var btn = document.getElementById('display_btn');
        btn.addEventListener('click', function () {
            document.location.href = '../incident_manager/incident_list.php';
        });
    </script>

<?php include '../view/footer.php'; ?>