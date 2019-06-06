<?php
session_set_cookie_params(3600, "/");

session_start(); // ready to go!
// Authenticate user
if (!isset($_SESSION['customerID'])) {
    $_SESSION['login_error_msg'] = "You aren't authorized to view this page";
    header("location: ../errors/error.php");
    exit; // prevent further execution, should there be more code that follows
}

include '../view/header.php';
?>

<main>
    <h1>Success</h1>
    <br>
    Product successfully registered to <?php echo $_SESSION['customer_name']; ?>
</main>
<?php include '../view/footer.php'; ?>