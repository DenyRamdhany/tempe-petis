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

      $user = $this->postData('username');
      $pass = $this->postData('password');

      $pegawai = $this->Broker->findKey('pegawai',$user);
      if($pegawai!=null)
      { if($pegawai->login($pass))
        { $this->Session->begin();
          $this->Session->setData(
            array('nama' => $pegawai->get('nama'))
          );
          $this->redirect('system');
        }
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
