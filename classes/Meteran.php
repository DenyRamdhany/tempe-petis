<?php

  class Meteran
  { private $db;
    private $gol;

    function __construct()
    { $this->db = Init::Instance()->database;
      $this->gol = Init::Instance()->golongan;
    }

    public function getAll()
    { return $this->db->query('SELECT meteran.*,golongan.* FROM meteran INNER JOIN golongan ON meteran.id_golongan = golongan.id_golongan');
    }

    public function addReplace($param)
    { $this->db->replace('meteran',$param);
    }
    public function getDetail($id)
    { return $this->db->getSingle('meteran','no_meter="'.$id.'"');
    }
    public function getWithGolongan($id)
    { $meteran  = $this->db->getSingle('meteran','no_meter="'.$id.'"')[0];
      $golongan = $this->gol->getDetail($meteran['id_golongan'])[0];

      return array_merge($meteran,$golongan);
    }
    public function delete($param)
    { return $this->db->delSingle('meteran','no_meter="'.$param['no_meter'].'"');
    }

    public function getOccupied()
    { return $this->db->query('SELECT meteran.*,golongan.* FROM meteran INNER JOIN golongan ON meteran.id_golongan = golongan.id_golongan INNER JOIN pelanggan ON pelanggan.no_meter = meteran.no_meter');
    }

    public function getAvailable()
    { return $this->db->query('SELECT meteran.*,golongan.* FROM pelanggan RIGHT JOIN meteran ON pelanggan.no_meter = meteran.no_meter INNER JOIN golongan ON meteran.id_golongan = golongan.id_golongan WHERE pelanggan.no_meter IS NULL');
    }

  }


?>
