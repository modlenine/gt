$(document).ready(function(){
    let depositePercen = $('#ip-viewfull-depositpercen').val();
    calcPriceDeposit(depositePercen , totalprice);
    if(formstatus == "Open"){
        //code
        $('#btn-approveDoc').css('display' , '');
    }else if(formstatus == "Approved"){
        $('#btn-approveDoc').css('display' , 'none');
        getDataApproved(formno);
    }

    $('#ip-viewfull-depositpercen').change(function(){
        calcPriceDeposit($(this).val() , totalprice);
    });

    $('#btn-approveDoc').click(function(){
        $('#btn-approveDoc').prop('disabled' , true);
        swal({
            title: 'ยืนยันการอนุมัติรายการใช่หรือไม่',
            type: 'warning',
            showCancelButton: true,
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            confirmButtonText: 'ยืนยัน',
            cancelButtonText:'ยกเลิก'
        }).then((result)=> {
            $('#btn-approveDoc').prop('disabled' , false);
            if(result.value == true){
                const formdata = new FormData();
                formdata.append('formno' , formno);
                formdata.append('depositpercen' , $('#ip-viewfull-depositpercen').val());
                formdata.append('deposit' , $('#ip-viewfull-deposit').val());
                formdata.append('memo' , $('#ip-viewfull-memo').val());
                formdata.append('m_am1_approve' , $("input:radio[name='ip-viewfull-appro']:checked").val());

                axios.post(url+'backend/admin/saveApproveDoc' , formdata).then(res=>{
                    console.log(res.data);
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
    });


    
});


function getDataApproved(formno)
{
    if(formno !== ""){
        const formdata = new FormData();
        formdata.append('formno' , formno);
        axios.post(url+'backend/admin/getDataApproved' , formdata).then(res=>{
            console.log(res.data);
            if(res.data.status == "Select Data Success"){
                let result = res.data.result;
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
}