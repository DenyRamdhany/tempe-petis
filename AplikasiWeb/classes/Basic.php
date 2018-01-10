<?php

  /**
   * basic class, isinya getter, setter, dan beberapa hal basic lainnya
   */
  class Basic
  {
    public function getProperty()
    { return get_object_vars($this);
    }

    public function getBehaviour()
    { return get_class_method($this);
    }

    public function get($name)
    { if(isset($this->{$name})){
        return $this->{$name};
      }
      else return null;
    }

    public function set($name,$value)
    { $this->{$name}=$value;
    }

    public function fill($attrib)
    { if (isset($attrib)) {
        foreach($attrib as $key => $value) {
          $this->{$key}=$value;
        }
      }
    }

  }
?>
