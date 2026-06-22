<div class="container" style="margin:30px 0;max-width: 100%;">
  <div class="row">
  	<div class="col-md-12">
  		<h2 style="color: gray;margin-bottom: 20px">Profile</h2>
      <div class="box" style="box-shadow: 0 0 5px gray;">
        <div class="box-header">
          <h5 class="box-title" style="margin-bottom: 20px;background-color: #35aa47;padding: 10px;color: #fff"><i class="fa fa-list"></i> View Profile</h5>
        </div>
        <div class="box-body" style="padding: 10px">
          <table class="table table-bordered">
            <tr>
              <td align="right" style="width: 25%;">Name</td>
              <td style="border-right: 0"><input disabled class="form-control" value="<?=$this->session->userdata('std_name')?>"></td>
              <td style="width: 30%;border-left: 0"></td>
            </tr>
            <tr>
              <td align="right" style="width: 25%;">Admission number</td>
              <td style="border-right: 0"><input disabled class="form-control" value="<?=$this->session->userdata('admission_no')?>"></td>
              <td style="width: 30%;border-left: 0"></td>
            </tr>
            <tr>
              <td align="right" style="width: 25%;">Roll No</td>
              <td style="border-right: 0"><input disabled class="form-control" value="<?=$this->session->userdata('roll_no')?>"></td>
              <td style="width: 30%;border-left: 0"></td>
            </tr>
            <tr>
              <td align="right" style="width: 25%;">Father Name</td>
              <td style="border-right: 0"><input disabled class="form-control" value="<?=$this->session->userdata('father_name')?>"></td>
              <td style="width: 30%;border-left: 0"></td>
            </tr>
            <tr>
              <td align="right" style="width: 25%;">DOB</td>
              <td style="border-right: 0"><input disabled class="form-control" value="<?=date('d-M-Y',strtotime($this->session->userdata('dob')))?>"></td>
              <td style="width: 30%;border-left: 0"></td>
            </tr>
            <tr>
              <td align="right" style="width: 25%;">Gender</td>
              <td style="border-right: 0"><input disabled class="form-control" value="<?php if($this->session->userdata('gender') == INACTIVE){ echo'Male';}else{echo'Female';}?>"></td>
              <td style="width: 30%;border-left: 0"></td>
            </tr>
            <tr>
              <td align="right" style="width: 25%;">Batch</td>
              <td style="border-right: 0"><input disabled class="form-control" value="<?=$this->session->userdata('batch_name')?>"></td>
              <td style="width: 30%;border-left: 0"></td>
            </tr>
            <tr>
              <td align="right" style="width: 25%;">Class</td>
              <td style="border-right: 0"><input disabled class="form-control" value="<?=$this->session->userdata('class_name')?>"></td>
              <td style="width: 30%;border-left: 0"></td>
            </tr>
            <tr>
              <td align="right" style="width: 25%;">Admission Date</td>
              <td style="border-right: 0"><input disabled class="form-control" value="<?=date('d-M-Y',strtotime($this->session->userdata('admission_date')))?>"></td>
              <td style="width: 30%;border-left: 0"></td>
            </tr>
          </table>
        </div>
      </div>
  	</div>
  </div>
</div>
