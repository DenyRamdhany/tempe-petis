<?php

  class Token extends Basic
  { protected $no_token;
    protected $nomor_rekening;
    protected $tgl_beli;
    protected $nominal;
    protected $status;

    public function gunakanToken()
    { if($this->status)
      { $this->set('status','0');
        return $this->nominal;
      }
      else return false;
    }
  }


?>
