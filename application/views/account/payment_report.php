<div class="container" style="margin:30px 0;max-width: 100%;">
  <div class="row">
    <!-- <div class="col-sm-1"></div> -->
  	<div class="col-md-12">
  		<h3 style="color: gray">Payment Report</h3>
      <div class="x-panel" style="padding: 0;box-shadow: 0 0 5px gray;border-bottom: 15px solid #2A3F54">
        <div class="x-title" style="padding: 0">
          <h5 style="margin-bottom: 20px;background-color: #2A3F54;padding: 10px;color: #fff"><i class="fa fa-list"></i> Generate report</h5>
        </div>
        <div class="x-content" style="padding: 10px">
          <?php echo form_open('payment-report'); ?>
          <div class="row">
            <div class="col-md-3 text-right">
              <label>Select Class</label>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <select name="class_id" class="form-control select2">
                  <option value="">=== All Classes ===</option>
                    <?php
                    foreach($results as $r)
                    {
                        $selected = ($r['id'] == $this->input->post('class_id')) ? ' selected="selected"' : "";

                        echo '<option value="'.$r['id'].'" '.$selected.'>'.$r['class_name'].'</option>';
                    }
                    ?>
                </select>
                <span class="text-danger"><?php echo form_error('class_id');?></span>
              </div>
            </div>
            <div class="col-md-3"></div>
            <div class="col-md-3 text-right">
              <label>Select Month</label>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <select name="month" class="form-control select2">
                    <?php
                    for ($m=1; $m<=12; $m++) {
                      $month = date('F', mktime(0,0,0,$m, 1, date('Y')));
                      $month2 = date('m', mktime(0,0,0,$m, 1, date('Y')));
                      echo '<option value="'.$month2.'">'.$month.'</option>';
                      }
                    ?>
                </select>
                <span class="text-danger"><?php echo form_error('status');?></span>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <select name="year" class="form-control select2">
                    <?php $years = range( date('Y')-7, date('Y') );
                    foreach( $years as $v ) {
                      $selected = ($v = date('Y')) ? 'selected="selected"' : "";
                      echo '<option value="'.$v.'" '.$selected.'>'.$v.'</option>';
                      }
                    ?>
                </select>
                <span class="text-danger"><?php echo form_error('status');?></span>
              </div>
            </div>
            <div class="col-md-3"></div>
            <div class="col-md-3"></div>
            <div class="col-md-6">
              <button type="submit" class="btn btn-success btn-sm" name="view">View Report</button>
              <button type="submit" class="btn btn-primary btn-sm" name="download">Download Report</button>
            </div>
          </div>
          <?php echo form_close();
          if (isset($students) && !empty($students)) {?>
          <div class="row" style="margin-top: 20px">
            <div class="col-md-12 col-sm-12">
              <table id="report" class="table table-striped table-bordered" style="width:100%">
                <thead>
                <tr>
                    <th>Sr.</th>
                    <th>Fee</th>
                    <th>Amount</th>
                    <th>Date</th>
                    <th>Receipt</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($students as $std) {?>
                <tr>
                  <td><?=$std['id'];?></td>
                  <td><?=$std['amount'];?></td>
                  <td><?=$std['amount']; ?></td>
                  <td><?=$std['paid_date'];?></td>
                  <td><?=$std['receipt'];?></td>
                </tr>
                <?php }?>
                </tbody>
              </table> 
            </div>
          </div>
          <?php }?>
        </div>
      </div>
  	</div>
  </div>
</div>
