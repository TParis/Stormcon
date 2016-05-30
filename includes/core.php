<?php

require_once("auth.php");
require_once("config.php");
require_once("database.php");

if (!defined("__INSYS__")) {
   die("Error: Malformed Request");
}

/*
Class: Core
*/
class core {

   private $dbh;
   private $auth;
   public $site_name;
   public $email_from;
   public $base_url;
   public $auth_conf;
   public $loc;
   public $mail;

   public function __construct($dbh) {

      session_start();

      global $site_name;
      global $email_from;
      global $loc;
      global $base_url;
      global $auth_conf;

      $this->dbh        = $dbh;


      $this->site_name  =  $site_name;
      $this->email_from =  $email_from;
      $this->loc        =  $loc;
      $this->base_url   =  $base_url;
      $this->auth_conf  =  $auth_conf;
	  
	  
	  
	  $this->mail		= array(
				"user"	=> "azure_9bf4550c87e9fd06f10e6804e9572f37@azure.com",
				"pass"	=> "TXL5G3e40bHqwhF",
				"api"	=> "https://api.sendgrid.com/");
   }

   public function db() {
      return $this->dbh;
   }

   public function auth() {
      return $this->auth;
   }
   public function set_auth($objUser, $PHPSESID) {

         global $admins;

         $arrAdmins = explode(",", $admins);

         $this->auth       = (object) array(
               "user_id"         => $objUser['uid'],
               "user_name"       => $objUser['username'],
               "session_hash"    => $PHPSESID,
               "user_expire"     => $objUser['expiredate'],
               "user_ip"         => $objUser['ip'],
               "user_admin"      => (in_array($objUser['uid'], $arrAdmins)) ? true : false,
         );
   }

}
