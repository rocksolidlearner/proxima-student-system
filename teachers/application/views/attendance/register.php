<div class="container" style="margin:30px 0;max-width: 100%;">
  <div class="row">
    <!-- <div class="col-sm-1"></div> -->
  	<div class="col-md-12">
  		<h3 style="color: gray">Attendacne</h3>
      <div class="box" style="box-shadow: 0 0 5px gray;border-bottom: 15px solid #4b8df8">
        <div class="box-header">
          <h5 class="box-title" style="margin-bottom: 20px;background-color: #4b8df8;padding: 10px;color: #fff"><i class="fa fa-list"></i> Attendance Register</h5>
        </div>
        <div class="box-body" style="padding: 10px">
          <?php echo form_open('attendance-register'); ?>
          <div class="row">
            <div class="col-md-3 text-right">
              <label>Attendance Date</label>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <input type="date" class="form-control" name="date" value="<?=$this->session->userdata('date')?>">

                <span class="text-danger"><?php echo form_error('date');?></span>
              </div>
            </div>
            <div class="col-md-3"></div>
            <div class="col-md-3 text-right">
              <label>Select Class</label>
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
              <button type="submit" class="btn btn-success btn-sm">Get Attendance</button>
            </div>
          </div>
          <?php echo form_close();
          if (isset($students) && !empty($students)) {?>
          <div class="row" style="margin-top: 20px">
            <input type="hidden" name="day" id="date" value="<?=$attendance_date?>">
            <div class="col-md-12 col-sm-12">
              <div id="hide-table">
                  <table class="table  table-bordered table-hover">
                      <thead>
                      <tr>
                          <th style="width: 30%">Student Name</th>
                          <th>Attendance</th>
                      </tr>
                      </thead>
                      <tbody id="list">
                      <?php
                      foreach ($students as $u){ ?>
                          <tr>
                              <td align="right" data-title="Name"><?=$u['std_name']?></td>
                              <td id="attendance<?=$u['id']?>" data-studentid="1" data-title="Attendance">
                                  <input type="radio" class="attendance btn btn-warning present" id="136-1<?=$u['id']?>" value="P" name="<?=$u['id']?>" checked>
                                  <label style="vertical-align:  middle;display: inline;" for="136-1">Present </label>
                                  <input type="radio" class="attendance btn btn-warning absent" id="136-4<?=$u['id']?>" value="A" name="<?=$u['id']?>">
                                  <label style="vertical-align:  middle;display: inline;" for="136-4">Absent </label>
                                  <input type="radio" class="attendance btn btn-warning lateexcuse" id="136-2<?=$u['id']?>" value="L" name="<?=$u['id']?>">
                                  <label style="vertical-align:  middle;display: inline;" for="136-2">Leave </label>
                                  
                              </td>
                          </tr>
                      <?php } ?>
                      </tbody>
                      <tr>
                        <td colspan="2" align="right">
                          <button class="btn btn-success save_attendance"onclick="attendance()">Save Attendance</button>
                        </td>
                      </tr>
                  </table>
              </div>

              <script type="text/javascript">

                  function attendance(){
                      var attendance = {};
                      $('.attendance').each(function(i){
                          var name = $(this).attr('name');
                          if($("input:radio[name="+name+"]").is(":checked")) {
                              var val = $('input:radio[name='+name+']:checked').val();
                          } else {
                              var val = 'A';
                          }
                          attendance[name] = val;
                      });
                      console.log(attendance);
                      var day = $('#date').val();
                      $.ajax({
                              type: 'POST',
                              url: "<?=base_url('dashboard/save_attendance')?>",
                              data: {
                                  attendance : attendance,
                                  day : day,
                              },
                              success: function(data) {
                                console.log(data);
                                toastr.success('success',data);
                              }
                          });

                  }
              </script>
            </div>
          </div>
          <?php }?>
        </div>
      </div>
  	</div>
  </div>
</div>
