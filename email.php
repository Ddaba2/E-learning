<?php
require 'bdd.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
//error_reporting(0);
// Load Composer's autoloader
require './vendor/autoload.php';
function email($subject=null, $body=null, $emailCode=null){

  // Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);


try {
    //Server settings
 //   $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
                                         // Send using SMTP
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = "mail09.lwspanel.com";                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = "contact@demande-banque.com";                     // SMTP username
    $mail->Password   = "Tounk@r@nke2021";                                // SMTP password
  //  $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

   // Spécifiez l'encodage UTF-8
    $mail->CharSet = 'UTF-8';

    //Recipients
    $mail->setFrom('contact@demande-banque.com', "E-leaning");
    $mail->addAddress($emailCode);     // Add a recipient
     //$mail->addCC('yalcouye1995@gmail.com');  // ajouter un mail en copie
     // $mail->addCC('yalcouye1995@gmail.com');  // ajouter un mail en copie
     //  $mail->addReplyTo($email_session,$session_codeBq);



   //for($i=0;$i<COUNT($_FILES['files_bf']);$i++){

    //if($_FILES['files_bf']['tmp_name'][$i] !=''){

    //$mail->AddAttachment($_FILES['files_bf']['tmp_name'][$i], $_FILES['files_bf']['name'][$i]);

    //}





    // Content
                                     // Set email format to HTML
    $mail->Subject = $subject?? 'Confirmation d\'inscription - E-learning 📖';
    $message =  "
    <p>Bonjour $nom_utilisateur,</p>

    <p>Nous sommes ravis de vous accueillir sur notre plateforme de e-learning !<br>
    Votre inscription a été prise en compte avec succès.</p>

    <hr>
    <p style='font-size: 0.9em; color: #666;'>
    Ce message et ses pièces jointes peuvent contenir des informations confidentielles ou privilégiées et ne doivent donc pas être diffusés, exploités ou copiés sans autorisation. Si vous avez reçu ce message par erreur, veuillez le signaler à l'expéditeur et le détruire ainsi que les pièces jointes. Les messages électroniques étant susceptibles d'altération, nous déclinons toute responsabilité si ce message a été altéré, déformé ou falsifié. Merci.
    </p>

    <p style='font-size: 0.9em; color: #666;'>
    This message and its attachments may contain confidential or privileged information that may be protected by law; they should not be distributed, used, or copied without authorization. If you have received this email in error, please notify the sender and delete this message and its attachments. As emails may be altered, we are not liable for messages that have been modified, changed, or falsified. Thank you.
    </p>

       <p>Cordialement,<br>L'équipe E-learning</p>";

     $mail->Body = $body?? $message;
     $mail->AltBody = strip_tags($message);
                                     


    $mail->send();

     echo "<script>
            alert('Un email vous a été envoyé');
      
            // body...
        </script>";


} catch (Exception $e) {
 echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
     echo "<script>
            alert('Echec lors de l\'envoi du mail');
              //      window.history.back();
            // body...
        </script>";
        //echo $e;
}

}

   ?>