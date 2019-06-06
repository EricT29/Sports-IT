<?php
session_set_cookie_params(3600, "/");

session_start(); // ready to go!
// Authenticate user
if (isset($_SESSION['admin_id'])) {
    header("location: admin/admin.php");
    exit; // prevent further execution, should there be more code that follows
}
if (isset($_SESSION['technician_id'])) {
    header("location: technician/technician.php");
    exit; // prevent further execution, should there be more code that follows
}
if (isset($_SESSION['customerID'])) {
    header("location: product_manager/product_register.php");
    exit; // prevent further execution, should there be more code that follows
}
?>

<!DOCTYPE html>
<link rel= "stylesheet" type = "text/css" media = "all" href = 'login/login.css'>
<div class="login-page">

    <div class="form">
        <form class="login-form" id="login" action="login/login.php" method="post">
            <input name = "username" type="text" placeholder="username"/>
            <input name = "password" type="password" placeholder="password"/>
            <button  name="submit" value="Submit">login</button>
        </form>
    </div>
</div>