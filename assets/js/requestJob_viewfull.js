$(document).ready(function(){
    //check Status Frist
    console.log(formstatus);
    jobProcess();



    $('#btn_dv-getjob').click(()=>{
        getJob(formno);
    });

    //Checkin
    $('#btn_dv-checkin').click(()=>{
        checkinDriver();
    });

    // beforeStart
    $('#btn-dv-saveStart').click(()=>{
        clickSaveStartJob();
    });

        // เมื่อคลิกที่รูปใน grid ให้แสดง modal พร้อมแสดงภาพขนาดใหญ่
    $(document).on('click', '.grid-item img', function() {
        let src = $(this).attr('src');
        $('#modal-img').attr('src', src);
        $('#image-modal').css('display', 'block');
    });
  
    // ปิด modal เมื่อคลิกที่ปุ่มปิด (×)
    $('.modal-close').click(function() {
        $('#image-modal').css('display', 'none');
    });
  
    // Optionally ปิด modal เมื่อคลิกที่พื้นหลังนอกภาพ
    $(window).click(function(event) {
        if ($(event.target).is('#image-modal')) {
        $('#image-modal').css('display', 'none');
        }
    });


}); //End ready function 

//function zone 
function getJob(formno)
{
    if(formno){
        const formdata = new FormData();
        formdata.append('formno' , formno);
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
}

function getExpireTime(formno)
{
    if(formno){
        const formdata = new FormData();
        formdata.append("formno" , formno);
        axios.post(url+'backend/drivers/getExpireTime' , formdata).then(res=>{
            console.log(res.data);
            if(res.data.status == "Select Data Success"){
                let result = res.data.result;
                $('#sec_dv-getjob').css('display' , 'none');
                $('#sec_dv-getjob-already').css('display' , '');
                startCountdown(result.m_dv_timeexpire_getjob);

                if(driverUsername == result.m_dv_user_getjob){
                    $('#sec_dv-checkIn').css('display' , '');
                }else{
                    $('#sec_dv-checkIn').css('display' , 'none');
                }
            }
        });
    }
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

function getJobTimeout(formno)
{
    if(formno){
        const formdata = new FormData();
        formdata.append("formno" , formno);
        axios.post(url+'backend/drivers/getJobTimeout' , formdata).then(res=>{
            console.log(res.data);
            if(res.data.status == "Update Data Success"){
                $('#sec_dv-getjob').css('display' , '');
                $('#sec_dv-getjob-already').css('display' , 'none');
                $('#sec_dv-checkIn').css('display' , 'none');
                location.reload();
            }
        });
    }
}

async function jobProcess()
{
    if(formstatus){
        if(formstatus === "Payment Checked"){
            $('#sec_dv-getjob').css('display' , '');
        }else if(formstatus === "Driver Get Job"){
            getExpireTime(formno);
        }else if(formstatus === "Driver Check In"){
            getCheckInData();
            $('#sec_dv-checkInAlready').css('display','');
            $('#sec-dv_start').css('display' , '');
            $('#sec_btnsaveStart').css('display' , '');
        }else if(formstatus === "Driver Start Job"){
            try {
                await getCheckInData();
                console.log('function 1 ทำงานสำเร็จ');
                $('#sec_dv-checkInAlready').css('display','');
                $('#sec-dv_start').css('display' , '');

                $('#dv_start').hide();
                $('#sec_btnsaveStart').css('display' , 'none');
                $('#secDataStart').css('display' , '');
                await getStartJobData();
                console.log('function 2 ทำงานสำเร็จ');
            } catch (error) {
                console.error("Error in startJobProcess:", error);
            }
        }
    }
}

function getStartJobData()
{
    const formdata = new FormData();
    formdata.append('formno' , formno);
    formdata.append('driverusername' , driverUsername);
    formdata.append('type' , 'start');
    axios.post(url+'backend/drivers/getStartJobData' , formdata).then(res=>{
        console.log(res.data);
        if(res.data.status == "Select Data Success"){
            let resultMain = res.data.result_main;
            let resultFiles = res.data.result_files;
            let drivername = res.data.drivername;

            //update map
            updateMap(resultMain.m_dv_start_lat , resultMain.m_dv_start_lng);

            //fill data start main
            $('#start-datashow-drivername').html('<b>ชื่อผู้ขับ : </b>'+drivername);
            $('#start-datashow-datetime').html('<b>ชื่อผู้ขับ : </b>'+resultMain.m_dv_datetime_start);
            $('#dv-ip-memostart').text(resultMain.m_dv_memo_start).prop('readonly' , true);

            // สร้าง grid แสดงรูปภาพจาก resultFiles
            let imageGrid = $('#show_imgStart');
            imageGrid.empty(); // เคลียร์ข้อมูลเก่า (ถ้ามี)

            // ตรวจสอบว่า resultFiles มีข้อมูลหรือไม่
            if (resultFiles && resultFiles.length > 0) {
                resultFiles.forEach(function(file) {
                // สมมุติว่า file.url คือ URL ของรูปภาพแต่ละไฟล์
                let gridItem = $('<div class="grid-item"></div>');
                let img = $('<img>').attr('src', url+file.f_path+file.f_name).attr('alt', 'Image');
                gridItem.append(img);
                imageGrid.append(gridItem);
            });
            } else {
                imageGrid.append('<p>ไม่พบรูปภาพ</p>');
            }
        }
    });
}

function getCheckInData()
{
    const formdata = new FormData();
    formdata.append('formno' , formno);
    formdata.append('driverUsername' , driverUsername);
    axios.post(url+'backend/drivers/getCheckInData' , formdata).then(res=>{
        console.log(res.data);
        if(res.data.status == "Select Data Success"){
            let lo = res.data.result;
            let drivername = res.data.drivername;
            
            updateMap(lo.m_dv_checkin_lat , lo.m_dv_checkin_lng);

            $('#checkin-datashow-datetime').html('<b>วันเวลาเช็กอิน : </b>'+lo.m_dv_datetime_checkin);
            $('#checkin-datashow-drivername').html('<b>ชื่อผู้ขับ : </b>'+drivername);

            console.log(currentLocation);
        }
    });
}

function updateMap(lat , lng)
{
    if(lat && lng){
        //Update Map Zone
        currentLocation = {
            lat: parseFloat(lat),
            lng: parseFloat(lng),
        };

        // สร้าง Marker บนแผนที่หรืออัปเดตตำแหน่ง Marker ที่มีอยู่แล้ว
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
                icon: carIcon
                
            });
        }
        // ปรับจุดศูนย์กลางของแผนที่ให้ตรงกับตำแหน่งที่ได้จาก Database
        map.setCenter(currentLocation);
        //Update Map Zone
    }
}



