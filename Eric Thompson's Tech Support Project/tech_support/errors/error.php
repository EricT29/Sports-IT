<link rel="stylesheet" type="text/css" media="all" href="../main.css">
<?php
include '../view/header.php';
session_set_cookie_params(3600, "/");
// written by Eric M. Thompson
session_start(); // ready to go!
?>
<div id="main" class="error">
    <h1 class="top">Error</h1>
    <p><?php echo $_SESSION['login_error_msg']; ?></p>
</div>
<?php include '../view/footer.php'; ?>