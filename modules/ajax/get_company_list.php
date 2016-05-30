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

   $company         = (ISSET($_GET['company']) && preg_match("/^[a-zA-Z0-9.\(\)\-\\\\\/ ]*$/",$_GET['company'])) ? $_GET['company'] : false;

   if (!$company) {
      $stmt = $sys->db()->prepare("SELECT DISTINCT [Company name] FROM companies ORDER BY [Company name]");


      $stmt->execute();

      echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
   } else {

      $stmt = $sys->db()->prepare("SELECT CONCAT([First name], ' ', [Last name]) as [Name] FROM contacts WHERE Company = :company_name ORDER BY [Last name], [First name]");

      $stmt->bindParam(":company_name", $company);

      $stmt->execute();

      echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));

   }
