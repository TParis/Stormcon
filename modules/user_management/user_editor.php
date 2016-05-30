<header class="entry-header">
   <h1 class="entry-title">User Editor</h1>
</header>
<div class="entry-content">
<?php

         global $sys;

         require_once("includes/functions.php");
         require_once("includes/core.php");

         //Get Requests
         $action        = (ISSET($_GET['action'])) ? $_GET['action'] : "view";
         $id    = (ISSET($_GET['id']) && is_numeric($_GET['id'])) ? $_GET['id'] : false;

         //SQL Injection Prevention
         if (!$id && $action != "add") {
            die("Error: Malformed Request");
         }

         // replace table name  by your table name
         $table_name = 'users';

         // prepare a statement
         $statement = $sys->db()->prepare("exec sp_columns @table_name = :table_name");

         // execute the statement with table_name as param
         $statement->execute(array(
             'table_name' => $table_name
         ));

         // fetch results
         $table_fields = $statement->fetchAll();

         //Only admins can check others, users can edit themselves
         if (!$sys->auth()->user_admin) {
            $id = $sys->auth()->user_id;
         }

         //SWITCH PAGES
         switch($action) {
            //CASE DELETE - NO VIEWS
            case "delete":

               if ($id == $sys->auth()->user_id) {

                  echo "You cannot delete yourself!";

               } else {

                  $stmt = $sys->db()->prepare("DELETE FROM users WHERE user_id = :id;");
                  $stmt->bindParam(":id", $id);

                  $stmt->execute();

                  LogActivity($sys->auth()->user_name, "DELETE USER_ID: " . $id);

                  echo redirect_to("?page=user_management");

               }

               break;
            case "add":
               if (ISSET($_POST['submit-action']) && $_POST['submit-action'] == "submit-add") {

                  global $auth;

                  $pass = $auth->randomkey(8);

                  if ($auth->register($_POST['username'], $pass, $pass, $_POST['email'])) {

                     LogActivity($sys->auth()->user_name, "ADD USER_ID: " . $sys->db()->lastInsertId());

                     echo $auth->successmsg[0];

                     echo redirect_to("?page=user_management");

                  } else {

                     echo $auth->errormsg[0];

                  }


               } else {
                  ?>
                  <form action="?page=user_management_item&action=add" method="post">
                  <div class="data_table">
                     <input type="hidden" name="submit-action" value="submit-add">
                     <div class="data_row">
                        <div class="column_label">Username</div>
                        <div class="column_data"><input type="text" class="edit" name="username"></div>
                     </div>
                     <div class="data_row">
                        <div class="column_label">Email</div>
                        <div class="column_data"><input type="text" class="edit" name="email"></div>
                     </div>
                  </div>
                  <center><input type="submit" class="submit-center" value="Add User"></center>
                  </form>
                  <?php
               }
               break;
            case "edit":
            //CASE VIEW/DEFAULT - SHOW PAGE
            case "view":
            default:

              //Submit Form
              if (ISSET($_POST['submit-action']) && $_POST['submit-action'] == "edit") {

                  $user_password             = (ISSET($_POST['user_password'])      && ($_POST['user_password'] == "" || preg_match("/^(?=.*[A-Za-z].*[A-Za-z])(?=.*[!@#$&*])(?=.*[0-9].*[0-9]).{8,}$/",$_POST['user_password'])))     ? $_POST['user_password']     : false;
                  $confirm_password          = (ISSET($_POST['confirm-password'])   && ($_POST['confirm-password'] == "" || preg_match("/^(?=.*[A-Za-z].*[A-Za-z])(?=.*[!@#$&*])(?=.*[0-9].*[0-9]).{8,}$/",$_POST['user_password'])))  ? $_POST['confirm-password']  : false;
                  $user_full_name            = (ISSET($_POST['user_full_name'])     && preg_match("/^[a-zA-Z0-9.\(\) ]*$/",$_POST['user_full_name']))                                                                                  ? $_POST['user_full_name']    : false;
                  $user_email                = (ISSET($_POST['user_email'])         && preg_match("/^[-a-z0-9~!$%^&*_=+}{\'?]+(\.[-a-z0-9~!$%^&*_=+}{\'?]+)*@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/i",$_POST['user_email']))                                           ? $_POST['user_email']        : false;
                  $user_phone                = (ISSET($_POST['user_phone'])         && preg_match("/^[a-zA-Z0-9.\(\)\-\+ ]*$/",$_POST['user_phone']))                                                                                      ? $_POST['user_phone']        : false;
                  $user_active               = (ISSET($_POST['user_active'])        && $_POST['user_active'] == 1)                                                                                                                     ? 1                           : 0;

                  if (($user_password === false || $confirm_password === false) && ($user_password !== "" && $confirm_password !== "")) {
                     echo "<span class=\"user_warning\">Passwords are not complex enough.<br><br></span>";
                  } elseif ($user_password !== $confirm_password) {
                     echo "<span class=\"user_warning\">Passwords do not match.<br><br></span>";
                  } elseif (!$user_full_name || !$user_phone) {
                     echo "<span class=\"user_warning\">Some fields hold invalid input.<br><br></span>";
                  } elseif (!$user_email) {
                     echo "<span class=\"user_warning\">Email address is in an incorrect format.<br><br></span>";
                  } else {

                     //Let's get the user's data so we can see what is really different.
                     $stmt = $sys->db()->prepare("SELECT * FROM users WHERE user_id = :user_id");

                     $stmt->bindParam(":user_id", $id);

                     $stmt->execute();

                     $result = $stmt->fetchAll()[0];


                     if ($result['user_email'] != $user_email) {

                        $stmt = $sys->db()->prepare("UPDATE users SET user_email = :user_email WHERE user_id = :user_id");

                        $stmt->bindParam(":user_id", $id);
                        $stmt->bindParam(":user_email", $user_email);

                        $stmt->execute();

                        LogActivity($sys->auth()->user_name, "CHANGE EMAIL USER_ID: " . $id, "From: " . $result['user_email'] . " TO: " . $user_email);
                     }

                     if ($user_password && $user_password != "") {

                        require_once("includes/auth.php");

                        $auth = new auth();

                        //Hash pass
                        $user_password = $auth->hashpass($user_password);

                        $stmt = $sys->db()->prepare("UPDATE users SET user_password = :user_password WHERE user_id = :user_id");

                        $stmt->bindParam(":user_id", $id);
                        $stmt->bindParam(":user_password", $user_password);

                        $stmt->execute();

                        LogActivity($sys->auth()->user_name, "CHANGE PASSWORD USER_ID: " . $id);

                     }

                     $stmt = $sys->db()->prepare("UPDATE users SET user_full_name = :user_full_name, user_phone = :user_phone, user_active = :user_active WHERE user_id = :user_id");

                     $stmt->bindParam(":user_id", $id);
                     $stmt->bindParam(":user_full_name", $user_full_name);
                     $stmt->bindParam(":user_phone", $user_phone);
                     $stmt->bindParam(":user_active", $user_active);

                     $stmt->execute();

                     LogActivity($sys->auth()->user_name, "UPDATE PROFILE USER_ID: " . $id);

                     echo "User updated successfully<br><br>";

                     echo redirect_to("?page=user_management_item&action=view&id=" . $id);

                  }

              }

              //SQL Statement
              $stmt = $sys->db()->prepare("SELECT * FROM [dbo].[" . $table_name . "] WHERE user_id = :project_id;");
              $stmt->bindParam(":project_id", $id);

              $stmt->execute();

              $results = $stmt->fetch();

              $row_div    = "\t<div class=\"data_row\">";
              $label_div  = "\t\t<div class=\"column_label\">";
              $data_div   = "\t\t<div class=\"column_data\">";
              $close_div  = "</div>";

              if ($action == "edit" || $action == "add") {
                  echo "<form action=\"?page=user_management_item&action=" . $action . "&id=" . $id . "\" method=\"post\">";
                  echo "<input type=\"hidden\" name=\"submit-action\" value=\"" . $action . "\">";
              }

              if ($action != "view") {
                 echo "<a href=\"?page=user_management_item&action=view&id=" . $id . "\"><img src=\"/images/view.png\"></a>&nbsp;";
              }
              if ($action != "edit") {
                 echo "<a href=\"?page=user_management_item&action=edit&id=" . $id . "\"><img src=\"/images/edit.png\"></a>&nbsp;";
              }
              if ($action != "delete") {
                  echo "<a href=\"?page=user_management_item&action=delete&id=" . $id . "\" class=\"item-delete\"><img src=\"/images/delete.png\"></a>&nbsp;";
              }

              //Table DIV
              echo "<div class=\"data_table\">";

              for ($i = 0; $i < count($table_fields); $i++) {

                 $row_type = $table_fields[$i]["COLUMN_NAME"] . "-" . $action;

                 if (strlen($results[$table_fields[$i]["COLUMN_NAME"]]) > 50 && $table_fields[$i]["COLUMN_NAME"] != "user_password") {
                    $row_type = "textfield-" . $action;
                 }


                 switch (strtolower($row_type)) {
                     case "user_id-add":
                     case "user_password-add":
                     case "user_password-view":
                     case "user_activekey-edit":
                     case "user_activekey-add":
                     case "user_activekey-view":
                     case "user_resetkey-edit":
                     case "user_resetkey-add":
                     case "user_resetkey-view":
                        break;

                     case "user_id-edit":
                     case "user_id-view":
                        echo "<input type=\"hidden\" value=\"" . $results[$table_fields[$i]["COLUMN_NAME"]] . "\" name=\"" . $table_fields[$i]["COLUMN_NAME"] . "\"></input>\n";
                        break;

                     case "textfield-edit":
                        echo $row_div . "\n";
                        echo $label_div . ucwords(str_replace("_", " ", $table_fields[$i]["COLUMN_NAME"])) . $close_div . "\n";
                        echo $data_div . "<textarea rows=\"4\" cols=\"50\" maxlength=\"2500\" name=\"" . $table_fields[$i]["COLUMN_NAME"] . "\">" . htmlspecialchars($results[$table_fields[$i]["COLUMN_NAME"]]) . "</textarea>" . $close_div . "\n";
                        echo "\t" . $close_div . "\n";
                        break;
                     case "user_active-view":
                        echo $row_div . "\n";
                        echo $label_div . ucwords(str_replace("_", " ", $table_fields[$i]["COLUMN_NAME"])) . $close_div . "\n";
                        echo $data_div;
                        echo ($results[$table_fields[$i]["COLUMN_NAME"]]) ? 'Active' : 'Disabled';
                        echo $close_div . "\n";
                        echo "\t" . $close_div . "\n";
                        break;
                     case "username-edit":
                     case "user_login_attempts-edit":
                        echo $row_div . "\n";
                        echo $label_div . ucwords(str_replace("_", " ", $table_fields[$i]["COLUMN_NAME"])) . $close_div . "\n";
                        echo $data_div;
                        echo htmlspecialchars($results[$table_fields[$i]["COLUMN_NAME"]]);
                        echo $close_div . "\n";
                        echo "\t" . $close_div . "\n";
                        break;
                     case "user_password-edit":
                        echo $row_div . "\n";
                        echo $label_div . ucwords(str_replace("_", " ", $table_fields[$i]["COLUMN_NAME"])) . $close_div . "\n";
                        echo $data_div . "<input class=\"edit\" type=\"password\" value=\"\" name=\"" . $table_fields[$i]["COLUMN_NAME"] . "\"></input>" . $close_div . "\n";
                        echo "\t" . $close_div . "\n";
                        echo $row_div . "\n";
                        echo $label_div . "Confirm Password" . $close_div . "\n";
                        echo $data_div . "<input class=\"edit\" type=\"password\" value=\"\" name=\"confirm-password\"></input>" . $close_div . "\n";
                        echo "\t" . $close_div . "\n";
                        break;
                     case "user_last_login-view":
                     case "user_last_login-edit":
                        echo $row_div . "\n";
                        echo $label_div . ucwords(str_replace("_", " ", $table_fields[$i]["COLUMN_NAME"])) . $close_div . "\n";
                        echo $data_div;
                        echo ($results[$table_fields[$i]["COLUMN_NAME"]]) ? date('Y-m-d @ g:m:s A T',$results[$table_fields[$i]["COLUMN_NAME"]]) : 'Never';
                        echo $close_div . "\n";
                        echo "\t" . $close_div . "\n";
                        break;
                     case "user_email-view":
                        echo $row_div . "\n";
                        echo $label_div . ucwords(str_replace("_", " ", $table_fields[$i]["COLUMN_NAME"])) . $close_div . "\n";
                        echo $data_div;
                        echo emailAddy(htmlspecialchars($results[$table_fields[$i]["COLUMN_NAME"]]));
                        echo $close_div . "\n";
                        echo "\t" . $close_div . "\n";
                        break;
                     case "user_active-edit":
                        echo $row_div . "\n";
                        echo $label_div . ucwords(str_replace("_", " ", $table_fields[$i]["COLUMN_NAME"])) . $close_div . "\n";
                        echo $data_div;
                        echo "<select class=\"edit\" name=\"" . $table_fields[$i]["COLUMN_NAME"] . "\">";
                        if ($results[$table_fields[$i]["COLUMN_NAME"]]) {
                           echo "<option value=\"1\" selected>Active</option>";
                           echo "<option value=\"0\">Disabled</option>";
                        } else {
                           echo "<option value=\"1\">Active</option>";
                           echo "<option value=\"0\" selected>Disabled</option>";
                        }
                        echo "</select>";
                        echo $close_div . "\n";
                        echo "\t" . $close_div . "\n";
                        break;

                     default:
                        echo $row_div . "\n";
                        if ($action == "edit" || $action == "add") {
                           echo $label_div . ucwords(str_replace("_", " ", $table_fields[$i]["COLUMN_NAME"])) . $close_div . "\n";
                           echo $data_div . "<input class=\"edit\" type=\"text\" value=\"" . htmlspecialchars($results[$table_fields[$i]["COLUMN_NAME"]]) . "\" name=\"" . $table_fields[$i]["COLUMN_NAME"] . "\"></input>" . $close_div . "\n";
                           } else {
                           echo $label_div . ucwords(str_replace("_", " ", $table_fields[$i]["COLUMN_NAME"])) . $close_div . "\n";
                           echo $data_div . htmlspecialchars($results[$table_fields[$i]["COLUMN_NAME"]]) . $close_div . "\n";
                        }
                        echo "\t" . $close_div . "\n";
                 }


              }

              //DIV TABLE
              echo $close_div;

              if ($action == "edit" || $action == "add") {
                  echo "<center><input class=\"submit-center\" type=\"submit\" value=\"Submit\"></center>";
                  echo "</form>";
              }

              echo "<br />";

              if ($action != "view") {
                 echo "<a href=\"?page=user_management_item&action=view&id=" . $id . "\"><img src=\"/images/view.png\"></a>&nbsp;";
              }
              if ($action != "edit") {
                 echo "<a href=\"?page=user_management_item&action=edit&id=" . $id . "\"><img src=\"/images/edit.png\"></a>&nbsp;";
              }
              if ($action != "delete") {
                  echo "<a href=\"?page=user_management_item&action=delete&id=" . $id . "\" class=\"item-delete\"><img src=\"/images/delete.png\"></a>&nbsp;";
              }

         //END SWITCH
         }
?>
</div><!-- .entry-content -->
