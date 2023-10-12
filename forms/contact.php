

<?php
session_start();
// -- get uer info --
if(isset($_POST['contact_submit'])){
  $username = $_POST['name'];
  $email = $_POST['email'];
  $subject = $_POST['subject'];
  $message = $_POST['message'];
  // echo $message;
}

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
require '../PHPMailer/PHPMailer.php';
require '../PHPMailer/Exception.php';
require '../PHPMailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// //Load Composer's autoloader
// require 'vendor/autoload.php';

// //Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'sailoge786@gmail.com';                     //SMTP username
    $mail->Password   = 'doughhkxmcgbxrmz';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom($email, $username);
    $mail->addAddress('sailoge786@gmail.com', 'Srisaidecors');     //Add a recipient
    // $mail->addAddress('ellen@example.com');               //Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    //Attachments
    // $mail->addAttachment('../assets/image/');         //Add attachments


    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <style>
        .e-title{
            color: orangered;
        }
        table,th,td{
            border: 1px solid black;
            width: 400px;
            border-collapse: collapse;
        }
        tr{
            height: 40px;
            text-align: center;
        }
        th{
            background-color: #dbdbdb;
        }
        td:hover{
            background-color: #dae99b;
        }
    </style>
    </head>
    <body>
   
        <div>
            <h2 class="e-title">Sri Sai Decors</h2>
        </div>
        <table>
            <tr>
                <th>Name</th>
                <td>'.$username.'</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>'.$email.'</td>
            </tr>

            <tr>
                <th>Subject</th>
                <td>'.$subject.'</td>
            </tr>
            <tr>
                <th>Message</th>
                <td>'.$message.'</td>
            </tr>
        </table>
    </body>
    </html>';
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    if($mail->send()){
      $_SESSION['status'] = "Message has been sent successfully. We will reach you soon!";
      header('location:../index.php');
      // echo 'Message has been sent';
    }else{
      echo "Oops error !....";
    }
    
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}