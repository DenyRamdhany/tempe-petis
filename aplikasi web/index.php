<?php
  $defaultController  = 'Front';

  spl_autoload_register(function ($class_name) {
    if(file_exists('./classes/'.$class_name.'.php')) require_once './classes/'.$class_name.'.php';
    else if(file_exists('./controller/'.$class_name.'.php')) require_once './controller/'.$class_name.'.php';
    else
    { echo "Error pada Classes atau Controller tidak tersedia";
      die();
    }
  });

  Init::Instance();

  $url   = $_SERVER['REQUEST_URI'];
  $path  = explode('/', parse_url(substr($url, strpos($url, basename(__FILE__)) + 10), PHP_URL_PATH));
  $page  = ucfirst(array_shift($path));
  $func  = strtolower(array_shift($path));
  $param = $path;

  if($page=="")
  { $obj = new $defaultController();
    $obj->index();

  }
  else
  { $obj = new $page();
    if($func=="") $obj->index();
    else $obj->$func($param);
  }
?>
