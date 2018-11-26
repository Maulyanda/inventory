<div class="row">

    <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="info-box bg-green">
      <span class="info-box-icon"><i class="fa fa-thumbs-o-up"></i></span>
      <div class="info-box-content">
        <a href="Staff/putaway" class="btn bg-green">CYCLE COUNT</a>
        <span class="info-box-number"><?php echo $cyclecount ?></span>
        <!-- The progress section is optional -->
        <div class="progress">
          <div class="progress-bar" style="width: 100%"></div>
        </div>
        <span class="progress-description">
          Jumlah Cycle Count : <b><?php echo $cyclecount ?></b>
        </span>
      </div>
    </div>
    </div>

    <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="info-box bg-yellow">
      <span class="info-box-icon"><i class="fa fa-thumbs-o-up"></i></span>
      <div class="info-box-content">
        <a href="Staff/outbound" class="btn bg-yellow">OUTBOUND</a>
        <span class="info-box-number"><?php echo $outbound ?></span>
        <!-- The progress section is optional -->
        <div class="progress">
          <div class="progress-bar" style="width: 100%"></div>
        </div>
        <span class="progress-description">
          Jumlah Outbound : <b><?php echo $outbound ?></b>
        </span>
      </div>
    </div>
    </div>

    <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="info-box bg-red">
      <span class="info-box-icon"><i class="fa fa-thumbs-o-up"></i></span>
      <div class="info-box-content">
        <a href="Staff/putaway" class="btn bg-red">PUTAWAY</a>
        <span class="info-box-number"><?php echo $putaway ?></span>
        <!-- The progress section is optional -->
        <div class="progress">
          <div class="progress-bar" style="width: 100%"></div>
        </div>
        <span class="progress-description">
          Jumlah Putaway : <b><?php echo $putaway ?></b>
        </span>
      </div>
    </div>
    </div>

    <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="info-box bg-blue">
      <span class="info-box-icon"><i class="fa fa-thumbs-o-up"></i></span>
      <div class="info-box-content">
        <a href="Staff/receivingkd" class="btn bg-blue">RECEIVING KD</a>
        <span class="info-box-number"><?php echo $receivingkd ?></span>
        <!-- The progress section is optional -->
        <div class="progress">
          <div class="progress-bar" style="width: 100%"></div>
        </div>
        <span class="progress-description">
          Jumlah Receiving KD : <b><?php echo $receivingkd ?></b>
        </span>
      </div>
    </div>
    </div>

    <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="info-box bg-navy">
      <span class="info-box-icon"><i class="fa fa-thumbs-o-up"></i></span>
      <div class="info-box-content">
        <a href="Staff/receivinglocal" class="btn bg-navy">RECEIVING LOCAL</a>
        <span class="info-box-number"><?php echo $receivinglocal ?></span>
        <!-- The progress section is optional -->
        <div class="progress">
          <div class="progress-bar" style="width: 100%"></div>
        </div>
        <span class="progress-description">
          Jumlah Receiving Local : <b><?php echo $receivinglocal ?></b>
        </span>
      </div>
    </div>
    </div>

</div>

<script type="text/javascript">
	$(document).ready(function() {
		$('#beranda2').addClass('active');
	});
</script>
