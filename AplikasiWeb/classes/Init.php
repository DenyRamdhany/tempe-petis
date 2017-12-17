<?php

  final class Init
  {
    public static function Instance()
    { static $inst = null;
      if($inst === null)
      { $inst = new Init();
        $inst->database = new Database();
        $inst->email    = new Email();
        $inst->session  = new Session();

        //tambah kelas baru disini
        $inst->pegawai  = new Pegawai();
        $inst->golongan = new Golongan();
        $inst->token    = new Token();
        $inst->aduan    = new Aduan();
        $inst->meteran  = new Meteran();
        $inst->pelanggan= new Pelanggan();
      }
      return $inst;
    }

    function __construct()
    {
    }

  }


?>
