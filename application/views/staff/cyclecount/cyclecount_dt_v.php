<div class="box box-info">
  <div class="box-header">
    <i class="fa fa-hdd-o fa-fw"></i>
    <h3 class="box-title">Data Cycle Count</h3>
  </div>
  <div class="box-body">
    <div class="mailbox-messages table-responsive">
      <table class="table table-bordered table-striped" id="brg">
        <thead>
            <tr>
                <th width="5%">#</th>
                <th>Kode Cycle Count</th>
                <th>Part Case</th>
                <th>Location</th>
                <th>Qty</th>
                <th class="text-center">Option</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $no = 0;
            foreach($cyclecount->result() as $r1){
                $no++;
        ?>
            <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo $r1->kd_cyclecount ?></td>
                <td><?php echo $r1->part_case ?></td>
                <td><?php echo $r1->location ?></td>
                <td><?php echo $r1->qty ?></td>
                <td class="text-center" width="12%">
                    <a href="javascript:;" class="btn btn-default btn-xs xtooltip" title="Edit"><i class="fa fa-edit" onclick="edit('<?php echo $r1->kd_cyclecount ?>','<?php echo $r1->part_case ?>','<?php echo $r1->location ?>','<?php echo $r1->qty ?>')"></i></a>
                    <a href="<?php echo base_url() ?>Staff/hapus_cyclecount/<?php echo $r1->kd_cyclecount ?> " onclick="return confirm('Anda Yakin Ingin Menghapusnya ?')" class="btn btn-default btn-xs xtooltip" title="Hapus"><i class="fa fa-trash"></i></a>
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

<script type="text/javascript">
  $(function () {
    $("#brg").dataTable({
      "iDisplayLength": 10,
      "processing": true,
          "serverSide": true,
    });

    $('.xtooltip').tooltip();
  });

function edit(kd,pc,loc,qty){
  $("#kd").val(kd);
  $("#pc").val(pc);
  $('#loc').val(loc);
  $('#qty').val(qty);
  $('#act').val('edit');
}
</script>
