<?php
  $count_receivingkd = $this->db->query("SELECT * FROM tb_receivingkd ORDER BY kd_receivingkd DESC LIMIT 1");
 foreach($count_receivingkd->result() as $i){
  $datakode = $i->kd_receivingkd;
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
    <h3 class="box-title">Form Receiving KD</h3>
  </div>
  <div class="box-body">
  <form action="<?php echo base_url() ?>Staff/inc_receivingkd" method="post">
    <div class="form-group">
      <label>Kode Receiving KD :</label>
      <input type="text" name="kd_txt" value="<?php echo $hasilkode ?>" id="kd" class="form-control" placeholder="Kode Receiving KD" readonly>
    </div>
    <div class="form-group">
      <label>Case No :</label>
      <input type="text" name="cn_txt" id="cn" class="form-control" placeholder="Case No" autofocus>
    </div>
    <div class="form-group">
      <label>Location :</label>
      <input type="text" name="loc_txt" id="loc" class="form-control" placeholder="Location">
    </div>
    <input type="hidden" name="act" id="act">
    <button type="submit" class="btn btn-primary"><i class="fa fa-save fa-fw"></i> Simpan</button>
    <button type="reset" id="reset" class="btn btn-default"><i class="fa fa-refresh fa-fw"></i></button>
  </div>
  </form>
</div>
