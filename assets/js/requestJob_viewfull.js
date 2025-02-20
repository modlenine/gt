$(document).ready(function(){
    //check Status Frist
    console.log(formstatus);
    if(formstatus){
        if(formstatus === "Payment Checked"){
            $('#sec_dv-getjob').css('display' , '');
        }else if(formstatus === "Driver Get Job"){
            getExpireTime(formno);
        }else if(formstatus === "Driver Check In"){
            getCheckInData();
            $('#sec_dv-checkInAlready').css('display','');
            $('#sec-dv_beforeStart').css('display' , '');
        }
    }


    $('#btn_dv-getjob').click(()=>{
        getJob(formno);
    });

    //Checkin
    $('#btn_dv-checkin').click(()=>{
        checkinDriver();
    });


}); //End ready function 

//function zone 
function getJob(formno)
{
    if(formno){
        const formdata = new FormData();
        formdata.append('formno' , formno);
        axios.post(url+'backend/drivers/getJob' , formdata).then(res=>{
            console.log(res.data);
            if(res.data.status == "Update Data Success"){
                swal({
                    title: 'รับงานสำเร็จ คุณมีเวลา 40 นาที',
                    type: 'success',
                    showConfirmButton: false,
                    timer:1500
                }).then(()=>{
                    location.reload();
                    getExpireTime(formno);
                });
            }
        });
    }
}

function getExpireTime(formno)
{
    if(formno){
        const formdata = new FormData();
        formdata.append("formno" , formno);
        axios.post(url+'backend/drivers/getExpireTime' , formdata).then(res=>{
            console.log(res.data);
            if(res.data.status == "Select Data Success"){
                let result = res.data.result;
                $('#sec_dv-getjob').css('display' , 'none');
                $('#sec_dv-getjob-already').css('display' , '');
                startCountdown(result.m_dv_timeexpire_getjob);

                if(driverUsername == result.m_dv_user_getjob){
                    $('#sec_dv-checkIn').css('display' , '');
                }else{
                    $('#sec_dv-checkIn').css('display' , 'none');
                }
            }
        });
    }
}

function startCountdown(expiryTime) {
    let countdownElement = document.getElementById("show_expireTime");
    let countdownInterval;

    function updateCountdown() {
        let now = Math.floor(Date.now() / 1000); // เวลาปัจจุบัน (timestamp)
        let timeLeft = expiryTime - now; // คำนวณเวลาที่เหลือ

        if (timeLeft > 0) {
            let minutes = Math.floor(timeLeft / 60);
            let seconds = timeLeft % 60;
            countdownElement.innerHTML = `เหลือเวลา: ${minutes} นาที ${seconds} วินาที`;
        } else {
            countdownElement.innerHTML = "⏳ หมดเวลาเช็กอินแล้ว!";
            clearInterval(countdownInterval);
            getJobTimeout(formno);
        }
    }

    updateCountdown();
    countdownInterval = setInterval(updateCountdown, 1000);
}

function getJobTimeout(formno)
{
    if(formno){
        const formdata = new FormData();
        formdata.append("formno" , formno);
        axios.post(url+'backend/drivers/getJobTimeout' , formdata).then(res=>{
            console.log(res.data);
            if(res.data.status == "Update Data Success"){
                $('#sec_dv-getjob').css('display' , '');
                $('#sec_dv-getjob-already').css('display' , 'none');
                $('#sec_dv-checkIn').css('display' , 'none');
                location.reload();
            }
        });
    }
}


