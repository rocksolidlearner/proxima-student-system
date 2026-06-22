<div class="container" style="margin:30px 0;max-width: 100%;">
  <div class="row">
    <!-- <div class="col-sm-1"></div> -->
  	<div class="col-md-12">
  		<h2 style="color: gray">Upload Assignment</h2>
      <div class="box" style="box-shadow: 0 0 5px gray;">
        <div class="box-header">
          <h5 class="box-title" style="margin-bottom: 20px;background-color: #4b8df8;padding: 10px;color: #fff"><i class="fa fa-list"></i> Class Name (<?=$class['class_name']?>)</h5>
        </div>
        <div class="box-body" style="padding: 10px">
          <table id="example" class="table table-striped table-bordered" style="width:100%">
              <thead>
              <tr>
                  <th>ID</th>
                  <th>Class Name</th>
                  <th>Subject Name</th>
                  <th>Assignment File</th>
                  <th>Upload</th>
              </tr>
              </thead>
              <tbody>
              <?php foreach ($results as $r) {?>
              <tr>
                <td><?=$r['id'];?></td>
                  <td><?=$r['class_name']; ?></td>
                  <td><?=$r['subject_name'];?></td>
                  <td><?=$r['assign_file'];?></td>
                  <td><I>no file uploaded</I></td>
              </tr>
              <?php } ?>
              </tbody>
          </table>               
        </div>
      </div>
  	</div>
  </div>
</div>
