<?php

  class Pelanggan
  {
    private $db;

    public function __construct()
    { $this->db = $this->db = Init::Instance()->database;
    }

    public function addReplace($param)
    { if($param['no_meter']==='null') $param['no_meter']=null;
      $this->db->replace('pelanggan',$param);
    }
    public function delPelanggan($param)
    { return $this->db->delSingle('pelanggan','no_rek_listrik="'.$param['no_rek_listrik'].'"');
    }

    public function getAll()
    { return $this->db->getTable('pelanggan');
    }

    public function getDetail($id)
    { return $this->db->query('SELECT * FROM pelanggan LEFT JOIN meteran ON pelanggan.no_meter = meteran.no_meter WHERE no_rek_listrik="'.$id.'"');
    }

    public function getWithMeteran()
    { return $this->db->getLeftJoin('pelanggan','meteran','no_meter');
    }

  }


?>
