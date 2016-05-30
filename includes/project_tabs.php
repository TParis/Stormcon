<?php

function project_tabs($page) {

require_once("includes/functions.php");

   global $sys;

   ?>
   <div class="tabs">

      <div class="tab no_top_margin <?php if ($page=="proj") { echo "tab-active"; } ?>"><a href="<?php echo $sys->base_url; ?>?page=projects_item&action=view&id=<?php echo $sys->page->id;?>">Project</a></div>
      <div class="tab no_top_margin <?php if ($page=="batch") { echo "tab-active"; } ?>"><a name="<?php echo $sys->base_url; ?>?page=batch_plants&action=view&id=<?php echo $sys->page->id;?>">Batch Plant</a></div>
      <div class="tab no_top_margin <?php if ($page=="elec") { echo "tab-active"; } ?>"><a href="<?php echo $sys->base_url; ?>?page=electric&action=view&id=<?php echo $sys->page->id;?>">Electric</a></div>
      <div class="tab no_top_margin <?php if ($page=="gas") { echo "tab-active"; } ?>"><a href="<?php echo $sys->base_url; ?>?page=gas&action=view&id=<?php echo $sys->page->id;?>">Gas</a></div>
      <div class="tab no_top_margin <?php if ($page=="cont") { echo "tab-active"; } ?>"><a href="<?php echo $sys->base_url; ?>?page=gen_contracting&action=view&id=<?php echo $sys->page->id;?>">Gen. Contracting</a></div>
      <div class="tab no_top_margin <?php if ($page=="home") { echo "tab-active"; } ?>"><a href="<?php echo $sys->base_url; ?>?page=home_building&action=view&id=<?php echo $sys->page->id;?>">Home Building</a></div>
      <div class="tab no_top_margin <?php if ($page=="land") { echo "tab-active"; } ?>"><a href="<?php echo $sys->base_url; ?>?page=land_development&action=view&id=<?php echo $sys->page->id;?>">Land Development</a></div>


   </div>
   <div class="tab-bottom no_top_margin"></div>
   <?php
}
