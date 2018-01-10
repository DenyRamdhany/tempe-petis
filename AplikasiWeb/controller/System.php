<?php

  class System extends Page
  {
    function __construct(){
      parent::__construct();
      $this->Session->protect();
    }

    public function index()
    { $param['userData']      = $this->Session->getData();
      $param['golongan']      = $this->Broker->get('golongan');
      $param['meteran']       = $this->Broker->get('meteran');
      $param['aduan']         = $this->Broker->get('aduan');
      $param['history']       = $this->Broker->get('token');
      $param['pelanggan']     = $this->Broker->get('pelanggan');
      $json = new Jsonify();
      $param['test']          = $json->getJSON($param['pelanggan'][0]);
      $param['meteranKosong'] = $this->Broker->findAttrib('meteran','nomor_rekening','null');
      $this->show('p_system',$param);
    }

    //fungsi untuk operasi pada form
    public function add()
    { $class = ucfirst($this->postData('table'));
      $data  = $this->postData();
      unset($data['table']);

      $obj = new $class();
      $obj->fill($data);

      if($class=='Pelanggan' && array_key_exists('no_meter',$data))
      { $pel = $this->Broker->findKey('Pelanggan',$data['nomor_rekening']);
        if($pel->get('Meteran')!=null)
        { $pel->get('Meteran')->set('nomor_rekening',null);
          $this->Broker->save($pel->get('Meteran'));
        }
        $met = $this->Broker->findKey('Meteran',$data['no_meter']);
        if($met!=null) $met->set('nomor_rekening',$data['nomor_rekening']);
        $obj->set('Meteran',$met);
      }

      $this->Broker->save($obj);
      $this->redirect('');
    }
    public function detail()
    { $class  = $this->postData('table');
      $key    = $this->postData('key');
      $object = $this->Broker->findKey($class,$key);
      $return = new Jsonify();
      echo json_encode($return->getJSON($object,array('Otp','Aduan','Token')));
    }

    public function delete()
    { $class = $this->postData('table');
      $key   = $this->postData('key');

      if($class=='pelanggan')
      { $pel = $this->Broker->findKey('Pelanggan',$key);
        if($pel->get('Meteran')!=null)
        { $pel->get('Meteran')->set('nomor_rekening',null);
          $this->Broker->save($pel->get('Meteran'));
        }
      }

      $object = $this->Broker->findKey($class,$key);
      if(!empty($object))
        if($this->Broker->delete($object)) echo "1";
        else echo "0";
    }

    //fungsi buat resolve aduan, beda sendiri soalnya
    public function resolve()
    { $adu = $this->Broker->findKey('Aduan',$this->postData('key'));
      if($adu!=null)
      { $adu->tanggapi();
        $this->Broker->save($adu);
        echo "1";
      }
      else echo "0";
    }


    //fungsi untuk tabel pelanggan
    public function randomRekening()
    { $random;
      $ada    = $this->Broker->get('Pelanggan');
      $state  = 1;
      while($state)
      { $random = mt_rand(100000000,999999999);
        $state = 0;
        foreach ($ada as $value) {
          if($value->get('nomor_rekening')==$random) $state = 1;
        }
      }
      echo $random;
    }

  }


?>
