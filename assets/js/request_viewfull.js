$(document).ready(function(){
    let depositePercen = $('#ip-viewfull-depositpercen').val();
    calcPriceDeposit(depositePercen , totalprice);
    if(formstatus == "Open"){
        //code
        $('#btn-approveDoc').css('display' , '');
    }else if(formstatus == "Approved"){
        $('#reqPaySec').css('display' , '');
        $('#btn-approveDoc').css('display' , 'none');
        getDataApproved(formno);
    }else if(formstatus == "Payment Confirmed"){
        //approve section 
        $('#btn-approveDoc').css('display' , 'none');
        getDataApproved(formno);

        //ดึงข้อมูลยืนยันการโอน
        $('#sec_confirmPay_backend').css('display' , '');
        $('#btn-approvePay-backend').css('display' , '');
        getDataConfirmPay(formno);
    }else if(formstatus == "Payment Checked"){
        //approve section 
        $('#btn-approveDoc').css('display' , 'none');
        getDataApproved(formno);

        //ดึงข้อมูลยืนยันการโอน
        $('#sec_confirmPay_backend').css('display' , '');
        $('#btn-approvePay-backend').css('display' , '');
        getDataConfirmPay(formno);

        //ดึงข้อมูลตรวจสอบการโอน
        getDataConfirmPayChecked(formno);
    }

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