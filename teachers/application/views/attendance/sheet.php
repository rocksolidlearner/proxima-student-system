<div class="container" style="margin:30px 0;max-width: 100%;">
  <div class="row">
    <!-- <div class="col-sm-1"></div> -->
  	<div class="col-md-12">
  		<h3 style="color: gray">Attendance Sheet</h3>
      <div class="box" style="box-shadow: 0 0 5px gray;border-bottom: 15px solid #4b8df8">
        <div class="box-header">
          <h5 class="box-title" style="margin-bottom: 20px;background-color: #4b8df8;padding: 10px;color: #fff"><i class="fa fa-list"></i> Generate report</h5>
        </div>
        <div class="box-body" style="padding: 10px">
          <?php echo form_open('attendance-sheet'); ?>
          <div class="row">
            <div class="col-md-3 text-right">
              <label>Select Class</label>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <select name="class_id" class="form-control select2">
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
              <label>Test/Exam Schedule Date Range</label>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <input type="date" class="form-control" name="from_date" value="<?=$this->session->userdata('from_date')?>">
                <span>From</span>
                <span class="text-danger"><?php echo form_error('from_date');?></span>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <input type="date" class="form-control" name="to_date" value="<?=$this->session->userdata('to_date')?>">
                <span>To</span>
                <span class="text-danger"><?php echo form_error('to_date');?></span>
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
            <div class="col-md-12 col-sm-12" style="overflow-x: scroll;">
              <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                <tr>
                    <th rowspan="2"></th>
                    <?php while($month <= $end)
                  {
                        echo'<th>'.date('d', $month), PHP_EOL.'</th>';
                        $month = strtotime("+1 day", $month);
                    }?>
                </tr>
                <tr>
                  <?php while($month1 <= $end1)
                  {
                        echo'<th>'.date('D', $month1), PHP_EOL.'</th>';
                        $month1 = strtotime("+1 day", $month1);
                    }?>
                </tr>
                <tr>
                  <th colspan="<?=$days+2?>" style="text-align: center;">Class: <?=$class['class_name'].' '.$from_date.' to ',$to_date?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($students as $std) {?>
                <tr>
                  <td><?=$std['std_name'];?></td>
                  <?php foreach ($std['days'] as $d) {
                  
                        echo'<td style="background-color: ';
                        if ($d['status']=='P') {
                          echo "darkgreen";
                        }elseif ($d['status']=='L') {
                          echo "yellowgreen";
                        }elseif ($d['status']=='A') {
                          echo "darkred";
                        }elseif ($d['status']=='H') {
                          echo "blue";
                        }
                        echo';color: #fff">'.$d['status'].'</td>';
                        $month1 = strtotime("+1 day", $month1);
                    }?>
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
