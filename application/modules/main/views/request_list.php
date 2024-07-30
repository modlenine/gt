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

                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="card card-box bg_cardlist">
								<div class="card-body">
									<h5 class="card-title">Special title treatment</h5>
									<p class="card-text">
										With supporting text below as a natural lead-in to
										additional content.
									</p>
									<a href="#" class="btn btn-primary">Go somewhere</a>
								</div>
							</div>
                        </div>
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

                        }
                    }
                });
            }
        }
    });
</script>
</html>