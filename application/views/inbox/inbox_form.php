
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
<div class="content-wrapper">
    
    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA INBOX <?=$form?></h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">
            
<table class='table table-bordered'>        
		<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
		<input type="hidden" name="jenis" value="<?=$menu?>">
	    
	    <tr><td width='200'>Judul <?php echo form_error('judul') ?></td><td><input type="text" required class="form-control" name="judul" id="judul" placeholder="Judul" value="<?php echo $judul; ?>" /></td></tr>
	    <tr><td width='200'>Tanggal <?php echo form_error('tgl') ?></td><td><input type="text" readonly class="form-control" name="tgl"  placeholder="Tanggal" value="<?php 
		if ($tgl != "") {
										echo date("d-m-Y", strtotime($tgl));
									} else {
										echo date("d-m-Y");
									}
		?>" /></td></tr>
	    <tr><td></td><td><input type="hidden" name="id_inbox" value="<?php echo $id_inbox; ?>" /> 
	    <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
	    <a href="<?php echo site_url('inboxes/'.$menu) ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
	</table></form>        </div>
</div>
</div>