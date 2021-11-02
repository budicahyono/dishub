<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-warning box-solid">
    
                    <div class="box-header">
                        <h3 class="box-title">KELOLA DATA KEGIATAN</h3>
                    </div>
        <h2 style="margin-top:0px">Kegiatan Read</h2>
        <table class="table">
	    <tr><td>Nama kegiatan</td><td><?php echo $nama_kegiatan; ?></td></tr>
	    <tr><td>Tgl Kegiatan</td><td><?php echo $tgl_kegiatan; ?></td></tr>
	    <tr><td>Lokasi</td><td><?php echo $lokasi; ?></td></tr>
	    <tr><td>Mata Anggaran</td><td><?php echo $mata_anggaran; ?></td></tr>
	    <tr><td>Pelaksana Kegiatan</td><td><?php echo $pelaksana_kegiatan; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('kegiatan') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        