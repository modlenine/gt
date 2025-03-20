$(document).ready(()=>{
    $('#btn-save-driverregister').click(()=>{
        //Check Value On Register form
        validateAndSave();
    });
});


document.getElementById("btn-save-driverregister-accept").addEventListener("click" , ()=>{
    saveDataRegisterAccept();
})

function isAllThai(text) {
    // ตรวจสอบว่าข้อความเป็นภาษาไทยทั้งหมด (ไม่อนุญาตช่องว่าง)
    return /^[\u0E00-\u0E7F]+$/.test(text);
}

function isEnglishOnly(text) {
    // ตรวจสอบว่า text มีแต่ตัวอักษรภาษาอังกฤษ (ไม่มีช่องว่าง)
    return /^[A-Za-z]+$/.test(text);
}

async function saveDataRegisterAccept()
{
    //savedata
    try {
        // สร้าง FormData และแนบข้อมูล
        const formdata = new FormData();
        formdata.append('fnameTH', fnameTH);
        formdata.append('lnameTH', lnameTH);
        formdata.append('fnameEN', fnameEN);
        formdata.append('lnameEN', lnameEN);
        formdata.append('tel', tel);
        formdata.append('lineid', lineid);
        formdata.append('numberplate', numberplate);
        formdata.append('username', username);

        // ส่งข้อมูลไปยัง backend
        const res = await axios.post(url + 'driverslogin/saveRegisterAccept', formdata);
        console.log(res.data);
        if (res.data.status === "Insert Data Success") {
            regisNo = res.data.registerNo;
            await dv_mem_doc1.processQueue();
            await dv_mem_doc2.processQueue();
            await dv_mem_doc3.processQueue();
            await dv_mem_doc4.processQueue();

            swal({
                title: 'ลงทพเบียนสำเร็จ กรุณารอการตอบกลับจากเจ้าหน้าที่',
                type: 'success',
                showConfirmButton: true,
            }).then(()=>{
                location.href = url+'backend/drivers';
            });
        }
    } catch (error) {
        console.error("Error saving register accept:", error);
        return;
    }
}

function validateAndSave() {
    // ดึงค่าจาก input ทั้งหมด
    fnameTH    = document.getElementById("reg-fnameTH").value.trim();
    lnameTH    = document.getElementById("reg-lnameTH").value.trim();
    fnameEN    = document.getElementById("reg-fnameEN").value.trim();
    lnameEN    = document.getElementById("reg-lnameEN").value.trim();
    tel        = document.getElementById("reg-tel").value.trim();
    lineid     = document.getElementById("reg-lineid").value.trim(); // ไม่บังคับก็ได้
    numberplate= document.getElementById("reg-numberplate").value.trim();
  
    // เช็กชื่อ (ภาษาไทย)
    if (fnameTH === "") {
        swal({
            title: 'กรุณากรอกชื่อ ภาษาไทย',
            type: 'warning',
            showConfirmButton: true,
        });
    }else if (!isAllThai(fnameTH)) {
        swal({
            title: 'กรุณากรอก ชื่อ (ภาษาไทย) ด้วยตัวอักษรภาษาไทยเท่านั้น',
            type: 'warning',
            showConfirmButton: true,
        });
    }else if (lnameTH === "") {
        // เช็กนามสกุล (ภาษาไทย)
        swal({
            title: 'กรุณากรอก นามสกุล (ภาษาไทย)',
            type: 'warning',
            showConfirmButton: true,
        });
    }else if (!isAllThai(lnameTH)) {
        swal({
            title: 'กรุณากรอก นามสกุล (ภาษาไทย) ด้วยตัวอักษรภาษาไทยเท่านั้น',
            type: 'warning',
            showConfirmButton: true,
        });
    }else if (fnameEN === "") {
        // เช็กชื่อ (ภาษาอังกฤษ)
        swal({
            title: 'กรุณากรอก ชื่อ (ภาษาอังกฤษ)',
            type: 'warning',
            showConfirmButton: true,
        });
    }else if (!isEnglishOnly(fnameEN)) {
        swal({
            title: 'กรุณากรอก ชื่อ (ภาษาอังกฤษ) ด้วยตัวอักษรภาษาอังกฤษเท่านั้น',
            type: 'warning',
            showConfirmButton: true,
        });
    }else if (lnameEN === "") {
        swal({
            title: 'กรุณากรอก นามสกุล (ภาษาอังกฤษ)',
            type: 'warning',
            showConfirmButton: true,
        });
    }else if (!isEnglishOnly(lnameEN)) {
        swal({
            title: 'กรุณากรอก นามสกุล (ภาษาอังกฤษ) ด้วยตัวอักษรภาษาอังกฤษเท่านั้น',
            type: 'warning',
            showConfirmButton: true,
        });
    }else if (tel === "") {
        swal({
            title: 'กรุณากรอก เบอร์โทร',
            type: 'warning',
            showConfirmButton: true,
        });
    }else if (numberplate === "") {
        swal({
            title: 'กรุณากรอก ทะเบียนรถ',
            type: 'warning',
            showConfirmButton: true,
        });
    }else if(dv_mem_doc1.files.length == 0){
        swal({
            title: 'กรุณาอัพโหลดสำเนาบัตรประชาชน หรือ ถ่ายรูปบัตรประชาชน',
            type: 'warning',
            showConfirmButton: true,
        });
    }else if(dv_mem_doc2.files.length == 0){
        swal({
            title: 'กรุณาอัพโหลดสำเนาทะเบียนบ้าน หรือ ถ่ายรูปทะเบียนบ้าน',
            type: 'warning',
            showConfirmButton: true,
        });
    }else if(dv_mem_doc3.files.length == 0){
        swal({
            title: 'กรุณาอัพโหลดสำเนาใบขับขี่ หรือ ถ่ายรูปใบขับขี่',
            type: 'warning',
            showConfirmButton: true,
        });
    }else if(dv_mem_doc4.files.length == 0){
        swal({
            title: 'กรุณาอัพโหลดสำเนากรมธรรม์ประกันภัย หรือ ถ่ายรูปกรมธรรม์ประกันภัย',
            type: 'warning',
            showConfirmButton: true,
        });
    }else{
        username = generateUsername();
        showModalAcceptCondition();
    }
  }

  function showModalAcceptCondition()
  {
    //Check Value On Register form
    $('#privacy_policy_modal').modal('show');
    console.log(username);
  }

// ฟังก์ชันสำหรับสร้าง username
function generateUsername() {
    // ดึงค่า input ทั้งสอง
    let username;
    let fname = document.getElementById("reg-fnameEN").value.trim();
    let lname = document.getElementById("reg-lnameEN").value.trim();
  
    // ตรวจสอบว่ามีข้อมูลทั้งสองด้านหรือไม่
    if (fname && lname) {
      // สร้าง username โดยเอาชื่อ + "_" + ตัวอักษรตัวแรกของนามสกุล
      return fname + "_" + lname.charAt(0);
      // กำหนดค่าให้ input username
    }
  }
  