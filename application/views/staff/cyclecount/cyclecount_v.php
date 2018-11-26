<link href="<?php echo base_url();?>asset/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url();?>asset/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url();?>asset/plugins/datatables/dataTables.bootstrap.js"></script>
<div id="respon1"></div>
<?php echo $this->session->flashdata('msg');?>
<div class="row">
    <div id="cyclecount_fm" class="col-md-4"><?php $this->load->view('Staff/cyclecount/cyclecount_fm_v') ?></div>
    <div id="cyclecount_dt" class="col-md-8"><?php $this->load->view('Staff/cyclecount/cyclecount_dt_v') ?></div>
</div>

<script type="text/javascript">
//Active Menu Sidebars
$(document).ready(function() {
    $('#master').addClass('active');
    $('#cyclecount').addClass('active');
});
</script>
