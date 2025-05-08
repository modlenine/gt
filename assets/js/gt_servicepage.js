$(document).ready(function () {

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


    $('#btn-reset').click(function () {
        location.reload();
    });

    function formatPrice(value) {
        return parseFloat(value).toFixed(0).replace(/\d(?=(\d{3})+\.)/g, '$&,');
    }

    $('#input-accept').change(function () {
        if ($('input[name="input-accept"]:checked').length > 0) {
            if ($('#input-sum-sumpriceBeforeVat').val() == "") {
                swal({
                    title: 'กรุณากดปุ่มคำนวณเส้นทาง',
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
        saveRequestCar();
    });

    async function saveRequestCar()
    {
        $('#btn-saverequest').prop('disabled', true);
        const formdata = new FormData();
        formdata.append('origininput', $('#originInput').val());
        formdata.append('destinationinput', $('#destinationInput').val());
        formdata.append('cartype', $('#input-sum-cartype').val());
        formdata.append('cartypeValue' , carTypeValue);
        formdata.append('distance', parseFloat(distance));
        formdata.append('sumpricecardistance', priceCarDistance);
        formdata.append('m_person_type1', $('#input-person-type1').val());
        formdata.append('m_person_type2', $('#input-person-type2').val());
        formdata.append('m_person_type3', $('#input-person-type3').val());
        formdata.append('personsumprice', pricePersonSum);
        formdata.append('totalprice', totalSum);
        formdata.append('distanceX' , distanceX);
        formdata.append('fuelConsumption' , fuelConsumption);
        formdata.append('fuelPriceRate' , fuelPriceRate);
        formdata.append('ratioX' , ratioX);
        formdata.append('moneyPlus' , moneyPlus);
        formdata.append('action', 'sendtoapprove');

        const res  = await axios.post(url + 'main/saveSendtoApprove', formdata, {
            headers: {
                'Content-Type': 'multipart/formdata'
            }
        });
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
        }else{
            swal({
                title: 'บันทึกข้อมูลไม่สำเร็จ',
                type: 'error',
                showConfirmButton: true,
            })
        }
    }


});