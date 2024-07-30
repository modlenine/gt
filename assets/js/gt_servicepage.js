$(document).ready(function(){

    let cartypeRate = 0;
    let namecarType = '';
    let personNameD1 , personNameD2 , personNameE1 , personNameE2 = '';
    let htmlsumPerson = '';
    let htmlsumPersonD1 = '';
    let htmlsumPersonD2 = '';
    let htmlsumPersonE1 = '';
    let htmlsumPersonE2 = '';
    let price = 0;
    let personNameD1Price = 0; 
    let personNameD2Price = 0;
    let personNameE1Price = 0;
    let personNameE2Price = 0;

    $('#btn-saverequest').prop('disabled' , true);

    $("input:radio[name='input-choosecar']").change(function(){
        //Clear calc value
        $('#input-sum-sumpriceBeforeVat').val('');
        $('#input-sum-personPrice').val('');
        $('#input-sum-sumpriceCarDistance').val('');

        if($("input:radio[name='input-choosecar']:checked").val() == "type3" || $("input:radio[name='input-choosecar']:checked").val() == "type4"){
            $('#choosePerson').css('display' , '');
        }else{
            $('#choosePerson').css('display' , 'none');
        }

        if($("input:radio[name='input-choosecar']:checked").length > 0){
            if($("input:radio[name='input-choosecar']:checked").val() == "type1"){
                cartypeRate = 10;
                namecarType = 'รถมอเตอร์ไซต์';
            }else if($("input:radio[name='input-choosecar']:checked").val() == "type2"){
                cartypeRate = 22;
                namecarType = 'รถเก๋ง';
            }else if($("input:radio[name='input-choosecar']:checked").val() == "type3"){
                cartypeRate = 25;
                namecarType = 'รถกระบะแคปเปลือย';
            }else if($("input:radio[name='input-choosecar']:checked").val() == "type4"){
                cartypeRate = 27;
                namecarType = 'รถกระบะตอนเดียวมีหลังคา';
            }
            $('#input-sum-cartype').val(namecarType);
        }
    });

    $("#input-person-typeD1").change(function(){
         //Clear calc value
         $('#input-sum-sumpriceBeforeVat').val('');
         $('#input-sum-personPrice').val('');
         $('#input-sum-sumpriceCarDistance').val('');
        personNameD1 = '';
        if($(this).val() != 0){
            personNameD1Price = 203 * parseFloat($(this).val());
            personNameD1 = 'เลือกคนขับยกของ ประเภทที่ 1 จำนวน '+$(this).val()+' คน';
            htmlsumPersonD1 = `
            <p>${personNameD1}</p>
            `;
        }else{
            htmlsumPersonD1 = '';
            personNameD1 = '';
            personNameD1Price = 0;
        }
    });

    $("#input-person-typeD2").change(function(){
         //Clear calc value
         $('#input-sum-sumpriceBeforeVat').val('');
         $('#input-sum-personPrice').val('');
         $('#input-sum-sumpriceCarDistance').val('');
        personNameD2 = '';
        if($(this).val() != 0){
            personNameD2Price = 309 * parseFloat($(this).val());
            personNameD2 = 'เลือกคนขับยกของ ประเภทที่ 2 จำนวน '+$(this).val()+' คน';
            htmlsumPersonD2 = `
            <p>${personNameD2}</p>
            `;
        }else{
            htmlsumPersonD2 = '';
            personNameD2 = '';
            personNameD2Price = 0;
        }
    });

    $("#input-person-typeE1").change(function(){
         //Clear calc value
         $('#input-sum-sumpriceBeforeVat').val('');
         $('#input-sum-personPrice').val('');
         $('#input-sum-sumpriceCarDistance').val('');
        personNameE1 = '';
        if($(this).val() != 0){
            personNameE1Price = 309 * parseFloat($(this).val());
            personNameE1 = 'เลือกพนักงานยกของ ประเภทที่ 1 จำนวน '+$(this).val()+' คน';
            htmlsumPersonE1 = `
            <p>${personNameE1}</p>
            `;
        }else{
            htmlsumPersonE1 = '';
            personNameE1 = '';
            personNameE1Price = 0;
        }
    });

    $("#input-person-typeE2").change(function(){
         //Clear calc value
         $('#input-sum-sumpriceBeforeVat').val('');
         $('#input-sum-personPrice').val('');
         $('#input-sum-sumpriceCarDistance').val('');
        personNameE2 = '';
        if($(this).val() != 0){
            personNameE2Price = 309 * parseFloat($(this).val());
            personNameE2 = 'เลือกพนักงานยกของ ประเภทที่ 2 จำนวน '+$(this).val()+' คน';
            htmlsumPersonE2 = `
            <p>${personNameE2}</p>
            `;
        }else{
            htmlsumPersonE2 = '';
            personNameE2 = '';
            personNameE2Price = 0;
        }
    });

    $('#btn-reset').click(function(){
        location.reload();
    });

    $('#btn-calculate').click(function(){
        let sumPersonPrice = 0;
        if(distance == ""){
            swal({
                title: 'กรุณาเลือกต้นทางและปลายทางก่อนค่ะ',
                type: 'warning',
                showConfirmButton: true,
            });
        }else{
            htmlsumPerson = htmlsumPersonD1+htmlsumPersonD2+htmlsumPersonE1+htmlsumPersonE2;
            $('#input-sum-person').html(htmlsumPerson);
            $('#input-sum-distance').val(distance);

            sumPersonPrice = personNameD1Price + personNameD2Price + personNameE1Price + personNameE2Price;
            $('#input-sum-personPrice').val(sumPersonPrice);

            price = (parseFloat(distance) * parseFloat(cartypeRate))/distanceRate;
            let priceBeforeVat = sumPersonPrice + price;
            let priceWithVat = (parseFloat(priceBeforeVat)*3) / 100;
            priceWithVat = priceWithVat+priceBeforeVat;


            $('#input-sum-sumprice').val(formatPrice(priceWithVat));
            $('#input-sum-sumpriceBeforeVat').val(formatPrice(priceBeforeVat));
            $('#input-sum-sumpriceCarDistance').val(formatPrice(price));
        }
    });

    function formatPrice(value) {
        return parseFloat(value).toFixed(0).replace(/\d(?=(\d{3})+\.)/g, '$&,');
    }

    $('#input-accept').change(function(){
        if($('input[name="input-accept"]:checked').length > 0){
            $('#btn-saverequest').prop('disabled' , false);
        }else{
            $('#btn-saverequest').prop('disabled' , true);
        }
    });

    $('#btn-saverequest').click(function(){
        if($('input[name="input-choosecar"]:checked').length == 0){
            swal({
                title: 'กรุณาเลือกประเภทของรถ',
                type: 'warning',
                showConfirmButton: true,
            });
        }else if($('#originInput').val() == ""){
            swal({
                title: 'กรุณาเลือกสถานที่ต้นทาง',
                type: 'warning',
                showConfirmButton: true,
            });
        }else if($('#destinationInput').val() == ""){
            swal({
                title: 'กรุณาเลือกสถานที่ปลายทาง',
                type: 'warning',
                showConfirmButton: true,
            });
        }else if($('#input-distance').val() == ""){
            swal({
                title: 'กรุณากดคำนวณระยะทาง',
                type: 'warning',
                showConfirmButton: true,
            });
        }else if($('#input-sum-sumpriceCarDistance').val() == ""){
            swal({
                title: 'กรุณากดคำนวณค่าใช้จ่าย',
                type: 'warning',
                showConfirmButton: true,
            });
        }else if($('#input-sum-personPrice').val() == ""){
            swal({
                title: 'กรุณากดคำนวณค่าใช้จ่าย',
                type: 'warning',
                showConfirmButton: true,
            });
        }else if($('#input-sum-sumpriceBeforeVat').val() == ""){
            swal({
                title: 'กรุณากดคำนวณค่าใช้จ่าย',
                type: 'warning',
                showConfirmButton: true,
            });
        }else if($('#input-sum-sumprice').val() == ""){
            swal({
                title: 'กรุณากดคำนวณค่าใช้จ่าย',
                type: 'warning',
                showConfirmButton: true,
            });
        }else{
            $('#btn-saverequest').prop('disabled' , true);
            const formdata = new FormData();
            formdata.append('origininput' , $('#originInput').val());
            formdata.append('destinationinput' , $('#destinationInput').val());
            formdata.append('cartype' , $('#input-sum-cartype').val());
            formdata.append('distance' , $('#input-sum-distance').val());
            formdata.append('sumpricecardistance' , $('#input-sum-sumpriceCarDistance').val());
            formdata.append('persontyped1' , $('#input-person-typeD1').val());
            formdata.append('persontyped2' , $('#input-person-typeD2').val());
            formdata.append('persontypee1' , $('#input-person-typeE1').val());
            formdata.append('persontypee2' , $('#input-person-typeE2').val());
            formdata.append('personsumprice' , $('#input-sum-personPrice').val());
            formdata.append('totalprice' , $('#input-sum-sumpriceBeforeVat').val());
            formdata.append('action' , 'sendtoapprove');

            axios.post(url+'main/saveSendtoApprove' , formdata , {
                headers:{
                    'Content-Type':'multipart/formdata'
                }
            }).then(res=>{
                console.log(res.data);
                $('#btn-saverequest').prop('disabled' , false);
                if(res.data.status == "Insert Data Success"){
                    swal({
                        title: 'บันทึกข้อมูลสำเร็จ',
                        type: 'success',
                        showConfirmButton: true,
                    }).then(function(){
                        location.href = url+'main/requestList';
                    });
                }
            });
        }
    });

    
});