<?php


function getCopyRight()
{	
	$year = date("Y");
	$SiteName = "Parlak Turk";
	$SiteAddress = "http://www.ParlakTurk.com";
	
	$result = "";	
	echo $result;
}

function load_menu_records()
{
	$result = mysql_query("select * from menu_item ORDER BY id ");	
    
    $outputString = "";  
    
    while ($row = mysql_fetch_assoc($result, MYSQL_NUM)) 
    {
        $outputString .= "\r\n" . "<tr>" 
        . "\r\n" . "<td>" . "$row[4]" . "</td>" . "\r\n" 
        . "\r\n" . "<td>" . "$row[3]" . "</td>" . "\r\n" 
        . "\r\n" . "<td>" . "$row[2]" . "</td>" . "\r\n" 
        . "\r\n" . "<td>" . "$row[1]" . "</td>" . "\r\n" 
        . "\r\n" . "<td>" . "$row[0]" . "</td>" . "\r\n" 
        . "</tr>" . "\r\n" ;        		
	}
	
	echo $outputString;
}	

function load_pageeditor_table()
{
	$result = mysql_query("select * from cms_post ORDER BY id ");   
    
    $outputString = "";  
    
    while ($row = mysql_fetch_assoc($result, MYSQL_NUM)) 
    {
        $outputString .= "\r\n" . "<tr>" 
        . "\r\n" . "<td>" . "$row[4]" . "</td>" . "\r\n"
        . "\r\n" . "<td>" . "$row[7]" . "</td>" . "\r\n" 
        . "\r\n" . "<td>" . "$row[8]" . "</td>" . "\r\n" 
        . "\r\n" . "<td>" . "$row[5]" . "</td>" . "\r\n" 
        . "\r\n" . "<td>" . "$row[0]" . "</td>" . "\r\n" 
        . "</tr>" . "\r\n" ;        		
	}
	
	echo $outputString;
}

function slider_items_generator()
{
	$path    = 'resource/slider/';		
	$files = scandir($path);	
	$arrlength = count($files);
	$retStr = "";
	
	for($index = 2; $index  < $arrlength; $index++) 
	{		
		$retStr .="<li>";
		$retStr .= "<img src='http://".$_SERVER['HTTP_HOST']."/".$path.$files[$index]."' />";
		$retStr .="</li>";
		$retStr .="\n\r";
	}	
	echo $retStr;
}

$search_any_Result = false;

function doSearch($val)
{		
	$result = mysql_query("select * from cms_post");	
	
	$num_rows = mysql_num_rows($result);		
    
    if($num_rows >= 1)
    {	
        while ($row = mysql_fetch_assoc($result , 1)) 
        {                         	
            if(serach_content($row["post_content"],$val))
            {                
                echo ("<br>");
                echo ("<a href=\"page.php?id=".$row['id']."\">!ادامه مطلب. کلیک کنید</a>"); 
                echo ("<br>"."<hr>"."<br>");
            }
        }
    }
    
    if($GLOBALS['$search_any_Result']  == false)
        echo("چیزی یافت نشد.");
    
}

function serach_content($contents,$searchfor)
{
    $contents = strip_tags($contents);

    $pattern = preg_quote($searchfor, '/');
    // finalise the regular expression, matching the whole line
    $pattern = "/^.*$pattern.*\$/m";
    // search, and store all matching occurences in $matches
    if(preg_match_all($pattern, $contents, $matches))
    {
        $GLOBALS['$search_any_Result']  = true;      
        $result = implode("\n", $matches[0]);   
        //echo '<p>'.substr(strip_tags($result),0, 300).'</p>'  ;
        echo '<p>'.substr(($result),0, 300).'</p>'  ;

        return true;
    }
    else
        return false;

}

function productBoxGenerator($numberOfItem)
{
    $new_array = Array();

    $result = mysql_query("select id from cms_products ORDER BY id ");

    while ($arr = mysql_fetch_assoc($result, MYSQL_NUM))
    {
        $new_array[] = $arr[0];
    }

    $random_keys=array_rand($new_array,$numberOfItem);

    for($index = 0; $index  < $numberOfItem; $index++) 
	{		
		$idx = $new_array[$random_keys[$index]];
		
		
		$result1 = mysql_query("select * from cms_products WHERE id =  $idx ");
		$input = mysql_fetch_assoc($result1, MYSQL_NUM);
		
		echo "<div class=\"productBox\">";						
		echo "<a href=\" $input[3] \">";		
		echo "<img src= \" $input[4] \" alt=\" $input[2] \" height=\"150px\" width=\"200px\">"; 
		echo "</a>";
		echo "<div class=\"productTitle\">";
		echo "<a href=\" $input[3] \">";
		echo "<h2>$input[1]</h2>";
		echo "</a>";
		echo "</div>";
		echo "<div class=\"description\">";
		echo "$input[2]";		
		echo "</div>";
		echo "<a class=\"button_Detail\" href=\"$input[3]\">مشاهده مشخصات</a>";
		echo "</div>";		        
	}

}

function LatestProduct($numberOfItem)
{
	$result = mysql_query("select * from cms_products ORDER BY id DESC");
	
	$outputStr = "";
	
	for($index = 0; $index  < $numberOfItem; $index++) 
	{	
		$arr = mysql_fetch_assoc($result, MYSQL_NUM);
        
		$outputStr .= "<li>";
		$outputStr .= "<a class=\"rsswidget\" href=\"$arr[3]\" title=\"$arr[2]\">$arr[2]</a>";
		$outputStr .= "</li>";		
	}
	echo $outputStr;	
}

function load_post_title($_pageid)
{
	
	$result = mysql_query("select * from cms_post WHERE id='$_pageid' ");	
	
	$num_rows = mysql_num_rows($result);		
    
    if($num_rows == 1)
    {	
        while ($row = mysql_fetch_assoc($result)) 
        {
            echo $row["post_title"];
        }
    }
    else
    {
        exit;
    }			
}

function load_pages($_pageid)
{	
	$result = mysql_query("select * from cms_post WHERE id='$_pageid' ");	
	
	$num_rows = mysql_num_rows($result);		
    
    if($num_rows == 1)
    {	
        while ($row = mysql_fetch_assoc($result)) 
        {
            echo $row["post_content"];
        }
    }
    else
    {
        exit;
    }			
}

?>