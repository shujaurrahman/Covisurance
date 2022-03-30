<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require '../PHPMailer/Exception.php';
require '../PHPMailer/PHPMailer.php';
require '../PHPMailer/SMTP.php';
session_start();
$email = "";
$errors = array();
require_once "../partials/conn.php"; 
    if(isset($_POST['check-email'])){
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $check_email = "SELECT * FROM alluser WHERE email='$email'";
        $run_sql = mysqli_query($conn, $check_email);
        if(mysqli_num_rows($run_sql) > 0){
            $code = rand(999999, 111111);
            $insert_code = "UPDATE alluser SET code = $code WHERE email = '$email'";
            $run_query =  mysqli_query($conn, $insert_code);
            if($run_query){
                $subject = "Password Reset Code";
                $message = "Your password reset code is";
                $msgend= "If this wasn't you ignore this message.";

                  //Create an instance; passing `true` enables exceptions
              $m = new PHPMailer(true);
   
              try {
                  //Server settings
                  // $m->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                  $m->isSMTP();                                            //Send using SMTP
                  $m->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                  $m->SMTPAuth   = true;    
                  $m->SMTPSecure = 'tls';// Enable TLS encryption, `ssl` also accepted                               //Enable SMTP authentication
                  $m->Username   = 'covisurance@gmail.com';                     //SMTP username
                  $m->Password   = 'shuja@123';                               //SMTP password
               //    $m->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                  $m->Port = '587';   
                  // $m->SMTPDebug = 2;   
                  $m->SMTPOptions = array(
                   'ssl' => array(
                       'verify_peer' => false,
                       'verify_peer_name' => false,
                       'allow_self_signed' => true
                   )
               );                              //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
   
                  //Recipients
                  $m->setFrom('covisurance@gmail.com', 'Covisurance');
                  $m->addAddress($email,$firstName);     //Add a recipient
                  $m->addAddress($email);               //Name is optional
                  // $m->addReplyTo('info@example.com', '');
               //    $m->addCC('cc@example.com');
               //    $m->addBCC('bcc@example.com');
   
                  //Attachments
               //    $m->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
               //    $m->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
   
                  //Content
                  $m->isHTML(true);                                  //Set email format to HTML
                  $m->Subject = $subject;
                  $m->Body    = $message .' <b>'.$code.'</b><br><br>'.$msgend;
                  $m->AltBody = 'Code Not Generated. Some error Occured';
   
                  $m->send();
                  $mailsent=true;
                 
                  // echo 'Message has been sent';
              }
              catch (Exception $e) {
                  // echo "Message could not be sent. Mailer Error: {$m->ErrorInfo}";
              }
                if($mailsent){
                    $info = "We've sent a passwrod reset otp to - $email";
                    $_SESSION['info'] = $info;
                    $_SESSION['email'] = $email;
                    header('location: reset-code.php');
                    exit();
                }else{
                    $errors['otp-error'] = "Failed while sending code!";
                }
            }else{
                $errors['db-error'] = "Something went wrong!";
            }
        }else{
            $errors['email'] = "This email address does not exist!";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form">
                <form action="forgot-password.php" method="POST" autocomplete="">
                    <h2 class="text-center">Forgot Password</h2>
                    <p class="text-center">Enter your email address</p>
                    <?php
                        if(count($errors) > 0){
                            ?>
                            <div class="alert alert-danger text-center">
                                <?php 
                                    foreach($errors as $error){
                                        echo $error;
                                    }
                                ?>
                            </div>
                            <?php
                        }
                    ?>
                    <div class="form-group">
                        <input class="form-control" type="email" name="email" placeholder="Enter email address" required value="<?php echo $email ?>">
                    </div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="check-email" value="Continue">
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>