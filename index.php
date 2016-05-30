<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" lang="en-US">
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" lang="en-US">
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html lang="en-US">
<!--<![endif]-->
   <?php
      error_reporting(E_ALL);
      ini_set('display_errors', 1);


      if (!defined("__INSYS__")) {
         DEFINE('__INSYS__', true);
      }

      require_once("includes/core.php");
      require_once("includes/auth.php");
      require_once("includes/database.php");

      $auth = new auth();
      $sys = new core($dbh);

      if (ISSET($_COOKIE['auth_session']) && $auth->checksession($_COOKIE['auth_session'])) {
         $sys->set_auth($auth->sessioninfo($_COOKIE['auth_session']), $_COOKIE['auth_session']);
      }

   ?>
   <head>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width" />
      <title>Stormcon LLC | SWPPP Management System</title>
      <link rel='stylesheet' id='twentytwelve-style-css'  href='css/styles.css' type='text/css' media='all' />
      <link rel='canonical' href='http://stormcon.sitedevbox.com/' />
      <link rel='shortlink' href='http://stormcon.sitedevbox.com/' />
      <link rel="stylesheet" href="css/nav_styles.css">
      <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
      <link href='http://fonts.googleapis.com/css?family=Lato:400,100,300,700' rel='stylesheet' type='text/css'>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
      <script type="text/javascript">
        $(document).ready(function() {
         $('#menu li').on('mouseover',function(e){
           if($(this).has('ul').length) {
             $(this).parent().addClass('expanded');
           }
           $('ul:first',this).parent().find('> a').addClass('active');
           $('ul:first',this).show();
         }).on('mouseout',function(e){
           $(this).parent().removeClass('expanded');
           $('ul:first',this).parent().find('> a').removeClass('active');
           $('ul:first', this).hide();
         });
        });
      </script>
      <script src="js/scripts.js"></script>
   </head>

   <body class="home">
      <div id="page" class="container">
         <header id="masthead" class="site-header" role="banner">
<a href="http://stormcon-php.azurewebsites.net/" title="Stormcon LLC";"><div class="header"></div></a>
            <hgroup>
               <!--<h1 class="site-title"><a href="<?php echo $sys->base_url; ?>" title="Stormcon LLC" rel="home">Stormcon LLC</a></h1>
               <h2 class="site-description">SWPPP Management System</h2>-->
            </hgroup>

            <nav id="site-navigation" class="main-navigation" role="navigation">
               <div id="cssmenu" class="wrapper">
                  <ul id="menu" class="clearfix">
                     <li><a href="<?php echo $sys->base_url; ?>">Home</a></li>
                     <?php if ($auth->login_state()) { ?>
                     <li><a>Entities</a>
                        <ul>
                           <!--<li><a href="<?php echo $sys->base_url; ?>?page=clients">Clients</a></li>-->
                           <li><a href="<?php echo $sys->base_url; ?>?page=companies">Companies</a></li>
                           <li class="last"><a href="<?php echo $sys->base_url; ?>?page=contacts">Contacts</a></li>
                        </ul>
                     </li>
                     <li><a>Configuration</a>
                        <ul>
                           <li><a href="<?php echo $sys->base_url; ?>?page=bmps">BMPs</a></li>
                           <li><a href="<?php echo $sys->base_url; ?>?page=responsibility">Responsibilities</a></li>
                           <li class="last"><a href="<?php echo $sys->base_url; ?>?page=soils">Soils</a></li>
                        </ul>
                     </li>
                     <li><a href="<?php echo $sys->base_url; ?>?page=projects">SWPPPs</a>
                        <ul>
                               <li><a href="<?php echo $sys->base_url; ?>?page=hb_LENNAR_HB">LENNAR HB</a></li>
                               <li class="last"><a href="<?php echo $sys->base_url; ?>?page=ld_Lennar_LD">Lennar LD</a></li>
                        </ul>
                     <?php /*
                     <ul>
                         <li><a>Batch Plants</a>
                            <ul>
                               <li><a href="<?php echo $sys->base_url; ?>?page=bp_DATA_BASE_AUSTIN_BRIDGE">DATA BASE AUSTIN BRIDGE</a></li>
                               <li><a href="<?php echo $sys->base_url; ?>?page=bp_DATA_BASE_GILCO">DATA BASE GILCO</a></li>
                               <li><a href="<?php echo $sys->base_url; ?>?page=bp_DATA_BASE_LACY">DATA BASE LACY</a></li>
                               <li><a href="<?php echo $sys->base_url; ?>?page=bp_DATABASE_OSBURN_CONTRACTORS">DATA BASE OSBURN CONTRACTORS</a></li>
                            </ul>
                         </li>
                         <li><a>Electric</a>
                            <ul>
                               <li><a href="<?php echo $sys->base_url; ?>?page=elec_CPS_Electric">CPS Electric</a></li>
                               <li><a href="<?php echo $sys->base_url; ?>?page=elec_Coserv_Elec">Coserv Elec</a></li>
                            </ul>
                         </li>
                         <li><a>Gas</a>
                            <ul>
                               <li><a href="<?php echo $sys->base_url; ?>?page=gas_COSERV_GAS">CONSERV GAS</a></li>
                               <li><a href="<?php echo $sys->base_url; ?>?page=gas_CPS_GAS">CPS GAS</a></li>
                               <li><a href="<?php echo $sys->base_url; ?>?page=gas_DATA_BASE_ATMOS">DATA BASE ATMOS</a></li>
                            </ul>
                         </li>
                         <li><a>General Contracting</a>
                            <ul>
                               <li><a href="<?php echo $sys->base_url; ?>?page=gc_2013_DATA_BASE_GC_CIVIL">2013 DATA BASE GC CIVIL</a></li>
                               <li><a href="<?php echo $sys->base_url; ?>?page=gc_2013_DATA_BASE_GC_Vertical">2013 DATA BASE GC Vertical</a></li>
                            </ul>
                         </li>
                         <li><a>Home Building</a>
                            <ul>
                               <li><a href="<?php echo $sys->base_url; ?>?page=hb_2013_DATA_BASE_KB">2013 DATA BASE KB</a></li>
                               <li><a href="<?php echo $sys->base_url; ?>?page=hb_Beazer_HB">Beazer HB</a></li>
                               <li><a href="<?php echo $sys->base_url; ?>?page=hb_CAMBRIDGE_DATABASE_HOMEBUILDER">CAMBRIDGE DATABASE HOMEBUILDER</a></li>
                               <li><a href="<?php echo $sys->base_url; ?>?page=hb_HB_Drees">HB Drees</a></li>
                               <li><a href="<?php echo $sys->base_url; ?>?page=hb_HB_HGC">HB HGC</a></li>
                               <li><a href="<?php echo $sys->base_url; ?>?page=hb_HB_MERITAGE">HB MERITAGE</a></li>
                               <li><a href="<?php echo $sys->base_url; ?>?page=hb_LENNAR_HB">LENNAR HB</a></li>
                            </ul>
                         </li>
                         <li><a>Land Development</a>
                            <ul>
                               <li><a href="<?php echo $sys->base_url; ?>?page=ld_2013_DATA_BASE_DREES_AUSTIN">2013 DATA BASE DREES AUSTIN</a></li>
                               <li><a href="<?php echo $sys->base_url; ?>?page=ld_2013_DATA_BASE_DREES_DALLAS">2013 DATA BASE DREES DALLAS</a></li>
                               <li><a href="<?php echo $sys->base_url; ?>?page=ld_2013_DATA_BASE_LD">2013 DATA BASE LD</a></li>
                               <li><a href="<?php echo $sys->base_url; ?>?page=ld_LD_Beazer">LD Beazer</a></li>
                               <li><a href="<?php echo $sys->base_url; ?>?page=ld_Lennar_LD">Lennar LD</a></li>
                            </ul>
                         </li>
                        </ul>
                        */ ?>
                     </li>
                     <?php if ($sys->auth()->user_admin) { ?>
                     <li><a href="<?php echo $sys->base_url; ?>?page=user_management">Users</a></li>
                     <? } ?>
                     <li><a href="<?php echo $sys->base_url; ?>?page=update_requests">Update Requests</a></li>
                     <li><a href="<?php echo $sys->base_url; ?>?page=documents">Documents</a></li>
                     <li><a href="<?php echo $sys->base_url; ?>?page=logout">Logout</a></li>
                     <?php } else { ?>
                     <li><a href="<?php echo $sys->base_url; ?>?page=login">Login</a></li>
                     <?php } ?>
                  </ul>
               </div>
            </nav><!-- #site-navigation -->
         </header><!-- #masthead -->

         <div id="main" class="wrapper">
            <div id="primary" class="site-content">
               <div id="content" role="main">
                  <article class="page">
                     <?php

                        $page = (ISSET($_GET['page'])) ? $_GET['page'] : 'home';

                        if (!$auth->login_state() && $page != "updates") {
                           include("login.php");
                        } else if ($page == "updates") {
                           include("modules/update_requests/updates.php");
                        } else {


                           switch($page) {
                              case "logout":
                                 @$auth->deletesession($sys->auth()->session_hash);
                                 break;

                              /* ENTITIES */

                              case "clients":
                                 include("modules/clients/clients_list.php");
                                 break;
                              case "clients_item":
                                 include("modules/clients/clients_item.php");
                                 break;
                              case "companies":
                                 include("modules/companies/companies_list.php");
                                 break;
                              case "companies_item":
                                 include("modules/companies/companies_item.php");
                                 break;
                              case "contacts":
                                 include("modules/contacts/contacts_list.php");
                                 break;
                              case "contacts_item":
                                 include("modules/contacts/contacts_item.php");
                                 break;

                              /* CONFIGURATION */

                              case "bmps":
                                 include("modules/bmps/bmps_list.php");
                                 break;
                              case "bmps_item":
                                 include("modules/bmps/bmps_item.php");
                                 break;
                              case "responsibility":
                                 include("modules/responsibility/responsibility_list.php");
                                 break;
                              case "responsibility_item":
                                 include("modules/responsibility/responsibility_item.php");
                                 break;
                              case "soils":
                                 include("modules/soils/soils_list.php");
                                 break;
                              case "soils_item":
                                 include("modules/soils/soils_item.php");
                                 break;


                              /* SWPPPS */
                                 /* Batch Planets */
                                 case "bp_DATA_BASE_AUSTIN_BRIDGE":
                                    include("modules/batch_plants/bp_DATA_BASE_AUSTIN_BRIDGE_list.php");
                                    break;
                                 case "bp_DATA_BASE_AUSTIN_BRIDGE_item":
                                    include("modules/batch_plants/bp_DATA_BASE_AUSTIN_BRIDGE_item.php");
                                    break;
                                 case "bp_DATA_BASE_GILCO":
                                    include("modules/batch_plants/bp_DATA_BASE_GILCO_list.php");
                                    break;
                                 case "bp_DATA_BASE_GILCO_item":
                                    include("modules/batch_plants/bp_DATA_BASE_GILCO_item.php");
                                    break;
                                 case "bp_DATA_BASE_LACY":
                                    include("modules/batch_plants/bp_DATA_BASE_LACY_list.php");
                                    break;
                                 case "bp_DATA_BASE_LACY_item":
                                    include("modules/batch_plants/bp_DATA_BASE_LACY_item.php");
                                    break;
                                 case "bp_DATABASE_OSBURN_CONTRACTORS":
                                    include("modules/batch_plants/bp_DATABASE_OSBURN_CONTRACTORS_list.php");
                                    break;
                                 case "bp_DATABASE_OSBURN_CONTRACTORS_item":
                                    include("modules/batch_plants/bp_DATABASE_OSBURN_CONTRACTORS_item.php");
                                    break;

                                 /* Electric */
                                 case "elec_CPS_Electric":
                                    include("modules/electric/elec_CPS_Electric_list.php");
                                    break;
                                 case "elec_CPS_Electric_item":
                                    include("modules/electric/elec_CPS_Electric_item.php");
                                    break;
                                 case "elec_Coserv_Elec":
                                    include("modules/electric/elec_Coserv_Elec_list.php");
                                    break;
                                 case "elec_Coserv_Elec_item":
                                    include("modules/electric/elec_Coserv_Elec_item.php");
                                    break;

                                 /* Gas */
                                 case "gas_CPS_GAS":
                                    include("modules/gas/gas_CPS_GAS_list.php");
                                    break;
                                 case "gas_CPS_GAS_item":
                                    include("modules/gas/gas_CPS_GAS_item.php");
                                    break;
                                 case "gas_COSERV_GAS":
                                    include("modules/gas/gas_COSERV_GAS_list.php");
                                    break;
                                 case "gas_COSERV_GAS_item":
                                    include("modules/gas/gas_COSERV_GAS_item.php");
                                    break;
                                 case "gas_DATA_BASE_ATMOS":
                                    include("modules/gas/gas_DATA_BASE_ATMOS_list.php");
                                    break;
                                 case "gas_DATA_BASE_ATMOS_item":
                                    include("modules/gas/gas_DATA_BASE_ATMOS_item.php");
                                    break;

                                 /* General Contracting */
                                 case "gc_2013_DATA_BASE_GC_CIVIL":
                                    include("modules/general_contracting/gc_2013_DATA_BASE_GC_CIVIL_list.php");
                                    break;
                                 case "gc_2013_DATA_BASE_GC_CIVIL_item":
                                    include("modules/general_contracting/gc_2013_DATA_BASE_GC_CIVIL_item.php");
                                    break;
                                 case "gc_2013_DATA_BASE_GC_Vertical":
                                    include("modules/general_contracting/gc_2013_DATA_BASE_GC_Vertical_list.php");
                                    break;
                                 case "gc_2013_DATA_BASE_GC_Vertical_item":
                                    include("modules/general_contracting/gc_2013_DATA_BASE_GC_Vertical_item.php");
                                    break;

                                 /* Home Building */
                                 case "hb_2013_DATA_BASE_KB":
                                    include("modules/home_building/hb_2013_DATA_BASE_KB_list.php");
                                    break;
                                 case "hb_2013_DATA_BASE_KB_item":
                                    include("modules/home_building/hb_2013_DATA_BASE_KB_item.php");
                                    break;
                                 case "hb_Beazer_HB":
                                    include("modules/home_building/hb_Beazer_HB_list.php");
                                    break;
                                 case "hb_Beazer_HB_item":
                                    include("modules/home_building/hb_Beazer_HB_item.php");
                                    break;
                                 case "hb_CAMBRIDGE_DATABASE_HOMEBUILDER":
                                    include("modules/home_building/hb_CAMBRIDGE_DATABASE_HOMEBUILDER_list.php");
                                    break;
                                 case "hb_CAMBRIDGE_DATABASE_HOMEBUILDER_item":
                                    include("modules/home_building/hb_CAMBRIDGE_DATABASE_HOMEBUILDER_item.php");
                                    break;
                                 case "hb_HB_Drees":
                                    include("modules/home_building/hb_HB_Drees_list.php");
                                    break;
                                 case "hb_HB_Drees_item":
                                    include("modules/home_building/hb_HB_Drees_item.php");
                                    break;
                                 case "hb_HB_HGC":
                                    include("modules/home_building/hb_HB_HGC_list.php");
                                    break;
                                 case "hb_HB_HGC_item":
                                    include("modules/home_building/hb_HB_HGC_item.php");
                                    break;
                                 case "hb_HB_MERITAGE":
                                    include("modules/home_building/hb_HB_MERITAGE_list.php");
                                    break;
                                 case "hb_HB_MERITAGE_item":
                                    include("modules/home_building/hb_HB_MERITAGE_item.php");
                                    break;
                                 case "hb_LENNAR_HB":
                                    include("modules/home_building/hb_LENNAR_HB_list.php");
                                    break;
                                 case "hb_LENNAR_HB_item":
                                    include("modules/home_building/hb_LENNAR_HB_item.php");
                                    break;

                                 /* Land Development */
                                 case "ld_2013_DATA_BASE_DREES_AUSTIN":
                                    include("modules/land_development/ld_2013_DATA_BASE_DREES_AUSTIN_list.php");
                                    break;
                                 case "ld_2013_DATA_BASE_DREES_AUSTIN_item":
                                    include("modules/land_development/ld_2013_DATA_BASE_DREES_AUSTIN_item.php");
                                    break;
                                 case "ld_2013_DATA_BASE_DREES_DALLAS":
                                    include("modules/land_development/ld_2013_DATA_BASE_DREES_DALLAS_list.php");
                                    break;
                                 case "ld_2013_DATA_BASE_DREES_DALLAS_item":
                                    include("modules/land_development/ld_2013_DATA_BASE_DREES_DALLAS_item.php");
                                    break;
                                 case "ld_2013_DATA_BASE_LD":
                                    include("modules/land_development/ld_2013_DATA_BASE_LD_list.php");
                                    break;
                                 case "ld_2013_DATA_BASE_LD_item":
                                    include("modules/land_development/ld_2013_DATA_BASE_LD_item.php");
                                    break;
                                 case "ld_LD_Beazer":
                                    include("modules/land_development/ld_LD_Beazer_list.php");
                                    break;
                                 case "ld_LD_Beazer_item":
                                    include("modules/land_development/ld_LD_Beazer_item.php");
                                    break;
                                 case "ld_Lennar_LD":
                                    include("modules/land_development/ld_Lennar_LD_list.php");
                                    break;
                                 case "ld_Lennar_LD_item":
                                    include("modules/land_development/ld_Lennar_LD_item.php");
                                    break;

                              /* PROJECTS */
                              case "projects":
                                 include("modules/projects/projects_list.php");
                                 break;
                              case "projects_item":
                                 include("modules/projects/projects_item.php");
                                 break;
                              case "electric":
                                 include("modules/electric/electric_item.php");
                                 break;
                              case "batch_plants":
                                 include("modules/batch_plants/batch_plant_item.php");
                                 break;
                              case "gas":
                                 include("modules/gas/gas_item.php");
                                 break;
                              case "gen_contracting":
                                 include("modules/general_contracting/general_contracting_item.php");
                                 break;
                              case "home_building":
                                 include("modules/home_building/home_building_item.php");
                                 break;
                              case "land_development":
                                 include("modules/land_development/land_development_item.php");
                                 break;


                              /* MANAGEMENT */
                              case "user_management":
                                 include("modules/user_management/users.php");
                                 break;
                              case "user_management_item":
                                 include("modules/user_management/user_editor.php");
                                 break;
                              case "update_requests":
                                 include("modules/update_requests/update_requests.php");
                                 break;
                              case "documents":
                                 include("documents.php");
                                 break;

                              default:
                                 include("home.php");
                           }
                        }
                        ?>
                  </article><!-- #post -->
               </div><!-- #content -->
            </div><!-- #primary -->
         </div><!-- #main .wrapper -->

         <footer id="footer" role="contentinfo">
            <div class="site-info">
                        Designed by NK Computer Solutions and based off the TwentyTwelve template by <a class="wp" href="http://wordpress.org/" title="Semantic Personal Publishing Platform">WordPress</a>
            </div><!-- .site-info -->
         </footer><!-- #colophon -->
      </div><!-- #page -->
   </body>
</html>
