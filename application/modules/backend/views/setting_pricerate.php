<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้าตั้งค่า เรทของค่าบริการ</title>
</head>
<body>
    <div class="main-container">
        <div class="pd-ltr-20">
            <div class="row">
                <div class="col-md-12 form-group">
                    <div class="card-box height-100-p pd-20">
                        <h3 class="text-center">ตั้งค่า เรทค่าบริการ</h3>
                        <hr>
                        <div class="row mt-3">
                            <div class="col-md-6 form-group">
                                <label for=""><b>ตัวคูณของระยะทาง</b></label>
                                <input type="text" name="ip-st-distant_x" id="ip-st-distant_x" class="form-control">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for=""><b>อัตราการบริโภคน้ำมัน</b></label>
                                <input type="text" name="ip-st-fuel_consumption" id="ip-st-fuel_consumption" class="form-control">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for=""><b>เรทราคาน้ำมัน</b></label>
                                <input type="text" name="ip-st-fuel_pricerate" id="ip-st-fuel_pricerate" class="form-control">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for=""><b>อัตราส่วน</b></label>
                                <input type="text" name="ip-st-ratio_x" id="ip-st-ratio_x" class="form-control">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for=""><b>เงินบวก</b></label>
                                <input type="text" name="ip-st-money_plus" id="ip-st-money_plus" class="form-control">
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-4 form-group">
                                <button type="button" id="btn_saveSettingPrice" name="btn_saveSettingPrice" class="btn btn-primary btn-block">บันทึก</button>
                            </div>
                            <div class="col-md-4"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<script src="<?=base_url('assets/js/setting_pricerate.js?v='.filemtime('./assets/js/setting_pricerate.js'))?>"></script>