<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <h2 style="margin-top:0px">Inboxfile Read</h2>
        <table class="table">
	    <tr><td>Id Inbox</td><td><?php echo $id_inbox; ?></td></tr>
	    <tr><td>Nm File</td><td><?php echo $nm_file; ?></td></tr>
	    <tr><td>File</td><td><?php echo $file; ?></td></tr>
	    <tr><td>Ukuran</td><td><?php echo $ukuran; ?></td></tr>
	    <tr><td>Jenis</td><td><?php echo $jenis; ?></td></tr>
	    <tr><td>Tgl</td><td><?php echo $tgl; ?></td></tr>
	    <tr><td>User</td><td><?php echo $user; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('inboxfile') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>