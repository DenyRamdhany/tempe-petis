<?php

  class Pegawai
  { private $db;

    public function __construct()
    { $this->db = Init::Instance()->database;
    }

    public function getAll()
    { if(!empty($this->connection))
      { return $this->connection->getTable('pegawai');
      }
      else
      { echo "Koneksi ke basisdata belum dibuat";
        die();
      }
    }

    public function login($param)
    { if(!empty($this->db))
      { $test = $this->db->getSingle('pegawai','id_pegawai="'.$param['username'].'" AND password="'.md5($param['password']).'"');
        if(count($test)==1) return $test;
        else return false;
      }
      else
      { echo "Koneksi ke basisdata belum dibuat";
        die();
      }
    }

    public function getWithMeteran()
    { if(!empty($this->db))
      { return $this->db->getInnerJoin('pelanggan','meteran','no_meter');
      }
      else
      { echo "Koneksi ke basisdata belum dibuat";
        die();
      }
    }
  }

?>
