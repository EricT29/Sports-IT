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

    <script type="module">
        var customers = <?php
            echo json_encode(array_column(get_customers_by_email(), "Email"));
            ?>;
        import('../autocomplete.js').then(module => {
            module.autocomplete(document.getElementById("customers"), customers);
        });
    </script>

    <link rel="stylesheet" type="text/css" media="all" href="../list.css">

    <main>
        <h1 style="margin-left: 10px;">Add Incident</h1>

        <?php
        $incidentID = rand(10000000, 99999999);
        //$customerID = filter_input(INPUT_POST, 'customerID', FILTER_VALIDATE_INT);
        $productCode = filter_input(INPUT_POST, 'productCode');
        $techID = filter_input(INPUT_POST, 'techID');
        $dateOpened = filter_input(INPUT_POST, 'dateOpened');
        $dateClosed = filter_input(INPUT_POST, 'dateClosed');
        $title = filter_input(INPUT_POST, 'title');
        $description = filter_input(INPUT_POST, 'description');
        ?>

        <form autocomplete="off" action="../incident_manager/incident_form_handler.php" method="post"
              id="add_customer_form">
            <div class="inputs">
                <input type="hidden" name="action" value="technician_add_incident">

                <input type="hidden" name="techID" value="<?php echo $_SESSION['technician_id']; ?>"/>

                <div class="" style="width:300px;">
                    <br>
                    <label>Customer:
                        <input id="customers" type="text" name="email"/>
                    </label>
                    <br>
                </div>

                <br>
                <label>Product:
                    <?php $products = get_products(); ?>
                    <select name="productCode">
                        <?php foreach ($products as $product) : ?>
                            <option value="<?php echo $product['productCode']; ?>">
                                <?php echo $product['name']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </label>
                <br>

                <br>
                <label>Title:
                    <input type="text" name="title"/>
                </label>
                <br>

                <br>
                <label>Date Opened:
                    <input type="text" name="dateOpened" value=<?php echo date('Y-m-d H:i:s') ?> readonly/>
                </label>
                <br>

                <br>
                <label>Description:
                    <input type="text" name="description"/>
                </label>
                <br>
            </div>

            <label>&nbsp;</label>
            <input type="submit" value="Submit" class="edit_btn"/>
        </form>

    </main>
<?php include '../view/footer.php'; ?>