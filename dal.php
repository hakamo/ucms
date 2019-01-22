<?php

$config = include('config.php');

function GetConnection()
{  
    ini_set('error_reporting',   E_COMPILE_ERROR);


    $conn = mysql_connect( $GLOBALS['config']['db_host'] , $GLOBALS['config']['db_user'],  $GLOBALS['config']['db_pass'] );
    
    if(!$conn)
        die("could not connect to db");
    
    mysql_query("SET NAMES 'utf8'", $conn);
    mysql_query("set character_set_client='utf8'");
    mysql_query("set character_set_results='utf8'"); 
    mysql_query("set collation_connection='utf8_general_ci'");
    
    $db_selected = mysql_select_db( $GLOBALS['config']['db_name']  , $conn );
    
    if(!$db_selected)
        die("Not connected : " . mysql_errno($conn) ."  ". mysql_error($conn) );
    
    return $conn;
}

?>