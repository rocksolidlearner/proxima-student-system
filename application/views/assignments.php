<div class="container" style="margin:30px 0;max-width: 100%;">
  <div class="row">
    <!-- <div class="col-sm-1"></div> -->
  	<div class="col-md-12">
  		<h2 style="color: gray">Teacher Assignments</h2>
      <div class="box" style="box-shadow: 0 0 5px gray;">
        <div class="box-header">
          <h5 class="box-title" style="margin-bottom: 20px;background-color: #4b8df8;padding: 10px;color: #fff"><i class="fa fa-list"></i> Teachers</h5>
        </div>
        <div class="box-body" style="padding: 10px">
          <table id="example" class="table table-striped table-bordered" style="width:100%">
              <thead>
              <tr>
                  <th style="width: 5%">#</th>
                  <th style="width: 20%">Teacher</th>
                  <th>Uploads Assignment</th>
              </tr>
              </thead>
              <tbody>
              <?php $count=1; foreach ($subjects as $s) {?>
              <tr>
                  <td><?php echo $count++; ?></td>
                  <td><?php echo $s['subject_name']; ?></td>
                  <td>
                    <button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-sm btn-danger" onclick="upload_assign(<?=$s['id']?>)" title="Upload assignment files">
                    <i class="fa fa-upload"></i> Upload File
                    </button>
                    <?php if(!empty($s['upload_file'])){?>
                    <a href="<?=base_url('remove-assignment/'.$s['id'])?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                    <p><?=$s['upload_file']?><?php }?>
                </td>
              </tr>
              <?php } ?>
              </tbody>
          </table>               
        </div>
      </div>
  	</div>
  </div>
</div>
<!-- Modal -->
<div id="myModal" class="modal fade">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Upload Assignment</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <?php echo form_open_multipart('teacher-assignments'); ?>
      <div class="modal-body">
        <input type="hidden" name="teacher_id" id="teacher_id">
        <div class="form-group">
          <label>Select File</label>
          <input type="file" name="upload_file" id="upload_file" class="form-control">
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success"><i class="fa fa-upload"></i> Upload</button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
      </div>
      <?=form_close();?>
    </div>
  </div>
</div>
<script>
  function upload_assign(id){
    // $('#myModal').modal();
    $('#teacher_id').val(id);
  }
</script>