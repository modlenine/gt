$(document).ready(function(){
    //code
    jobProcess_user();

    $('#btn_confirmPay').on("click" , function (){
        if(myDropzone1.files.length == 0){
            swal({
                title: 'กรุณาอัพโหลดไฟล์หลักฐานการโอนเงิน',
                type: 'error',
                showConfirmButton: true,
            });
        }else if($('#ip-confirmNumPay').val() == ""){
            swal({
                title: 'กรุณาระบุจำนวนเงิน',
                type: 'error',
                showConfirmButton: true,
            });
        }else{
            saveConfirmPay(formno , userid);
        }
    });

    // Modal Event
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
    // Modal Event
});

function deleteTempfileFrist(userid)
{
    if(userid)
    {
        const formdata = new FormData();
        formdata.append('userid' , userid);

        axios.post(url+'main/removeTempFile_byuser' , formdata).then(res=>{
            console.log(res.data);
        });
    }
}

function saveConfirmPay(formno , userid)
{
    if(formno != "" && userid != "" && $('#ip-confirmNumPay').val() != ""){
        $('#btn_confirmPay').prop('disabled' , true);
        const formdata = new FormData();
        formdata.append('formno' , formno);
        formdata.append('userid' , userid);
        formdata.append('confirmNumPay' , $('#ip-confirmNumPay').val());
        axios.post(url+'main/saveConfirmPay' , formdata).then(res=>{
            console.log(res.data);
            $('#btn_confirmPay').prop('disabled' , false);
            if(res.data.status == "Update Data Success"){
                swal({
                    title: 'ส่งข้อมูลยืนยันการโอนเงินสำเร็จ',
                    type: 'success',
                    showConfirmButton: false,
                    timer:1500
                }).then(()=>{
                    location.reload();
                });
            }
        });
    }
}

function getDataConfirmPay(formno)
{
    if(formno){
        const formdata = new FormData()
        formdata.append('formno' , formno);
        axios.post(url+'main/getDataConfirmPay' , formdata).then(res=>{
            console.log(res.data);
            if(res.data.status == "Select Data Success"){
                //
                let result = res.data.result;
                let resultFile = res.data.resultFile;

                $('#ip-confirmNumPay').val(result.m_userconfirm_money).prop('readonly' , true);

                let imageHtml = ``;
                let ext;
                for(let i = 0; i < resultFile.length; i++){
                    ext = resultFile[i].f_name.split('.').pop().toLowerCase();

                    if(ext != "pdf"){
                        imageHtml +=`
                        <div class="col-md-4 col-lg-3 col-6 mt-2">
                            <a href="`+url+resultFile[i].f_path+resultFile[i].f_name+`" target="_blank">
                                <img class="runImageView" src="`+url+resultFile[i].f_path+resultFile[i].f_name+`">
                            </a>
                            <a href="`+url+resultFile[i].f_path+resultFile[i].f_name+`" target="_blank"><b>`+resultFile[i].f_name+`</b></a>
                        </div>
                        `;
                    }else{
                        imageHtml +=`
                        <div class="col-md-4 col-lg-3 col-6 mt-2">
                            <embed src="`+url+resultFile[i].f_path+resultFile[i].f_name+`" width="100%" frameborder="0" allowfullscreen>
                            <a href="`+url+resultFile[i].f_path+resultFile[i].f_name+`" target="_blank"><b>`+resultFile[i].f_name+`</b></a>
                        </div>
                        `;
                    }

                    
                    console.log(ext);
                }
                $('#show_file_confirmPay').html(imageHtml);
            }
        });
    }
}

function getDriverGetjobData(formno)
{
    if(formno){
        const formdata = new FormData();
        formdata.append('formno' , formno);
        axios.post(url+'main/getDriverGetjobData' , formdata).then(res=>{
            console.log(res.data);
            console.log('ดึงข้อมูล driver');
            if(res.data.status == "Select Data Success"){
                let result = res.data.result;
                $('#cus-drivername').html(`<b>ชื่อ : </b>`+res.data.drivername);
                $('#cus-drivertel').html(`<b>เบอร์โทรศัพท์ : </b><a href="tel:${res.data.drivertel}">`+res.data.drivertel+`</a>`);
                $('#cus-drivergetjob-datetime').html(`<b>วันที่รับงาน : </b>`+result.m_dv_datetime_getjob);
                //update map
                updateMap(result.m_dv_getjob_lat , result.m_dv_getjob_lng);
            }
        });
    }
}

function getDriverCheckinData(formno)
{
    if(formno){
        const formdata = new FormData();
        formdata.append('formno' , formno);
        axios.post(url+'main/getDriverCheckinData' , formdata).then(res=>{
            console.log(res.data);
            console.log('ดึงข้อมูล driver');
            if(res.data.status == "Select Data Success"){
                let result = res.data.result;
                $('#cus-driverCheckin-datetime').html(`<b>วันเวลาเช็กอินต้นทาง : </b>`+result.m_dv_datetime_checkin);
                //update map
                updateMap(result.m_dv_checkin_lat , result.m_dv_checkin_lng);
            }
        });
    }
}

function getDriverStartJobData(formno)
{
    const formdata = new FormData();
    formdata.append('formno' , formno);
    formdata.append('type' , 'start');
    axios.post(url+'main/getDriverStartJobData' , formdata).then(res=>{
        console.log(res.data);
        if(res.data.status == "Select Data Success"){
            let resultMain = res.data.result_main;
            let resultFiles = res.data.result_files;
            let drivername = res.data.drivername;

            //update map
            updateMap(resultMain.m_dv_start_lat , resultMain.m_dv_start_lng);

            //fill data start main
            $('#start-datashow-cus-drivername').html('<b>ชื่อผู้ขับ : </b>'+drivername);
            $('#start-datashow-cus-datetime').html('<b>ชื่อผู้ขับ : </b>'+resultMain.m_dv_datetime_start);
            $('#dv-ip-memostart').text(resultMain.m_dv_memo_start).prop('readonly' , true);

            // สร้าง grid แสดงรูปภาพจาก resultFiles
            let imageGrid = $('#show_imgStart-cus');
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

function getDriverCheckinDesData(formno)
{
    if(formno){
        const formdata = new FormData();
        formdata.append('formno' , formno);
        axios.post(url+'main/getDriverCheckinDesData' , formdata).then(res=>{
            console.log(res.data);
            console.log('ดึงข้อมูล driver');
            if(res.data.status == "Select Data Success"){
                let result = res.data.result;
                $('#cus-driverCheckinDes-datetime').html(`<b>วันเวลาเช็กอินปลายทาง : </b>`+result.m_dv_datetime_checkindes);
                //update map
                updateMap(result.m_dv_checkindes_lat , result.m_dv_checkindes_lng);
            }
        });
    }
}

function getDriverStopJobData(formno)
{
    const formdata = new FormData();
    formdata.append('formno' , formno);
    formdata.append('type' , 'stop');
    axios.post(url+'main/getDriverStopJobData' , formdata).then(res=>{
        console.log(res.data);
        if(res.data.status == "Select Data Success"){
            let resultMain = res.data.result_main;
            let resultFiles = res.data.result_files;
            let drivername = res.data.drivername;

            //update map
            updateMap(resultMain.m_dv_stop_lat , resultMain.m_dv_stop_lng);

            //fill data start main
            $('#stop-datashow-cus-drivername').html('<b>ชื่อผู้ขับ : </b>'+drivername);
            $('#stop-datashow-cus-datetime').html('<b>ชื่อผู้ขับ : </b>'+resultMain.m_dv_datetime_stop);
            $('#dv-ip-memostop').text(resultMain.m_dv_memo_stop).prop('readonly' , true);

            // สร้าง grid แสดงรูปภาพจาก resultFiles
            let imageGrid = $('#show_imgStop-cus');
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

async function jobProcess_user()
{
    //check form status frist
    await deleteTempfileFrist(userid);
    if(formstatus == "Open"){
        //code
        let statusText = `รายการอยู่ระหว่างตรวจสอบจากเจ้าหน้าที่`;
        $('#statusForUserText').html(statusText);
    }else if(formstatus == "Approved"){
        $('.sec_waitConfirm').css('display' , '');
        $('#reqPaySec').css('display' , '');
    }else if(formstatus == "Payment Confirmed"){
        $('.sec_waitConfirm').css('display' , 'none');
        await getDataConfirmPay(formno);
        let statusText = `ยืนยันการโอนเงินสำเร็จ เจ้าหน้าที่กำลังตรวจสอบข้อมูล`;
        $('#statusForUserText').html(statusText);
    }else if(formstatus == "Payment Checked"){
        $('.sec_waitConfirm').css('display' , 'none');
        await getDataConfirmPay(formno);
        let statusText = `เจ้าหน้าที่ตรวจสอบข้อมูลเรียบร้อยแล้ว กำลังติดต่อคนขับรถเพื่อรับงานของท่าน`;
        $('#statusForUserText').html(statusText);
    }else if(formstatus == "Driver Get Job"){
        $('.sec_waitConfirm').css('display' , 'none');
        await getDataConfirmPay(formno);
        let statusText = `คนขับรับงานแล้ว กำลังเดินทางไปหาท่าน`;
        $('#statusForUserText').html(statusText);
        await getDriverGetjobData(formno);
        $('#sec-showcus-getjob').css('display' , '');
    }else if(formstatus == "Driver Check In"){
        $('.sec_waitConfirm').css('display' , 'none');
        await getDataConfirmPay(formno);
        let statusText = `คนขับเช็กอินหน้างานแล้ว`;
        $('#statusForUserText').html(statusText);
        await getDriverGetjobData(formno);
        $('#sec-showcus-getjob').css('display' , '');
        await getDriverCheckinData(formno);
    }else if(formstatus == "Driver Start Job"){
        $('.sec_waitConfirm').css('display' , 'none');
        await getDataConfirmPay(formno);
        let statusText = `คนขับกำลังออกเดินทาง`;
        $('#statusForUserText').html(statusText);
        await getDriverGetjobData(formno);
        $('#sec-showcus-getjob').css('display' , '');
        await getDriverCheckinData(formno);
        $('#sec-dv_start-customer').css('display' , '');
        await getDriverStartJobData(formno);
    }else if(formstatus == "Driver Check In Destination"){
        $('.sec_waitConfirm').css('display' , 'none');
        await getDataConfirmPay(formno);
        let statusText = `คนขับเช็กอินปลายทาง`;
        $('#statusForUserText').html(statusText);
        await getDriverGetjobData(formno);
        $('#sec-showcus-getjob').css('display' , '');
        await getDriverCheckinData(formno);
        $('#sec-dv_start-customer').css('display' , '');
        await getDriverStartJobData(formno);

        await getDriverCheckinDesData(formno);
    }else if(formstatus == "Driver Close Job"){
        $('.sec_waitConfirm').css('display' , 'none');
        await getDataConfirmPay(formno);
        let statusText = `คนขับปิดงาน เรียบร้อยแล้ว`;
        $('#statusForUserText').html(statusText);
        await getDriverGetjobData(formno);
        $('#sec-showcus-getjob').css('display' , '');
        await getDriverCheckinData(formno);
        $('#sec-dv_start-customer').css('display' , '');
        await getDriverStartJobData(formno);

        await getDriverCheckinDesData(formno);
        $('#sec-dv_stop-customer').css('display' , '');
        await getDriverStopJobData(formno);
    }
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




