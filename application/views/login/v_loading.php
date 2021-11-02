<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" href="<?php echo base_url();?>assets/dishub.png">
<title>Aplikasi Data Perencanaan Keuangan</title>
<link href="<?php echo base_url();?>assets/css/bootstrap.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/css/styles.css" rel="stylesheet">
<!--Icons-->

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->

</head>

<body class="login_camaba">
<div class="overlay2">
	
	
		

	<script src="<?php echo base_url();?>assets/js/jquery-1.11.1.min.js"></script>
		
<script>
var base_url = "http://localhost/dishub";
	
<?php
if (!isset($_SESSION['username'])) {  ?>

// Check browser support
if (typeof(Storage) !== "undefined") {
	// ambil
	var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>',
    csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
	var id_admin = localStorage.getItem("id_admin");
    var dataJson = { [csrfName]: csrfHash, id_admin: id_admin};
	
	localStorage.setItem("base_url", base_url); 
	
	$(document).ready(function(){	
  
	  ambil_id();
	  
	  //ambil_id
	  function ambil_id(){
		  $.ajax({      
			  url	: base_url + "/ajax/user",
			  method: 'POST',
			  data	: dataJson,
			  success: function(data) {
				csrfName = data.csrfName;
				csrfHash = data.csrfHash;
				 //localStorage.removeItem("id_admin"); 
			  }
		  })	
	  }
	})
} else {
  document.getElementById("update").innerHTML = "Sorry, your browser does not support Web Storage...";
}
<?php } ?>

function myFunction() {
	
	
   window.location.replace(base_url+"/login/form");
}
	
    setTimeout( myFunction , 0);

</script>
	
	
	
	
	
	
	
	<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/bootstrap-datepicker.js"></script>
</div>
</body>

</html>
