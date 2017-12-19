<?php

  class Page
  {
    protected $baseURL  = 'https://petis.jaban.in/';
  //  protected $baseURL  = 'http://localhost/petis/';
    protected $appName  = 'Tempe Petis';
    protected $router   = 'index.php';
    protected $views    = 'views';


    public function __construct()
    { $obj = Init::Instance();
      foreach ($obj as $key) {
        $this->{get_class($key)}=$key;
      }
    }

    public function getURL()
    { return $this->baseURL.$this->router."/";
    }

    public function show($viewsName,$param="")
    { if(!file_exists('./'.$this->views.'/'.$viewsName.'.php')) echo "Halaman \"$viewsName\" Tidak Ditemukan";
      else
      { ob_start();
        if(!empty($param)) extract($param);
        $content = require('./'.$this->views.'/'.$viewsName.'.php');
        $content = ob_get_clean();
        echo $content;
      }
    }

    public function postData()
    { return $_POST;
    }

    public function redirect($param)
    { header("Location:".$this->getURL().$param);
      exit();
    }

    public function debug($param='')
    { echo "<pre>";
      print_r($param);
      echo "</pre>";
    }

  }

?>
