<script type="text/javascript">
    <?php if($this->session->flashdata('success')){  ?>
    toastr.success("<?php echo $this->session->flashdata('success'); ?>");
    <?php } ?>
</script>
<div class="container" style="margin:30px 0;max-width: 100%;">
  <div class="row">
    <!-- <div class="col-sm-1"></div> -->
  	<div class="col-md-12">
  		<h3 style="color: gray">Examination</h3>
      <div class="x_panel">
        <div class="x_title">
          <h2><i class="fa fa-list"></i> Test Schedules</h2>
          <ul class="nav navbar-right panel_toolbox">
              <li>
                  <a href="<?=base_url('schedule-add')?>"><button class="btn btn-sm btn-info"><i class="fa fa-plus"></i> Add Schedule</button></a>
              </li>
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content" style="padding: 10px">
          <?php echo form_open('test-schedules'); ?>
          <div class="row">
            <div class="col-md-3 text-right">
              <label>From Date</label>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <input  name="from_date" value="<?=$this->input->post('from_date')?>" placeholder="<?=date('d-M-Y')?>" id="date_picker" class="date_picker form-control" type="text">
                <span class="text-danger"><?php echo form_error('from_date');?></span>
              </div>
            </div>
            <div class="col-md-3"></div>
            <div class="col-md-3 text-right">
              <label>To Date</label>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <input  name="to_date" value="<?=$this->input->post('to_date')?>" id="date_picker" class="date_picker form-control" type="text">
                <span class="text-danger"><?php echo form_error('to_date');?></span>
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
              <button type="submit" class="btn btn-primary btn-sm" name="filter">Filter Result</button>
              <button type="submit" class="btn btn-default btn-sm" name="cancel" style="background: #d8d8d8 !important">Cancel Filter</button>
            </div>
          </div>
          <?php echo form_close();?>
          <div class="row" style="margin-top: 20px">
            <div class="col-md-12 col-sm-12">
              <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                <tr>
                    <th>Schedule Name</th>
                    <th>Test Date</th>
                    <th>Class</th>
                    <th>Subject</th>
                    <th>Teacher</th>
                    <th style="width: 10%"></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($schedules as $s) {
                  $id = urlencode(base64_encode($s['id']));?>
                <tr>
                  <td><?=$s['schedule_name'];?></td>
                  <td><?=date('d-M-Y',strtotime($s['from_date'])).' - '.$s['day'];?></td>
                  <td><?=$s['class_name']; ?></td>
                  <td><?=$s['subject_name'].' - ('.$s['total_stds'].' students)'?></td>
                  <td><?=$s['employee_name'];?></td>
                  <td style="white-space: nowrap">
                    <a class="btn btn-success btn-sm" href="<?=base_url('mark-sheet/'.$id)?>" target="_blank" title="Generate/Fill Marksheet"><i class="fa fa-table"></i> Mark Sheet</a>
                    <a class="btn btn-info btn-sm" href="#" onclick="mark_empty(<?=$s['schedule_id']?>)" title="Empty Marksheet"><i class="fa fa-file"></i></a>
                    <a class="btn btn-danger btn-sm" href="#" onclick="get_record_id(<?=$s['id']?>)" title="Delete This Schdule"><i class="fa fa-trash"></i></a>
                  </td>
                </tr>
                <?php }?>
                </tbody>
              </table> 
            </div>
          </div>
        </div>
      </div>
  	</div>
  </div>
</div>
<!-- The Modal -->
<div class="modal fade" id="deleteModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Test Schedule</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <?php echo form_open('test-schedules'); ?>
            <!-- Modal body -->
            <div class="modal-body">
                <input type="hidden" name="id" id="schedule_id">
                <p>Are you sure you want to delete this Schedule?</p>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Yes</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<div class="modal fade" id="confirmModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <?php echo form_open('test-schedules'); ?>
            <!-- Modal body -->
            <div class="modal-body">
                <input type="hidden" name="schedule_id" id="schedule_id2">
                <p>Are you sure you want to remove all data in this mark sheet? This action will not undo</p>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Ok</button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<!-- //End Modal -->
<script>
    function get_record_id(id) {
		  $('#deleteModal').modal();
		  $('#schedule_id').val(id);
    }
    function mark_empty(id) {
		  $('#confirmModal').modal();
		  $('#schedule_id2').val(id);
    }
</script>