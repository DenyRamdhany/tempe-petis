<?php
  // Kelas inisialisasi kelas yang mau jadi singleton

  final class Init
  {
    public static function Instance()
    { static $inst = null;
      if($inst === null)
      { $inst = new Init();

        $inst->email    = new Email();
        $inst->session  = new Session();
        $inst->jsonify  = new Jsonify();
        $inst->broker   = new Broker(array('pegawai','golongan','meteran','aduan','token','otp','pelanggan'));
      }
      return $inst;
    }
  }


?>
