<?php

if (!defined("__INSYS__")) {
   die("Error: Malformed Request");
}

if (!ISSET($_GET['action']) || $_GET['action'] != "login") {
   require("templates/login_page.tpl");
} else {
   require_once("includes/auth.php");

   $auth = new auth();

   if ($auth->login($_POST['username'], $_POST['password'])) {

   ?>
      <script language="javascript" type="text/javascript">

      window.location = "index.php";

      </script>
   <?php
   } else {
      echo "<center>" . $auth->errormsg[0] . "<br>" . $auth->errormsg[1] . "</center><br>";
      require("templates/login_page.tpl");
   }
}
