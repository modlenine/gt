<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้าแสดงรายการ ใบสมัครรถร่วม</title>
</head>
<body>
    <div class="main-container">
        <div class="pd-ltr-20">
            <div class="row">
                <div class="col-md-12 form-group">
                    <div class="card-box height-100-p pd-20">
                        <h3 class="text-center">รายการใบสมัครรถร่วม</h3>
                        <div class="row form-group mt-3">
                        </div>

                        <table id="tbl_registerList" class="table table-striped table-bordered" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>เลขที่เอกสาร</th>
                                    <th class="">วันที่ลงทะเบียน</th>
                                    <th class="">ชื่อ-สกุล</th>
                                    <th class="">เบอร์โทร</th>
                                    <th class="">ทะเบียนรถ</th>
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
        let listtype = "<?php echo $listtype; ?>";
        loadRegisterList(listtype);

        function loadRegisterList(listtype)
        {
            let thid = 1;
            $('#tbl_registerList thead th').each(function() {
                var title = $(this).text();
                $(this).html(title + ' <input type="text" id="tbl_registerList'+thid+'" class="col-search-input" placeholder="Search ' + title + '" />');
                thid++;
            });

            $('#tbl_registerList').DataTable().destroy();

            let table = $('#tbl_registerList').DataTable({
                        "scrollX": true,
                        "processing": true,
                        "serverSide": true,
                        "stateSave": true,
                        "pageLength":10,
                        stateLoadParams: function(settings, data) {
                            for (let i = 0; i < data.columns["length"]; i++) {
                                let col_search_val = data.columns[i].search.search;
                                if (col_search_val !== "") {
                                    $("input", $("#tbl_registerList thead th")[i]).val(col_search_val);
                                }
                            }
                        },
                        "ajax": {
                            "url":url+"backend/admin/load_register_list/"+listtype,
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
                          {targets: [0 , 1 , 2],width: "120px",},
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
    });
</script>