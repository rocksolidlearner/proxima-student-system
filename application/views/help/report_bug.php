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
        /* max-width: 340px; */
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

    .browse-btn{
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
<div class="row">
    <div class="col-md-12">
      	<div class="x_panel">
            <div class="x_title">
              	<h2>Contact Us</h2>
				<div class="clearfix"></div>
            </div>
			<div class="x_content">
				<?php echo form_open_multipart('report-bug'); ?>
				<div class="row clearfix">
					<div class="col-md-6">
						<h4>Contacts</h4>
						<hr>
						<label class="control-label">Please report us bug to improve our software. You can also submit screen shot files or any other files to us. </label>
						<div class="form-group">
							<h4>Address</h4>
							<label><b>creativeON</b></label>
							<p><?=$this->data['setting']['address']?></p>
							<label><b>Email</b></label>
							<p><a href="mailto:<?=$this->data['setting']['email']?>"><?=$this->data['setting']['email']?></a></p>
						</div>
					</div>
					
					<div class="col-md-6">
						<h4>Report your bug</h4>
						<hr>
						<label for="email" class="control-label">Name</label>
						<div class="form-group">
							<input type="text" name="name" value="<?=$this->session->userdata('name')?>" class="form-control" id="name">
							<span class="text-danger"><?php echo form_error('name');?></span>
						</div>
						<label for="email" class="control-label">Email</label>
						<div class="form-group">
							<input type="email" name="email" value="<?=$this->session->userdata('email')?>" class="form-control" id="email">
							<span class="text-danger"><?php echo form_error('email');?></span>
						</div>
						<label for="phone" class="control-label">Phone</label>
						<div class="form-group">
							<input type="text" name="phone" maxlength="16" value="<?=$this->input->post('phone')?>" class="form-control" id="phone">
						</div>
						<label for="address" class="control-label">Detail about bug</label>
						<div class="form-group">
							<textarea name="bug" placeholder="Detail about bug..." rows="3" class="form-control" id="bug" style="resize: none;"><?=$this->input->post('bug')?></textarea>
						</div>
						<label for="logo" class="control-label">Attach a File (Screenshot etc.)</label>
                    	<div class="form-group">
                        	<div class="input-container">
                            	<input type="file" name="file" class="form-control" id="real-input">
                            	<button type="button" class="browse-btn" style="margin-bottom: 0">Browse Files</button>
                            	<span class="file-info">Attach a File</span>
                        	</div>
						</div>
						<div class="form-group text-right">
							<button type="submit" class="btn btn-success"><i class="fa fa-check-circle"></i> Send</button>
						</div>
					</div>
					
				</div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>

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