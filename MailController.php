<?php
session_start();

function log_to_file($filepath, $text)
{
   if ($file = fopen($filepath, 'w+'))
   {
      fwrite($file, $text);
   }
   fclose($file);
}

function send_mail()
{
   $email_text = '';
   
   // Useful data from $_SERVER
   $email_text .= 'Client IP: '. $_SERVER[REMOTE_ADDR] .'<br/>';
   $email_text .= 'Client User Agent: '. $_SERVER[HTTP_USER_AGENT] .'<br/>';
   //$email_text .= 'Client IP: '. $_SERVER[CONTENT_TYPE] => application/x-www-form-urlencoded .'<br/>';
   $email_text .= 'Referer: '. $_SERVER[HTTP_REFERER] .'<br/>';
   $email_text .= 'Languages Accepted: '. $_SERVER[HTTP_ACCEPT_LANGUAGE] .'<br/>';
   $email_text .= '<br/>';
   $email_text .= 'Contact Name: '. $_POST['name'] .'<br/>';
   $email_text .= 'Contact Email: '. $_POST['email'] .'<br/>';
   $email_text .= 'Subject: '. $_POST['subject'] .'<br/>';
   $email_text .= 'Message: '. $_POST['message'];
   
   $body = "<h2>Contacto desde BarcaraCardozo.com</h2>";
   $body .= $email_text;
   
   $headers = "From: ". $_POST['email'] . " <" . $_POST['email'] . ">\r\n"; //optional headerfields
   $headers .="Return-Path:<" . $_POST['email'] . ">\r\n"; // avoid ending in spam folder http://php.net/manual/en/function.mail.php
   
   // To send HTML mail, the Content-type header must be set
   $headers .= 'MIME-Version: 1.0'. "\r\n";
   $headers .= 'Content-type: text/html; charset=iso-8859-1'. "\r\n";
      
   ini_set('sendmail_from', $_POST['email']);
    
   // TODO: los errores logueados a disco
   // Por si no tengo servidor de email
   try
   {
      // bool mail ( string $to , string $subject , string $message [, string $additional_headers [, string $additional_parameters ]] )
      if (!mail('info@barcaracardozo.com', 'Contacto desde BarcaraCardozo.com', $body, $headers))
      {
         log_to_file('logs/'.date("YmdHis").'.log', 'No se pudo enviar el correo: '. $email_text);
         return false;
      }
      else
      {
         return true;
      }
   }
   catch (Exception $e)
   {
      // Por problemas t&eacute;cnicos no se pudo enviar notificacion
      log_to_file('logs/'.date("YmdHis").'.log', 'No se pudo enviar el correo: '.$email_text.' ('.$e->getMessage().')');
      return false;
   }
}

// JSON Response
header('Content-Type: application/json');

// The form should come from the UI and using POST
if ($_SERVER['REQUEST_METHOD'] != 'POST' ||
    !isset($_POST['nonce']) ||
    !isset($_SESSION['form_id']) ||
    $_POST['nonce'] != $_SESSION['form_id'])
{
   echo json_encode(array('status' => 'error', 'msg' => "Ha ocurrido un error al enviar el mensaje, por favor pruebe más tarde o contáctenos en info@barbaracardozo.com"));
}

// Clear nonce from SESSION after the submit to avoid second submits or page reload
unset( $_SESSION['form_id'] );


if (!send_mail())
{
   echo json_encode(array('status' => 'error', 'msg' => "Ha ocurrido un error al enviar el mensaje, por favor pruebe más tarde o contáctenos en info@barbaracardozo.com"));
}
else
{
   echo json_encode(array('status' => 'ok', 'msg' => "Hemos recibido tu mensaje, nos pondremos en contacto en breve"));
}
exit;

?>