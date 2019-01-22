<?php
session_start();

if( !isset($_SESSION[user_name]) ){
    header("location:../login/");
}

?>

<!doctype html>
<html lang="en">
<head>


    <?php include('../head_script.php') ?>

</head>
<body>   

    <?php include('navbar.php') ?>

    <div  class="container">
        <div class="jumbotron">
            <h1>Navbar example</h1>
            <p class="lead">This example is a quick exercise to illustrate how the top-aligned navbar works. As you scroll, this navbar remains in its original position and moves with the rest of the page.</p>
            <a class="btn btn-lg btn-primary" href="/docs/4.2/components/navbar/" role="button">View navbar docs &raquo;</a>
        </div>
    </div>

</body>
</html>

