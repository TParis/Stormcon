<?php

	global $sys;
	
	require_once("includes/functions.php");
	require_once("includes/data_map.php");
	require_once("includes/project_tabs.php");
	require_once("projects.class.php");
	
	//Get Requests
	$action = (ISSET($_GET['action'])) ? $_GET['action'] : "view";
	$id     = (ISSET($_GET['id']) && is_numeric($_GET['id'])) ? $_GET['id'] : false;
	
	//SQL Injection Prevention
	if (!$id && $action != "add") {
		die("Error: Malformed Request");
	}
	
	$curr_obj = new PROJECTS($id);
	
	//SWITCH PAGES
	switch ($action) {
		//CASE DELETE - NO VIEWS
		case "delete":
			
			$curr_obj->delete();
			
			LogActivity($sys->auth()->user_name, "DELETE PROJ_ID: " . $id);
			
			echo redirect_to("?page=projects");
			
			break;
		//CASE MODIFY - SHOW PAGE AFTER MODIFICATION (Form submission actions reside here)
		
		case "add":
	
			if (isset($_POST['submit'])) {
				
				$curr_obj->insert($_POST);
				
				LogActivity($sys->auth()->user_name, "INSERT PROJ_ID: " . $curr_obj->id);
			
			}
						
			break;
			
		case "edit":
		
			if (isset($_POST['submit'])) {

				$curr_obj->update($_POST);
				
				LogActivity($sys->auth()->user_name, "UPDATE PROJ_ID: " . $id);
			
			}
						
			break;
			
	//END SWITCH
	}
?>
<header class="entry-header">
   <h1 class="entry-title"><?php echo $curr_obj->getProjectTitle(); ?> - <?php echo $curr_obj->getTitle(); ?> - <?php echo ucwords($action); ?></h1>
</header>
<?php

	if ($curr_obj->getLatLong()) {
?>
    <script src="https://maps.googleapis.com/maps/api/js"></script>
    <script>
      function initialize() {
        var mapCanvas = document.getElementById('map-canvas');
		var latlng = new google.maps.LatLng(<?php echo $curr_obj->getLatLong(); ?>)
        var mapOptions = {
          center: latlng,
          zoom: 8,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        var map = new google.maps.Map(mapCanvas, mapOptions)
		
		var marker = new google.maps.Marker({
			position: latlng,
			map: map,
			title: '<?php echo $curr_obj->getProjectTitle(); ?>'
		});
      }
      google.maps.event.addDomListener(window, 'load', initialize);
    </script>
<?php } ?>
<div class="entry-content">
<?php
	$curr_obj->getMessages();
	
	$curr_obj->getMenuLinks();
	
	echo "<div style=\"clear: both;\"></div>";
	
	$curr_obj->actionLinks();
	
	project_tabs('proj');
	
	$curr_obj->createForm();
	
	//Table DIV
	echo "<div class=\"data_table no_top_margin\">";
	echo ($curr_obj->getLatLong()) ? "<div id=\"map-canvas\"></div>" : "";
	
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
