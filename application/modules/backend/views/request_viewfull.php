<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้าแสดงรายละเอียดของรายการ</title>
</head>
<?php
$personTypes = [];

if ($dataviewfull->m_person_type1 != 0) {
    $personTypes[] = "คนยกของประเภทที่ 1 คนขับรถยกของ " . $dataviewfull->m_person_type1 . " คน";
}

if ($dataviewfull->m_person_type2 != 0) {
    $personTypes[] = "คนยกของประเภทที่ 2 คนขับรถยกของ " . $dataviewfull->m_person_type2 . " คน";
}

if ($dataviewfull->m_person_type3 != 0) {
    $personTypes[] = "คนยกของประเภทที่ 3 เด็กรถยกของ " . $dataviewfull->m_person_type3 . " คน";
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
                        <h5 class="text-center">รายการรอตรวจสอบข้อมูล</h3>
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
                            <div class="col-md-6 form-group">
                                <label for=""><b>เงินมัดจำ (เปอร์เซ็น) จากยอดเต็ม</b></label>
                                <select name="ip-viewfull-depositpercen" id="ip-viewfull-depositpercen" class="form-control">
                                    <option value="15">15%</option>
                                    <option value="16" selected>16%</option>
                                    <option value="17">17%</option>
                                    <option value="18">18%</option>
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for=""><b>จำนวนเงิน (บาท)</b></label>
                                <input type="text" name="ip-viewfull-deposit" id="ip-viewfull-deposit" class="form-control" readonly>
                            </div>
                            <div class="col-md-12 form-group">
                                <label for=""><b>หมายเหตุ</b></label>
                                <textarea name="ip-viewfull-memo" id="ip-viewfull-memo" class="form-control"></textarea>
                            </div>
                            <div class="btnapproveSec col-md-12 form-group d-flex justify-content-center">
                                <div class="custom-control custom-radio mb-5 ml-3">
                                    <input type="radio" id="ip-viewfull-appro-yes" name="ip-viewfull-appro" value="อนุมัติ" class="custom-control-input" required> 
                                    <label for="ip-viewfull-appro-yes" class="custom-control-label">อนุมัติ</label>
                                </div> 
                                <div class="custom-control custom-radio mb-5 ml-3">
                                    <input type="radio" id="ip-viewfull-appro-no" name="ip-viewfull-appro" value="ไม่อนุมัติ" class="custom-control-input" required> 
                                    <label for="ip-viewfull-appro-no" class="custom-control-label">ไม่อนุมัติ</label>
                                </div>
                            </div>
                            <div class="btnapproveSec col-md-12 form-group d-flex justify-content-center">
                                <button class="btn btn-primary" id="btn-approveDoc" name="btn-approveDoc" style="display:none;">ยืนยัน</button>
                            </div>
                        </div>
                        <div id="approSecUser" class="row form-group" style="display:none;">
                            <div class="col-md-6 form-group">
                                <label for=""><b>ผู้อนุมัติ</b></label>
                                <input type="text" name="ip-viewfull-appro-name" id="ip-viewfull-appro-name" class="form-control" readonly>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for=""><b>วันที่อนุมัติ</b></label>
                                <input type="text" name="ip-viewfull-appro-datetime" id="ip-viewfull-appro-datetime" class="form-control" readonly>
                            </div>
                            <hr>
                        </div>
                        <!-- ตรวจสอบการโอนเงิน -->
                         <!-- check confirm payment -->
                        <section id="sec_confirmPay_backend" style="display:none;">
                            <h5 class="text-center">ตรวจสอบการโอนเงิน</h5>
                            <hr>
                            <div class="row form-group">
                                <div class="col-md-12 form-group">
                                    <label for=""><b>จำนวนเงินที่โอน</b></label>
                                    <input type="number" name="ip-viewfull-numberPay" id="ip-viewfull-numberPay" class="form-control">
                                </div>
                            </div>
                            <div id="show_file_confirmPay_backend" class="row form-group"></div>
                            <div class="row form-group">
                                <div class="col-md-12 form-group">
                                    <label for=""><b>หมายเหตุ</b></label>
                                    <textarea name="ip-viewfull-memoPay" id="ip-viewfull-memoPay" class="form-control"></textarea>
                                </div>
                                <div class="btnapproveSec col-md-12 form-group d-flex justify-content-center">
                                    <div class="custom-control custom-radio mb-5 ml-3">
                                        <input type="radio" id="ip-viewfull-approPay-yes" name="ip-viewfull-approPay" value="อนุมัติ" class="custom-control-input" required> 
                                        <label for="ip-viewfull-approPay-yes" class="custom-control-label">อนุมัติ</label>
                                    </div> 
                                    <div class="custom-control custom-radio mb-5 ml-3">
                                        <input type="radio" id="ip-viewfull-approPay-no" name="ip-viewfull-approPay" value="ไม่อนุมัติ" class="custom-control-input" required> 
                                        <label for="ip-viewfull-approPay-no" class="custom-control-label">ไม่อนุมัติ</label>
                                    </div>
                                </div>
                                <div id="sec-approvePay-backend" class="col-md-12 form-group d-flex justify-content-center">
                                    <button class="btn btn-primary" id="btn-approvePay-backend" name="btn-approvePay-backend" style="display:none;">ยืนยัน</button>
                                </div>
                            </div>
                            
                        <div id="approSecUser2" class="row form-group" style="display:none;">
                            <div class="col-md-6 form-group">
                                <label for=""><b>ผู้อนุมัติ</b></label>
                                <input type="text" name="ip-viewfull-appro2-name" id="ip-viewfull-appro2-name" class="form-control" readonly>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for=""><b>วันที่อนุมัติ</b></label>
                                <input type="text" name="ip-viewfull-appro2-datetime" id="ip-viewfull-appro2-datetime" class="form-control" readonly>
                            </div>
                        </div>
                        <hr>
                        </section>

                        <section id="sec_dv-getjob-admin" style="display:none;">
                            <h5 class="text-center">คนขับ รับงานแล้วกำลังเดินทางไปหาลูกค้า</h5>
                            <hr>
                            <div class="row form-group text-center">
                                <div class="col-md-6">
                                    <label for="" id="getjob-datashow-admin-drivername"></label>
                                </div>
                                <div class="col-md-6">
                                    <label for="" id="getjob-datashow-admin-datetime"></label>
                                </div>
                            </div>
                            <hr>
                        </section>


                        <!-- Driver Section view -->
                        <section id="sec_dv-checkInAlready-admin" style="display:none;">
                            <h5 class="text-center">คนขับ เช็กอินหน้างาน (ต้นทาง)</h5>
                            <hr>
                            <div class="row form-group text-center">
                                <div class="col-md-6">
                                    <label for="" id="checkin-datashow-admin-drivername"></label>
                                </div>
                                <div class="col-md-6">
                                    <label for="" id="checkin-datashow-admin-datetime"></label>
                                </div>
                            </div>
                            <hr>
                        </section>

                        <section id="sec-dv-start-admin" style="display:none;">
                            <h5 class="text-center">รายละเอียดการเริ่มงาน</h5>
                            <hr>
                            <div class="row form-group">
                                <div class="col-md-12 form-group">
                                    <label for=""><b>ภาพประกอบ</b></label>
                                    <div id="show_imgStart-admin"></div>
                                </div>

                                <!-- Modal สำหรับแสดงภาพขนาดใหญ่ -->
                                <div id="image-modal" class="modal">
                                    <span class="modal-close">&times;</span>
                                    <img class="modal-content" id="modal-img">
                                </div>


                                <div class="col-md-12 form-group">
                                    <label for=""><b>หมายเหตุ</b></label>
                                    <textarea style="height:80px;" class="form-control" name="dv-ip-memostart-admin" id="dv-ip-memostart-admin"></textarea>
                                </div>
                            </div>
                            <div class="row form-group text-center" id="secDataStart-admin">
                                <div class="col-md-6 form-group">
                                    <label for="" id="start-datashow-admin-drivername"></label>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="" id="start-datashow-admin-datetime"></label>
                                </div>
                            </div>
                            <hr>
                        </section>

                        <section id="sec_dv-checkInAlreadyDes-admin" style="display:none;">
                            <h5 class="text-center">คนขับ เช็กอินหน้างาน (ปลายทาง)</h5>
                            <hr>
                            <div class="row form-group text-center">
                                <div class="col-md-6">
                                    <label for="" id="checkinDes-datashow-admin-drivername"></label>
                                </div>
                                <div class="col-md-6">
                                    <label for="" id="checkinDes-datashow-admin-datetime"></label>
                                </div>
                            </div>
                            <hr>
                        </section>

                        <section id="sec-dv-stop-admin" style="display:none;">
                            <h5 class="text-center">รายละเอียดการปิดงาน</h5>
                            <hr>
                            <div class="row form-group">
                                <div class="col-md-12 form-group">
                                    <label for=""><b>ภาพประกอบ</b></label>
                                    <div id="show_imgStop-admin"></div>
                                </div>

                                <!-- Modal สำหรับแสดงภาพขนาดใหญ่ -->
                                <div id="image-modal-stop" class="modal">
                                    <span class="modal-close">&times;</span>
                                    <img class="modal-content" id="modal-img-stop">
                                </div>


                                <div class="col-md-12 form-group">
                                    <label for=""><b>หมายเหตุ</b></label>
                                    <textarea style="height:80px;" class="form-control" name="dv-ip-memostop-admin" id="dv-ip-memostop-admin"></textarea>
                                </div>
                            </div>
                            <div class="row form-group text-center">
                                <div class="col-md-6 form-group">
                                    <label for="" id="stop-datashow-admin-drivername"></label>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="" id="stop-datashow-admin-datetime"></label>
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
<script src="<?=base_url('assets/js/request_viewfull.js?v='.filemtime('./assets/js/request_viewfull.js'))?>"></script>
<script>
    let formno = "<?php echo $dataviewfull->m_formno ?>";
    let formstatus = "<?php echo $dataviewfull->m_status ?>";
    let totalprice = "<?php echo $dataviewfull->m_totalprice?>";
    let userId = "<?php echo $dataviewfull->m_cusid?>";
    let origin = "<?php echo $dataviewfull->m_origininput?>";
    let destination = "<?php echo $dataviewfull->m_destinationinput?>";
    let driverMarker;
    let currentLocation;
    let map;
    const getapikey = "<?php echo get_googlemap_apikey(); ?>";
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