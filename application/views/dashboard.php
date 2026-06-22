<script>
    <?php if($this->session->flashdata('success')){  ?>
    toastr.success("<?php echo $this->session->flashdata('success'); ?>");
    <?php } ?>
</script>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <h2>Dashboard </h2>
    </div>
</div>
<div class="row">
  <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <div class="tile-stats" style="background-color: #27a9e3;color: #fff">
      <div class="icon" style="color: #fff;font-size: 25px;"><i class="fa fa-graduation-cap"></i></div>
      <div class="count" style="color: #fff;font-size: 25px;"><?=$tot_stds?></div>
      <h4 style="color: #fff;padding-left: 7px">Total Students</h4>
      <p><a href="<?=base_url('student')?>" style="color: #fff">View more</a></p>
    </div>
  </div>
  <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <div class="tile-stats" style="background-color: #169F85;color: #fff">
      <div class="icon" style="color: #fff"><i class="fa fa-line-chart"></i></div>
      <div class="count" style="color: #fff;font-size: 25px;"><?=$this->data['setting']['currency_symbol'].' '.number_format($fee['total_fee'],2)?></div>
      <h4 style="color: #fff;padding-left: 7px">Revenue</h4>
      <p><?=date('F Y')?></p>
    </div>
  </div>
  <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <div class="tile-stats" style="background-color: #ffb848;color: #fff">
      <div class="icon" style="color: #fff"><i class="fa fa-pie-chart"></i></div>
      <div class="count" style="color: #fff;font-size: 25px;"><?=$this->data['setting']['currency_symbol'].' '.number_format($expense['total_expenses'],2)?></div>
      <h4 style="color: #fff;padding-left: 7px">Expenses</h4>
      <p><?=date('F Y')?></p>
    </div>
  </div>
  <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <div class="tile-stats" style="background-color: #852b99;color: #fff">
      <div class="icon" style="color: #fff"><i class="fa fa-thumbs-o-up"></i></div>
      <div class="count" style="color: #fff;font-size: 25px;"><?=$this->data['setting']['currency_symbol'].' '.$profit?></div>
      <h4 style="color: #fff;padding-left: 7px">Profit</h4>
      <p><?=date('F Y')?></p>
    </div>
  </div>
</div>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><i class="fa fa-bar-chart-o"></i> Income/Expense <small></small></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content2">
                <div id="graph_line" style="width:100%; height:300px;"></div>
            </div>
        </div>
    </div>
</div>
<script>

    //User Appointment
    // var randomScalingFactorCancel = function() {
    //     return Math.round(<?=$this->data['cancelled']?>);
    // };
    // var randomColorFactorComplete = function() {
    //     return Math.round(<?=$this->data['completed']?>);
    // };
    // var randomColorFactorPending = function() {
    //     return Math.round(<?=$this->data['pending']?>);
    // };

    // var config = {
    //     type: 'pie',
    //     data: {
    //         datasets: [{
    //             data: [
    //                 randomScalingFactorCancel(),
    //                 randomColorFactorComplete(),
    //                 randomColorFactorPending(),
    //             ],
    //             backgroundColor: [
    //                 "#F7464A",
    //                 "#28a745",
    //                 "#17a2b8",
    //             ],
    //         }, {
    //             data: [
    //                 randomScalingFactorCancel(),
    //                 randomColorFactorComplete(),
    //                 randomColorFactorPending(),
    //             ],
    //             backgroundColor: [
    //                 "#F7464A",
    //                 "#28a745",
    //                 "#17a2b8",
    //             ],
    //         }, {
    //             data: [
    //                 randomScalingFactorCancel(),
    //                 randomColorFactorComplete(),
    //                 randomColorFactorPending(),
    //             ],
    //             backgroundColor: [
    //                 "#F7464A",
    //                 "#28a745",
    //                 "#17a2b8",
    //             ],
    //         }],
    //         labels: [
    //             "Not Booked",
    //             "Completed",
    //             "Pending",
    //         ]
    //     },
    //     options: {
    //         responsive: true
    //     }
    // };

    // window.onload = function() {
    //     var session = document.getElementById("clientSession").getContext("2d");
    //     window.myPie = new Chart(session, config);
    // };
</script>