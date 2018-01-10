<?php

  class Pegawai extends Basic
  { protected $nomor_induk;
    protected $nama;
    protected $password;

    public function login($pass)
    { if($this->password == md5($pass)) return true;
      else return false;
    }
  }

?>
