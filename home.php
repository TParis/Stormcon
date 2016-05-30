<?php

require_once("includes/core.php");
require_once("includes/functions.php");

if (!defined("__INSYS__")) {
   die("Error: Malformed Request");
}

echo "Welcome, <strong>" . $sys->auth()->user_name . "</strong>";

?>
<div class="quick-links">
   <a href="?page=projects_item&action=add">Start Project</a>
   <a href="?page=companies_item&action=add">Add Company</a>
   <a href="?page=contacts_item&action=add">Add Contact</a>
   <a href="?page=update_requests&action=send">Send Update Request</a>
   <a href="?page=user_management_item&action=edit&id=<?php echo $sys->auth()->user_id; ?>">Edit Profile</a>
</div>
<br>
<?php getQOTD(); ?>
<br>
<div class="home-table">
   <div class="home-row">
      <div class="page-updates">
         <h1 align=center>Recent Project Changes</h1>
         <br>
         <div class="data_table">
            <div class="data_row">
               <div class="column_label small_label">Username</div>
               <div class="column_label">Action</div>
            </div>

         <?php

            $stmt = $sys->db()->prepare("SELECT TOP 10 * FROM activitylog WHERE action LIKE 'UPDATE%' OR action LIKE 'INSERT%' OR action LIKE 'DELETE%' ORDER BY id DESC");

            $stmt->execute();

            $results = $stmt->fetchAll();


            foreach ($results as $row) {

               echo "<div class=\"data_row\">";

               echo "<div class=\"column_data small_label\">" . $row['username'] . "</div>";
               echo "<div class=\"column_data\">" . $row['action'] . "</div>";

               echo "</div>";

            }

         ?>
         </div>
      </div>
      <div class="update-requests">
         <h1 align=center>Open Edit Requests</h1>
         <br>
         <div class="data_table">
            <div class="data_row">
               <div class="column_label">Company</div>
               <div class="column_label">Action</div>
               <div class="column_label">Last Update</div>
            </div>
         <?php

            $stmt = $sys->db()->prepare("SELECT TOP 10 [Company name], [last_update], request_date, request_status
                                   FROM companies
                                   LEFT JOIN (SELECT *
                                      FROM update_requests
                                      WHERE (request_status IS NULL OR request_status != 1))
                                   AS update_requests
                                   ON companies.ID = update_requests.request_company
                                   ORDER BY request_date DESC, last_update ASC, [Company name] ASC;");

            $stmt->execute();


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
                  $request_status = "NO REQUESTS SENT";
               } else if ($request['request_date'] == NULL && $row_color == "update-row-green") {
                  $request_status = "NO UPDATE NEEDED";
               } else {
                  $request_status = "SENT: " . date('Y-m-d', $request['request_date']);
               }

               $last_update = ($request['last_update'] == 0) ? "Never" : date('Y-m-d', $request['last_update']);

               echo "<div class=\"data_row " . $row_color . "\">";
                  echo "<div class=\"column_data bold\">" . htmlspecialchars($request['Company name']) . "</div>";
                  echo "<div class=\"column_data\">" . htmlspecialchars($request_status) . "</div>";
                  echo "<div class=\"column_data\">" . $last_update . "</div>";
               echo "</div>";

            }
         ?>
      </div>
   </div>
   <div class="home-row">
      <div class="user-log">
         <?php
         ?>
      </div>
   </div>
</div>
