<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
<div class="content-wrapper">
    
    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA USER</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">
            
<table class='table table-bordered'>        
		<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
	    <tr><td width='200'>Nama </td><td><input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?php echo $nama; ?>" />
		<?php echo form_error('nama') ?>
		</td></tr>
	    <tr><td width='200'>Username </td><td><input type="text" class="form-control" name="username" id="username" placeholder="Username" value="<?php echo $username; ?>" />
		<?php echo form_error('username') ?>
		</td></tr>
	    <tr><td width='200'>Password </td><td><input type="password" class="form-control" name="password" id="password" placeholder="Password" value="" />
		<?php echo form_error('password') ?>
		</td></tr>
	    <tr><td width='200'>Level </td><td>
		<select class="form-control" name="level">
			<option value="">--Pilih Level User</option>
			<option value="admin" <?php if ($level=="admin") {echo "selected";} ?> >Admin</option>
			<option value="operator" <?php if ($level=="operator") {echo "selected";} ?>>Operator</option>
		</select>
		<?php echo form_error('level') ?>
		</td></tr>
	    <tr><td></td><td><input type="hidden" name="id_admin" value="<?php echo $id_admin; ?>" /> 
	    <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
	    <a href="<?php echo site_url('user') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
	</table></form>        </div>
</div>
</div>