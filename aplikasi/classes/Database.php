<?php

  class Database
  { private $dbServer = 'localhost';
    private $dbDriver = 'mysql';
    private $dbName   = 'u780923786_psbo';
    private $dbUser   = 'u780923786_root';
    private $dbPass   = '@Tekom5050';
    private $conn;

    public function __construct()
    { //masih kosong
    }

    protected function open()
    { try {
          $this->conn = new PDO($this->dbDriver.":host=$this->dbServer;dbname=$this->dbName", $this->dbUser, $this->dbPass);
          $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          return true;
      }
      catch(PDOException $e){
        echo "Koneksi database gagal: " . $e->getMessage();
      }
    }

    protected function close()
    { $this->conn  = null;
    }

    public function insert($table,$values)
    { if($this->open())
      { $key   = array_keys($values);
        $val   = array_values($values);
        $field = implode(',',$key);
        $bind  = str_repeat("?,",count($key)-1);

        try {
          $sql = 'INSERT INTO '.$table." ($field) VALUES ($bind?)";
          $this->conn->prepare($sql)->execute($val);
          return true;
        }
        catch(PDOException $e){
          return $e->getMessage();
        }

        $this->close();
      }
    }

    public function getTable($table,$col = '*')
    { if($this->open())
      { $sql = 'SELECT '.$col.' FROM '.$table;
        $res = $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        $this->close();
        return $res;
      }
    }

    public function query($sql)
    { if($this->open())
      { try {
          $res = $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
          return $res;
        }
        catch(PDOException $e){
          return $e;
        }
        $this->close();
      }
    }

  }

?>
