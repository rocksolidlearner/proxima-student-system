<div class="container" style="margin:30px 0;max-width: 100%;">
  <div class="row">
    <!-- <div class="col-sm-1"></div> -->
  	<div class="col-md-12">
  		<h2 style="color: gray">Student View</h2>
      <?php foreach ($results as $r) {?>
      <div class="box" style="box-shadow: 0 0 5px gray;">
        <div class="box-header">
          <h5 class="box-title" style="margin-bottom: 20px;background-color: #4b8df8;padding: 10px;color: #fff"><i class="fa fa-list"></i> Class Name (<?=$r['class_name']?>)</h5>
        </div>
        <div class="box-body" style="padding: 10px">
          <table id="example<?=$r['id']?>" class="table table-striped table-bordered" style="width:100%">
              <thead>
              <tr>
                  <th>Admission #</th>
                  <th>Roll No</th>
                  <th>Student Name</th>
                  <th>Admission Date</th>
                  <th>Date of Birth</th>
                  <th>Files</th>
              </tr>
              </thead>
              <tbody>
              <?php foreach ($r['students'] as $std) {?>
              <tr>
                  <td><?=$std['admission_no']; ?></td>
                  <td><a href="<?=base_url('assignments/'.$std['id'])?>"><?=$std['roll_no']; ?></a></td>
                  <td><a href="<?=base_url('assignments/'.$std['id'])?>"><?=$std['std_name']; ?></a></td>
                  <td><?=date('d-M-Y',strtotime($std['admission_date'])); ?></td>
                  <td><?=date('d-M-Y',strtotime($std['dob']));?> (<?=date_diff(date_create($std['dob']), date_create('today'))->y;?> Years)</td>
                  <td><I>no file uploaded</I></td>
              </tr>
              <?php } ?>
              </tbody>
          </table>               
        </div>
      </div>
      <script>
        $(document).ready(function() {
            $('#example'+<?=$r['id']?>).DataTable();
        } );
      </script>
      <?php } ?>
  	</div>
  </div>
</div>
