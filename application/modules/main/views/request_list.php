<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้าแสดงรายการ การเรียกใช้บริการ</title>
</head>
<body>
    <div class="main-container">
		<div class="pd-ltr-20">

            <section id="add_accode_zone">
                <div class="card-box pd-20 height-100-p mb-30">
                    <div class="row align-items-center">
                        <div class="col-md-12 text-center">
                            <h4>รายการของท่าน</h4>
                        </div>
                    </div>

                    <div class="row mt-3 show_request_list">
                       <!-- load request list -->
                    </div>
                </div>
            </section>

		</div>
	</div>
</body>

<script>

    $(document).ready(function(){
        let userId = "<?php echo $this->session->userId; ?>";
        get_requestList();
        function get_requestList()
        {
            if(userId != ""){
                const formdata = new FormData();
                formdata.append('action' , 'get_requestList');
                formdata.append('userId' , userId);
                axios.post(url+'main/get_requestList' , formdata ,{
                    headers:{
                        'Content-Type':'multipart/form-data'
                    }
                }).then(res=>{
                    console.log(res.data);
                    if(res.data.status == "Select Data Success"){
                        let result = res.data.result;
                        let output = ``;
                        for(let key in result){
                            let bdcardColour = 'bg_cardlist';
                            if(result[key].m_status == "Approved"){
                                bdcardColour = 'bg_cardlistApprove';
                            }
                            output += `
                            <div class="col-md-12 form-group reListAttr"
                                data_formno="${result[key].m_formno}"
                                data_userId="${result[key].m_cusid}"
                            >
                                <div class="card card-box ${bdcardColour}">
                                    <div class="card-body">
                                        <h5 class="card-title">รายการเลขที่ : ${result[key].m_formno}</h5>
                                        <p class="card-text">
                                            <b>วันที่เรียกรถ : </b>${result[key].m_datetimecreate}<br>
                                            <b>ต้นทาง : </b>${result[key].m_origininput}<br>
                                            <b>ปลายทาง : </b>${result[key].m_destinationinput}<br>
                                            <b>สถานะ : </b>${result[key].m_status}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            `;
                        }
                        $('.show_request_list').html(output);
                    }
                });
            }
        }

        $(document).on('click' , '.reListAttr' , function(){
            const data_formno = $(this).attr('data_formno');
            const data_userId = $(this).attr('data_userId');

            location.href = url+'main/request_viewfull_page/'+data_formno+'/'+data_userId;
        });
    });
</script>
</html>