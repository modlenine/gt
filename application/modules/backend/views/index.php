<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้าแสดงรายการ เรียกใช้บริการรถ</title>
</head>
<body>
    <div class="main-container">
        <div class="pd-ltr-20">
            <div class="row">
                <div class="col-md-12 form-group">
                    <div class="card-box height-100-p pd-20">
                        <h3>test</h3>
                        <div class="row form-group">
                            <table id="tbl_requestList" class="table table-striped table-bordered" cellspacing="0">
                                <thead>
                                    <tr>
                                        <!-- <th class="td1">Ulid</th> -->
                                        <th>เลขที่เอกสาร</th>
                                        <th class="td2">บริษัท</th>
                                        <th class="td2">เลขที่ PR</th>
                                        <th class="td2">เลขที่ PO</th>
                                        <th class="thItemid">รหัสสินค้า</th>
                                        <th class="td2">จำนวนเงิน</th>
                                        <th class="td2">แผนกที่ร้องขอ</th>
                                        <th class="td3">ผู้ร้องขอ</th>
                                        <th class="td4">วันที่ขอซื้อ</th>
                                        <th class="td5">รหัสผู้ขาย</th>
                                        <th class="td7">ชื่อผู้ขาย</th>
                                        <th class="td7">วันที่ส่งของ</th>
                                        <th class="td7">สถานะ</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<script>
    $(document).ready(function(){
        function loadRequestList()
        {
                // let filter_formno = $('#s-input-byformno').val();
                // let filter_status = $('#s-input-bystatus').val();
                // let filter_category = $('#s-input-bycategory').val();
                // let filter_customer = $('#s-input-bycustomer').val();
                // let filter_startDate = $('#s-input-dateStart').val();
                // let filter_endDate = $('#s-input-dateEnd').val();
                // let filter_invoice = $('#s-input-byinvoice').val();

                let thid = 1;
                $('#tbl_prlist thead th').each(function() {
                    var title = $(this).text();
                    $(this).html(title + ' <input type="text" id="tbl_prlist'+thid+'" class="col-search-input" placeholder="Search ' + title + '" />');
                    thid++;
                });

                $('#tbl_prlist').DataTable().destroy();

            let table = $('#tbl_prlist').DataTable({
                        "scrollX": true,
                        "processing": true,
                        "serverSide": true,
                        "stateSave": true,
                        "pageLength":10,
                        stateLoadParams: function(settings, data) {
                            for (let i = 0; i < data.columns["length"]; i++) {
                                let col_search_val = data.columns[i].search.search;
                                if (col_search_val !== "") {
                                    $("input", $("#tbl_prlist thead th")[i]).val(col_search_val);
                                }
                            }
                        },
                        "ajax": {
                            "url":url+"intsys/purchaseplus/purchaseplus_backend/mainapi/loadprlist",
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
                            {
                            targets: "_all",
                            orderable: false
                            },
                            {
                            targets: [0 , 2 , 3 , 5 , 8,11],
                            width: "60px",
                            },
                            {
                            targets: [1],
                            width: "50px",
                            },
                            {
                            targets: [10],
                            width: "100px",
                            },
                            {
                            targets: [4],
                            width: "200px",
                            // createdCell: function (td) { //td , cellData, rowData, row, col
                            //     $(td).css('font-size', '10px'); // กำหนดฟอนต์สำหรับคอลัมน์ที่กำหนด
                            // }
                            },
                            {
                            targets: [6 , 7 , 9],
                            width: "60px"
                            }
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


            $('#tbl_prlist4 , #tbl_prlist5 , #tbl_prlist7 , #tbl_prlist10').prop('readonly' , true).css({
                'background-color':'#F5F5F5',
                'cursor':'no-drop'
            });
        };
    });
</script>