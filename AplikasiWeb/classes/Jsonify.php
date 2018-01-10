<?php

  class Jsonify
  { public function getJSON($obj,$exclude=array())
    { $attr = $obj->getProperty();
      $return = array();

      foreach ($attr as $key => $value)
      { if(!in_array($key,$exclude))
        { if(is_object($value))
          { if($value!=null) $return[$key] = $this->getJSON($value);
            else $return[$key]=null;
          }
          else if(is_array($value))
          { if(!empty($value))
            { foreach($value as $val)
              { $return[$key][] = $this->getJSON($val);
              }
            }
            else $return[$key] = array();
          }
          else $return[$key] = $value;
        }
      }
      return $return;
    }

  }

?>
