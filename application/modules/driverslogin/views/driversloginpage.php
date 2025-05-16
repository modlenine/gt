<!DOCTYPE html>
<html>
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>หน้า Login เข้าใช้งานโปรแกรม (สำหรับคนขับรถ)</title>

	<!-- Site favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="<?=base_url('assets/')?>vendors/images/gt_favicon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?=base_url('assets/')?>vendors/images/gt_favicon.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?=base_url('assets/')?>vendors/images/gt_favicon.png">

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

						/* thai */
		@font-face {
			font-family: 'Sarabun';
			font-style: normal;
			font-weight: 400;
			font-display: swap;
			src: local('Sarabun Regular'), local('Sarabun-Regular'), url(<?= base_url('assets/fonts/DtVjJx26TKEr37c9aAFJn2QN.woff2') ?>) format('woff2');
			unicode-range: U+0E01-0E5B, U+200C-200D, U+25CC;
		}

		/* vietnamese */
		@font-face {
			font-family: 'Sarabun';
			font-style: normal;
			font-weight: 400;
			font-display: swap;
			src: local('Sarabun Regular'), local('Sarabun-Regular'), url(<?= base_url('assets/fonts/DtVjJx26TKEr37c9aBpJn2QN.woff2') ?>) format('woff2');
			unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+1EA0-1EF9, U+20AB;
		}

		/* latin-ext */
		@font-face {
			font-family: 'Sarabun';
			font-style: normal;
			font-weight: 400;
			font-display: swap;
			src: local('Sarabun Regular'), local('Sarabun-Regular'), url(<?= base_url('assets/fonts/DtVjJx26TKEr37c9aBtJn2QN.woff2') ?>) format('woff2');
			unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
		}

		/* latin */
		@font-face {
			font-family: 'Sarabun';
			font-style: normal;
			font-weight: 400;
			font-display: swap;
			src: local('Sarabun Regular'), local('Sarabun-Regular'), url(<?= base_url('assets/fonts/DtVjJx26TKEr37c9aBVJnw.woff2') ?>) format('woff2');
			unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
		}

		* {
			font-family: 'Sarabun', sans-serif;
		}

		h1,
		h2,
		h3,
		h4,
		h5,
		h6,
		label ,
		button {
			font-family: 'Sarabun', sans-serif !important;
		}

		body {
			font-size: .9rem !important;
		}

		.form-control {
			font-size: .9rem !important;
		}

		.process-steps li h5 {
			font-size: .85rem !important;
		}

		.col-search-input {
			width: 100% !important;
		}
	</style>
</head>
<body class="login-page">

	<div id="loginpage">

		<div class="login-header box-shadow">
			<div class="container-fluid d-flex justify-content-between align-items-center">
				<div class="brand-logo">
					<a href="#">
						<!-- <img src="<?=base_url('assets/')?>vendors/images/deskapp-logo.svg" alt=""> -->
						<span style="color:gray;">โปรแกรมเรียกรถ GT Move</span>
					</a>
				</div>
				<div class="login-menu">

				</div>
			</div>
		</div>
		<div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
			<div class="container">
				<div class="row align-items-center">
					<!-- <div class="col-md-6 col-lg-7">
						<img src="<?=base_url('assets/')?>vendors/images/login-page-img.png" alt="">
					</div> -->
					<div class="col-md-12 col-lg-12">
						<div class="login-box bg-white box-shadow border-radius-10">
							<div class="login-title">
								<h2 class="text-center mb-2">ล็อกอินเข้าสู่ระบบ คนขับรถ</h2>
								<?php echo $this->session->flashdata('msgdriver');?>
								<?=$this->session->dv_username?>
							</div>
							<form id="frm_driverslogin" name="frm_driverslogin" action="<?=base_url('driverslogin/drivers_checklogin')?>" method="post" autocomplete="off">
								<div class="input-group custom">
									<input type="text" id="drivers-username" name="drivers-username" class="form-control form-control-lg" placeholder="Username">
									<div class="input-group-append custom">
										<span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
									</div>
								</div>
								<div class="input-group custom">
									<input type="password" id="drivers-password" name="drivers-password" class="form-control form-control-lg" placeholder="**********">
									<div class="input-group-append custom">
										<span class="input-group-text"><i class="dw dw-padlock1"></i></span>
									</div>
								</div>
								<div class="row pb-30">
									<div class="col-6">
										<div class="custom-control custom-checkbox">
											
										</div>
									</div>
									<div class="col-6">
										<div class="forgot-password"><a href="<?=base_url('driverslogin/register')?>">สมัครรถร่วม</a></div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12">
										<div class="input-group mb-0">
											<button class="btn btn-primary btn-lg btn-block">เข้าสู่ระบบ</button>
										</div>
									</div>
								</div>
							</form>
						</div>
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