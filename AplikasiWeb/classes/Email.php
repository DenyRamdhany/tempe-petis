<?php
  require_once 'PHPMailer/src/PHPMailer.php';
  require_once 'PHPMailer/src/SMTP.php';

  use PHPMailer\PHPMailer\PHPMailer;

  class Email
  { private $mail;

    function __construct()
    { $this->mail = new PHPMailer(); //php mailer https://github.com/PHPMailer/PHPMailer

      $this->mail->isSMTP();
      $this->mail->Host = 'smtp.gmail.com';
      $this->mail->SMTPAuth = true;
      $this->mail->Username = 'sampuc.inc@gmail.com';
      $this->mail->Password = 'dancenanta';
      $this->mail->SMTPSecure = 'ssl';
      $this->mail->Port = 465;
    }

    public function send($param)
    { //Recipients
      $this->mail->setFrom($this->mail->Username, $param['senderName']);
      $this->mail->addAddress($param['mailTo'], $param['mailName']);

      //Content
      $this->mail->isHTML(true);
      $this->mail->Subject = $param['subject'];
      $this->mail->Body    = $param['body'];

      if($this->mail->send()) return "Berhasil Dikirim";
      else return $this->mail->ErrorInfo;

    }
  }

?>
