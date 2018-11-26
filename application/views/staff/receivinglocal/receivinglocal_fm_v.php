<?php
  $count_receivinglocal = $this->db->query("SELECT * FROM tb_receivinglocal ORDER BY kd_receivinglocal DESC LIMIT 1");
 foreach($count_receivinglocal->result() as $i){
  $datakode = $i->kd_receivinglocal;
 }
  if (!empty($datakode)) {
      //$nilaikode = substr($datakode[0], 1);
      $kode = (int) $datakode;
      $kode = $kode + 1;
      $hasilkode = str_pad($kode, 3, "0", STR_PAD_LEFT);
  }else {
      $hasilkode = "001";
  }

  //var_dump($hasilkode)
?>

<div class="box box-info">
  <div class="box-header">
    <h3 class="box-title">Form Receiving Local</h3>
  </div>
  <div class="box-body">
  <form action="<?php echo base_url() ?>Staff/inc_receivinglocal" method="post">
    <div class="form-group">
      <label>Kode Receiving Local :</label>
      <input type="text" name="kd_txt" value="<?php echo $hasilkode ?>" id="kd" class="form-control" placeholder="Kode Receiving Local" readonly>
    </div>
    <div class="form-group">
      <label>Part Number :</label>
      <input type="text" name="pn_txt" id="pn" class="form-control" placeholder="Part Number" autofocus>
    </div>
    <input type="hidden" name="act" id="act">
    <button type="submit" class="btn btn-primary"><i class="fa fa-save fa-fw"></i> Simpan</button>
    <button type="reset" id="reset" class="btn btn-default"><i class="fa fa-refresh fa-fw"></i></button>
  </div>
  </form>
</div>
