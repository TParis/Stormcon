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

   $soil_name        = (ISSET($_GET['soil']) && preg_match("/^[a-zA-Z0-9%\- ]*$/",$_GET['soil'])) ? $_GET['soil'] : false;

   if (!$soil_name) {
         echo json_encode(array(
               "status"    =>    "error",
               "error"     =>    "Malformed request",
               ));
   } else {

      $stmt = $sys->db()->prepare("SELECT * FROM soils WHERE [Soil name] = :soil_name ORDER BY [Soil name]");

      $stmt->bindParam(":soil_name", $soil_name);

      $stmt->execute();

      echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));

   }
