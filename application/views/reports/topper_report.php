<div class="container" style="margin:30px 0;max-width: 100%;">
  <div class="row">
    <!-- <div class="col-sm-1"></div> -->
  	<div class="col-md-12">
  		<h3 style="color: gray">Toppers Report</h3>
      <div class="x-panel" style="padding: 0;box-shadow: 0 0 5px gray;border-bottom: 15px solid #2A3F54">
        <div class="x-title" style="padding: 0">
          <h5 style="margin-bottom: 20px;background-color: #2A3F54;padding: 10px;color: #fff"><i class="fa fa-list"></i> Generate report</h5>
        </div>
        <div class="x-content" style="padding: 10px">
          <?php echo form_open('topper-report'); ?>
          <div class="row">
            <div class="col-md-3 text-right">
              <label>Type Percentage</label>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <input  name="marks" value="80" id="marks" class="form-control" type="number">
                <span class="text-danger"><?php echo form_error('marks');?></span>
              </div>
            </div>
            <div class="col-md-3"></div>
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
                <span>Select Class</span>
                <span class="text-danger"><?php echo form_error('class_id');?></span>
              </div>
            </div>
            <div class="col-md-3"></div>
            <div class="col-md-3 text-right">
              <label>Test/Exam Schedule Date Range</label>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <input  name="from_date" placeholder="From Date" value="<?=$this->input->post('from_date')?>" id="date_picker" class="date_picker form-control" type="text">
                <span>Select date range</span>
                <span class="text-danger"><?php echo form_error('from_date');?></span>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
              <input  name="to_date" placeholder="To Date" value="<?=$this->input->post('to_date')?>" id="date_picker" class="date_picker form-control" type="text">
                <span class="text-danger"><?php echo form_error('to_date');?></span>
              </div>
            </div>
            <div class="col-md-3"></div>
            <div class="col-md-3 text-right">
              <label>Order By</label>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <select name="order_by1" class="form-control">
                  <option value="">=== Default ===</option>
                    <?php 
                      $orders = array(
                        'Student Name' => 'name',
                        'Total Marks' => 'tmarks',
                        'Percentage' => 'percen',
                      );
                    foreach($orders as $key=> $or)
                    {
                        $selected = ($or == $this->input->post('order_by')) ? ' selected="selected"' : "";

                        echo '<option value="'.$or.'" '.$selected.'>'.$key.'</option>';
                    }
                    ?>
                </select>
                <span>Change order of records</span>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <select name="order_by" class="form-control">
                    <?php 
                      $orders = array(
                        'Ascending' => 'asc',
                        'Descending' => 'desc',
                      );
                    foreach($orders as $key=> $or)
                    {
                        $selected = ($or == $this->input->post('order_by')) ? ' selected="selected"' : "";

                        echo '<option value="'.$or.'" '.$selected.'>'.$key.'</option>';
                    }
                    ?>
                </select>
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
          if (isset($marks) && !empty($marks)) {?>
          <div class="row" style="margin-top: 20px">
            <div class="col-md-12 col-sm-12">
              <table id="report" class="table table-striped table-bordered" style="width:100%">
                <thead>
                <tr>
                    <th>Sr.</th>
                    <th>Student Name</th>
                    <th>Class</th>
                    <th>Total Marks</th>
                    <th>Obtained Marks</th>
                    <th>%</th>
                </tr>
                </thead>
                <tbody>
                <?php $count=1; foreach ($marks as $std) {
                  foreach ($std['std_marks'] as $m) {?>
                <tr>
                  <td><?=$count++;?></td>
                  <td><?=$m['std_name'];?></td>
                  <td><?=$std['class_name']; ?></td>
                  <td><?=$std['total_marks']; ?></td>
                  <td><?=$m['marks'];?></td>
                  <td><?=($m['marks']/$std['total_marks'])*100;?>%</td>
                </tr>
                <?php }}?>
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
