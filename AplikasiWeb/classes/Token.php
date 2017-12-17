<?php

  class Token
  { private $db;

    function __construct()
    { $this->db = Init::Instance()->database;
    }

    public function getAll()
    { return $this->db->getTable('struk_token');
    }

    public function getUserHist($id)
    { $result = $this->db->getSingle('struk_token','no_rek_listrik="'.$id.'" ORDER BY no_struk DESC');
      $return = array();
      foreach ($result as $single) {
        setlocale(LC_ALL, 'id_ID');
        unset($single['no_rek_listrik']);
        $single['tgl_bayar'] = date("l, d-m-Y H:i",$single['tgl_bayar']);
        $single['nominal'] = (double) $single['nominal'];
        $single['status'] = (int) $single['status'];

        $return[]=$single;
      }

      return $return;
    }




  }


?>
