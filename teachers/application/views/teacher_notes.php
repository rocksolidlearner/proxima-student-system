<div class="container" style="margin:30px 0;max-width: 100%;">
  <div class="row">
    <!-- <div class="col-sm-1"></div> -->
  	<div class="col-md-12">
  		<h2 style="color: gray">Teacher Notes</h2>
      <div class="box" style="box-shadow: 0 0 5px gray;">
        <div class="box-header">
          <h5 class="box-title" style="margin-bottom: 20px;background-color: #4b8df8;padding: 10px;color: #fff"><i class="fa fa-user"></i> Student</h5>
        </div>
        <div class="box-body" style="padding: 10px">
          <table id="example" class="table table-striped table-bordered" style="width:100%">
              <thead>
              <tr>
                  <th>ID</th>
                  <th>Student Name</th>
                  <th>Class</th>
                  <th>Comments</th>
                  <th>Action</th>
              </tr>
              </thead>
              <tbody>
              <?php foreach ($results as $r) {?>
              <tr>
                <td><?=$r['id'];?></td>
                <td><?=$r['std_name'];?></td>
                <td><?=$r['class_name']; ?></td>
                <td><?=$r['comments'];?></td>
                <td><?=$r['status']?></td>
              </tr>
              <?php }?>
              </tbody>
          </table>               
        </div>
      </div>
  	</div>
  </div>
</div>
