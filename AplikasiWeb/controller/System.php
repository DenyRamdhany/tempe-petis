<?php

  class System extends Page
  {
    function __construct(){
      parent::__construct();
      $this->Session->protect();
    }

    public function index()
    { $param['golongan']      = $this->Golongan->getAll();
      $param['pelanggan']     = $this->Pelanggan->getWithMeteran();
      $param['meteranKosong'] = $this->Meteran->getAvailable();
      $param['meteran']       = $this->Meteran->getAll();
      $param['userData']      = $this->Session->getData();
      $param['history']       = $this->Token->getAll();

      $this->show('p_system',$param);
    }


    //fungsi untuk tabel golongan
    public function addGolongan()
    { $this->Golongan->addReplace($this->postData());
      $this->redirect('');
    }
    public function detailGolongan()
    { echo json_encode($this->Golongan->getDetail($this->postData()['id_golongan']));
    }
    public function delGolongan()
    { echo $this->Golongan->delGolongan($this->postData());
    }


    //fungsi untuk tabel pelanggan
    public function addPelanggan()
    { $this->Pelanggan->addReplace($this->postData());
      $this->redirect('');
    }
    public function randomRekening()
    { $random;
      $ada    = $this->Pelanggan->getAll();
      $state  = 1;
      while($state)
      { $random = mt_rand(1000000000,9999999999);
        $state = 0;
        foreach ($ada as $value) {
          if($value['no_rek_listrik']==$random) $state = 1;
        }
      }
      echo $random;
    }
    public function detailPelanggan()
    { echo json_encode($this->Pelanggan->getDetail($this->postData()['no_rek_listrik']));
    }
    public function delPelanggan()
    { echo $this->Pelanggan->delPelanggan($this->postData());
    }


    // fungsi untuk tabel meteran
    public function addMeteran()
    { $this->Meteran->addReplace($this->postData());
      $this->redirect('');
    }
    public function detailMeteran()
    { echo json_encode($this->Meteran->getDetail($this->postData()['no_meter']));
    }
    public function delMeteran()
    { echo $this->Meteran->delete($this->postData());
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
