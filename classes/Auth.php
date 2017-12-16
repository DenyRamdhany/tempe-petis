<?php

  class Auth
  { private $db;

    function __construct()
    { $this->db = Init::Instance()->database;
    }

    public function isKeyValid($key)
    { $test = $this->db->getSingle('pelanggan','keylog="'.$key.'"');

      if(count($test)==1) return true;
      else return false;
    }

  }


?>
