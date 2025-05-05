<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้าแสดงรายการ การตั้งค่าเรทราคา</title>
</head>

<body>

    <div class="modal fade bs-example-modal-lg" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">
                        แก้ไขการตั้งค่าสูตรการคำนวณ
                    </h4>
                </div>
                <div class="modal-body">
                    <div class="row mt-3">
                        <div class="col-md-6 form-group">
                            <label for=""><b>เลือกประเภทรถที่ต้องการตั้งค่า</b></label>
                            <select name="ipe-st-cartype" id="ipe-st-cartype" class="form-control">
                                <option value="">กรุณาเลือกประเภทรถ</option>
                                <option value="type1">รถกระบะคอก</option>
                                <option value="type2">รถกระบะตู้ทึบ</option>
                                <option value="type3">รถกระบะเปลือย</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for=""><b>ตัวคูณของระยะทาง</b></label>
                            <input type="number" name="ipe-st-distance_x" id="ipe-st-distance_x" class="form-control">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for=""><b>อัตราการบริโภคน้ำมัน</b></label>
                            <input type="number" name="ipe-st-fuel_consumption" id="ipe-st-fuel_consumption" class="form-control">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for=""><b>เรทราคาน้ำมัน</b></label>
                            <input type="number" name="ipe-st-fuel_pricerate" id="ipe-st-fuel_pricerate" class="form-control">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for=""><b>อัตราส่วน</b></label>
                            <input type="number" name="ipe-st-ratio_x" id="ipe-st-ratio_x" class="form-control">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for=""><b>เงินบวก</b></label>
                            <input type="number" name="ipe-st-money_plus" id="ipe-st-money_plus" class="form-control">
                        </div>
                    </div>
                </div>
                <input type="text" name="ipe-st-id" id="ipe-st-id" hidden>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                        ปิด
                    </button>
                    <button type="button" class="btn btn-success" id="btn-save-editPricerate">
                        บันทึกการแก้ไข
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="main-container">
        <div class="pd-ltr-20">
            <div class="row">
                <div class="col-md-12 form-group">
                    <div class="card-box height-100-p pd-20">
                        <h3 class="text-center">ยินดีต้อนรับทุกท่าน</h3>
                        <h1 class="text-center">GT Transport Program</h1>
                        <hr>
                        <div class="row form-group">
                            <div class="col-md-12 form-group">
                                <a href="<?php echo base_url('backend/admin/addSettingPriceRate') ?>" type="button" class="btn btn-primary">สร้างรายการ</a>
                            </div>
                        </div>
                        <table id="tbl_pricerateList" class="table table-striped table-bordered" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ประเภทรถ</th>
                                    <th>รายละเอียดสูตรคำนวณ</th>
                                    <th>#</th>
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
    $(document).ready(function () {
        loadPricerateList();

        $(document).on('click' , '.btn-edit' , function(){
                // ดึงค่าจากปุ่ม
            let id = $(this).data('id');
            let cartype = $(this).data('cartype'); // <-- ประเภทรถ type1 / type2 / type3
            let distance_x = $(this).data('distance_x');
            let fuel_consumption = $(this).data('fuel_consumption');
            let fuel_pricerate = $(this).data('fuel_pricerate');
            let ratio_x = $(this).data('ratio_x');
            let money_plus = $(this).data('money_plus');

            // เติมค่าลง input
            $('#ipe-st-id').val(id);
            $('#ipe-st-distance_x').val(distance_x);
            $('#ipe-st-fuel_consumption').val(fuel_consumption);
            $('#ipe-st-fuel_pricerate').val(fuel_pricerate);
            $('#ipe-st-ratio_x').val(ratio_x);
            $('#ipe-st-money_plus').val(money_plus);

            // เติมค่า select
            $('#ipe-st-cartype').val(cartype);

            // เปิด modal
            $('#editModal').modal('show');
        });

        $(document).on('click' , '#btn-save-editPricerate' , function(){
            $('#btn-save-editPricerate').prop('disabled' , true);
            let cartype = $('#ipe-st-cartype').val();
            let distance_x = $('#ipe-st-distance_x').val();
            let fuel_consumption = $('#ipe-st-fuel_consumption').val();
            let fuel_pricerate = $('#ipe-st-fuel_pricerate').val();
            let ratio_x = $('#ipe-st-ratio_x').val();
            let money_plus = $('#ipe-st-money_plus').val();
            let id = $('#ipe-st-id').val();

            // สร้าง Array เช็กช่องที่ไม่ได้กรอก
            let missingFields = [];

            if (cartype === "") missingFields.push("ประเภทรถ");
            if (distance_x === "") missingFields.push("ตัวคูณระยะทาง");
            if (fuel_consumption === "") missingFields.push("อัตราการบริโภคน้ำมัน");
            if (fuel_pricerate === "") missingFields.push("เรทราคาน้ำมัน");
            if (ratio_x === "") missingFields.push("อัตราส่วน");
            if (money_plus === "") missingFields.push("เงินบวก");

            // ถ้ามีช่องที่ไม่กรอก
            if (missingFields.length > 0) {
                swal({
                    title: 'กรุณากรอกข้อมูลให้ครบถ้วน',
                    text: 'ช่องที่ขาด: ' + missingFields.join(', '),
                    type: 'warning',
                    showConfirmButton: true,
                });
                $('#btn-save-editPricerate').prop('disabled' , false);
                return; // ไม่ต้องทำอะไรต่อ
            }

            const formdata = new FormData();
            formdata.append('action', 'saveEditSettingPrice');
            formdata.append('cartype' , cartype);
            formdata.append('distance_x' , distance_x);
            formdata.append('fuel_consumption' , fuel_consumption);
            formdata.append('fuel_pricerate' , fuel_pricerate);
            formdata.append('ratio_x' , ratio_x);
            formdata.append('money_plus' , money_plus);
            formdata.append('id' , id);

            saveEditPricerate(formdata);
        
        });
    });

    function loadPricerateList() {

        let thid = 1;
        $('#tbl_pricerateList thead th').each(function () {
            var title = $(this).text();
            $(this).html(title + ' <input type="text" id="tbl_pricerateList' + thid + '" class="col-search-input" placeholder="Search ' + title + '" />');
            thid++;
        });

        $('#tbl_pricerateList').DataTable().destroy();

        let table = $('#tbl_pricerateList').DataTable({
            "scrollX": true,
            "processing": true,
            "serverSide": true,
            "stateSave": true,
            "pageLength": 10,
            stateLoadParams: function (settings, data) {
                for (let i = 0; i < data.columns["length"]; i++) {
                    let col_search_val = data.columns[i].search.search;
                    if (col_search_val !== "") {
                        $("input", $("#tbl_pricerateList thead th")[i]).val(col_search_val);
                    }
                }
            },
            "ajax": {
                "url": url + "backend/admin/loadPricerateList",
                "type": "POST",
                "data": function () {
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
            columnDefs: [{
                targets: "_all",
                orderable: false
            },
            ],
        });

        // $('#tbl_noticeinfo_list tbody').on('click', 'tr', function() {
        //     let data = table.row(this).data();
        //     alert('You clicked on row: ' + data[0]);
        // });

        table.columns().every(function () {
            var table = this;
            $('input', this.header()).on('keyup change', function () {
                if (table.search() !== this.value) {
                    table.search(this.value).draw();
                }
            });
        });


        // $('#tbl_prlist4 , #tbl_prlist5 , #tbl_prlist7 , #tbl_prlist10').prop('readonly', true).css({
        //     'background-color': '#F5F5F5',
        //     'cursor': 'no-drop'
        // });
    };

    async function saveEditPricerate(formdata)
    {
        try {
            if(formdata){
                let res = await axios.post(url+'backend/admin/saveEditPricerate' , formdata ,{
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                });

                if(res.data.status == "success"){
                    swal({
                        title: 'บันทึกข้อมูลสำเร็จ',
                        type: 'success',
                        showConfirmButton: true,
                    }).then(() => {
                        location.href = url+'backend/admin/setting_pricerate_page'
                    });
                }else{
                    swal({
                        title: 'เกิดข้อผิดพลาด',
                        text: res.data.message || 'ไม่สามารถบันทึกข้อมูลได้',
                        type: 'error',
                        showConfirmButton: true,
                    });
                }
            }
        } catch (error) {
            console.error(error);
            swal({
                title: 'เกิดข้อผิดพลาด',
                text: 'ไม่สามารถบันทึกข้อมูลได้',
                type: 'error',
                showConfirmButton: true,
            });
        }

    }
</script>