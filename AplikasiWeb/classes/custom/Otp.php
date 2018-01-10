<?php

  class Otp extends Basic
  { protected $serial_id;
    protected $nomor_rekening;
    protected $password;
    protected $tgl_valid;

    public function __construct()
    { date_default_timezone_set("Asia/Bangkok");
    }

    public function generatePassword($nomor_rekening)
    { $this->serial_id = null;
      $this->nomor_rekening = $nomor_rekening;
      $this->password = hexdec(hash('adler32',time().$nomor_rekening,FALSE));
      $this->tgl_valid = strtotime(date('d-m-Y H:i:s'))+(12*3600);
    }

    public function verifyPassword($password)
    { if($this->password==$password && (strtotime("now")-$this->tgl_valid)<(12*3600)) return true;
      else return false;
    }

    public function kirimEmail($alamat_email)
    { $email = new Email();
      $stat  = $email->send(  array(
                  'mailTo'     => $alamat_email ,
                  'senderName' => 'Tempe Petis',
                  'mailName'   => 'OTP Request',
                  'subject'    => 'OTP Request pada '.date('d-M-Y H:i:s'),
                  'body'       => 'Kode OTP Anda adalah<br>'.$this->password.'<br>Berlaku 12 jam hingga<br>'.date('l, d-M-Y H:i:s',$this->tgl_valid)
               ));
      return $stat;
      unset($email);
    }
  }


?>
