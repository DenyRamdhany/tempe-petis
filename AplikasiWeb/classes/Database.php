<?php

  class Database
  { private $dbServer = 'localhost';
    private $dbDriver = 'mysql';
    private $dbName   = 'jabanin_petis';
    private $dbUser   = 'jabanin_petis';
    private $dbPass   = 'dancenanta';
    private $conn;

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

    public function replace($table,$values)
    { if($this->open())
      { $key   = array_keys($values);
        $val   = array_values($values);
        $field = implode(',',$key);
        $bind  = str_repeat("?,",count($key)-1);

        try {
          $sql = 'REPLACE INTO '.$table." ($field) VALUES ($bind?)";
          $this->conn->prepare($sql)->execute($val);
          return true;
        }
        catch(PDOException $e){
          return $e->getMessage();
        }

        $this->close();
      }
    }

    public function insertUpdate($table,$values)
    { if($this->open())
      { $key   = array_keys($values);
        $val   = array_values($values);
        $field = implode(',',$key);
        $bind  = str_repeat("?,",count($key)-1);

        $updte = array();
        foreach ($key as $k => $v) {
          if($val[$k]==null) $updte[]=$v.' = NULL';
          else $updte[]=$v.' = "'.$val[$k].'"';
        }
        $updte=implode(',',$updte);

        try {
          $sql = 'INSERT INTO '.$table." ($field) VALUES ($bind?)";
          $sql.=" ON DUPLICATE KEY UPDATE ".$updte;
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

    public function getSingle($table,$val)
    { if($this->open())
      { $sql = 'SELECT * FROM '.$table.' WHERE '.$val;;
        $res = $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        $this->close();
        return $res;
      }
    }

    public function getInnerJoin($table1,$table2,$id)
    { if($this->open())
      { $sql = 'SELECT * FROM '.$table1.' INNER JOIN '.$table2.' ON '.$table1.'.'.$id.' = '.$table2.'.'.$id;
        $res = $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        $this->close();
        return $res;
      }
    }

    public function getLeftJoin($table1,$table2,$id)
    { if($this->open())
      { $sql = 'SELECT * FROM '.$table1.' LEFT JOIN '.$table2.' ON '.$table1.'.'.$id.' = '.$table2.'.'.$id;
        $res = $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        $this->close();
        return $res;
      }
    }

    public function getRightJoin($table1,$table2,$id,$isnull=0)
    { if($this->open())
      { $nul=' IS NOT NULL';
        if($isnull==1) $nul=' IS NULL';

        $sql = 'SELECT * FROM '.$table1.' RIGHT JOIN '.$table2.' ON '.$table1.'.'.$id.' = '.$table2.'.'.$id.' WHERE '.$table1.'.'.$id.' '.$nul;

        $res = $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        $this->close();
        return $res;
      }
    }

    public function delSingle($table,$val)
    { if($this->open())
      { try {
          $sql = 'DELETE FROM '.$table.' WHERE '.$val;
          $this->conn->prepare($sql)->execute();
          return true;
        }
        catch(PDOException $e){
          return false;
        }

        $this->close();
      }
    }

    public function attrib($table)
    { if($this->open())
      { $return = array();
        try {
          $res = $this->conn->query('DESCRIBE '.$table)->fetchAll(PDO::FETCH_ASSOC);
          foreach ($res as $value) {
            if($value['Key']=="PRI")
               array_unshift($return,$value['Field']);
            else $return[]=$value['Field'];
          }
          return $return;
        }
        catch(PDOException $e){
          return $e;
        }
        $this->close();
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
