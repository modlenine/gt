<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้าแสดงรายการ งาน [ <?=$description_param?> ]</title>
</head>
<body>
    <div class="main-container">
        <div class="pd-ltr-20">
            <div class="row">
                <div class="col-md-12 form-group">
                    <div class="card-box height-100-p pd-20">
                        <h4 class="text-center">รายการงาน [ <?=$description_param?> ]</h4>
                        <div class="row form-group mt-3">
                        </div>

                        <table id="tbl_request_jobList" class="table table-striped table-bordered" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>เลขที่เอกสาร</th>
                                    <th class="">วันที่</th>
                                    <th class="">ชื่อลูกค้า</th>
                                    <th class="">เบอร์โทร</th>
                                    <th class="">ต้นทาง</th>
                                    <th class="">ปลายทาง</th>
                                    <th class="">ประเภทรถ</th>
                                    <th class="">ยอดเรียกเก็บ</th>
                                    <th class="">สถานะ</th>
                                </tr>
                            </thead>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<script>
    $(document).ready(function(){
        let param = "<?php echo $param; ?>";
        jl_checkExpireTime();

        function loadRequest_jobList()
        {
            let thid = 1;
            $('#tbl_request_jobList thead th').each(function() {
                var title = $(this).text();
                $(this).html(title + ' <input type="text" id="tbl_request_jobList'+thid+'" class="col-search-input" placeholder="Search ' + title + '" />');
                thid++;
            });

            $('#tbl_request_jobList').DataTable().destroy();

            let table = $('#tbl_request_jobList').DataTable({
                        "scrollX": true,
                        "processing": true,
                        "serverSide": true,
                        "stateSave": true,
                        "pageLength":10,
                        stateLoadParams: function(settings, data) {
                            for (let i = 0; i < data.columns["length"]; i++) {
                                let col_search_val = data.columns[i].search.search;
                                if (col_search_val !== "") {
                                    $("input", $("#tbl_request_jobList thead th")[i]).val(col_search_val);
                                }
                            }
                        },
                        "ajax": {
                            "url":url+"backend/drivers/request_job_list/"+param,
                            "type": "POST",
                            "data":function(){
                                // d.filter_formno = filter_formno;
                                // d.filter_status = filter_status;
                                // d.filter_category = filter_category;
                                // d.filter_customer = filter_customer;
                                // d.filter_startDate = filter_startDate;
                                // d.filter_endDate = filter_endDate;
                                // d.filter_invoice = filter_invoice;
                            }
                        },
                        order: [
                            [0, 'desc'],
                        ],
                        columnDefs: [
                            {targets: "_all",orderable: false},
                            {targets: [0],width: "60px",},
                            {targets: [4 , 5],width: "150px",},
                            {targets:[8],width:"150px"}
                        ],
            });

            // $('#tbl_noticeinfo_list tbody').on('click', 'tr', function() {
            //     let data = table.row(this).data();
            //     alert('You clicked on row: ' + data[0]);
            // });

            table.columns().every(function() {
                var table = this;
                $('input', this.header()).on('keyup change', function() {
                    if (table.search() !== this.value) {
                        table.search(this.value).draw();
                    }
                });
            });


            // $('#tbl_prlist4 , #tbl_prlist5 , #tbl_prlist7 , #tbl_prlist10').prop('readonly' , true).css({
            //     'background-color':'#F5F5F5',
            //     'cursor':'no-drop'
            // });
        };

        function jl_checkExpireTime()
        {
            axios.get(url+'backend/drivers/jl_checkExpireTime').then(res=>{
                console.log(res.data);
                loadRequest_jobList();
            });
        }
    });


</script>