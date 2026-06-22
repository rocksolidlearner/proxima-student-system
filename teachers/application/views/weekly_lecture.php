<div class="container" style="margin:30px 0;max-width: 100%;">
  <div class="row">
    <!-- <div class="col-sm-1"></div> -->
  	<div class="col-md-12">
  		<h2 style="color: gray">Weekly Lecture</h2>
      <div class="box" style="box-shadow: 0 0 5px gray;">
        <div class="box-header">
          <h5 class="box-title" style="margin-bottom: 20px;background-color: #4b8df8;padding: 10px;color: #fff"><i class="fa fa-list"></i> Weekly Lecture Schedule</h5>
        </div>
        <div class="box-body" style="padding: 10px">
          <table id="example" class="table table-striped table-bordered" style="width:100%">
              <thead>
              <tr>
                  <th>Time</th>
                  <th>Monday</th>
                  <th>Tuesday</th>
                  <th>Wednesday</th>
                  <th>Thursday</th>
                  <th>Friday</th>
                  <th>Saturday</th>
              </tr>
              </thead>
              <tbody>
              <?php foreach ($results as $r) {?>
              <tr>
                <td><?='<b>'.$r['id'].'. '.$r['shift_name'].'</b><br>'.
                        $r['start_time'].' > '.$r['end_time']?></td>
                <td><?=$r['day'];?></td>
                <td><?=$r['day'];?></td>
                <td><?=$r['day'];?></td>
                <td><?=$r['day'];?></td>
                <td><?=$r['day'];?></td>
                <td><?=$r['day'];?></td>
              </tr>
              <?php }?>
              </tbody>
          </table>               
        </div>
      </div>
  	</div>
  </div>
</div>
