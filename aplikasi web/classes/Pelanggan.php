<?php

  class Pelanggan
  { private $db;

    public function __construct()
    { $this->db = Init::Instance()->database;
    }

    public function addReplace($param)
    { if($param['no_meter']==='null') $param['no_meter']=null;

      $param['keylog']=hash('adler32',$param['no_rek_listrik'],FALSE);

      $this->db->replace('pelanggan',$param);
    }
    public function delPelanggan($param)
    { return $this->db->delSingle('pelanggan','no_rek_listrik="'.$param['no_rek_listrik'].'"');
    }

    public function getAll()
    { return $this->db->getTable('pelanggan');
    }

    public function getWithKey($key)
    { return $this->db->getSingle('pelanggan','keylog="'.$key.'"');
    }
    function reqOtp($id)
    { $case = $this->getDetail($id);
      if(count($case)==1)
      { $email = Init::Instance()->email;

        $str1  = time().$case[0]['no_rek_listrik'];
        $hash  = hexdec(hash('adler32',$str1,FALSE));
        $valid = strtotime(date('d-m-Y H:i:s'))+(12*3600);
        $query = array( 'id_otp' => null,
                        'no_rek_listrik' => $case[0]['no_rek_listrik'],
                        'password' => $hash,
                        'valid_until' => $valid
                      );

        $case2 = $this->db->query('SELECT * FROM OTP WHERE no_rek_listrik="'.$case[0]['no_rek_listrik'].'" AND valid_until>'.time().' ORDER BY id_otp DESC');

        if(count($case2)>0)
        {
          $email->send(array( 'mailTo'     => $case[0]['email'] ,
                              'senderName' => 'Tempe Petis',
                              'mailName'   => 'OTP Request',
                              'subject'    => 'OTP Request pada '.date('d-m-Y H:i:s'),
                              'body'       => 'Kode OTP Anda adalah<br>'.$case2[0]['password'].'<br>Berlaku hingga '.date('d-m-Y H:i:s',$case2[0]['valid_until'])
                            ));
        }
        else
        { $this->db->insert('OTP',$query);
          $email->send(array( 'mailTo'     => $case[0]['email'] ,
                                'senderName' => 'Tempe Petis',
                                'mailName'   => 'OTP Request',
                                'subject'    => 'OTP Request pada '.date('d-m-Y H:i:s'),
                                'body'       => 'Kode OTP Anda adalah<br>'.$query['password'].'<br>Berlaku hingga '.date('d-m-Y H:i:s',$query['valid_until'])
                              ));
        }

        return Array('response' => "OTP Telah Dikirim ke Email Anda");
      }
    }

    public function loginOtp($otp,$addr='')
    { $case1 = $this->db->query('SELECT * FROM OTP WHERE password="'.$otp.'" AND valid_until>'.time().' ORDER BY id_otp DESC');

      if(count($case1)>0)
      { $user = $this->getDetail($case1[0]['no_rek_listrik']);
        return Array( 'response' => "Selamat Datang, ".$user[0]['nama'],
                      'authkey' => $user[0]['keylog'],
                      'address' => $addr.'api/auth/'.$user[0]['keylog']
                    );
      }
      else return Array('response' => "OTP Tidak Valid!");
    }

    public function getDetail($id)
    { return $this->db->query('SELECT * FROM pelanggan LEFT JOIN meteran ON pelanggan.no_meter = meteran.no_meter WHERE no_rek_listrik="'.$id.'"');
    }

    public function getWithMeteran()
    { return $this->db->getLeftJoin('pelanggan','meteran','no_meter');
    }

  }


?>
