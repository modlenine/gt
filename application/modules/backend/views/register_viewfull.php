<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้าแสดงรายละเอียดของผู้สมัคร</title>
</head>

<body>

    <!-- Modal สำหรับแสดงภาพขนาดใหญ่ -->
    <div id="image-modal" class="modal">
        <span class="modal-close">&times;</span>
        <img class="modal-content" id="modal-img">
    </div>
    <!-- Modal สำหรับแสดงภาพขนาดใหญ่ -->

    <div class="main-container">
        <div class="pd-ltr-20">
            <div class="row">
                <div class="col-md-12">
                    <div class="card-box height-100-p pd-20">
                        <h5 class="text-center">หน้าแสดงรายละเอียดของผู้สมัคร</h3>
                        <hr>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <p>
                                    <span><b>ชื่อ : </b><?=$registerData->dv_fnameth?></span>
                                    <span><b>นามสกุล : </b><?=$registerData->dv_lnameth?></span>
                                </p>
                                <p>
                                    <span><b>เบอร์โทรศัพท์ : </b><?=$registerData->dv_tel?></span>
                                    <span><b>ไลน์ไอดี : </b><?=$registerData->dv_lineid?></span>
                                </p>
                                <p>
                                    <span><b>ทะเบียนรถ : </b><?=$registerData->dv_number_plate?></span>
                                </p>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-6 form-group">
                                <label for=""><b>เอกสารสำเนาบัตรประชาชน</b></label>
                                <div id="show_imgdoc1-admin"></div>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for=""><b>เอกสารสำเนาทะเบียนบ้าน</b></label>
                                <div id="show_imgdoc2-admin"></div>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for=""><b>เอกสารสำเนาใบขับขี่</b></label>
                                <div id="show_imgdoc3-admin"></div>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for=""><b>เอกสารสำเนากรมธรรม์ประกันภัย</b></label>
                                <div id="show_imgdoc4-admin"></div>
                            </div>
                        </div>
                        <hr>
                        <div class="row form-group">
                            <div class="col-md-12 form-group">
                                <label for=""><b>หมายเหตุ</b></label>
                                <textarea name="ip-regis-memo" id="ip-regis-memo" class="form-control"></textarea>
                            </div>
                            <div class="col-md-12 form-group d-flex justify-content-center">
                                <div class="custom-control custom-radio mb-5 ml-3">
                                    <input type="radio" id="ip-regis-appro-yes" name="ip-regis-appro" value="อนุมัติ" class="custom-control-input" required> 
                                    <label for="ip-regis-appro-yes" class="custom-control-label">อนุมัติ</label>
                                </div> 
                                <div class="custom-control custom-radio mb-5 ml-3">
                                    <input type="radio" id="ip-regis-appro-no" name="ip-regis-appro" value="ไม่อนุมัติ" class="custom-control-input" required> 
                                    <label for="ip-regis-appro-no" class="custom-control-label">ไม่อนุมัติ</label>
                                </div>
                            </div>
                            <div class="col-md-12 form-group d-flex justify-content-center">
                                <button style="display:none;" class="btn btn-primary" id="btn-approveRegis" name="btn-approveRegis">ยืนยัน</button>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<script src="<?=base_url('assets/js/register_viewfull.js?v='.filemtime('./assets/js/register_viewfull.js'))?>"></script>
<script>
    let registerNo = "<?php echo $registerNo; ?>";
    let registerData = "";
</script>
