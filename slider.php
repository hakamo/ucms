<?php                     

$result = mysql_query("select * from cms_slide ORDER BY id ASC" );      

$rowcount=mysqli_num_rows($result);

echo '<div id="myCarousel" class="carousel slide" data-ride="carousel">'."\n";

echo '<ol class="carousel-indicators">'."\n";

$length = $rowcount;

for ($i = 1; $i <= $length; $i++)
{
    echo '<li data-target="#myCarousel" data-slide-to="'.$i.'" ></li>'."\n";
}                            

echo '</ol>'."\n";

echo '<div class="carousel-inner">'."\n";



$slide_index = 0;

while ($record = mysql_fetch_assoc($result, MYSQL_ASSOC))
{                            
    
    if($slide_index == 0)
        echo '<div class="carousel-item  active">'."\n";
    else
        echo '<div class="carousel-item ">'."\n";

    echo '<svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img">'."\n";
    echo '<rect fill="#707" width="100%" height="100%" />'."\n";
    echo '<image href="'.$record['file_name'].'" style="width:100%;"  />'."\n";
    echo '</svg>'."\n";


    echo '<div class="container">'."\n";
    echo '<div class="carousel-caption text-right">';
    echo '<h1>'.$record['title'].'</h1>'."\n";
    echo '<p>'.$record['description'].'</p>'."\n";
    echo '<p><a class="btn btn-lg btn-primary" href="'.$record['url'].'" role="button">بخوانید</a></p>'."\n";
    echo '</div>'."\n";

    echo '</div>'."\n";   
    echo '</div>'."\n"; 

    $slide_index++;
    
}

echo '</div>';

echo   '            <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>

';

echo '</div>';

?>