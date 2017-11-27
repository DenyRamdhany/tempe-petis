<?php

  class Front extends Page
  {
    function __construct()
    {
    }

    public function index($param='')
    { if($this->session()->isLogin()) $this->redirect('system');

      $data['warn'] = "";
      $this->show('p_login',$data);
    }

    public function login()
    { if($this->session()->isLogin()) $this->redirect('system');

      if(!empty($this->postData()) && $this->postData()['user']=='admin' && $this->postData()['pass']=='admin')
        { $this->session()->begin();
          $this->redirect('system');
        }
      else
      { $data['warn']="Login Gagal <br> Username atau Password Salah";
        $this->show('p_login',$data);
      }
    }

    public function logout()
    { $this->session()->end();
      $this->redirect('');
    }

  }

?>
