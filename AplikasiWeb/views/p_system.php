<?php
  require_once("include.php");
  require_once("navbar.php");
  $this->debug();
?>

<br>
<div class="container-fluid">
  <div class="row">

    <div class="col-lg-7">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <div class="row">
            <div class="col-xs-8 text-left">
              <a onclick="resize('panelPelanggan');" class="btn btn-primary btn-xs"><i class="fa fa-compress"></i></a> &nbsp;
              <i class="fa fa-group"></i> &nbsp; Data Pelanggan
            </div>
            <div class="col-xs-4 text-right">
              <a onclick="tambahPelanggan();" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Tambah Pelanggan"><i class="fa fa-plus"></i></a>
            </div>
          </div>
        </div>
        <div id="panelPelanggan" class="panel-body">
          <table id="tblPelanggan" width="100%" class="table table-striped table-bordered table-hover">
            <thead>
              <th width="15%">No Rekening</th>
              <th width="15%">Nomor Meter</th>
              <th width="10%">Golongan</th>
              <th width="20%">Atas Nama</th>
              <th>Alamat</th>
              <th width="8%"></th>
            </thead>
            <tbody>
              <?php
                foreach ($pelanggan as $pel) {
                  if($pel->get('Meteran')!=null) echo "<tr>";
                  else echo "<tr class=text-danger>";
                    echo "<td>".$pel->get('nomor_rekening')."</td>";

                    if($pel->get('Meteran')!=null) echo "<td>".$pel->get('Meteran')->get('no_meter')."</td>";
                    else echo "<td></td>";

                    if($pel->get('Meteran')!=null) echo "<td>".$pel->get('Meteran')->get('id_golongan')."</td>";
                    else echo "<td></td>";

                    echo "<td>".$pel->get('nama')."</td>";
                    echo "<td>".$pel->get('alamat')."</td>";
                    echo '<td><center>
                      <a href="#" onClick="editPelanggan(\''.$pel->get('nomor_rekening').'\')" ><i class="fa fa-fw fa-pencil fa-lg text-success" data-toggle="tooltip" title="Lihat/Ubah"></i></a>';
                      if($pel->get('Meteran')!=null)
                      { if($pel->get('Meteran')->get('status'))
                        echo '<a href="#" onClick="editMeteran(\''.$pel->get('Meteran')->get('no_meter').'\')" ><i class="fa fa-fw fa-power-off fa-lg text-success" data-toggle="tooltip" title="Lihat/Ubah Meteran"></i></a>';
                        else
                        echo '<a href="#" onClick="editMeteran(\''.$pel->get('Meteran')->get('no_meter').'\')" ><i class="fa fa-fw fa-power-off fa-lg text-danger" data-toggle="tooltip" title="Lihat/Ubah Meteran"></i></a>';

                      }

                    echo '</center></td>';
                  echo "</tr>";
                }
              ?>
            </tbody>
          </table>
        </div>
        <div class="panel-footer">
          <div class="text-left">
            <span class="text-danger">Merah</span> : Belum memiliki meteran listrik<br>
            <i class="fa fa-fw fa-power-off text-success"></i> : Meteran Aktif<br>
            <i class="fa fa-fw fa-power-off text-danger"></i> : Meteran Non-Aktif
          </div>
        </div>
      </div>

      <div class="panel panel-info">
        <div class="panel-heading">
          <div class="row">
            <div class="col-xs-8 text-left">
              <a onclick="resize('panelHistory');" class="btn btn-info btn-xs"><i class="fa fa-compress"></i></a> &nbsp;
              <i class="fa fa-list"></i> &nbsp; History Pembelian Token
            </div>
          </div>
        </div>
        <div id="panelHistory" class="panel-body">
          <table id="tblHistory" width="100%" class="table table-striped table-bordered table-hover">
            <thead>
              <th>No</th>
              <th>No Rekening</th>
              <th>Tanggal Bayar</th>
              <th>No Token</th>
              <th>Nominal</th>
            </thead>
            <tbody>
              <?php
              $c=1;
                foreach ($history as $tok) {
                  if(!$tok->get('status')) echo "<tr class=text-danger>";
                  else echo "<tr class=text-success>";
                    echo "<td>".$c++."</td>";
                    echo "<td>".$tok->get('nomor_rekening')."</td>";
                    echo "<td>".date("l, d-M-Y H:i",strtotime($tok->get('tgl_beli')))."</td>";

                    $token  = str_split(strrev($tok->get('no_token')),4);
                    $tokens = "";
                    foreach ($token as $one) {
                      if($one==$token[count($token)-1]) $tokens.=$one;
                      else $tokens.=$one.'-';
                    }
                    $tokens=strrev($tokens);
                    echo "<td>$tokens</td>";

                    $noms = str_split(strrev($tok->get('nominal')),3);
                    $nominal = "";
                    foreach ($noms as $nom) {
                      $nominal.=$nom.' ';
                    }
                    $nominal=strrev($nominal);
                    echo "<td>Rp.$nominal</td>";
                  echo "</tr>";
                }
              ?>
            </tbody>
          </table>
        </div>
        <div class="panel-footer">
          <div class="text-left">
            <span class="text-success">Hijau</span> &nbsp; : Token belum digunakan<br>
            <span class="text-danger">Merah</span>&nbsp;: Token sudah digunakan<br>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-5">
      <div class="panel panel-green">
        <div class="panel-heading">
          <div class="row">
            <div class="col-xs-8 text-left">
              <a onclick="resize('panelGolongan');" class="btn btn-success btn-xs"><i class="fa fa-compress"></i></a> &nbsp;
              <i class="fa fa-list-alt"></i> &nbsp; Daftar Golongan
            </div>
            <div class="col-xs-4 text-right">
              <a onclick="tambahGolongan();" class="btn btn-success btn-xs" data-toggle="tooltip" title="Tambah Golongan"><i class="fa fa-plus"></i></a>
            </div>
          </div>
        </div>
        <div id="panelGolongan" class="panel-body">
          <table id="tblGolongan" width="100%" class="table table-striped table-bordered table-hover">
            <thead>
              <th>Kode</th>
              <th>Golongan</th>
              <th>Harga perKWH</th>
              <th></th>
            </thead>
            <tbody>
              <?php
                foreach ($golongan as $gol) {
                  echo "<tr>";
                    echo "<td>".$gol->get('id_golongan')."</td>";
                    echo "<td>".$gol->get('nama_gol')."</td>";
                    echo "<td>Rp. ".$gol->get('tarif_dasar')."</td>";
                    echo '<td><center>
                      <a href="#" onClick="editGolongan(\''.$gol->get('id_golongan').'\')"><i class="fa fa-fw fa-pencil fa-lg text-success" data-toggle="tooltip" title="Lihat/Ubah"></i></a><a href="#" onClick="delGolongan(\''.$gol->get('id_golongan').'\')"><i class="fa fa-fw fa-trash-o fa-lg text-danger" data-toggle="tooltip" title="Hapus"></i></a></center></td>';
                  echo "</tr>";
                }
              ?>
            </tbody>
          </table>
        </div>
        <div class="panel-footer">
          <div class="text-left">
            <span class="text-danger">Keterangan: </span>
          </div>
        </div>
      </div>

      <div class="panel panel-yellow">
        <div class="panel-heading">
          <div class="row">
            <div class="col-xs-8 text-left">
              <a onclick="resize('panelMeteran');" class="btn btn-warning btn-xs"><i class="fa fa-compress"></i></a> &nbsp;
              <i class="fa fa-group"></i> &nbsp; Daftar Meteran
            </div>
            <div class="col-xs-4 text-right">
              <a onclick="tambahMeteran();" class="btn btn-warning btn-xs" data-toggle="tooltip" title="Tambah Meteran"><i class="fa fa-plus"></i></a>
            </div>
          </div>
        </div>
        <div id="panelMeteran" class="panel-body">
          <table id="tblMeteran" width="100%" class="table table-striped table-bordered table-hover">
            <thead>
              <th>Nomor Meter</th>
              <th>Golongan</th>
              <th></th>
            </thead>
            <tbody>
              <?php
                foreach ($meteran as $val) {
                  if($val->get('status')) echo "<tr>";
                  else echo "<tr class=text-danger>";
                    echo "<td>".$val->get('no_meter')."</td>";
                    echo "<td>".$val->get('Golongan')->get('nama_gol')."</td>";
                    echo '<td><center>
                      <a href="#" onClick="editMeteran(\''.$val->get('no_meter').'\')" ><i class="fa fa-fw fa-pencil fa-lg text-success" data-toggle="tooltip" title="Lihat/Ubah"></i></a><a href="#" onClick="delMeteran(\''.$val->get('no_meter').'\')"><i class="fa fa-fw fa-trash-o fa-lg text-danger" data-toggle="tooltip" title="Hapus"></i></a></center></td>';
                  echo "</tr>";
                }
              ?>
            </tbody>
          </table>
        </div>
        <div class="panel-footer">
          <div class="text-left">
            <span class="text-danger">Merah</span> : Meteran Non-aktif
          </div>
        </div>
      </div>

      <div class="panel panel-danger">
        <div class="panel-heading">
          <div class="row">
            <div class="col-xs-8 text-left">
              <a onclick="resize('panelAduan');" class="btn btn-danger btn-xs"><i class="fa fa-compress"></i></a> &nbsp;
              <i class="fa fa-exclamation-triangle"></i> &nbsp; Daftar Aduan
            </div>
          </div>
        </div>
        <div id="panelAduan" class="panel-body">
          <table id="tblAduan" width="100%" class="table table-striped table-bordered table-hover">
            <thead>
              <th width="5%">No</th>
              <th width="20%">Pengirim</th>
              <th>Problem</th>
              <th width="10%"></th>
            </thead>
            <tbody>
              <?php
              $coun = 1;
                foreach ($aduan as $val) {
                  echo "<tr>";
                    echo "<td><center>".$coun++."</center></td>";
                    echo "<td>".$val->get('nomor_rekening')."</td>";
                    echo "<td>".$val->get('teks_aduan')."</td>";
                    if($val->get('status'))
                      echo '<td><center>
                        <a href="#"><i class="fa fa-fw fa-check fa-lg text-success" data-toggle="tooltip" title="Selesai"></i></a></center></td>';
                    else
                      echo '<td><center>
                        <a href="#" onClick="editAduan(\''.$val->get('no_aduan').'\')" ><i class="fa fa-fw fa-exclamation-triangle fa-lg text-danger" data-toggle="tooltip" title="Tanggapi"></i></a></center></td>';
                  echo "</tr>";
                }
              ?>
            </tbody>
          </table>
        </div>
        <div class="panel-footer">
          <div class="text-left">
            <i class="fa fa-fw fa-check fa-lg text-success"></i>&nbsp;: Sudah Ditanggapi<br>
            <i class="fa fa-fw fa-exclamation-triangle text-danger"></i>&nbsp;&nbsp;: Belum Ditanggapi
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

<!-- MODAL -->
<div class="modal fade col-lg-8 col-lg-offset-2" id="modalPelanggan">
  <br>
  <div class="modal-content">
    <div class="row">
      <div class="col-lg-10 col-lg-offset-1">
        <div class="modal-body">
          <h2 id="modalPlgJudul"></h2>
          <br>
          <div class="row">
            <form class="form-horizontal col-sm-12" action="<?php echo $this->getURL()."system/add/"; ?>" method="post">
              <div class="form-group">
                <label class="control-label col-sm-2" >No Rekening</label>
                <div class="col-sm-8">
                  <input type="hidden" name="table" class="form-control" value="pelanggan">
                  <input readonly id="modalPlgRek" type="text" name="nomor_rekening" placeholder="Nomor Rekening" class="form-control" required>
                </div>
                <div class="col-sm-2 text-right">
                  <input id="modalPlgGenBtn" onClick="generateMeter()" type="button" value="Generate" class="btn btn-primary" required>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2" >Nomor Meter</label>
                <div class="col-sm-10">
                  <select  id="modalPlgMeter" class="form-control" name="no_meter">
                    <option value='null' selected>Belum Terdaftar</option>
                    <?php
                      foreach ($meteranKosong as $meter) {
                        echo '<option value="'.$meter->get('no_meter').'">'.$meter->get('no_meter').' - '.$meter->get('id_golongan').'</option>';
                      }

                    ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2" >Atas Nama</label>
                <div class="col-sm-10">
                  <input id="modalPlgNama" type="text" name="nama" placeholder="Nama Pemilik" class="form-control" required>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2" >Nomor Telepon</label>
                <div class="col-sm-10">
                  <input id="modalPlgTlp" type="text" name="no_tlp" placeholder="Nomor Telepon" class="form-control" required>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2" >Email</label>
                <div class="col-sm-10">
                  <input id="modalPlgMail" type="text" name="email" placeholder="Alamat Email" class="form-control" required>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2" >Alamat</label>
                <div class="col-sm-10">
                  <input id="modalPlgAddr" type="text" name="alamat" placeholder="Alamat Rumah" class="form-control" required>
                </div>
              </div>
              <div class="text-right">
                <br>
                <input type="submit" value="Save" class="btn btn-success">
                <input id="modalPlgDeleteBtn" type="button" value="Delete" class="btn btn-danger">
                <input type="button" value="Close" class="btn btn-warning" data-dismiss="modal">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade col-lg-8 col-lg-offset-2" id="modalGolongan">
  <br>
  <div class="modal-content">
    <div class="row">
      <div class="col-lg-10 col-lg-offset-1">
        <div class="modal-body">
          <h2 id="modalGolJudul"></h2>
          <br>
          <div class="row">
            <form class="form-horizontal col-sm-12" action="<?php echo $this->getURL()."system/add/"; ?>" method="post">
              <div class="form-group">
                <label class="control-label col-sm-3" >Kode Golongan</label>
                <div class="col-sm-9">
                  <input type="hidden" name="table" class="form-control" value="golongan">
                  <input id="modalGolId" type="text" name="id_golongan" class="form-control" required>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-3" >Nama Golongan</label>
                <div class="col-sm-9">
                  <input id="modalGolNama" type="text" name="nama_gol" class="form-control" required>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-3" >Harga Per-KWH</label>
                <div class="col-sm-9">
                  <input id="modalGolHarga" type="number" step=".01" name="tarif_dasar" class="form-control" required>
                </div>
              </div>
              <div class="text-right">
                <br>
                <input type="submit" value="Save" class="btn btn-success">
                <input type="button" value="Close" class="btn btn-warning" data-dismiss="modal">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade col-lg-8 col-lg-offset-2" id="modalMeteran">
  <br>
  <div class="modal-content">
    <div class="row">
      <div class="col-lg-10 col-lg-offset-1">
        <div class="modal-body">
          <h2 id="modalMtrJudul"></h2>
          <br>
          <div class="row">
            <form class="form-horizontal col-sm-12" action="<?php echo $this->getURL()."system/add/"; ?>" method="post">
              <div class="form-group">
                <label class="control-label col-sm-3" >No Meter</label>
                <div class="col-sm-9">
                    <input type="hidden" name="table" class="form-control" value="meteran">
                    <input id='modalMtrRek' type="hidden" name="nomor_rekening" class="form-control" value="NULL">
                  <input id="modalMtrId" type="text" name="no_meter" placeholder="Nomor ID Meteran" class="form-control" required>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-3" >Golongan</label>
                <div class="col-sm-9">
                  <select  id="modalMtrGol" class="form-control" name="id_golongan">
                    <?php
                      foreach ($golongan as $gol) {
                        echo '<option value="'.$gol->get('id_golongan').'">'.$gol->get('id_golongan').' - '.$gol->get('nama_gol').'</option>';
                      }
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-3" >Sisa KWH</label>
                <div class="col-sm-9">
                  <input id="modalMtrKwh" type="text" name="sisa_kwh" value="0" class="form-control" required>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-3" >Status</label>
                <div class="col-sm-9">
                  <input type="radio"  name="status" class="" value="1">&nbsp; Hidup
                  <br>
                  <input type="radio"  name="status" class="" value="0" checked>&nbsp; Mati

                </div>
              </div>
              <div class="text-right">
                <br>
                <input type="submit" value="Save" class="btn btn-success">
                <input type="button" value="Close" class="btn btn-warning" data-dismiss="modal">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
  var today = "<?php echo date('d-m-Y'); ?>";
  var tomoro = "<?php echo date('d-m-Y',strtotime(date('d-m-Y')."+1 days")); ?>";

  var tblPelanggan = "";
  var tblGolongan  = "";
  var tblMeteran   = "";
  var tblHistory   = "";
  var tblAduan   = "";

  $(document).ready(function() {
    $('.panel-body').slideUp();

    if(localStorage['panelPelanggan']==1) $("#panelPelanggan").slideDown();
    if(localStorage['panelGolongan']==1) $("#panelGolongan").slideDown();
    if(localStorage['panelMeteran']==1) $("#panelMeteran").slideDown();
    if(localStorage['panelHistory']==1) $("#panelHistory").slideDown();
    if(localStorage['panelAduan']==1) $("#panelAduan").slideDown();

    tblPelanggan=$('#tblPelanggan').DataTable({
        "responsive": {details: false},
        "aLengthMenu": [[5, 10, 25, -1], [5, 10, 25, "All"]]
    });

    tblGolongan=$('#tblGolongan').DataTable({
        "responsive": {details: false},
        "aLengthMenu": [[5, 10, 25, -1], [5, 10, 25, "All"]]
    });

    tblMeteran=$('#tblMeteran').DataTable({
        "responsive": {details: false},
        "aLengthMenu": [[5, 10, 25, -1], [5, 10, 25, "All"]]
    });

    tblHistory=$('#tblHistory').DataTable({
        "responsive": {details: false},
        "aLengthMenu": [[5, 10, 25, -1], [5, 10, 25, "All"]]
    });

    tblAduan=$('#tblAduan').DataTable({
        "responsive": {details: false},
        "aLengthMenu": [[5, 10, 25, -1], [5, 10, 25, "All"]]
    });

  });

  function resize(section) {
    if(localStorage[section]==1)
      { $("#"+section).slideUp();
        localStorage[section]=0;
      }
    else { $("#"+section).slideDown();
           localStorage[section]=1;
         }
  }

  //buat tabel pelanggan
  function tambahPelanggan() {
    $('#modalPlgJudul').html("Tambah Pelanggan");
    $("#modalPlgDeleteBtn").hide();
    $("#modalPlgGenBtn").show();
    $("#modalPlgRek").val("");
    $("#appended").remove();
    $("#modalPlgMeter").val('null');
    $("#modalPlgNama").val("");
    $("#modalPlgTlp").val("");
    $("#modalPlgMail").val("");
    $("#modalPlgAddr").val("");

    $('#modalPelanggan').modal('show');
  }

  function generateMeter() {
    $.post(url+"system/randomRekening", function(data) {
      $("#modalPlgRek").val(data);
    });
  }
  function editPelanggan(id) {
    $.post(url+"system/detail",{table:'pelanggan',key:id}, function(data) {
      var val = JSON.parse(data);
      $('#modalPlgJudul').html("Edit Pelanggan");
      $("#modalPlgDeleteBtn").show();
      $("#modalPlgDeleteBtn").attr('onClick','delPelanggan(\''+val.nomor_rekening+'\')');

      $("#modalPlgGenBtn").hide();
      $("#modalPlgRek").val(val.nomor_rekening);

      $("#appended").remove();
      if(val.Meteran==null) $("#modalPlgMeter").val('null');
      else $("#modalPlgMeter").append('<option id="appended" value="'+val.Meteran.no_meter+'"selected>'+val.Meteran.no_meter+' - '+val.Meteran.id_golongan+'</option>');

      $("#modalPlgNama").val(val.nama);
      $("#modalPlgTlp").val(val.no_tlp);
      $("#modalPlgMail").val(val.email);
      $("#modalPlgAddr").val(val.alamat);
    });

    $('#modalPelanggan').modal('show');
  }
  function delPelanggan(id) {
    if (confirm("Hapus pelanggan "+id+"?")) {
      $.post(url+"system/delete",{table:'pelanggan',key:id}, function(data) {

        if(data=="1") alert('Berhasil Dihapus');
        else alert("Gagal Hapus");

        location.reload();
      });
    }
  }


  // buat tabel golongan
  function tambahGolongan() {
    $('#modalGolJudul').html("Tambah Golongan");
    $("#modalGolId").val("");
    $("#modalGolNama").val("");
    $("#modalGolHarga").val("");

    $('#modalGolongan').modal('show');
  }
  function editGolongan(id) {
    $.post(url+"system/detail",{table:'golongan',key:id}, function(data) {
      var val = JSON.parse(data);
      $('#modalGolJudul').html("Edit Golongan");
      $("#modalGolId").val(val.id_golongan);
      $("#modalGolNama").val(val.nama_gol);
      $("#modalGolHarga").val(val.tarif_dasar);
    });

    $('#modalGolongan').modal('show');
  }
  function delGolongan(id) {
    if (confirm("Hapus golongan "+id+"?")) {
      $.post(url+"system/delete",{table:'golongan',key:id}, function(data) {
        if(data=="1") alert('Berhasil Dihapus');
        else alert("Gagal Hapus");

        location.reload();
      });
    }
  }


  // buat tabel meteran
  function tambahMeteran() {
    $('#modalMtrJudul').html("Tambah Meteran");
    $('#modalMtrId').val("");
    $('#modalMtrKwh').val("0");
    $('input:radio[name=status]').filter('[value=0]').prop('checked',true);

    $('#modalMeteran').modal('show');
  }
  function editMeteran(id) {
    $.post(url+"system/detail",{table:'meteran',key:id}, function(data) {
      var val = JSON.parse(data);
      $('#modalMtrJudul').html("Edit Meteran");
      $('#modalMtrId').val(val.no_meter);
      $('#modalMtrRek').val(val.nomor_rekening);
      $('#modalMtrGol').val(val.id_golongan);
      $('#modalMtrKwh').val(val.sisa_kwh);
      $('input:radio[name=status]').filter('[value='+val.status+']').prop('checked',true);
    });

    $('#modalMeteran').modal('show');
  }
  function delMeteran(id) {
    if (confirm("Hapus meteran "+id+"?")) {
      $.post(url+"system/delete",{table:'meteran',key:id}, function(data) {
        if(data=="1") alert('Berhasil Dihapus');
        else alert("Gagal Hapus");

        location.reload();
      });
    }
  }

  function editAduan(id) {
    if (confirm("Aduan telah diselesaikan?")) {
      $.post(url+"system/resolve",{key:id}, function(data) {
        if(data=="1") alert('Selesai');
        else alert("Gagal");

        location.reload();
      });
    }
  }

</script>
