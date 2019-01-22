<?php

if( !isset($_GET["id"]) || $_GET["id"] == "" )
{  		
	header("location:/");    
}

include 'dal.php';
include 'func.php';
include 'menugenerator.php';

GetConnection();

$page_id = $_GET["id"];

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
                            <?php                     
                            load_post_title($page_id) 
                            ?>

                        </h2>
                    </div>
                    <div class="card-body">
                        <?php  load_pages($page_id) ?>
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
