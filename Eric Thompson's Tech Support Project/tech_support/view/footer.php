<link rel="stylesheet" type="text/css" media="all" href="main.css">

<div id="footer">
    <div id="home">
        <button id="home_btn">Home</button>
    </div>
    <div id="sign_out">
        <button id="sign_out_btn">Sign Out</button>
    </div>
</div>

<script>
    var btn = document.getElementById('home_btn');
    btn.addEventListener('click', function () {
        document.location.href = '../index.php';
    });

    var btn = document.getElementById('sign_out_btn');
    btn.addEventListener('click', function () {
        document.location.href = '../login/logout.php';
    });
</script>