<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้าแสดงรายละเอียดของผู้สมัคร</title>
</head>

<body>
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
                            <div class="col-md-12 form-group">
                                <label for=""><b>เอกสารสำเนาบัตรประชาชน</b></label>
                                <div id="show_imgStop-admin"></div>
                            </div>

                            <!-- Modal สำหรับแสดงภาพขนาดใหญ่ -->
                            <div id="image-modal-stop" class="modal">
                                <span class="modal-close">&times;</span>
                                <img class="modal-content" id="modal-img-stop">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12 form-group">
                                <label for=""><b>เอกสารสำเนาทะเบียนบ้าน</b></label>
                                <div id="show_imgStop-admin"></div>
                            </div>

                            <!-- Modal สำหรับแสดงภาพขนาดใหญ่ -->
                            <div id="image-modal-stop" class="modal">
                                <span class="modal-close">&times;</span>
                                <img class="modal-content" id="modal-img-stop">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12 form-group">
                                <label for=""><b>เอกสารสำเนาใบขับขี่</b></label>
                                <div id="show_imgStop-admin"></div>
                            </div>

                            <!-- Modal สำหรับแสดงภาพขนาดใหญ่ -->
                            <div id="image-modal-stop" class="modal">
                                <span class="modal-close">&times;</span>
                                <img class="modal-content" id="modal-img-stop">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12 form-group">
                                <label for=""><b>เอกสารสำเนากรมธรรม์ประกันภัย</b></label>
                                <div id="show_imgStop-admin"></div>
                            </div>

                            <!-- Modal สำหรับแสดงภาพขนาดใหญ่ -->
                            <div id="image-modal-stop" class="modal">
                                <span class="modal-close">&times;</span>
                                <img class="modal-content" id="modal-img-stop">
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
</script>
