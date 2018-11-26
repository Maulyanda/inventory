<?php
  $count_outbound = $this->db->query("SELECT * FROM tb_outbound ORDER BY kd_outbound DESC LIMIT 1");
 foreach($count_outbound->result() as $i){
  $datakode = $i->kd_outbound;
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
    <h3 class="box-title">Form outbound</h3>
  </div>
  <div class="box-body">
  <form action="<?php echo base_url() ?>Gudang/inc_outbound" method="post">
    <div class="form-group">
      <label>Kode outbound :</label>
      <input type="text" name="kd_txt" value="<?php echo $hasilkode ?>" id="kd" class="form-control" placeholder="Kode outbound" readonly>
    </div>
    <div class="form-group">
      <label>Part Number :</label>
      <input type="text" name="pn_txt" id="pn" class="form-control" placeholder="Part Number" autofocus>
    </div>
    <!-- <div class="form-group">
      <label>Qty :</label>
      <input type="text" name="qty_txt" id="qty" class="form-control" placeholder="Qty" readonly>
    </div> -->
    <input type="hidden" name="act" id="act">
    <button type="submit" class="btn btn-primary"><i class="fa fa-save fa-fw"></i> Simpan</button>
    <button type="reset" id="reset" class="btn btn-default"><i class="fa fa-refresh fa-fw"></i></button>
  </div>
  </form>
</div>
