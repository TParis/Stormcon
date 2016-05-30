<header class="entry-header">
   <h1 class="entry-title"><?php echo str_replace("_", " ", substr($page, 3, -5)); ?> SWPPP</h1>
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
         $table_name = 'ld_2013 DATA BASE LD';
         $url_name = str_replace(" ", "_", $table_name);

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

               echo redirect_to("?page=" . $url_name);

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
                        if ($table_fields[$i]["COLUMN_NAME"] != "id") {
                           $sql .= "\"" . $table_fields[$i]["COLUMN_NAME"] . "\",";

                           //Need this later for the bindParams
                           $datatypes[generateColumnName($table_fields[$i]["COLUMN_NAME"])] = $table_fields[$i]["TYPE_NAME"];
                        }
                     }

                     $sql = substr($sql, 0, -1);

                     $sql .= ") VALUES (";

                     foreach ($_POST as $key => $value) {
                        if ($key != "submit-action" && $key != "id") {
                           $sql .= ":" . generateColumnName($key) . ",";
                        }
                     }

                     $sql = substr($sql, 0, -1);

                     $sql .= ");";

                     $stmt = $sys->db()->prepare($sql);

                     foreach ($_POST as $key => $value) {

                        if ($key != "submit-action" && $key != "id") {
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

                     echo "Added successfully, redirecting...";

                     echo redirect_to("?page=" . $url_name . "_item&action=view&id=" . $sys->db()->lastInsertId());

                     break;

                  } else if ($_POST['submit-action'] == "edit") {
                     $datatypes = array();

                     $sql = "UPDATE [dbo].[" . $table_name . "] SET";

                     for ($i = 0; $i < count($table_fields); $i++) {
                        if ($table_fields[$i]["COLUMN_NAME"] != "id") {

                           $sql .= " [" . $table_fields[$i]["COLUMN_NAME"] . "] = :" . generateColumnName($table_fields[$i]["COLUMN_NAME"]) . ",";

                           //Need this later for the bindParams
                           $datatypes[generateColumnName($table_fields[$i]["COLUMN_NAME"])] = $table_fields[$i]["TYPE_NAME"];
                        }
                     }

                     $sql = substr($sql, 0, -1);

                     $sql .= " WHERE id = :id";

                     $stmt = $sys->db()->prepare($sql);

                     foreach ($_POST as $key => $value) {

                        if ($key != "submit-action" && $key != "id") {
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

                     echo "Updated successfully, redirecting...";

                     echo redirect_to("?page=" . $url_name . "_item&action=view&id=" . $id);

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
                  echo "<form action=\"?page=" . $url_name . "_item&action=" . $action . "&id=" . $id . "\" method=\"post\">";
                  echo "<input type=\"hidden\" name=\"submit-action\" value=\"" . $action . "\">";
              } else if ($action == "view") {
                  echo "<a href=\"?page=" . $url_name . "_item&action=edit&id=" . $id . "\">Edit</a> - <a href=\"?page=" . $url_name . "_item&action=delete&id=" . $id . "\" class=\"item-delete\">Delete</a>";
              }

              //Table DIV
              echo "<div class=\"data_table\">";

              for ($i = 0; $i < count($table_fields); $i++) {

                 $row_type = $table_fields[$i]["COLUMN_NAME"] . "-" . $action;

                 if (strlen($results[$table_fields[$i]["COLUMN_NAME"]]) > 50) {
                    $row_type = "textfield-" . $action;
                 }

                 echo $row_div . "\n";

                 switch (strtolower($row_type)) {
                    case "contact exc-add":
                    case "contact exc-edit":
                    case "contact utility-add":
                    case "contact utility-edit":
                    case "contact paving-add":
                    case "contact paving-edit":
                    case "contact dry-add":
                    case "contact dry-edit":
                    case "inspector 1-add":
                    case "inspector 1-edit":

                        echo $label_div . $table_fields[$i]["COLUMN_NAME"] . $close_div . "\n";
                        echo $data_div;
                        echo "<SELECT name=\"" . $table_fields[$i]["COLUMN_NAME"] . "\" class=\"contacts-name\">";

                        echo "<OPTION VALUE=\"" . $results[$table_fields[$i]["COLUMN_NAME"]] . "\">" . $results[$table_fields[$i]["COLUMN_NAME"]] . "</OPTION>";

                        $contacts = $sys->db()->prepare("SELECT CONCAT([First name], ' ', [Last name]) as [Name], ID FROM contacts ORDER BY [Last name], [First name];");

                        $contacts->execute();

                        foreach ($contacts as $contact) {


                           if ($results[$table_fields[$i]["COLUMN_NAME"]] == $contact["Name"]) {

                              echo "<OPTION SELECTED VALUE=\"" . $contact["Name"] . "\">" . $contact["Name"] . "</OPTION>";

                           } else {

                              echo "<OPTION VALUE=\"" . $contact["Name"] . "\">" . $contact["Name"] . "</OPTION>";

                           }
                        }

                        echo "</SELECT>";
                        echo $close_div . "\n";
                        break;
                    case "contact company exc-add":
                    case "contact company exc-edit":
                    case "contact company utility-add":
                    case "contact company utility-edit":
                    case "contact company paving-add":
                    case "contact company paving-edit":
                    case "contact company dry-add":
                    case "contact company dry-edit":
                    case "inspector company 1-add":
                    case "inspector company 1-edit":

                        echo $label_div . $table_fields[$i]["COLUMN_NAME"] . $close_div . "\n";
                        echo $data_div;
                        echo "<SELECT name=\"" . $table_fields[$i]["COLUMN_NAME"] . "\" class=\"company-contacts\">";

                        echo "<OPTION VALUE=\"" . $results[$table_fields[$i]["COLUMN_NAME"]] . "\">" . $results[$table_fields[$i]["COLUMN_NAME"]] . "</OPTION>";

                        $companies = $sys->db()->prepare("SELECT [ID], [Company name] FROM companies ORDER BY [Company name];");

                        $companies->execute();

                        foreach ($companies as $company) {


                           if ($results[$table_fields[$i]["COLUMN_NAME"]] == $company["Company name"]) {

                              echo "<OPTION SELECTED VALUE=\"" . $company["Company name"] . "\">" . $company["Company name"] . "</OPTION>";

                           } else {

                              echo "<OPTION VALUE=\"" . $company["Company name"] . "\">" . $company["Company name"] . "</OPTION>";

                           }
                        }

                        echo "</SELECT>";
                        echo $close_div . "\n";
                        break;
                    case "soil type 1-add":
                    case "soil type 1-edit":
                    case "soil type 2-add":
                    case "soil type 2-edit":
                    case "soil type 3-add":
                    case "soil type 3-edit":
                    case "soil type 4-add":
                    case "soil type 4-edit":

                        echo $label_div . $table_fields[$i]["COLUMN_NAME"] . $close_div . "\n";
                        echo $data_div;
                        echo "<SELECT name=\"" . $table_fields[$i]["COLUMN_NAME"] . "\" class=\"soil-types\">";

                        echo "<OPTION VALUE=\"" . $results[$table_fields[$i]["COLUMN_NAME"]] . "\">" . $results[$table_fields[$i]["COLUMN_NAME"]] . "</OPTION>";

                        $soils = $sys->db()->prepare("SELECT [ID], [Soil name] FROM soils ORDER BY [Soil name];");

                        $soils->execute();

                        foreach ($soils as $soil) {


                           if ($results[$table_fields[$i]["COLUMN_NAME"]] == $soil["Soil name"]) {

                              echo "<OPTION SELECTED VALUE=\"" . $soil["Soil name"] . "\">" . $soil["Soil name"] . "</OPTION>";

                           } else {

                              echo "<OPTION VALUE=\"" . $soil["Soil name"] . "\">" . $soil["Soil name"] . "</OPTION>";

                           }
                        }

                        echo "</SELECT>";
                        echo $close_div . "\n";

                        break;
                    case "id-add":
                     break;
                    case "id-edit":
                    case "id-view":
                       echo "<input type=\"hidden\" value=\"" . $results[$table_fields[$i]["COLUMN_NAME"]] . "\" name=\"" . $table_fields[$i]["COLUMN_NAME"] . "\"></input>\n";
                       break;
                    case "textfield-edit":
                       echo $label_div . $table_fields[$i]["COLUMN_NAME"] . $close_div . "\n";
                       echo $data_div . "<textarea class=\"edit\" rows=\"4\" cols=\"50\" maxlength=\"2500\" name=\"" . $table_fields[$i]["COLUMN_NAME"] . "\">" . $results[$table_fields[$i]["COLUMN_NAME"]] . "</textarea>" . $close_div . "\n";
                       break;
                    default:
                       if ($action == "edit" || $action == "add") {
                          echo $label_div . ucwords($table_fields[$i]["COLUMN_NAME"]) . $close_div . "\n";
                          echo $data_div . "<input class=\"edit\" type=\"text\" value=\"" . $results[$table_fields[$i]["COLUMN_NAME"]] . "\" name=\"" . $table_fields[$i]["COLUMN_NAME"] . "\"></input>" . $close_div . "\n";
                          } else {
                          echo $label_div . ucwords($table_fields[$i]["COLUMN_NAME"]) . $close_div . "\n";
                          echo $data_div . $results[$table_fields[$i]["COLUMN_NAME"]] . $close_div . "\n";
                       }
                 }

                 echo "\t" . $close_div . "\n";

              }

              //DIV TABLE
              echo $close_div;

              if ($action == "edit" || $action == "add") {
                  echo "<center><input class=\"submit-center\" type=\"submit\" value=\"Submit\"></center>";
                  echo "</form>";
              } else if ($action == "view") {
                  echo "<a href=\"?page=" . $url_name . "_item&action=edit&id=" . $id . "\">Edit</a> - <a href=\"?page=" . $url_name . "_item&action=delete&id=" . $id . "\" class=\"item-delete\">Delete</a>";
              }

         //END SWITCH
         }
?>
</div><!-- .entry-content -->
