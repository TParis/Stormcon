<?php

   require_once("includes/database.php");
   require_once("includes/core.php");
   require_once("includes/functions.php");

   if (!defined("__INSYS__")) {
         echo json_encode(array(
               "status"    =>    "error",
               "error"     =>    "Malformed request",
               ));	 
		 die();
   }

   $table_name			= (ISSET($_POST['table_name']) && preg_match("/^[a-zA-Z_]*$/",$_POST['table_name'])) ? $_POST['table_name'] : false;
   $constraints			= (ISSET($_POST['constraints'])) ? json_decode($_POST['constraints']) : false;
   $sel					= (ISSET($_POST['column']) && preg_match("/^[a-zA-Z0-9_\[\]* ]*$/",$_POST['column'])) ? $_POST['column'] : false;
   $el					= (ISSET($_POST['field']) && preg_match("/^[a-zA-Z0-9_\[\] ]*$/",$_POST['field'])) ? $_POST['field'] : false;
   
   switch($table_name) {
	   case "soils":
	   case "view_contacts":
	   case "companies":
	   case "inspection_schedule":
	   case "endangered_species":
	   case "edwards_aquifer":
	   case "bmps":
	   case "responsibilities":
	   		break;
	   default:
         echo json_encode(array(
               "status"    =>    "error",
               "error"     =>    "Malformed request",
               ));
		 die();
   }

	$values = array();
	$sql = "SELECT " . $sel . " FROM " . $table_name;
   
	if ($constraints) {
	   
		$sql .= " WHERE ";
	   
		foreach($constraints as $key => $item) {
			$sql .= $key . " LIKE ? AND ";
			array_push($values, $item);
		}
		
		$sql = substr($sql, 0, -4);
	}
	
	if ($sel != "*") {
		$sql .= " ORDER BY " . $sel . " ASC";
	}
	
	$query = $sys->db()->prepare($sql);
	
	$query->execute($values);
	
	$data = $query->fetchAll();
	
	echo json_encode(array($el,$data));
   
   
   
   
   
   