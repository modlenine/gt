$(document).ready(() => {
    $("#btn_saveSettingPrice").click(function () {
        // ดึงค่าจากฟอร์ม
        $('#btn_saveSettingPrice').prop('disabled' , true);
        let cartype = $('#ip-st-cartype').val();
        let distance_x = $('#ip-st-distance_x').val();
        let fuel_consumption = $('#ip-st-fuel_consumption').val();
        let fuel_pricerate = $('#ip-st-fuel_pricerate').val();
        let ratio_x = $('#ip-st-ratio_x').val();
        let money_plus = $('#ip-st-money_plus').val();

        // สร้าง Array เช็กช่องที่ไม่ได้กรอก
        let missingFields = [];

        if (cartype === "") missingFields.push("ประเภทรถ");
        if (distance_x === "") missingFields.push("ตัวคูณระยะทาง");
        if (fuel_consumption === "") missingFields.push("อัตราการบริโภคน้ำมัน");
        if (fuel_pricerate === "") missingFields.push("เรทราคาน้ำมัน");
        if (ratio_x === "") missingFields.push("อัตราส่วน");
        if (money_plus === "") missingFields.push("เงินบวก");

        // ถ้ามีช่องที่ไม่กรอก
        if (missingFields.length > 0) {
            swal({
                title: 'กรุณากรอกข้อมูลให้ครบถ้วน',
                text: 'ช่องที่ขาด: ' + missingFields.join(', '),
                type: 'warning',
                showConfirmButton: true,
            });
            $('#btn_saveSettingPrice').prop('disabled' , false);
            return; // ไม่ต้องทำอะไรต่อ
        }

        // ถ้าครบแล้ว ทำ FormData + ส่ง axios ต่อ
        let formData = new FormData();
        formData.append('action', 'saveSettingPrice');
        formData.append('cartype', cartype);
        formData.append('distance_x', distance_x);
        formData.append('fuel_consumption', fuel_consumption);
        formData.append('fuel_pricerate', fuel_pricerate);
        formData.append('ratio_x', ratio_x);
        formData.append('money_plus', money_plus);

        axios.post(url + 'backend/admin/saveSettingPrice', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
            .then(function (response) {
                $('#btn_saveSettingPrice').prop('disabled' , false);
                if (response.data.status === 'success') {
                    swal({
                        title: 'บันทึกข้อมูลสำเร็จ',
                        type: 'success',
                        showConfirmButton: true,
                    }).then(() => {
                        location.href = url+'backend/admin/setting_pricerate_page'
                    });
                } else {
                    swal({
                        title: 'เกิดข้อผิดพลาด',
                        text: response.data.message || 'ไม่สามารถบันทึกข้อมูลได้',
                        type: 'error',
                        showConfirmButton: true,
                    });
                }
            })
            .catch(function (error) {
                console.error('Error:', error);
                swal({
                    title: 'ข้อผิดพลาดในการเชื่อมต่อ',
                    text: 'กรุณาตรวจสอบการเชื่อมต่ออินเทอร์เน็ตหรือ Server',
                    type: 'error',
                    showConfirmButton: true,
                });
            });
    });

});