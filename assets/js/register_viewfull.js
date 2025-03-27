$(document).ready(function(){
    getRegisterData();

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

    $('#btn-approveRegis').click(() => {
        // Check approve choice
        let approveChoice = $('input:radio[name="ip-regis-appro"]:checked');
        if (approveChoice.length === 0) {
            swal({
                title: 'กรุณาเลือกรายการใดรายการหนึ่ง',
                type: 'warning',
                showConfirmButton: true,
            });
        } else {
            saveRegisterApprove(approveChoice.val());
        }
    });
});

async function getRegisterData()
{
    try {
        if(registerNo){
            const formdata = new FormData();
            formdata.append('registerNo' , registerNo);
            const res = await axios.post(url+'backend/admin/getRegisterData' , formdata);
            console.log(res.data);
            if(res.data.status == "Select Data Success"){
                let doc1 = res.data.doc1;
                let doc2 = res.data.doc2;
                let doc3 = res.data.doc3;
                let doc4 = res.data.doc4;
                registerData = res.data.registerdata;

                // สร้าง grid แสดงรูปภาพจาก resultFiles
                let imageGrid1 = $('#show_imgdoc1-admin');
                imageGrid1.empty(); // เคลียร์ข้อมูลเก่า (ถ้ามี)

                // ตรวจสอบว่า resultFiles มีข้อมูลหรือไม่
                if (doc1 && doc1.length > 0) {
                    doc1.forEach(function(file) {
                    // สมมุติว่า file.url คือ URL ของรูปภาพแต่ละไฟล์
                    let gridItem = $('<div class="grid-item"></div>');
                    let img = $('<img>').attr('src', url+file.f_path+file.f_name).attr('alt', 'Image');
                    gridItem.append(img);
                    imageGrid1.append(gridItem);
                });
                } else {
                    imageGrid1.append('<p>ไม่พบรูปภาพ</p>');
                }


                // สร้าง grid แสดงรูปภาพจาก resultFiles
                let imageGrid2 = $('#show_imgdoc2-admin');
                imageGrid2.empty(); // เคลียร์ข้อมูลเก่า (ถ้ามี)

                // ตรวจสอบว่า resultFiles มีข้อมูลหรือไม่
                if (doc2 && doc2.length > 0) {
                    doc2.forEach(function(file) {
                    // สมมุติว่า file.url คือ URL ของรูปภาพแต่ละไฟล์
                    let gridItem = $('<div class="grid-item"></div>');
                    let img = $('<img>').attr('src', url+file.f_path+file.f_name).attr('alt', 'Image');
                    gridItem.append(img);
                    imageGrid2.append(gridItem);
                });
                } else {
                    imageGrid2.append('<p>ไม่พบรูปภาพ</p>');
                }


                // สร้าง grid แสดงรูปภาพจาก resultFiles
                let imageGrid3 = $('#show_imgdoc3-admin');
                imageGrid3.empty(); // เคลียร์ข้อมูลเก่า (ถ้ามี)

                // ตรวจสอบว่า resultFiles มีข้อมูลหรือไม่
                if (doc3 && doc3.length > 0) {
                    doc3.forEach(function(file) {
                    // สมมุติว่า file.url คือ URL ของรูปภาพแต่ละไฟล์
                    let gridItem = $('<div class="grid-item"></div>');
                    let img = $('<img>').attr('src', url+file.f_path+file.f_name).attr('alt', 'Image');
                    gridItem.append(img);
                    imageGrid3.append(gridItem);
                });
                } else {
                    imageGrid3.append('<p>ไม่พบรูปภาพ</p>');
                }


                // สร้าง grid แสดงรูปภาพจาก resultFiles
                let imageGrid4 = $('#show_imgdoc4-admin');
                imageGrid4.empty(); // เคลียร์ข้อมูลเก่า (ถ้ามี)

                // ตรวจสอบว่า resultFiles มีข้อมูลหรือไม่
                if (doc4 && doc4.length > 0) {
                    doc4.forEach(function(file) {
                    // สมมุติว่า file.url คือ URL ของรูปภาพแต่ละไฟล์
                    let gridItem = $('<div class="grid-item"></div>');
                    let img = $('<img>').attr('src', url+file.f_path+file.f_name).attr('alt', 'Image');
                    gridItem.append(img);
                    imageGrid4.append(gridItem);
                });
                } else {
                    imageGrid4.append('<p>ไม่พบรูปภาพ</p>');
                }

                await checkRegisStatus(registerData);
            }
        }
    } catch (error) {
        console.error("Error get register data:", error);
        return;
    }
}

async function saveRegisterApprove(approveChoice)
{
    try {
        if(registerNo){
            const formdata = new FormData();
            formdata.append('registerNo' , registerNo);
            formdata.append('approveChoice' , approveChoice);
            formdata.append('memo' , $('#ip-regis-memo').val())
            const res = await axios.post(url+'backend/admin/saveRegisterData' , formdata);
            console.log(res.data);
            if(res.data.status == "Update Data Success"){
                //code
                swal({
                    title: 'บันทึกข้อมูลสำเร็จ',
                    type: 'success',
                    showConfirmButton: true,
                }).then(()=>{
                    location.href = url+'backend/admin/register_list_page/waitapprove';
                });
            }
        }
    } catch (error) {
        console.error("บันทึกข้อมูลการอนุมัติใบสมัครไม่สำเร็จ" , error);
    }
}

function checkRegisStatus(registerData){
    if(registerData.dv_status === "wait approve"){
        $("#btn-approveRegis").css('display' , '');
    }else if(registerData.dv_status === "active" || registerData.dv_status === "not active"){
        $('input:radio[name="ip-regis-appro"][value="' + registerData.dv_approve_status + '"]').prop('checked', true);
        $('input:radio[name="ip-regis-appro"]').attr('onclick' , 'return false');
        $('#ip-regis-memo').val(registerData.dv_approve_memo).prop('readonly' , true);
    }else{
        $("#btn-approveRegis").css('display' , 'none');
    }
}