<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" href="<?php echo base_url();?>assets/dishub.png">
<title>Aplikasi Data Perencanaan Keuangan</title>

<link href="<?php echo base_url();?>assets/css/bootstrap.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/css/datepicker3.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/css/styles.css?v=<?php echo time() ?>" rel="stylesheet">

<link href="<?=base_url();?>assets/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

<!--Icons-->
<script src="<?php echo base_url();?>assets/js/lumino.glyphs.js"></script>

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->

</head>

<body>
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#"><span>Aplikasi Data Perencanaan Keuangan</span></a>
				<ul class="user-menu">
					<li class="dropdown pull-right">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> <?=ucfirst($_SESSION['nama'])?> (<?=$_SESSION['username']?>) <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="<?php echo base_url('auth/admin');?>"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Profile</a></li>
							<li><a href="<?php echo base_url('login/logout');?>"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Logout</a></li>
							
							
						</ul>
					</li>
				</ul>
			</div>
							
		</div><!-- /.container-fluid -->
	</nav>
		
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<form role="search" >
			<div class="form-group ">
				<h3 class="text-center">Menu <?=ucfirst($_SESSION['level'])?></h3>
			</div>
		</form>
		<ul class="nav menu">
			<li class="<?php if ($menu == "home") { echo "active"; } ?>"><a href="<?php echo base_url("home");?>"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Dashboard</a></li>
			<?php if ($_SESSION['level'] != "operator") { ?>
			<li class="<?php if ($menu == "user") { echo "active"; } ?>"><a href="<?php echo base_url("user");?>"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> User</a></li>
			<li class="<?php if ($menu == "kegiatan") { echo "active"; } ?>"><a href="<?php echo base_url("kegiatan");?>"><svg class="glyph stroked notepad "><use xlink:href="#stroked-notepad"/></svg> Kegiatan</a></li>
			<?php } ?>
			
			<li class="<?php if ($menu == "usul") { echo "active"; } ?>"><a href="<?php echo base_url("inboxes/usul");?>"><svg class="glyph stroked notepad "><use xlink:href="#stroked-notepad"/></svg> Inbox Usul</a></li>
			<li class="<?php if ($menu == "laporan") { echo "active"; } ?>"><a href="<?php echo base_url("inboxes/laporan");?>"><svg class="glyph stroked notepad "><use xlink:href="#stroked-notepad"/></svg> Inbox Laporan</a></li>
			
			
		</ul>

	</div><!--/.sidebar-->
		
	<?php echo $contents ?> 

	<script src="<?php echo base_url();?>assets/js/jquery-1.11.1.min.js"></script>
<?php
if (isset($_SESSION['username'])) { ?>
<script>
// Check browser support
if (typeof(Storage) !== "undefined") {
  // Store
  localStorage.setItem("id_admin", <?=$_SESSION['id_admin']?>); 
} else {
  document.getElementById("update").innerHTML = "Sorry, your browser does not support Web Storage...";
}
</script>
<?php } ?>
<script>
//5 menit selama 1 halaman dan tidak reload halaman akan logout otomatis
function myFunction() {
	
	var base_url = localStorage.getItem("base_url");
	
   window.location.replace(base_url+"/login/logout");
}
	
    setTimeout( myFunction , 600000);
    //setTimeout( myFunction , 10000);

</script>	
	
	
	
	<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/bootstrap-datepicker.js"></script>
	
	<script>
	var format_tgl = "dd-mm-yyyy";
		$('#calendar').datepicker({
			setDate: new Date(),
			format: format_tgl,
			autoclose: true,
		});
		
		$('#calendar2').datepicker({
			 "setDate": new Date(),
			format: format_tgl,
			autoclose: true,
		});
		
		$('#calendar3').datepicker({
			 "setDate": new Date(),
			format: format_tgl,
			autoclose: true,
		});
		
		$('#calendar4').datepicker({
			 "setDate": new Date(),
			format: format_tgl,
			autoclose: true,
		});
		
		!function ($) {
		    $(document).on("click","ul.nav li.parent > a > span.icon", function(){          
		        $(this).find('em:first').toggleClass("glyphicon-minus");      
		    }); 
		    $(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
		}(window.jQuery);

		$(window).on('resize', function () {
		  if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
		})
		$(window).on('resize', function () {
		  if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
		})
	</script>


		
	
		<!-- Jquery DataTable Plugin Js -->
		<script  type="text/javascript" src="<?=base_url();?>assets/jquery-datatable/jquery.dataTables.js"></script>
		<script  type="text/javascript" src="<?=base_url();?>assets/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
		
		
<script type="text/javascript">
$(function () {
    $('.data').DataTable({
        responsive: true,
		"lengthMenu": [[50, 100, 200], [50, 100, 200]],
		 "order": [[ 0, "desc" ]],
    });
	 $('.data2').DataTable({
        responsive: true,
		"lengthMenu": [[50, 100, 200], [50, 100, 200]],
		 "order": [[ 3, "asc" ]],
    });
	 $('.data3').DataTable({
        responsive: true,
		"lengthMenu": [[10, 50, 100], [10, 50, 100]],
    });
	 $('.data4').DataTable({
        responsive: true,
		"lengthMenu": [[5, 10, 50], [5, 10, 50]],
    });
});
</script>		
		
</body>

</html>
