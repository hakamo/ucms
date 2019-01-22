<?php

include 'dal.php';
include 'func.php';
include 'menugenerator.php';

header('content-type:text/html;charset=utf-8');

?>

<!doctype html>
<html lang="fa">
<head>

    <meta charset="utf-8">
    <title><?php echo  $GLOBALS['config']['site_name'] ?></title>
    <meta name="description" content="Buy and rent house in Turkey - International Trading ">

    <link rel="stylesheet" href="css/styles.css?v1.0">
    <link rel="stylesheet" href="css/styles_nav.css?v1.0">
    <link rel="stylesheet" href="css/flexslider.css?v1.0">
</head>


<body>

    <div class="mrgAuto">

        <div class="LogoTop"></div>

        <div class="para"></div>

        <div class="search-block">
            <form method="get" id="searchform" action="search.php">
                <input class="search-button" value="" type="submit">
                <input id="s" name="s" value="جستجو..." onfocus="if (this.value == 'جستجو...') {this.value = '';}" onblur="if (this.value == '') {this.value = 'جستجو...';}" type="text">
            </form>
        </div>



        <?php 

        $menu = new MenuBuilder();
        echo htmlspecialchars_decode($menu->get_menu_html());

        ?>

        <div class="flexslider">
            <ul class="slides">
                <?php  slider_items_generator(); ?>
            </ul>
        </div>


        <!-- jQuery -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/libs/jquery-1.7.min.js">\x3C/script>')</script>

        <!-- FlexSlider -->
        <script defer src="js/jquery.flexslider.js"></script>

        <script type="text/javascript">
            $(function () {
                SyntaxHighlighter.all();
            });
            $(window).load(function () {
                $('.flexslider').flexslider({
                    animation: "slide",
                    start: function (slider) {
                        $('body').removeClass('loading');
                    }
                });
            });
        </script>


        <?php productBoxGenerator(4); ?>


        <div class="para"></div>

        <div class="content-main">

            <div class="post-title">

                <h1>
                    <?php load_post_title(1) ?>
                </h1>

            </div>

            <?php  load_pages(1) ?>
        </div>


        <footer>

            <div id="footer-first" class="footer-widgets-box">

                <div id="rss-2" class="footer-widget widget_rss">
                    <div class="footer-widget-top">
                        <h4>
                            <a class="rsswidget" href="http://3e7en.com/feed/" title="پیگیری با RSS.">
                                <img style="border: 0" width="14" height="14" src="img/rss.png" alt="RSS">
                            </a>
                            <a class="rsswidget" href="http://3e7en.com/" title="ستی">آخرین محصولات</a>
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


<?php include('footer.php') ?>

</body>
</html>
