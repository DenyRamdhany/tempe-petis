<?php

  class System extends Page
  {
    function __construct()
    { $this->session()->protect();
    }

    public function index($param='')
    { $this->show('p_system');
    }

    public function get($param)
    { $this->show('p-hello',$this->dbase()->getTable($param[0]));
    }

    public function login()
    { $this->session()->begin();
      $this->session()->setData(array('user' => 'nama saya' , 'status' => 'wibu' ));
      $this->debug($this->session()->getData());

      //$this->redirect("hello");
    }

    public function logout()
    { $this->session()->end();
    }

    public function mail($param)
    { $this->email()->send(array( 'mailTo'     => $param[0] ,
                                  'senderName' => 'Tempe Petis',
                                  'mailName'   => 'Testing Mail',
                                  'subject'    => 'Testing Email Petis' ,
                                  'body'       => 'test kirim com...'
                                ));
    }

  }


?>
