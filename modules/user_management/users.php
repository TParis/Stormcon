<?php

global $sys;

require_once("includes/functions.php");

if (!defined("__INSYS__")  || !$sys->auth()->user_admin) {
   die("Error: Malformed Request");
}

?>
<header class="entry-header">
   <h1 class="entry-title"><?php echo ucwords(str_replace("_", " ", $page)); ?> Lookup</h1>
</header>
<div class="entry-content">
<div class="search-box">
   <form method="POST">
      <input type="text" class="searchfield" name="search" value="<?php echo (ISSET($_GET['search'])) ? $_GET['search'] : ""; ?>"><input type="button" class="searchbutton" value="Search">
   </form>
</div>
<?php


         $table_name    = "users";
         $url_name         = str_replace(" ", "_", $table_name);
         $select_columns   = "[username],  [user_full_name], [user_email], [user_active]";
         $order_by         = "[username]";

         $page_limit       = (ISSET($_GET['limit']) && is_numeric($_GET['limit'])) ? $_GET['limit'] : 20;

         //Start to build SQL Statement for general results
         $sql              = "SELECT user_id, " . $select_columns . " FROM [dbo].[" . $table_name . "]";
         $count_sql        = "SELECT Count(*) FROM [dbo].[" . $table_name . "]";

         //Actions
         if (ISSET($_GET['action'])) {

            global $auth;

            if (ISSET($_GET['id'])) {

               $id = $_GET['id'];

                  switch ($_GET['action']) {

                    case 'activate':

                       $auth->activate($id);

                       break;

                    case 'disable':

                       $auth->deactivate($id);

                       break;
               }
            }
         }

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

         echo "<div class=\"pageination\"><span class=\"add-new\"><a href=\"?page=user_management_item&action=add\">Add New</a></span>";

         if ($curr_page > 1) {
            echo "<span class=\"page_prev\" type=\"button\" id=\"page-prev\">&nbsp;</span>";
         }
         echo "<span>Page " . $curr_page . " of " . $num_pages . "</span>";
         if ($curr_page < $num_pages) {
            echo "<span class=\"page_next\" type=\"button\" id=\"page-next\">&nbsp;</span>";
         }

         echo "</div>";
         echo "<div class=\"data_table\">";

         echo "\t" . $row_div . "\n";
         echo "\t\t\t\t<div class=\"column_label wide_label\">Actions" . $close_div . "\n";
         echo "\t\t" . $label_div . "Username" . $close_div . "\n";
         echo "\t\t" . $label_div . "Name" . $close_div . "\n";
         echo "\t\t" . $label_div . "Email" . $close_div . "\n";
         echo "\t\t" . $label_div . "Active" . $close_div . "\n";
         echo "\t" . $close_div . "\n";

         if (empty($results)) {
            echo "\t" . $row_div . "\n";
            echo "\t\t" . $data_div . "No results returned from query." . $close_div . "\n";
            echo "\t" . $close_div . "\n";
         }

         foreach ($results as $row) {

            echo "\t" . $row_div . "\n";

            echo "\t\t" . $data_div;
               echo "<a href=\"?page=user_management_item&action=view&id=" . $row['user_id'] . "\"><img src=\"/images/view.png\"></a>&nbsp;";
               echo "<a href=\"?page=user_management_item&action=edit&id=" . $row['user_id'] . "\"><img src=\"/images/edit.png\"></a>&nbsp;";
               if (!$row['user_active']) {
                  echo "<a href=\"?page=user_management&action=activate&id=" . $row['user_id'] . "\"><img src=\"/images/activate.png\"></a>&nbsp;";
               } else {
                  echo "<a href=\"?page=user_management&action=disable&id=" . $row['user_id'] . "\"><img src=\"/images/disable.png\"></a>&nbsp;";
               }
               echo "<a href=\"?page=user_management_item&action=delete&id=" . $row['user_id'] . "\" class=\"item-delete\"><img src=\"/images/delete.png\"></a>";
            echo $close_div . "\n";
            echo "\t\t" . $data_div . $row[1] . $close_div . "\n";
            echo "\t\t" . $data_div . $row[2] . $close_div . "\n";
            echo "\t\t" . $data_div . "<a class=\"wp\" href=\"mailto:" . $row[3] . "\">" . $row[3] . "</a>" . $close_div . "\n";

            $is_active = ($row['user_active']) ? "Active" : "Disabled";

            echo "\t\t" . $data_div . $is_active . $close_div . "\n";

            echo "\t" . $close_div . "\n";

         }

         echo $close_div;

         echo "<div class=\"pageination\">";

         if ($curr_page > 1) {
            echo "<span class=\"page_prev\" type=\"button\" id=\"page-prev\">&nbsp;</span>";
         }
         echo "<span>Page " . $curr_page . " of " . $num_pages . "</span>";
         if ($curr_page < $num_pages) {
            echo "<span class=\"page_next\" type=\"button\" id=\"page-next\">&nbsp;</span>";
         }

         echo "</div>";
?>
</div><!-- .entry-content -->
