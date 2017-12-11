<?php

  class Meteran
  { private $db;

    function __construct()
    { $this->db = Init::Instance()->database;
    }

    public function getAll()
    { return $this->db->query('SELECT meteran.*,golongan.* FROM meteran INNER JOIN golongan ON meteran.id_golongan = golongan.id_golongan');
    }

    public function addReplace($param)
    { var_dump($param);
      var_dump($this->db->replace('meteran',$param));
    }
    public function getDetail($id)
    { return $this->db->getSingle('meteran','no_meter="'.$id.'"');
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
