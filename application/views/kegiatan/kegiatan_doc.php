<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            .word-table {
                border:1px solid black !important; 
                border-collapse: collapse !important;
                width: 100%;
            }
            .word-table tr th, .word-table tr td{
                border:1px solid black !important; 
                padding: 5px 10px;
            }
        </style>
    </head>
    <body>
        <h2>Kegiatan List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Namakegiatan</th>
		<th>Tgl Kegiatan</th>
		<th>Lokasi</th>
		<th>Mata Anggaran</th>
		<th>Pelaksana Kegiatan</th>
		
            </tr><?php
            foreach ($kegiatan_data as $kegiatan)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $kegiatan->namakegiatan ?></td>
		      <td><?php echo $kegiatan->tgl_kegiatan ?></td>
		      <td><?php echo $kegiatan->lokasi ?></td>
		      <td><?php echo $kegiatan->mata_anggaran ?></td>
		      <td><?php echo $kegiatan->pelaksana_kegiatan ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>