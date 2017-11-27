<?php

  class Page
  {
    protected $baseURL  = 'http://localhost/petis/';
    protected $appName  = 'Tempe Petis';
    protected $router   = 'apps.php';

    function __construct()
    {
    }

    public function index()
    {
    }

    public function show($pageName,$param="")
    { if(!file_exists('./pages/'.$pageName.'.php')) echo "Halaman Tidak Ditemukan";
      else
      { ob_start();
        $content = require('./pages/'.$pageName.'.php');
        $content = ob_get_clean();
        echo $content;
      }
    }

    public function postData()
    { return $_POST;
    }

    public function redirect($param)
    { header("Location:".$this->baseURL.$this->router."/".$param);
      exit();
    }

    public function debug($param='')
    { echo "<pre>";
      print_r($param);
      echo "</pre>";
    }

    public function dbase()
    { return new Database();
    }

    public function email()
    { return new Email();
    }

    public function session()
    { return new Session();
    }

  }

?>
