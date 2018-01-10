<?php

  class Pelanggan extends Basic
  { protected $nomor_rekening;
    protected $nama;
    protected $alamat;
    protected $no_tlp;
    protected $email;
    protected $Meteran;
    protected $Token;
    protected $Aduan;
    protected $Otp;

    public function __construct()
    { $this->Meteran = new Meteran();
      $this->Otp     = array();
      $this->Token   = array();
      $this->Aduan   = array();
    }

    public function requestPassword()
    { $newOtp;
      if($this->Meteran==null) return false;

      if(!empty($this->Otp))
      { usort($this->Otp, function($a, $b) {
              return $a->get('serial_id') < $b->get('serial_id');
        });

        if(($this->Otp[0]->get('tgl_valid')-strtotime("now"))>0)
        { $newOtp = $this->Otp[0];
        }
        else
        { $newOtp = new Otp();
          $newOtp->generatePassword($this->nomor_rekening);
        }
      }
      else
      { $newOtp = new Otp();
        $newOtp->generatePassword($this->nomor_rekening);
      }

      $newOtp->kirimEmail($this->email);
      return $newOtp;
    }

    public function login($password)
    { if($this->Meteran==null) return false;
      
      if(!empty($this->Otp))
      { usort($this->Otp, function($a, $b) {
              return $a->get('serial_id') < $b->get('serial_id');
        });

        if($this->Otp[0]->verifyPassword($password)) return true;
        else return false;
      }
      return false;
    }

    public function isiUlang($no_token)
    { $changed = false;
      if(!empty($this->Token) && !empty($this->Meteran))
      { foreach ($this->Token as $key => $token)
        { if($token->get('no_token')==$no_token)
          { $valid=$token->gunakanToken();
            if($valid)
            { $this->Meteran->tambahKuota($valid);
              $changed = true;
            }
            break;
          }
        }
      }
      return $changed;
    }

  }


?>
