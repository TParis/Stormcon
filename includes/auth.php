<?php

require_once("core.php");
require_once("mail.php");

if (!defined("__INSYS__")) {
   die("Error: Malformed Request");
}

class auth {

   public $errormsg;
   public $successmsg;

   public function __construct() {
      global $sys;

   }

   public function logout_auth() {
   }

   private function encrypt_pass() {
   }

   private function check_session() {
   }

   private function bad_login() {
   }

   private function good_login() {
   }

   private function login_screen() {
   }

   public function login_state() {

      global $sys;

      if (ISSET($sys->auth()->session_hash)
            && $this->checksession($sys->auth()->session_hash)
            && ISSET($sys->auth()->user_id)
            && $sys->auth()->user_id > 0) {
         return true;
      } else {
         return false;
      }
   }

   function activate() {
      $a = func_get_args();
      $i = func_num_args();
      if (method_exists($this,$f='activate'.$i)) {
          call_user_func_array(array($this,$f),$a);
      }
   }

   function activate1($user_id) {

      global $sys;

      $stmt = $sys->db()->prepare("UPDATE users SET user_active = 1 WHERE user_id = :user_id;");

      $stmt->bindParam(":user_id", $user_id);

      $stmt->execute();

   }

   function deactivate($user_id) {

      global $sys;

      if ($sys->auth()->user_id != $user_id) {

         $stmt = $sys->db()->prepare("UPDATE users SET user_active = 0 WHERE user_id = :user_id;");

         $stmt->bindParam(":user_id", $user_id);

         $stmt->execute();

      }

   }

    /*
    * Log user in via MSSQL Database
    * @param string $username
    * @param string $password
    * @return boolean
    */

    function login($username, $password)
    {
        global $sys;
        include("lang.php");

        if(!isset($_COOKIE["auth_session"]))
        {
            $attcount = $this->getattempt($_SERVER['REMOTE_ADDR']);

            if($attcount >= $sys->auth_conf['max_attempts'])
            {
                $this->errormsg[] = $lang[$sys->loc]['auth']['login_lockedout'];
                $this->errormsg[] = $lang[$sys->loc]['auth']['login_wait30'];

                return false;
            }
            else
            {
                // Input verification :

                if(strlen($username) == 0) { $this->errormsg[] = $lang[$sys->loc]['auth']['login_username_empty']; return false; }
                elseif(strlen($username) > 30) { $this->errormsg[] = $lang[$sys->loc]['auth']['login_username_long']; return false; }
                elseif(strlen($username) < 3) { $this->errormsg[] = $lang[$sys->loc]['auth']['login_username_short']; return false; }
                elseif(strlen($password) == 0) { $this->errormsg[] = $lang[$sys->loc]['auth']['login_password_empty']; return false; }
                elseif(strlen($password) > 30) { $this->errormsg[] = $lang[$sys->loc]['auth']['login_password_short']; return false; }
                elseif(strlen($password) < 5) { $this->errormsg[] = $lang[$sys->loc]['auth']['login_password_long']; return false; }
                else
                {
                    // Input is valid

                    $password = $this->hashpass($password);

                    $query = $sys->db()->prepare("SELECT user_active FROM users WHERE username = :username AND user_password = :password", array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
                    $query->bindParam(":username", $username);
                    $query->bindParam(":password", $password);
                    $query->execute();

                    $count = $query->rowCount();


                    if($count == 0)
                    {
                        // Username and / or password are incorrect

                        $this->errormsg[] = $lang[$sys->loc]['auth']['login_incorrect'];

                        $this->addattempt($_SERVER['REMOTE_ADDR']);

                        $attcount = $attcount + 1;
                        $remaincount = $sys->auth_conf['max_attempts'] - $attcount;

                        $this->LogActivity("UNKNOWN", "AUTH_LOGIN_FAIL", "Username / Password incorrect - {$username} / {$password}");

                        $this->errormsg[] = sprintf($lang[$sys->loc]['auth']['login_attempts_remaining'], $remaincount);

                        return false;
                    }
                    else
                    {
                        // Username and password are correct

                        $isactive = current($query->fetch());

                        if($isactive == "0")
                        {
                            // Account is not activated

                            $this->LogActivity($username, "AUTH_LOGIN_FAIL", "Account inactive");

                            $this->errormsg[] = $lang[$sys->loc]['auth']['login_account_inactive'];

                            return false;
                        }
                        else
                        {
                            // Account is activated

                            $this->newsession($username);

                            $this->LogActivity($username, "AUTH_LOGIN_SUCCESS", "User logged in");

                            $this->successmsg[] = $lang[$sys->loc]['auth']['login_success'];

                            return true;
                        }
                    }


                }
            }
        }
        else
        {
            // User is already logged in

            $this->errormsg[] = $lang[$sys->loc]['auth']['login_already'];

            return false;
        }
    }

    /*
    * Register a new user into the database
    * @param string $username
    * @param string $password
    * @param string $verifypassword
    * @param string $email
    * @return boolean
    */

    function register($username, $password, $verifypassword, $email)
    {
        global $sys;
        include("lang.php");


            // Input Verification :

            if(strlen($username) == 0) { $this->errormsg[] = $lang[$sys->loc]['auth']['register_username_empty']; }
            elseif(strlen($username) > 30) { $this->errormsg[] = $lang[$sys->loc]['auth']['register_username_long']; }
            elseif(strlen($username) < 3) { $this->errormsg[] = $lang[$sys->loc]['auth']['register_username_short']; }
            if(strlen($password) == 0) { $this->errormsg[] = $lang[$sys->loc]['auth']['register_password_empty']; }
            elseif(strlen($password) > 30) { $this->errormsg[] = $lang[$sys->loc]['auth']['register_password_long']; }
            elseif(strlen($password) < 5) { $this->errormsg[] = $lang[$sys->loc]['auth']['register_password_short']; }
            elseif($password !== $verifypassword) { $this->errormsg[] = $lang[$sys->loc]['auth']['register_password_nomatch']; }
            elseif(strstr($password, $username)) { $this->errormsg[] = $lang[$sys->loc]['auth']['register_password_username']; }
            if(strlen($email) == 0) { $this->errormsg[] = $lang[$sys->loc]['auth']['register_email_empty']; }
            elseif(strlen($email) > 100) { $this->errormsg[] = $lang[$sys->loc]['auth']['register_email_long']; }
            elseif(strlen($email) < 5) { $this->errormsg[] = $lang[$sys->loc]['auth']['register_email_short']; }
            elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) { $this->errormsg[] = $lang[$sys->loc]['auth']['register_email_invalid']; }

            if(count($this->errormsg) == 0)
            {
                // Input is valid

                $query = $sys->db()->prepare("SELECT * FROM users WHERE username = :username", array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
                $query->bindParam(":username", $username);
                $query->execute();
                $count = $query->rowCount();


                if($count != 0)
                {
                    // Username already exists

                    $this->LogActivity("UNKNOWN", "AUTH_REGISTER_FAIL", "Username ({$username}) already exists");

                    $this->errormsg[] = $lang[$sys->loc]['auth']['register_username_exist'];

                    return false;
                }
                else
                {
                    // Username is not taken

                    $query = $sys->db()->prepare("SELECT * FROM users WHERE user_email= :email", array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
                    $query->bindParam(":email", $email);
                    $query->execute();
                    $count = $query->rowCount();
                    $query->closeCursor();

                    if($count != 0)
                    {
                        // Email address is already used

                        $this->LogActivity("UNKNOWN", "AUTH_REGISTER_FAIL", "Email ({$email}) already exists");

                        $this->errormsg[] = $lang[$sys->loc]['auth']['register_email_exist'];

                        return false;
                    }
                    else
                    {
                        // Email address isn't already used

                        $unhashed = $password;
                        $password = $this->hashpass($password);
                        $activekey = $this->randomkey(15);

                        $query = $sys->db()->prepare("INSERT INTO users (username, user_password, user_full_name, user_email, user_active, user_activekey) VALUES (:username, :password, ' ', :email, 0, :active_key)");
                        $query->bindParam(":username", $username);
                        $query->bindParam(":password", $password);
                        $query->bindParam(":email", $email);
                        $query->bindParam(":active_key", $activekey);
                        $query->execute();


                        $message_subj = $sys->site_name . " - Account activation required !";
                        $message_cont = "Hello {$username}<br/><br/>";
                        $message_cont .= "You recently registered a new account on " . $sys->site_name . "<br/>";
                        $message_cont .= "Username: " . $username . "<br/>";
                        $message_cont .= "Password: " . $unhashed . "<br/>";
                        $message_cont .= "To activate your account please click the following link<br/><br/>";
                        $message_cont .= "<b><a href=\"" . $sys->base_url . "?page=activate&username={$username}&key={$activekey}\">Activate my account</a></b>";

                        sendEmail($email, $message_subj, $message_cont, $message_cont);

                        $this->LogActivity($username, "AUTH_REGISTER_SUCCESS", "Account created and activation email sent");

                        $this->successmsg[] = $lang[$sys->loc]['auth']['register_success'];

                        return true;
                    }
                }
            }
            else
            {
                return false;
            }
    }

    /*
    * Creates a new session for the provided username and sets cookie
    * @param string $username
    */

    function newsession($username)
    {
        global $sys;

        $hash = md5(microtime());

        // Fetch User ID :

        $query = $sys->db()->prepare("SELECT user_id FROM users WHERE username = :username");
        $query->bindParam(":username", $username);
        $query->execute();
        $uid = current($query->fetch());


        // Delete all previous sessions :

        $query = $sys->db()->prepare("DELETE FROM sessions WHERE username = :username");
        $query->bindParam(":username", $username);
        $query->execute();


        $ip = $_SERVER['REMOTE_ADDR'];
        $expiredate = date("Y-m-d H:i:s", strtotime($sys->auth_conf['session_duration']));
        $expiretime = strtotime($expiredate);

        $query = $sys->db()->prepare("INSERT INTO sessions (uid, username, hash, expiredate, ip) VALUES (:user_id, :username, :hash, :expiredate, :ip)");
        $query->bindParam(":user_id", $uid);
        $query->bindParam(":username", $username);
        $query->bindParam(":hash", $hash);
        $query->bindParam(":expiredate", $expiredate);
        $query->bindParam(":ip", $ip);
        $query->execute();


        setcookie("auth_session", $hash, $expiretime);
    }

    /*
    * Deletes the user's session based on hash
    * @param string $hash
    */

    function deletesession($hash)
    {
        global $sys;
        include("lang.php");

        $query = $sys->db()->prepare("SELECT username FROM sessions WHERE hash = :hash", array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        $query->bindParam(":hash", $hash);
        $query->execute();
        $count = $query->rowCount();

        if($count == 0)
        {
            // Hash doesn't exist

            $this->LogActivity("UNKNOWN", "AUTH_LOGOUT", "User session cookie deleted - Database session not deleted - Hash ({$hash}) didn't exist");

            $this->errormsg[] = $lang[$sys->loc]['auth']['deletesession_invalid'];

            setcookie("auth_session", $hash, time() - 3600);
        }
        else
        {
            // Hash exists, Delete all sessions for that username :

            $username = current($query->fetch());

            $query = $sys->db()->prepare("DELETE FROM sessions WHERE username = :username");
            $query->bindParam(":username", $username);
            $query->execute();


            $this->LogActivity($username, "AUTH_LOGOUT", "User session cookie deleted - Database session deleted - Hash ({$hash})");

            setcookie("auth_session", $hash, time() - 3600);
        }


    }

    /*
    * Provides an associative array of user info based on session hash
    * @param string $hash
    * @return array $session
    */

    function sessioninfo($hash)
    {
        global $sys;
        include("lang.php");

        $query = $sys->db()->prepare("SELECT uid, username, expiredate, ip FROM sessions WHERE hash = :hash", array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        $query->bindParam(":hash", $hash);
        $query->execute();
        $count = $query->rowCount();

        if($count == 0)
        {
            // Hash doesn't exist

            $this->errormsg[] = $lang[$sys->loc]['auth']['sessioninfo_invalid'];

            setcookie("auth_session", $hash, time() - 3600);

            return false;
        }
        else
        {

            $session = $query->fetch();
            // Hash exists

            return $session;
        }


    }

    /*
    * Checks if session is valid (Current IP = Stored IP + Current date < expire date)
    * @param string $hash
    * @return bool
    */

    function checksession($hash)
    {
        global $sys;

        $query = $sys->db()->prepare("SELECT username, expiredate, ip FROM sessions WHERE hash = :hash", array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        $query->bindParam(":hash", $hash);
        $query->execute();
        $count = $query->rowCount();
        list($username, $db_expiredate, $db_ip) = $query->fetch();


        if($count == 0)
        {
            // Hash doesn't exist

            setcookie("auth_session", $hash, time() - 3600);

            $this->LogActivity($username, "AUTH_CHECKSESSION", "User session cookie deleted - Hash ({$hash}) didn't exist");

            return false;
        }
        else
        {
            if($_SERVER['REMOTE_ADDR'] != $db_ip)
            {
                // Hash exists, but IP has changed

                $query = $sys->db()->prepare("DELETE FROM sessions WHERE username = :username;");
                $query->bindParam(":username", $username);
                $query->execute();


                setcookie("auth_session", $hash, time() - 3600);

                $this->LogActivity($username, "AUTH_CHECKSESSION", "User session cookie deleted - IP Different ( DB : {$db_ip} / Current : " . $_SERVER['REMOTE_ADDR'] . " )");

                return false;
            }
            else
            {
                $expiredate = strtotime($db_expiredate);
                $currentdate = strtotime(date("Y-m-d H:i:s"));

                if($currentdate > $expiredate)
                {
                    // Hash exists, IP is the same, but session has expired

                    $query = $sys->db()->prepare("DELETE FROM sessions WHERE username = :username;");
                    $query->bindParam(":username", $username);
                    $query->execute();


                    setcookie("auth_session", $hash, time() - 3600);

                    $this->LogActivity($username, "AUTH_CHECKSESSION", "User session cookie deleted - Session expired ( Expire date : {$db_expiredate} )");

                    return false;
                }
                else
                {
                    // Hash exists, IP is the same, date < expiry date

                    return true;
                }
            }
        }
    }

    /*
    * Returns a random string, length can be modified
    * @param int $length
    * @return string $key
    */

    function randomkey($length = 10)
    {
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
        $key = "";

        for($i = 0; $i < $length; $i++)
        {
            $key .= $chars{rand(0, strlen($chars) - 1)};
        }

        return $key;
    }

    /*
    * Activate a user's account
    * @param string $username
    * @param string $key
    * @return boolean
    */

    function activate2($username, $key)
    {
        global $sys;
        include("lang.php");

        // Input verification

        if(strlen($username) == 0) { $this->errormsg[] = $lang[$sys->loc]['auth']['activate_username_empty']; return false; }
        elseif(strlen($username) > 30) { $this->errormsg[] = $lang[$sys->loc]['auth']['activate_username_long']; return false; }
        elseif(strlen($username) < 3) { $this->errormsg[] = $lang[$sys->loc]['auth']['activate_username_short']; return false; }
        elseif(strlen($key) == 0) { $this->errormsg[] = $lang[$sys->loc]['auth']['activate_key_empty']; return false; }
        elseif(strlen($key) > 15) { $this->errormsg[] = $lang[$sys->loc]['auth']['activate_key_long']; return false; }
        elseif(strlen($key) < 15) { $this->errormsg[] = $lang[$sys->loc]['auth']['activate_key_short']; return false; }
        else
        {
            // Input is valid

            $query = $sys->db()->prepare("SELECT user_active, user_activekey FROM users WHERE username = :username;", array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
            $query->bindParam(":username", $username);
            $query->execute();
            $count = $query->rowCount();
            list($isactive, $activekey) = $query->fetch();


            if($count == 0)
            {
                // User doesn't exist

                $this->LogActivity("UNKNOWN", "AUTH_ACTIVATE_FAIL", "Username Incorrect : {$username}");

                $this->errormsg[] = $lang[$sys->loc]['auth']['activate_username_incorrect'];

                return false;
            }
            else
            {
                // User exists

                if($isactive == 1)
                {
                    // Account is already activated

                    $this->LogActivity($username, "AUTH_ACTIVATE_FAIL", "Account already activated");

                    $this->errormsg[] = $lang[$sys->loc]['auth']['activate_account_activated'];

                    return true;
                }
                else
                {
                    // Account isn't activated

                    if($key == $activekey)
                    {
                        // Activation keys match

                        $new_isactive = 1;
                        $new_activekey = "0";

                        $query = $sys->db()->prepare("UPDATE users SET user_active = :isactive, user_activekey = :activekey WHERE username = :username;");
                        $query->bindParam(":isactive", $new_isactive);
                        $query->bindParam(":activekey", $new_activekey);
                        $query->bindParam(":username", $username);
                        $query->execute();


                        $this->LogActivity($username, "AUTH_ACTIVATE_SUCCESS", "Activation successful. Key Entry deleted.");

                        $this->successmsg[] = $lang[$sys->loc]['auth']['activate_success'];

                        return true;
                    }
                    else
                    {
                        // Activation Keys don't match

                        $this->LogActivity($username, "AUTH_ACTIVATE_FAIL", "Activation keys don't match ( DB : {$activekey} / Given : {$key} )");

                        $this->errormsg[] = $lang[$sys->loc]['auth']['activate_key_incorrect'];

                        return false;
                    }
                }
            }
        }
    }

    /*
    * Changes a user's password, providing the current password is known
    * @param string $username
    * @param string $currpass
    * @param string $newpass
    * @param string $verifynewpass
    * @return boolean
    */

    function changepass($username, $currpass, $newpass, $verifynewpass)
    {
        global $sys;
        include("lang.php");

        if(strlen($username) == 0) { $this->errormsg[] = $lang[$sys->loc]['auth']['changepass_username_empty']; }
        elseif(strlen($username) > 30) { $this->errormsg[] = $lang[$sys->loc]['auth']['changepass_username_long']; }
        elseif(strlen($username) < 3) { $this->errormsg[] = $lang[$sys->loc]['auth']['changepass_username_short']; }
        if(strlen($currpass) == 0) { $this->errormsg[] = $lang[$sys->loc]['auth']['changepass_currpass_empty']; }
        elseif(strlen($currpass) < 5) { $this->errormsg[] = $lang[$sys->loc]['auth']['changepass_currpass_short']; }
        elseif(strlen($currpass) > 30) { $this->errormsg[] = $lang[$sys->loc]['auth']['changepass_currpass_long']; }
        if(strlen($newpass) == 0) { $this->errormsg[] = $lang[$sys->loc]['auth']['changepass_newpass_empty']; }
        elseif(strlen($newpass) < 5) { $this->errormsg[] = $lang[$sys->loc]['auth']['changepass_newpass_short']; }
        elseif(strlen($newpass) > 30) { $this->errormsg[] = $lang[$sys->loc]['auth']['changepass_newpass_long']; }
        elseif(strstr($newpass, $username)) { $this->errormsg[] = $lang[$sys->loc]['auth']['changepass_password_username']; }
        elseif($newpass !== $verifynewpass) { $this->errormsg[] = $lang[$sys->loc]['auth']['changepass_password_nomatch']; }

        if(count($this->errormsg) == 0)
        {
            $currpass = $this->hashpass($currpass);
            $newpass = $this->hashpass($newpass);

            $query = $sys->db()->prepare("SELECT user_password FROM users WHERE username = :username", array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
            $query->bindParam(":username", $username);
            $query->execute();
            $count = $query->rowCount();

            if($count == 0)
            {
                $this->LogActivity("UNKNOWN", "AUTH_CHANGEPASS_FAIL", "Username Incorrect ({$username})");

                $this->errormsg[] = $lang[$sys->loc]['auth']['changepass_username_incorrect'];

                return false;
            }
            else
            {
                $db_currpass = current($query->fetch());

                if($currpass == $db_currpass)
                {
                    $query = $sys->db()->prepare("UPDATE users SET user_password = :user_password WHERE username = :username");
                    $query->bindParam(":user_password", $newpass);
                    $query->bindParam(":username", $username);
                    $query->execute();


                    $this->LogActivity($username, "AUTH_CHANGEPASS_SUCCESS", "Password changed");

                    $this->successmsg[] = $lang[$sys->loc]['auth']['changepass_success'];

                    return true;
                }
                else
                {
                    $this->LogActivity($username, "AUTH_CHANGEPASS_FAIL", "Current Password Incorrect ( DB : {$db_currpass} / Given : {$currpass} )");

                    $this->errormsg[] = $lang[$sys->loc]['auth']['changepass_currpass_incorrect'];

                    return false;
                }
            }


        }
        else
        {
            return false;
        }
    }

    /*
    * Changes the stored email address based on username
    * @param string $username
    * @param string $email
    * @return boolean
    */

    function changeemail($username, $email)
    {
        global $sys;
        include("lang.php");

        if(strlen($username) == 0) { $this->errormsg[] = $lang[$sys->loc]['auth']['changeemail_username_empty']; }
        elseif(strlen($username) > 30) { $this->errormsg[] = $lang[$sys->loc]['auth']['changeemail_username_long']; }
        elseif(strlen($username) < 3) { $this->errormsg[] = $lang[$sys->loc]['auth']['changeemail_username_short']; }
        if(strlen($email) == 0) { $this->errormsg[] = $lang[$sys->loc]['auth']['changeemail_email_empty']; }
        elseif(strlen($email) > 100) { $this->errormsg[] = $lang[$sys->loc]['auth']['changeemail_email_long']; }
        elseif(strlen($email) < 5) { $this->errormsg[] = $lang[$sys->loc]['auth']['changeemail_email_short']; }
        elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) { $this->errormsg[] = $lang[$sys->loc]['auth']['changeemail_email_invalid']; }

        if(count($this->errormsg) == 0)
        {
            $query = $sys->db()->prepare("SELECT user_email FROM users WHERE username = :username", array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
            $query->bindParam(":username", $username);
            $query->execute();
            $count = $query->rowCount();

            if($count == 0)
            {
                $this->LogActivity("UNKNOWN", "AUTH_CHANGEEMAIL_FAIL", "Username Incorrect ({$username})");

                $this->errormsg[] = $lang[$sys->loc]['auth']['changeemail_username_incorrect'];

                return false;
            }
            else
            {
                $db_email = current($query->fetch());

                if($email == $db_email)
                {
                     $this->LogActivity($username, "AUTH_CHANGEEMAIL_FAIL", "Old and new email matched ({$email})");

                    $this->errormsg[] = $lang[$sys->loc]['auth']['changeemail_email_match'];

                    return false;
                }
                else
                {
                    $query = $sys->db()->prepare("UPDATE users SET user_email = :user_email WHERE username = :username");
                    $query->bindParam(":user_email", $email);
                    $query->bindParam(":username", $username);
                    $query->execute();


                    $this->LogActivity($username, "AUTH_CHANGEEMAIL_SUCCESS", "Email changed from {$db_email} to {$email}");

                    $this->successmsg[] = $lang[$sys->loc]['auth']['changeemail_success'];

                    return true;
                }
            }


        }
        else
        {
            return false;
        }
    }

    /*
    * Give the user the ability to change their password if the current password is forgotten
    * by sending email to the email address associated to that user
    * @param string $username
    * @param string $email
    * @param string $key
    * @param string $newpass
    * @param string $verifynewpass
    * @return boolean
    */

    function resetpass($username = '0', $email ='0', $key = '0', $newpass = '0', $verifynewpass = '0')
    {
        global $sys;
        include("lang.php");

        $attcount = $this->getattempt($_SERVER['REMOTE_ADDR']);

        if($attcount >= $sys->auth_conf['max_attempts'])
        {
            $this->errormsg[] = $lang[$sys->loc]['auth']['resetpass_lockedout'];
            $this->errormsg[] = $lang[$sys->loc]['auth']['resetpass_wait30'];

            return false;
        }
        else
        {
            if($username == '0' && $key == '0')
            {
                if(strlen($email) == 0) { $this->errormsg[] = $lang[$sys->loc]['auth']['resetpass_email_empty']; }
                elseif(strlen($email) > 100) { $this->errormsg[] = $lang[$sys->loc]['auth']['resetpass_email_long']; }
                elseif(strlen($email) < 5) { $this->errormsg[] = $lang[$sys->loc]['auth']['resetpass_email_short']; }
                elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) { $this->errormsg[] = $lang[$sys->loc]['auth']['resetpass_email_invalid']; }

                $resetkey = $this->randomkey(15);

                $query = $sys->db()->prepare("SELECT username FROM users WHERE user_email = :user_email", array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
                $query->bindParam(":user_email", $email);
                $query->execute();
                $count = $query->rowCount();

                if($count == 0)
                {
                    $this->errormsg[] = $lang[$sys->loc]['auth']['resetpass_email_incorrect'];

                    $attcount = $attcount + 1;
                    $remaincount = $sys->auth_conf['max_attempts'] - $attcount;

                    $this->LogActivity("UNKNOWN", "AUTH_RESETPASS_FAIL", "Email incorrect ({$email})");

                    $this->errormsg[] = sprintf($lang[$sys->loc]['auth']['resetpass_attempts_remaining'], $remaincount);

                    $this->addattempt($_SERVER['REMOTE_ADDR']);

                    return false;
                }
                else
                {
                    $username = current($query->fetch());

                    $query = $sys->db()->prepare("UPDATE users SET user_resetkey=:resetkey WHERE username=:username");
                    $query->bindParam(":resetkey", $resetkey);
                    $query->bindParam(":username", $username);
                    $query->execute();


                    $message_subj = $sys->site_name . " - Password reset request !";
                    $message_cont = "Hello {$username}<br/><br/>";
                    $message_cont .= "You recently requested a password reset on " . $sys->site_name . "<br/>";
                    $message_cont .= "To proceed with the password reset, please click the following link :<br/><br/>";
                    $message_cont .= "<b><a href=\"" . $sys->base_url . "?page=forgot&username={$username}&key={$resetkey}\">Reset My Password</a></b>";

                    sendEmail($email, $message_subj, $message_cont, $message_cont);

                    $this->LogActivity($username, "AUTH_RESETPASS_SUCCESS", "Reset pass request sent to {$email} ( Key : {$resetkey} )");

                    $this->successmsg[] = $lang[$sys->loc]['auth']['resetpass_email_sent'];

                    return true;
                }


            }
            else
            {
                // Reset Password

                if(strlen($key) == 0) { $this->errormsg[] = $lang[$sys->loc]['auth']['resetpass_key_empty']; }
                elseif(strlen($key) < 15) { $this->errormsg[] = $lang[$sys->loc]['auth']['resetpass_key_short']; }
                elseif(strlen($key) > 15) { $this->errormsg[] = $lang[$sys->loc]['auth']['resetpass_key_long']; }
                if(strlen($newpass) == 0) { $this->errormsg[] = $lang[$sys->loc]['auth']['resetpass_newpass_empty']; }
                elseif(strlen($newpass) > 30) { $this->errormsg[] = $lang[$sys->loc]['auth']['resetpass_newpass_long']; }
                elseif(strlen($newpass) < 5) { $this->errormsg[] = $lang[$sys->loc]['auth']['resetpass_newpass_short']; }
                elseif(strstr($newpass, $username)) { $this->errormsg[] = $lang[$sys->loc]['auth']['resetpass_newpass_username']; }
                elseif($newpass !== $verifynewpass) { $this->errormsg[] = $lang[$sys->loc]['auth']['resetpass_newpass_nomatch']; }

                if(count($this->errormsg) == 0)
                {
                    $query = $sys->db()->prepare("SELECT user_resetkey FROM users WHERE username = :username", array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
                    $query->bindParam(":username", $username);
                    $query->execute();
                    $count = $query->rowCount();

                    if($count == 0)
                    {
                        $this->errormsg[] = $lang[$sys->loc]['auth']['resetpass_username_incorrect'];

                        $attcount = $attcount + 1;
                        $remaincount = $sys->auth_conf['max_attempts'] - $attcount;

                        $this->LogActivity("UNKNOWN", "AUTH_RESETPASS_FAIL", "Username incorrect ({$username})");

                        $this->errormsg[] = sprintf($lang[$sys->loc]['auth']['resetpass_attempts_remaining'], $remaincount);

                        $this->addattempt($_SERVER['REMOTE_ADDR']);

                        return false;
                    }
                    else
                    {
                        $db_key = current($query->fetch());

                        if($key == $db_key)
                        {
                            $newpass = $this->hashpass($newpass);

                            $resetkey = '0';

                            $query = $sys->db()->prepare("UPDATE users SET user_password=:user_password, user_resetkey=:resetkey WHERE username=:username");
                            $query->bindParam(":user_password", $newpass);
                            $query->bindParam(":resetkey", $resetkey);
                            $query->bindParam(":username", $username);
                            $query->execute();


                            $this->LogActivity($username, "AUTH_RESETPASS_SUCCESS", "Password reset - Key reset");

                            $this->successmsg[] = $lang[$sys->loc]['auth']['resetpass_success'];

                            return true;
                        }
                        else
                        {
                            $this->errormsg[] = $lang[$sys->loc]['auth']['resetpass_key_incorrect'];

                            $attcount = $attcount + 1;
                            $remaincount = 5 - $attcount;

                            $this->LogActivity($username, "AUTH_RESETPASS_FAIL", "Key Incorrect ( DB : {$db_key} / Given : {$key} )");

                            $this->errormsg[] = sprintf($lang[$sys->loc]['auth']['resetpass_attempts_remaining'], $remaincount);

                            $this->addattempt($_SERVER['REMOTE_ADDR']);

                            return false;
                        }
                    }


                }
                else
                {
                    return false;
                }
            }
        }
    }

    /*
    * Checks if the reset key is correct for provided username
    * @param string $username
    * @param string $key
    * @return boolean
    */

    function checkresetkey($username, $key)
    {
        global $sys;
        include("lang.php");

        $attcount = $this->getattempt($_SERVER['REMOTE_ADDR']);

        if($attcount >= $sys->auth_conf['max_attempts'])
        {
            $this->errormsg[] = $lang[$sys->loc]['auth']['resetpass_lockedout'];
            $this->errormsg[] = $lang[$sys->loc]['auth']['resetpass_wait30'];

            return false;
        }
        else
        {

            if(strlen($username) == 0) { return false; }
            elseif(strlen($username) > 30) { return false; }
            elseif(strlen($username) < 3) { return false; }
            elseif(strlen($key) == 0) { return false; }
            elseif(strlen($key) < 15) { return false; }
            elseif(strlen($key) > 15) { return false; }
            else
            {
                $query = $sys->db()->prepare("SELECT user_resetkey FROM users WHERE username = :username", array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
                $query->bindParam(":username", $username);
                $query->execute();
                $count = $query->rowCount();


                if($count == 0)
                {
                    $this->LogActivity("UNKNOWN", "AUTH_CHECKRESETKEY_FAIL", "Username doesn't exist ({$username})");

                    $this->addattempt($_SERVER['REMOTE_ADDR']);

                    $this->errormsg[] = $lang[$sys->loc]['auth']['checkresetkey_username_incorrect'];

                    $attcount = $attcount + 1;
                    $remaincount = $sys->auth_conf['max_attempts'] - $attcount;

                    $this->errormsg[] = sprintf($lang[$sys->loc]['auth']['checkresetkey_attempts_remaining'], $remaincount);

                    return false;
                }
                else
                {
                    $db_key = current($query->fetch());

                    if($key == $db_key)
                    {
                        return true;
                    }
                    else
                    {
                        $this->LogActivity($username, "AUTH_CHECKRESETKEY_FAIL", "Key provided is different to DB key ( DB : {$db_key} / Given : {$key} )");

                        $this->addattempt($_SERVER['REMOTE_ADDR']);

                        $this->errormsg[] = $lang[$sys->loc]['auth']['checkresetkey_key_incorrect'];

                        $attcount = $attcount + 1;
                        $remaincount = $sys->auth_conf['max_attempts'] - $attcount;

                        $this->errormsg[] = sprintf($lang[$sys->loc]['auth']['checkresetkey_attempts_remaining'], $remaincount);

                        return false;
                    }
                }
            }
        }
    }

    /*
    * Deletes a user's account. Requires user's password
    * @param string $username
    * @param string $password
    * @return boolean
    */

    function deleteaccount($username, $password)
    {
        global $sys;
        include("lang.php");

        if(strlen($username) == 0) { $this->errormsg[] = $lang[$sys->loc]['auth']['deleteaccount_username_empty']; }
        elseif(strlen($username) > 30) { $this->errormsg[] = $lang[$sys->loc]['auth']['deleteaccount_username_long']; }
        elseif(strlen($username) < 3) { $this->errormsg[] = $lang[$sys->loc]['auth']['deleteaccount_username_short']; }
        if(strlen($password) == 0) { $this->errormsg[] = $lang[$sys->loc]['auth']['deleteaccount_password_empty']; }
        elseif(strlen($password) > 30) { $this->errormsg[] = $lang[$sys->loc]['auth']['deleteaccount_password_long']; }
        elseif(strlen($password) < 5) { $this->errormsg[] = $lang[$sys->loc]['auth']['deleteaccount_password_short']; }

        if(count($this->errormsg) == 0)
        {
            $password = $this->hashpass($password);

            $query = $sys->db()->prepare("SELECT user_password FROM users WHERE username = :username", array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
            $query->bindParam(":username", $username);
            $query->execute();
            $count = $query->rowCount();


            if($count == 0)
            {
                $this->LogActivity("UNKNOWN", "AUTH_DELETEACCOUNT_FAIL", "Username Incorrect ({$username})");

                $this->errormsg[] = $lang[$sys->loc]['auth']['deleteaccount_username_incorrect'];

                return false;
            }
            else
            {
                $db_password = current($query->fetch());

                if($password == $db_password)
                {
                    $query = $sys->db()->prepare("DELETE FROM users WHERE username = :username");
                    $query->bindParam(":username", $username);
                    $query->execute();


                    $query = $sys->db()->prepare("DELETE FROM sessions WHERE username = :username");
                    $query->bindParam(":username", $username);
                    $query->execute();


                    $this->LogActivity($username, "AUTH_DELETEACCOUNT_SUCCESS", "Account deleted - Sessions deleted");

                    $this->successmsg[] = $lang[$sys->loc]['auth']['deleteaccount_success'];

                    return true;
                }
                else
                {
                    $this->LogActivity($username, "AUTH_DELETEACCOUNT_FAIL", "Password incorrect ( DB : {$db_password} / Given : {$password} )");

                    $this->errormsg[] = $lang[$sys->loc]['auth']['deleteaccount_password_incorrect'];

                    return false;
                }
            }
        }
        else
        {
            return false;
        }
    }

    /*
    * Adds a new attempt to database based on user's IP
    * @param string $ip
    */

    function addattempt($ip)
    {
        global $sys;

        $query = $sys->db()->prepare("SELECT count FROM attempts WHERE ip = :ip", array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        $query->bindParam(":ip", $ip);
        $query->execute();
        $count = $query->rowCount();


        if($count == 0)
        {
            // No record of this IP in attempts table already exists, create new

            $attempt_expiredate = date("Y-m-d H:i:s", strtotime($sys->auth_conf['security_duration']));
            $attempt_count = 1;

            $query = $sys->db()->prepare("INSERT INTO attempts (ip, count, expiredate) VALUES (?, ?, ?)");
            $query->bindParam(1, $ip);
            $query->bindParam(2, $attempt_count);
            $query->bindParam(3, $attempt_expiredate);
            $query->execute();
        }
        else
        {
            $attempt_count = current($query->fetch());

            // IP Already exists in attempts table, add 1 to current count

            $attempt_expiredate = date("Y-m-d H:i:s", strtotime($sys->auth_conf['security_duration']));
            $attempt_count = $attempt_count + 1;

            $query = $sys->db()->prepare("UPDATE attempts SET count = :count, expiredate=:expiredate WHERE ip=:ip");
            $query->bindParam(":count", $attempt_count);
            $query->bindParam(":expiredate", $attempt_expiredate);
            $query->bindParam(":ip", $ip);
            $query->execute();

        }
    }

    /*
    * Provides amount of attempts already in database based on user's IP
    * @param string $ip
    * @return int $attempt_count
    */

    function getattempt($ip)
    {
        global $sys;

        $query = $sys->db()->prepare("SELECT count FROM attempts WHERE ip = :ip", array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        $query->bindParam(":ip", $ip);
        $query->execute();
        $count = $query->rowCount();

        if($count == 0)
        {
            $attempt_count = 0;
        } else {
            $attempt_count = current($query->fetch());
        }



        return $attempt_count;
    }

    /*
    * Function used to remove expired attempt logs from database (Recommended as Cron Job)
    */

    function expireattempt()
    {
        global $sys;

        $query = $sys->db()->prepare("SELECT ip, expiredate FROM attempts", array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        $query->execute();
        $count = $query->rowCount();

        $curr_time = strtotime(date("Y-m-d H:i:s"));

        if($count != 0)
        {
            while(list($ip, $expiredate) = $query->fetch())
            {
                $attempt_expiredate = strtotime($expiredate);

                if($attempt_expiredate <= $curr_time)
                {
                    $query2 = $sys->db()->prepare("DELETE FROM attempts WHERE ip = :ip");
                    $query2->bindParam(":ip", $ip);
                    $query2->execute();
                    $query2->closeCursor();
                }
            }
        }


    }

    /*
    * Logs users actions on the site to database for future viewing
    * @param string $username
    * @param string $action
    * @param string $additionalinfo
    * @return boolean
    */

    function LogActivity($username, $action, $additionalinfo = "none")
    {
        global $sys;
        include("lang.php");

        if(strlen($username) == 0) { $username = "GUEST"; }
        elseif(strlen($username) < 3) { $this->errormsg[] = $lang[$sys->loc]['auth']['logactivity_username_short']; return false; }
        elseif(strlen($username) > 30) { $this->errormsg[] = $lang[$sys->loc]['auth']['logactivity_username_long']; return false; }

        if(strlen($action) == 0) { $this->errormsg[] = $lang[$sys->loc]['auth']['logactivity_action_empty']; return false; }
        elseif(strlen($action) < 3) { $this->errormsg[] = $lang[$sys->loc]['auth']['logactivity_action_short']; return false; }
        elseif(strlen($action) > 100) { $this->errormsg[] = $lang[$sys->loc]['auth']['logactivity_action_long']; return false; }

        if(strlen($additionalinfo) == 0) { $additionalinfo = "none"; }
        elseif(strlen($additionalinfo) > 500) { $this->errormsg[] = $lang[$sys->loc]['auth']['logactivity_addinfo_long']; return false; }

        if(count($this->errormsg) == 0)
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

    /*
    * Hash user's password with SHA512, base64_encode, ROT13 and salts !
    * @param string $password
    * @return string $password
    */

    function hashpass($password)
    {
        global $sys;

        $password = hash("SHA512", base64_encode(str_rot13(hash("SHA512", str_rot13($sys->auth_conf['salt_1'] . $password . $sys->auth_conf['salt_2'])))));
        return $password;
    }

}
