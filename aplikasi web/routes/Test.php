<?php

  class Test extends Page
  {

    function __construct()
    {
    }

    public function index()
    { $param = $this->dbase()->getTable('test');
      echo "<h2>".$param[0]['test']."</h2>";
      echo '<form action="'.$this->baseURL.$this->router."/test/send".'" method=POST>
              <input type=hidden name=test value=0>
              <input type=submit value=Mati>
            </form>
            <form action="'.$this->baseURL.$this->router."/test/send".'" method=POST>
              <input type=hidden name=test value=1>
              <input type=submit value=Nyala>
            </form>';
    }

    public function send()
    { $this->dbase()->query("UPDATE test SET test=".$this->postData()['test']." WHERE id=1");
      $this->redirect('test');
    }

    public function get()
    { $param = $this->dbase()->getTable('test');
      echo "{".$param[0]['test']."}";
    }
  }


?>
