<?php
include('PHPMailer/smtp/PHPMailerAutoload.php');

function smtp_mailer($to, $subject, $msg, $userEmail) {
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 587;
    $mail->IsHTML(true);
    $mail->CharSet = 'UTF-8';
    //$mail->SMTPDebug = 2; 
    $mail->Username = "ahsanfsc@gmail.com";
    // get your app password from this link => but activate 2FA Auth first
    // https://myaccount.google.com/apppasswords
    $mail->Password = "wtmr gbbc ywxm vwap";
    $mail->SetFrom("ahsanfsc@gmail.com");
    $mail->Subject = "New message from user: " . $subject;
    $mail->Body = "User Email: " . $userEmail . "<br><br> Message: "  . $msg;
    $mail->AddAddress($to);
    $mail->SMTPOptions = array('ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => false
    ));
    if (!$mail->Send()) {
        return $mail->ErrorInfo;
    } else {
        return 'Sent';
    }
}

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $msg = $_POST['msg'];
    $reciever = '@gmail.com';

    $result = smtp_mailer($reciever, $name, $msg, $email);

    if ($result === 'Sent') {
        // Success message for Bootstrap dismissible alert
        echo '
        
        
        <div class="alert alert-success alert-dismissible fade show" role="alert">
                Email sent successfully!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
    } else {
        // Error message for Bootstrap dismissible alert
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Error sending email: ' . $result . '
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
    }
}
?>


    <?php
     include 'cdn.php';
    ?>