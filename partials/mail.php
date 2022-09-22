<?php
                        use PHPMailer\PHPMailer\PHPMailer;
                        use PHPMailer\PHPMailer\SMTP;
                        use PHPMailer\PHPMailer\Exception;
                        require '../PHPMailer/Exception.php';
                        require '../PHPMailer/PHPMailer.php';
                        require '../PHPMailer/SMTP.php';
                        $m = new PHPMailer(true);

              try {
                  $m->isSMTP();                                            
                    $m->Host      = 'smtp.gmail.com';                     
                  $m->SMTPAuth   = true;    
                  $m->SMTPSecure = 'tls';                             
                  $m->Username   = 'covisurance@gmail.com';                     
                  $m->Password   = 'imfqdtfdtgkbqqbt';                               
                  $m->Port = '587';   
                  $m->SMTPOptions = array(
                   'ssl' => array(
                       'verify_peer' => false,
                       'verify_peer_name' => false,
                       'allow_self_signed' => true
                   )
               );                              
                  $m->setFrom('covisurance@gmail.com', 'Covisurance');
                  $m->addAddress($email,$firstName);    
                  $m->addAddress($email);               
                  $m->isHTML(true);                                  
                  $m->Subject = $subject;
                  $m->Body    = $msg .' <b>'.$code.'</b><br><br>'.$msgend;
                  $m->AltBody = 'Code Not Generated. Some error Occured';
   
                  $m->send();
              }
              catch (Exception $e) {
              }


?>