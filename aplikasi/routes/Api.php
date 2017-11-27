<?php

  class Api extends Page
  {

    function __construct()
    {
    }

    public function index()
    { echo "test api";
    }

    public function getMe($param)
    { $me = new Pelanggan($param[0]);
      $this->debug(json_encode($me->getDetail(), JSON_PRETTY_PRINT));
    }



  }

?>
