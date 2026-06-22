<div class="container" style="margin:30px 0;max-width: 100%;">
  <div class="row">
    <!-- <div class="col-sm-1"></div> -->
  	<div class="col-md-12">
  		<h3 style="color: gray">Expense Report</h3>
      <div class="x_panel" style="padding: 0;box-shadow: 0 0 5px gray;border-bottom: 15px solid #2A3F54">
        <div class="x_title" style="padding: 0">
          <h5 style="margin-bottom: 20px;background-color: #2A3F54;padding: 10px;color: #fff"><i class="fa fa-list"></i> Generate report</h5>
        </div>
        <div class="x-content" style="padding: 10px">
          <?php echo form_open('expense-report'); ?>
          <div class="row">
          <div class="col-md-3 text-right">
              <label>Select Head</label>
            </div>
            <div class="col-md-7">
              <div class="form-group">
                <select class="form-control select2" name="head_id" style="width: 100%">
                    <?php foreach($heads as $h)
                    {
                        $selected = ($h['id'] == $this->input->post('head_id')) ? ' selected="selected"' : "";

                        echo '<option value="'.$h['id'].'" '.$selected.'>'.$h['account_head'].'</option>';
                    } ?>
                </select>
                <span class="text-danger"><?php echo form_error('head_id');?></span>
              </div>
            </div>
            <div class="col-md-3 text-right">
              <label>Dates</label>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <input  name="from_date" placeholder="<?=date('d-M-Y')?>" value="<?=$this->input->post('from_date')?>" id="date_picker" class="date_picker form-control" type="text">
                <span class="text-danger"><?php echo form_error('from_date');?></span>
              </div>
            </div>
            <div class="col-md-1 text-center">TO</div>
            <div class="col-md-3">
              <div class="form-group">
              <input  name="to_date" placeholder="<?=date('d-M-Y')?>" value="<?=$this->input->post('to_date')?>" id="date_picker" class="date_picker form-control" type="text">
                <span class="text-danger"><?php echo form_error('to_date');?></span>
              </div>
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-3"></div>
            <div class="col-md-7">
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
                    <th>ID</th>
                    <th>Date</th>
                    <th>Description</th>
                    <th>Receipt</th>
                    <th>Amount</th>
                </tr>
                </thead>
                <tbody>
                <?php $total=0; foreach ($students as $std) {
                  $total +=$std['amount']; ?>
                <tr>
                  <td><?=$std['id'];?></td>
                  <td><?=$std['expense_date'];?></td>
                  <td><?=$std['detail'];?></td>
                  <td><?=$std['receipt'];?></td>
                  <td><?=$std['amount']; ?></td>
                </tr>
                <?php }?>
                <tr>
                  <td colspan="4" align="right">Total:</td>
                  <td><?=$total?></td>
                </tr>
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
