<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เรียกใช้บริการ รถรับจ้างทั่วไป</title>

    <style>

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
                        <label for="option1">
                            <img src="<?=base_url('uploads/image_system/motocycle-type.webp')?>" alt="input-choosecar-type1">
                            รถมอเตอร์ไซต์
                        </label>
                    </div>
                    <div class="grid-item">
                        <input type="radio" class="customRadio" id="input-choosecar-type2" name="input-choosecar" value="type2">
                        <label for="option2">
                            <img src="<?=base_url('uploads/image_system/car-type.webp')?>" alt="input-choosecar-type2">
                            รถเก๋ง
                        </label>
                    </div>
                    <div class="grid-item">
                        <input type="radio" class="customRadio" id="input-choosecar-type3" name="input-choosecar" value="type3">
                        <label for="option3">
                            <img src="<?=base_url('uploads/image_system/truck3-type.webp')?>" alt="input-choosecar-type3">
                            รถกระบะแคปเปลือย
                        </label>
                    </div>
                    <div class="grid-item">
                        <input type="radio" class="customRadio" id="input-choosecar-type4" name="input-choosecar" value="type4">
                        <label for="option4">
                            <img src="<?=base_url('uploads/image_system/truck2-type.webp')?>" alt="input-choosecar-type4">
                            รถกระบะตอนเดียวมีหลังคา
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
                        <label for=""><b>เลือกคนขับยกของ ประเภทที่ 1 (คนขับยกของจากท้ายรถไม่เกิน 10 เมตร ไม่ขึ้นชั้น น้ำหนักไม่เกิน 25 กิโลกรัม)</b></label>
                        <select name="input-person-typeD1" id="input-person-typeD1" class="form-control">
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                    <div class="col-md-12 form-group">
                        <label for=""><b>เลือกคนขับยกของ ประเภทที่ 2 (คนขับยกขึ้นไม่เกิน 3 ชั้น ยกขึ้นได้ 5 รอบต่อขา น้ำหนักไม่เกิน 25 กิโลกรัม)</b></label>
                        <select name="input-person-typeD2" id="input-person-typeD2" class="form-control">
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                    <div class="col-md-12 form-group">
                        <label for=""><b>เลือกพนักงานยกของ ประเภทที่ 1 (ยกขึ้นชั้นไม่เกิน 3 ชั้น ยกขึ้นได้ 5 รอบต่อขา น้ำหนักไม่เกิน 25 กิโลกรัม)</b></label>
                        <select name="input-person-typeE1" id="input-person-typeE1" class="form-control">
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                    <div class="col-md-12 form-group">
                        <label for=""><b>เลือกพนักงานยกของ ประเภทที่ 2 (ยกขึ้นชั้นไม่เกิน 3 ชั้น ยกได้ 5 รอบต่อขา น้ำหนักไม่เกิน 25 กิโลกรัม)</b></label>
                        <select name="input-person-typeE2" id="input-person-typeE2" class="form-control">
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
                
                    <div>
                        <label for="originInput">สถานที่ต้นทาง:</label>
                        <input type="text" id="originInput" placeholder="ป้อนสถานที่ต้นทาง">
                    </div>
                    <div>
                        <label for="destinationInput">สถานที่ปลายทาง:</label>
                        <input type="text" id="destinationInput" placeholder="ป้อนสถานที่ปลายทาง">
                    </div>
                    <button onclick="calculateRoute()">คำนวณเส้นทาง</button>
                    <button onclick="resetMap()">Reset</button>
                    <p id="distance"></p>
                    <div id="map"></div>
                
            </div>

            <div class="card-box pd-20 height-100-p mb-30">
                <div class="row form-group">
                    <div class="col-md-12 form-group">
                        <h5>สรุปรายการ</h5>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-12 form-group">
                        <button type="button" id="btn-calculate" class="btn btn-primary">คำนวณ</button>
                        <button type="button" id="btn-reset" class="btn btn-warning">ล้างค่า</button>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-6 form-group">
                        <label for=""><b>ประเภทรถ</b></label>
                        <!-- <span id="input-sum-cartype"><b>-</b></span> -->
                        <input class="form-control" type="text" name="input-sum-cartype" id="input-sum-cartype" readonly>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for=""><b>ระยะทาง</b></label>
                        <!-- <span id="input-sum-distance"><b>-</b></span> -->
                        <input type="text" name="input-sum-distance" id="input-sum-distance" class="form-control" readonly>
                    </div>
                    <div class="col-md-12 form-group input-group">
                        <label for=""><b>คิดเป็นเงิน</b></label>
                        <!-- <span id="input-sum-sumpriceBeforeVat"><b>-</b></span> -->
                        <div class="input-group">
                          <input type="text" name="input-sum-sumpriceCarDistance" id="input-sum-sumpriceCarDistance" class="form-control" readonly>
                          <div class="input-group-append">
                            <span class="input-group-text">บาท</span>
                          </div>
                        </div>
                    </div>
                    <div class="col-md-12 form-group">
                        <label for=""><b>คนยกของ</b></label>
                        <span id="input-sum-person"><b>-</b></span>
                    </div>
                    <div class="col-md-12 form-group">
                      <label for=""><b>คิดเป็นเงิน</b></label>
                      <div class="input-group">
                        <input type="text" name="input-sum-personPrice" id="input-sum-personPrice" class="form-control" readonly>
                        <div class="input-group-append">
                          <span class="input-group-text">บาท</span>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 form-group input-group">
                        <label for=""><b>ยอดค่าบริการทั้งสิ้น</b></label>
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
                          <input type="checkbox" class="form-check-input" id="input-accept" name="input-accept" value="accept">ยอมรับ เงื่อนไขการให้บริการ It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
                        </label>
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
<script src="<?=base_url('assets/js/gt_servicepage.js?v='.filemtime('./assets/js/gt_servicepage.js'))?>"></script>
<script>
    const getapikey = "<?php echo get_googlemap_apikey(); ?>";
    let map;
    let directionsService;
    let directionsRenderer;
    let originMarker;
    let destinationMarker;
    let distance = 0;
    let distanceRate = 0;

    function initMap() {
      let initialLocation = { lat: 13.7563, lng: 100.5018 };

      map = new google.maps.Map(document.getElementById('map'), {
        center: initialLocation,
        zoom: 10
      });

      directionsService = new google.maps.DirectionsService();
      directionsRenderer = new google.maps.DirectionsRenderer();
      directionsRenderer.setMap(map);

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

    function calculateRoute() {
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

      directionsService.route(request, function(result, status) {
        if (status === 'OK') {
          directionsRenderer.setDirections(result);
          distance = result.routes[0].legs[0].distance.text;
          document.getElementById('distance').innerText = 'ระยะทาง: ' + distance;
          getDistanceRate(distance);
        } else {
          console.error('เกิดข้อผิดพลาดในการคำนวณเส้นทาง: ' + status);
        }
      });
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
    }

    function getDistanceRate(distance)
    {
        if(distance != ""){
            axios.post(url+'main/getDistanceRate' , {
                action:"getDistanceRate",
                distance:distance
            }).then(res=>{
                // console.log(res.data);
                if(res.data.status == "Select Data Success"){
                    //code
                    let result = res.data.result;
                    distanceRate = parseFloat(result.d_calrate);
                    console.log(distanceRate);
                }
            });
        }
    }

    // window.onload = initMap;

</script>
  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD3A9Mc08SyCJjtWFLFijSITvvx0UmdmFU&libraries=places&callback=initMap"></script>
</html>