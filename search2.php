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

<!doctype html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <title>Parlak Turk</title>
    <meta name="description" content="About my site!">
    <link rel="stylesheet" href="css/styles.css?v1.0">
    <link rel="stylesheet" href="css/styles_nav.css?v1.0">
    <link rel="stylesheet" href="css/flexslider.css?v1.0">
</head>


<body>

    <div class="mrgAuto">

        <div class="LogoTop"></div>



        <div class="para"></div>

        <div class="search-block">
            <form method="get" id="searchform" action="page.php">
                <input class="search-button" value="" type="submit">
                <input id="s" name="s" value="جستجو..." onfocus="if (this.value == 'جستجو...') {this.value = '';}" onblur="if (this.value == '') {this.value = 'جستجو...';}" type="text">
            </form>
        </div>


        <?php 
            $menu = new MenuBuilder();
            echo htmlspecialchars_decode($menu->get_menu_html());
        ?>



        <div class="content-main">
            <div class="post-title">
                <h1>
                    <?php   echo ("نتایج جستجو برای :  ".$_GET["s"]); ?>
                </h1>
            </div>
            <?php    $val = $_GET["s"];
                     doSearch($val); ?>
        </div>

        <footer>

            <div id="footer-first" class="footer-widgets-box">


                <div id="rss-2" class="footer-widget widget_rss">
                    <div class="footer-widget-top">
                        <h4>
                            <a class="rsswidget" href="#" title="پیگیری با RSS.">
                                <img style="border: 0" width="14" height="14" src="img/rss.png" alt="RSS">
                            </a>
                            <a class="rsswidget" href="#" title="ستی">آخرین محصولات</a>
                        </h4>
                    </div>
                    <div class="footer-widget-container">

                        <?php LatestProduct(5); ?>

                    </div>
                </div>
                <!-- .widget /-->



            </div>

        </footer>

    </div>


    <div class="fullFooter">
        <div class="copyrights">

            <?php getCopyRight(); ?>

            <a href="http://www.hakamo.org" target="_blank">Design by HAKAMO</a>


        </div>
    </div>


</body>
</html>
