<?php
  $count_cyclecount = $this->db->query("SELECT * FROM tb_cyclecount ORDER BY kd_cyclecount DESC LIMIT 1");
 foreach($count_cyclecount->result() as $i){
  $datakode = $i->kd_cyclecount;
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
    <h3 class="box-title">Form Cycle Count</h3>
  </div>
  <div class="box-body">
  <form action="<?php echo base_url() ?>Staff/inc_cyclecount" method="post">
    <div class="form-group">
      <label>Kode Cycle Count :</label>
      <input type="text" name="kd_txt" value="<?php echo $hasilkode ?>" id="kd" class="form-control" placeholder="Kode Cycle Count" readonly>
    </div>
    <div class="form-group">
      <label>Part Case :</label>
      <input type="text" name="pc_txt" id="pc" class="form-control" placeholder="Part Case" autofocus>
    </div>
    <div class="form-group">
      <label>Location :</label>
      <input type="text" name="loc_txt" id="loc" class="form-control" placeholder="Location">
    </div>
    <div class="form-group">
      <label>Qty :</label>
      <input type="text" name="qty_txt" id="qty" class="form-control" placeholder="Qty">
    </div>
    <input type="hidden" name="act" id="act">
    <button type="submit" class="btn btn-primary"><i class="fa fa-save fa-fw"></i> Simpan</button>
    <button type="reset" id="reset" class="btn btn-default"><i class="fa fa-refresh fa-fw"></i></button>
  </div>
  </form>
</div>
