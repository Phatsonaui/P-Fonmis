<?php
    $al = $be = $ap = $ac = 0;
    $dbGrpabo = new Database('nurse');
    $dbGrpabo->Table = "proj_list";
    $dbGrpabo->Where = "where project_year = '2024' AND project_status NOT IN ('00') AND project_id <> '14' "; //14 เป็น project_test
    $userGrpabo = $dbGrpabo->Select();
    $cou_pro = count($userGrpabo);
    foreach ($userGrpabo as $valuesGrpabo => $dataGrpabo) { $al++;
        if (in_array($dataGrpabo['project_status'], ['06', '07', '08', '11', '14']) ) {
            $be++;
        }
        if ($dataGrpabo['project_status'] == '09') {
            $ap++;
        }
        if (in_array($dataGrpabo['project_status'], ['12', '16'])) {
            $ac++;
        }
    }
?>
<div class="Header_sub_nu" style="padding-right: 10px;">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <label for="project_Year" class="form-label"><strong>โครงการ <span class="text-danger">*</span></strong></label>
            <ul id="selectableList" class="text-center">
                <li data-date="1" id="all">โครงการทั้งหมด
                    <span class="position-absolute translate-middle badge rounded-pill bg-danger fs-6" id="ac_point" >
                        <?php 
                            if ($al >= 100) {
                                echo "99+";
                            } else if($al == 0) {
                                echo "0";
                            }else{
                                echo $al;
                            }
                        ?>
                        <span class="visually-hidden">unread messages</span>
                    </span>
                </li>
                <li data-date="2" id="being">ไม่ได้รายงานผล
                    <span class="position-absolute translate-middle badge rounded-pill bg-danger fs-6" id="ac_point" >
                        <?php 
                            if ($be >= 100) {
                                echo "99+";
                            } else if($be == 0) {
                                echo "0";
                            }else{
                                echo $be;
                            }
                        ?>
                        <span class="visually-hidden">unread messages</span>
                    </span>
                </li>
                <li data-date="3" id="app">รายงานผล
                    <span class="position-absolute translate-middle badge rounded-pill bg-danger fs-6" id="ac_point" >
                        <?php 
                            if ($ap >= 100) {
                                echo "99+";
                            } else if($ap == 0) {
                                echo "0";
                            }else{
                                echo $ap;
                            }
                        ?>
                        <span class="visually-hidden">unread messages</span>
                    </span>
                </li>
                <li data-date="4" id="not">ไม่อนุมัติ/ยกเลิก
                    <span class="position-absolute translate-middle badge rounded-pill bg-danger fs-6" id="ac_point" >
                        <?php 
                            if ($ac >= 100) {
                                echo "99+";
                            } else if($ac == 0) {
                                echo "0";
                            }else{
                                echo $ac;
                            }
                        ?>
                        <span class="visually-hidden">unread messages</span>
                    </span>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="Header_main_nu d-none">
    <div class="row">
        <div id="tri_pro"></div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        // ดึงค่า stats จาก URL
        var urlParams = new URLSearchParams(window.location.search);
        var stats = urlParams.get('status');
        var year = urlParams.get('year_a');

        if (stats === 'all') {
            $('#all').addClass('active');
            loadProject(1, year);
        }
        if (stats === 'App') {
            $('#being').addClass('active');
            loadProject(2, year);
        }
        if (stats === 'App_re') {
            $('#app').addClass('active');
            loadProject(3, year);
        }
        if (stats === 'Not') {
            $('#not').addClass('active');
            loadProject(4, year);
        }

        $('#selectableList li').on('click', function() {
            $('#selectableList li').removeClass('active');
            $(this).addClass('active');

            var selectedDate = $(this).data('date');
            loadProject(selectedDate, year);
        });

        function loadProject(selectedDate, positions) {
            Swal.fire({
                title: 'กำลังโหลดข้อมูล',
                text: 'กรุณารอสักครู่...',
                icon: 'info',
                allowOutsideClick: false,
                showConfirmButton: false,
                willOpen: () => {
                    Swal.showLoading();
                }
            });
            var startTime = new Date().getTime(); // บันทึกเวลาเริ่มต้น
            $.ajax({
                type: "POST",
                url: 'config/gen_project.php',
                data: {
                    date: selectedDate,
                    position: positions
                },
                success: function(data) {
                    var elapsedTime = new Date().getTime() - startTime; // คำนวณเวลาใช้ไป
                    var remainingTime = Math.max(0, 2000 - elapsedTime); // คำนวณเวลาเหลืออยู่เพื่อให้ครบ 2 วินาที
                    setTimeout(function() {
                        $('.Header_main_nu').removeClass('d-none');
                        Swal.close();
                        $('#tri_pro').html(data);
                        var table = $('#dtBasicExample').DataTable({
                            "lengthMenu": [
                                [10, 10, 25, 50, 100],
                                ["แสดงจำนวนข้อมูล", 10, 25, 50, 100]
                            ],
                            "dom": '<"d-flex justify-content-between align-items-center"l' +
                                '<"select-items"f>' +
                                '>tip',
                            "pagingType": "simple_numbers",
                            "renderer": {
                                "header": "bootstrap",
                                "pageButton": "bootstrap",
                                "number": "num",
                                "paginate": "full_numbers",
                                "sort": "bootstrap",
                                "typeBased": "bootstrap",
                                "display": "bootstrap"
                            },
                            "language": {
                                "searchPlaceholder": "ค้นหา",
                                "lengthMenu": "_MENU_",
                                "paginate": {
                                    "first": "First",
                                    "last": "Last",
                                    "next": "&raquo;",
                                    "previous": "&laquo;"
                                },
                                "info": "แสดงข้อมูลตั้งแต่ _START_ ถึง _END_ จาก _TOTAL_ รายการ ",
                                "infoFiltered": "( โดยมีข้อมูลทั้งหมด _MAX_ รายการ )",
                                "infoEmpty": "ไม่พบข้อมูลในตาราง",
                                "emptyTable": "ไม่พบข้อมูลในตาราง",
                                "zeroRecords": "ไม่พบข้อมูลในตาราง",
                                "loadingRecords": "กำลังโหลด...",
                                "processing": "กำลังประมวลผล",
                                "search": ""
                            },
                            initComplete: function() {
                                $('<input type="text" placeholder="ค้นหา"/>')
                                    .appendTo('div.toolbar')
                                    .on('keyup', function() {
                                        table.search(this.value).draw();
                                    });
                                $('div.toolbar').addClass('d-flex flex-wrap justify-content-between align-items-center mb-3');
                                $('input[type="search"]').addClass('form-control me-2 mb-3');
                            },
                            "drawCallback": function(settings) {
                                $('[data-toggle="tooltip"]').tooltip();
                            }
                        });
                    }, remainingTime); // ปิด SweetAlert หลังจากเวลาที่เหลือ
                },
                error: function() {
                    // ปิด SweetAlert เมื่อเกิดข้อผิดพลาด
                    Swal.close();
                    Swal.fire({
                        title: 'เกิดข้อผิดพลาด',
                        text: 'ไม่สามารถโหลดข้อมูลได้',
                        icon: 'error',
                        confirmButtonText: 'ตกลง'
                    });
                }
            });
        }
    });
</script>