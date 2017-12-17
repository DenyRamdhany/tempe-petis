<?php

  class Aduan
  { private $db;

    function __construct()
    { $this->db = Init::Instance()->database;
    }

    public function getUserHist($id)
    { $result = $this->db->getSingle('aduan','no_rek_listrik="'.$id.'" ORDER BY no_aduan ASC');
      $return = array();
      foreach ($result as $single) {
        unset($single['no_rek_listrik']);
          $single['tgl_aduan'] = date("l, d-m-Y H:i",$single['tgl_aduan']);
        $return[]=$single;
      }

      return $return;
    }
  }


?>
