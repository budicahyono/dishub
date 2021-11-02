<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" href="<?php echo base_url();?>mansel.ico">
<title>Aplikasi Kegiatan</title>

<link href="<?php echo base_url();?>assets/css/bootstrap.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/css/datepicker3.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/css/styles.css" rel="stylesheet">

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
				<a class="navbar-brand" href="#"><span>Pegawai</span></a>
				<ul class="user-menu">
					<li class="dropdown pull-right">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> <?=$_SESSION['username']?> ( <?=$_SESSION['nip']?> ) <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="<?php echo base_url('auth/pegawai');?>"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Profile</a></li>
							
							<li><a href="<?php echo base_url('login_pegawai/logout');?>"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Logout</a></li>
							
						</ul>
					</li>
				</ul>
			</div>
							
		</div><!-- /.container-fluid -->
	</nav>
		
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<form role="search" >
			<div class="form-group">
				<h3 class="text-center">Menu Utama</h3>
			</div>
		</form>
		<ul class="nav menu">
			<li class="<?php if ($menu == "naik_pangkat") { echo "active"; } ?>"><a href="<?php echo base_url("naik_pangkat");?>"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg>Kenaikan Pangkat</a></li>
			<li class="<?php if ($menu == "pengumuman") { echo "active"; } ?>"><a href="<?php echo base_url("naik_pangkat/pengumuman");?>"><svg class="glyph stroked sound on"><use xlink:href="#stroked-sound-on"/></svg></svg> Pengumuman </a></li>
			<li class="<?php if ($menu == "berkas_kp") { echo "active"; } ?>"><a href="<?php echo base_url("naik_pangkat/detail_pegawai");?>"><svg class="glyph stroked line-graph"><use xlink:href="#stroked-line-graph"></use></svg> Berkas Kenaikan Pangkat</a></li>
			
		</ul>

	</div><!--/.sidebar-->
		
	<?php echo $contents ?> 
	
	<script src="<?php echo base_url();?>assets/js/jquery-1.11.1.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/chart.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/chart-data.js"></script>
	<script src="<?php echo base_url();?>assets/js/easypiechart.js"></script>
	<script src="<?php echo base_url();?>assets/js/easypiechart-data.js"></script>
	<script src="<?php echo base_url();?>assets/js/bootstrap-datepicker.js"></script>
	<script>
		$('#calendar').datepicker({
			
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
	
	
	<script>
		document.getElementById("uploadBtn1").onchange = function () {
			document.getElementById("uploadFile1").value = this.value;
		};
		document.getElementById("uploadBtn2").onchange = function () {
			document.getElementById("uploadFile2").value = this.value;
		};
		document.getElementById("uploadBtn3").onchange = function () {
			document.getElementById("uploadFile3").value = this.value;
		};
		document.getElementById("uploadBtn4").onchange = function () {
			document.getElementById("uploadFile4").value = this.value;
		};
		document.getElementById("uploadBtn5").onchange = function () {
			document.getElementById("uploadFile5").value = this.value;
		};
		document.getElementById("uploadBtn6").onchange = function () {
			document.getElementById("uploadFile6").value = this.value;
		};
		document.getElementById("uploadBtn7").onchange = function () {
			document.getElementById("uploadFile7").value = this.value;
		};
		document.getElementById("uploadBtn8").onchange = function () {
			document.getElementById("uploadFile8").value = this.value;
		};
		document.getElementById("uploadBtn9").onchange = function () {
			document.getElementById("uploadFile9").value = this.value;
		};
		document.getElementById("uploadBtn10").onchange = function () {
			document.getElementById("uploadFile10").value = this.value;
		};
		document.getElementById("uploadBtn11").onchange = function () {
			document.getElementById("uploadFile11").value = this.value;
		};
		document.getElementById("uploadBtn12").onchange = function () {
			document.getElementById("uploadFile12").value = this.value;
		};
		document.getElementById("uploadBtn13").onchange = function () {
			document.getElementById("uploadFile13").value = this.value;
		};
		document.getElementById("uploadBtn14").onchange = function () {
			document.getElementById("uploadFile14").value = this.value;
		};
		document.getElementById("uploadBtn15").onchange = function () {
			document.getElementById("uploadFile15").value = this.value;
		};
		document.getElementById("uploadBtn16").onchange = function () {
			document.getElementById("uploadFile16").value = this.value;
		};
		document.getElementById("uploadBtn17").onchange = function () {
			document.getElementById("uploadFile17").value = this.value;
		};
	</script>	
	
</body>

</html>
