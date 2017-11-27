<?php

  class Session
  {
    function __construct()
    { if(session_status() == PHP_SESSION_NONE) session_start();
    }

    public function getData()
    { return $_SESSION;
    }

    public function setData($param)
    { $_SESSION = array_merge($_SESSION,$param);
    }

    public function begin()
    { $_SESSION['login'] = 1;
    }

    public function end()
    { if(isset($_SESSION['login'])) session_unset($_SESSION['login']);
    }

    public function isLogin()
    { if(isset($_SESSION['login'])) return true;
      else return false;
    }

    public function protect()
    { $page = new Page();
      if(!isset($_SESSION['login'])) $page->redirect('');
    }

  }

?>
