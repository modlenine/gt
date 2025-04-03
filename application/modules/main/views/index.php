<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้าหลักโปรแกรมใบเบิกเงิน</title>
		<!-- Date picker -->
		<link rel="stylesheet" href="<?=base_url()?>assets/dist/css/default/zebra_datepicker.min.css" type="text/css" />
</head>

<body>
    <div class="main-container">
		<div class="pd-ltr-20">
			<div class="card-box pd-20 height-100-p mb-30">
				<h5 class="text-center">Welcome to GT Transport</h5>
				<div class="row form-group mt-3">
					<div class="col-md-4"></div>
					<div class="col-md-4 form-group">
						<a href="<?=base_url('main/gt_service')?>"><button type="button" id="btn_requestCar" name="btn_requestCar" class="btn btn-primary btn-block">เรียกรถรับจ้างทั่วไป</button></a>
					</div>
					<div class="col-md-4"></div>
					<div class="col-md-4"></div>
					<div class="col-md-4 form-group">
						<a href="<?=base_url('main/requestList')?>"><button type="button" id="btn_requestCarList" name="btn_requestCarList" class="btn btn-info btn-block">รายการเรียกรถ</button></a>
					</div>
					<div class="col-md-4"></div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
