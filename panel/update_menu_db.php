<?php

session_start();

if( isset($_SESSION[user_name]) ){
    header("location:../login/");
}
include '../dal.php';

GetConnection();

$pagetitle  = $_POST["PageTitle"];
$pagelink   = $_POST["PageLink"];
$motherlink = $_POST["MotherLink"];
$linkindex  = $_POST["LinkIndex"];
$command    = $_POST["Command"];
$indx 	    = $_POST["Index"];
$currentID  = $_POST["currentID"];

$query_ = "";


if( isset($_POST["Command"]) && $_POST["Command"]!="" )
{
	
	if($command == "delete")
	{
		$query_ = "DELETE FROM menu_item  WHERE id='$indx'";		
		CompleteAction("DeleteOK" , $query_);
	}
	
	if($command == "add")	
	{
		$query_ = "INSERT INTO menu_item (`id`, `title`, `link`, `parent_id`, `position`) VALUES ($indx,'$pagetitle','$pagelink',$motherlink,$linkindex)";
		CompleteAction("AddOK" , $query_);
	}
	
	if($command == "edit")	
	{
		$query_ = "UPDATE  menu_item  SET  title='$pagetitle' , link='$pagelink'  , parent_id = '$motherlink' , position = '$linkindex' , id='$indx'  WHERE  id='$currentID' ";
		CompleteAction("EditOK" , $query_);
	}	
    
	exit;
}
else
	exit;


function CompleteAction($row , $query_)
{
	exceute_query($query_);	
	$path = load_menu();	
	
	//$row = $query_;
	$answer = array($row,$path);
	echo (json_encode($answer));
}

function exceute_query($_query)
{				
	$result = mysql_query($_query);	
	
	if ( $result === false ){	
		echo("Inser error");
		exit;
	}	
	return $result;		        	     	        
}

function load_menu()
{
	$result = exceute_query("select * from menu_item ORDER BY id ");
    
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
	
	return $outputString;
}

?>