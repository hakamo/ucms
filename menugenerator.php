<?php

/**
 * Generate HTML for multi-dimensional menu from MySQL database
 * with ONE QUERY and WITHOUT RECURSION 
 * @author J. Bruni
 */

mb_internal_encoding('UTF-8');


class MenuBuilder
{
	var $test;
	/**
     * MySQL connection
     */
	var $conn;

	/**
     * Menu items
     */
	var $items = array();
	
	/**
     * HTML contents
     */
	var $html  = array();
	
	/**
     * Create MySQL connection
     */
	function MenuBuilder()
	{
		$this->conn = GetConnection();
	}
	
	/**
     * Perform MySQL query and return all results
     */
	function fetch_assoc_all( $sql )
	{
		//$result = mysql_query( $sql, $this->conn );
		
		$result = mysql_query( $sql);				
		
		if ( !$result )
			return false;
		
		$assoc_all = array();

		while( $fetch = mysql_fetch_assoc( $result ) )
			$assoc_all[] = $fetch;

		mysql_free_result( $result );
		
		return $assoc_all;
	}
	
	/**
     * Get all menu items from database
     */
	function get_menu_items()
	{

		// Change the field names and the table name in the query below to match tour needs
		$sql = 'SELECT id, parent_id, title, link, position FROM menu_item ORDER BY id DESC';
		return $this->fetch_assoc_all( $sql );
	}
	
	/**
     * Build the HTML for the menu 
     */
	function get_menu_html( $root_id = 0 )
	{
		$this->html  = array();
        $children = array();

		$this->items = $this->get_menu_items();
		
		foreach ( $this->items as $item )
			$children[$item['parent_id']][] = $item;
		
		// loop will be false if the root has no children (i.e., an empty menu!)
		$loop = !empty( $children[$root_id] );
		
		// HTML wrapper for the menu (open)
		$this->html[] = '<ul  class="navbar-nav mr-auto">';

        if($loop)
            foreach ($children[$root_id] as $root_item)
            {

                if(!empty($children[$root_item['id']])){                

                    $this->html[] = '<li class="nav-item dropdown">';

                    $this->html[] = '<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">'.$root_item["title"].'</a>';

                    $this->html[] = '<div class="dropdown-menu">';

                    foreach ($children[$root_item['id']] as $sub_item)
                    {
                        $this->html[] = '<a class="dropdown-item" href="'.$sub_item["link"].'" >'.$sub_item["title"].'</a>';
                    }

                    $this->html[] = '</div>';

                    $this->html[] = '</li>';                    
                }
                else
                {
                    $this->html[] = '<li class="nav-item">';
                    $this->html[] = '<a class="nav-link" href='.$root_item["link"].">".$root_item["title"].'</a>';
                    $this->html[] = '</li>';
                }
                
            }

        // HTML wrapper for the menu (close)
		$this->html[] = '</ul>';

		return implode( "\r\n", $this->html );        					
	}
}



?>