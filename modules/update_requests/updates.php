<?php

   require_once("includes/database.php");
   require_once("includes/core.php");
   require_once("includes/functions.php");
   require_once("includes/templates.php");

   if (!defined("__INSYS__")) {
      die("Error: Malformed Request");
   }

   ?>
   <header class="entry-header">
      <h1 class="entry-title">Update Requests</h1>
   </header>
   <div class="entry-content">
   <?php

   function viewRequest() {

      global $sys;

      $key = (ISSET($_GET['key']) && preg_match("/^[a-z0-9]*$/",$_GET['key'])) ? $_GET['key'] : false;

      if ($key) {

         $stmt = $sys->db()->prepare("SELECT * FROM update_requests LEFT JOIN companies ON update_requests.request_company = companies.ID WHERE request_key = :request_key;",
                                        array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));

         $stmt->bindParam(":request_key", $key);

         $stmt->execute();

         $rows = $stmt->rowCount();

         $result = $stmt->fetch();

         if ($rows == 1) {

           //Build Contacts
           $stmt = $sys->db()->prepare("SELECT * FROM contacts WHERE Company = :company_name;");

           $stmt->bindValue(":company_name", $result['Company name']);

           $stmt->execute();

           $contacts = $stmt->fetchAll();

           $arrContacts = array();

           foreach ($contacts as $contact) {

               array_push($arrContacts, array(
                  "contact_id" => $contact['ID'],
                  "contact_name" => htmlspecialchars($contact['First name'] . " " . $contact['Last name']),
                  "contact_phone" => htmlspecialchars($contact['Phone number']),
                  "contact_division" => htmlspecialchars($contact['Division']),
               ));

           }

           $template = new Template(__DIR__ . "/contact_updates.tpl");

           $template->setValues(array(

              "request_key"         => $key,
              "company_legal_name"  => htmlspecialchars($result['Legal Company Name']),
              "company_name"        => htmlspecialchars($result['Company name']),
              "company_phone"       => htmlspecialchars($result['Phone number']),
              "company_fax"         => htmlspecialchars($result['Fax Number']),
              "company_url"         => htmlspecialchars($result['Web address']),
              "company_address"     => htmlspecialchars($result['Address']),
              "company_street"      => htmlspecialchars($result['Street']),
              "company_city"        => htmlspecialchars($result['City']),
              "company_state"       => htmlspecialchars($result['State']),
              "company_zip"         => htmlspecialchars($result['Zip']),
              "company_employees"   => htmlspecialchars($result['Number of employees']),
              "company_type"        => htmlspecialchars($result['Type of company']),
              "company_division"    => htmlspecialchars($result['Division']),
              "company_state_tax"   => htmlspecialchars($result['State tax id']),
              "company_fed_tax"     => htmlspecialchars($result['Federal tax id']),
              "company_sos"         => htmlspecialchars($result['SOS #']),
              "company_cn"          => htmlspecialchars($result['CN number']),
              "company_sic"         => htmlspecialchars($result['SIC code']),
              "loop:contacts"       => $arrContacts,

              ));

           $template->flush_template();

         } else {
            echo "Error: Key invalid or expired";
         }

      } else {
         echo "Error: Malformed Request";
      }

   }

   function updateCompany() {

      global $sys;

      $key = (ISSET($_GET['key']) && preg_match("/^[a-z0-9]*$/",$_GET['key'])) ? $_GET['key'] : false;

      if ($key) {

         $stmt = $sys->db()->prepare("SELECT request_company FROM update_requests WHERE request_key = :request_key;",
                                        array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));

         $stmt->bindParam(":request_key", $key);

         $stmt->execute();

         $rows = $stmt->rowCount();

         if ($rows == 1) {

            $company = $stmt->fetch()['request_company'];

            $company_legal_name     = (ISSET($_POST['company-legal-name'])    && preg_match("/^[a-zA-Z0-9\. ]*$/",           $_POST['company-legal-name']))   ? $_POST['company-legal-name']   : null;
            $company_phone          = (ISSET($_POST['company-phone'])         && preg_match("/^[\+0-9\-\(\)\s]*$/",        $_POST['company-phone']))        ? $_POST['company-phone']        : null;
            $company_fax            = (ISSET($_POST['company-fax'])           && preg_match("/^[\+0-9\-\(\)\s]*$/",        $_POST['company-fax']))          ? $_POST['company-fax']          : null;
            $company_url            = (ISSET($_POST['company-url'])           && preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$_POST['company-url'])) ? $_POST['company-url'] : null;
            $company_address        = (ISSET($_POST['company-address'])       && preg_match("/^[a-zA-Z0-9\. ]*$/",           $_POST['company-address']))      ? $_POST['company-address']        : null;
            $company_street         = (ISSET($_POST['company-street'])        && preg_match("/^[a-zA-Z0-9\. ]*$/",           $_POST['company-street']))       ? $_POST['company-street']       : null;
            $company_city           = (ISSET($_POST['company-city'])          && preg_match("/^[a-zA-Z0-9\. ]*$/",           $_POST['company-city']))         ? $_POST['company-city']         : null;
            $company_state          = (ISSET($_POST['company-state'])         && preg_match("/^[a-zA-Z0-9\. ]*$/",           $_POST['company-state']))        ? $_POST['company-state']        : null;
            $company_zip            = (ISSET($_POST['company-zip'])           && preg_match("/^[0-9\- ]*$/",               $_POST['company-zip']))          ? $_POST['company-zip']          : null;
            $company_employees      = (ISSET($_POST['company-employees'])     && preg_match("/^[0-9\- ]*$/",               $_POST['company-employees']))    ? $_POST['company-employees']    : null;
            $company_type           = (ISSET($_POST['company-type'])          && preg_match("/^[a-zA-Z0-9]*$/",            $_POST['company-type']))         ? $_POST['company-type']         : null;
            $company_division       = (ISSET($_POST['company-division'])      && preg_match("/^[a-zA-Z0-9 ]*$/",           $_POST['company-division']))     ? $_POST['company-division']     : null;
            $company_state_tax      = (ISSET($_POST['company-state-tax'])     && preg_match("/^[a-zA-Z0-9\- ]*$/",         $_POST['company-state-tax']))    ? $_POST['company-state-tax']    : null;
            $company_fed_tax        = (ISSET($_POST['company-fed-tax'])       && preg_match("/^[a-zA-Z0-9\- ]*$/",         $_POST['company-fed-tax']))      ? $_POST['company-fed-tax']      : null;
            $company_sos            = (ISSET($_POST['company-sos'])           && preg_match("/^[a-zA-Z0-9\- ]*$/",         $_POST['company-sos']))          ? $_POST['company-sos']          : null;
            $company_cn             = (ISSET($_POST['company-cn'])            && preg_match("/^[a-zA-Z0-9\- ]*$/",         $_POST['company-cn']))           ? $_POST['company-cn']           : null;
            $company_sic            = (ISSET($_POST['company-sic'])           && preg_match("/^[a-zA-Z0-9\- ]*$/",         $_POST['company-sic']))          ? $_POST['company-sic']          : null;

            $stmt = $sys->db()->prepare("UPDATE companies SET
                                           [Address] = :company_address,
                                           [Street] = :company_street,
                                           [City] = :company_city,
                                           [State] = :company_state,
                                           [Zip] = :company_zip,
                                           [State tax id] = :company_state_tax,
                                           [Federal tax id] = :company_fed_tax,
                                           [SOS #] = :company_sos,
                                           [CN number] = :company_cn,
                                           [Phone number] = :company_phone,
                                           [Number of employees] = :company_employees,
                                           [Type of company] = :company_type,
                                           [Web address] = :company_url,
                                           [Division] = :company_division,
                                           [Fax Number] = :company_fax,
                                           [Legal Company Name] = :company_legal_name,
                                           [SIC code] = :company_sic,
                                           [last_update] = :company_last_update
                                           WHERE [ID] = :company_id;");

            $stmt->bindParam(":company_address", $company_address);
            $stmt->bindParam(":company_street", $company_street);
            $stmt->bindParam(":company_city", $company_city);
            $stmt->bindParam(":company_state", $company_state);
            $stmt->bindParam(":company_zip", $company_zip);
            $stmt->bindParam(":company_state_tax", $company_state_tax);
            $stmt->bindParam(":company_fed_tax", $company_fed_tax);
            $stmt->bindParam(":company_sos", $company_sos);
            $stmt->bindParam(":company_cn", $company_cn);
            $stmt->bindParam(":company_phone", $company_phone);
            $stmt->bindParam(":company_employees", $company_employees);
            $stmt->bindParam(":company_type", $company_type);
            $stmt->bindParam(":company_url", $company_url);
            $stmt->bindParam(":company_division", $company_division);
            $stmt->bindParam(":company_fax", $company_fax);
            $stmt->bindParam(":company_legal_name", $company_legal_name);
            $stmt->bindParam(":company_sic", $company_sic);
            $stmt->bindValue(":company_last_update", time());
            $stmt->bindParam(":company_id", $company);

            $stmt->execute();

            $stmt = $sys->db()->prepare("DELETE FROM update_requests WHERE request_key = :request_key;");

            $stmt->bindParam(":request_key", $key);

            $stmt->execute();

            LogActivity("GUEST", "CONTACT UPDATE COMPANY_ID: " . $company, "USED KEY: " . $key);

            echo "<br><center><h2>Thank you!</h2><br><p>Your updates have been submitted successfully.  You may now close your browser.</p></center>";

         } else {
            echo "Error: Key invalid or expired";
         }

      } else {
         echo "Error: Malformed Request";
      }
   }

   $action = (ISSET($_GET['action'])) ? $_GET['action'] : "list";

   switch ($action) {
      case "submit-company-update":
         updateCompany();
         break;
      case "delete-contact":
      case "submit-contact-update":
      case "edit-contact":
         require("edit-contact.php");
         break;
      case "submit-contact-add":
      case "new-contact":
         require("add-contact.php");
         break;
      case "view":
      default:
         viewRequest();
   }

?>
</div>
