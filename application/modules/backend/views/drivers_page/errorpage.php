<!DOCTYPE html>
<html>
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>หน้า Login เข้าใช้งานโปรแกรม</title>

	<!-- Site favicon -->
	<!-- <link rel="apple-touch-icon" sizes="180x180" href="<?=base_url('assets/')?>vendors/images/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?=base_url('assets/')?>vendors/images/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?=base_url('assets/')?>vendors/images/favicon-16x16.png"> -->

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/')?>vendors/styles/core.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/')?>vendors/styles/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/')?>vendors/styles/style.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/')?>src/plugins/sweetalert2/sweetalert2.css">

	<style>
		.btn-primary{
			background-color:#465881;
			border-color:#465881;
		}
		.btn-primary:hover{
			background-color:#406bcd;
			border-color:#406bcd;
		}
	</style>
</head>
<body class="login-page">

	<div id="loginpage">

		<div class="login-header box-shadow">
			<div class="container-fluid d-flex justify-content-between align-items-center">
				<div class="brand-logo">
					<a href="<?=base_url()?>">
						<!-- <img src="<?=base_url('assets/')?>vendors/images/deskapp-logo.svg" alt=""> -->
						<span style="color:gray;">โปรแกรมเรียกรถ ออนไลน์</span>
					</a>
				</div>
				<div class="login-menu">
					
				</div>
			</div>
		</div>
		<div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
			<div class="container">
				<div class="row align-items-center">

					<div class="col-md-12 col-lg-12">
						<!-- <div class="login-box bg-white box-shadow border-radius-10">
							<div class="login-title">
								
							</div>
						</div> -->
					</div>

				</div>
			</div>
		</div>
		<!-- js -->

	</div>




	<script src="<?=base_url('assets/')?>vendors/scripts/core.js"></script>
	<script src="<?=base_url('assets/')?>vendors/scripts/script.min.js"></script>
	<script src="<?=base_url('assets/')?>vendors/scripts/process.js"></script>
	<script src="<?=base_url('assets/')?>vendors/scripts/layout-settings.js"></script>

	<!-- add sweet alert js & css in footer -->
	<script src="<?=base_url('assets/')?>src/plugins/sweetalert2/sweetalert2.all.js"></script>
	<script src="<?=base_url('assets/')?>src/plugins/sweetalert2/sweet-alert.init.js"></script>
</body>


</html>
<script>
    const url = "<?php echo base_url() ?>";
    $(document).ready(()=>{
        swal({
            title: 'ท่านมีงานค้างอยู่ในระบบ',
            type: 'error',
            showConfirmButton: true,
            // timer: 1500
        }).then(() => {
            location.href = url+'backend/drivers/job_list_page/job_avaliable';
        });
    });
</script>