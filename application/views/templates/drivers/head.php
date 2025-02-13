<!DOCTYPE html>
<html>
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">

	<!-- Site favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="<?=base_url('assets/')?>vendors/images/slc.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?=base_url('assets/')?>vendors/images/slc.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?=base_url('assets/')?>vendors/images/slc.png">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/')?>vendors/styles/core.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/')?>vendors/styles/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/')?>src/plugins/datatables/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/')?>src/plugins/datatables/css/responsive.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/')?>vendors/styles/style.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/')?>src/plugins/dropzone/src/dropzone.css">
	

    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/')?>src/plugins/sweetalert2/sweetalert2.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/')?>css/custom.css">

	<!-- Bootstrap File Upload CSS -->
    <!-- <link href="<?=base_url('assets/')?>fileinput/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" crossorigin="anonymous">
    <link href="<?=base_url('assets/')?>fileinput/themes/explorer-fa5/theme.css" media="all" rel="stylesheet" type="text/css"/> -->
	<link rel="stylesheet" href="<?=base_url('assets/')?>fileupload/bs-filestyle.css" type="text/css" />
	<link rel="stylesheet" href="<?=base_url('assets/')?>fileupload/bootstrap-icons.css" type="text/css" />


	<link rel="stylesheet" href="<?=base_url()?>assets/ekko_lightbox/ekko-lightbox.css" type="text/css"/>

	<!-- Date picker -->
	<link rel="stylesheet" href="<?=base_url()?>assets/dist/css/default/zebra_datepicker.min.css" type="text/css" />

	<link rel="stylesheet" href="<?= base_url() ?>signature-pad/assets/jquery.signaturepad.css">
    <link href="<?= base_url() ?>signature-pad/assets/jquerysctipttop.css" rel="stylesheet" type="text/css">

    <script src="<?=base_url('assets/js/jquery.min.js?v='.filemtime('./assets/js/jquery.min.js'))?>"></script>
	<script src="<?=base_url('assets/js/vue.js')?>"></script>
	<script src="<?=base_url('assets/js/axios.min.js')?>"></script>


	<!-- Process step -->
	<link rel="stylesheet" href="<?=base_url()?>assets/process_step/style.css" type="text/css" />



	<style>
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
		label {
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
<?php
	// Get Modal Zone
	if($this->session->dv_username == ""){
		$fnamedata = "Gust";
	}else{
		$fnamedata = $this->session->dv_fname." ".$this->session->dv_lname;
	}
?>

<div class="loader">
	<div></div>
</div>

<script> 
	 // Code page Load 
	$(window).on('load',function(){ 
    $('.loader').fadeOut(100); 
  }) 
</script>

<body>


	<div class="header">
		<div class="header-left">
			<div class="menu-icon dw dw-menu"></div>
			<!-- <div class="search-toggle-icon dw dw-search2" data-toggle="header_search"></div>
			<div class="header-search">
				
			</div> -->
		</div>
		<div class="header-right">
			<div class="user-notification">
				<div class="dropdown">
					<a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown">
						<i class="icon-copy dw dw-notification"></i>
						<div id="notify-section" style="display:none;">
							<span class="badge notification-active"></span>
							<div class="d-flex align-items-center justify-content-center countNotify">
								<span class="countNotifyText">0</span>
							</div>
						</div>
					</a>

					<div class="dropdown-menu dropdown-menu-right">
						<div class="notification-list mx-h-350 customscroll">
							<div id="show_notifyData"></div>
						</div>
					</div>

				</div>
			</div>
			<div class="user-info-dropdown">
				<div class="dropdown">
					<a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
						<span class="user-icon">
							<img src="#" alt="">
						</span>
						<span class="user-name"><?=$fnamedata ?></span>
					</a>
					<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
						<!-- <a class="dropdown-item" href="profile.html"><i class="dw dw-user1"></i> Profile</a>
						<a class="dropdown-item" href="profile.html"><i class="dw dw-settings2"></i> Setting</a>
						<a class="dropdown-item" href="faq.html"><i class="dw dw-help"></i> Help</a> -->
						<a class="dropdown-item" id="logoutBtn" href="#"><i class="dw dw-logout"></i> Log Out</a>
					</div>
				</div>
			</div>
			
		</div>
	</div>


	<div class="left-side-bar">
		<div class="brand-logo">
			<a href="<?=base_url()?>">
				<!-- <img src="<?=base_url('assets/')?>vendors/images/wdflogo.svg" alt="" class="dark-logo">
				<img src="<?=base_url('assets/')?>vendors/images/wdflogo.svg" alt="" class="light-logo"> -->
				<span style="font-size:28px;color:#ef476f;"><b>GT Driver Page</b></span>
			</a>
			<div class="close-sidebar" data-toggle="left-sidebar-close">
				<i class="ion-close-round"></i>
			</div>
		</div>
		<div class="menu-block customscroll">
			<div class="sidebar-menu">
				<ul id="accordion-menu">
					<li class="dropdown">
						<a href="<?=base_url('backend/admin')?>" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-city-hall hicon"></span><span class="mtext">หน้าหลัก</span>
						</a>
					</li>
			
			
					<li>
						<a href="<?=base_url('backend/drivers/job_list_page/job_avaliable')?>" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-wallet1 wdfI1"></span><span class="mtext">รายการงาน [รอรับงาน]</span>
						</a>
					</li>

					<li>
						<a href="<?=base_url('backend/admin/request_list_page/checkpayment')?>" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-wallet1 wdfI1"></span><span class="mtext">งานของฉัน [กำลังทำ]</span>
						</a>
					</li>

					<li>
						<a href="<?=base_url('backend/admin/request_list_page/paymented')?>" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-wallet1 wdfI1"></span><span class="mtext">งานของฉัน [เสร็จสิ้นแล้ว]</span>
						</a>
					</li>

					<!-- <li>
						<a href="<?=base_url('backend/admin/request_list_page/publish_to_driver')?>" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-wallet1 wdfI1"></span><span class="mtext">รายการปล่อยงานแล้ว</span>
						</a>
					</li> -->

					<li>
						<div class="dropdown-divider"></div>
					</li>
					<!-- <li>
						<div class="sidebar-small-cap mtext">รายงาน</div>
					</li>
					<li>
						<a href="<?=base_url('advance_report.html')?>" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-profits-1 wdfI1"></span><span class="mtext">ประวัติการเรียกรถ</span>
						</a>
					</li> -->
					
				</ul>
			</div>
		</div>
	</div>
	<div class="mobile-menu-overlay"></div>


<script>
	const url = "<?php echo base_url()?>";
	$(document).ready(function(){


		$('#logoutBtn').click(function(){
			logoutConfirm();
		});


		function logoutConfirm()
		{
			swal({
				title: 'ต้องการลงชื่ออกจากระบบ ใช่หรือไม่',
				type: 'warning',
				showCancelButton: true,
				confirmButtonClass: 'btn btn-success',
				cancelButtonClass: 'btn btn-danger',
				confirmButtonText: 'ยืนยัน',
				cancelButtonText:'ยกเลิก'
			}).then((result)=> {
				if(result.value == true){
					location.href = url+'backend/drivers';
				}
			});
		}

		// controlButton_foradmin(ecode);
		
	});
</script>


