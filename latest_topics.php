<?php

?>
<div class="card mb-4 shadow-sm">
    <div class="card-header">
        <h4 class="my-0 font-weight-normal">آخرین مطالب</h4>
    </div>
    <div class="card-body">
        <ul class="list-unstyled mt-3 mb-4">
            <?php                     

            $result = mysql_query("select * from cms_products ORDER BY id DESC Limit 6");

            while ($record = mysql_fetch_assoc($result, MYSQL_ASSOC))
            {
                echo '<li><a class="nav-link" href="'.$record['product_page_url'].'">'.$record['product_title'].'</a></li>';
            }

            ?>

        </ul>

    </div>
</div>
