<script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script> 
<script type="text/javascript">
    bkLib.onDomLoaded(function () {
        nicEditors.allTextAreas()
    });
</script>
<script type="text/javascript">
    <?php if($this->session->flashdata('success')){  ?>
    toastr.success("<?php echo $this->session->flashdata('success'); ?>");
    <?php } ?>
</script>
<script type="text/javascript">
    <?php if($this->session->flashdata('info')){  ?>
    toastr.info("<?php echo $this->session->flashdata('info'); ?>");
    <?php } ?>
</script>
<style type="text/css">
    .input-container {
        margin: 0 auto;
        max-width: 340px;
        background-color: #EDEDED;
        border: 1px solid #DFDFDF;
        border-radius: 5px;
    }

    input[type='file'] {
        display: none;
    }

    .file-info,.file-info1,.file-info2{
        font-size: 0.9em;
        color: #176c9d;
    }

    .browse-btn,.browse-btn1,.browse-btn2{
        background: #176c9d;
        color: #fff;
        min-height: 35px;
        padding: 10px;
        border: none;
        border-top-left-radius: 5px;
        border-bottom-left-radius: 5px;
    }

    .browse-btn:hover,.browse-btn1:hover,.browse-btn2:hover {
        background: #3c8dbc;
    }

    @media (max-width: 300px) {
        button {
            width: 100%;
            border-top-right-radius: 5px;
            border-bottom-left-radius: 0;
        }

        .file-info,.file-info1,.file-info2{
            display: block;
            margin: 7px 5px;
        }
    }
</style>
<?php echo form_open_multipart('app-setting'); ?>
<div class="row">
    <div class="col-md-12">
      	<div class="x_panel">
            <div class="x_title">
              	<h2>Application Settings</h2>
				<div class="clearfix"></div>
            </div>
			<div class="x_content">
				<div class="row clearfix">
					<div class="col-md-4">
						<label class="control-label">System's Internal Name</label>
						<div class="form-group">
							<input type="text" name="website_name" value="<?=$this->data['setting']['website_name']?>" class="form-control" id="website_name">
							<span class="text-danger"></span>
						</div>
					</div>
					<div class="col-md-4">
						<label for="email" class="control-label">Admin Email</label>
						<div class="form-group">
							<input type="text" name="email" value="<?=$this->data['setting']['email']?>" class="form-control" id="email">
							<span class="text-danger"></span>
						</div>
					</div>
					<div class="col-md-4">
						<label for="phone" class="control-label">Institute's Contact Numbers</label>
						<div class="form-group">
							<input type="text" name="phone" placeholder="+92 303 785 9398" maxlength="16" value="<?=$this->data['setting']['phone']?>" class="form-control" id="phone">
						</div>
					</div>
					<div class="col-md-2" hidden>
						<label for="website_name" class="control-label">Short Name</label>
						<div class="form-group">
							<input type="text" name="short_name" value="<?=$this->data['setting']['short_name']?>" class="form-control" id="website_name">
							<span class="text-danger"></span>
						</div>
					</div>
					<div class="col-md-8">
						<label for="address" class="control-label">Institute's Address</label>
						<div class="form-group">
							<textarea name="address" placeholder="Institute's Address..." rows="6" class="form-control" id="address" style="resize: none;"><?=$this->data['setting']['address']?></textarea>
						</div>
					</div>
					<div class="col-md-4">
						<label for="logo" class="control-label">Upload Logo</label>
                    	<div class="form-group">
                        	<div class="input-container">
                            	<input type="file" name="logo" class="form-control" id="real-input">
                            	<button type="button" class="browse-btn">Browse Files</button>
                            	<span class="file-info">Upload Logo</span>
                        	</div>
							<img src="<?=base_url('uploads/'.$this->data['setting']['logo'])?>" style="height: 160px; width: 100%">
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-12">
      	<div class="x_panel">
            <div class="x_title">
              	<h2>Currency and Date Settings</h2>
				<div class="clearfix"></div>
            </div>
			<div class="x_content">
				<div class="row">
					<div class="col-md-4">
						<label class="control-label">Currency Symbol/Name</label>
						<div class="form-group">
							<input type="text" name="currency_symbol" value="<?=$this->data['setting']['currency_symbol']?>" class="form-control" id="currency_symbol">
							<span class="text-danger"></span>
						</div>
					</div>
					<div class="col-md-4">
						<label class="control-label">Currency Decimals</label>
						<div class="form-group">
							<input type="text" name="currency_decimals" value="<?=$this->data['setting']['currency_decimals']?>" class="form-control" id="currency_decimals">
							<span class="text-danger"></span>
						</div>
					</div>
					<div class="col-md-4">
						<label class="control-label">Marks Decimals</label>
						<div class="form-group">
							<input type="text" name="mark_decimals" value="<?=$this->data['setting']['mark_decimals']?>" class="form-control" id="mark_decimals">
							<span class="text-danger"></span>
						</div>
					</div>
					<div class="col-md-4">
						<label class="control-label">Is application language RTL (Right to Left)</label>
						<div class="form-group">
							<input type="text" name="language" value="<?=$this->data['setting']['language']?>" class="form-control" id="language">
							<span class="text-danger"></span>
						</div>
					</div>
					<div class="col-md-4">
						<label class="control-label">Date Format</label>
						<div class="form-group">
							<input type="text" name="date_formate" value="<?=$this->data['setting']['date_formate']?>" class="form-control" id="date_formate">
							<span class="text-danger"></span>
						</div>
					</div>
					<div class="col-md-4">
						<label class="control-label">Date/Time Format</label>
						<div class="form-group">
							<input type="text" name="dt_formate" value="<?=$this->data['setting']['dt_formate']?>" class="form-control" id="dt_formate">
							<span class="text-danger"></span>
						</div>
					</div>
					<div class="col-md-4">
						<label class="control-label">Long Date Format</label>
						<div class="form-group">
							<input type="text" name="lg_date_fromate" value="<?=$this->data['setting']['lg_date_fromate']?>" class="form-control" id="lg_date_fromate">
							<span class="text-danger"></span>
						</div>
					</div>
					<div class="col-md-4">
						<label class="control-label">Long Date/Time Format</label>
						<div class="form-group">
							<input type="text" name="lg_dt_formate" value="<?=$this->data['setting']['lg_dt_formate']?>" class="form-control" id="lg_dt_formate">
							<span class="text-danger"></span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-12">
      	<div class="x_panel">
            <div class="x_title">
              	<h2>Reporting</h2>
				<div class="clearfix"></div>
            </div>
			<div class="x_content">
				<div class="row">
					<div class="col-md-4">
						<label class="control-label">PDF Report Page Size</label>
						<div class="form-group">
							<input type="text" name="page_size" value="<?=$this->data['setting']['page_size']?>" class="form-control" id="page_size">
							<span class="text-danger"></span>
						</div>
					</div>
					<div class="col-md-4">
						<label class="control-label">PDF Report Page Orientation</label>
						<div class="form-group">
							<select class="form-control" name="page_orientation">
								<?php $types = array(
								'Portrait' => 'Portrait',
								'Landscape' => 'Landscape'
								);
								foreach($types as $key => $v)
								{
									$selected = ($v == $this->data['setting']['page_orientation']) ? ' selected="selected"' : "";

									echo '<option value="'.$v.'" '.$selected.'>'.$key.'</option>';
								} ?>
							</select>
						</div>
					</div>
					<div class="col-md-4">
						<label for="logo" class="control-label">Upload PDF Logo</label>
                    	<div class="form-group">
                        	<div class="input-container">
                            	<input type="file" name="pdf_logo" class="form-control" id="real-input1">
                            	<button type="button" class="browse-btn1">Browse Files</button>
                            	<span class="file-info1">Upload PDF Logo</span>
                        	</div>
							<img src="<?=base_url('uploads/'.$this->data['setting']['pdf_logo'])?>" style="height: 100px; width: 100%">
                    	</div>
					</div>
					<div class="col-md-12 text-right">
						<button type="submit" class="btn btn-success">
							<i class="fa fa-check"></i> Save
						</button>
					</div>
				</div>
			</div>		
		</div>
    </div>
</div>
<?php echo form_close(); ?>
<script type="text/javascript">
    const uploadButton = document.querySelector('.browse-btn');
    const fileInfo = document.querySelector('.file-info');
    const realInput = document.getElementById('real-input');

    const uploadButton1 = document.querySelector('.browse-btn1');
    const fileInfo1 = document.querySelector('.file-info1');
    const realInput1 = document.getElementById('real-input1');

    uploadButton.addEventListener('click', (e) => {
        realInput.click();
    });
    uploadButton1.addEventListener('click', (e) => {
        realInput1.click();
    });

    realInput.addEventListener('change', (e) => {
        const name = realInput.value.split(/\\|\//).pop();
    const truncated = name.length > 20
        ? name.substr(name.length - 20)
        : name;

    fileInfo.innerHTML = truncated;
    });
    realInput1.addEventListener('change', (e) => {
        const name = realInput1.value.split(/\\|\//).pop();
    const truncated = name.length > 20
        ? name.substr(name.length - 20)
        : name;

    fileInfo1.innerHTML = truncated;
    });

</script>