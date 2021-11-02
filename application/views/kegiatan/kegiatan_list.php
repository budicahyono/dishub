<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-warning box-solid">
    
                    <div class="box-header">
                        <h3 class="box-title">KELOLA DATA KEGIATAN</h3>
                    </div>
        
        <div class="box-body">
            <div class='row'>
            <div class='col-md-9'>
            <div style="padding-bottom: 10px;"'>
       
        <?php echo anchor(site_url('kegiatan/create'), '<i class="fa fa-wpforms" aria-hidden="true"></i> Tambah Data', 'class="btn btn-danger btn-sm"'); ?>
		<?php echo anchor(site_url('kegiatan/excel'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Export Ms Excel', 'class="btn btn-success btn-sm"'); ?>
		<?php echo anchor(site_url('kegiatan/word'), '<i class="fa fa-file-word-o" aria-hidden="true"></i> Export Ms Word', 'class="btn btn-primary btn-sm"'); ?></div>
            </div>
            <div class='col-md-3'>
            <form action="<?php echo site_url('kegiatan/index'); ?>" class="form-inline" method="get">
                    Cari Kegiatan
					<div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('kegiatan'); ?>" class="btn btn-default">Reset</a>
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
		<th>Nama Kegiatan</th>
		<th>Tgl Kegiatan</th>
		<th>Lokasi</th>
		<th>Mata Anggaran</th>
		<th>Pelaksana Kegiatan</th>
		<th>Jumlah Dokumen</th>
		<th>Action</th>
            </tr><?php
            foreach ($kegiatan_data as $kegiatan)
            {
                ?>
                <tr>
			<td width="10px"><?php echo ++$start ?></td>
			<td><?php echo $kegiatan->nama_kegiatan ?></td>
			<td>Tanggal Awal: <?php echo tgl_indo($kegiatan->tgl_kegiatan) ?><br>
				Tanggal Akhir: <?php echo tgl_indo($kegiatan->tgl_akhir) ?><br>
				</td>
			<td><?php echo $kegiatan->lokasi ?></td>
			<td><?php echo $kegiatan->mata_anggaran ?></td>
			<td><?php echo $kegiatan->pelaksana_kegiatan ?></td>
			<td>
			<?php 
				$upload = $this->db->query("SELECT * FROM kegiatan k, upload u where k.id_kegiatan=u.id_kegiatan and k.id_kegiatan = ".$kegiatan->id_kegiatan );
				if (count($upload->result() != 0)) {
					 echo $upload->num_rows()." Dokumen";
				}
			?>
			</td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('kegiatan/upload/'.$kegiatan->id_kegiatan),'<i class="glyphicon glyphicon-list-alt" aria-hidden="true"> </i> Upload Dokumen','class="btn btn-success btn-sm"'); 
				echo '<p></p>'; 
				echo anchor(site_url('kegiatan/update/'.$kegiatan->id_kegiatan),'<i class="glyphicon glyphicon-edit" aria-hidden="true"></i> Edit','class="btn btn-danger btn-sm"'); 
				echo '  '; 
				echo anchor(site_url('kegiatan/delete/'.$kegiatan->id_kegiatan),'<i class="glyphicon glyphicon-trash" aria-hidden="true"></i> Delete','class="btn btn-danger btn-sm" onclick=" return confirm(\'Apakah anda Yakin ingin menghapus kegiatan '.$kegiatan->nama_kegiatan.' dan seluruh dokumennya? \')"'); 
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