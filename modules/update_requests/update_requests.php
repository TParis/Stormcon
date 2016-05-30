<?php

   require_once("includes/database.php");
   require_once("includes/core.php");
   require_once("includes/functions.php");

   if (!defined("__INSYS__")) {
      die("Error: Malformed Request");
   }

   ?>
   <header class="entry-header">
      <h1 class="entry-title">Update Requests</h1>
   </header>
   <div class="entry-content">
   <?php

   function getUpdateRequestsList() {

      global $sys;

      $stmt = $sys->db()->prepare("SELECT [ID], [Company name], [last_update], request_date, request_status, request_email, request_id
                                   FROM companies
                                   LEFT JOIN (SELECT *
                                      FROM update_requests
                                      WHERE (request_status IS NULL OR request_status != 1))
                                   AS update_requests
                                   ON companies.ID = update_requests.request_company
                                   ORDER BY request_date DESC, last_update ASC, [Company name] ASC;");

      $stmt->execute();

      echo "<div class=\"add-new-sr\"><a href=\"?page=update_requests&action=send\">Send New Request</a></div>";
      echo "<div class=\"data_table\">";

      echo "<div class=\"data_row\">";
         echo "<div class=\"column_data\">Actions</div>";
         echo "<div class=\"column_data\">Company</div>";
         echo "<div class=\"column_data\">Status</div>";
         echo "<div class=\"column_data\">Last Update</div>";
      echo "</div>";

      foreach ($stmt->fetchAll() as $request) {

         $one_year = 60 * 60 * 24 * 365; //Doesn't have to be perfect...who cares about leap years
         $time_since_last_update = time() - $request['last_update'];

         //Determine row color
         if ($time_since_last_update < $one_year) {
            $row_color = "update-row-green";
         } else if ($request['request_date'] != NULL) {
            $row_color = "update-row-yellow";
         } else {
            $row_color = "update-row-red";
         }

         //Determine Request Status & Action
         if ($request['request_date'] == NULL && $row_color != "update-row-green") {
            $request_action = "<a href=\"?page=update_requests&action=send&id=" . $request['ID'] . "\"><img src=\"/images/sendreq.png\"></a>";
            $request_status = "NO REQUESTS HAVE BEEN SENT";
         } else if ($request['request_date'] == NULL && $row_color == "update-row-green") {
            $request_action = "<a href=\"?page=update_requests&action=send&id=" . $request['ID'] . "\"><img src=\"/images/sendreq.png\"></a>";
            $request_status = "NO UPDATE NEEDED";
         } else {
            $request_action = "<a href=\"?page=update_requests&action=cancel&id=" . $request['request_id'] . "\"><img src=\"/images/cancelreq.png\"></a>";
            $request_status = "AWAITING ACTION. SENT: " . date('Y-m-d', $request['request_date']) . " TO " . $request['request_email'];
         }

         $last_update = ($request['last_update'] == 0) ? "Never" : date('Y-m-d', $request['last_update']);

         echo "<div class=\"data_row " . $row_color . "\">";
            echo "<div class=\"column_data\">" . $request_action . "</div>";
            echo "<div class=\"column_data bold\">" . $request['Company name'] . "</div>";
            echo "<div class=\"column_data\">" . $request_status . "</div>";
            echo "<div class=\"column_data\">" . $last_update . "</div>";
         echo "</div>";

      }

      echo "</div>";

   }



   function getNewRequestPage() {

      global $sys;

      $id = (ISSET($_GET['id']) && is_numeric($_GET['id'])) ? $_GET['id'] : 0;

      $class_name = ($id == 0) ? "company-name-visible" : "company-name-hidden";

      ?>
      <center><div class="request-table">
         <form action="?page=update_requests&action=submit-request" method="post">
            Companies: <select class="select" name="company-list">
                       <?php

                         $stmt =  $sys->db()->prepare("SELECT [ID], [Company name] FROM companies ORDER BY [Company name]");

                         $stmt->execute();

                         $arrCompanies = $stmt->fetchAll();

                         array_unshift($arrCompanies, array("0", "Add New Company"));

                         foreach ($arrCompanies as $Company) {

                           if ($id == $Company[0]) {
                              echo "<option SELECTED value=\"" . $Company[0] . "\">" . $Company[1] . "</option>";
                           } else {
                              echo "<option value=\"" . $Company[0] . "\">" . $Company[1] . "</option>";
                           }


                         }

                       ?>
                        </select><br>
            <div class="<?php echo $class_name; ?>"><br>Company Name: <input class="select" type="text" name="company-name"></div><br>
            Email: <input class="select" type="text" name="company-email"><br><br>
            <input class="submit" type="submit" value="Send">
         </form>
      </div></center>
      <?php
   }

   function sendNewRequest() {

      require_once("includes/mail.php");

      global $sys, $auth;

      $email = (ISSET($_POST['company-email']) && filter_var($_POST['company-email'], FILTER_VALIDATE_EMAIL)) ? $_POST['company-email'] : false;
      $list = (ISSET($_POST['company-list']) && is_numeric($_POST['company-list'])) ? $_POST['company-list'] : false;
      $name = (ISSET($_POST['company-name']) && preg_match("/^[a-zA-Z0-9& ]*$/",$_POST['company-name'])) ? $_POST['company-name'] : false;

      if (!$email) {

         echo "<div class=\"form-error\">Invalid email address - no request sent!</div>";

      } else if ($list === false || ($list == 0 && !$name)) {

         echo "<div class=\"form-error\">Invalid company selected or no company name specified - no request sent!</div>";

      } else {

         if ($name) {

            $stmt = $sys->db()->prepare("INSERT INTO companies ([Company name]) VALUES (:company_name)");
            $stmt->bindParam(":company_name", $name);
            $stmt->execute();

            $list = $sys->db()->lastInsertId();
         }

         $key = md5($auth->randomkey());

         $stmt = $sys->db()->prepare("INSERT INTO update_requests VALUES (:request_date, :request_company, :request_status, :request_email, :request_key);");
         $stmt->bindValue(":request_date", time());
         $stmt->bindValue(":request_company", $list);
         $stmt->bindValue(":request_status", 0);
         $stmt->bindValue(":request_email", $email);
         $stmt->bindValue(":request_key", $key);

         if (!$stmt->execute()) {
            echo "<div class=\"form-error\">Error while adding request to the database.</div>";
         }

         //Send Email

         $body = "Hello\n
                  \n
                  We are requesting that you update your contact details in our database so we may maintain accurate data
                  that will be used to develop our Swormwater Pollution Prevent Plans (SWPPP).  These updates are invaluable
                  for the efficiency of the project and your cooperation will assist us in providing a quality plan.\n
                  \n
                  To complete the updates, please click this link: \n";
         $body .="<a href=\"" . $sys->base_url . "?page=updates&key=" . $key . "\">Click here to update</a>\n";
         $body .="\n
                  Please update your company details and also be sure to add/remove/update individual persons who will be
                  acting as points of contact.\n
                  \n
                  Thank you for your help!\n
                  \n
                  Stormcon, LLC";

         $html = str_replace("\n", "<br />", $body);

         sendEmail($email, "Request for updates", $html, $body);

         LogActivity($sys->auth()->user_name, "SENT UPDATE REQUEST_ID: " . $sys->db()->lastInsertId(), "TO COMPANY_ID: " . $list . " USING EMAIL ADDRESS: " . $email . " AND KEY: " . $key);

         echo "Update request sent successfully &nbsp;&nbsp;&nbsp;";

      }

   }

   function cancelRequest() {

      global $sys;

      $id = (ISSET($_GET['id']) && is_numeric($_GET['id'])) ? $_GET['id'] : false;

      if ($id) {

         $stmt = $sys->db()->prepare("DELETE FROM update_requests WHERE request_id = :request_id");
         $stmt->bindParam(":request_id", $id);
         $stmt->execute();

         LogActivity($sys->auth()->user_name, "CANCEL UPDATE REQUEST ID: " . $id);

      } else {
         echo "Error: Malformed Request";
      }

   }

   $action = (ISSET($_GET['action'])) ? $_GET['action'] : "list";

   switch ($action) {
      case "submit-request":
         sendNewRequest();
         getUpdateRequestsList();
         break;
      case "cancel":
         cancelRequest();
         getUpdateRequestsList();
         break;
      case "send":
         getNewRequestPage();
         break;
      case "list":
      default:
         getUpdateRequestsList();
   }

?>
</div>
