$(document).ready(function(){
    adminJobProcess();
    let depositePercen = $('#ip-viewfull-depositpercen').val();
    calcPriceDeposit(depositePercen , totalprice);

    $('#ip-viewfull-depositpercen').change(function(){
        calcPriceDeposit($(this).val() , totalprice);
    });

    $('#btn-approveDoc').click(function(){
        //check input null
        if($('input[name="ip-viewfull-appro"]:checked').length === 0){
            swal({
                title: 'กรุณาเลือกการอนุมัติ',
                type: 'error',
                showConfirmButton: true,
                // timer:1500
            });
        }else{
            $('#btn-approveDoc').prop('disabled' , true);
            const formdata = new FormData();
            formdata.append('formno' , formno);
            formdata.append('depositpercen' , $('#ip-viewfull-depositpercen').val());
            formdata.append('deposit' , $('#ip-viewfull-deposit').val());
            formdata.append('memo' , $('#ip-viewfull-memo').val());
            formdata.append('m_am1_approve' , $("input:radio[name='ip-viewfull-appro']:checked").val());

            axios.post(url+'backend/admin/saveApproveDoc' , formdata).then(res=>{
                console.log(res.data);
                $('#btn-approveDoc').prop('disabled' , false);
                if(res.data.status == "Update Data Success"){
                    swal({
                        title: 'บันทึกข้อมูลสำเร็จ',
                        type: 'success',
                        showConfirmButton: true,
                    }).then(function(){
                        location.href = url+'backend/admin/request_list_page/data';
                    });
                }
            });
        }
    });

    $('#btn-approvePay-backend').click(()=>{
        if($("input[name='ip-viewfull-approPay']:checked").length === 0){
            swal({
                title: 'กรุณาเลือกการอนุมัติ',
                type: 'error',
                showConfirmButton: true,
            });
        }else{
            saveConfirmPayChecked(formno);
        }
    });

    async function adminJobProcess(){
        if(formstatus == "Open"){
            //code
            $('#btn-approveDoc').css('display' , '');
        }else if(formstatus == "Approved"){
            $('#reqPaySec').css('display' , '');
            $('#btn-approveDoc').css('display' , 'none');
            await getDataApproved(formno);
        }else if(formstatus == "Payment Confirmed"){
            //approve section 
            $('#btn-approveDoc').css('display' , 'none');
            await getDataApproved(formno);
    
            //ดึงข้อมูลยืนยันการโอน
            $('#sec_confirmPay_backend').css('display' , '');
            $('#btn-approvePay-backend').css('display' , '');
            await getDataConfirmPay(formno);
        }else if(formstatus == "Payment Checked"){
            //approve section 
            $('#btn-approveDoc').css('display' , 'none');
            await getDataApproved(formno);
    
            //ดึงข้อมูลยืนยันการโอน
            $('#sec_confirmPay_backend').css('display' , '');
            $('#btn-approvePay-backend').css('display' , '');
            await getDataConfirmPay(formno);
    
            //ดึงข้อมูลตรวจสอบการโอน
            await getDataConfirmPayChecked(formno);
        }else if(formstatus == "Driver Check In"){
            //approve section 
            $('#btn-approveDoc').css('display' , 'none');
            await getDataApproved(formno);
    
            //ดึงข้อมูลยืนยันการโอน
            $('#sec_confirmPay_backend').css('display' , '');
            $('#btn-approvePay-backend').css('display' , '');
            await getDataConfirmPay(formno);
    
            //ดึงข้อมูลตรวจสอบการโอน
            await getDataConfirmPayChecked(formno);
            $('#sec_dv-checkInAlready-admin').css('display' , '');
            await getCheckInData();
        }else if(formstatus == "Driver Start Job"){
            //approve section 
            $('#btn-approveDoc').css('display' , 'none');
            await getDataApproved(formno);
    
            //ดึงข้อมูลยืนยันการโอน
            $('#sec_confirmPay_backend').css('display' , '');
            $('#btn-approvePay-backend').css('display' , '');
            await getDataConfirmPay(formno);
    
            //ดึงข้อมูลตรวจสอบการโอน
            await getDataConfirmPayChecked(formno);
            $('#sec_dv-checkInAlready-admin').css('display' , '');
            await getCheckInData();

            $('#sec-dv-start-admin').css('display' , '');
            await getStartJobData();
        }else if(formstatus == "Driver Check In Destination"){
            //approve section 
            $('#btn-approveDoc').css('display' , 'none');
            await getDataApproved(formno);
    
            //ดึงข้อมูลยืนยันการโอน
            $('#sec_confirmPay_backend').css('display' , '');
            $('#btn-approvePay-backend').css('display' , '');
            await getDataConfirmPay(formno);
    
            //ดึงข้อมูลตรวจสอบการโอน
            await getDataConfirmPayChecked(formno);
            $('#sec_dv-checkInAlready-admin').css('display' , '');
            await getCheckInData();

            $('#sec-dv-start-admin').css('display' , '');
            await getStartJobData();

            $('#sec_dv-checkInAlreadyDes-admin').css('display' , '');
            await getCheckInDataDes();
        }else if(formstatus == "Driver Close Job"){
            //approve section 
            $('#btn-approveDoc').css('display' , 'none');
            await getDataApproved(formno);

            //ดึงข้อมูลยืนยันการโอน
            $('#sec_confirmPay_backend').css('display' , '');
            $('#btn-approvePay-backend').css('display' , '');
            await getDataConfirmPay(formno);

            //ดึงข้อมูลตรวจสอบการโอน
            await getDataConfirmPayChecked(formno);
            $('#sec_dv-checkInAlready-admin').css('display' , '');
            await getCheckInData();

            $('#sec-dv-start-admin').css('display' , '');
            await getStartJobData();

            $('#sec_dv-checkInAlreadyDes-admin').css('display' , '');
            await getCheckInDataDes();

            $('#sec-dv-stop-admin').css('display' , '');
            await getStopJobData();
        }
    }

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


function getDataApproved(formno)
{
    if(formno !== ""){
        const formdata = new FormData();
        formdata.append('formno' , formno);
        axios.post(url+'backend/admin/getDataApproved' , formdata).then(res=>{
            console.log(res.data);
            if(res.data.status == "Select Data Success"){
                let result = res.data.result;
                $('#approSecUser').css('display' , '');
                $('#ip-viewfull-appro-name').val(result.m_am1_user);
                $('#ip-viewfull-appro-datetime').val(result.m_am1_datetime);
                $('#ip-viewfull-memo').val(result.m_am1_memo).prop('readonly' , true);
                $('#ip-viewfull-deposit').val(result.m_deposit);
                $('#ip-viewfull-depositpercen').val(result.m_deposit_percen).prop('disabled', true).css('pointer-events', 'none');
                $("input:radio[name='ip-viewfull-appro'][value='" + result.m_am1_approve + "']").prop('checked', true);
                $("input:radio[id='ip-viewfull-appro-yes']").attr('onclick','return false');
                $("input:radio[id='ip-viewfull-appro-no']").attr('onclick','return false');
            }
        });
    }
}

//Function area
function calcPriceDeposit(depositePercen , totalprice)
{
    if(depositePercen !== "" && totalprice !== ""){
        let deposit = 0;
        deposit = (parseFloat(totalprice)*(parseFloat(depositePercen)/100));
        $('#ip-viewfull-deposit').val(deposit.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
    }else{
        $('#ip-viewfull-deposit').val(0);
    }
    console.log(parseFloat(totalprice));
}

function getDataConfirmPay(formno)
{
    if(formno){
        const formdata = new FormData()
        formdata.append('formno' , formno);
        axios.post(url+'backend/admin/getDataConfirmPay' , formdata).then(res=>{
            console.log(res.data);
            if(res.data.status == "Select Data Success"){
                //
                let result = res.data.result;
                let resultFile = res.data.resultFile;

                $('#ip-viewfull-numberPay').val(result.m_userconfirm_money).prop('readonly' , true);

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
                $('#show_file_confirmPay_backend').html(imageHtml);
            }
        });
    }
}

function saveConfirmPayChecked(formno)
{
    if(formno){
        $('#btn-approvePay-backend').prop('disabled' , true);
        const formdata = new FormData();
        formdata.append('formno' , formno);
        formdata.append('m_am2_approve' , $("input[name='ip-viewfull-approPay']").val());
        formdata.append('m_am2_memo' , $('#ip-viewfull-memoPay').val());
        axios.post(url+'backend/admin/saveConfirmPayChecked' , formdata).then(res=>{
            console.log(res.data);
            $('#btn-approvePay-backend').prop('disabled' , false);
            if(res.data.status == "Update Data Success"){
                swal({
                    title: 'บันทึกข้อมูลสำเร็จ',
                    type: 'success',
                    showConfirmButton: false,
                    timer:1500
                }).then(()=>{
                    location.href = url+'backend/admin/request_list_page/checkpayment';
                });
            }
        });
    }
}

function getDataConfirmPayChecked(formno)
{
    if(formno){
        const formdata = new FormData()
        formdata.append('formno' , formno);
        axios.post(url+'backend/admin/getDataConfirmPayChecked' , formdata).then(res=>{
            console.log(res.data);
            if(res.data.status == "Select Data Success"){
                //Code
                let result = res.data.result;

                $('#approSecUser2').css('display' , '');
                $('#ip-viewfull-appro2-name').val(result.m_am2_user);
                $('#ip-viewfull-appro2-datetime').val(result.m_am2_datetime);

                $('#btn-approvePay-backend').css('display' , 'none');
                $('#ip-viewfull-memoPay').val(result.m_am2_memo).prop('readonly' , true);
                $("input:radio[name='ip-viewfull-approPay'][value='" + result.m_am2_approve + "']").prop('checked', true);
                $("input:radio[id='ip-viewfull-approPay-yes']").attr('onclick','return false');
                $("input:radio[id='ip-viewfull-approPay-no']").attr('onclick','return false');
            }
        });
    }
}

function getCheckInData()
{
    const formdata = new FormData();
    formdata.append('formno' , formno);
    axios.post(url+'backend/admin/getCheckInData' , formdata).then(res=>{
        console.log(res.data);
        if(res.data.status == "Select Data Success"){
            let result = res.data.result;
            
            updateMap(result.m_dv_checkin_lat , result.m_dv_checkin_lng);

            $('#checkin-datashow-admin-datetime').html('<b>วันเวลาเช็กอิน : </b>'+result.m_dv_datetime_checkin);
            $('#checkin-datashow-admin-drivername').html('<b>ชื่อผู้ขับ : </b>'+res.data.drivername);

            console.log(currentLocation);
        }
    });
}

function getStartJobData()
{
    const formdata = new FormData();
    formdata.append('formno' , formno);
    formdata.append('type' , 'start');
    axios.post(url+'backend/admin/getStartJobData' , formdata).then(res=>{
        console.log(res.data);
        if(res.data.status == "Select Data Success"){
            let resultMain = res.data.result_main;
            let resultFiles = res.data.result_files;
            let drivername = res.data.drivername;

            //update map
            updateMap(resultMain.m_dv_start_lat , resultMain.m_dv_start_lng);

            //fill data start main
            $('#start-datashow-admin-drivername').html('<b>ชื่อผู้ขับ : </b>'+drivername);
            $('#start-datashow-admin-datetime').html('<b>ชื่อผู้ขับ : </b>'+resultMain.m_dv_datetime_start);
            $('#dv-ip-memostart-admin').text(resultMain.m_dv_memo_start).prop('readonly' , true);

            // สร้าง grid แสดงรูปภาพจาก resultFiles
            let imageGrid = $('#show_imgStart-admin');
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

function getCheckInDataDes()
{
    const formdata = new FormData();
    formdata.append('formno' , formno);
    axios.post(url+'backend/admin/getCheckInDataDes' , formdata).then(res=>{
        console.log(res.data);
        if(res.data.status == "Select Data Success"){
            let result = res.data.result;
            let drivername = res.data.drivername;
            
            updateMap(result.m_dv_checkin_lat , result.m_dv_checkin_lng);

            $('#checkinDes-datashow-admin-datetime').html('<b>วันเวลาเช็กอิน : </b>'+result.m_dv_datetime_checkindes);
            $('#checkinDes-datashow-admin-drivername').html('<b>ชื่อผู้ขับ : </b>'+drivername);

            console.log(currentLocation);
        }
    });
}

function getStopJobData()
{
    const formdata = new FormData();
    formdata.append('formno' , formno);
    formdata.append('type' , 'stop');
    axios.post(url+'backend/admin/getStopJobData' , formdata).then(res=>{
        console.log(res.data);
        if(res.data.status == "Select Data Success"){
            let resultMain = res.data.result_main;
            let resultFiles = res.data.result_files;
            let drivername = res.data.drivername;

            //update map
            updateMap(resultMain.m_dv_stop_lat , resultMain.m_dv_stop_lng);

            //fill data start main
            $('#stop-datashow-admin-drivername').html('<b>ชื่อผู้ขับ : </b>'+drivername);
            $('#stop-datashow-admin-datetime').html('<b>ชื่อผู้ขับ : </b>'+resultMain.m_dv_datetime_stop);
            $('#dv-ip-memostop-admin').text(resultMain.m_dv_memo_stop).prop('readonly' , true);

            // สร้าง grid แสดงรูปภาพจาก resultFiles
            let imageGrid = $('#show_imgStop-admin');
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