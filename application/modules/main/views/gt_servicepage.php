<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เรียกใช้บริการ รถรับจ้างทั่วไป</title>

    <style>
      .customRadio {
          display: none;
      }

      .customRadio:checked + label {
          border: 2px solid #007BFF;
          border-radius: 10px;
          background-color: #f0f8ff;
      }
      label img {
          display: block;
          width: 100%;
          cursor: pointer;
      }
      label {
          cursor: pointer;
          padding: 10px;
          display: block;
      }
      .scrollable-div {
        width: 100%;
        height: 200px;
        overflow-y: auto;
        border: 1px solid #ccc;
        padding: 10px;
        border-radius: 5px;
        background-color: #f9f9f9; /* (ใส่พื้นหลังอ่อนๆ ให้อ่านง่ายขึ้น) */
      }
    </style>
    <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD3A9Mc08SyCJjtWFLFijSITvvx0UmdmFU&libraries=places"></script> -->
</head>
<body>
    <div class="main-container">
      <div class="pd-ltr-20">
        <div class="card-box pd-20 height-100-p mb-30">
            <div class="row form-group">
                <div class="col-md-12 form-group">
                    <h5>เลือกประเภทรถ</h5>
                </div>
            </div>
            <hr>
            <div class="grid-container">
                <div class="grid-item">
                    <input type="radio" class="customRadio" id="input-choosecar-type1" name="input-choosecar" value="type1">
                    <label for="input-choosecar-type1">
                        <img src="<?php echo base_url('uploads/image_system/truck3-type.webp') ?>" alt="input-choosecar-type1">
                        รถกระบะคอก
                    </label>
                </div>
                <div class="grid-item">
                    <input type="radio" class="customRadio" id="input-choosecar-type2" name="input-choosecar" value="type2">
                    <label for="input-choosecar-type2">
                        <img src="<?php echo base_url('uploads/image_system/truck2-type.webp') ?>" alt="input-choosecar-type2">
                        รถกระบะตู้ทึบ
                    </label>
                </div>
                <div class="grid-item">
                    <input type="radio" class="customRadio" id="input-choosecar-type3" name="input-choosecar" value="type3">
                    <label for="input-choosecar-type3">
                        <img src="<?php echo base_url('uploads/image_system/truck1-type.webp') ?>" alt="input-choosecar-type3">
                        รถกระบะเปลือย
                    </label>
                </div>
            </div>
        </div>

        <div id="choosePerson" class="card-box pd-20 height-100-p mb-30" style="display:none;">
            <div class="row form-group">
                <div class="col-md-12 form-group">
                    <h5>เลือกพนักงานยกของ</h5>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-12 form-group">
                    <span><b>เลือกคนยกของประเภทที่ 1 คนขับรถยกของ (จากท้ายรถไม่เกิน 10 เมตร , ไม่ขึ้นชั้น , น้ำหนักต่อชิ้นไม่เกิน 25 กิโลกรัม)</b></span>
                    <select name="input-person-type1" id="input-person-type1" class="form-control">
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>
                <div class="col-md-12 form-group">
                    <label for=""><b>เลือกคนยกของประเภทที่ 2 คนขับรถยกของ (ขึ้นชั้นได้แต่ไม่เกินชั้น 3 ยกขึ้นชั้นได้ 5 รอบต่อขา น้ำหนักไม่เกิน 25 กิโลกรัม)</b></label>
                    <select name="input-person-type2" id="input-person-type2" class="form-control">
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>
                <div class="col-md-12 form-group">
                    <label for=""><b>เลือกคนยกของประเภทที่ 3 เด็กรถยกของ (ขึ้นชั้นได้แต่ไม่เกินชั้น 3 ยกขึ้นชั้นได้ 5 รอบต่อขา น้ำหนักไม่เกิน 25 กิโลกรัม)</b></label>
                    <select name="input-person-type3" id="input-person-type3" class="form-control">
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>

            </div>
        </div>

        <div class="card-box pd-20 height-100-p mb-30">
            <div class="row form-group">
                <div class="col-md-12">
                    <h5>เลือกจุดหมายปลายทาง</h5>
                </div>
            </div>

            <div class="row">
              <div class="col-md-12 form-group">
                  <span for="originInput"><b>สถานที่ต้นทาง : </b></span>
                  <input class="form-control form-group" type="text" id="originInput" placeholder="ป้อนสถานที่ต้นทาง">
              </div>
              <div class="col-md-12 form-group">
                  <span for="destinationInput"><b>สถานที่ปลายทาง : </b></span>
                  <input class="form-control form-group" type="text" id="destinationInput" placeholder="ป้อนสถานที่ปลายทาง">
              </div>
            </div>


              <div class="row form-group">
                <div class="col-md-6 form-group">
                  <button class="btn btn-primary btn-block" onclick="calculateRoute()"><i class="dw dw-car mr-2"></i>คำนวณเส้นทาง</button>
                </div>
                <div class="col-md-6 form-group">
                  <button class="btn btn-warning btn-block" onclick="resetMap()"><i class="dw dw-refresh2 mr-2"></i>Reset</button>
                </div>
              </div>
                <p id="distance"></p>
                <div id="map"></div>

        </div>

        <div class="card-box pd-20 height-100-p mb-30">
            <div class="row form-group">
                <div class="col-md-12 form-group">
                    <h5>สรุปรายการ</h5>
                </div>
            </div>
            <!-- <div class="row form-group">
                <div class="col-md-6 form-group">
                    <button type="button" id="btn-calculate" class="btn btn-primary btn-block"><i class="dw dw-pin mr-2"></i>คำนวณค่าบริการ</button>
                </div>
                <div class="col-md-6 form-group">
                  <button type="button" id="btn-reset" class="btn btn-warning btn-block"><i class="dw dw-refresh2 mr-2"></i>ล้างค่า</button>
                </div>
            </div> -->
            <div class="row form-group">
                <div class="col-md-6 form-group">
                    <span for=""><b>ประเภทรถ</b></span>
                    <!-- <span id="input-sum-cartype"><b>-</b></span> -->
                    <input class="form-control" type="text" name="input-sum-cartype" id="input-sum-cartype" readonly>
                </div>
                <div class="col-md-6 form-group">
                    <span for=""><b>ระยะทาง</b></span>
                    <!-- <span id="input-sum-distance"><b>-</b></span> -->
                    <input type="text" name="input-sum-distance" id="input-sum-distance" class="form-control" readonly>
                </div>
                <div class="col-md-12 form-group input-group">
                    <span for=""><b>คิดเป็นเงิน</b></span>
                    <!-- <span id="input-sum-sumpriceBeforeVat"><b>-</b></span> -->
                    <div class="input-group">
                      <input type="text" name="input-sum-sumpriceCarDistance" id="input-sum-sumpriceCarDistance" class="form-control" readonly>
                      <div class="input-group-append">
                        <span class="input-group-text">บาท</span>
                      </div>
                    </div>
                </div>
                <div class="col-md-12 form-group">
                    <span for=""><b>คนยกของ</b></span>
                    <span id="input-sum-person"><b>-</b></span>
                </div>
                <div class="col-md-12 form-group">
                  <span for=""><b>คิดเป็นเงิน</b></span>
                  <div class="input-group">
                    <input type="text" name="input-sum-personPrice" id="input-sum-personPrice" class="form-control" readonly>
                    <div class="input-group-append">
                      <span class="input-group-text">บาท</span>
                    </div>
                  </div>
                </div>
                <div class="col-md-12 form-group input-group">
                    <span for=""><b>ยอดค่าบริการทั้งสิ้น</b></span>
                    <!-- <span id="input-sum-sumpriceBeforeVat"><b>-</b></span> -->
                    <div class="input-group">
                      <input type="text" name="input-sum-sumpriceBeforeVat" id="input-sum-sumpriceBeforeVat" class="form-control" readonly>
                      <div class="input-group-append">
                        <span class="input-group-text">บาท</span>
                      </div>
                    </div>
                </div>
                <!-- <div class="col-md-6 form-group">
                    <label for=""><b>ราคารวม Vat 3%</b></label>

                    <div class="input-group">
                      <input type="text" name="input-sum-sumprice" id="input-sum-sumprice" class="form-control" readonly>
                      <div class="input-group-append">
                        <span class="input-group-text">บาท</span>
                      </div>
                    </div>
                </div> -->
                <div class="col-md-12">
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" id="input-accept" name="input-accept" value="accept">ยอมรับ เงื่อนไขการให้บริการ
                    </label>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="scrollable-div">
                    <p>
                    1.บริษัท GT Transport เป็นแพลตฟอร์มสำหรับเชื่อมต่อระหว่างผู้ใช้บริการและผู้ให้บริการรถร่วมอิสระ โดยงานบริการทั้งหมดจะดำเนินการและอยู่ภายใต้ความรับผิดชอบของผู้ให้บริการรถร่วมอิสระโดยตรง
                    </p>

                    <p>
                    2.บริษัท GT Transport ไม่มีหน้าที่รับผิดหรือร่วมรับผิดในความเสียหายใดๆ ที่เกิดจากการดำเนินการของผู้ให้บริการรถร่วมอิสระ ทั้งนี้ ผู้ให้บริการรถร่วมอิสระจะเป็นผู้รับผิดชอบต่อความเสียหายที่เกิดขึ้นทั้งหมด โดยวงเงินความรับผิดชอบสูงสุดไม่เกินค่าจ้างที่ผู้ใช้บริการชำระให้แก่ผู้ให้บริการรถร่วมอิสระ
                    </p>

                    <p>
                    3.ผู้ใช้บริการต้องดำเนินการบรรจุหีบห่อหรือซีลสินค้าใดๆ ที่มีความเสี่ยงต่อการแตกหัก ชำรุด หรือสูญหายด้วยตนเอง ทั้งนี้ บริษัท GT Transport ไม่มีหน้าที่รับผิดชอบต่อความเสียหายที่เกิดจากการดำเนินการของผู้ให้บริการรถร่วมอิสระไม่ว่ากรณีใดๆ
                    </p>

                    <p>
                    4.ผู้ใช้บริการแพลตฟอร์มต้องไม่นำสิ่งของผิดกฎหมายส่งผ่านการให้บริการ ทั้งนี้ ผู้ให้บริการรถร่วมอิสระมีสิทธิยกเลิกการให้บริการได้ตามความเหมาะสม โดยบริษัท GT Transport และผู้ให้บริการรถร่วมอิสระจะไม่รับผิดชอบและไม่ต้องร่วมรับผิดในความผิดทางกฎหมายใดๆ ที่เกิดจากการดำเนินการดังกล่าว
                    </p>

                  </div>
                </div>
            </div>

            <div class="row form-group">
                <div class="col-md-4 form-group"></div>
                <div class="col-md-4 form-group">
                    <button type="button" id="btn-saverequest" class="btn btn-success btn-block">เรียกใช้บริการ</button>
                </div>
                <div class="col-md-4 form-group"></div>
            </div>
        </div>
      </div>
	</div>
</body>
<script src="<?php echo base_url('assets/js/gt_servicepage.js?v=' . filemtime('./assets/js/gt_servicepage.js')) ?>"></script>
<script>
    const getapikey = "<?php echo get_googlemap_apikey(); ?>";
    let map;
    let directionsService;
    let directionsRenderer;
    let originMarker;
    let destinationMarker;
    let distance = 0;
    let distanceRate = 0;

    //forSelectCar
    let carTypeValue , carTypes;

    let priceCarDistance = 0; // ราคาค่ารถ (จากระยะทาง)
    let pricePersonSum = 0;   // ราคาคนยกของรวม
    let totalSum = 0;

    let distanceX = 0;
    let fuelConsumption = 1; // ป้องกันหาร 0
    let fuelPriceRate = 0;
    let ratioX = 1;
    let moneyPlus = 0;
    let distanceKm = 0;

    // กำหนดตัวแปรทั้งหมด
    let htmlsumPerson = {
        type1: '',
        type2: '',
        type3: ''
    };

    let personPrice = {
        type1: 0,
        type2: 0,
        type3: 0
    };

    const pricePerPerson = {
        type1: 203,
        type2: 309,
        type3: 309
    };

    //อัพเดตให้สามารถดึงตำแหน่งที่ตั้งปัจจุบันได้
    function initMap() {
      let initialLocation = { lat: 13.7563, lng: 100.5018 };

      // สร้างแผนที่โดยใช้ตำแหน่งเริ่มต้น
      map = new google.maps.Map(document.getElementById('map'), {
        center: initialLocation,
        zoom: 10
      });

      directionsService = new google.maps.DirectionsService();
      directionsRenderer = new google.maps.DirectionsRenderer();
      directionsRenderer.setMap(map);

      // ดึงตำแหน่งที่ตั้งปัจจุบันของผู้ใช้
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
          let currentLocation = {
            lat: position.coords.latitude,
            lng: position.coords.longitude
          };

          // กำหนดค่าให้กับ input ของ origin
          document.getElementById('originInput').value = currentLocation.lat + ', ' + currentLocation.lng;

          // สร้าง marker สำหรับจุดต้นทางจากตำแหน่งปัจจุบัน
          if (originMarker) {
            originMarker.setMap(null);
          }
          originMarker = new google.maps.Marker({
            position: currentLocation,
            map: map,
            title: 'จุดต้นทาง (ตำแหน่งปัจจุบัน)',
            icon: 'http://maps.google.com/mapfiles/ms/icons/green-dot.png',
            draggable: true
          });

          // ปรับการแสดงผลของแผนที่ให้อยู่ที่ตำแหน่งปัจจุบัน
          map.setCenter(currentLocation);

          // อัปเดตค่าใน input เมื่อผู้ใช้ลาก marker
          originMarker.addListener('dragend', function() {
            document.getElementById('originInput').value = originMarker.getPosition().lat() + ', ' + originMarker.getPosition().lng();
          });
        }, function() {
          console.error('ไม่สามารถดึงตำแหน่งปัจจุบันได้');
          return;
        });
      } else {
        console.error("เบราว์เซอร์นี้ไม่รองรับ Geolocation");
        return;
      }

      // ฟังก์ชันสำหรับการคลิกบนแผนที่ (ใช้สำหรับกำหนด destination ถ้ายังไม่ได้ตั้ง)
      map.addListener('click', function(event) {
        let clickedLocation = event.latLng;
        if (!document.getElementById('originInput').value) {
          document.getElementById('originInput').value = clickedLocation.lat() + ', ' + clickedLocation.lng();
          if (originMarker) {
            originMarker.setMap(null);
          }
          originMarker = new google.maps.Marker({
            position: clickedLocation,
            map: map,
            title: 'จุดต้นทาง',
            icon: 'http://maps.google.com/mapfiles/ms/icons/green-dot.png',
            draggable: true
          });
          originMarker.addListener('dragend', function() {
            document.getElementById('originInput').value = originMarker.getPosition().lat() + ', ' + originMarker.getPosition().lng();
          });
        } else if (!document.getElementById('destinationInput').value) {
          document.getElementById('destinationInput').value = clickedLocation.lat() + ', ' + clickedLocation.lng();
          if (destinationMarker) {
            destinationMarker.setMap(null);
          }
          destinationMarker = new google.maps.Marker({
            position: clickedLocation,
            map: map,
            title: 'จุดปลายทาง',
            icon: 'http://maps.google.com/mapfiles/ms/icons/red-dot.png',
            draggable: true
          });
          destinationMarker.addListener('dragend', function() {
            document.getElementById('destinationInput').value = destinationMarker.getPosition().lat() + ', ' + destinationMarker.getPosition().lng();
          });
        }
      });

      // กำหนด autocomplete สำหรับ input จุดต้นทาง
      let originAutocomplete = new google.maps.places.Autocomplete(document.getElementById('originInput'));
      originAutocomplete.bindTo('bounds', map);
      originAutocomplete.addListener('place_changed', function() {
        let place = originAutocomplete.getPlace();
        if (!place.geometry) {
          window.alert("ไม่พบข้อมูลสถานที่: '" + place.name + "'");
          return;
        }
        if (originMarker) {
          originMarker.setMap(null);
        }
        originMarker = new google.maps.Marker({
          map: map,
          position: place.geometry.location,
          title: 'จุดต้นทาง',
          icon: 'http://maps.google.com/mapfiles/ms/icons/green-dot.png',
          draggable: true
        });
        map.setCenter(place.geometry.location);
        originMarker.addListener('dragend', function() {
          document.getElementById('originInput').value = originMarker.getPosition().lat() + ', ' + originMarker.getPosition().lng();
        });
      });

      // กำหนด autocomplete สำหรับ input จุดปลายทาง
      let destinationAutocomplete = new google.maps.places.Autocomplete(document.getElementById('destinationInput'));
      destinationAutocomplete.bindTo('bounds', map);
      destinationAutocomplete.addListener('place_changed', function() {
        let place = destinationAutocomplete.getPlace();
        if (!place.geometry) {
          window.alert("ไม่พบข้อมูลสถานที่: '" + place.name + "'");
          return;
        }
        if (destinationMarker) {
          destinationMarker.setMap(null);
        }
        destinationMarker = new google.maps.Marker({
          map: map,
          position: place.geometry.location,
          title: 'จุดปลายทาง',
          icon: 'http://maps.google.com/mapfiles/ms/icons/red-dot.png',
          draggable: true
        });
        map.setCenter(place.geometry.location);
        destinationMarker.addListener('dragend', function() {
          document.getElementById('destinationInput').value = destinationMarker.getPosition().lat() + ', ' + destinationMarker.getPosition().lng();
        });
      });
    }
    //อัพเดตให้สามารถดึงตำแหน่งที่ตั้งปัจจุบันได้


    async function calculateRoute() {
      let originInput = document.getElementById('originInput').value;
      let destinationInput = document.getElementById('destinationInput').value;

      let request = {
        origin: originInput,
        destination: destinationInput,
        travelMode: 'DRIVING'
      };

      // ปิดการแสดงหมุดต้นทางและปลายทาง
      directionsRenderer.setOptions({
        suppressMarkers: true
      });

      if ($('#input-sum-cartype').val() == "") {
          swal({
              title: 'กรุณาเลือกประเภทของรถ',
              type: 'warning',
              showConfirmButton: true,
          });
      } else if ($('#originInput').val() == "") {
          swal({
              title: 'กรุณาเลือกต้นทาง',
              type: 'warning',
              showConfirmButton: true,
          });
      }else if ($('#destinationInput').val() == "") {
          swal({
              title: 'กรุณาเลือกปลายทาง',
              type: 'warning',
              showConfirmButton: true,
          });
      } else {
        directionsService.route(request, async function(result, status) {
          if (status === 'OK') {
            directionsRenderer.setDirections(result);
            distance = result.routes[0].legs[0].distance.text;
            document.getElementById('distance').innerText = 'ระยะทาง: ' + distance.toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2});
            document.getElementById('input-sum-distance').value = distance.toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2});
            console.log(carTypeValue+' '+carTypes[carTypeValue]);

            await getPricerate(carTypeValue , distance);

          } else {
            console.error('เกิดข้อผิดพลาดในการคำนวณเส้นทาง: ' + status);
          }
        });
      }
    }

    function resetMap() {
      document.getElementById('originInput').value = '';
      document.getElementById('destinationInput').value = '';
      document.getElementById('distance').innerText = '';

      if (originMarker) {
        originMarker.setMap(null);
        originMarker = null;
      }
      if (destinationMarker) {
        destinationMarker.setMap(null);
        destinationMarker = null;
      }

      directionsRenderer.setDirections({ routes: [] });

      map.setCenter({ lat: 13.7563, lng: 100.5018 });
      map.setZoom(10);
      location.reload();
    }

    async function getPricerate(cartype , distance) {
      try {
          const formdata = new FormData();
          formdata.append('action' , 'getPricerate');
          formdata.append('cartype' , cartype);
          let res = await axios.post(url + 'main/getPricerate', formdata);

          console.log(res);
          if (res.data.status == "success") {
              let result = res.data.result;
              //เข้าสูตรคำนวณ
              // ดึงค่าที่ต้องใช้มาคำนวณ
              distanceX = parseFloat(result.distance_x) || 0;
              fuelConsumption = parseFloat(result.fuel_consumption) || 1; // ป้องกันหาร 0
              fuelPriceRate = parseFloat(result.fuel_pricerate) || 0;
              ratioX = parseFloat(result.ratio_x) || 1;
              moneyPlus = parseFloat(result.money_plus) || 0;
              distanceKm = parseFloat(distance) || 0;

              // สูตรการคำนวณแบบแยกขั้นตอน
              let fuelUsed = (distanceKm * distanceX) / fuelConsumption; // ปริมาณน้ำมันที่ใช้
              let fuelCost = fuelUsed * fuelPriceRate; // ค่าน้ำมัน
              priceCarDistance = (fuelCost * ratioX) + moneyPlus; // ราคาสุดท้าย

              console.log('ราคาค่าบริการทั้งหมด: ', priceCarDistance);
              $('#input-sum-sumpriceCarDistance').val(priceCarDistance.toLocaleString('en-US', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                }));
              await updatePersonSummary();
              calculateTotalSum();
          } else {
              console.warn('ไม่พบ pricerate:', res.data.msg);
              console.log(cartype+''+distance);
          }
      } catch (error) {
          console.error('เกิดข้อผิดพลาดในการดึง pricerate:', error);
      }
    }

    async function updatePersonSummary() {
        const summary = htmlsumPerson.type1 + htmlsumPerson.type2 + htmlsumPerson.type3;
        if (summary) {
            $('#input-sum-person').html(summary);
            // รวมราคาของทุกประเภท
            pricePersonSum = (personPrice.type1 || 0) + (personPrice.type2 || 0) + (personPrice.type3 || 0);
            const formattedPrice = pricePersonSum.toLocaleString('en-US', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });

            $('#input-sum-personPrice').val(formattedPrice); // ใส่เป็นเลขทศนิยม 2 ตำแหน่ง
        } else {
            $('#input-sum-person').html('<b>-</b>');
            $('#input-sum-personPrice').val('');
            pricePersonSum = 0;
        }
    }

  function calculateTotalSum() {
    totalSum = (priceCarDistance || 0) + (pricePersonSum || 0);

    $('#input-sum-sumpriceBeforeVat').val(totalSum.toLocaleString('en-US', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    }));

    console.log('ยอดรวมทั้งหมดก่อน VAT: ', totalSum);
  }



    // window.onload = initMap;

</script>
  <script async defer src="https://maps.googleapis.com/maps/api/js?key=<?php echo get_googlemap_apikey(); ?>&libraries=places&callback=initMap"></script>
</html>