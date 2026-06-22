<div class="container" style="margin:30px 0;max-width: 100%;">
  <div class="row">
    <!-- <div class="col-sm-1"></div> -->
  	<div class="col-md-12">
  		<h3 style="color: gray">Add Test Schedule</h3>
      <div class="x-panel" style="padding: 0;box-shadow: 0 0 5px gray;border-bottom: 15px solid #2A3F54">
        <div class="x-title" style="padding: 0">
          <h5 style="margin-bottom: 20px;background-color: #2A3F54;padding: 10px;color: #fff"><i class="fa fa-plus"></i> Add Test Schedule</h5>
        </div>
        <div class="x-content" style="padding: 10px">
          <?php echo form_open('schedule-add'); ?>
          <div class="row">
            <div class="col-md-2 text-right">
              <label>Schedule Name</label>
            </div>
            <div class="col-md-8">
              <div class="form-group">
                <input type="text" class="form-control" name="schedule_name" value="<?=$this->input->post('class_id')?>"/>
                <span class="text-danger"><?php echo form_error('schedule_name');?></span>
              </div>
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-2 text-right">
              <label>Select Class</label>
            </div>
            <div class="col-md-8">
              <div class="form-group">
                <select name="class_id" class="form-control select2">
                    <?php
                    foreach($classes as $c)
                    {
                        $selected = ($c['id'] == $this->input->post('class_id')) ? ' selected="selected"' : "";

                        echo '<option value="'.$c['id'].'" '.$selected.'>'.$c['class_name'].'</option>';
                    }
                    ?>
                </select>
                <span class="text-danger"><?php echo form_error('class_id');?></span>
              </div>
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-2 text-right">
              <label>Test/Exam Date Range</label>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <input  name="from_date" placeholder="From Date" value="<?=$this->input->post('from_date')?>" id="date_picker" class="date_picker form-control" type="text">
                <span class="text-danger"><?php echo form_error('from_date');?></span>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
              <input  name="to_date" placeholder="To Date" value="<?=$this->input->post('to_date')?>" id="date_picker" class="date_picker form-control" type="text">
                <span class="text-danger"><?php echo form_error('to_date');?></span>
              </div>
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-2"></div>
            <div class="col-md-8">
              <button type="button" id="more_subject" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Add more subjects</button>
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-2 text-right">
              <label>Weekday > Subject</label>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <select name="days[]" class="form-control select2">
                  <option value="">==> Select Day</option>
                    <?php $days = array(
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
                    }
                    ?>
                </select>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <select name="subject_id[]" class="form-control select2">
                  <option value="">==> Select Subject</option>
                    <?php foreach($subjects as $s)
                    {
                        $selected = ($s['id'] == $this->input->post('subject_id')) ? ' selected="selected"' : "";

                        echo '<option value="'.$s['id'].'" '.$selected.'>'.$s['subject_name'].'</option>';
                    }
                    ?>
                </select>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <select name="teacher_id[]" class="form-control select2">
                  <option value="">==> Select Teacher</option>
                    <?php foreach($teachers as $t)
                    {
                      if($t['role']==TEACHER){
                        $selected = ($t['id'] == $this->input->post('teacher_id')) ? ' selected="selected"' : "";

                        echo '<option value="'.$t['id'].'" '.$selected.'>'.$t['employee_name'].'</option>';
                    } }
                    ?>
                </select>
              </div>
            </div>
            <div class="col-md-2"></div>
          </div>
          <div class="row" id="more"></div>
          <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8 text-right">
              <button type="submit" class="btn btn-primary btn-sm" name="view">Save Schedule</button>
              <button type="submit" class="btn btn-default btn-sm"  name="cancel" style="background: #d8d8d8 !important">Cancel</button>
            </div>
          </div>
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