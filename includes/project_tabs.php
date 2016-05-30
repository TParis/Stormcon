<?php

function project_tabs($page) {

require_once("includes/functions.php");

   global $sys;

   //Get Requests
   $action        = (ISSET($_GET['action'])) ? $_GET['action'] : "view";
   $id    = (ISSET($_GET['id']) && is_numeric($_GET['id'])) ? $_GET['id'] : false;

   ?>
   <div class="tabs">

      <div class="tab no_top_margin <?php if ($page=="project") { echo "tab-active"; } ?>"><a href="<?php echo $sys->base_url; ?>?page=projects_item&action=<?php echo $action;?>&id=<?php echo $id;?>">Project</a></div>
      <div class="tab no_top_margin <?php if ($page=="batch") { echo "tab-active"; } ?>"><a href="<?php echo $sys->base_url; ?>?page=batch_plants&action=<?php echo $action;?>&id=<?php echo $id;?>">Batch Plant</a></div>
      <div class="tab no_top_margin <?php if ($page=="elec") { echo "tab-active"; } ?>"><a href="<?php echo $sys->base_url; ?>?page=electric&action=<?php echo $action;?>&id=<?php echo $id;?>">Electric</a></div>
      <div class="tab no_top_margin <?php if ($page=="gas") { echo "tab-active"; } ?>"><a href="<?php echo $sys->base_url; ?>?page=gas&action=<?php echo $action;?>&id=<?php echo $id;?>">Gas</a></div>
      <div class="tab no_top_margin <?php if ($page=="cont") { echo "tab-active"; } ?>"><a href="<?php echo $sys->base_url; ?>?page=gen_contracting&action=<?php echo $action;?>&id=<?php echo $id;?>">Gen. Contracting</a></div>
      <div class="tab no_top_margin <?php if ($page=="home") { echo "tab-active"; } ?>"><a href="<?php echo $sys->base_url; ?>?page=home_building&action=<?php echo $action;?>&id=<?php echo $id;?>">Home Building</a></div>
      <div class="tab no_top_margin <?php if ($page=="land") { echo "tab-active"; } ?>"><a href="<?php echo $sys->base_url; ?>?page=land_development&action=<?php echo $action;?>&id=<?php echo $id;?>">Land Development</a></div>


   </div>
   <div class="tab-bottom no_top_margin"></div>
   <?php
}
