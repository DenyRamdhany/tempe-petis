<?php

  class Front extends Page
  {
    public function index()
    { if($this->Session->isLogin()) $this->redirect('system');

      $data['warn'] = "";
      $this->show('p_login',$data);
    }

    public function login()
    { if($this->Session->isLogin()) $this->redirect('system');

      $testCase = $this->Pegawai->login($this->postData());

      if(!empty($this->postData()) && $testCase)
        { $this->Session->begin();
          $this->Session->setData($testCase[0]);
          $this->redirect('system');
        }
      else
      { $data['warn']="Login Gagal <br> Username atau Password Salah";
        $this->show('p_login',$data);
      }
    }

    public function logout()
    { $this->Session->end();
      $this->redirect('');
    }

  }

?>
