<?php

class Broker
{ private $db;

  function __construct($classes)
  { $this->db = new Database();

    foreach ($classes as $class) {
      $this->begin($class);
    }
  }

  private function begin($class)
  { $data   = $this->db->getTable($class);
    $class  = ucfirst($class);
    $return = array();

    foreach($data as $value)
    { $origin = new $class();
      $attrs  = $origin->getProperty();

      foreach($attrs as $prop => $val)
      { if(is_object($val))
        { $attr1 = $this->db->attrib(strtolower($class));
          $attr2 = $this->db->attrib(strtolower($prop))[0];
          $keys  = $attr1[array_search($attr2,$attr1)];
          if(isset($this->{$prop}))
          { $objNew;
            $objNew = $this->findAttrib($prop,$keys,$origin->get($keys))[0];
            $origin->set($prop,$objNew);
          }
        }
        else if(is_array($val))
        { $objPrim = $this->db->attrib(strtolower($class))[0];
          $objData = $this->db->getSingle(strtolower($prop),$objPrim.'="'.$value[$objPrim].'"');
          $array = array();
          foreach ($objData as $v)
          { $objNew  = new $prop();
            $objNew->fill($v);
            $array[]=$objNew;
          }
          $origin->set($prop,$array);
        }
        else
        { $origin->set($prop,$value[$prop]);
        }
      }

      $return[] = $origin;
    }

    $this->{$class} = $return;
    return $return;
  }

  public function get($name)
  { $name = ucfirst($name);
    if(isset($this->{$name})){
      return $this->{$name};
    }
    else return null;
  }

  public function findKey($class,$key)
  { $attr  = $this->db->attrib($class);
    $class = ucfirst($class);
    $iter  = $this->{$class};

    foreach ($iter as $one)
    { if($one->get($attr[0])==$key)
      { return $one;
         break;
      }
    }
    return null;
  }

  public function findAttrib($class,$key,$value)
  { $class = ucfirst($class);
    $return = array();
    $iter  = $this->{$class};

    foreach ($iter as $one)
    { if($value=='null' || $value=='NULL')
      { if(is_object($one->get($key)) && $one->{$key}==null) $return[]=$one;
        else if($one->get($key)=='NULL' || $one->get($key)==null) $return[]=$one;
      }
      else
      { if($one->get($key)==$value) $return[]=$one;
      }
    }

    if(!empty($return)) return $return;
    else return null;
  }

  public function save($objs)
  { if($objs!=null && is_object($objs))
    { $this->commit($objs);
      foreach ($objs->getProperty() as $attr)
      { $this->save($attr);
      }
    }
    else if(is_array($objs) && !empty($objs))
    { foreach($objs as $obj)
      { $this->save($obj);
      }
    }
  }

  private function commit($obj)
  { $attrb = $this->db->attrib(strtolower(get_class($obj)));
    $value = array();

    foreach($attrb as $attr) {
      $value[$attr] = $obj->get($attr);
    }

    return $this->db->insertUpdate(strtolower(get_class($obj)),$value);
  }

  public function delete($obj)
  { $table = strtolower(get_class($obj));
    $prim  = $this->db->attrib($table)[0];
    $key   = $obj->get($prim);

    return $this->db->delSingle($table,$prim.' = "'.$key.'"');
  }

}

?>
