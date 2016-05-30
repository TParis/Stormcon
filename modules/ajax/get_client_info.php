<?php

//die("In Development: Protecting data");

         //Database Connection
         $server = "tcp:r25fq9eyjb.database.windows.net,1433";
         $user = "Stormcon";
         $pwd = "Stormwater123";
         $db = "2013 DATA BASE LD";

         try{
             $dbh = new PDO( "sqlsrv:Server= $server ; Database = $db ", $user, $pwd);
             $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
         }
         catch(Exception $e){
             die(print_r($e));
         }

         //Get Requests
         $contact_id    = (is_numeric($_GET['id'])) ? $_GET['id'] : false;

         //SQL Injection Prevention
         if (!$contact_id) {
            die("Error: Malformed Request");
         }

         //SQL Statement
         $stmt = $dbh->prepare("SELECT * FROM [dbo].[Contact] WHERE ID = :contact_id;");
         $stmt->bindParam(":contact_id", $contact_id);

         $stmt->execute();

         $results = $stmt->fetch();

         echo json_encode($results);
?>
