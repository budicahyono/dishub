<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-warning box-solid">
    
                    <div class="box-header">
                        <h3 class="box-title">KELOLA DOKUMEN INBOX <?=strtoupper($judul)?></h3>
                    </div>
        
        <div class="box-body">
            <div class='row'>
            <div class='col-md-9'>
            <div style="padding-bottom: 10px;">
			
			<?php 
			echo anchor(site_url('inboxes/'.$menu), '<i class="glyphicon glyphicon-arrow-left" aria-hidden="true"></i> Kembali', 'class="btn btn-warning btn-sm"'); ?>
        <?php 
		if ($this->session->userdata('level') != "admin") { 
		echo anchor(site_url('inboxfile/create/'.$id_inbox.'?jenis='.$menu), '<i class="fa fa-wpforms" aria-hidden="true"></i> Tambah Dokumen', 'class="btn btn-danger btn-sm"'); 
		}
		?>
		<?php echo anchor(site_url('inboxfile/excel'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Export Ms Excel', 'class="btn btn-success btn-sm"'); ?>
		<?php echo anchor(site_url('inboxfile/word'), '<i class="fa fa-file-word-o" aria-hidden="true"></i> Export Ms Word', 'class="btn btn-primary btn-sm"'); ?></div>
            </div>
            <div class='col-md-3'>
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
            </tr><?php
			$start=0;
            foreach ($inboxfile_data->result() as $inboxfile)
            {
                ?>
                <tr>
			<td width="10px"><?php echo ++$start ?></td>
			<td><?php echo $inboxfile->nm_file ?></td>
			<td>
			<?php if ($inboxfile->jenis == "application/pdf") { 
				$pdf = base_url()."assets/pdf.png";
			?>
			<img  id="output" src="<?=$pdf?>" style="height:100px" class="muncul thumbnail img-responsive">
			<?php } else { 
				$foto = base_url()."inboxes/$menu/".$id_inbox."/".$inboxfile->file;
			?>
			<img  id="output" src="<?=$foto?>" style="height:100px" class="muncul thumbnail img-responsive">
			<?php } ?>
			</td>
			<td><?php echo $inboxfile->file ?></td>
			<td><?php echo $inboxfile->ukuran ?>KB</td>
			<td><?php echo $inboxfile->jenis ?></td>
			<td><?php echo tgl_indo($inboxfile->tgl) ?></td>
			<td><?php echo $inboxfile->user ?></td>
			
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('inboxfile/download/'.$inboxfile->id_inboxfile.'?id='.$id_inbox.'&jenis='.$menu),'<i class="glyphicon glyphicon-list-alt" aria-hidden="true"></i> Download Dokumen','class="btn btn-success btn-sm"'); 
				echo '<p></p>'; 
				if ($this->session->userdata('level') != "admin") { 
				echo anchor(site_url('inboxfile/delete/'.$inboxfile->id_inboxfile.'?id='.$id_inbox.'&jenis='.$menu),'<i class="glyphicon glyphicon-trash" aria-hidden="true"></i> Hapus','class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah anda Yakin ingin menghapus dokumen '.$inboxfile->nm_file.'?\')"');
				}	
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
                
            </div>
        </div>
        </div>
                    </div>
            </div>
            </div>
    </section>
</div>