<script type="text/javascript">
    <?php if($this->session->flashdata('success')){  ?>
    toastr.success("<?php echo $this->session->flashdata('success'); ?>");
    <?php } ?>
    <?php if($this->session->flashdata('info')){  ?>
    toastr.info("<?php echo $this->session->flashdata('info'); ?>");
    <?php } ?>
</script>
<div class="container" style="margin:30px 0;max-width: 100%;">
  <div class="row">
  	<div class="col-md-12">
  		<h2 style="color: gray;margin-bottom: 20px">Dashboard</h2>
      <div class="row">
        <div class="col-md-6" style="margin-bottom: 20px">
          <div class="box" style="box-shadow: 0 0 5px gray;border-bottom: 15px solid #4b8df8">
            <div class="box-header">
              <h5 class="box-title" style="margin-bottom: 20px;background-color: #4b8df8;padding: 10px;color: #fff"><i class="fa fa-list"></i> Class Assign</h5>
            </div>
            <div class="box-body" style="padding: 10px">
              <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Class Name</th>
                    <th>Total Students</th>
                    <th>Subjects</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($results as $r) {?>
                <tr>
                  <td><?=$r['id'];?></td>
                  <td><?=$r['class_name']; ?></td>
                  <td><?=$r['std_name'];?></td>
                  <td><?=$r['comments'];?></td>
                </tr>
                <?php }?>
                </tbody>
              </table> 
            </div>
          </div>
        </div>
        <div class="col-md-6" style="margin-bottom: 20px">
          <div class="box" style="box-shadow: 0 0 5px gray;border-bottom: 15px solid #35aa47">
            <div class="box-header">
              <h5 class="box-title" style="margin-bottom: 20px;background-color: #35aa47;padding: 10px;color: #fff"><i class="fa fa-list"></i> Subject Assign</h5>
            </div>
            <div class="box-body" style="padding: 10px">
              <table id="example1" class="table table-striped table-bordered" style="width:100%">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Class Name</th>
                    <th>Subject Name</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($results as $r) {?>
                <tr>
                  <td><?=$r['id'];?></td>
                  <td><?=$r['class_name']; ?></td>
                  <td><?=$r['std_name'];?></td>
                </tr>
                <?php }?>
                </tbody>
              </table> 
            </div>
          </div>
        </div>
        <div class="col-md-6" style="margin-bottom: 20px">
          <div class="box" style="box-shadow: 0 0 5px gray;border-bottom: 15px solid #35aa47">
            <div class="box-header">
              <h5 class="box-title" style="margin-bottom: 20px;background-color: #35aa47;padding: 10px;color: #fff"><i class="fa fa-list"></i> File Assign</h5>
            </div>
            <div class="box-body" style="padding: 10px">
              <table id="example2" class="table table-striped table-bordered" style="width:100%">
                <thead>
                <tr>
                    <th>No</th>
                    <th>File Name</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($results as $r) {?>
                <tr>
                  <td><?=$r['id'];?></td>
                  <td><?=$r['std_name'];?></td>
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
