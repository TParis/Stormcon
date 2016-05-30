<header class="entry-header">
   <h1 class="entry-title"><?php echo str_replace("_", " ", substr($page, 3)); ?> Lookup</h1>
</header>
<div class="entry-content">
<div class="search-box">
   <form method="POST">
      <input type="text" class="searchfield" name="search" value="<?php echo (ISSET($_GET['search'])) ? $_GET['search'] : ""; ?>"><input type="button" class="searchbutton" value="Search">
   </form>
</div>
<?php

         global $sys;

         require_once("includes/functions.php");

         $table_name    = "bp_DATA BASE AUSTIN BRIDGE";
         $url_name         = str_replace(" ", "_", $table_name);
         $select_columns   = "[Project],  [location], [Owners name], [Owner Phone]";
         $order_by         = "[Project]";

         $page_limit       = (ISSET($_GET['limit']) && is_numeric($_GET['limit'])) ? $_GET['limit'] : 20;

         //Start to build SQL Statement for general results
         $sql              = "SELECT id, " . $select_columns . " FROM [dbo].[" . $table_name . "]";
         $count_sql        = "SELECT Count(*) FROM [dbo].[" . $table_name . "]";

         //Search
         if (ISSET($_GET['search'])) {

            $search_terms  = "%" . $_GET['search'] . "%";

            $col_sql       = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME  = PARSENAME('" . $table_name . "', 1) AND DATA_TYPE IN ('char', 'varchar', 'nchar', 'nvarchar')";
            $col_query     = $sys->db()->prepare($col_sql);
            $col_query->execute();

            $where_clause  = " WHERE ";

            $columns       = "";

            foreach ($col_query->fetchAll() as $column) {

               $column_nosp = generateColumnName($column['COLUMN_NAME']);

               $where_clause .= " [" . $column['COLUMN_NAME'] . "] LIKE :" . $column_nosp . " OR";

               if (is_array($columns)) {
                  $columns[$column_nosp] = $search_terms;
               } else {
                  $columns = array($column_nosp => $search_terms);
               }
            }

            $where_clause  = substr($where_clause, 0, -3);

            $sql           .= $where_clause;
            $count_sql     .= $where_clause;

         }

         //ORDER BY

         $sql .= " ORDER BY " . $order_by;

         //Pagination
         $start = (ISSET($_GET['start']) && is_numeric($_GET['start'])) ? $_GET['start'] : 0;
         $sql .= " OFFSET " . $start . " ROWS FETCH NEXT 20 ROWS ONLY";

         $stmt = $sys->db()->prepare($sql);
         $ctmt = $sys->db()->prepare($count_sql);

         //Execute for search
         if (ISSET($_GET['search'])) {

            $stmt->execute($columns);
            $ctmt->execute($columns);

         //No Search
         } else {

            $stmt->execute();
            $ctmt->execute();

         }

         //Count Pages
         $num_pages      = ceil(current($ctmt->fetch()) / 20);
         $curr_page      = floor($start / 20) + 1;

         //Display Results
         $results    = $stmt->fetchAll();

         $row_div    = "\t<div class=\"data_row\">";
         $label_div  = "\t\t<div class=\"column_label\">";
         $data_div   = "\t\t<div class=\"column_data\">";
         $close_div  = "</div>";

         echo "<div class=\"pageination\"><span class=\"add-new\"><a href=\"?page=" . $url_name . "_item&action=add\">Add New</a></span>";
         echo "<span class=\"page_prev\" type=\"button\" id=\"page-prev\">&nbsp;</span><span>Page " . $curr_page . " of " . $num_pages . "</span><span class=\"page_next\" type=\"button\" id=\"page-next\">&nbsp;</span></div>";

         echo "<div class=\"data_table\">";

         echo "\t" . $row_div . "\n";
         echo "\t\t" . $label_div . "Actions" . $close_div . "\n";
         echo "\t\t" . $label_div . "Project" . $close_div . "\n";
         echo "\t\t" . $label_div . "Location" . $close_div . "\n";
         echo "\t\t" . $label_div . "Owner" . $close_div . "\n";
         echo "\t\t" . $label_div . "Phone" . $close_div . "\n";
         echo "\t" . $close_div . "\n";

         if (empty($results)) {
            echo "\t" . $row_div . "\n";
            echo "\t\t" . $data_div . "No results returned from query." . $close_div . "\n";
            echo "\t" . $close_div . "\n";
         }

         foreach ($results as $row) {

            echo "\t" . $row_div . "\n";

            echo "\t\t" . $data_div;
               echo "<a href=\"?page=" . $url_name . "_item&action=view&id=" . $row['id'] . "\"><img src=\"/images/view.png\"></a>&nbsp;";
               echo "<a href=\"?page=" . $url_name . "_item&action=edit&id=" . $row['id'] . "\"><img src=\"/images/edit.png\"></a>&nbsp;";
               echo "<a href=\"?page=" . $url_name . "_item&action=delete&id=" . $row['id'] . "\" class=\"item-delete\"><img src=\"/images/delete.png\"></a>";
            echo $close_div . "\n";
            echo "\t\t" . $data_div . $row[1] . $close_div . "\n";
            echo "\t\t" . $data_div . $row[2] . $close_div . "\n";
            echo "\t\t" . $data_div . $row[3] . $close_div . "\n";
            echo "\t\t" . $data_div . $row[4] . $close_div . "\n";

            echo "\t" . $close_div . "\n";

         }

         echo $close_div;


         echo "<div class=\"pageination\"><input class=\"page_prev\" type=\"button\" name=\"page-prev\" value=\"<\"> Page " . $curr_page . " of " . $num_pages . " <input class=\"page_next\" type=\"button\" name=\"page-next\" value=\">\"></div>";

?>
</div><!-- .entry-content -->
