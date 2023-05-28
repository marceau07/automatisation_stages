<?php
error_reporting(E_ALL); 
ini_set("display_errors", 1);
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Spipu\Html2Pdf\Html2Pdf;

//Load Composer's autoloader
require __DIR__ . '/../src/vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->CharSet    = "UTF-8";                                //Enable encoding in UTF-8
    $mail->Encoding   = 'base64';                               //Change the default encoding
    $mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'marceau.ro@adrar-numerique.com';       //SMTP username
    $mail->Password   = 'pleoxdpptfpkdmnd';                     //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('marceau.ro@adrar-numerique.com', 'Marceau 2');
    $mail->addAddress('marceaurodrigues@adrar-formation.com', 'Marceau 1');     //Add a recipient
    $mail->addReplyTo('marceau.ro@adrar-numerique.com', 'Marceau 2');
    $mail->addCC('marceaurodrigues@adrar-formation.com');
    // $mail->addBCC('bcc@example.com');

    //Création des PDFs personnalisés
    $html2pdf = new Html2Pdf();
    $attestation = file_get_contents(__DIR__ . '/documents/templates/attestation.html');
    $attestation = strtr($attestation, array(
        '{{NOM_PRENOM_STAGIAIRE}}' => 'NOM Prénom Stagiaire', 
        '{{DATE_DEBUT_STAGE}}' => '01/02/2023', 
        '{{DATE_FIN_STAGE}}' => '05/05/2023', 
        '{{DUREE_STAGE}}' => '253', 
    ));
    $html2pdf->writeHTML($attestation);
    $html2pdf->output(__DIR__ . '/../src/v/tmp/attestation.pdf', 'F');
    
    $evaluation = file_get_contents(__DIR__ . '/documents/templates/evaluation.html');
    $evaluation = strtr($evaluation, array(
        '{{NOM_PRENOM_STAGIAIRE}}' => 'NOM Prénom Stagiaire', 
        '{{NOM_ENTREPRISE}}' => 'ADRAR', 
        '{{NOM_SESSION}}' => 'dwwm', 
        '{{NOM_PRENOM_TUTEUR}}' => 'NOM Prénom tuteur', 
        '{{DATE_DEBUT_STAGE}}' => '01/02/2023', 
        '{{DATE_FIN_STAGE}}' => '05/05/2023', 
        '{{DUREE_STAGE}}' => '253', 
        '{{DATE_VISITE}}' => '26/05/2023', 
    ));
    $html2pdf->writeHTML($evaluation);
    $html2pdf->output(__DIR__ . '/../src/v/tmp/evaluation.pdf', 'F');
    
    //Attachments
    // $mail->addAttachment(__DIR__ . '/../src/v/tmp/attestation.pdf', 'Attestation_de_stage.pdf');    //Optional name
    // $mail->addAttachment(__DIR__ . '/../src/v/tmp/evaluation.pdf', 'Evaluation_de_stage.pdf');    //Optional name
    
    $message = file_get_contents(__DIR__ . '/../src/v/templates_mails/MAIL_DEMANDE.html');
    $message = strtr($message, array(
        '{{NOM_TUTEUR}}' => 'Marceau RODRIGUES', 
        '{{PRENOM_NOM_STAGIAIRE}}' => 'Marceau RODRIGUES stagiaire', 
        '{{LISTE_DOCUMENTS}}' => '<li>Attestation de stage</li><li>Évaluation de stage</li>', 
    ));

    //Content
    $mail->isHTML(true); //Set email format to HTML
    $mail->Subject = 'Demande de documents de stage';
    $mail->Body    = $message;
    $mail->AltBody = strip_tags($message);

    $mail->send();
    echo 'Le mail a bien été envoyé';
} catch (Exception $e) {
    echo "Message non délivré. Erreur: {$mail->ErrorInfo}";
}



// TODO: Automatiser avec la génération de PDF à partir du fichier HTML