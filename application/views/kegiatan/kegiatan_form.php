<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
<div class="content-wrapper">
    
    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA KEGIATAN</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">
            
<table class='table table-bordered'>        
		<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
	    
	    <tr><td width='200'>Nama kegiatan <?php echo form_error('nama_kegiatan') ?></td><td><input type="text" class="form-control" name="nama_kegiatan" id="nama_kegiatan" placeholder="Nama kegiatan" value="<?php echo $nama_kegiatan; ?>" /></td></tr>
	    <tr><td width='200'>Tanggal Awal <?php echo form_error('tgl_kegiatan') ?></td><td><input type="text" class="form-control" name="tgl_kegiatan" id="calendar2" placeholder="Tanggal Awal" value="<?php 
									if ($tgl_kegiatan != "") {
										echo date("d-m-Y", strtotime($tgl_kegiatan));
									} else {
										echo "";
									}
									
									?>" /></td></tr>
		<tr><td width='200'>Tanggal Akhir <?php echo form_error('tgl_akhir') ?></td><td>
		
		<input type="text" class="form-control" name="tgl_akhir" id="calendar" placeholder="Tanggal Akhir" value="<?php

									if ($tgl_akhir != "") {
										echo date("d-m-Y", strtotime($tgl_akhir));
									} else {
										echo "";
									} 							
									
									
									?>" />
		</td></tr>
	    <tr><td width='200'>Lokasi <?php echo form_error('lokasi') ?></td><td><input type="text" class="form-control" name="lokasi" id="lokasi" placeholder="Lokasi" value="<?php echo $lokasi; ?>" /></td></tr>
	    <tr><td width='200'>Mata Anggaran <?php echo form_error('mata_anggaran') ?></td><td><input type="text" class="form-control" name="mata_anggaran" id="mata_anggaran" placeholder="Mata Anggaran" value="<?php echo $mata_anggaran; ?>" /></td></tr>
	    <tr><td width='200'>Pelaksana Kegiatan <?php echo form_error('pelaksana_kegiatan') ?></td><td><input type="text" class="form-control" name="pelaksana_kegiatan" id="pelaksana_kegiatan" placeholder="Pelaksana Kegiatan" value="<?php echo $pelaksana_kegiatan; ?>" /></td></tr>
	    <tr><td></td><td><input type="hidden" name="id_kegiatan" value="<?php echo $id_kegiatan; ?>" /> 
	    <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
	    <a href="<?php echo site_url('kegiatan') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
	</table></form>        </div>
</div>
</div>