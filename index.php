<?php

include 'dal.php';
include 'func.php';
include 'menugenerator.php';

GetConnection();

?>

<!DOCTYPE html>
<html lang="fa">
<head>

    <?php include('head_script.php') ?>

    <style>
        /* CUSTOMIZE THE CAROUSEL
-------------------------------------------------- */

        /* Carousel base class */
        .carousel {
            margin-bottom: 4rem;
        }
        /* Since positioning the image, we need to help out the caption */
        .carousel-caption {
            bottom: 3rem;
            z-index: 10;
        }

        /* Declare heights because of positioning of img element */
        .carousel-item {
            height: 32rem;
        }

            .carousel-item > img {
                position: absolute;
                top: 0;
                left: 0;
                min-width: 100%;
                height: 32rem;
            }


        /* MARKETING CONTENT
-------------------------------------------------- */

        /* Center align the text within the three columns below the carousel */
        .marketing .col-lg-4 {
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .marketing h2 {
            font-weight: 400;
        }

        .marketing .col-lg-4 p {
            margin-right: .75rem;
            margin-left: .75rem;
        }


        /* Featurettes
------------------------- */

        .featurette-divider {
            margin: 5rem 0; /* Space out the Bootstrap <hr> more */
        }

        /* Thin out the marketing headings */
        .featurette-heading {
            font-weight: 300;
            line-height: 1;
            letter-spacing: -.05rem;
        }


        /* RESPONSIVE CSS
-------------------------------------------------- */

        @media (min-width: 40em) {
            /* Bump up size of carousel content */
            .carousel-caption p {
                margin-bottom: 1.25rem;
                font-size: 1.25rem;
                line-height: 1.4;
            }

            .featurette-heading {
                font-size: 50px;
            }
        }

        @media (min-width: 62em) {
            .featurette-heading {
                margin-top: 7rem;
            }
        }
    </style>

</head>

<body>

        <?php include('header.php') ?>
      <?php include('navbar.php') ?>

  


    <div class="container" style="margin-top: 30px">

        <?php include('slider.php') ?>

        <div class="row">

            <div class="col-sm-8">

                <?php                     

                $result = mysql_query("select * from cms_products ORDER BY id DESC");

                while ($record = mysql_fetch_assoc($result, MYSQL_ASSOC))
                {
                    echo '<div class="card">';

                    echo '<div class="card-header">';
                    echo  "<h2>".$record['product_title']."</h2>";  
                    echo '</div>';

                    echo '<div class="card-body">';
                    echo "<img src=\"".$record['product_picture_url']."\" class=\"rounded mx-auto d-block\" alt=\"".$record['product_title']."\">";
                    echo "<br>";
                    echo "<p>".$record['product_description']."</p>";
                    echo '<a type="button" class="btn btn-danger" href='.$record['product_page_url'].' >ادامه مطلب</a>';                                       
                    echo '</div>';
                    echo '</div>';

                    echo "<br>";
                }

                ?>

            </div>

            <div class="col-sm-4">
                
                <hr class="d-sm-none">

                 <?php include('latest_topics.php') ?>


            </div>

            <div class="col-sm-4">
            </div>
        </div>

    </div>
    </div>
   
    <?php include('footer.php') ?>

</body>

</html>
