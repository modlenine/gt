<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้าแสดงรายละเอียดของรายการ</title>
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
                        <h5 class="text-center">รายการ</h3>
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
                        <h5 class="text-center">ยอดเรียกเก็บจากลูกค้า</h5>
                        <hr>
                        <div class="row form-group">
                            <!-- <div class="col-md-6 form-group">
                                <label for=""><b>เงินมัดจำ (เปอร์เซ็น) จากยอดเต็ม</b></label>
                                <input readonly type="text" class="form-control" name="ip-viewfullJob-depositpercen" id="ip-viewfullJob-depositpercen" value="<?=$dataviewfull->m_deposit_percen?> %">
                            </div> -->
                            <div class="col-md-6 form-group">
                                <label for=""><b>เงินมัดจำชำระแล้ว</b></label>
                                <input type="text" name="ip-viewfullJob-deposit" id="ip-viewfullJob-deposit" class="form-control" readonly value="<?=$dataviewfull->m_deposit?> บาท">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for=""><b>ยอดคงค้างชำระ</b></label>
                                <input type="text" name="ip-viewfullJob-deposit" id="ip-viewfullJob-deposit" class="form-control" readonly value="<?=$dataviewfull->m_totalprice-$dataviewfull->m_deposit?> บาท">
                            </div>
                            <!-- <div class="col-md-12 form-group">
                                <label for=""><b>หมายเหตุ</b></label>
                                <textarea style="height:80px;" readonly name="ip-viewfullJob-memo" id="ip-viewfullJob-memo" class="form-control"><?=$dataviewfull->m_am1_memo?></textarea>
                            </div> -->
       
                        </div>
                        <hr>
                        <!-- Section สำหรับกดรับงาน -->
                        <section id="sec_dv-getjob" style="display:none;">
                            <div class="row form-group">
                                <div class="col-md-4"></div>
                                <div class="col-md-4">
                                    <button type="button" class="btn btn-primary btn-block" name="btn_dv-getjob" id="btn_dv-getjob">รับงาน</button>
                                </div>
                                <div class="col-md-4"></div>
                            </div>
                        </section>

                        <section id="sec_dv-getjob-already" style="display:none;">
                            <div class="row form-group text-center">
                                <div class="col-md-4"></div>
                                <div class="col-md-4">
                                    <div id="show_expireTime"></div>
                                </div>
                                <div class="col-md-4"></div>
                            </div>
                        </section>

                        <section id="sec_dv-checkIn" style="display:none;">
                        <div class="row form-group">
                                <div class="col-md-4"></div>
                                <div class="col-md-4" id="show_navigator"></div>
                                <div class="col-md-4"></div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-4"></div>
                                <div class="col-md-4">
                                    <button type="button" class="btn btn-primary btn-block" name="btn_dv-checkin" id="btn_dv-checkin">เช็กอิน</button>
                                </div>
                                <div class="col-md-4"></div>
                            </div>
                        </section>

                        <section id="sec_dv-checkInAlready" style="display:none;">
                            <h5 class="text-center">คนขับ เช็กอินหน้างาน (ต้นทาง)</h5>
                            <hr>
                            <div class="row form-group text-center">
                                <div class="col-md-6">
                                    <label for="" id="checkin-datashow-drivername"></label>
                                </div>
                                <div class="col-md-6">
                                    <label for="" id="checkin-datashow-datetime"></label>
                                </div>
                            </div>
                        </section>
                        <hr>

                        <section id="sec-dv_start" style="display:none;">
                            <h5 class="text-center">รายละเอียดการเริ่มงาน</h5>
                            <hr>
                            <div class="row form-group">
                                <div class="col-md-12 form-group">
                                    <label for=""><b>ภาพประกอบ</b></label>
                                    <div id="dv_start" class="dropzone"></div>
                                    <div id="show_imgStart"></div>
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
                            <div class="row form-group" id="sec_btnsaveStart" style="display:none;">
                                <div class="col-md-4"></div>
                                <div class="col-md-4">
                                    <button type="button" class="btn btn-primary btn-block" id="btn-dv-saveStart" name="btn-dv-saveStart" disabled>บันทึก</button>
                                </div>
                                <div class="col-md-4"></div>
                            </div>
                            <div class="row form-group text-center" id="secDataStart" style="display:none;">
                                <div class="col-md-6 form-group">
                                    <label for="" id="start-datashow-drivername"></label>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="" id="start-datashow-datetime"></label>
                                </div>
                            </div>
                            <hr>
                        </section>

                        <section id="sec_dv-checkInDes" style="display:none;">
                            <div class="row form-group">
                                <div class="col-md-4"></div>
                                <div class="col-md-4">
                                    <button type="button" class="btn btn-primary btn-block" name="btn_dv-checkinDes" id="btn_dv-checkinDes">เช็กอิน</button>
                                </div>
                                <div class="col-md-4"></div>
                            </div>
                        </section>

                        <section id="sec_dv-checkInAlreadyDes" style="display:none;">
                            <h5 class="text-center">คนขับ เช็กอินหน้างาน (ปลายทาง)</h5>
                            <hr>
                            <div class="row form-group text-center">
                                <div class="col-md-6">
                                    <label for="" id="checkinDes-datashow-drivername"></label>
                                </div>
                                <div class="col-md-6">
                                    <label for="" id="checkinDes-datashow-datetime"></label>
                                </div>
                            </div>
                        </section>
                        <hr>

                        <section id="sec-dv_stop" style="display:none;">
                            <h5 class="text-center">รายละเอียดการปิดงาน</h5>
                            <hr>
                            <div class="row form-group">
                                <div class="col-md-12 form-group">
                                    <label for=""><b>ภาพประกอบ</b></label>
                                    <div id="dv_stop" class="dropzone"></div>
                                    <div id="show_imgStop"></div>
                                </div>

                                <!-- Modal สำหรับแสดงภาพขนาดใหญ่ -->
                                <div id="image-modal-stop" class="modal">
                                    <span class="modal-close">&times;</span>
                                    <img class="modal-content" id="modal-img-stop">
                                </div>


                                <div class="col-md-12 form-group">
                                    <label for=""><b>หมายเหตุ</b></label>
                                    <textarea style="height:80px;" class="form-control" name="dv-ip-memostop" id="dv-ip-memostop"></textarea>
                                </div>
                            </div>
                            <div class="row form-group" id="sec_btnsaveStop" style="display:none;">
                                <div class="col-md-4"></div>
                                <div class="col-md-4">
                                    <button type="button" class="btn btn-primary btn-block" id="btn-dv-saveStop" name="btn-dv-saveStop" disabled>บันทึก</button>
                                </div>
                                <div class="col-md-4"></div>
                            </div>
                            <div class="row form-group text-center" id="secDataStop" style="display:none;">
                                <div class="col-md-6 form-group">
                                    <label for="" id="stop-datashow-drivername"></label>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="" id="stop-datashow-datetime"></label>
                                </div>
                            </div>
                            <hr>
                        </section>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<script src="<?=base_url('assets/js/requestJob_viewfull.js?v='.filemtime('./assets/js/requestJob_viewfull.js'))?>"></script>

<script>
    Dropzone.autoDiscover = false;
    let dv_before = new Dropzone("#dv_start", {
        url: url+'backend/drivers/uploadFile_start',
        paramName: "file",
        maxFilesize: 10, // MB
        acceptedFiles: "image/*", // กำหนดประเภทของไฟล์ที่สามารถอัพโหลดได้
        addRemoveLinks: true,
        dictRemoveFile: "Remove file", // เปลี่ยน label ของปุ่ม remove file
        dictDefaultMessage: "ลากและวางไฟล์ที่นี่หรือคลิกเพื่อเลือกไฟล์",
        maxRetryAttempts: 3, // จำนวนครั้งสูงสุดในการพยายามเชื่อมต่อใหม่
        // autoProcessQueue: true, // ให้การประมวลผลคิวเป็นอัตโนมัติ
        chunking: true, // เปิดใช้งานการแบ่งไฟล์เป็นชิ้น ๆ
        chunkSize: 250000, // ขนาดของแต่ละ chunk (1 MB) 500000 = 500k
        parallelUploads: 2, // จำนวนการอัปโหลดพร้อมกัน
        // resizeWidth: 1024, // กำหนดความกว้างของภาพที่ย่อ (ปรับตามที่ต้องการ)
        // resizeHeight: 1024, // กำหนดความสูงของภาพที่ย่อ (ปรับตามที่ต้องการ)
        createImageThumbnails:true,
        thumbnailMethod:"crop",
        thumbnailWidth: 120,
        thumbnailHeight: 120,
        // resizeMethod: 'contain', // วิธีการย่อขนาด สามารถใช้ contain, crop, หรือ none
        init: function () {
            this.on("sending", function (file, xhr, formData) {
                // ส่งพารามิเตอร์เพิ่มเติมไปด้วย
                formData.append("file_formno", "<?php echo $dataviewfull->m_formno;?>");
                formData.append("file_driverusername" , "<?php echo $dataviewfull->m_dv_user_checkin;?>");
                formData.append("file_type" , "start");
            });
            this.on("addedfile", function(file) {
                document.getElementById("btn-dv-saveStart").disabled = false;
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
                if (this.files.length === 0) {
                    document.getElementById("btn-dv-saveStart").disabled = true;
                }
                if(file.serverFileName){
                    //ส่งคำขอลบไฟล์ไปยังเซอร์เวอร์
                    console.log("ลบไฟล์:", file.serverFileName); // log ชื่อไฟล์ก่อนส่งคำขอลบ
                    fetch(url+"backend/drivers/removeFile_start" , {
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
            this.on("thumbnail", function(file, dataUrl) {
                console.log("สร้าง thumbnail สำเร็จ:", file.name);
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

    let dv_stop = new Dropzone("#dv_stop", {
        url: url+'backend/drivers/uploadFile_stop',
        paramName: "file",
        maxFilesize: 10, // MB
        acceptedFiles: "image/*", // กำหนดประเภทของไฟล์ที่สามารถอัพโหลดได้
        addRemoveLinks: true,
        dictRemoveFile: "Remove file", // เปลี่ยน label ของปุ่ม remove file
        dictDefaultMessage: "ลากและวางไฟล์ที่นี่หรือคลิกเพื่อเลือกไฟล์",
        maxRetryAttempts: 3, // จำนวนครั้งสูงสุดในการพยายามเชื่อมต่อใหม่
        // autoProcessQueue: true, // ให้การประมวลผลคิวเป็นอัตโนมัติ
        chunking: true, // เปิดใช้งานการแบ่งไฟล์เป็นชิ้น ๆ
        chunkSize: 250000, // ขนาดของแต่ละ chunk (1 MB) 500000 = 500k
        parallelUploads: 2, // จำนวนการอัปโหลดพร้อมกัน
        // resizeWidth: 1024, // กำหนดความกว้างของภาพที่ย่อ (ปรับตามที่ต้องการ)
        // resizeHeight: 1024, // กำหนดความสูงของภาพที่ย่อ (ปรับตามที่ต้องการ)
        createImageThumbnails:true,
        thumbnailMethod:"crop",
        thumbnailWidth: 120,
        thumbnailHeight: 120,
        // resizeMethod: 'contain', // วิธีการย่อขนาด สามารถใช้ contain, crop, หรือ none
        init: function () {
            this.on("sending", function (file, xhr, formData) {
                // ส่งพารามิเตอร์เพิ่มเติมไปด้วย
                formData.append("file_formno", "<?php echo $dataviewfull->m_formno;?>");
                formData.append("file_driverusername" , "<?php echo $dataviewfull->m_dv_user_checkin;?>");
                formData.append("file_type" , "stop");
            });
            this.on("addedfile", function(file) {
                document.getElementById("btn-dv-saveStop").disabled = false;
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
                if (this.files.length === 0) {
                    document.getElementById("btn-dv-saveStop").disabled = true;
                }
                if(file.serverFileName){
                    //ส่งคำขอลบไฟล์ไปยังเซอร์เวอร์
                    console.log("ลบไฟล์:", file.serverFileName); // log ชื่อไฟล์ก่อนส่งคำขอลบ
                    fetch(url+"backend/drivers/removeFile_stop" , {
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
            this.on("thumbnail", function(file, dataUrl) {
                console.log("สร้าง thumbnail สำเร็จ:", file.name);
            });
            this.on("chunksUploaded", function (file, done) {
                console.log("ทุก chunk ของไฟล์นี้ถูกอัปโหลดเสร็จแล้ว");
                done(); // เรียก callback นี้เพื่อระบุว่าการอัปโหลดเสร็จสมบูรณ์
            });
        },
    });
</script>

<script>
    let formno = "<?php echo $dataviewfull->m_formno ?>";
    let formstatus = "<?php echo $dataviewfull->m_status ?>";
    let totalprice = "<?php echo $dataviewfull->m_totalprice?>";
    let driverUsername = "<?php echo $this->session->dv_username ?>";
    const getapikey = "<?php echo get_googlemap_apikey(); ?>";

    let map;
    let driverMarker;
    let currentLocation;

    let origin;
    let destination;
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
        origin = "<?php echo $dataviewfull->m_origininput ?>"; // ต้นทาง
        destination = "<?php echo $dataviewfull->m_destinationinput ?>"; // ปลายทาง

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


    function clickGetJob()
    {
        // ตรวจสอบ permission ด้วย Permissions API
        document.getElementById("btn_dv-getjob").disabled = true;
        if (navigator.permissions) {
            navigator.permissions.query({ name: 'geolocation' }).then(function(permissionStatus) {
                console.log("สถานะ permission:", permissionStatus.state);
                if (permissionStatus.state === 'granted' || permissionStatus.state === 'prompt') {
                    // ถ้าอนุญาตหรืออยู่ในสถานะ prompt ให้ดึงตำแหน่ง
                    getJob(formno);
                } else {
                    // ถ้าไม่ได้อนุญาต
                    swal({
                        title: 'การเข้าถึงตำแหน่งถูกปฏิเสธ',
                        text: 'โปรดอนุญาตการเข้าถึงตำแหน่งเพื่อทำการเช็กอิน',
                        type: 'error'
                    });
                    document.getElementById("btn_dv-getjob").disabled = false;
                }
            });
        } else {
            // หากเบราว์เซอร์ไม่รองรับ Permissions API ให้ลองเรียก getCurrentPosition ตรงๆ
            getJob(formno);
        }
    }

    function getJob(formno)
    {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
            function (position) {
                currentLocation = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude,
                };

                // สร้าง marker สำหรับแสดงตำแหน่งบนแผนที่ (ตัวอย่าง)
                const carIcon = {
                    url: url+"images/driverIcon.png",
                    scaledSize: new google.maps.Size(60, 60)
                };

                if (driverMarker) {
                    driverMarker.setPosition(currentLocation);
                } else {
                    driverMarker = new google.maps.Marker({
                        position: currentLocation,
                        map: map,
                        title: "ตำแหน่งคนขับ",
                        icon: carIcon,
                    });
                }
                map.setCenter(currentLocation);

                // ส่งข้อมูลตำแหน่งไปบันทึกที่ backend (เช่น PHP)
                if(formno){
                    const formdata = new FormData();
                    formdata.append('formno' , formno);
                    formdata.append('lat', currentLocation.lat);
                    formdata.append('lng', currentLocation.lng);
                    axios.post(url+'backend/drivers/getJob' , formdata).then(res=>{
                        console.log(res.data);
                        if(res.data.status == "Update Data Success"){
                            swal({
                                title: 'รับงานสำเร็จ คุณมีเวลา 40 นาที',
                                type: 'success',
                                showConfirmButton: false,
                                timer:1500
                            }).then(()=>{
                                location.reload();
                                getExpireTime(formno);
                            });
                        }
                    });
                }
            },
            function (error) {
                console.error("ไม่สามารถดึงตำแหน่งของคุณได้", error);
                if (error.code === error.PERMISSION_DENIED) {
                    swal({
                        title: 'การเข้าถึงตำแหน่งถูกปฏิเสธ',
                        text: 'โปรดอนุญาตการเข้าถึงตำแหน่งเพื่อทำการเช็กอิน',
                        type: 'error'
                    });
                    document.getElementById("btn_dv-getjob").disabled = false;
                } else {
                    swal({
                        title: 'เกิดข้อผิดพลาด',
                        text: 'ไม่สามารถดึงตำแหน่งของคุณได้',
                        type: 'error'
                    });
                    document.getElementById("btn_dv-getjob").disabled = false;
                }
            },
            {
                enableHighAccuracy: true,
                maximumAge: 0,
                timeout: 5000
            }
            );
        } else {
            swal({
            title: 'เบราว์เซอร์ไม่รองรับ',
            text: 'เบราว์เซอร์นี้ไม่รองรับ Geolocation',
            type: 'error'
            });
            document.getElementById("btn_dv-getjob").disabled = false;
        }

    }

    // ฟังก์ชันสำหรับการ Checkin คนขับรถ
    function checkinDriver() {
        // ตรวจสอบ permission ด้วย Permissions API
        document.getElementById("btn_dv-checkin").disabled = true;
        if (navigator.permissions) {
            navigator.permissions.query({ name: 'geolocation' }).then(function(permissionStatus) {
                console.log("สถานะ permission:", permissionStatus.state);
                if (permissionStatus.state === 'granted' || permissionStatus.state === 'prompt') {
                    // ถ้าอนุญาตหรืออยู่ในสถานะ prompt ให้ดึงตำแหน่ง
                    getAndSaveCurrentLocation();
                } else {
                    // ถ้าไม่ได้อนุญาต
                    swal({
                        title: 'การเข้าถึงตำแหน่งถูกปฏิเสธ',
                        text: 'โปรดอนุญาตการเข้าถึงตำแหน่งเพื่อทำการเช็กอิน',
                        type: 'error'
                    });
                    document.getElementById("btn_dv-checkin").disabled = false;
                }
            });
        } else {
            // หากเบราว์เซอร์ไม่รองรับ Permissions API ให้ลองเรียก getCurrentPosition ตรงๆ
            getAndSaveCurrentLocation();
        }
    }

    function getAndSaveCurrentLocation()
    {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
            function (position) {
                currentLocation = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude,
                };

                // สร้าง marker สำหรับแสดงตำแหน่งบนแผนที่ (ตัวอย่าง)
                const carIcon = {
                    url: url+"images/driverIcon.png",
                    scaledSize: new google.maps.Size(60, 60)
                };

                if (driverMarker) {
                    driverMarker.setPosition(currentLocation);
                } else {
                    driverMarker = new google.maps.Marker({
                        position: currentLocation,
                        map: map,
                        title: "ตำแหน่งเช็กอิน",
                        icon: carIcon,
                    });
                }
                map.setCenter(currentLocation);

                // ส่งข้อมูลตำแหน่งไปบันทึกที่ backend (เช่น PHP)
                if (driverUsername && formno) {
                    const formdata = new FormData();
                    formdata.append('formno', formno);
                    formdata.append('driverUsername', driverUsername);
                    formdata.append('lat', currentLocation.lat);
                    formdata.append('lng', currentLocation.lng);
                    axios.post(url + 'backend/drivers/checkin', formdata)
                    .then(res => {
                    console.log(res.data);
                    document.getElementById("btn_dv-checkin").disabled = false;
                    if (res.data.status === "Update Data Success") {
                        swal({
                            title: 'เช็กอินหน้างานสำเร็จ',
                            type: 'success',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            // ตัวอย่างเรียกดึงข้อมูลกลับมาใช้งาน
                            location.reload();
                            getCheckInData();
                        });
                    }
                    })
                    .catch(err => {
                        console.error("Error saving data:", err);
                    });
                }
            },
            function (error) {
                console.error("ไม่สามารถดึงตำแหน่งของคุณได้", error);
                if (error.code === error.PERMISSION_DENIED) {
                    swal({
                        title: 'การเข้าถึงตำแหน่งถูกปฏิเสธ',
                        text: 'โปรดอนุญาตการเข้าถึงตำแหน่งเพื่อทำการเช็กอิน',
                        type: 'error'
                    });
                    document.getElementById("btn_dv-checkin").disabled = false;
                } else {
                    swal({
                        title: 'เกิดข้อผิดพลาด',
                        text: 'ไม่สามารถดึงตำแหน่งของคุณได้',
                        type: 'error'
                    });
                    document.getElementById("btn_dv-checkin").disabled = false;
                }
            },
            {
                enableHighAccuracy: true,
                maximumAge: 0,
                timeout: 5000
            }
            );
        } else {
            swal({
            title: 'เบราว์เซอร์ไม่รองรับ',
            text: 'เบราว์เซอร์นี้ไม่รองรับ Geolocation',
            type: 'error'
            });
            document.getElementById("btn_dv-checkin").disabled = false;
        }
    }

    function clickSaveStartJob() {
        // ตรวจสอบ permission ด้วย Permissions API
        document.getElementById("btn-dv-saveStart").disabled = true;
        if (navigator.permissions) {
            navigator.permissions.query({ name: 'geolocation' }).then(function(permissionStatus) {
                console.log("สถานะ permission:", permissionStatus.state);
                if (permissionStatus.state === 'granted' || permissionStatus.state === 'prompt') {
                    // ถ้าอนุญาตหรืออยู่ในสถานะ prompt ให้ดึงตำแหน่ง
                    startJob();
                } else {
                    // ถ้าไม่ได้อนุญาต
                    swal({
                        title: 'การเข้าถึงตำแหน่งถูกปฏิเสธ',
                        text: 'โปรดอนุญาตการเข้าถึงตำแหน่งเพื่อทำการเช็กอิน',
                        type: 'error'
                    });
                    document.getElementById("btn-dv-saveStart").disabled = false;
                }
            });
        } else {
            // หากเบราว์เซอร์ไม่รองรับ Permissions API ให้ลองเรียก getCurrentPosition ตรงๆ
            startJob();
        }
    }

    function startJob()
    {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
            function (position) {
                currentLocation = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude,
                };

                // สร้าง marker สำหรับแสดงตำแหน่งบนแผนที่ (ตัวอย่าง)
                const carIcon = {
                    url: url+"images/driverIcon.png",
                    scaledSize: new google.maps.Size(60, 60)
                };

                if (driverMarker) {
                    driverMarker.setPosition(currentLocation);
                } else {
                    driverMarker = new google.maps.Marker({
                        position: currentLocation,
                        map: map,
                        title: "ตำแหน่งคนขับ",
                        icon: carIcon,
                    });
                }
                map.setCenter(currentLocation);

                // ส่งข้อมูลตำแหน่งไปบันทึกที่ backend (เช่น PHP)
                if(formno && driverUsername){
                    const formdata = new FormData();
                    formdata.append('formno' , formno);
                    formdata.append('driverusername' , driverUsername);
                    formdata.append('type' , 'start');
                    formdata.append('memo' , $('#dv-ip-memostart').val());
                    formdata.append('lat', currentLocation.lat);
                    formdata.append('lng', currentLocation.lng);
                    axios.post(url+'backend/drivers/saveStart' , formdata).then(res=>{
                        console.log(res.data);
                        document.getElementById("btn-dv-saveStart").disabled = false;
                        if(res.data.status == "Update Data Success"){
                            swal({
                                title: 'บันทึกข้อมูลเริ่มงานสำเร็จ',
                                type: 'success',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                // ตัวอย่างเรียกดึงข้อมูลกลับมาใช้งาน
                                location.reload();
                            });
                        }
                    });
                }
            },
            function (error) {
                console.error("ไม่สามารถดึงตำแหน่งของคุณได้", error);
                if (error.code === error.PERMISSION_DENIED) {
                    swal({
                        title: 'การเข้าถึงตำแหน่งถูกปฏิเสธ',
                        text: 'โปรดอนุญาตการเข้าถึงตำแหน่งเพื่อทำการเช็กอิน',
                        type: 'error'
                    });
                    document.getElementById("btn-dv-saveStart").disabled = false;
                } else {
                    swal({
                        title: 'เกิดข้อผิดพลาด',
                        text: 'ไม่สามารถดึงตำแหน่งของคุณได้',
                        type: 'error'
                    });
                    document.getElementById("btn-dv-saveStart").disabled = false;
                }
            },
            {
                enableHighAccuracy: true,
                maximumAge: 0,
                timeout: 5000
            }
            );
        } else {
            swal({
                title: 'เบราว์เซอร์ไม่รองรับ',
                text: 'เบราว์เซอร์นี้ไม่รองรับ Geolocation',
                type: 'error'
            });
            document.getElementById("btn-dv-saveStart").disabled = false;
        }
    }

    function checkinDriverDes() {
        // ตรวจสอบ permission ด้วย Permissions API
        document.getElementById("btn_dv-checkinDes").disabled = true;
        if (navigator.permissions) {
            navigator.permissions.query({ name: 'geolocation' }).then(function(permissionStatus) {
                console.log("สถานะ permission:", permissionStatus.state);
                if (permissionStatus.state === 'granted' || permissionStatus.state === 'prompt') {
                    // ถ้าอนุญาตหรืออยู่ในสถานะ prompt ให้ดึงตำแหน่ง
                    getAndSaveCurrentLocationDes();
                } else {
                    // ถ้าไม่ได้อนุญาต
                    swal({
                        title: 'การเข้าถึงตำแหน่งถูกปฏิเสธ',
                        text: 'โปรดอนุญาตการเข้าถึงตำแหน่งเพื่อทำการเช็กอิน',
                        type: 'error'
                    });
                    document.getElementById("btn_dv-checkinDes").disabled = false;
                }
            });
        } else {
            // หากเบราว์เซอร์ไม่รองรับ Permissions API ให้ลองเรียก getCurrentPosition ตรงๆ
            getAndSaveCurrentLocationDes();
        }
    }

    function getAndSaveCurrentLocationDes()
    {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
            function (position) {
                currentLocation = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude,
                };

                // สร้าง marker สำหรับแสดงตำแหน่งบนแผนที่ (ตัวอย่าง)
                const carIcon = {
                    url: url+"images/driverIcon.png",
                    scaledSize: new google.maps.Size(60, 60)
                };

                if (driverMarker) {
                    driverMarker.setPosition(currentLocation);
                } else {
                    driverMarker = new google.maps.Marker({
                        position: currentLocation,
                        map: map,
                        title: "ตำแหน่งเช็กอิน",
                        icon: carIcon,
                    });
                }
                map.setCenter(currentLocation);

                // ส่งข้อมูลตำแหน่งไปบันทึกที่ backend (เช่น PHP)
                if (driverUsername && formno) {
                    const formdata = new FormData();
                    formdata.append('formno', formno);
                    formdata.append('driverUsername', driverUsername);
                    formdata.append('lat', currentLocation.lat);
                    formdata.append('lng', currentLocation.lng);
                    axios.post(url + 'backend/drivers/checkinDes', formdata)
                    .then(res => {
                    console.log(res.data);
                    document.getElementById("btn_dv-checkinDes").disabled = false;
                    if (res.data.status === "Update Data Success") {
                        swal({
                            title: 'เช็กอินหน้างานสำเร็จ',
                            type: 'success',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            // ตัวอย่างเรียกดึงข้อมูลกลับมาใช้งาน
                            location.reload();
                            getCheckInDataDes();
                        });
                    }
                    })
                    .catch(err => {
                        console.error("Error saving data:", err);
                    });
                }
            },
            function (error) {
                console.error("ไม่สามารถดึงตำแหน่งของคุณได้", error);
                if (error.code === error.PERMISSION_DENIED) {
                    swal({
                        title: 'การเข้าถึงตำแหน่งถูกปฏิเสธ',
                        text: 'โปรดอนุญาตการเข้าถึงตำแหน่งเพื่อทำการเช็กอิน',
                        type: 'error'
                    });
                    document.getElementById("btn_dv-checkinDes").disabled = false;
                } else {
                    swal({
                        title: 'เกิดข้อผิดพลาด',
                        text: 'ไม่สามารถดึงตำแหน่งของคุณได้',
                        type: 'error'
                    });
                    document.getElementById("btn_dv-checkinDes").disabled = false;
                }
            },
            {
                enableHighAccuracy: true,
                maximumAge: 0,
                timeout: 5000
            }
            );
        } else {
            swal({
            title: 'เบราว์เซอร์ไม่รองรับ',
            text: 'เบราว์เซอร์นี้ไม่รองรับ Geolocation',
            type: 'error'
            });
            document.getElementById("btn_dv-checkinDes").disabled = false;
        }
    }

    function clickSaveStopJob() {
        // ตรวจสอบ permission ด้วย Permissions API
        document.getElementById("btn-dv-saveStop").disabled = true;
        if (navigator.permissions) {
            navigator.permissions.query({ name: 'geolocation' }).then(function(permissionStatus) {
                console.log("สถานะ permission:", permissionStatus.state);
                if (permissionStatus.state === 'granted' || permissionStatus.state === 'prompt') {
                    // ถ้าอนุญาตหรืออยู่ในสถานะ prompt ให้ดึงตำแหน่ง
                    stopJob();
                } else {
                    // ถ้าไม่ได้อนุญาต
                    swal({
                        title: 'การเข้าถึงตำแหน่งถูกปฏิเสธ',
                        text: 'โปรดอนุญาตการเข้าถึงตำแหน่งเพื่อทำการเช็กอิน',
                        type: 'error'
                    });
                    document.getElementById("btn-dv-saveStop").disabled = false;
                }
            });
        } else {
            // หากเบราว์เซอร์ไม่รองรับ Permissions API ให้ลองเรียก getCurrentPosition ตรงๆ
            stopJob();
        }
    }

    function stopJob()
    {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
            function (position) {
                currentLocation = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude,
                };

                // สร้าง marker สำหรับแสดงตำแหน่งบนแผนที่ (ตัวอย่าง)
                const carIcon = {
                    url: url+"images/driverIcon.png",
                    scaledSize: new google.maps.Size(60, 60)
                };

                if (driverMarker) {
                    driverMarker.setPosition(currentLocation);
                } else {
                    driverMarker = new google.maps.Marker({
                        position: currentLocation,
                        map: map,
                        title: "ตำแหน่งคนขับ",
                        icon: carIcon,
                    });
                }
                map.setCenter(currentLocation);

                // ส่งข้อมูลตำแหน่งไปบันทึกที่ backend (เช่น PHP)
                if(formno && driverUsername){
                    const formdata = new FormData();
                    formdata.append('formno' , formno);
                    formdata.append('driverusername' , driverUsername);
                    formdata.append('type' , 'stop');
                    formdata.append('memo' , $('#dv-ip-memostop').val());
                    formdata.append('lat', currentLocation.lat);
                    formdata.append('lng', currentLocation.lng);
                    axios.post(url+'backend/drivers/saveStop' , formdata).then(res=>{
                        console.log(res.data);
                        document.getElementById("btn-dv-saveStop").disabled = false;
                        if(res.data.status == "Update Data Success"){
                            swal({
                                title: 'บันทึกข้อมูลปิดงานสำเร็จ',
                                type: 'success',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                // ตัวอย่างเรียกดึงข้อมูลกลับมาใช้งาน
                                location.reload();
                            });
                        }
                    });
                }
            },
            function (error) {
                console.error("ไม่สามารถดึงตำแหน่งของคุณได้", error);
                if (error.code === error.PERMISSION_DENIED) {
                    swal({
                        title: 'การเข้าถึงตำแหน่งถูกปฏิเสธ',
                        text: 'โปรดอนุญาตการเข้าถึงตำแหน่งเพื่อทำการเช็กอิน',
                        type: 'error'
                    });
                    document.getElementById("btn-dv-saveStop").disabled = false;
                } else {
                    swal({
                        title: 'เกิดข้อผิดพลาด',
                        text: 'ไม่สามารถดึงตำแหน่งของคุณได้',
                        type: 'error'
                    });
                    document.getElementById("btn-dv-saveStop").disabled = false;
                }
            },
            {
                enableHighAccuracy: true,
                maximumAge: 0,
                timeout: 5000
            }
            );
        } else {
            swal({
                title: 'เบราว์เซอร์ไม่รองรับ',
                text: 'เบราว์เซอร์นี้ไม่รองรับ Geolocation',
                type: 'error'
            });
            document.getElementById("btn-dv-saveStop").disabled = false;
        }
    }

    

    //   window.onload = initMap;
</script>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=<?=get_googlemap_apikey()?>&libraries=places&callback=initMap"></script>