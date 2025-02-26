<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$title?></title>

</head>
<?php
$personTypes = [];

if ($dataviewfull->m_persontyped1 != 0) {
    $personTypes[] = "คนขับยกของ(Type1) " . $dataviewfull->m_persontyped1 . " คน";
}

if ($dataviewfull->m_persontyped2 != 0) {
    $personTypes[] = "คนขับยกของ(Type2) " . $dataviewfull->m_persontyped2 . " คน";
}

if ($dataviewfull->m_persontypee1 != 0) {
    $personTypes[] = "พนักงานยกของ(Type1) " . $dataviewfull->m_persontypee1 . " คน";
}

if ($dataviewfull->m_persontypee2 != 0) {
    $personTypes[] = "พนักงานยกของ(Type2) " . $dataviewfull->m_persontypee2 . " คน";
}

if (!empty($personTypes)) {
    $sumPersonType = implode(", ", $personTypes);
} else {
    $sumPersonType = "ไม่มีข้อมูล";
}

?>
<body>
    <div class="main-container">
        <div class="pd-ltr-20">
            <div class="row">
                <div class="col-md-12">
                    <div class="card-box height-100-p pd-20">
                        <h5 class="text-center">รายการเรียกใช้บริการ เลขที่ <?=$dataviewfull->m_formno?></h3>
                        <hr>

                        <div class="row form-group">
                            <div class="col-md-6">
                                <p><b>เอกสารเลขที่ : </b><?=$dataviewfull->m_formno?></p>
                            </div>
                            <div class="col-md-6">
                                <p><b>ชื่อลูกค้า : </b><?=$dataviewfull->mem_fname." ".$dataviewfull->mem_lname?></p>
                            </div>
                            <div class="col-md-6">
                                <p><b>หมายเลขโทรศัพท์ : </b><?=$dataviewfull->mem_tel?></p>
                            </div>
                            <div class="col-md-6">
                                <p><b>Status : </b><?=$dataviewfull->m_status?></p>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-6">
                                <p><b>ประเภทรถที่เลือก : </b><?=$dataviewfull->m_cartype?></p>
                            </div>
                            <div class="col-md-6">
                                <p><b>ประเภทคนยกของที่เลือก : </b><?=$sumPersonType?></p>
                            </div>
                            <div class="col-md-6">
                                <p><b>ต้นทาง : </b><?=$dataviewfull->m_origininput?></p>
                            </div>
                            <div class="col-md-6">
                                <p><b>ปลายทาง : </b><?=$dataviewfull->m_destinationinput?></p>
                            </div>
                            <div class="col-md-6">
                                <p><b>ระยะทางทั้งสิ้น : </b><?=$dataviewfull->m_distance?> กิโลเมตร</p>
                            </div>
                            <div class="col-md-6">
                                <p><b>รวมเป็นเงินทั้งสิ้น : </b><?=number_format($dataviewfull->m_totalprice , 2)?> บาท</p>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-12">
                                <div id="map"></div>
                            </div>
                        </div>
                        <hr>
                        <section id="reqPaySec" style="display:none;">
                            <h5 class="text-center">ยอดเรียกเก็บจากลูกค้า (เงินมัดจำ)</h5>
                            <hr>
                            <div class="row form-group">
                                <div class="col-md-12 form-group">
                                    <label for=""><b>จำนวนเงิน (บาท)</b></label>
                                    <input type="text" name="ip-viewfull-deposit" id="ip-viewfull-deposit" class="form-control" readonly value="<?=number_format($dataviewfull->m_deposit , 2)?>">
                                </div>
                                <div class="col-md-12 form-group">
                                    <label for=""><b>หมายเหตุ</b></label>
                                    <textarea name="ip-viewfull-memo" id="ip-viewfull-memo" class="form-control" readonly><?=$dataviewfull->m_am1_memo?></textarea>
                                </div>
                            </div>
                            <hr>
                                <h5 class="text-center">ยืนยันการโอนเงิน</h5>
                            <hr>
                            <div class="row form-group">
                                <div class="col-md-12 text-center">
                                    <p><b>กรุณาโอนเงิน เข้ามาที่บัญชีบริษัทเท่านั้น หลังโอนเสร็จกรุณาแนบหลักฐานการโอนเงินเข้ามาในระบบ เพื่อยืนยันการโอนเงิน</b></p>
                                    <p>
                                        <span class="mr-2"><b>เลขที่บัญชี : </b> 123456789</span>
                                        <span class="mr-2"><b>ชื่อบัญชี : </b>บริษัท จีที ทรานสปอร์ต จำกัด</span>
                                        <span class="mr-2"><b>ธนาคาร : </b>กสิกรไทย</span>
                                    </p>
                                    <p>
                                        <span class="mr-2"><b>เลขที่บัญชี : </b> 123456789</span>
                                        <span class="mr-2"><b>ชื่อบัญชี : </b>บริษัท จีที ทรานสปอร์ต จำกัด</span>
                                        <span class="mr-2"><b>ธนาคาร : </b>กสิกรไทย</span>
                                    </p>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-12 form-group text-center">
                                    <label for=""><b>จำนวนเงินที่โอน</b></label>
                                    <input type="number" name="ip-confirmNumPay" id="ip-confirmNumPay" class="form-control">
                                </div>
                            </div>
                            <div id="show_file_confirmPay" class="row form-group"></div>
                            <div class="row form-group sec_waitConfirm" style="display:none;">
                                <div class="col-md-12">
                                    <div id="fd_files1" class="dropzone"></div>
                                </div>
                            </div>
                            <div class="row form-group sec_waitConfirm" style="display:none;">
                                <div class="col-md-4"></div>
                                <div class="col-md-4">
                                    <button type="button" id="btn_confirmPay" name="btn_confirmPay" class="btn btn-success btn-block"><i class="dw dw-diskette2 mr-2"></i>ยืนยัน</button>
                                </div>
                                <div class="col-md-4"></div>
                            </div>
                        </section>
                            <!-- <div style="height:100px;"></div> -->
                        <section id="sec-showcus-getjob" style="display:none;">
                            <h5 class="text-center">ข้อมูลคนขับ</h5>
                            <div class="row form-group text-center mt-3">
                                <div class="col-md-12">
                                    <p>
                                        <span id="cus-drivername"></span>
                                        <span id="cus-drivertel"></span>
                                    </p>
                                    <p>
                                        <span id="cus-drivergetjob-datetime"></span>
                                    </p>
                                    <p>
                                        <span id="cus-driverCheckin-datetime"></span>
                                    </p>
                                    <p>
                                        <span id="cus-driverCheckinDes-datetime"></span>
                                    </p>
                                </div>
                            </div>
                        </section>

                        <section id="sec-dv_start-customer" style="display:none;">
                            <h5 class="text-center">รายละเอียดการเริ่มงาน</h5>
                            <hr>
                            <div class="row form-group">
                                <div class="col-md-12 form-group">
                                    <label for=""><b>ภาพประกอบ</b></label>
                                    <div id="show_imgStart-cus"></div>
                                </div>

                                <!-- Modal สำหรับแสดงภาพขนาดใหญ่ -->
                                <div id="image-modal" class="modal">
                                    <span class="modal-close">&times;</span>
                                    <img class="modal-content" id="modal-img">
                                </div>


                                <div class="col-md-12 form-group">
                                    <label for=""><b>หมายเหตุ</b></label>
                                    <textarea style="height:80px;" class="form-control" name="dv-ip-memostart" id="dv-ip-memostart"></textarea>
                                </div>
                            </div>
                            <div class="row form-group text-center">
                                <div class="col-md-6 form-group">
                                    <label for="" id="start-datashow-cus-drivername"></label>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="" id="start-datashow-cus-datetime"></label>
                                </div>
                            </div>
                            <hr>
                        </section>

                        <section id="sec-dv_stop-customer" style="display:none;">
                            <h5 class="text-center">รายละเอียดการปิดงาน</h5>
                            <hr>
                            <div class="row form-group">
                                <div class="col-md-12 form-group">
                                    <label for=""><b>ภาพประกอบ</b></label>
                                    <div id="show_imgStop-cus"></div>
                                </div>

                                <!-- Modal สำหรับแสดงภาพขนาดใหญ่ -->
                                <div id="image-modal" class="modal">
                                    <span class="modal-close">&times;</span>
                                    <img class="modal-content" id="modal-img">
                                </div>


                                <div class="col-md-12 form-group">
                                    <label for=""><b>หมายเหตุ</b></label>
                                    <textarea style="height:80px;" class="form-control" name="dv-ip-memostop" id="dv-ip-memostop"></textarea>
                                </div>
                            </div>
                            <div class="row form-group text-center">
                                <div class="col-md-6 form-group">
                                    <label for="" id="stop-datashow-cus-drivername"></label>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="" id="stop-datashow-cus-datetime"></label>
                                </div>
                            </div>
                            <hr>
                        </section>

                    </div>

                </div>
            </div>


            <div class="row form-group mt-2">
                <div class="col-md-12">
                    <div class="card-box height-100-p pd-20">
                        <h4 class="text-center" id="statusForUserText"></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<script src="<?=base_url('assets/js/request_viewfull_main.js?v='.filemtime('./assets/js/request_viewfull_main.js'))?>"></script>

<script>
    Dropzone.autoDiscover = false;
    let myDropzone1 = new Dropzone("#fd_files1", {
        url: url+'main/uploadFile_confirmPay',
        paramName: "file",
        maxFilesize: 10, // MB
        acceptedFiles: "image/*,application/pdf", // กำหนดประเภทของไฟล์ที่สามารถอัพโหลดได้
        addRemoveLinks: true,
        dictRemoveFile: "Remove file", // เปลี่ยน label ของปุ่ม remove file
        dictDefaultMessage: "ลากและวางไฟล์ที่นี่หรือคลิกเพื่อเลือกไฟล์",
        maxRetryAttempts: 3, // จำนวนครั้งสูงสุดในการพยายามเชื่อมต่อใหม่
        // autoProcessQueue: true, // ให้การประมวลผลคิวเป็นอัตโนมัติ
        chunking: true, // เปิดใช้งานการแบ่งไฟล์เป็นชิ้น ๆ
        chunkSize: 250000, // ขนาดของแต่ละ chunk (1 MB) 500000 = 500k
        parallelUploads: 1, // จำนวนการอัปโหลดพร้อมกัน
        resizeWidth: 1024, // กำหนดความกว้างของภาพที่ย่อ (ปรับตามที่ต้องการ)
        resizeHeight: 1024, // กำหนดความสูงของภาพที่ย่อ (ปรับตามที่ต้องการ)
        resizeMethod: 'contain', // วิธีการย่อขนาด สามารถใช้ contain, crop, หรือ none
        init: function () {
            this.on("sending", function (file, xhr, formData) {
                // ส่งพารามิเตอร์เพิ่มเติมไปด้วย
                formData.append("file_formno", "<?php echo $dataviewfull->m_formno;?>");
                formData.append("file_cusid" , "<?php echo $dataviewfull->m_cusid;?>");
                formData.append("file_type" , "confirmpayment");
            });
            this.on("success", function (file, response) {
                file.serverFileName = JSON.parse(response).fileName;
                console.log(file.serverFileName);
            });
            this.on("error", function (file, errorMessage , xhr) {
                console.error("Error : " , errorMessage);
                if (!file.retryAttempts) {
                    file.retryAttempts = 0;
                }

                // ตรวจสอบว่าข้อผิดพลาดเป็นปัญหาที่สามารถ retry ได้
                if (xhr && xhr.status >= 500 && xhr.status < 600) {
                    // ตรวจสอบว่า error เป็นเซิร์ฟเวอร์หรือไม่
                    if (file.retryAttempts < this.options.maxRetryAttempts) {
                        file.retryAttempts++;
                        console.log(`Retrying upload (${file.retryAttempts}/${this.options.maxRetryAttempts})...`);

                        setTimeout(() => {
                            this.retry(file);
                        }, 2000); // รอ 1 วินาทีเพื่อพยายามเชื่อมต่อใหม่
                    } else {
                        console.log("Failed to upload after maximum retry attempts.");
                    }
                } else {
                    console.log("Upload failed:", errorMessage);
                }
            });
            this.on("removedfile" , function (file){
                if(file.serverFileName){
                    //ส่งคำขอลบไฟล์ไปยังเซอร์เวอร์
                    console.log("ลบไฟล์:", file.serverFileName); // log ชื่อไฟล์ก่อนส่งคำขอลบ
                    fetch(url+"main/remove_confirmPay" , {
                        method:"POST",
                        headers:{
                            "Content-Type":"application/json"
                        },
                        body: JSON.stringify({ fileName: file.serverFileName })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if(data.status === "success"){
                            console.log("ไฟล์ถูกลบสำเร็จ");
                        }else{
                            console.error("เกิดข้อผิดพลาดในการลบไฟล์ : "+data.message);
                        }
                    })
                    .catch(error => console.error("เกิดข้อผิดพลาดในการลบไฟล์ : " , error));
                }
            });
            this.on("chunksUploaded", function (file, done) {
                console.log("ทุก chunk ของไฟล์นี้ถูกอัปโหลดเสร็จแล้ว");
                done(); // เรียก callback นี้เพื่อระบุว่าการอัปโหลดเสร็จสมบูรณ์
            });
        },
        // resize: function(file) {
        //     if (file.width > 1024 || file.height > 1024) {
        //         // กำหนดขนาดใหม่
        //         let ratio = file.width / file.height;
        //         let newWidth = 1024;
        //         let newHeight = 1024;
        //         if (file.width > file.height) {
        //             newHeight = newWidth / ratio;
        //         } else {
        //             newWidth = newHeight * ratio;
        //         }
        //         return {
        //             srcX: 0,
        //             srcY: 0,
        //             srcWidth: file.width,
        //             srcHeight: file.height,
        //             trgX: 0,
        //             trgY: 0,
        //             trgWidth: newWidth,
        //             trgHeight: newHeight
        //         };
        //     }
        //     return null; // ไม่ต้องย่อขนาด
        // }
    });
</script>
<script>
    let formno = "<?php echo $dataviewfull->m_formno ?>";
    let formstatus = "<?php echo $dataviewfull->m_status ?>";
    let totalprice = "<?php echo $dataviewfull->m_totalprice?>";
    let userid = "<?php echo $dataviewfull->m_cusid ?>";
    const getapikey = "<?php echo get_googlemap_apikey(); ?>";

    let map;
    let driverMarker;
    let currentLocation;

    // ฟังก์ชันเริ่มต้น
    function initMap() {
        // สร้างแผนที่
        map = new google.maps.Map(document.getElementById("map"), {
            zoom: 7,
            center: { lat: 13.736717, lng: 100.523186 }, // ตั้งค่าเริ่มต้น (กรุงเทพฯ)
        });

        // สร้างบริการ Directions
        const directionsService = new google.maps.DirectionsService();
        const directionsRenderer = new google.maps.DirectionsRenderer({
            map: map,
        });

        // ชื่อสถานที่ต้นทางและปลายทาง
        const origin = "<?php echo $dataviewfull->m_origininput ?>"; // ต้นทาง
        const destination = "<?php echo $dataviewfull->m_destinationinput ?>"; // ปลายทาง

        // สร้างคำขอเส้นทาง
        const request = {
            origin: origin,
            destination: destination,
            travelMode: "DRIVING", // ประเภทการเดินทาง เช่น DRIVING, WALKING, BICYCLING, TRANSIT
        };

        // คำนวณเส้นทาง
        directionsService.route(request, (result, status) => {
            if (status === "OK") {
            directionsRenderer.setDirections(result); // แสดงเส้นทางบนแผนที่
            } else {
            console.error("เกิดข้อผิดพลาดในการคำนวณเส้นทาง:", status);
            }
        });
    }

      // เรียกใช้ฟังก์ชันเมื่อโหลดหน้า
//   window.onload = initMap;
</script>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=<?=get_googlemap_apikey()?>&libraries=places&callback=initMap"></script>
