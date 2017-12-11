<?php
  require_once("include.php");
  require_once("navbar.php");
  //$this->debug($pelanggan);
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
                  if(!empty($pel['no_meter'])) echo "<tr>";
                  else echo "<tr class=text-danger>";
                    echo "<td>$pel[no_rek_listrik]</td>";

                    if(!empty($pel['no_meter'])) echo "<td>$pel[no_meter]</td>";
                    else echo "<td></td>";

                    if(!empty($pel['no_meter'])) echo "<td>$pel[id_golongan]</td>";
                    else echo "<td></td>";

                    echo "<td>$pel[nama]</td>";
                    echo "<td>$pel[alamat]</td>";
                    echo '<td><center>
                      <a href="#" onClick="editPelanggan(\''.$pel['no_rek_listrik'].'\')" id="edit"><i class="fa fa-fw fa-pencil fa-lg text-success" data-toggle="tooltip" title="Lihat/Ubah"></i></a>';
                      if(!empty($pel['no_meter']))
                      { if($pel['status'])
                        echo '<a href="#" onClick="editMeteran(\''.$pel['no_meter'].'\')" id="edit"><i class="fa fa-fw fa-power-off fa-lg text-success" data-toggle="tooltip" title="Lihat/Ubah Meteran"></i></a>';
                        else
                        echo '<a href="#" onClick="editMeteran(\''.$pel['no_meter'].'\')" id="edit"><i class="fa fa-fw fa-power-off fa-lg text-danger" data-toggle="tooltip" title="Lihat/Ubah Meteran"></i></a>';

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
                    echo "<td>$gol[id_golongan]</td>";
                    echo "<td>$gol[nama_golongan]</td>";
                    echo "<td>Rp. $gol[harga_perkwh]</td>";
                    echo '<td><center>
                      <a href="#" onClick="editGolongan(\''.$gol['id_golongan'].'\')"><i class="fa fa-fw fa-pencil fa-lg text-success" data-toggle="tooltip" title="Lihat/Ubah"></i></a><a href="#" onClick="delGolongan(\''.$gol['id_golongan'].'\')"><i class="fa fa-fw fa-trash-o fa-lg text-danger" data-toggle="tooltip" title="Hapus"></i></a></center></td>';
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
                  if($val['status']) echo "<tr>";
                  else echo "<tr class=text-danger>";
                    echo "<td>$val[no_meter]</td>";
                    echo "<td>$val[nama_golongan]</td>";
                    echo '<td><center>
                      <a href="#" onClick="editMeteran(\''.$val['no_meter'].'\')" id="edit"><i class="fa fa-fw fa-pencil fa-lg text-success" data-toggle="tooltip" title="Lihat/Ubah"></i></a><a href="#" onClick="delMeteran(\''.$val['no_meter'].'\')"><i class="fa fa-fw fa-trash-o fa-lg text-danger" data-toggle="tooltip" title="Hapus"></i></a></center></td>';
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
            <form class="form-horizontal col-sm-12" action="<?php echo $this->getURL()."system/addPelanggan/"; ?>" method="post">
              <div class="form-group">
                <label class="control-label col-sm-2" >No Rekening</label>
                <div class="col-sm-8">
                  <input readonly id="modalPlgRek" type="text" name="no_rek_listrik" placeholder="Nomor Rekening" class="form-control" required>
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
                        echo '<option value="'.$meter['no_meter'].'">'.$meter['no_meter'].' - '.$meter['id_golongan'].'</option>';
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
            <form class="form-horizontal col-sm-12" action="<?php echo $this->getURL()."system/addGolongan/"; ?>" method="post">
              <div class="form-group">
                <label class="control-label col-sm-3" >Kode Golongan</label>
                <div class="col-sm-9">
                  <input id="modalGolId" type="text" name="id_golongan" class="form-control" required>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-3" >Nama Golongan</label>
                <div class="col-sm-9">
                  <input id="modalGolNama" type="text" name="nama_golongan" class="form-control" required>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-3" >Harga Per-KWH</label>
                <div class="col-sm-9">
                  <input id="modalGolHarga" type="number" step=".01" name="harga_perkwh" class="form-control" required>
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
            <form class="form-horizontal col-sm-12" action="<?php echo $this->getURL()."system/addMeteran/"; ?>" method="post">
              <div class="form-group">
                <label class="control-label col-sm-3" >No Meter</label>
                <div class="col-sm-9">
                  <input id="modalMtrId" type="text" name="no_meter" placeholder="Nomor ID Meteran" class="form-control" required>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-3" >Golongan</label>
                <div class="col-sm-9">
                  <select  id="modalMtrGol" class="form-control" name="id_golongan">
                    <?php
                      foreach ($golongan as $gol) {
                        echo '<option value="'.$gol['id_golongan'].'">'.$gol['id_golongan'].' - '.$gol['nama_golongan'].'</option>';
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
  var tblGolongan = "";
  var tblMeteran = "";

  $(document).ready(function() {
    $('.panel-body').slideUp();

    if(localStorage['panelPelanggan']==1) $("#panelPelanggan").slideDown();
    if(localStorage['panelGolongan']==1) $("#panelGolongan").slideDown();
    if(localStorage['panelMeteran']==1) $("#panelMeteran").slideDown();

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

    $('.datepicker').datetimepicker({
      format: "DD-MM-YYYY"
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
    $.post(url+"system/detailPelanggan",{no_rek_listrik:id}, function(data) {
      var val = JSON.parse(data)[0];
      $('#modalPlgJudul').html("Edit Pelanggan");
      $("#modalPlgDeleteBtn").show();
      $("#modalPlgDeleteBtn").attr('onClick','delPelanggan(\''+val.no_rek_listrik+'\')');

      $("#modalPlgGenBtn").hide();
      $("#modalPlgRek").val(val.no_rek_listrik);

      $("#appended").remove();
      if(val.no_meter==null) $("#modalPlgMeter").val('null');
      else $("#modalPlgMeter").append('<option id="appended" value="'+val.no_meter+'"selected>'+val.no_meter+' - '+val.id_golongan+'</option>');

      $("#modalPlgNama").val(val.nama);
      $("#modalPlgTlp").val(val.no_tlp);
      $("#modalPlgMail").val(val.email);
      $("#modalPlgAddr").val(val.alamat);
    });

    $('#modalPelanggan').modal('show');
  }
  function delPelanggan(id) {
    if (confirm("Hapus pelanggan "+id+"?")) {
      $.post(url+"system/delPelanggan",{no_rek_listrik:id}, function(data) {

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
    $.post(url+"system/detailGolongan",{id_golongan:id}, function(data) {
      var val = JSON.parse(data)[0];
      $('#modalGolJudul').html("Edit Golongan");
      $("#modalGolId").val(val.id_golongan);
      $("#modalGolNama").val(val.nama_golongan);
      $("#modalGolHarga").val(val.harga_perkwh);
    });

    $('#modalGolongan').modal('show');
  }
  function delGolongan(id) {
    if (confirm("Hapus golongan "+id+"?")) {
      $.post(url+"system/delGolongan",{id_golongan:id}, function(data) {

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
    console.log(id);
    $.post(url+"system/detailMeteran",{no_meter:id}, function(data) {
      console.log(data);
      var val = JSON.parse(data)[0];
      $('#modalMtrJudul').html("Edit Meteran");
      $('#modalMtrId').val(val.no_meter);
      $('#modalMtrGol').val(val.id_golongan);
      $('#modalMtrKwh').val(val.sisa_kwh);
      $('input:radio[name=status]').filter('[value='+val.status+']').prop('checked',true);
    });

    $('#modalMeteran').modal('show');
  }
  function delMeteran(id) {
    if (confirm("Hapus meteran "+id+"?")) {
      $.post(url+"system/delMeteran",{no_meter:id}, function(data) {

        if(data=="1") alert('Berhasil Dihapus');
        else alert("Gagal Hapus");

        location.reload();
      });
    }
  }

</script>
