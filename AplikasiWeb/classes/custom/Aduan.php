<?php

  class Aduan extends Basic
  { protected $no_aduan;
    protected $nomor_rekening;
    protected $teks_aduan;
    protected $status;

    public function tanggapi()
    { $this->set('status','1');
    }
  }


?>
