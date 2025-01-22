<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้าแสดงรายละเอียดของรายการ</title>
</head>
<body>
    <div class="main-container">
        <div class="pd-ltr-20">
            <div class="row">
                <div class="col-md-12">
                    <div class="card-box height-100-p pd-20">
                        <h5 class="text-center">รายการรอตรวจสอบข้อมูล</h3>
                        <hr>
                        <div class="row form-group">
                            <div class="col-md-4 form-group">
                                <p><b>เอกสารเลขที่ : </b><?=$dataviewfull->m_formno?></p>
                                <p><b>ชื่อลูกค้า : </b><?=$dataviewfull->mem_fname." ".$dataviewfull->mem_lname?></p>
                                <p><b>หมายเลขโทรศัพท์ : </b><?=$dataviewfull->mem_tel?></p>
                                <p><b>Status : </b><?=$dataviewfull->m_status?></p>
                            </div>
                            <div class="col-md-8 form-group">
                                <p><b>ประเภทรถที่เลือก : </b><?=$dataviewfull->m_cartype?></p>
                                <p><b>ต้นทาง : </b><?=$dataviewfull->m_origininput?></p>
                                <p><b>ปลายทาง : </b><?=$dataviewfull->m_destinationinput?></p>
                                <p><b>ระยะทางทั้งสิ้น : </b><?=$dataviewfull->m_distance?> กิโลเมตร</p>
                                <p><b>รวมเป็นเงินทั้งสิ้น : </b><?=number_format($dataviewfull->m_totalprice , 2)?> บาท</p>
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
                        <hr>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <div id="map"></div>
                            </div>
                        </div>
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
    let totalprice = "<?php echo number_format($dataviewfull->m_totalprice , 2) ?>";
    const getapikey = "<?php echo get_googlemap_apikey(); ?>";
      // ฟังก์ชันเริ่มต้น
      function initMap() {
        // สร้างแผนที่
        const map = new google.maps.Map(document.getElementById("map"), {
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