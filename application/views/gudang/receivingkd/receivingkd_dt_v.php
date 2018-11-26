<div class="box box-info">
  <div class="box-header">
    <i class="fa fa-hdd-o fa-fw"></i>
    <h3 class="box-title">Data Receiving KD</h3>
  </div>
  <div class="box-body">
    <div class="mailbox-messages table-responsive">
      <table class="table table-bordered table-striped" id="brg">
        <thead>
            <tr>
                <th width="5%">#</th>
                <th>Kode Receiving KD</th>
                <th>Case No</th>
                <th>Location</th>
                <th class="text-center">Option</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $no = 0;
            foreach($receivingkd->result() as $r1){
                $no++;
        ?>
            <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo $r1->kd_receivingkd ?></td>
                <td><?php echo $r1->case_no ?></td>
                <td><?php echo $r1->location ?></td>
                <td class="text-center" width="12%">
                    <a href="javascript:;" class="btn btn-default btn-xs xtooltip" title="Edit"><i class="fa fa-edit" onclick="edit('<?php echo $r1->kd_receivingkd ?>','<?php echo $r1->case_no ?>','<?php echo $r1->location ?>')"></i></a>
                    <a href="<?php echo base_url() ?>Gudang/hapus_receivingkd/<?php echo $r1->kd_receivingkd ?> " onclick="return confirm('Anda Yakin Ingin Menghapusnya ?')" class="btn btn-default btn-xs xtooltip" title="Hapus"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
        <?php
            }
        ?>
        </tbody>
      </table>
    </div>
  </div>
  <!-- /.box-body -->
</div>

<a href="<?php echo base_url() ?>Gudang/deleteall_receivingkd/?> " onclick="return confirm('Anda Yakin Ingin Menghapusnya ?')" class="pull-right btn btn-danger btn-xs"> Refresh Data</a>
<a href="<?php echo base_url() ?>Gudang/excel_receivingkd/" class="pull-right btn btn-primary btn-xs"><i class="fa fa-file-excel-o"></i> Export Data</a>

<script type="text/javascript">
  $(function () {
    $("#brg").dataTable({
      "iDisplayLength": 10,
      "processing": true,
          "serverSide": true,
    });

    $('.xtooltip').tooltip();
  });

function edit(kd,cn,loc){
  $("#kd").val(kd);
  $("#cn").val(cn);
  $('#loc').val(loc);
  $('#act').val('edit');
}
</script>
