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
        <h2>Inbox List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Judul</th>
		<th>Tgl</th>
		<th>Jenis</th>
		<th>Id Admin</th>
		
            </tr><?php
            foreach ($inbox_data as $inbox)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $inbox->judul ?></td>
		      <td><?php echo $inbox->tgl ?></td>
		      <td><?php echo $inbox->jenis ?></td>
		      <td><?php echo $inbox->id_admin ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>