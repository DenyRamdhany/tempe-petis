<?php

  class Golongan
  {
    private $db;

    public function __construct()
    { $this->db = Init::Instance()->database;
    }

    public function getAll()
    { return $this->db->getTable('golongan');
    }

    public function getWithMeteran()
    { return $this->db->getInnerJoin('pelanggan','meteran','no_meter');
    }

    public function getDetail($id)
    { return $this->db->getSingle('golongan','id_golongan="'.$id.'"');
    }

    public function addReplace($value)
    { $this->db->replace('golongan',$value);
    }

    public function delGolongan($value)
    { return $this->db->delSingle('golongan','id_golongan="'.$value['id_golongan'].'"');
    }

  }


?>
