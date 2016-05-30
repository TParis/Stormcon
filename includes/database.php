<?php

require_once("config.php");
require_once("core.php");

if (!defined("__INSYS__")) {
   die("Error: Malformed Request");
}

try{
    $dbh = new PDO( "sqlsrv:Server= $server ; Database = $db ", $user, $pwd);
    $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
}
catch(Exception $e){
	if (CORE::$DEBUG) {
	    die(print_r($e));
	} else {
		die("ERROR CONNECTING TO DATABASE");
	}
}
