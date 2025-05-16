$(document).ready(function () {
  //check Status Frist
  console.log(formstatus);
  jobProcess();

  $("#btn_dv-getjob").click(() => {
    getJob(formno);
  });

  //Checkin
  $("#btn_dv-checkin").click(() => {
    checkinDriver();
  });

  $("#btn_dv-checkinDes").click(() => {
    checkinDriverDes();
  });

  // beforeStart
  $("#btn-dv-saveStart").click(() => {
    clickSaveStartJob();
  });

  $("#btn-dv-saveStop").click(() => {
    clickSaveStopJob();
  });

  // Modal Event
  // เมื่อคลิกที่รูปใน grid ให้แสดง modal พร้อมแสดงภาพขนาดใหญ่
  $(document).on("click", ".grid-item img", function () {
    let src = $(this).attr("src");
    $("#modal-img").attr("src", src);
    $("#image-modal").css("display", "block");
  });

  // ปิด modal เมื่อคลิกที่ปุ่มปิด (×)
  $(".modal-close").click(function () {
    $("#image-modal").css("display", "none");
  });

  // Optionally ปิด modal เมื่อคลิกที่พื้นหลังนอกภาพ
  $(window).click(function (event) {
    if ($(event.target).is("#image-modal")) {
      $("#image-modal").css("display", "none");
    }
  });
  // Modal Event
}); //End ready function

//function zone

function getExpireTime(formno) {
  if (formno) {
    const formdata = new FormData();
    formdata.append("formno", formno);
    axios.post(url + "backend/drivers/getExpireTime", formdata).then((res) => {
      console.log(res.data);
      if (res.data.status == "Select Data Success") {
        let result = res.data.result;
        let drivername = res.data.drivername;
        $("#sec_dv-getjob").css("display", "none");
        $("#sec_dv-getjob-already").css("display", "");
        startCountdown(result.m_dv_timeexpire_getjob);

        updateMap(result.m_dv_getjob_lat, result.m_dv_getjob_lng);
        let isIOS = /iPhone|iPad|iPod/i.test(navigator.userAgent);
        let isAndroid = /Android/i.test(navigator.userAgent);

        let navigationUrl = "";

        if (isIOS) {
          navigationUrl = `comgooglemaps://?saddr=${result.m_dv_getjob_lat},${result.m_dv_getjob_lng}&daddr=${origin}&directionsmode=driving`;
        } else if (isAndroid) {
          navigationUrl = `google.navigation:q=${origin}&mode=d`;
        } else {
          // fallback ไป browser
          navigationUrl = `https://www.google.com/maps/dir/?api=1&origin=${result.m_dv_getjob_lat},${result.m_dv_getjob_lng}&destination=${origin}&travelmode=driving`;
        }

        let bt_showmap = `<a href="${navigationUrl}" target="_blank"><button type="button" class="btn btn-primary btn-block">นำทาง</button></a>`;

        if (driverUsername == result.m_dv_user_getjob) {
          $("#sec_dv-checkIn").css("display", "");
          $("#show_navigator").html(bt_showmap);
        } else {
          $("#sec_dv-checkIn").css("display", "none");
          $("#show_navigator").html("");
        }
      }
    });
  }
}

function openNavigation(originLat, originLng, destinationLat, destinationLng) {
  const navigationUrl = `https://www.google.com/maps/dir/?api=1&origin=${originLat},${originLng}&destination=${destinationLat},${destinationLng}&travelmode=driving`;
  window.open(navigationUrl, "_blank");
}

function startCountdown(expiryTime) {
  let countdownElement = document.getElementById("show_expireTime");
  let countdownInterval;

  function updateCountdown() {
    let now = Math.floor(Date.now() / 1000); // เวลาปัจจุบัน (timestamp)
    let timeLeft = expiryTime - now; // คำนวณเวลาที่เหลือ

    if (timeLeft > 0) {
      let minutes = Math.floor(timeLeft / 60);
      let seconds = timeLeft % 60;
      countdownElement.innerHTML = `เหลือเวลา: ${minutes} นาที ${seconds} วินาที`;
    } else {
      countdownElement.innerHTML = "⏳ หมดเวลาเช็กอินแล้ว!";
      clearInterval(countdownInterval);
      getJobTimeout(formno);
    }
  }

  updateCountdown();
  countdownInterval = setInterval(updateCountdown, 1000);
}

function getJobTimeout(formno) {
  if (formno) {
    const formdata = new FormData();
    formdata.append("formno", formno);
    axios.post(url + "backend/drivers/getJobTimeout", formdata).then((res) => {
      console.log(res.data);
      if (res.data.status == "Update Data Success") {
        $("#sec_dv-getjob").css("display", "");
        $("#sec_dv-getjob-already").css("display", "none");
        $("#sec_dv-checkIn").css("display", "none");
        location.reload();
      }
    });
  }
}

async function jobProcess() {
  if (formstatus) {
    await clearDataTempByUser();
    console.log("function เช็ก Temp Data ทำงานเสร็จ");
    if (formstatus === "Payment Checked") {
      $("#sec_dv-getjob").css("display", "");
    } else if (formstatus === "Driver Get Job") {
      getExpireTime(formno);
    } else if (formstatus === "Driver Check In") {
      getCheckInData();
      $("#sec_dv-checkInAlready").css("display", "");
      $("#sec-dv_start").css("display", "");
      $("#sec_btnsaveStart").css("display", "");
    } else if (formstatus === "Driver Start Job") {
      try {
        await getCheckInData();
        console.log("function 1 ทำงานสำเร็จ");
        $("#sec_dv-checkInAlready").css("display", "");
        $("#sec-dv_start").css("display", "");

        $("#dv_start").hide();
        $("#sec_btnsaveStart").css("display", "none");
        $("#secDataStart").css("display", "");
        await getStartJobData();
        console.log("function 2 ทำงานสำเร็จ");

        $("#sec_dv-checkInDes").css("display", "");
      } catch (error) {
        console.error("Error in startJobProcess:", error);
      }
    } else if (formstatus === "Driver Check In Destination") {
      try {
        await getCheckInData();
        console.log("function 1 ทำงานสำเร็จ");
        $("#sec_dv-checkInAlready").css("display", "");
        $("#sec-dv_start").css("display", "");

        $("#dv_start").hide();
        $("#sec_btnsaveStart").css("display", "none");
        $("#secDataStart").css("display", "");
        await getStartJobData();
        console.log("function 2 ทำงานสำเร็จ");

        $("#sec_dv-checkInDes").css("display", "none");
        $("#sec_dv-checkInAlreadyDes").css("display", "");
        await getCheckInDataDes();
        console.log("function 3 ทำงานสำเร็จ");

        $("#sec-dv_stop").css("display", "");
        $("#sec_btnsaveStop").css("display", "");
      } catch (error) {
        console.error("Error in startJobProcess:", error);
      }
    } else if (formstatus === "Driver Close Job") {
      try {
        await getCheckInData();
        console.log("function 1 ทำงานสำเร็จ");
        $("#sec_dv-checkInAlready").css("display", "");
        $("#sec-dv_start").css("display", "");

        $("#dv_start").hide();
        $("#sec_btnsaveStart").css("display", "none");
        $("#secDataStart").css("display", "");
        await getStartJobData();
        console.log("function 2 ทำงานสำเร็จ");

        $("#sec_dv-checkInDes").css("display", "none");
        $("#sec_dv-checkInAlreadyDes").css("display", "");
        await getCheckInDataDes();
        console.log("function 3 ทำงานสำเร็จ");

        $("#sec-dv_stop").css("display", "");
        $("#sec_btnsaveStop").css("display", "");

        await getStopJobData();
        $("#sec_btnsaveStop").css("display", "none");
        $("#secDataStop").css("display", "");
        $("#dv_stop").hide();
      } catch (error) {
        console.error("Error in startJobProcess:", error);
      }
    }
  }
}

function getStartJobData() {
  const formdata = new FormData();
  formdata.append("formno", formno);
  formdata.append("driverusername", driverUsername);
  formdata.append("type", "start");
  axios.post(url + "backend/drivers/getStartJobData", formdata).then((res) => {
    console.log(res.data);
    if (res.data.status == "Select Data Success") {
      let resultMain = res.data.result_main;
      let resultFiles = res.data.result_files;
      let drivername = res.data.drivername;

      //update map
      updateMap(resultMain.m_dv_start_lat, resultMain.m_dv_start_lng);

      //fill data start main
      $("#start-datashow-drivername").html("<b>ชื่อผู้ขับ : </b>" + drivername);
      $("#start-datashow-datetime").html(
        "<b>ชื่อผู้ขับ : </b>" + resultMain.m_dv_datetime_start
      );
      $("#dv-ip-memostart")
        .text(resultMain.m_dv_memo_start)
        .prop("readonly", true);

      // สร้าง grid แสดงรูปภาพจาก resultFiles
      let imageGrid = $("#show_imgStart");
      imageGrid.empty(); // เคลียร์ข้อมูลเก่า (ถ้ามี)

      // ตรวจสอบว่า resultFiles มีข้อมูลหรือไม่
      if (resultFiles && resultFiles.length > 0) {
        resultFiles.forEach(function (file) {
          // สมมุติว่า file.url คือ URL ของรูปภาพแต่ละไฟล์
          let gridItem = $('<div class="grid-item"></div>');
          let img = $("<img>")
            .attr("src", url + file.f_path + file.f_name)
            .attr("alt", "Image");
          gridItem.append(img);
          imageGrid.append(gridItem);
        });
      } else {
        imageGrid.append("<p>ไม่พบรูปภาพ</p>");
      }
    }
  });
}

function getStopJobData() {
  const formdata = new FormData();
  formdata.append("formno", formno);
  formdata.append("driverusername", driverUsername);
  formdata.append("type", "stop");
  axios.post(url + "backend/drivers/getStopJobData", formdata).then((res) => {
    console.log(res.data);
    if (res.data.status == "Select Data Success") {
      let resultMain = res.data.result_main;
      let resultFiles = res.data.result_files;
      let drivername = res.data.drivername;

      //update map
      updateMap(resultMain.m_dv_stop_lat, resultMain.m_dv_stop_lng);

      //fill data start main
      $("#stop-datashow-drivername").html("<b>ชื่อผู้ขับ : </b>" + drivername);
      $("#stop-datashow-datetime").html(
        "<b>ชื่อผู้ขับ : </b>" + resultMain.m_dv_datetime_stop
      );
      $("#dv-ip-memostop")
        .text(resultMain.m_dv_memo_stop)
        .prop("readonly", true);

      // สร้าง grid แสดงรูปภาพจาก resultFiles
      let imageGrid = $("#show_imgStop");
      imageGrid.empty(); // เคลียร์ข้อมูลเก่า (ถ้ามี)

      // ตรวจสอบว่า resultFiles มีข้อมูลหรือไม่
      if (resultFiles && resultFiles.length > 0) {
        resultFiles.forEach(function (file) {
          // สมมุติว่า file.url คือ URL ของรูปภาพแต่ละไฟล์
          let gridItem = $('<div class="grid-item"></div>');
          let img = $("<img>")
            .attr("src", url + file.f_path + file.f_name)
            .attr("alt", "Image");
          gridItem.append(img);
          imageGrid.append(gridItem);
        });
      } else {
        imageGrid.append("<p>ไม่พบรูปภาพ</p>");
      }
    }
  });
}

function getCheckInData() {
  const formdata = new FormData();
  formdata.append("formno", formno);
  formdata.append("driverUsername", driverUsername);
  axios.post(url + "backend/drivers/getCheckInData", formdata).then((res) => {
    console.log(res.data);
    if (res.data.status == "Select Data Success") {
      let lo = res.data.result;
      let drivername = res.data.drivername;

      updateMap(lo.m_dv_checkin_lat, lo.m_dv_checkin_lng);

      $("#checkin-datashow-datetime").html(
        "<b>วันเวลาเช็กอิน : </b>" + lo.m_dv_datetime_checkin
      );
      $("#checkin-datashow-drivername").html(
        "<b>ชื่อผู้ขับ : </b>" + drivername
      );

      console.log(currentLocation);
    }
  });
}

function getCheckInDataDes() {
  const formdata = new FormData();
  formdata.append("formno", formno);
  formdata.append("driverUsername", driverUsername);
  axios
    .post(url + "backend/drivers/getCheckInDataDes", formdata)
    .then((res) => {
      console.log(res.data);
      if (res.data.status == "Select Data Success") {
        let lo = res.data.result;
        let drivername = res.data.drivername;

        updateMap(lo.m_dv_checkin_lat, lo.m_dv_checkin_lng);

        $("#checkinDes-datashow-datetime").html(
          "<b>วันเวลาเช็กอิน : </b>" + lo.m_dv_datetime_checkindes
        );
        $("#checkinDes-datashow-drivername").html(
          "<b>ชื่อผู้ขับ : </b>" + drivername
        );

        console.log(currentLocation);
      }
    });
}

function updateMap(lat, lng) {
  if (lat && lng) {
    //Update Map Zone
    currentLocation = {
      lat: parseFloat(lat),
      lng: parseFloat(lng),
    };

    // สร้าง Marker บนแผนที่หรืออัปเดตตำแหน่ง Marker ที่มีอยู่แล้ว
    const carIcon = {
      url: url + "images/driverIcon.png",
      scaledSize: new google.maps.Size(60, 60),
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
    // ปรับจุดศูนย์กลางของแผนที่ให้ตรงกับตำแหน่งที่ได้จาก Database
    map.setCenter(currentLocation);
    //Update Map Zone
  }
}

function clearDataTempByUser() {
  if (driverUsername) {
    const formdata = new FormData();
    formdata.append("driverusername", driverUsername);
    axios
      .post(url + "backend/drivers/clearDataTempByUser", formdata)
      .then((res) => {
        console.log(res.data);
      });
  }
}

// ฟังก์ชันสำหรับเริ่มติดตามตำแหน่งแบบ realtime
function watchDriverLocation() {
  if (navigator.geolocation) {
    // เริ่มติดตามตำแหน่งและรับ watchId สำหรับหยุดติดตามเมื่อไม่ต้องการแล้ว
    const watchId = navigator.geolocation.watchPosition(
      function (position) {
        const lat = position.coords.latitude;
        const lng = position.coords.longitude;
        // เรียก updateMap เพื่ออัปเดต marker บนแผนที่
        updateMap(lat, lng);
      },
      function (error) {
        console.error("ไม่สามารถดึงตำแหน่งแบบ realtime ได้", error);
      },
      {
        enableHighAccuracy: true,
        maximumAge: 0,
        timeout: 5000,
      }
    );
    return watchId;
  } else {
    console.error("เบราว์เซอร์นี้ไม่รองรับ Geolocation");
  }
}

// เรียกใช้งานฟังก์ชันเพื่อเริ่มติดตามตำแหน่งแบบ realtime
//   const driverWatchId = watchDriverLocation();
