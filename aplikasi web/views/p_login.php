<?php require_once("include.php"); ?>

  <body>
    <div class="container">
      <div class="row">
        <div class="col-md-4 col-md-offset-4">
          <div class="login-panel panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title">Login Petugas</h3>
            </div>
            <div class="panel-body">
              <form action="<?php echo $this->baseURL.$this->router."/front/login/"; ?>" method="post">
                <fieldset>
                  <div class="form-group">
                    <input type="text" name="username" placeholder="username" class="form-control" required autofocus>
                  </div>
                  <div class="form-group">
                    <input type="password" name="password" placeholder="password" class="form-control" required>
                  </div>
                  <div class="form-group text-center text-danger">
                    <?php echo $param['warn']; ?>
                  </div>
                  <input type="submit" name="submit" value="Login" class="btn btn-lg btn-success btn-block">
                </fieldset>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
