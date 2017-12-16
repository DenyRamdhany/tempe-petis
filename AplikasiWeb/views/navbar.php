<!-- Navigation -->
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?php echo $this->baseURL.$this->router; ?>">Panel Petugas</a>
    </div>

    <!-- Top Menu Items -->
    <ul class="nav navbar-right top-nav">
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>&nbsp; <?php echo $userData['nama']; ?><b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li>
                    <a href="#setting" data-toggle="modal"><i class="fa fa-fw fa-gear"></i> Settings</a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="<?php echo $this->baseURL,$this->router; ?>/front/logout"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                </li>
            </ul>
        </li>
    </ul>
</nav>


  <div class="modal fade col-lg-6 col-lg-offset-3" id="setting">
    <br>
    <div class="modal-content">
      <div class="row">
        <div class="col-lg-12">
          <div class="modal-body">
            <h2>Pengaturan akun</h2>
            <br>
            <form action="<?php echo $this->getURL()."front/setting/"; ?>" method="post">
              <div class="form-group">
                <label class="control-label col-sm-3" >Username</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="nname" value="Admin"  required>

                  <input type="hidden" class="form-control" name="oname" value="Admin">
                  <br>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-3">Old Password</label>
                <div class="col-sm-9">
                  <input type="password" name="opass" class="form-control" placeholder="Old Password Here" required>
                  <br>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-3">New Password</label>
                <div class="col-sm-9">
                  <input type="password" name="npass" class="form-control" placeholder="New Password Here" required>
                  <br>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-12 text-right">
                  <button type="submit" class="btn btn-success">Save</button>
                  <a data-dismiss="modal" class="btn btn-warning">Cancel</a>
                </div>
              </div>
            </form>
            <h4> &nbsp; </h4>
          </div>
        </div>
        </div>
    </div>
  </div>
