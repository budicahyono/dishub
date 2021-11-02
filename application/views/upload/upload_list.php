<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-warning box-solid">
    
                    <div class="box-header">
                        <h3 class="box-title">KELOLA DOKUMEN KEGIATAN <?=strtoupper($nama_kegiatan)?></h3>
                    </div>
        
        <div class="box-body">
            <div class='row'>
            <div class='col-md-9'>
            <div style="padding-bottom: 10px;">
			 <?php echo anchor(site_url('kegiatan'), '<i class="glyphicon glyphicon-arrow-left" aria-hidden="true"></i> Kembali', 'class="btn btn-warning btn-sm"'); ?>
        <?php echo anchor(site_url('upload/create/'.$id_kegiatan), '<i class="fa fa-wpforms" aria-hidden="true"></i> Tambah Dokumen', 'class="btn btn-danger btn-sm"'); ?>
		<?php echo anchor(site_url('upload/excel'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Export Ms Excel', 'class="btn btn-success btn-sm"'); ?>
		<?php echo anchor(site_url('upload/word'), '<i class="fa fa-file-word-o" aria-hidden="true"></i> Export Ms Word', 'class="btn btn-primary btn-sm"'); ?></div>
            </div>
            
            </div>
        <?php if ($this->session->flashdata('error') != null) { ?>
					<div class="alert bg-danger" role="alert">
					<svg class="glyph stroked checkmark"><use xlink:href="#stroked-checkmark"/></svg>
					<a  class="close" data-dismiss="alert" aria-label="close"><span class="glyphicon glyphicon-remove"></span></a>
					<?php echo $this->session->flashdata('error') ?>
					
					</div>
					<?php } ?>	
   
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                
            </div>
        </div>
        <table class="table table-bordered" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Nama Dokumen</th>
		<th>Preview</th>
		<th>Nama FIle</th>
		<th>Ukuran</th>
		<th>Jenis</th>
		<th>Tanggal Upload</th>
		<th>User</th>
		<th>Action</th>
            </tr><?php $start=0;
            foreach ($upload_data->result() as $upload)
            {
                ?>
                <tr>
			<td width="10px"><?php echo ++$start ?></td>
			<td><?php echo $upload->nm_file ?></td>
			<td>
			<?php if ($upload->jenis == "application/pdf") { 
				$pdf = base_url()."assets/pdf.png";
			?>
			<img  id="output" src="<?=$pdf?>" style="height:100px" class="muncul thumbnail img-responsive">
			<?php } else { 
				$foto = base_url()."doc/".$id_kegiatan."/".$upload->file;
			?>
			<img  id="output" src="<?=$foto?>" style="height:100px" class="muncul thumbnail img-responsive">
			<?php } ?>
			</td>
			<td><?php echo $upload->file ?></td>
			<td><?php echo $upload->ukuran ?>KB</td>
			<td><?php echo $upload->jenis ?></td>
			<td><?php echo tgl_indo($upload->tgl) ?></td>
			<td><?php echo $upload->user ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('upload/download/'.$upload->id_upload.'?id_kegiatan='.$id_kegiatan),'<i class="glyphicon glyphicon-list-alt" aria-hidden="true"></i> Download Dokumen','class="btn btn-success btn-sm"'); 
				echo '<p></p>'; 
				
				echo anchor(site_url('upload/delete/'.$upload->id_upload.'?id_kegiatan='.$id_kegiatan),'<i class="glyphicon glyphicon-trash" aria-hidden="true"></i> Hapus','class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah anda Yakin ingin menghapus dokumen '.$upload->nm_file.'?\')"'); 
				?>
			</td>
		</tr>
                <?php
            }
            ?>
        </table>
        <div class="row">
            <div class="col-md-6">
                
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
        </div>
                    </div>
            </div>
            </div>
    </section>
</div>