<?php

	global $sys;
	
	require_once("includes/functions.php");
	require_once("includes/data_map.php");
	require_once("includes/project_tabs.php");
	require_once("contacts.class.php");
	
	//Get Requests
	$action = (ISSET($_GET['action'])) ? $_GET['action'] : "view";
	$id     = (ISSET($_GET['id']) && is_numeric($_GET['id'])) ? $_GET['id'] : false;
	
	//SQL Injection Prevention
	if (!$id && $action != "add") {
		die("Error: Malformed Request");
	}
	
	$curr_obj = new CONTACT($id);
	
	//SWITCH PAGES
	switch ($action) {
		//CASE DELETE - NO VIEWS
		case "delete":
			
			$curr_obj->delete();
			
			LogActivity($sys->auth()->user_name, "DELETE CONTACT_ID: " . $id);
			
			echo redirect_to("?page=contacts");
			
			break;
		//CASE MODIFY - SHOW PAGE AFTER MODIFICATION (Form submission actions reside here)
		
		case "add":
	
			if (isset($_POST['submit'])) {
				
				$curr_obj->insert($_POST);
				
				LogActivity($sys->auth()->user_name, "INSERT CONTACT_ID: " . $curr_obj->id);
			
			}
						
			break;
			
		case "edit":
		
			if (isset($_POST['submit'])) {

				$curr_obj->update($_POST);
				
				LogActivity($sys->auth()->user_name, "UPDATE CONTACT_ID: " . $id);
			
			}
						
			break;
			
	//END SWITCH
	}
?>
<header class="entry-header">
   <h1 class="entry-title"><?php echo $curr_obj->getTitle(); ?> - <?php echo ucwords($action); ?></h1>
</header>
<div class="entry-content">
<?php
	$curr_obj->getMessages();
	
	echo "<div style=\"clear: both;\"></div>";
	
	$curr_obj->actionLinks();
	
	$curr_obj->createForm();
	
	//Table DIV
	echo "<div class=\"data_table no_top_margin\">";
	
	//DIV TABLE
	$curr_obj->displayPage();
	
	echo "</div>";
	
	if ($sys->page->action == "edit" || $sys->page->action == "add") {
		echo "<br><center><input class=\"submit-center\" type=\"submit\" name=\"submit\" value=\"Submit\"></center>";
		echo "</form>";
	}
	
	
	echo "<br>";
	
	$curr_obj->actionLinks();
	
	$curr_obj->flushJavascript();
	echo "<script language=\"javascript\" type=\"text/javascript\" src=\"js/autopop.js\"></script>";
	echo "</div><!-- .entry-content -->";
