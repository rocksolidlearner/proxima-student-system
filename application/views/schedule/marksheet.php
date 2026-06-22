<div class="container" style="margin:30px 0;max-width: 100%;">
  <div class="row">
    <!-- <div class="col-sm-1"></div> -->
  	<div class="col-md-12">
  		<h3 style="color: gray">Mark Sheet</h3>
      <div class="x_panel">
        <div class="x_title">
          <h2><i class="fa fa-check"></i> 	Fill mark sheet</h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content" style="padding: 10px">
        <?php $id = urlencode(base64_encode($schedule['id']));
                 echo form_open_multipart('mark-sheet/'.$id); ?>
          <div class="row">
            <div class="col-md-12">
              <table class="table table-bordered table-striped table-condensed flip-content tablesaw-stack" id="tablesaw-195">
                <tbody>
                <tr>
                  <th colspan="5" style="text-align: center;"><?=$schedule['class_name'].' - '.$schedule['batch_name']?></th>
                </tr>
                <tr>
                  <td style="text-align: right;">Subject:</td>
                  <td style="width: 38%"><?=$schedule['subject_name']?></td>
                  <td style="text-align: right;">Total Marks:</td>
                  <td>
                    <input name="total_marks" class="form-control" min="-1" step="0.1" type="number" placeholder="Total marks" value="<?=$schedule['total_marks']?>">
                  </td>
                  <td>
                    <input name="week" class="form-control" type="text" placeholder="Week" value="<?=$schedule['week']?>">
                  </td>
                </tr>
                <tr>
                  <td style="text-align: right;">Class</td>
                  <td><?=$schedule['class_name']?></td>
                  <td style="text-align: right;">Passing Marks:</td>
                  <td>
                    <input name="passing_marks" class="form-control" min="0" step="0.1" type="number" placeholder="Passing marks" value="<?=$schedule['passing_marks']?>">
                  </td>
                  <td>Date: <?=date('d-M-Y',strtotime($schedule['from_date']))?></td>
                </tr>
                <tr>
                  <td style="text-align: right;">Teacher</td>
                  <td colspan="4"><?=$schedule['employee_name']?></td>
                </tr>
                </tbody>
              </table>
            </div>
            <div class="col-md-6 hidden-xs hidden-sm">
              <table class="table table-bordered" id="tablesaw-195">
                <thead style="background: #666">
                  <th style="color: #fff">## Name</th>
                  <th style="width: 30%;color: #fff">Marks</th>
                </thead>
                <tbody>
                <?php foreach($schedule['std_marks'] as $key => $std){ 
                  if ($key % 2 == 0) {?>
                <tr>
                  <td><b><?=$std['student_id'].'. '.$std['std_name']?></b></td>
                  <td>
                    <input hidden name="std[]" value="<?=$std['student_id']?>">
                    <input name="marks[]" class="form-control" min="-1" step="0.1" type="number" placeholder="Marks" value="<?=$std['marks']?>">
                  </td>
                </tr>
                <?php }}?>
                </tbody>
              </table>
            </div>
            <div class="col-md-6 hidden-xs hidden-sm">
              <table class="table table-bordered" id="tablesaw-195">
                <thead style="background: #666">
                  <th style="color: #fff">## Name</th>
                  <th style="width: 30%;color: #fff">Marks</th>
                </thead>
                <tbody>
                <?php foreach($schedule['std_marks'] as $key => $std){ 
                  if ($key % 2 != 0) {?>
                <tr>
                  <td><b><?=$std['id'].'. '.$std['std_name']?></b></td>
                  <td>
                    <input hidden name="std2[]" value="<?=$std['student_id']?>">
                    <input name="marks2[]" class="form-control" min="-1" step="0.1"  type="number" placeholder="Marks" value="<?=$std['marks']?>">
                  </td>
                </tr>
                <?php }}?>
                </tbody>
              </table>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 text-center">
              <button type="submit" class="btn btn-primary btn-sm" name="view">Save Changes</button>
              <button type="submit" class="btn btn-success btn-sm"  name="downlaod">Download PDF</button>
            </div>
            <div class="col-md-12" style="margin-top: 30px">
              <div style="padding: 20px;background-color: #e8f6fc;border-left:5px solid #57b5e3;">
                <h4><strong>Note:</strong>  Please note following mark statuses</h4>
                <ul>
                <li><b>0</b> = Student is present but got 0 marks.</li>
                <li><b>Blank Field</b> = Student is absent.</li>
                <li><b>-1</b> = Student is present but not appeared in test/exam.</li>
                </ul>
              </div>
            </div>
          </div>
          <?php echo form_close();?>
        </div>
      </div>
  	</div>
  </div>
</div>
<script>
  $(function(){
    $('#more_subject').click(function(){
      $('#more').append('<div class="col-md-2 text-right"><label>Weekday > Subject</label>'+
      '</div>'+
      '<div class="col-md-2">'+
        '<div class="form-group">'+
          '<select name="days[]" class="form-control select2">'+
            '<option value="">==> Select Day</option>'+
              '<?php $days = array(
                'Monday' => 'Monday',
                'Tuesday' => 'Tuesday',
                'Wednesday' => 'Wednesday',
                'Thurday' => 'Thurday',
                'Friday' => 'Friday',
                'Saturday' => 'Saturday',
                'Sunday' => 'Sunday',
              );
              foreach($days as $key => $v)
              {
                  $selected = ($v == $this->input->post('days')) ? ' selected="selected"' : "";

                  echo '<option value="'.$v.'" '.$selected.'>'.$key.'</option>';
              }?>'+
          '</select>'+
        '</div>'+
      '</div>'+
      '<div class="col-md-3">'+
        '<div class="form-group">'+
          '<select name="subject_id[]" class="form-control select2">'+
            '<option value="">==> Select Subject</option>'+
              '<?php foreach($subjects as $s)
              {
                  $selected = ($s['id'] == $this->input->post('subject_id')) ? ' selected="selected"' : "";

                  echo '<option value="'.$s['id'].'" '.$selected.'>'.$s['subject_name'].'</option>';
              }
              ?>'+
          '</select>'+
        '</div>'+
      '</div>'+
      '<div class="col-md-3">'+
        '<div class="form-group">'+
          '<select name="teacher_id[]" class="form-control select2">'+
            '<option value="">==> Select Teacher</option>'+
              '<?php foreach($teachers as $t)
              {
                if($t['role']==TEACHER){
                  $selected = ($t['id'] == $this->input->post('teacher_id')) ? ' selected="selected"' : "";

                  echo '<option value="'.$t['id'].'" '.$selected.'>'.$t['employee_name'].'</option>';
              } }
              ?>'+
          '</select>'+
        '</div>'+
      '</div><div class="col-md-2"></div>');
      $('.select2').select2()
    })
  });
    function get_record_id(id) {
		$('#deleteModal').modal();
		$('#schedule_id').val(id);
    }
</script>