<?php

require_once("core.php");

if (!defined("__INSYS__")) {
   die("Error: Malformed Request");
}

function generateColumnName($column_name) {

   $column_name = str_replace(" ", "", $column_name);
   $column_name = str_replace("#", "", $column_name);
   $column_name = str_replace("/", "", $column_name);
   $column_name = str_replace("(", "", $column_name);
   $column_name = str_replace(")", "", $column_name);
   $column_name = str_replace("_", "", $column_name);
   $column_name = str_replace(".", "", $column_name);
   $column_name = str_replace("%", "", $column_name);
   $column_name = str_replace("-", "", $column_name);

   $column_name = strtolower($column_name);

   return $column_name;

}

function redirect_to($redirect_url) {

   $template = file_get_contents("templates/redirect_script.tpl");

   $template = str_replace("{{redirect_to}}", $redirect_url, $template);

   return $template;

}

function limit_string($str, $num) {

   if (strlen($str) < ($num - 3)) {
      return $str;
   } else {
      return substr($str, 0, $num - 3) . "...";
   }
}

function LogActivity($username, $action, $additionalinfo = "none") {
  global $sys;

  $errormsg = Array();
  $successmsg = Array();

  include("lang.php");

  if(strlen($username) == 0) { $username = "GUEST"; }
  elseif(strlen($username) < 3) { $errormsg[] = $lang[$sys->loc]['auth']['logactivity_username_short']; return false; }
  elseif(strlen($username) > 30) { $errormsg[] = $lang[$sys->loc]['auth']['logactivity_username_long']; return false; }

  if(strlen($action) == 0) { $errormsg[] = $lang[$sys->loc]['auth']['logactivity_action_empty']; return false; }
  elseif(strlen($action) < 3) { $errormsg[] = $lang[$sys->loc]['auth']['logactivity_action_short']; return false; }
  elseif(strlen($action) > 100) { $errormsg[] = $lang[$sys->loc]['auth']['logactivity_action_long']; return false; }

  if(strlen($additionalinfo) == 0) { $additionalinfo = "none"; }
  elseif(strlen($additionalinfo) > 500) { $errormsg[] = $lang[$sys->loc]['auth']['logactivity_addinfo_long']; return false; }

  if(count($errormsg) == 0)
  {
      $ip = $_SERVER['REMOTE_ADDR'];
      $date = date("Y-m-d H:i:s");

      $query = $sys->db()->prepare("INSERT INTO activitylog (date, username, action, additionalinfo, ip) VALUES (:date, :username, :action, :additionalinfo, :ip)");
      $query->bindParam(":date", $date);
      $query->bindParam(":username", $username);
      $query->bindParam(":action", $action);
      $query->bindParam(":additionalinfo", $additionalinfo);
      $query->bindParam(":ip", $ip);
      $query->execute();


      return true;
  }
}

function emailAddy($email) {
   return "<a href=\"mailto:" . $email . "\">" . $email . "</a>";
}

function debug($string) {
	global $sys;
	
	if (core::$DEBUG === TRUE) {
		echo $string;
	}
}

function getQOTD() {
	$url = "https://www.quotesdaddy.com/feed";
	
	$rss = new DOMDocument();
	$rss->load($url);

	$node = $rss->getElementsByTagName('item')->item(0);
	$item = array ( 
			'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
			'desc' => $node->getElementsByTagName('description')->item(0)->nodeValue,
			'link' => $node->getElementsByTagName('link')->item(0)->nodeValue,
			'date' => $node->getElementsByTagName('pubDate')->item(0)->nodeValue,
	);
	
	echo "<center>" . $item['desc'] . "</center>";
}