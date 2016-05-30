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

   $contact_name         = (ISSET($_GET['contact']) && preg_match("/^[a-zA-Z0-9 ]*$/",$_GET['contact'])) ? $_GET['contact'] : false;

   if (!$contact_name) {

      $stmt = $sys->db()->prepare("SELECT CONCAT([First name], ' ', [Last name]) as \"Name\" FROM contacts ORDER BY [Last name], [First name];");

      $stmt->execute();

      echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));

   } else {

      $stmt = $sys->db()->prepare("SELECT *, contacts.[Phone number] as [Contact phone] FROM contacts LEFT JOIN companies ON contacts.Company = companies.[Company name] WHERE CONCAT([First name], ' ', [Last name]) = :contact_name");

      $stmt->bindParam(":contact_name", $contact_name);

      $stmt->execute();

      echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));

   }


