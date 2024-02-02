<?php include "config/config.php"; ?>
<?php include "includes/header.php"; ?>
<?php

if (isset($_GET['token'])) {
    if (isset($_SESSION['user_id'])) {
        $select = $conn->query("SELECT * FROM cart WHERE user_id = '$_SESSION[user_id])'");
        $select->execute();
        $allProducts = $select->fetchAll(PDO::FETCH_OBJ);


    }

} else {
    header("location:" . APPURL . "");
}

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth = true;                                   //Enable SMTP authentication
    $mail->Username = 'niel2264@gmail.com';                     //SMTP username
    $mail->Password = 'otsedzqanxreujfz';                               //SMTP password
    $mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
    $mail->Port = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Sender
    $mail->setFrom('niel2264@gmail.com', 'Bookstore');

    //Recipent
    $mail->addAddress($_SESSION['email'], $_SESSION['username']);     //Add a recipient

    foreach ($allProducts as $products) {
        $path = 'books/';
        //$file = $products->pro_file;

        for ($i = 0; $i < count($allProducts); $i++) {

            $mail->addAttachment($path . $products->pro_file);         //Add attachments

        }
    }

    $deleteCart = $conn->query("DELETE FROM cart WHERE user_id = '$_SESSION[user_id])'");
    $deleteCart->execute();

    header("location:" . APPURL . "");

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'The books you bought';
    $mail->Body = 'Here are the books you paid for. $' . $_SESSION['price'] . ' <b>Thanks for buying from bookstore</b>';
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
<?php include "includes/footer.php" ?>