<?php

  class Api extends Page
  { public function index()
    { $data['enabled'] = 0;
      $this->show('p_api',$data);
    }

    public function auth($param)
    { $auth = new Auth();
      $data = array( 'enabled'=> 0 );

      if(empty($param)) $this->show('p_api',$data);
      else if($auth->isKeyValid($param[0]))
      { $data['enabled'] = 1;
        $data['response'] = $this->Pelanggan->getWithKey($param[0]);

        $this->show('p_api',$data);
      }
      else $this->show('p_api',$data);
    }

    public function reqotp($param)
    { $data['enabled']=0;
      if(empty($param)) $this->show('p_api',$data);
      else
      { $data['enabled'] = 1;
        $data['response'][0]=$this->Pelanggan->reqOtp($param[0]);
        $this->show('p_api',$data);
      }
    }

    public function loginotp($param)
    { $data['enabled']=0;
      if(empty($param)) $this->show('p_api',$data);
      else
      { $data['enabled'] = 1;
        $data['response'][0]=$this->Pelanggan->loginotp($param[0],$this->getURL());
        $this->show('p_api',$data);
      }
    }

  }


?>