<!DOCTYPE html>
<html>
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>หน้าอัพเดตข้อมูล เพื่อเข้าใช้งาน</title>

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

	<script src="<?=base_url('assets/js/jquery.min.js?v='.filemtime('./assets/js/jquery.min.js'))?>"></script>
	<script src="<?=base_url('assets/js/vue.js')?>"></script>
	<script src="<?=base_url('assets/js/axios.min.js')?>"></script>

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
					<!-- <div class="col-md-6 col-lg-7">
						<img src="<?=base_url('assets/')?>vendors/images/login-page-img.png" alt="">
					</div> -->
					<div class="col-md-12 col-lg-12">
						<div class="login-box bg-white box-shadow border-radius-10">
							<div class="login-title">
								<h2 class="text-center">อัพเดตข้อมูล</h2>
								<?php echo $this->session->flashdata('msg');?>
							</div>
							<form id="frm_signup" name="frm_signup" autocomplete="off" class="needs-validation" novalidate>
                                <div class="input-group custom">
									<input type="text" id="line-displayName" name="line-displayName" class="form-control form-control-lg" placeholder="Username" value="<?=$displayName?>" readonly>
									<div class="input-group-append custom">
										<span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
									</div>
								</div>
                                <div class="input-group custom">
									<input type="text" id="line-fname" name="line-fname" class="form-control form-control-lg" placeholder="ชื่อ" required>
									<div class="input-group-append custom">
										<span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
									</div>
								</div>
                                <div class="input-group custom">
									<input type="text" id="line-lname" name="line-lname" class="form-control form-control-lg" placeholder="นามสกุล" required>
									<div class="input-group-append custom">
										<span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
									</div>
								</div>
                                <div class="input-group custom">
									<input type="tel" id="line-tel" name="line-tel" class="form-control form-control-lg" placeholder="เบอร์โทรศัพท์" required>
									<div class="input-group-append custom">
										<span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12">
										<div class="input-group mb-0">
											<button type="submit" id="btn-signup" class="btn btn-primary btn-lg btn-block">บันทึกข้อมูล</button>
										</div>
									</div>
								</div>

                                <input type="text" name="line-userId" id="line-userId" value="<?=$userId?>">
                                <input type="text" name="line-pictureUrl" id="line-pictureUrl" value="<?=$pictureUrl?>">
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

<script>
	$(document).ready(function(){
		let url = "<?php echo base_url(); ?>";
		$('#frm_signup').submit(function(e){
			e.preventDefault();
			// check data null
			if($('#line-fname').val() == ""){
				swal({
					title: 'กรุณาระบุชื่อ',
					type: 'warning',
					showConfirmButton: true,
				});
			}else if($('#line-lname').val() == ""){
				swal({
					title: 'กรุณาระบุนามสกุล',
					type: 'warning',
					showConfirmButton: true,
				});
			}else if($('#line-tel').val() == ""){
				swal({
					title: 'กรุณาระบุเบอร์โทรศัพท์',
					type: 'warning',
					showConfirmButton: true,
				});
			}else{
				const formdata = new FormData();
				formdata.append('mem_line_userId' , $('#line-userId').val());
				formdata.append('mem_line_displayName' , $('#line-displayName').val());
				formdata.append('mem_line_pictureUrl' , $('#line-pictureUrl').val());
				formdata.append('mem_fname' , $('#line-fname').val());
				formdata.append('mem_lname' , $('#line-lname').val());
				formdata.append('mem_tel' , $('#line-tel').val());
				formdata.append('action' , 'saveSignup');

				axios.post(url+'login/saveSignup' , formdata , {
					headers:{
						'Content-Type':'multipart/form-data'
					}
				}).then(res=>{
					console.log(res.data);
					if(res.data.status == "Insert Data Success"){
						swal({
							title: 'กรุณารอสักครู่ระบบกำลังพาท่านไปยังหน้ายืนยันการใช้โปรแกรม',
							type: 'warning',
							showConfirmButton: false,
							timer:2000
						}).then(function(){
							location.href = url+'login/allowlinenotifypage'
						});
					}
				});
			}
		})
	});
</script>


</html>