<?php

function sendEmail($to, $subject, $html, $body) {

  global $sys;

  $url = $sys->mail->api;
  $user = $sys->mail->user;
  $pass = $sys->mail->pass;

  $params = array(
      'api_user'  => $user,
      'api_key'   => $pass,
      'to'        => $to,
      'subject'   => $subject,
      'html'      => $html,
      'text'      => $body,
      'from'      => $sys->email_from,
    );


  $request =  $url.'api/mail.send.json';

  // Generate curl request
  $session = curl_init($request);
  // Tell curl to use HTTP POST
  curl_setopt ($session, CURLOPT_POST, true);
  // Tell curl that this is the body of the POST
  curl_setopt ($session, CURLOPT_POSTFIELDS, $params);
  // Tell curl not to return headers, but do return the response
  curl_setopt($session, CURLOPT_HEADER, false);
  // Tell PHP not to use SSLv3 (instead opting for TLS)
  curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
  curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($session, CURLOPT_SSL_VERIFYPEER, false);

  // obtain response
  $response = curl_exec($session);

  // Check for errors and display the error message
  if($errno = curl_errno($session)) {
      $error_message = curl_strerror($errno);
      echo "cURL error ({$errno}):\n {$error_message}";
  }

  curl_close($session);

  // print everything out
  return $response;
}
