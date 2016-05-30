<?php

         global $sys;

         require_once("includes/functions.php");
         require_once("includes/data_map.php");
         require_once("includes/project_tabs.php");

         //Get Requests
         $action        = (ISSET($_GET['action'])) ? $_GET['action'] : "view";
         $id    = (ISSET($_GET['id']) && is_numeric($_GET['id'])) ? $_GET['id'] : false;

         //SQL Injection Prevention
         if (!$id && $action != "add") {
            die("Error: Malformed Request");
         }

?>
<header class="entry-header">
   <h1 class="entry-title"><?php echo get_Project_Title($id) ?> - Land Development - <?php echo ucwords($action) ?></h1>
</header>
<div class="entry-content">
<?php

         // replace table name  by your table name
         $table_name = 'land_development';
         $url_name         = str_replace(" ", "_", $table_name);

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

               $stmt = $sys->db()->prepare("DELETE FROM [dbo].[" . $table_name . "] WHERE ld_id = :ld_id;");
               $stmt->bindParam(":ld_id", $id);

               $stmt->execute();

               LogActivity($sys->auth()->user_name, "DELETE LD_ID: " . $id);

               echo redirect_to("?page=" . $table_name . "&id=" . $id);

               break;
            //CASE MODIFY - SHOW PAGE AFTER MODIFICATION (Form submission actions reside here)
            case "add":

               if (ISSET($_POST['submit-action'])) {
                  if ($_POST['submit-action'] == "add") {
                     $datatypes = array();

                     $sql = "INSERT INTO [dbo].[" . $table_name . "] (";

                     for ($i = 0; $i < count($table_fields); $i++) {

                           $sql .= "\"" . $table_fields[$i]["COLUMN_NAME"] . "\",";

                           //Need this later for the bindParams
                           $datatypes[generateColumnName($table_fields[$i]["COLUMN_NAME"])] = $table_fields[$i]["TYPE_NAME"];
                     }

                     $sql = substr($sql, 0, -1);

                     $sql .= ") VALUES (";

                     $sql .= ":ld_id,:ld_last_modified,";

                     foreach ($_POST as $key => $value) {
                        if ($key != "submit-action" && $key != "ld_id" && $key != "ld_last_modified") {
                           $sql .= ":" . generateColumnName($key) . ",";
                        }

                     }

                     $sql = substr($sql, 0, -1);

                     $sql .= ");";

                     echo $sql;

                     $stmt = $sys->db()->prepare($sql);

                     $stmt->bindValue(":ld_id", $id, PDO::PARAM_INT);
                     $stmt->bindValue(":ld_last_modified", time(), PDO::PARAM_INT);

                     foreach ($_POST as $key => $value) {

                        if ($key != "submit-action" && $key != "ld_id") {
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

                     LogActivity($sys->auth()->user_name, "INSERT LD_ID: " . $id);

                     echo "Added successfully, redirecting...";

                     echo redirect_to("?page=" . $url_name . "&action=view&id=" . $id);

                     break;
                  }
               }
            case "edit":
               if (ISSET($_POST['submit-action'])) {
                  if ($_POST['submit-action'] == "edit") {
                     $datatypes = array();

                     $sql = "UPDATE [dbo].[" . $table_name . "] SET";

                     for ($i = 0; $i < count($table_fields); $i++) {
                        if ($table_fields[$i]["COLUMN_NAME"] != "ld_id") {

                           if ($table_fields[$i]["COLUMN_NAME"] == "ld_last_modified") {
                              $sql .= " [" . $table_fields[$i]["COLUMN_NAME"] . "] = '" . time() . "',";
                           } else {
                              $sql .= " [" . $table_fields[$i]["COLUMN_NAME"] . "] = :" . generateColumnName($table_fields[$i]["COLUMN_NAME"]) . ",";
                           }

                           //Need this later for the bindParams
                           $datatypes[generateColumnName($table_fields[$i]["COLUMN_NAME"])] = $table_fields[$i]["TYPE_NAME"];
                        }
                     }

                     $sql = substr($sql, 0, -1);

                     $sql .= " WHERE ld_id = :ld_id";

                     $stmt = $sys->db()->prepare($sql);

                     foreach ($_POST as $key => $value) {

                        if ($key != "submit-action" && $key != "ld_id") {
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

                     $stmt->bindValue(":ld_id", $id, PDO::PARAM_INT);

                     $stmt->execute();

                     LogActivity($sys->auth()->user_name, "UPDATE LD_ID: " . $id);

                     echo "Updated successfully, redirecting...";

                     echo redirect_to("?page=" . $url_name . "&action=view&id=" . $id);

                     break;
                  }
               }
            //CASE VIEW/DEFAULT - SHOW PAGE
            case "view":
            default:

              //SQL Statement
              $stmt = $sys->db()->prepare("SELECT * FROM [dbo].[" . $table_name . "] WHERE ld_id = :ld_id;", array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
              $stmt->bindParam(":ld_id", $id);

              $stmt->execute();

              $results = $stmt->fetch();

              $count = $stmt->rowCount();

              $row_div    = "\t<div class=\"data_row\">";
              $label_div  = "\t\t<div class=\"column_label\">";
              $data_div   = "\t\t<div class=\"column_data\">";
              $close_div  = "</div>";

              if ($action == "edit" || $action == "add") {
                  //If there are no results, this is an add, not an edit.
                  $submit_action = ($count > 0) ? $action : "add";

                  echo "<form action=\"?page=" . $url_name . "&action=" . $submit_action . "&id=" . $id . "\" method=\"post\">";
                  echo "<input type=\"hidden\" name=\"submit-action\" value=\"" . $submit_action . "\">";
              }

              if ($action != "view") {
                 echo "<a href=\"?page=" . $url_name . "&action=view&id=" . $id . "\"><img src=\"/images/view.png\"></a>&nbsp;";
              }
              if ($action != "edit" && $action != "add") {
                 echo "<a href=\"?page=" . $url_name . "&action=edit&id=" . $id . "\"><img src=\"/images/edit.png\"></a>&nbsp;";
              }
              if ($action != "delete") {
                  echo "<a href=\"?page=" . $url_name . "&action=delete&id=" . $id . "\" class=\"item-delete\"><img src=\"/images/delete.png\"></a>&nbsp;";
              }

              //Table DIV
              project_tabs('land');
              echo "<div class=\"data_table no_top_margin\">";

              for ($i = 0; $i < count($table_fields); $i++) {

                 $row_type = $table_fields[$i]["COLUMN_NAME"] . "-" . $action;

                 if ($table_fields[$i]["LENGTH"] > 250) {
                    $row_type = "textfield-" . $action;
                 }


                 switch (strtolower($row_type)) {
                    /* Don't display these */
                    case "ld_id-add":
                    case "ld_last_modified-add":
                     break;
                    /* Display these as formatted */
                    case "ld_id-edit":
                    case "ld_id-view":
                       echo "<input type=\"hidden\" value=\"" . $results[$table_fields[$i]["COLUMN_NAME"]] . "\" name=\"" . $table_fields[$i]["COLUMN_NAME"] . "\"></input>\n";
                       break;
                    case "ld_last_modified-view":
                    case "ld_last_modified-edit":
                       echo $row_div . "\n";
                       echo $label_div . ucwords($map_land[$table_fields[$i]["COLUMN_NAME"]]) . $close_div . "\n";
                       if (is_numeric($results[$table_fields[$i]["COLUMN_NAME"]])) {
                        echo $data_div . date('Y-m-d @ g:m:s A T',$results[$table_fields[$i]["COLUMN_NAME"]]) . $close_div . "\n";
                       } else {
                        echo $data_div . "New" . $close_div . "\n";
                       }
                       echo "\t" . $close_div . "\n";
                       break;
                    case "textfield-edit":
                       echo $row_div . "\n";
                       echo $label_div . ucwords($map_land[$table_fields[$i]["COLUMN_NAME"]]) . $close_div . "\n";
                       echo $data_div . "<textarea class=\"edit\" rows=\"4\" cols=\"50\"  maxlength=\"" . $table_fields[$i]["LENGTH"] . "\" name=\"" . $table_fields[$i]["COLUMN_NAME"] . "\">" . htmlspecialchars($results[$table_fields[$i]["COLUMN_NAME"]]) . "</textarea>" . $close_div . "\n";
                       echo "\t" . $close_div . "\n";
                       break;
                    /* Dispaly these default format */
                    case "ld_owner_contact-edit":
                    case "ld_team1-edit":
                    case "ld_team2-edit":
                    case "ld_team3-edit":
                    case "ld_team4-edit":
                    case "ld_engi_contact-edit":
                    case "ld_exc_contact-edit":
                    case "ld_wet_contact-edit":
                    case "ld_pavi_contact-edit":
                    case "ld_dry_contact-edit":
                       echo $row_div . "\n";
                          echo $label_div . ucwords($map_land[$table_fields[$i]["COLUMN_NAME"]]) . $close_div . "\n";
                          echo $data_div . "<select class=\"edit contact\" name=\"" . $table_fields[$i]["COLUMN_NAME"] . "\" value=\"" . htmlspecialchars($results[$table_fields[$i]["COLUMN_NAME"]]) . "\"><option value=\"\">Select One</option></select>" . $close_div . "\n";
                       echo "\t" . $close_div . "\n";
                       break;
                    case "ld_owner_contact_company-edit":
                    case "ld_exc_contact_company-edit":
                    case "ld_wet_contact_company-edit":
                    case "ld_pavi_contact_company-edit":
                    case "ld_dry_contact_company-edit":
                    case "ld_engi_contact_company-edit":
                       echo $row_div . "\n";
                          echo $label_div . ucwords($map_land[$table_fields[$i]["COLUMN_NAME"]]) . $close_div . "\n";
                          echo $data_div . "<select class=\"edit company\" name=\"" . $table_fields[$i]["COLUMN_NAME"] . "\" value=\"" . htmlspecialchars($results[$table_fields[$i]["COLUMN_NAME"]]) . "\"><option value=\"\">Select One</option></select>" . $close_div . "\n";
                       echo "\t" . $close_div . "\n";
                       break;
                    case "ld_soil1_type-edit":
                    case "ld_soil2_type-edit":
                    case "ld_soil3_type-edit":
                    case "ld_soil4_type-edit":
                    case "ld_soil5_type-edit":
                    case "ld_soil6_type-edit":
                    case "ld_soil7_type-edit":
                       echo $row_div . "\n";
                          echo $label_div . ucwords($map_land[$table_fields[$i]["COLUMN_NAME"]]) . $close_div . "\n";
                          echo $data_div . "<select class=\"edit soil\" name=\"" . $table_fields[$i]["COLUMN_NAME"] . "\" value=\"" . htmlspecialchars($results[$table_fields[$i]["COLUMN_NAME"]]) . "\"><option value=\"\">Select One</option></select>" . $close_div . "\n";
                       echo "\t" . $close_div . "\n";
                       break;
                    default:
                       echo $row_div . "\n";
                       if ($action == "edit" || $action == "add") {
                          echo $label_div . ucwords($map_land[$table_fields[$i]["COLUMN_NAME"]]) . $close_div . "\n";
                          echo $data_div . "<input class=\"edit\" type=\"text\" value=\"" . htmlspecialchars($results[$table_fields[$i]["COLUMN_NAME"]]) . "\" name=\"" . $table_fields[$i]["COLUMN_NAME"] . "\" maxlength=\"" . $table_fields[$i]["LENGTH"] . "\"></input>" . $close_div . "\n";
                          } else {
                          echo $label_div . ucwords($map_land[$table_fields[$i]["COLUMN_NAME"]]) . $close_div . "\n";
                          echo $data_div . htmlspecialchars($results[$table_fields[$i]["COLUMN_NAME"]]) . $close_div . "\n";
                       }
                       echo "\t" . $close_div . "\n";
                 }


              }

              //DIV TABLE
              echo $close_div;

              if ($action == "edit" || $action == "add") {
                  echo "<br><center><input class=\"submit-center\" type=\"submit\" value=\"Submit\"></center>";
                  echo "</form>";
              }

              echo "<br>";

              if ($action != "view") {
                 echo "<a href=\"?page=" . $url_name . "&action=view&id=" . $id . "\"><img src=\"/images/view.png\"></a>&nbsp;";
              }
              if ($action != "edit" && $action != "add") {
                 echo "<a href=\"?page=" . $url_name . "&action=edit&id=" . $id . "\"><img src=\"/images/edit.png\"></a>&nbsp;";
              }
              if ($action != "delete") {
                  echo "<a href=\"?page=" . $url_name . "&action=delete&id=" . $id . "\" class=\"item-delete\"><img src=\"/images/delete.png\"></a>&nbsp;";
              }

         //END SWITCH
         }
?>
<script language="javascript" type="text/javascript" src="js/autopop.js"></script>
</div><!-- .entry-content -->
