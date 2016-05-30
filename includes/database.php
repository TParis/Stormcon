<?php

require_once("config.php");

if (!defined("__INSYS__")) {
   die("Error: Malformed Request");
}

try{
    $dbh = new PDO( "sqlsrv:Server= $server ; Database = $db ", $user, $pwd);
    $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
}
catch(Exception $e){
    die(print_r($e));
}
