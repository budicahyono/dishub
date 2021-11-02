<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-warning box-solid">
    
                    <div class="box-header">
                        <h3 class="box-title">KELOLA DATA USER</h3>
                    </div>
        
        <div class="box-body">
            <div class='row'>
            <div class='col-md-9'>
            <div style="padding-bottom: 10px;"'>
        <?php echo anchor(site_url('user/create'), '<i class="fa fa-wpforms" aria-hidden="true"></i> Tambah Data', 'class="btn btn-danger btn-sm"'); ?></div>
            </div>
            <div class='col-md-3'>
            <form action="<?php echo site_url('user/index'); ?>" class="form-inline" method="get">
                    Cari Nama User
					<div class="input-group">
					
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('user'); ?>" class="btn btn-default">Reset</a>
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
		<th>Nama</th>
		<th>Username</th>
		<th>Password</th>
		<th>Level</th>
		<th>Login</th>
		<th>Action </th>
            </tr><?php
            foreach ($user_data as $user)
            {
				if ( $user->id_admin != $this->session->userdata('id_admin'))  {
                ?>
                <tr>
			<td width="10px"><?php echo ++$start ?></td>
			<td><?php echo $user->nama ?></td>
			<td><?php echo $user->username ?></td>
			<td>
			<?php 
			if ($this->session->has_userdata('id_admins')) {
				if ($this->session->userdata('id_admins') == $user->id_admin) {
					echo $this->session->userdata('password') <> '' ? $this->session->userdata('password') : '***'; 
				} else {
					echo "***";
				}
			} else {
				echo "***";
			}	
			?>
			</td>
			<td><?php echo $user->level ?></td>
			<td><?php if ( $user->is_login == 1) {  ?>
				<label class=" badge bg-success">Login</label>
			</td>
			<?php } ?>
			<td style="text-align:center" width="200px">
				<?php 
				
				echo anchor(site_url('user/update/'.$user->id_admin),'<i class="glyphicon glyphicon-edit" aria-hidden="true"></i> Edit','class="btn btn-danger btn-sm"'); 
				echo '  '; 
				echo anchor(site_url('user/delete/'.$user->id_admin),'<i class="glyphicon glyphicon-trash" aria-hidden="true"></i> Delete','class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah anda Yakin ingin menghapus User '.$user->nama.'?\')"'); 
				?>
			</td>
		</tr>
                <?php }
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