<?php

include 'dal.php';
include 'func.php';
include 'menugenerator.php';

if( isset($_GET["s"]) && $_GET["s"] != "" )
{  		
	$_pageid = $_GET["page_id"];
}
else
{
	header("location:/index.php");
}

?>

<!DOCTYPE html>
<html lang="fa">
<head>
    <?php include('head_script.php') ?>
</head>

<body>
    <?php include('header.php') ?>
    <?php include('navbar.php') ?>


    <div class="container" style="margin-top: 30px">

       

        <div class="row">

            <div class="col-sm-8">

                <div class="card">

                    <div class="card-header">
                        <h2>
                            
                            <?php   echo ("نتایج جستجو برای :  ".$_GET["s"]); ?>

                        </h2>
                    </div>
                    <div class="card-body">
                         <?php    $val = $_GET["s"];
                                  doSearch($val); ?>
                    </div>
                </div>



            </div>

            <div class="clear"></div>

            <div class="col-sm-4">

                <?php include('about_author.php') ?>

                <hr class="d-sm-none">

                <?php include('latest_topics.php') ?>


            </div>

        </div>

        <div class="row"></div>

    </div>

   
    <?php include('footer.php') ?>

</body>

</html>
