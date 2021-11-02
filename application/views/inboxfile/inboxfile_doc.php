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
        <h2>Inboxfile List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Id Inbox</th>
		<th>Nm File</th>
		<th>File</th>
		<th>Ukuran</th>
		<th>Jenis</th>
		<th>Tgl</th>
		<th>User</th>
		
            </tr><?php
            foreach ($inboxfile_data as $inboxfile)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $inboxfile->id_inbox ?></td>
		      <td><?php echo $inboxfile->nm_file ?></td>
		      <td><?php echo $inboxfile->file ?></td>
		      <td><?php echo $inboxfile->ukuran ?></td>
		      <td><?php echo $inboxfile->jenis ?></td>
		      <td><?php echo $inboxfile->tgl ?></td>
		      <td><?php echo $inboxfile->user ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>