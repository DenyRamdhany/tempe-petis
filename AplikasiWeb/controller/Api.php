<?php

  class Api extends Page
  { public function index()
    { $data['enabled'] = 0;
      $this->show('p_api',$data);
    }

    public function pelanggan($param)
    { if(empty($param)) $this->show('p_api',$data);
      else if(!empty($param[0]))
      { $data['enabled']  = 1;
        $data['response'] = array();
        $pel  = $this->Broker->findKey('Pelanggan',strrev($param[0]));

        if($pel!=null)
        { if(!empty($param[1]) && $param[1]=='status')
          { if($pel->get('Meteran')!=null) $data['response'] = '{'.$pel->get('Meteran')->get('status').'}';
          }
          else if(!empty($param[1]) && $param[1]=='post')
          { $this->post($param);
            return;
          }
          else $data['response'] = $this->Jsonify->getJSON($pel,array('Otp'));
        }
        else $data['enabled']  = 0;

        $this->show('p_api',$data);
      }
      else $this->show('p_api',$data);
    }

    public function request($param)
    { $data['enabled'] = 0;
      if(!empty($param[0]))
      { $data['enabled']  = 1;
        $pel  = $this->Broker->findKey('Pelanggan',$param[0]);
        if($pel!=null)
        { if($pel->get('Meteran')==null) $data['response'] = array("response" => "Meteran Listrik Anda Belum Terdaftar","status" => 0);
          else
          { //$this->Broker->save($pel->requestPassword());
            $data['response'] = array(
              "response" => "OTP Telah Dikirim ke Email Anda",
              "status" => 1
            );
          }
        } else $data['response'] = array("response" => "Nomor Rekening Tidak Valid","status" => 0);

        $this->show('p_api',$data);
      }
      else $this->show('p_api',$data);
    }

    public function loginotp($param)
    { $data['enabled']=0;
      if(empty($param)) $this->show('p_api',$data);
      else if(!empty($param[0]))
      { $data['enabled'] = 1;
        $otp  = $this->Broker->findAttrib('Otp','password',$param[0])[0];
        if($otp!=null)
        { $pel  = $this->Broker->findKey('Pelanggan',$otp->get('nomor_rekening'));
          if($pel!=null)
          { if($pel->login($param[0]))
            { $data['response'] = array(
                "response" => "Selamat Datang, ".$pel->get('nama'),
                "address" => $this->baseURL.$this->router."/api/pelanggan/".strrev($pel->get('nomor_rekening')),
                "status" => 1
              );
            }
            else $data['response'] = array("response" => "OTP Tidak Valid","status" => 0);
          } else $data['response'] = array("response" => "OTP Tidak Valid","status" => 0);
        } else $data['response'] = array("response" => "OTP Tidak Valid","status" => 0);

        $this->show('p_api',$data);
      }
    }

    public function post($param)
    { if(!empty($param))
      { if(!empty($param[2]) && $param[2]=='aduan')
        { if($this->postData('teks')!=null)
          { $adu = new Aduan();
            $adu->set('nomor_rekening',strrev($param[0]));
            $adu->set('teks_aduan',$this->postData('teks'));
            $adu->set('status','0');
            $this->Broker->save($adu);

            $data['enabled']  = 1;
            $data['response'] = array(
                "response" => "Aduan Telah Terkirim",
                "status" => 1
              );
            $this->show('p_api',$data);
          }
        }
        if(!empty($param[2]) && $param[2]=='token' && !empty($param[3]))
        { $pel = $this->Broker->findKey('Pelanggan',strrev($param[0]));
          $data['enabled']  = 1;
          if($pel->isiUlang($param[3]))
          { $this->Broker->save($pel);
            $data['response'] = array(
                "response" => "Berhasil Mengisi Pulsa Listrik",
                "status" => 1
              );
          }
          else
          { $data['response'] = array(
              "response" => "Gagal Isi Ulang Pulsa Listrik",
              "status" => 0
            );
          }
          $this->show('p_api',$data);
        }
        if(!empty($param[2]) && $param[2]=='meteran' && !empty($param[3]))
        { $pel = $this->Broker->findKey('Pelanggan',strrev($param[0]));
          if($pel->get('Meteran')!=null)
          { if($param[3]=='on') $pel->get('Meteran')->aktifkan();
            else if($param[3]=='off') $pel->get('Meteran')->nonAktifkan();
            $this->Broker->save($pel->get('Meteran'));
          }
        }
      }
    }
  }

?>
