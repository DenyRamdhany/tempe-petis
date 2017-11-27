<?php

  $defPage  = 'Front';

  spl_autoload_register(function ($class_name) {
    if(file_exists('./classes/'.$class_name.'.php')) require_once './classes/'.$class_name.'.php';
    else if(file_exists('./routes/'.$class_name.'.php')) require_once './routes/'.$class_name.'.php';
    else
    { echo "Error pada Classes atau Routes";
      die();
    }
  });

  $url   = $_SERVER['REQUEST_URI'];

  $path  = explode('/', parse_url(substr($url, strpos($url, basename(__FILE__)) + 9), PHP_URL_PATH));
  $page  = ucfirst(array_shift($path));
  $func  = strtolower(array_shift($path));
  $param = $path;

  if($page=="")
  { $obj = new $defPage();
    $obj->index();
  }
  else
  { $obj = new $page();
    if($func=="") $obj->index();
    else $obj->$func($param);
  }

?>
