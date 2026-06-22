<div class="container" style="margin:30px 0;max-width: 100%;">
  <div class="row">
  	<div class="col-md-12">
  		<h3 style="color: gray">Attendance Report</h3>
      <div class="x_panel" style="padding: 0;box-shadow: 0 0 5px gray;border-bottom: 15px solid #2A3F54">
        <div class="x_title" style="padding: 0">
          <h5 style="margin-bottom: 20px;background-color: #2A3F54;padding: 10px;color: #fff"><i class="fa fa-list"></i> Generate Attendance Report</h5>
        </div>
        <div class="x_content" style="padding: 10px">
          <?php echo form_open('attendance-report'); ?>
          <div class="row">
            <div class="col-md-3 text-right">
              <label>Select Date</label>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <input  name="date" value="<?=$this->input->post('date')?>" placeholder="<?=date('d-M-Y')?>" id="date_picker" class="date_picker form-control" type="text">
                <span class="text-danger"><?php echo form_error('date');?></span>
              </div>
            </div>
            <div class="col-md-3"></div>
            <div class="col-md-3 text-right">
              <label>Attendance Status</label>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <select name="attend_status" class="form-control select2">
                  <option value="">=== Any ===</option>
                    <?php $status = array('Absent' => 'A','Present' => 'P','Leave' => 'L');
                    foreach($status as $key => $st)
                    {
                        $selected = ($st == $this->input->post('attend_status')) ? ' selected="selected"' : "";

                        echo '<option value="'.$st.'" '.$selected.'>'.$key.'</option>';
                    } ?>
                </select>
                <span class="text-danger"><?php echo form_error('attend_status');?></span>
              </div>
            </div>
            <div class="col-md-3"></div>
            <div class="col-md-3 text-right">
              <label>Select Classes</label>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <select name="class_id" class="form-control select2">
                  <option value="">=== Select Class ===</option>
                    <?php foreach($results as $r)
                    {
                        $selected = ($r['id'] == $this->input->post('class_id')) ? ' selected="selected"' : "";

                        echo '<option value="'.$r['id'].'" '.$selected.'>'.$r['class_name'].'</option>';
                    } ?>
                </select>
                <span class="text-danger"><?php echo form_error('class_id');?></span>
              </div>
            </div>
            <div class="col-md-3"></div>
            <div class="col-md-3"></div>
            <div class="col-md-6">
              <button type="submit" class="btn btn-success btn-sm" name="view">View Report</button>
              <button type="submit" class="btn btn-danger btn-sm" name="absent">SMS Absent Report</button>
              <button type="submit" class="btn btn-primary btn-sm" name="download">Download Report</button>
            </div>
          </div>
          <?php echo form_close();
          if (isset($students)) {?>
          <div class="row" style="margin-top: 20px">
            <div class="col-md-12 col-sm-12">
              <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                <tr>
                    <th>Roll No.</th>
                    <th>Student</th>
                    <th>Class</th>
                    <th>Father</th>
                    <th>Contact</th>
                    <th>Attendance</th>
                </tr>
                </thead>
                <tbody>
                <?php if (!empty($students)) {
                  foreach ($students as $std) {?>
                <tr>
                  <td><?=$std['roll_no'];?></td>
                  <td><?=$std['std_name'];?></td>
                  <td><?=$std['class_name']; ?></td>
                  <td><?=$std['father_name'];?></td>
                  <td><?=$std['phone'];?></td>
                  <td style="background-color: <?php if($std['status'] == 'P'){echo "darkgreen";}elseif ($std['status']=='L') {
                    echo "#e2e209";
                  }elseif ($std['status'] == 'A') {
                    echo "darkred";
                  }else{echo'#0069d9';} ?>; color: #fff;"><?=$std['status'];?></td>
                </tr>
                <?php }}else{
                  echo '<tr>
                    <td align="center" colspan="6">No record found</td>
                  </tr>';
                }?>
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
