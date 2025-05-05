$(document).ready(function () {

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

    $('#btn-saverequest').prop('disabled', true);

    $("input:radio[name='input-choosecar']").change(function () {
        // Clear calculated values
        $('#input-sum-sumpriceBeforeVat, #input-sum-personPrice, #input-sum-sumpriceCarDistance').val('');

        carTypeValue = $("input:radio[name='input-choosecar']:checked").val();
        carTypes = {
            type1: 'รถกระบะคอก',
            type2: 'รถกระบะตู้ทึบ',
            type3: 'รถกระบะเปลือย'
        };

        // Show or hide "เลือกพนักงานยกของ" section
        $('#choosePerson').toggle(carTypeValue === 'type1' || carTypeValue === 'type2' || carTypeValue === 'type3');

        // Set car type name if exists
        if (carTypes[carTypeValue]) {
            $('#input-sum-cartype').val(carTypes[carTypeValue]);
        } else {
            $('#input-sum-cartype').val('');
        }
    });

    // ฟังก์ชันสำหรับ clear ค่า
    function clearSumPrice() {
        $('#input-sum-sumpriceBeforeVat, #input-sum-personPrice, #input-sum-sumpriceCarDistance').val('');
    }

    function handlePersonChange(type, value) {
        clearSumPrice();
        if (parseFloat(value) !== 0) {
            personPrice[type] = pricePerPerson[type] * parseFloat(value);
            htmlsumPerson[type] = `<p>เลือกคนยกของประเภทที่ ${type.slice(-1)} จำนวน ${value} คน (${personPrice[type]} บาท)</p>`;
        } else {
            personPrice[type] = 0;
            htmlsumPerson[type] = '';
        }

        updatePersonSummary(); // <<< อัปเดตผลแสดงผล
    }

    // เชื่อม event ทุกตัว
    ["type1", "type2", "type3"].forEach(type => {
        $(`#input-person-${type}`).change(function () {
            handlePersonChange(type, $(this).val());
        });
    });

    function updatePersonSummary() {
        const summary = htmlsumPerson.type1 + htmlsumPerson.type2 + htmlsumPerson.type3;
        if (summary) {
            $('#input-sum-person').html(summary);
            // รวมราคาของทุกประเภท
            const totalPersonPrice = (personPrice.type1 || 0) + (personPrice.type2 || 0) + (personPrice.type3 || 0);
            $('#input-sum-personPrice').val(totalPersonPrice.toFixed(2)); // ใส่เป็นเลขทศนิยม 2 ตำแหน่ง
        } else {
            $('#input-sum-person').html('<b>-</b>');
            $('#input-sum-personPrice').val('');
        }
    }


    $('#btn-reset').click(function () {
        location.reload();
    });

    $('#btn-calculate').click(function () {
        // check ว่าลูกค้าเลือกต้นทางหรือ ปลายทางแล้วหรือไม่
        if ($('#input-sum-cartype').val() == "") {
            swal({
                title: 'กรุณาเลือกประเภทของรถ',
                type: 'warning',
                showConfirmButton: true,
            });
        } else if ($('#input-sum-distance').val() == "") {
            swal({
                title: 'กรุณาเลือกต้นทางและปลายทางจากนั้นกดคำนวณเส้นทาง',
                type: 'warning',
                showConfirmButton: true,
            });
        } else {
            //code
        }
    });

    function formatPrice(value) {
        return parseFloat(value).toFixed(0).replace(/\d(?=(\d{3})+\.)/g, '$&,');
    }

    $('#input-accept').change(function () {
        if ($('input[name="input-accept"]:checked').length > 0) {
            if ($('#input-sum-sumpriceBeforeVat').val() == "") {
                swal({
                    title: 'กรุณากดปุ่มคำนวณค่าใช้จ่าย',
                    type: 'warning',
                    showConfirmButton: true,
                });
                $('input[name="input-accept"]').prop('checked', false);
            } else {
                $('#btn-saverequest').prop('disabled', false);
            }
        } else {
            $('#btn-saverequest').prop('disabled', true);
        }
    });

    $('#btn-saverequest').click(function () {
        if ($('input[name="input-choosecar"]:checked').length == 0) {
            swal({
                title: 'กรุณาเลือกประเภทของรถ',
                type: 'warning',
                showConfirmButton: true,
            });
        } else if ($('#originInput').val() == "") {
            swal({
                title: 'กรุณาเลือกสถานที่ต้นทาง',
                type: 'warning',
                showConfirmButton: true,
            });
        } else if ($('#destinationInput').val() == "") {
            swal({
                title: 'กรุณาเลือกสถานที่ปลายทาง',
                type: 'warning',
                showConfirmButton: true,
            });
        } else if ($('#input-distance').val() == "") {
            swal({
                title: 'กรุณากดคำนวณระยะทาง',
                type: 'warning',
                showConfirmButton: true,
            });
        } else if ($('#input-sum-sumpriceCarDistance').val() == "") {
            swal({
                title: 'กรุณากดคำนวณค่าใช้จ่าย',
                type: 'warning',
                showConfirmButton: true,
            });
        } else if ($('#input-sum-personPrice').val() == "") {
            swal({
                title: 'กรุณากดคำนวณค่าใช้จ่าย',
                type: 'warning',
                showConfirmButton: true,
            });
        } else if ($('#input-sum-sumpriceBeforeVat').val() == "") {
            swal({
                title: 'กรุณากดคำนวณค่าใช้จ่าย',
                type: 'warning',
                showConfirmButton: true,
            });
        } else if ($('#input-sum-sumprice').val() == "") {
            swal({
                title: 'กรุณากดคำนวณค่าใช้จ่าย',
                type: 'warning',
                showConfirmButton: true,
            });
        } else {
            $('#btn-saverequest').prop('disabled', true);
            const formdata = new FormData();
            formdata.append('origininput', $('#originInput').val());
            formdata.append('destinationinput', $('#destinationInput').val());
            formdata.append('cartype', $('#input-sum-cartype').val());
            formdata.append('distance', $('#input-sum-distance').val());
            formdata.append('sumpricecardistance', $('#input-sum-sumpriceCarDistance').val());
            formdata.append('persontyped1', $('#input-person-typeD1').val());
            formdata.append('persontyped2', $('#input-person-typeD2').val());
            formdata.append('persontypee1', $('#input-person-typeE1').val());
            formdata.append('persontypee2', $('#input-person-typeE2').val());
            formdata.append('personsumprice', $('#input-sum-personPrice').val());
            formdata.append('totalprice', $('#input-sum-sumpriceBeforeVat').val());
            formdata.append('action', 'sendtoapprove');

            axios.post(url + 'main/saveSendtoApprove', formdata, {
                headers: {
                    'Content-Type': 'multipart/formdata'
                }
            }).then(res => {
                console.log(res.data);
                $('#btn-saverequest').prop('disabled', false);
                if (res.data.status == "Insert Data Success") {
                    swal({
                        title: 'บันทึกข้อมูลสำเร็จ',
                        type: 'success',
                        showConfirmButton: true,
                    }).then(function () {
                        location.href = url + 'main/requestList';
                    });
                }
            });
        }
    });


});