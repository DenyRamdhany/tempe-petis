<?php

  class Meteran extends Basic
  { protected $no_meter;
    protected $id_golongan;
    protected $nomor_rekening;
    protected $sisa_kwh;
    protected $status;
    protected $Golongan;

    public function __construct()
    { $this->Golongan = new Golongan();
    }

    public function tambahKuota($nomninal)
    { $this->sisa_kwh+=$nomninal/$this->Golongan->get('tarif_dasar');
    }

    public function pindahGolongan($Golongan)
    { $this->Golongan = $Golongan;
      $this->id_golongan = $Golongan->get('id_golongan');
    }

    public function aktifkan()
    { $this->set('status','1');
    }

    public function nonAktifkan()
    { $this->set('status','0');
    }

  }


?>
