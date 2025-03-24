<!DOCTYPE html>
<html>
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>หน้า สมัครรถร่วมบริการ</title>

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
    <script src="<?=base_url('assets/js/axios.min.js')?>"></script>

    <script src="<?=base_url()?>assets/dropzone-mobile/dist/dropzone.js"></script>
	<link href="<?=base_url()?>assets/dropzone-mobile/dist/dropzone.css" rel="stylesheet" type="text/css" />

	<style>
		.btn-primary{
			background-color:#465881;
			border-color:#465881;
		}
		.btn-primary:hover{
			background-color:#406bcd;
			border-color:#406bcd;
		}
        .login-box{
            max-width:800px !important;
        }
        h1, h2 {
            color: #333;
        }
        ul {
            list-style-type: none;
            padding-left: 0;
        }
        ul li::before {
            content: "✅ ";
            color: green;
        }
        .section {
            background: #fff;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 5px;
            box-shadow: 0px 2px 5px rgba(0,0,0,0.1);
        }
        .textRequestRegis{
            color:#e20707;
            font-weight:600;
        }
	</style>
</head>

    <div class="modal fade bs-example-modal-lg" id="privacy_policy_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">
                    นโยบายความเป็นส่วนตัว | บริษัท จี.ที. ทรานสปอร์ต จำกัด
                    </h4>
                </div>
                <div class="modal-body">
                <h4>นโยบายความเป็นส่วนตัว (Privacy Policy)</h4>
                <p><strong>บริษัท จี.ที. ทรานสปอร์ต จำกัด</strong> ("บริษัท" หรือ "เรา") ให้ความสำคัญกับการคุ้มครองข้อมูลส่วนบุคคลของผู้สมัครรถร่วมบริการ บริษัทมุ่งมั่นปฏิบัติตาม <strong>พระราชบัญญัติคุ้มครองข้อมูลส่วนบุคคล พ.ศ. 2562 (PDPA)</strong> เพื่อให้มั่นใจว่าข้อมูลของท่านได้รับการเก็บรักษาและใช้อย่างปลอดภัย</p>

                <div class="section">
                    <h4>1. ข้อมูลส่วนบุคคลที่เราเก็บรวบรวม</h4>
                    <p>ในการสมัครรถร่วมบริการ บริษัทจะเก็บรวบรวมและประมวลผลข้อมูลส่วนบุคคลของท่าน ได้แก่:</p>
                    <ul>
                        <li><strong>ข้อมูลประจำตัว:</strong> ชื่อ-นามสกุล, หมายเลขบัตรประชาชน และสำเนาบัตรประชาชน, สำเนาทะเบียนบ้าน</li>
                        <li><strong>ข้อมูลเกี่ยวกับการขับขี่:</strong> สำเนาใบขับขี่, ข้อมูลเกี่ยวกับประวัติการขับขี่</li>
                        <li><strong>ข้อมูลเกี่ยวกับยานพาหนะ:</strong> เลขทะเบียนรถ, สำเนากรมธรรม์ประกันภัยรถยนต์</li>
                        <li><strong>ข้อมูลติดต่อ:</strong> ที่อยู่, เบอร์โทรศัพท์, อีเมล</li>
                    </ul>
                </div>

                <div class="section">
                    <h4>2. วัตถุประสงค์ในการเก็บรวบรวมข้อมูล</h4>
                    <p>เราจะใช้ข้อมูลส่วนบุคคลของท่านเพื่อวัตถุประสงค์ดังต่อไปนี้เท่านั้น:</p>
                    <ul>
                        <li>📌 การสมัครและพิจารณาคุณสมบัติรถร่วมบริการ</li>
                        <li>📌 การตรวจสอบและยืนยันตัวตนของผู้สมัคร</li>
                        <li>📌 การประเมินคุณสมบัติและตรวจสอบประวัติการขับขี่</li>
                        <li>📌 การทำสัญญาและบริหารจัดการการให้บริการรถร่วม</li>
                        <li>📌 การปฏิบัติตามกฎหมายที่เกี่ยวข้อง</li>
                    </ul>
                </div>

                <div class="section">
                    <h4>3. ระยะเวลาการเก็บรักษาข้อมูล</h4>
                    <p>บริษัทจะเก็บรักษาข้อมูลส่วนบุคคลของท่าน ตลอดระยะเวลาที่ท่านเป็นรถร่วมบริการของบริษัท และจะลบหรือทำลายข้อมูลภายใน <strong>1 ปี</strong> หลังจากที่ท่านยกเลิกการเป็นรถร่วม เว้นแต่มีข้อกำหนดทางกฎหมายให้ต้องเก็บรักษาไว้</p>
                </div>

                <div class="section">
                    <h4>4. การแบ่งปันข้อมูลส่วนบุคคล</h4>
                    <p>บริษัท จะไม่ขายหรือเปิดเผยข้อมูลของท่านแก่บุคคลภายนอก เว้นแต่ในกรณีต่อไปนี้:</p>
                    <ul>
                        <li>✔ หน่วยงานราชการ หรือหน่วยงานที่มีอำนาจตามกฎหมาย</li>
                        <li>✔ บริษัทประกันภัย ในกรณีที่ต้องดำเนินการเกี่ยวกับกรมธรรม์</li>
                        <li>✔ พันธมิตรทางธุรกิจที่เกี่ยวข้องกับบริการของบริษัท (โดยจะได้รับความยินยอมจากท่านก่อน)</li>
                    </ul>
                </div>

                <div class="section">
                    <h4>5. สิทธิของเจ้าของข้อมูล</h4>
                    <p>ท่านมีสิทธิ์เกี่ยวกับข้อมูลส่วนบุคคลของท่านตาม PDPA ได้แก่:</p>
                    <ul>
                        <li>🔹 สิทธิขอเข้าถึงและรับสำเนาข้อมูลส่วนบุคคล</li>
                        <li>🔹 สิทธิขอแก้ไขข้อมูลให้ถูกต้อง</li>
                        <li>🔹 สิทธิขอให้ลบหรือระงับการใช้ข้อมูล</li>
                        <li>🔹 สิทธิขอถอนความยินยอมเมื่อใดก็ได้</li>
                    </ul>
                    <p>ท่านสามารถติดต่อเราเพื่อใช้สิทธิ์ของท่านได้ที่ <strong>[ข้อมูลติดต่อด้านล่าง]</strong></p>
                </div>

                <div class="section">
                    <h4>6. การรักษาความปลอดภัยของข้อมูล</h4>
                    <p>บริษัทใช้มาตรการทางเทคนิคและการบริหารจัดการเพื่อรักษาความปลอดภัยของข้อมูลของท่าน เช่น:</p>
                    <ul>
                        <li>✅ การเข้ารหัสไฟล์ข้อมูล</li>
                        <li>✅ การจำกัดสิทธิ์การเข้าถึงข้อมูล</li>
                        <li>✅ การใช้ระบบตรวจสอบความปลอดภัยของข้อมูล</li>
                    </ul>
                </div>

                <div class="section">
                    <h4>7. การติดต่อบริษัท</h4>
                    <p>หากท่านมีข้อสงสัยเกี่ยวกับนโยบายความเป็นส่วนตัวนี้ หรือประสงค์ใช้สิทธิ์เกี่ยวกับข้อมูลของท่าน สามารถติดต่อเราได้ที่:</p>
                    <p>📍 <strong>บริษัท จี.ที. ทรานสปอร์ต จำกัด</strong></p>
                    <p>📞 โทร: <strong>[ 0948836222 ]</strong></p>
                    <!-- <p>📧 อีเมล: <strong>[อีเมลติดต่อ]</strong></p>
                    <p>📌 ที่อยู่: <strong>[ที่อยู่บริษัท]</strong></p> -->
                </div>

                <!-- <p><strong>ประกาศใช้วันที่:</strong> [วันที่]</p>
                <p><strong>แก้ไขล่าสุด:</strong> [วันที่แก้ไขล่าสุด]</p> -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                        ไม่ยินยอม
                    </button>
                    <button type="button" class="btn btn-success" id="btn-save-driverregister-accept">
                        ยินยอม
                    </button>
                </div>
            </div>
        </div>
    </div>

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
								<h2 class="text-center mb-2">สมัครรถร่วมบริการ</h2>
								<?php echo $this->session->flashdata('msg');?>
							</div>
                            <hr>
                            <div class="row form-group">
                                <div class="col-md-6 form-group">
                                    <label for=""><b>ชื่อ (ภาษาไทย): <span class="textRequestRegis">*</span></b></label>
                                    <input type="text" name="reg-fnameTH" id="reg-fnameTH" class="form-control">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for=""><b>นามสกุล (ภาษาไทย): <span class="textRequestRegis">*</span></b></label>
                                    <input type="text" name="reg-lnameTH" id="reg-lnameTH" class="form-control">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for=""><b>ชื่อ (ภาษาอังกฤษ): <span class="textRequestRegis">*</span></b></label>
                                    <input type="text" name="reg-fnameEN" id="reg-fnameEN" class="form-control">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for=""><b>นามสกุล (ภาษาอังกฤษ): <span class="textRequestRegis">*</span></b></label>
                                    <input type="text" name="reg-lnameEN" id="reg-lnameEN" class="form-control">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for=""><b>เบอร์โทร : <span class="textRequestRegis">*</span></b></label>
                                    <input type="text" name="reg-tel" id="reg-tel" class="form-control">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for=""><b>LINE ID : </b></label>
                                    <input type="text" name="reg-linenid" id="reg-lineid" class="form-control">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for=""><b>ทะเบียนรถ : <span class="textRequestRegis">*</span></b></label>
                                    <input type="text" name="reg-numberplate" id="reg-numberplate" class="form-control">
                                </div>
                            </div>
                            <hr>
                            <div class="row form-group">
                                <div class="col-md-12 form-group">
                                    <label for=""><b>แนบเอกสารสำเนาบัตรประชาชน <span class="textRequestRegis">*</span></b></label>
                                    <div id="dv_mem_doc1" class="dropzone"></div>
                                    <div id="show_mem_doc1"></div>
                                </div>
                            </div>
                            <hr>
                            <div class="row form-group">
                                <div class="col-md-12 form-group">
                                    <label for=""><b>แนบเอกสารสำเนาทะเบียนบ้าน <span class="textRequestRegis">*</span></b></label>
                                    <div id="dv_mem_doc2" class="dropzone"></div>
                                    <div id="show_mem_doc1"></div>
                                </div>
                            </div>
                            <hr>
                            <div class="row form-group">
                                <div class="col-md-12 form-group">
                                    <label for=""><b>แนบเอกสารสำเนาใบขับขี่ <span class="textRequestRegis">*</span></b></label>
                                    <div id="dv_mem_doc3" class="dropzone"></div>
                                    <div id="show_mem_doc1"></div>
                                </div>
                            </div>
                            <hr>
                            <div class="row form-group">
                                <div class="col-md-12 form-group">
                                    <label for=""><b>แนบเอกสารสำเนากรมธรรม์ประกันภัย <span class="textRequestRegis">*</span></b></label>
                                    <div id="dv_mem_doc4" class="dropzone"></div>
                                    <div id="show_mem_doc1"></div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-12 form-group">
                                    <label for=""><b>ตั้งรหัสผ่าน<span class="textRequestRegis">*</span></b></label>
                                    <input type="password" name="reg-password" id="reg-password" class="form-control">
                                </div>
                            </div>
                            <hr>
                            <div class="row form-group">
                                <div class="col-md-4"></div>
                                <div class="col-md-4">
                                    <button type="button" id="btn-save-driverregister" class="btn btn-success btn-block">ส่งข้อมูล</button>
                                </div>
                                <div class="col-md-4"></div>
                            </div>
						</div>
					</div>

				</div>
			</div>
		</div>
		<!-- js -->

	</div>

    <script>
        const url = "<?php echo base_url()?>";
        let fnameTH , lnameTH , fnameEN , lnameEN , tel , lineid , numberplate , username , regisNo , password;

        Dropzone.autoDiscover = false;
        let dv_mem_doc1 = new Dropzone("#dv_mem_doc1", {
            url: url+'driverslogin/uploadFile_mem_doc1',
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
            autoProcessQueue: false, // ปิดการอัปโหลดอัตโนมัติ
            // resizeMethod: 'contain', // วิธีการย่อขนาด สามารถใช้ contain, crop, หรือ none
            init: function () {
                this.on("sending", function (file, xhr, formData) {
                    // ส่งพารามิเตอร์เพิ่มเติมไปด้วย
                    formData.append("file_registerno" , regisNo);
                    formData.append("file_driverusername" , username);
                    formData.append("file_type" , "doc1");
                });
                this.on("addedfile", function(file) {
                    // document.getElementById("btn-save-driverregister").disabled = false;
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
                        // document.getElementById("btn-dv-saveStart").disabled = true;
                    }
                    if(file.serverFileName){
                        //ส่งคำขอลบไฟล์ไปยังเซอร์เวอร์
                        console.log("ลบไฟล์:", file.serverFileName); // log ชื่อไฟล์ก่อนส่งคำขอลบ
                        fetch(url+"driverslogin/removeFile_mem_doc1" , {
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

        let dv_mem_doc2 = new Dropzone("#dv_mem_doc2", {
            url: url+'driverslogin/uploadFile_mem_doc2',
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
            autoProcessQueue: false, // ปิดการอัปโหลดอัตโนมัติ
            // resizeMethod: 'contain', // วิธีการย่อขนาด สามารถใช้ contain, crop, หรือ none
            init: function () {
                this.on("sending", function (file, xhr, formData) {
                    // ส่งพารามิเตอร์เพิ่มเติมไปด้วย
                    formData.append("file_registerno" , regisNo);
                    formData.append("file_driverusername" , username);
                    formData.append("file_type" , "doc2");
                });
                this.on("addedfile", function(file) {
                    // document.getElementById("btn-dv-saveStop").disabled = false;
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
                        // document.getElementById("btn-dv-saveStop").disabled = true;
                    }
                    if(file.serverFileName){
                        //ส่งคำขอลบไฟล์ไปยังเซอร์เวอร์
                        console.log("ลบไฟล์:", file.serverFileName); // log ชื่อไฟล์ก่อนส่งคำขอลบ
                        fetch(url+"driverslogin/removeFile_mem_doc2" , {
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

        let dv_mem_doc3 = new Dropzone("#dv_mem_doc3", {
            url: url+'driverslogin/uploadFile_mem_doc3',
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
            autoProcessQueue: false, // ปิดการอัปโหลดอัตโนมัติ
            // resizeMethod: 'contain', // วิธีการย่อขนาด สามารถใช้ contain, crop, หรือ none
            init: function () {
                this.on("sending", function (file, xhr, formData) {
                    // ส่งพารามิเตอร์เพิ่มเติมไปด้วย
                    formData.append("file_registerno" , regisNo);
                    formData.append("file_driverusername" , username);
                    formData.append("file_type" , "doc3");
                });
                this.on("addedfile", function(file) {
                    // document.getElementById("btn-dv-saveStop").disabled = false;
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
                        // document.getElementById("btn-dv-saveStop").disabled = true;
                    }
                    if(file.serverFileName){
                        //ส่งคำขอลบไฟล์ไปยังเซอร์เวอร์
                        console.log("ลบไฟล์:", file.serverFileName); // log ชื่อไฟล์ก่อนส่งคำขอลบ
                        fetch(url+"driverslogin/removeFile_mem_doc3" , {
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

        let dv_mem_doc4 = new Dropzone("#dv_mem_doc4", {
            url: url+'driverslogin/uploadFile_mem_doc4',
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
            autoProcessQueue: false, // ปิดการอัปโหลดอัตโนมัติ
            // resizeMethod: 'contain', // วิธีการย่อขนาด สามารถใช้ contain, crop, หรือ none
            init: function () {
                this.on("sending", function (file, xhr, formData) {
                    // ส่งพารามิเตอร์เพิ่มเติมไปด้วย
                    formData.append("file_registerno" , regisNo);
                    formData.append("file_driverusername" , username);
                    formData.append("file_type" , "doc4");
                });
                this.on("addedfile", function(file) {
                    // document.getElementById("btn-dv-saveStop").disabled = false;
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
                        // document.getElementById("btn-dv-saveStop").disabled = true;
                    }
                    if(file.serverFileName){
                        //ส่งคำขอลบไฟล์ไปยังเซอร์เวอร์
                        console.log("ลบไฟล์:", file.serverFileName); // log ชื่อไฟล์ก่อนส่งคำขอลบ
                        fetch(url+"driverslogin/removeFile_mem_doc4" , {
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



	<script src="<?=base_url('assets/')?>vendors/scripts/core.js"></script>
	<script src="<?=base_url('assets/')?>vendors/scripts/script.min.js"></script>
	<script src="<?=base_url('assets/')?>vendors/scripts/process.js"></script>
	<script src="<?=base_url('assets/')?>vendors/scripts/layout-settings.js"></script>

	<!-- add sweet alert js & css in footer -->
	<script src="<?=base_url('assets/')?>src/plugins/sweetalert2/sweetalert2.all.js"></script>
	<script src="<?=base_url('assets/')?>src/plugins/sweetalert2/sweet-alert.init.js"></script>

    <script src="<?=base_url('assets/js/drivers_register.js?v='.filemtime('./assets/js/drivers_register.js'))?>"></script>
</body>


</html>