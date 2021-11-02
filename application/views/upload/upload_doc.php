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
        <h2>Upload List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Nm File</th>
		<th>File</th>
		<th>Ukuran</th>
		<th>Jenis</th>
		<th>Tgl</th>
		<th>User</th>
		
            </tr><?php
            foreach ($upload_data as $upload)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $upload->nm_file ?></td>
		      <td><?php echo $upload->file ?></td>
		      <td><?php echo $upload->ukuran ?></td>
		      <td><?php echo $upload->jenis ?></td>
		      <td><?php echo $upload->tgl ?></td>
		      <td><?php echo $upload->user ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>