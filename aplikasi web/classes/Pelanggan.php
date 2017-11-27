<?php

  class Pelanggan
  {
    private $no_rek;
    private $golongan;
    private $nama;
    private $alamat;
    private $no_tlp;
    private $email;
    private $kwh;

    function __construct($no_rek)
    { $db = new Database();
      $res = $db->query("SELECT * FROM pelanggan WHERE no_rekening = ".$no_rek);

      if($res)
      { $gol = $db->query('SELECT * FROM golongan WHERE id_golongan = "'.$res[0]['id_golongan'].'"');
        $this->no_rek = $res[0]['no_rekening'];
        $gol[0]['harga_perkwh'] = (double) $gol[0]['harga_perkwh'];
        $this->golongan = $gol[0];
        $this->nama = $res[0]['nama'];
        $this->alamat = $res[0]['alamat'];
        $this->no_tlp = $res[0]['no_tlp'];
        $this->email = $res[0]['email'];
        $this->kwh = $res[0]['sisa_kwh'];
      }
    }

    public function getDetail()
    { return array('nomor_rekening' => $this->no_rek,
                   'golongan' => $this->golongan,
                   'nama_jelas' => $this->nama,
                   'tempat_tinggal' => $this->alamat,
                   'nomor_telepon' => $this->no_tlp,
                   'alamat_email' => $this->email,
                   'kwh_tersisa' => (double)$this->kwh,
                  );
    }

  }


?>
