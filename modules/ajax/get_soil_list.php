<?php

   require_once("includes/database.php");
   require_once("includes/core.php");
   require_once("includes/functions.php");

   if (!defined("__INSYS__")) {
         echo json_encode(array(
               "status"    =>    "error",
               "error"     =>    "Malformed request",
               ));
   }

   $stmt = $sys->db()->prepare("SELECT * FROM Soils");

   $stmt->execute();

   echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));




