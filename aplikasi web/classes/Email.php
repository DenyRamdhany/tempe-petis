<?php
  require_once './includes/PHPMailer/src/PHPMailer.php';
  require_once './includes/PHPMailer/src/SMTP.php';

  use PHPMailer\PHPMailer\PHPMailer;

  class Email
  { function __construct()
    {
    }

    public function send($param)
    { $mail = new PHPMailer(); //php mailer https://github.com/PHPMailer/PHPMailer

      $mail->isSMTP();
      $mail->Host = 'smtp.gmail.com';
      $mail->SMTPAuth = true;
      $mail->Username = 'sampuc.inc@gmail.com';
      $mail->Password = 'sampucnanta';
      $mail->SMTPSecure = 'ssl';
      $mail->Port = 465;

      //Recipients
      $mail->setFrom($mail->Username, $param['senderName']);
      $mail->addAddress($param['mailTo'], $param['mailName']);

      //Content
      $mail->isHTML(true);
      $mail->Subject = $param['subject'];
      $mail->Body    = $param['body'];

      if($mail->send()) return "Berhasil Dikirim";
      else return $mail->ErrorInfo;

    }
  }

?>
