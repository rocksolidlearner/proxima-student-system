<div class="container" style="margin:30px 0;max-width: 100%;">
  <div class="row">
    <!-- <div class="col-sm-1"></div> -->
  	<div class="col-md-12">
  		<h2 style="color: gray">Dashboard</h2>
      <div class="box" style="box-shadow: 0 0 5px gray;border-bottom: 15px solid #4b8df8">
        <div class="box-header">
          <h5 class="box-title" style="margin-bottom: 20px;background-color: #4b8df8;padding: 10px;color: #fff"><i class="fa fa-list"></i> Child Record</h5>
        </div>
        <div class="box-body" style="padding: 10px">
          <table id="example" class="table table-striped table-bordered" style="width:100%">
              <thead>
              <tr>
                  <th>No.</th>
                  <th>Name</th>
                  <th>Class</th>
              </tr>
              </thead>
              <tbody>
              <?php foreach ($childs as $p) {?>
              <tr>
                  <td><?php echo $p['roll_no']; ?></td>
                  <td><?php echo $p['std_name']; ?></td>
                  <td><?php echo $p['class_name']; ?></td>
              </tr>
              <?php } ?>
              </tbody>
          </table>               
        </div>
      </div>
  	</div>
  </div>
</div>
