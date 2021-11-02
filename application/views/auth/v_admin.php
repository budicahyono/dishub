<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header"></h1>
			</div>
		
		
		
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Ubah Password User</div>
					<div class="panel-body">
					
					<?php if ($this->session->flashdata('status') != null) { ?>
					<div class="alert bg-success" role="alert">
					<svg class="glyph stroked checkmark"><use xlink:href="#stroked-checkmark"/></svg>
					<?php echo $this->session->flashdata('status') ?>	
					<a  class="close" data-dismiss="alert" aria-label="close"><span class="glyphicon glyphicon-remove"></span></a>
					</div>
					<?php } ?>
					
						<?php foreach ($auth->result() as $r) { ?>
						<form action="<?php echo base_url();?>auth/proses_admin" method="post" enctype="multipart/form-data">
								<input value="<?php echo $r->id_admin ?>" name="id_admin" type="hidden"  >
								<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
																
								<div class="form-group">
									<label>Nama</label>
									<input value="<?php echo $r->nama ?>" name="nama" type="text" class="form-control">
								</div>
								
								
																
								<div class="form-group">
									<label>Username</label>
									<input value="<?php echo $r->username ?>" name="username" type="text" class="form-control">
								</div>
								
								<div class="form-group">
									<label>Password</label>
									<input value="" name="password" type="password" class="form-control">
								</div>
								
								<button name="submit" type="submit" class="btn btn-primary">Simpan</button>
								<button type="reset" class="btn btn-warning">Reset</button>
							
						</form>
						<?php } ?>
					</div>
				</div>
			</div><!-- /.col-->
		
		
		
	</div>	<!--/.main-->