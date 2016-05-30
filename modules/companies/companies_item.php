<header class="entry-header">
   <h1 class="entry-title">Companies</h1>
</header>
<div class="entry-content">
<?php

         global $sys;

         require_once("includes/functions.php");

         //Get Requests
         $action        = (ISSET($_GET['action'])) ? $_GET['action'] : "view";
         $id    = (ISSET($_GET['id']) && is_numeric($_GET['id'])) ? $_GET['id'] : false;

         //SQL Injection Prevention
         if (!$id && $action != "add") {
            die("Error: Malformed Request");
         }

         // replace table name  by your table name
         $table_name = 'companies';

         // prepare a statement
         $statement = $sys->db()->prepare("exec sp_columns @table_name = :table_name");

         // execute the statement with table_name as param
         $statement->execute(array(
             'table_name' => $table_name
         ));

         // fetch results
         $table_fields = $statement->fetchAll();

         //SWITCH PAGES
         switch($action) {
            //CASE DELETE - NO VIEWS
            case "delete":

               $stmt = $sys->db()->prepare("DELETE FROM [dbo].[" . $table_name . "] WHERE id = :id;");
               $stmt->bindParam(":id", $id);

               $stmt->execute();

               LogActivity($sys->auth()->user_name, "DELETE COMPANIES_ID: " . $id);

               echo redirect_to("?page=" . $table_name);

               break;
            //CASE MODIFY - SHOW PAGE AFTER MODIFICATION (Form submission actions reside here)
            case "add":
               $id = 0;
            case "edit":
               if (ISSET($_POST['submit-action'])) {
                  if ($_POST['submit-action'] == "add") {

                     $datatypes = array();

                     $sql = "INSERT INTO [dbo].[" . $table_name . "] (";

                     for ($i = 0; $i < count($table_fields); $i++) {
                        if (strtolower($table_fields[$i]["COLUMN_NAME"]) != "id" && strtolower($table_fields[$i]["COLUMN_NAME"]) != "last_update") {
                           $sql .= "\"" . $table_fields[$i]["COLUMN_NAME"] . "\",";

                           //Need this later for the bindParams
                           $datatypes[generateColumnName($table_fields[$i]["COLUMN_NAME"])] = $table_fields[$i]["TYPE_NAME"];
                        }
                     }

                     $sql = substr($sql, 0, -1);

                     $sql .= ") VALUES (";

                     foreach ($_POST as $key => $value) {
                        if ($key != "submit-action" && $key != "id" && $key != "last_update") {
                           $sql .= ":" . generateColumnName($key) . ",";
                        }
                     }

                     $sql = substr($sql, 0, -1);

                     $sql .= ");";

                     $stmt = $sys->db()->prepare($sql);

                     foreach ($_POST as $key => $value) {

                        if ($key != "submit-action" && strtolower($key) != "id" && strtolower($key) != "last_update") {
                           switch ($datatypes[generateColumnName($key)]) {
                              case "int":
                              case "float":
                                 $bind_type = PDO::PARAM_INT;
                                 $value = (int)$value;
                                 echo $key. "\tfloat<br />\n";
                                 break;
                              case "bool":
                                 $bind_type = PDO::PARAM_BOOL;
                                 $value = (bool)$value;
                                 break;
                              case "ntext":
                              case "varchar":
                              default:
                                 $bind_type = PDO::PARAM_STR;
                                 break;
                           }

                           $stmt->bindValue(":" . generateColumnName($key), $value, $bind_type);
                        }
                     }

                     $stmt->execute();

                     $new_id = $sys->db()->lastInsertId();

                     LogActivity($sys->auth()->user_name, "INSERT COMPANIES_ID: " . $new_id);

                     echo "Added successfully, redirecting...";

                     echo redirect_to("?page=" . $table_name . "_item&action=view&id=" . $new_id);

                     break;

                  } else if ($_POST['submit-action'] == "edit") {
                     $datatypes = array();

                     $sql = "UPDATE [dbo].[" . $table_name . "] SET";

                     for ($i = 0; $i < count($table_fields); $i++) {
                        if (strtolower($table_fields[$i]["COLUMN_NAME"]) != "id" && strtolower($table_fields[$i]["COLUMN_NAME"]) != "last_update") {

                           $sql .= " [" . $table_fields[$i]["COLUMN_NAME"] . "] = :" . generateColumnName($table_fields[$i]["COLUMN_NAME"]) . ",";

                           //Need this later for the bindParams
                           $datatypes[generateColumnName($table_fields[$i]["COLUMN_NAME"])] = $table_fields[$i]["TYPE_NAME"];
                        }
                     }

                     $sql = substr($sql, 0, -1);

                     $sql .= " WHERE id = :id";

                     $stmt = $sys->db()->prepare($sql);

                     foreach ($_POST as $key => $value) {

                        if ($key != "submit-action" && strtolower($key) != "id" && strtolower($key) != "last_update") {
                           switch ($datatypes[generateColumnName($key)]) {
                              case "ntext":
                              case "varchar":
                                 $bind_type = PDO::PARAM_STR;
                                 break;
                              case "int":
                              case "float":
                                 $bind_type = PDO::PARAM_INT;
                                 $value = (int)$value;
                                 echo $key. "\tfloat<br />\n";
                                 break;
                              case "bool":
                                 $bind_type = PDO::PARAM_BOOL;
                                 $value = (bool)$value;
                                 break;
                           }

                           $stmt->bindValue(":" . generateColumnName($key), $value, $bind_type);
                        }
                     }

                     $stmt->bindValue(":id", $id, PDO::PARAM_INT);

                     $stmt->execute();

                     LogActivity($sys->auth()->user_name, "UPDATE COMPANIES_ID: " . $id);

                     echo "Updated successfully, redirecting...";

                     echo redirect_to("?page=" . $table_name . "_item&action=view&id=" . $id);

                     break;
                  }
               }
            //CASE VIEW/DEFAULT - SHOW PAGE
            case "view":
            default:

              //SQL Statement
              $stmt = $sys->db()->prepare("SELECT * FROM [dbo].[" . $table_name . "] WHERE id = :project_id;");
              $stmt->bindParam(":project_id", $id);

              $stmt->execute();

              $results = $stmt->fetch();

              $row_div    = "\t<div class=\"data_row\">";
              $label_div  = "\t\t<div class=\"column_label\">";
              $data_div   = "\t\t<div class=\"column_data\">";
              $close_div  = "</div>";

              if ($action == "edit" || $action == "add") {
                  echo "<form action=\"?page=" . $table_name . "_item&action=" . $action . "&id=" . $id . "\" method=\"post\">";
                  echo "<input type=\"hidden\" name=\"submit-action\" value=\"" . $action . "\">";
              }

              if ($action != "view") {
                 echo "<a href=\"?page=" . $table_name . "_item&action=view&id=" . $id . "\"><img src=\"/images/view.png\"></a>&nbsp;";
              }
              if ($action != "edit") {
                 echo "<a href=\"?page=" . $table_name . "_item&action=edit&id=" . $id . "\"><img src=\"/images/edit.png\"></a>&nbsp;";
              }
              if ($action != "delete") {
                  echo "<a href=\"?page=" . $table_name . "_item&action=delete&id=" . $id . "\" class=\"item-delete\"><img src=\"/images/delete.png\"></a>&nbsp;";
              }

              //Table DIV
              echo "<div class=\"data_table\">";

              for ($i = 0; $i < count($table_fields); $i++) {

                 $row_type = $table_fields[$i]["COLUMN_NAME"] . "-" . $action;

                 if (strlen($results[$table_fields[$i]["COLUMN_NAME"]]) > 50) {
                    $row_type = "textfield-" . $action;
                 }


                 switch (strtolower($row_type)) {

                    case "id-add":
                    case "last_update-add":
                    case "last_update-edit":
                     break;
                    case "id-edit":
                    case "id-view":
                       echo "<input type=\"hidden\" value=\"" . $results[$table_fields[$i]["COLUMN_NAME"]] . "\" name=\"" . $table_fields[$i]["COLUMN_NAME"] . "\"></input>\n";
                       break;
                    case "textfield-edit":
                       echo $row_div . "\n";
                       echo $label_div . $table_fields[$i]["COLUMN_NAME"] . $close_div . "\n";
                       echo $data_div . "<textarea class=\"edit\" rows=\"4\" cols=\"50\" maxlength=\"2500\" name=\"" . $table_fields[$i]["COLUMN_NAME"] . "\">" . $results[$table_fields[$i]["COLUMN_NAME"]] . "</textarea>" . $close_div . "\n";
                       echo "\t" . $close_div . "\n";
                       break;
                    case "last_update-view":
                          echo $row_div . "\n";
                          echo $label_div . "Updated by Company" . $close_div . "\n";
                          echo $data_div . date('Y-m-d @ g:m:s A T',$results[$table_fields[$i]["COLUMN_NAME"]]) . $close_div . "\n";
                          echo "\t" . $close_div . "\n";
                       break;
                    default:
                       echo $row_div . "\n";
                       if ($action == "edit" || $action == "add") {
                          echo $label_div . ucwords($table_fields[$i]["COLUMN_NAME"]) . $close_div . "\n";
                          echo $data_div . "<input class=\"edit\" type=\"text\" value=\"" . $results[$table_fields[$i]["COLUMN_NAME"]] . "\" name=\"" . $table_fields[$i]["COLUMN_NAME"] . "\"></input>" . $close_div . "\n";
                          } else {
                          echo $label_div . ucwords($table_fields[$i]["COLUMN_NAME"]) . $close_div . "\n";
                          echo $data_div . $results[$table_fields[$i]["COLUMN_NAME"]] . $close_div . "\n";
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

              echo "<br>";

              if ($action != "view") {
                 echo "<a href=\"?page=" . $table_name . "_item&action=view&id=" . $id . "\"><img src=\"/images/view.png\"></a>&nbsp;";
              }
              if ($action != "edit") {
                 echo "<a href=\"?page=" . $table_name . "_item&action=edit&id=" . $id . "\"><img src=\"/images/edit.png\"></a>&nbsp;";
              }
              if ($action != "delete") {
                  echo "<a href=\"?page=" . $table_name . "_item&action=delete&id=" . $id . "\" class=\"item-delete\"><img src=\"/images/delete.png\"></a>&nbsp;";
              }

         //END SWITCH
         }
?>
</div><!-- .entry-content -->
