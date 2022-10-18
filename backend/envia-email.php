<?php


// -----------------------------------







// destinatario-> quem ira receber o email
// $destinatario_email = $_POST['email'];
// $destinatario_nome = $_POST['nome'];

/**
 * This example shows settings to use when sending via Google's Gmail servers.
 * This uses traditional id & password authentication - look at the gmail_xoauth.phps
 * example to see how to use XOAUTH2.
 * The IMAP section shows how to save this message to the 'Sent Mail' folder using IMAP commands.
 */



//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

function enviaEmail($destinatario_email,$destinatario_nome,$token)

{
    
    $email_servidor = 'smtp.gmail.com';
    $email_porta= 465;
    $email_usuario = 'tecnico22asenac@gmail.com';
    $email_usuario_password = 'zvfarpeztyqgtrhe';
    $email_usuario_nome ='Técnico 22A';
    $email_assunto = 'Sistema senac - Ative sua conta!'; 

    $email_corpo = <<<EMAIL
    <img src = "https://logodownload.org/wp-content/uploads/2014/10/senac-logo-4.png" width="200px"

    <h3 style = "margin-top:15px">Olá $destinatario_nome, bem vindo ao Sistema Senac</h1>
    <p>Ative o seu login, acessando o link abaixo:</p>
    <a href="http://localhost/datatable-exemplo/backend/activeUser.php?token=$token">
    Ativar acesso</a>
    <small> Esse é um email automarico, não responda</small>
    <small> Em caso de dúvidas, entre em contato: contato@sistema.com</small>

EMAIL;

// usada apenas se estiver usando gerenciador de pacotes composer
// require '../vendor/autoload.php';

// importaçao manual dos arquivos necessarios para o funcionamento do php mailer
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

//Create a new PHPMailer instance
$mail = new PHPMailer();

// altera o charset pra utf8
$mail->CharSet = 'UTF-8';

//Tell PHPMailer to use SMTP
$mail->isSMTP();

//Enable SMTP debugging
//SMTP::DEBUG_OFF = off (for production use)
//SMTP::DEBUG_CLIENT = client messages
//SMTP::DEBUG_SERVER = client and server messages
$mail->SMTPDebug = SMTP::DEBUG_OFF;

//Set the hostname of the mail server
// endereço do servidor de envio de emails da empresa/provedor
$mail->Host = $email_servidor;
//Use `$mail->Host = gethostbyname('smtp.gmail.com');`
//if your network does not support SMTP over IPv6,
//though this may cause issues with TLS

//Set the SMTP port number:
// - 465 for SMTP with implicit TLS, a.k.a. RFC8314 SMTPS or
// - 587 for SMTP+STARTTLS
$mail->Port = $email_porta;

//Set the encryption mechanism to use:
// - SMTPS (implicit TLS on port 465) or
// - STARTTLS (explicit TLS on port 587)
$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

//Whether to use SMTP authentication
$mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = $email_usuario;

//Password to use for SMTP authentication
$mail->Password = $email_usuario_password;

//Set who the message is to be sent from
//Note that with gmail you can only use your account address (same as `Username`)
//or predefined aliases that you have configured within your account.
//Do not use user-submitted addresses in here
$mail->setFrom($email_usuario, $email_usuario_nome);

//Set an alternative reply-to address
//This is a good place to put user-submitted addresses
// $mail->addReplyTo($email_usuario, $email_usuario_nome);

//Set who the message is to be sent to
$mail->addAddress($destinatario_email);

//Set the subject line
$mail->Subject = $email_assunto;

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
// $mail->msgHTML(file_get_contents('contents.html'), __DIR__);

//Replace the plain text body with one created manually
// $mail->AltBody = 'This is a plain-text message body';



$mail->Body = $email_corpo;
$mail->isHTML(true);

//Attach an image file
// $mail->addAttachment('images/phpmailer_mini.png');

//send the message, check for errors
if (!$mail->send()) {
    // echo 'Mailer Error: ' . $mail->ErrorInfo;
    return false;
} else {
    return true;
    //Section 2: IMAP
    //Uncomment these to save your message in the 'Sent Mail' folder.
    #if (save_mail($mail)) {
    #    echo "Message saved!";
    #}
}

}

