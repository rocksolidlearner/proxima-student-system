<!-- <link rel="stylesheet" href="<?=base_url('assets/css/bootstrap.min.css')?>" />
<script src="<?=base_url('assets/js/jquery.min.js'); ?>"></script> -->

<div class="row">
    <div class="col-md-12 col-sm-12">
		<div class="x_panel">
            <div class="x_title">
                <h2>Student<small><i class="fa fa-upload"></i> Import Student</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
			<div class="x_content">
				<div class="row">
					<div class="col-md-3"></div>
					<div class="col-md-6">
						<?php if($this->session->flashdata('success')!= ''){?>
							<div class="alert alert-success alert-dismissible fade in" id="success-alert">
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								<center>
									<strong><li class="fa fa-check"></li> </strong><?php echo $this->session->flashdata('success');?>
								</center>
							</div>
						<?php }elseif($this->session->flashdata('info')!=''){?>
							<div class="alert alert-info alert-dismissible fade in" id="info-alert">
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								<center>
									<strong><li class="fa fa-info"></li> </strong><?php echo $this->session->flashdata('info'); ?>
								</center>
							</div>
						<?php }else{?>
							<p></p>
						<?php }?>
					</div>
					<div class="col-md-3"></div>
				</div>
				<?php echo form_open_multipart('student-import'); ?>
					<div class="col-md-3"></div>
					<div class="col-md-4">
						<div class="form-group">
							<input name="file" type="file" class="custom-file-input" id="file">
							<label class="custom-file-label custom-file-label-primary" id="file_lab" for="file" style="margin-left: 0px;width: 350px;">Select Student ExcelSheet</label>
						</div>
					</div>
					<div class="col-md-2">
						<button type="submit" name="import" class="hvr-grow btn btn-success" style="padding: 0.260rem .75rem"><li class="fa fa-upload"></li> Upload</button>
					</div>
					<div class="col-md-3"></div>
				<?php echo form_close(); ?>
				<div class="row">
					<div class="col-md-12">
						<h2>Demo Import ExcelSheet For Student</h2>
						<table class="table table-striped table-bordered" style="width:100%">
							<thead style="background: gray">
							<tr>
								<th style="color: #fff">Status</th>
								<th style="color: #fff">Adm. Number</th>
								<th style="color: #fff">Class_id</th>
								<th style="color: #fff">Roll</th>
								<th style="color: #fff">Fee</th>
								<th style="color: #fff">Adm. Date</th>
								<th style="color: #fff">Name</th>
								<th style="color: #fff">Father Name</th>
								<th style="color: #fff">DOB</th>
								<th style="color: #fff">Gender</th>
								<th style="color: #fff">Relation</th>
								<th style="color: #fff">Guardian Cell</th>
							</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div>
		
	</div>
</div>
<script>
	//ALert box auto close
	$(document).ready (function(){
		$("#success-alert").fadeTo(3000, 1000).slideUp(2000, function(){
			$("#success-alert").slideUp(2000);
		});
		$("#info-alert").fadeTo(3000, 1000).slideUp(2000, function(){
			$("#info-alert").slideUp(2000);
		});
	});
</script>