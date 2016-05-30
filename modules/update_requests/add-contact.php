<?php

   require_once("includes/database.php");
   require_once("includes/core.php");
   require_once("includes/functions.php");
   require_once("includes/templates.php");

   if (!defined("__INSYS__")) {
      die("Error: Malformed Request");
   }

   function viewContact() {

      global $sys;

      $key = (ISSET($_GET['key']) && preg_match("/^[a-z0-9]*$/",$_GET['key'])) ? $_GET['key'] : false;
      $id = (ISSET($_GET['id']) && is_numeric($_GET['id'])) ? $_GET['id'] : 0;

      if ($key) {

         $stmt = $sys->db()->prepare("SELECT * FROM  companies LEFT JOIN update_requests ON update_requests.request_company = companies.ID WHERE request_key = :request_key;",
                                        array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));

         $stmt->bindParam(":request_key", $key);

         $stmt->execute();
         $rows = $stmt->rowCount();

         if ($rows > 0) {

           $contact = $stmt->fetch();

           $template = new Template(__DIR__ . "/edit-contact.tpl");

           $template->setValues(array(

              "request_key"            => $key,
              "action"                 => "submit-contact-add",
              "contact_first_name"     => "",
              "contact_last_name"      => "",
              "contact_company"        => $contact['Company name'],
              "contact_phone"          => "",
              "contact_cell_phone"     => "",
              "contact_email"          => "",
              "contact_title"          => "",
              "contact_division"       => "",
              "contact_epa_number"     => "",
              "contact_er_number"      => "",

              ));

           $template->flush_template();

         } else {

            echo "Error: Malformed Request";
         }
      }
   }

   function addContact() {

      global $sys;

      $key = (ISSET($_GET['key']) && preg_match("/^[a-z0-9]*$/",$_GET['key'])) ? $_GET['key'] : false;
      $id = (ISSET($_GET['id']) && is_numeric($_GET['id'])) ? $_GET['id'] : 0;

      if ($key) {

         $stmt = $sys->db()->prepare("SELECT * FROM  companies LEFT JOIN update_requests ON update_requests.request_company = companies.ID WHERE request_key = :request_key;",
                                        array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));

         $stmt->bindParam(":request_key", $key);

         $stmt->execute();
         $rows = $stmt->rowCount();

         if ($rows > 0) {

            $company = $stmt->fetch()['Company name'];

            $first_name       = (ISSET($_POST['contact-first-name']) && preg_match("/^[a-zA-Z0-9]*$/",$_POST['contact-first-name'])) ? $_POST['contact-first-name'] : null;
            $last_name        = (ISSET($_POST['contact-last-name']) && preg_match("/^[a-zA-Z0-9]*$/",$_POST['contact-last-name'])) ? $_POST['contact-last-name'] : null;
            $er_number        = (ISSET($_POST['contact-er-number']) && preg_match("/^[a-zA-Z0-9]*$/",$_POST['contact-er-number'])) ? $_POST['contact-er-number'] : null;
            $phone_number     = (ISSET($_POST['contact-phone']) && preg_match("/^[\+0-9\-\(\)\s]*$/",$_POST['contact-phone'])) ? $_POST['contact-phone'] : null;
            $email            = (ISSET($_POST['contact-email']) && filter_var($_POST['contact-email'], FILTER_VALIDATE_EMAIL)) ? $_POST['contact-email'] : null;
            $title            = (ISSET($_POST['contact-title']) && preg_match("/^[a-zA-Z0-9]*$/",$_POST['contact-title'])) ? $_POST['contact-title'] : null;
            $division         = (ISSET($_POST['contact-division']) && preg_match("/^[a-zA-Z0-9]*$/",$_POST['contact-division'])) ? $_POST['contact-division'] : null;
            $epa_number       = (ISSET($_POST['contact-epa-number']) && preg_match("/^[a-zA-Z0-9]*$/",$_POST['contact-epa-number'])) ? $_POST['contact-epa-number'] : null;
            $cell_number      = (ISSET($_POST['contact-cell-phone']) && preg_match("/^[\+0-9\-\(\)\s]*$/",$_POST['contact-cell-phone'])) ? $_POST['contact-cell-phone'] : null;

            $stmt = $sys->db()->prepare("INSERT INTO contacts VALUES (:first_name, :last_name, :er_number, :company, :phone_number, :email, :title, :division, :epa_number, :cell_number);");

            $stmt->bindParam(":first_name",     $first_name);
            $stmt->bindParam(":last_name",      $last_name);
            $stmt->bindParam(":er_number",      $er_number);
            $stmt->bindParam(":company",        $company);
            $stmt->bindParam(":phone_number",   $phone_number);
            $stmt->bindParam(":email",          $email);
            $stmt->bindParam(":title",          $title);
            $stmt->bindParam(":division",       $division);
            $stmt->bindParam(":epa_number",       $epa_number);
            $stmt->bindParam(":cell_number",       $cell_number);

            $stmt->execute();

            LogActivity("GUEST", "CONTACT INSERT CLIENT_ID: " . $sys->db()->lastInsertId(), "USED KEY: " . $key);

            echo "Contact added successfully";

            echo redirect_to("?page=updates&key=" . $key);

         } else {

            echo "Error: Malformed Request";
         }
      }
   }


   $action = (ISSET($_GET['action'])) ? $_GET['action'] : "list";

   switch ($action) {
      case "submit-contact-add":
         addContact();
         break;
      case "contact-add":
      default:
         viewContact();
   }

?>
</div>
