<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
<div class="content-wrapper">
    
    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">UPLOAD DATA DOKUMEN DARI INBOX <?=strtoupper($judul)?></h3>
            </div>
            <?php echo form_open_multipart('inboxfile/create_action');?>
			
<table class='table table-bordered'>     
		<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
	    
	    <tr><td width='200'>Nama File </td><td>
		<input type="text" class="form-control" name="nm_file" id="nm_file" placeholder="Nama File" value="" />
		</td></tr>
	    
		<tr><td width='200'>File </td><td>
		<input required  type="file" class="btn btn-sm btn-default" id="dokumen" name="dokumen"  >
		<label style="padding-top:5p">Harap upload file berformat PDF, JPG, JPEG, dan PNG dengan ukuran maksimal 5MB</label>
		</td></tr>
	    
	    <tr><td></td><td>
		<input type="hidden" name="menu" value="<?php echo $menu; ?>" /> 
		<input type="hidden" name="id_inboxfile" value="<?php echo $id_inboxfile; ?>" /> 
		<input type="hidden" name="id_inbox" value="<?php echo $id_inbox; ?>" /> 
	    <button type="submit" name="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
	    <a href="<?php echo site_url('inboxes/upload/'.$id_inbox.'?jenis='.$menu) ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
	</table>
			</form>   





			
	</div>
</div>
</div>