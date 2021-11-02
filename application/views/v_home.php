<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header"></h1>
			</div>
		
		<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">Dashboard</div>
					<div class="panel-body">
					<?php if ($this->session->flashdata('status') != null) { ?>
					<div class="alert bg-success" role="alert">
					<svg class="glyph stroked checkmark"><use xlink:href="#stroked-checkmark"/></svg>
					<?php echo $this->session->flashdata('status') ?>	
					<a  class="close" data-dismiss="alert" aria-label="close"><span class="glyphicon glyphicon-remove"></span></a>
					</div>
					<?php } ?>
<?php if ($_SESSION['level'] != "operator") { ?>
		<div class="row">
			<div class="col-xs-12 col-md-6 col-lg-6">
				<div class="panel panel-blue panel-widget ">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-3 widget-left">
							<svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg>
						</div>
						<div class="col-sm-9 col-lg-9 widget-right">
							<div class="large"><?=$user?>
							<a href="<?php echo base_url('user');?>" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-right"></span> Selengkapnya</a>
							</div>
							<div class="text-muted">Data User</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="col-xs-12 col-md-6 col-lg-6">
				<div class="panel panel-teal panel-widget">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-3 widget-left">
							<svg class="glyph stroked notepad "><use xlink:href="#stroked-notepad"/></svg>
						</div>
						<div class="col-sm-9 col-lg-9 widget-right">
							<div class="large"><?=$kegiatan?>
							<a href="<?php echo base_url('kegiatan');?>" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-right"></span> Selengkapnya</a>
							</div>
							<div class="text-muted">Kegiatan</div>
						</div>
					</div>
				</div>
			</div>
			
			
			
		</div><!--/.row-->
<?php } ?>
		
		<div class="row">
			<div class="col-xs-12 col-md-6 col-lg-6">
				<div class="panel panel-blue panel-widget ">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-3 widget-left">
							<svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg>
						</div>
						<div class="col-sm-9 col-lg-9 widget-right">
							<div class="large"><?=$usul?>
							<a href="<?php echo base_url('inboxes/usul');?>" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-right"></span> Selengkapnya</a>
							</div>
							<div class="text-muted">Inbox Usul</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="col-xs-12 col-md-6 col-lg-6">
				<div class="panel panel-teal panel-widget">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-3 widget-left">
							<svg class="glyph stroked notepad "><use xlink:href="#stroked-notepad"/></svg>
						</div>
						<div class="col-sm-9 col-lg-9 widget-right">
							<div class="large"><?=$laporan?>
							<a href="<?php echo base_url('inboxes/laporan');?>" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-right"></span> Selengkapnya</a>
							</div>
							<div class="text-muted">Inbox Laporan</div>
						</div>
					</div>
				</div>
			</div>
			
			
			
		</div><!--/.row-->			
						
					</div>
					
				</div>
			</div>
		
		
		
	</div>	<!--/.main-->