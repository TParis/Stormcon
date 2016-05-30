<?php

   error_reporting(E_ALL);
   ini_set('display_errors', 1);


   if (!defined("__INSYS__")) {
      DEFINE('__INSYS__', true);
   }

   require_once("includes/core.php");
   require_once("includes/auth.php");
   require_once("includes/database.php");

   $auth = new auth();
   $sys = new core($dbh);

   if (ISSET($_COOKIE['auth_session']) && $auth->checksession($_COOKIE['auth_session'])) {

      $sys->set_auth($auth->sessioninfo($_COOKIE['auth_session']), $_COOKIE['auth_session']);

   }

   $page = (ISSET($_GET['action'])) ? $_GET['action'] : 'none';

   if (!$auth->login_state()) {

      echo json_encode(array(
         "status"    =>    "error",
         "error"     =>    "Not logged in",
         ));

   } else {

      switch($page) {
         case "get-company-list":
            include("modules/ajax/get_company_list.php");
            break;

         case "get-contact-list":
            include("modules/ajax/get_contact_list.php");
            break;

         case "get-soil-data":
            include("modules/ajax/get_soil_data.php");
            break;

         case "get-soil-list":
            include("modules/ajax/get_soil_list.php");
            break;
			
		 case "populate_dropdown":
            include("modules/ajax/populate_dropdowns.php");
            break;

         default:

            echo json_encode(array(
               "status"    =>    "error",
               "error"     =>    "No function specified",
               ));

      }
   }
