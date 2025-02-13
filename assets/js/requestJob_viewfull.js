$(document).ready(function(){
    let depositePercen = $('#ip-viewfullJob-depositpercen').val();
    calcPriceDeposit_job(depositePercen , totalprice);

    //approve section 
    $('#btn-approveDoc').css('display' , 'none');
    getDataApproved_job(formno);

    //ดึงข้อมูลยืนยันการโอน
    $('#sec_confirmPay_backend').css('display' , '');
    $('#btn-approvePay-backend').css('display' , '');
    getDataConfirmPay_job(formno);

    //ดึงข้อมูลตรวจสอบการโอน
    getDataConfirmPayChecked_job(formno);

    
}); //End ready function 


function getDataApproved_job(formno)
{
    if(formno !== ""){
        const formdata = new FormData();
        formdata.append('formno' , formno);
        axios.post(url+'backend/admin/getDataApproved' , formdata).then(res=>{
            console.log(res.data);
            if(res.data.status == "Select Data Success"){
                let result = res.data.result;
                $('#approSecUser').css('display' , '');
                $('#ip-viewfullJob-appro-name').val(result.m_am1_user);
                $('#ip-viewfullJob-appro-datetime').val(result.m_am1_datetime);
                $('#ip-viewfullJob-memo').val(result.m_am1_memo).prop('readonly' , true);
                $('#ip-viewfullJob-deposit').val(result.m_deposit);
                $('#ip-viewfullJob-depositpercen').val(result.m_deposit_percen).prop('disabled', true).css('pointer-events', 'none');
                $("input:radio[name='ip-viewfullJob-appro'][value='" + result.m_am1_approve + "']").prop('checked', true);
                $("input:radio[id='ip-viewfullJob-appro-yes']").attr('onclick','return false');
                $("input:radio[id='ip-viewfullJob-appro-no']").attr('onclick','return false');
            }
        });
    }
}

//Function area
function calcPriceDeposit_job(depositePercen , totalprice)
{
    if(depositePercen !== "" && totalprice !== ""){
        let deposit = 0;
        deposit = (parseFloat(totalprice)*(parseFloat(depositePercen)/100));
        $('#ip-viewfullJob-deposit').val(deposit.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
    }else{
        $('#ip-viewfullJob-deposit').val(0);
    }
    console.log(parseFloat(totalprice));
}

function getDataConfirmPay_job(formno)
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

                $('#ip-viewfullJob-numberPay').val(result.m_userconfirm_money).prop('readonly' , true);

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
                $('#show_file_confirmPay_backend_job').html(imageHtml);
            }
        });
    }
}



function getDataConfirmPayChecked_job(formno)
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
                $('#ip-viewfullJob-appro2-name').val(result.m_am2_user);
                $('#ip-viewfullJob-appro2-datetime').val(result.m_am2_datetime);

                $('#btn-approvePay-backend').css('display' , 'none');
                $('#ip-viewfullJob-memoPay').val(result.m_am2_memo).prop('readonly' , true);
                $("input:radio[name='ip-viewfullJob-approPay'][value='" + result.m_am2_approve + "']").prop('checked', true);
                $("input:radio[id='ip-viewfullJob-approPay-yes']").attr('onclick','return false');
                $("input:radio[id='ip-viewfullJob-approPay-no']").attr('onclick','return false');
            }
        });
    }
}