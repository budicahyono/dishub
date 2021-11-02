<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-warning box-solid">
    
                    <div class="box-header">
                        <h3 class="box-title">KELOLA DATA INBOX <?=$jenis?></h3>
                    </div>
        
        <div class="box-body">
            <div class='row'>
            <div class='col-md-9'>
            <div style="padding-bottom: 10px;">
			<?php if ($this->session->userdata('level') != "admin") { ?>
        <?php echo anchor(site_url('inboxes/create?jenis='.$menu), '<i class="fa fa-wpforms" aria-hidden="true"></i> Tambah Data', 'class="btn btn-danger btn-sm"'); ?>
			<?php } ?>
		<?php echo anchor(site_url('inboxes/excel'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Export Ms Excel', 'class="btn btn-success btn-sm"'); ?>
		<?php echo anchor(site_url('inboxes/word'), '<i class="fa fa-file-word-o" aria-hidden="true"></i> Export Ms Word', 'class="btn btn-primary btn-sm"'); ?></div>
            </div>
            <div class='col-md-3'>
            <form action="<?php echo site_url('inboxes/'.$menu); ?>" class="form-inline" method="get">
            <form action="<?php echo site_url('inboxes/'.$menu); ?>" class="form-inline" method="get">
               Cari Judul     
					<div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('inboxes/'.$menu); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
            </div>
        
   
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
		<th>Judul</th>
		<th>Tanggal</th>
		<th>Nama</th>
		<th>Jumlah Dokumen</th>
		<th>Status</th>
		<th>Action</th>
            </tr><?php
            foreach ($inbox_data as $inbox)
            {
                ?>
                <tr>
			<td width="10px"><?php echo ++$start ?></td>
			<td><?php echo $inbox->judul ?></td>
			<td><?php echo tgl_indo($inbox->tgl)."<br>".
					  $inbox->waktu?></td>
			<td><?php echo $inbox->nama ?></td>
			<td><?php 
				$upload = $this->db->query("SELECT * FROM inbox i, inboxfile f where i.id_inbox=f.id_inbox and i.id_inbox = ".$inbox->id_inbox );
				if ($upload == TRUE) {
					if (count($upload->result() != 0)) {
						 echo $upload->num_rows()." Dokumen";
					}
				}
			?>
			</td>
			<td><?=$inbox->status?></td>
			
			<td style="text-align:center" width="200px">
				<?php 
				 if ($this->session->userdata('level') == "admin") { 
					echo anchor(site_url('inboxes/upload/'.$inbox->id_inbox.'?jenis='.$menu	),'<i class="glyphicon glyphicon-list-alt" aria-hidden="true"> </i> Lihat Dokumen','class="btn btn-success btn-sm"'); 
					echo '<p></p>'; 
				 }	
				if ($inbox->status == "draft") {
					echo anchor(site_url('inboxes/upload/'.$inbox->id_inbox.'?jenis='.$menu	),'<i class="glyphicon glyphicon-list-alt" aria-hidden="true"> </i> Upload Dokumen','class="btn btn-success btn-sm"'); 
					echo '<p></p>'; 
					echo anchor(site_url('inboxes/kirim/'.$inbox->id_inbox.'?jenis='.$menu	),'<i class="glyphicon glyphicon-list-alt" aria-hidden="true"> </i> Kirim','class="btn btn-warning btn-sm" onclick=" return confirm(\'Apakah anda Yakin ingin mengirimkan Inbox  '.$inbox->judul.' dan seluruh dokumennya kepada admin ? \')" '); 
					echo '<p></p>'; 
					echo anchor(site_url('inboxes/update/'.$inbox->id_inbox.'?jenis='.$menu),'<i class="glyphicon glyphicon-edit" aria-hidden="true"></i> Edit','class="btn btn-danger btn-sm" '); 
					echo '  '; 
					echo anchor(site_url('inboxes/delete/'.$inbox->id_inbox.'?jenis='.$menu),'<i class="glyphicon glyphicon-trash" aria-hidden="true"></i> Delete','class="btn btn-danger btn-sm" onclick=" return confirm(\'Apakah anda Yakin ingin menghapus Inbox  '.$inbox->judul.' dan seluruh dokumennya ? \')"'); 
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
                <?php echo $pagination ?>
            </div>
        </div>
        </div>
                    </div>
            </div>
            </div>
    </section>
</div>