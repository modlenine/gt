$(document).ready(function(){
    //code
    deleteTempfileFrist(userid);

    //check form status frist
    if(formstatus == "Open"){
        //code
        let statusText = `รายการอยู่ระหว่างตรวจสอบจากเจ้าหน้าที่`;
        $('#statusForUserText').html(statusText);
    }else if(formstatus == "Approved"){
        $('.sec_waitConfirm').css('display' , '');
        $('#reqPaySec').css('display' , '');
    }else if(formstatus == "Payment Confirmed"){
        $('.sec_waitConfirm').css('display' , 'none');
        getDataConfirmPay(formno);
        let statusText = `ยืนยันการโอนเงินสำเร็จ เจ้าหน้าที่กำลังตรวจสอบข้อมูล`;
        $('#statusForUserText').html(statusText);
    }else if(formstatus == "Payment Checked"){
        $('.sec_waitConfirm').css('display' , 'none');
        getDataConfirmPay(formno);
        let statusText = `เจ้าหน้าที่ตรวจสอบข้อมูลเรียบร้อยแล้ว กำลังติดต่อคนขับรถเพื่อรับงานของท่าน`;
        $('#statusForUserText').html(statusText);
    }

    $('#btn_confirmPay').on("click" , function (){
        if(myDropzone1.files.length == 0){
            swal({
                title: 'กรุณาอัพโหลดไฟล์หลักฐานการโอนเงิน',
                type: 'error',
                showConfirmButton: true,
            });
        }else if($('#ip-confirmNumPay').val() == ""){
            swal({
                title: 'กรุณาระบุจำนวนเงิน',
                type: 'error',
                showConfirmButton: true,
            });
        }else{
            saveConfirmPay(formno , userid);
        }
    });
});

function deleteTempfileFrist(userid)
{
    if(userid)
    {
        const formdata = new FormData();
        formdata.append('userid' , userid);

        axios.post(url+'main/removeTempFile_byuser' , formdata).then(res=>{
            console.log(res.data);
        });
    }
}

function saveConfirmPay(formno , userid)
{
    if(formno != "" && userid != "" && $('#ip-confirmNumPay').val() != ""){
        $('#btn_confirmPay').prop('disabled' , true);
        const formdata = new FormData();
        formdata.append('formno' , formno);
        formdata.append('userid' , userid);
        formdata.append('confirmNumPay' , $('#ip-confirmNumPay').val());
        axios.post(url+'main/saveConfirmPay' , formdata).then(res=>{
            console.log(res.data);
            $('#btn_confirmPay').prop('disabled' , false);
            if(res.data.status == "Update Data Success"){
                swal({
                    title: 'ส่งข้อมูลยืนยันการโอนเงินสำเร็จ',
                    type: 'success',
                    showConfirmButton: false,
                    timer:1500
                }).then(()=>{
                    location.reload();
                });
            }
        });
    }
}

function getDataConfirmPay(formno)
{
    if(formno){
        const formdata = new FormData()
        formdata.append('formno' , formno);
        axios.post(url+'main/getDataConfirmPay' , formdata).then(res=>{
            console.log(res.data);
            if(res.data.status == "Select Data Success"){
                //
                let result = res.data.result;
                let resultFile = res.data.resultFile;

                $('#ip-confirmNumPay').val(result.m_userconfirm_money).prop('readonly' , true);

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
                $('#show_file_confirmPay').html(imageHtml);
            }
        });
    }
}


