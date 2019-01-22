<?php
session_start();

if( !isset($_SESSION[user_name]) ){
    header("location:../login/");
}

include('url_slug.php');

include '../dal.php';
GetConnection();

if(isset($_GET["command"])&&$_GET["command"]!="")
{
    if($_GET["command"] == "read")
    {
        $query = "SELECT id , post_author , slug FROM cms_post  ";

        $result = mysql_query($query);
		
		if($result) 
        {
            $row = mysql_fetch_row($result );

            echo json_encode($row);
            exit();
        }
			
    }

}

if(isset($_POST["command"])&&$_POST["command"]!="")
{

   

	if($_POST["command"] == "LastIndex")
	{
		$iquery = "SELECT `AUTO_INCREMENT` FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$cms_db_Name' AND TABLE_NAME = 'cms_post'";
		//$iquery = "SELECT id FROM cms_post ORDER BY id DESC LIMIT 1 ";	
		
		$result = mysql_query($iquery);
		
		if($result) 
			$row = mysql_fetch_row($result );
		else die("no result");	
		
		if($row)
		{
			//$path = "http://".$_SERVER['SERVER_NAME'].dirname($_SERVER['REQUEST_URI'])."/"."page.php?page_id=".$row[0];
			$path = "http://".$_SERVER['SERVER_NAME'].dirname($_SERVER['REQUEST_URI'])."page.php?page_id=".$row[0];
			$answer = array($row[0],$path);
			echo (json_encode($answer));
        }

        
		exit;	
	}
	
	if($_POST["command"] == "Add" && isset($_POST["PageTitle"]) && isset($_POST["PageSlug"]) && isset($_POST["PageBody"]) && isset($_POST["PageGUID"]) )
	{				
		$val1 = $_POST["PageTitle"];
		$val2 = $_POST["PageBody"];
		$val3 = $_POST["PageGUID"];
		$val4 = url_slug($_POST["PageSlug"]);
        
		$iquery = "INSERT INTO cms_post (post_title,post_content,post_guid,slug) VALUES ('$val1','$val2','$val3','$val4')";
		
        $result = mysql_query($iquery);
		
		if ( $result == false )
			echo "error";					
		else					
			echo "AddOK";							 		
		exit;	
	}
	
	//params = "command=" + command + "&CurrentIndex=" + CurrentIndex + "&PageTitle=" + _PageTitle + "&PageSlug=" + _PageSlug + "&PageBody=" + _PageBody;
	//UPDATE table_name SET column1=value, column2=value2,... WHERE some_column=some_value 
	
	
	
	if($_POST["command"] == "Edit" && isset($_POST["PageTitle"]) && isset($_POST["PageSlug"]) && isset($_POST["PageBody"]) && isset($_POST["PageGUID"]) && isset($_POST["CurrentIndex"]) )
	{	
        
		$val1 = $_POST["PageTitle"];
		$val2 = $_POST["PageBody"];
		$val3 = $_POST["PageGUID"];
		$val4 = url_slug($_POST["PageSlug"]);
		$val5 = $_POST["CurrentIndex"];				
		$iquery = "UPDATE cms_post SET  post_title='$val1',post_content= '$val2',post_guid='$val3',slug='$val4' WHERE id='$val5' ";	
		
		$result = mysql_query($iquery);
		
		if ( $result == false )
			echo "error";					
		else
			echo "EditOK";							 		
		exit;	
	}
	
	if($_POST["command"] == "Delete" && isset($_POST["CurrentIndex"]) )
	{					
		$val5 = $_POST["CurrentIndex"];		
		
		if($val5 == 1)
		{
			echo "error";	
			exit;	
		}
        
		$iquery = "DELETE FROM cms_post  WHERE id='$val5' ";	
		
		$result = mysql_query($iquery);
		
		if ( $result == false )
			echo "error";				
		else
			echo "DeleteOK";	
        
		exit;	
	}	
	
	
	echo "unknown command";
	exit;
}
else
{
	echo("error in post");
	exit;
}


?>