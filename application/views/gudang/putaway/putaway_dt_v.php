<div class="box box-info">
  <div class="box-header">
    <i class="fa fa-hdd-o fa-fw"></i>
    <h3 class="box-title">Data Putaway</h3>
  </div>
  <div class="box-body">
    <div class="mailbox-messages table-responsive">
      <table class="table table-bordered table-striped" id="brg">
        <thead>
            <tr>
                <th width="5%">#</th>
                <th>Kode Putaway</th>
                <th>Case Id/Part Number</th>
                <th>Old Location</th>
                <th>New Location</th>
                <th>QTY</th>
                <th class="text-center">Option</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $no = 0;
            foreach($putaway->result() as $r1){
                $no++;
        ?>
            <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo $r1->kd_putaway?></td>
                <td><?php echo $r1->part_case?></td>
                <td><?php echo $r1->old_loc?></td>
                <td><?php echo $r1->new_loc?></td>
                <td><?php echo $r1->qty?></td>
                <td class="text-center" width="12%">
                    <a href="javascript:;" class="btn btn-default btn-xs xtooltip" title="Edit"><i class="fa fa-edit" onclick="edit('<?php echo $r1->kd_putaway ?>','<?php echo $r1->part_case ?>','<?php echo $r1->old_loc ?>','<?php echo $r1->new_loc ?>','<?php echo $r1->qty ?>')"></i></a>
                    <a href="<?php echo base_url() ?>Gudang/hapus_putaway/<?php echo $r1->kd_putaway ?> " onclick="return confirm('Anda Yakin Ingin Menghapusnya ?')" class="btn btn-default btn-xs xtooltip" title="Hapus"><i class="fa fa-trash"></i></a>
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

<a href="<?php echo base_url() ?>Gudang/deleteall_putaway/?> " onclick="return confirm('Anda Yakin Ingin Menghapusnya ?')" class="pull-right btn btn-danger btn-xs"> Refresh Data</a>
<a href="<?php echo base_url() ?>Gudang/excel_putaway/" class="pull-right btn btn-primary btn-xs"><i class="fa fa-file-excel-o"></i> Export Data</a>

<script type="text/javascript">
  $(function () {
    $("#brg").dataTable({
      "iDisplayLength": 10,
      "processing": true,
          "serverSide": true,
    });

    $('.xtooltip').tooltip();
  });

function edit(kd,pc,old,neloc,qty){
  $("#kd").val(kd);
  $("#pc").val(pc);
  $('#old').val(old);
  $('#neloc').val(neloc);
  $('#qty').val(qty);
  $('#act').val('edit');
}
</script>
