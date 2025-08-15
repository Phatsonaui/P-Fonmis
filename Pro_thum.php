<script src="https://cdn.jsdelivr.net/npm/echarts@5.5.1/dist/echarts.min.js"></script>
<style>
    .project-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 10px;
    }

    .content-card {
        display: grid;
        grid-template-columns: repeat(4, minmax(150px, 1fr));
        gap: 10px;
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .content-card_re {
        display: grid;
        grid-template-columns: repeat(1, minmax(150px, 1fr));
        gap: 10px;
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .content-card_plan {
        display: grid;
        grid-template-columns: repeat(2, minmax(150px, 1fr));
        gap: 10px;
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .card-body {
        height: 100%;

        .row {
            height: 100%;

            .d-flex {
                align-items: center;
            }
        }
    }

    .Header_main_nu {
        background: #f8f8f8;
        margin-top: 3rem;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        height: 100%;
        border: solid 1px #d0d0d0;
    }

    .kpi-card {
        background: #f8f8f8;
        /* rgb(216 214 214); */
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        /* 11px 12px 7px rgba(0, 0, 0, 0.15); */
        height: 100%;
        border: solid 1px #d0d0d0;
    }

    .kpi-card>h2 {
        padding: 1.5rem;
    }

    .kpi-card>.card-body p,
    h1,
    p {
        font-weight: 700;
        margin: 0;
    }

    .kpi-data {
        display: flex;
        justify-content: center;
        align-items: baseline;
        gap: 10px;
    }

    .kpi-value {
        font-size: 2rem;
        font-weight: bold;
    }

    .kpi-label {
        font-size: 0.9rem;
    }

    .container-core {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }

    .card-core {
        flex: 1 1 300px;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        background-color: #f9f9f9;
    }

    .number-core {
        font-size: 2em;
        text-align: center;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .header-core {
        background-color: #ff9b69;
        color: #fff;
        padding: 10px;
        text-align: center;
        font-weight: bold;
        border-radius: 4px;
        margin-bottom: 15px;
    }

    .list-item-core {
        display: flex;
        justify-content: space-between;
        padding: 8px;
        font-size: 1rem;
        border-bottom: 1px solid #d0d0d0;
    }

    .list-item-core:nth-child(2) {
        background-color: #d0d0d0;
    }

    .list-item-core:last-child {
        border-bottom: none;
    }

    .badge-count {
        font-weight: bold;
    }

    .rounded-full {
        border-radius: 9999px;
        width: 20px;
        /* กำหนดขนาด*/
        height: 13px;
        border: solid 1px #D0D0FF;
    }

    .success-full {
        background-color: rgb(34, 197, 94);
    }

    .warning-full {
        background-color: rgb(234 179 8);
    }

    .danger-full {
        background-color: rgb(239 68 68);
    }

    .default-full {
        background-color: rgb(107 114 128);
    }

    .flex-container-rounded {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .bgg-primary {
        background-color: #c1602f;
    }

    .bgg-success {
        background-color: #ec7032;
    }

    .bgg-danger {
        background-color: #ff9b69;
    }

    .bgg-warning {
        background-color: #162339;
    }

    .bgg-info {
        background-color: #50514f;
    }

    @media all and (max-width: 572px) {
        .content-card {
            grid-template-columns: repeat(2, minmax(150px, 1fr));

            .kpi-card {
                padding: 30px;
            }
        }

        .content-card_plan {
            grid-template-columns: repeat(1, minmax(150px, 1fr));

            .kpi-card {
                padding: 30px;
            }
        }
    }
</style>
<div class="container-fluid pb-4" style=" color: #000000; background-color:#d8d6d6;">
    <div class="row g-3 mt-2">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="Page.php" style="color: #fff;">Home</a></li>
                <li class="breadcrumb-item active" id="activet" aria-current="page">การทำนุศิลปะและวัฒนธรรม</li>
            </ol>
        </nav>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12 mt-5">
            <div class="kpi-card">
                <div class="flex-container-rounded">
                    <h1 style="font-weight: 700;">สรุปภาพรวมการทำนุศิลปะและวัฒนธรรม</h1>
                    <div class="col-md-3">
                        <label for="project_Year" class="form-label"><strong>ประจำปีงบประมาณ <span class="text-danger">*</span></strong></label>
                        <?php
                        $dbuni = new Database('nurse');
                        $dbuni->Table = "proj_list";
                        $dbuni->Where = "order by project_id";
                        $useruni = $dbuni->Select();

                        $currentYear = date("Y"); // ปีปัจจุบัน

                        echo '<select class="form-select select-sm" name="year-section" id="year-section">';
                        echo '<option selected>ปีงบประมาณ</option>';
                        $currentYear = date('Y');
                        for ($i = 0; $i < 5; $i++) {
                            $year = $currentYear - $i;
                            $buddhistYear = $year + 543;
                            $selected = ($i === 0) ? 'selected' : '';
                            echo "<option value=\"$year\" $selected>$buddhistYear</option>";
                        }

                        echo '</select>';
                        ?>
                    </div>
                </div>
                <h2><strong>โครงการ</strong></h2>
                <div class="content-card_plan">
                    <div class="kpi-card">
                        <div class="card-body">
                            <div class="row"> <!-- style="align-items: center;" -->
                                <div id="roomStatusChart" style="width: 100%; height: 400px;border-radius: 10px; overflow: hidden;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="content-card_plan">

                        <div class="kpi-card">
                            <div class="card-body">
                                <div class="flex-container-rounded">
                                    <p class="card-text"><i class="bi bi-journals"></i> จำนวนเงินที่ใช้ไปในโครงการ </p>
                                    <p class="rounded-full success-full"></p>
                                </div>
                                <div class="row">
                                    <div class="d-flex justify-content-around">
                                        <h1 class="card-title" id="sum_money"></h1>
                                    </div>
                                </div>
                            </div>
                            <p style="font-style: italic; font-size:11px;" id="pere_thum"></p>
                        </div>

                        <div class="kpi-card">
                            <div class="card-body">
                                <div class="flex-container-rounded">
                                    <p class="card-text"><i class="bi bi-journals"></i> จำนวนเงินที่ได้รับสนับสนุนจากภายนอก </p>
                                    <p class="rounded-full success-full"></p>
                                </div>
                                <div class="row">
                                    <div class="d-flex justify-content-around">
                                        <h1 class="card-title" id="money_outside_real"></h1>
                                    </div>
                                </div>
                            </div>
                            <p style="font-style: italic; font-size:11px;" id="pe_thum"></p>
                        </div>

                        <div class="kpi-card">
                            <div class="card-body">
                                <div class="flex-container-rounded">
                                    <p class="card-text"><i class="bi bi-journals"></i> จำนวนเงินที่ใช้ของคณะ </p>
                                    <p class="rounded-full success-full"></p>
                                </div>
                                <div class="row">
                                    <div class="d-flex justify-content-around">
                                        <h1 class="card-title" id="money_income_real"></h1>
                                    </div>
                                </div>
                            </div>
                            <p style="font-style: italic; font-size:11px;" id="p_thum"></p>
                        </div>

                        <div class="kpi-card">
                            <div class="card-body">
                                <div class="flex-container-rounded">
                                    <p class="card-text"><i class="bi bi-journals"></i> จำนวนบุคลากร </p>
                                    <p class="rounded-full success-full"></p>
                                </div>
                                <div class="row">
                                    <div class="d-flex justify-content-around">
                                        <h1 class="card-title" id="sum_group"></h1>
                                    </div>
                                </div>
                            </div>
                            <p style="font-style: italic; font-size:11px;" id="thum"></p>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
    <div class="Header_main_nu">
        <div class="row">
            <div id="So_pro"></div>
        </div>
    </div>
</div>
<script>
    function animateMoney(element, start, end, duration) {
        // if (end === 0) return;

        // กำหนดเวลาให้สั้นลงถ้าค่าน้อย
        if (end <= 100) {
            duration = 300; // ปรับให้แสดงเร็วขึ้น
        }

        var range = end - start;
        var stepTime = Math.abs(Math.floor(duration / Math.max(range, 1))); // เวลาต่อการนับ
        var increment = range / (duration / 50); // เพิ่มค่าทีละน้อยตามเวลา

        var current = start;
        var timer = setInterval(function() {
            current += increment;

            if (current > end) current = end; // หยุดเมื่อถึง end

            // ตรวจสอบว่าเป็นจำนวนเต็มหรือไม่
            let displayValue = Number.isInteger(current) ?
                current.toLocaleString() // จำนวนเต็ม
                :
                current.toFixed(2).toLocaleString(); // มีทศนิยม 2 ตำแหน่ง

            $(element).text(displayValue);

            if (current >= end) {
                clearInterval(timer);
            }
        }, stepTime);
    }

    var initialYear = new Date().getFullYear().toString();
    fetchData(initialYear);
    $('.Header_main_nu').hide();
    $('#year-section').change(function() {
        var selectedYear = $(this).val();
        if (selectedYear !== '') {
            fetchData(selectedYear);
        } else {
            $('#result #number_j').empty();
        }
    });

    function fetchData(year) {
        $.ajax({
            type: "POST",
            url: 'config/get_Pro_Thum.php',
            data: {
                year: year
            },
            success: function(data) {
                animateMoney('#pro_thum', 0, data.project || 0, 3000);
                animateMoney('#per_thum', 0, data.Percent || 0, 3000);
                animateMoney('#sum_money', 0, data.sum_money || 0, 3000);
                animateMoney('#money_outside_real', 0, data.money_outside_real || 0, 3000);
                animateMoney('#money_income_real', 0, data.money_income_real || 0, 3000);
                animateMoney('#sum_group', 0, data.sum_group || 0, 3000);
                const allProjectIds = data.allProjectIds; // ดึง project_id ของ earn
                const allProjectStd = data.thumStd;
                const allProjectRe = data.thumRe;
                const allProjectAll = data.thumAll;
                const thumProjectIds = data.thumProjectIds;

                var chartDom = document.getElementById('roomStatusChart');
                var myChart = echarts.init(chartDom, 'vintage');
                var option;

                option = {
                    backgroundColor: 'rgba(254,248,239,1)',
                    tooltip: {
                        trigger: 'item',
                        formatter: '{b}: {c} ({d}%)' // แสดงชื่อ, จำนวน, และอัตราร้อยละใน tooltip
                    },
                    legend: {
                        top: '0%',
                        left: 'center',
                        bottom: '10%'

                    },
                    series: [{
                        name: 'Access From',
                        type: 'pie',
                        radius: ['40%', '70%'],
                        avoidLabelOverlap: false,
                        padAngle: 5,
                        itemStyle: {
                            borderRadius: 10
                        },
                        label: {
                            show: false,
                            position: 'center'
                        },
                        emphasis: {
                            label: {
                                show: true,
                                fontSize: 20,
                                fontWeight: 'bold',
                                formatter: function(params) {
                                    return `${params.name}\n${params.percent}%`;
                                    // แสดงชื่อและอัตราร้อยละตรงกลาง
                                },
                                color: '#000' // ปรับสีข้อความให้ชัดเจน
                            }
                        },
                        labelLine: {
                            show: false
                        },
                        data: [{
                                value: data.project,
                                name: "ทำนุศิลปะและวัฒนธรรม",

                                itemStyle: {
                                    color: "#dd6b66",
                                    borderColor: '#000', // สีเส้นขอบ
                                    borderWidth: 1 // ความหนาของเส้นขอบ
                                }
                            },
                            {
                                value: data.SumThumStd,
                                name: "ทำนุการเรียน",

                                itemStyle: {
                                    color: "#759aa0",
                                    borderColor: '#000', // สีเส้นขอบ
                                    borderWidth: 1 // ความหนาของเส้นขอบ
                                }
                            },
                            {
                                value: data.SumThumRe,
                                name: "ทำนุการวิจัย",

                                itemStyle: {
                                    color: "#ea7e53",
                                    borderColor: '#000', // สีเส้นขอบ
                                    borderWidth: 1 // ความหนาของเส้นขอบ
                                }
                            },
                            {
                                value: data.SumThumAll,
                                name: "โครงการที่มีการทำนุศิลปะและวัฒนธรรมทั้งหมด",

                                itemStyle: {
                                    color: "#73b9bc",
                                    borderColor: '#000', // สีเส้นขอบ
                                    borderWidth: 1 // ความหนาของเส้นขอบ
                                }
                            },
                            {
                                value: data.project_al,
                                name: "โครงการที่ไม่มีการทำนุศิลปะและวัฒนธรรม",

                                itemStyle: {
                                    color: "#eeeeee",
                                    borderColor: '#000', // สีเส้นขอบ
                                    borderWidth: 1 // ความหนาของเส้นขอบ
                                }
                            }
                        ]
                    }]
                };


                option && myChart.setOption(option);

                myChart.on('click', function(params) {
                    // console.log('Clicked:', params);

                    let selectedProjectIds;

                    if (params.name === "ทำนุศิลปะและวัฒนธรรม") {
                        selectedProjectIds = thumProjectIds;
                    } else if (params.name === "ทำนุการเรียน") {
                        selectedProjectIds = allProjectStd;
                        // return;
                    } else if (params.name === "ทำนุการวิจัย") {
                        selectedProjectIds = allProjectRe;
                        // return;
                    } else if (params.name === "โครงการที่ไม่มีการทำนุศิลปะและวัฒนธรรม") {
                        selectedProjectIds = allProjectIds;
                        // return;
                    } else if (params.name === "โครงการที่มีการทำนุศิลปะและวัฒนธรรมทั้งหมด") {
                        selectedProjectIds = allProjectAll;
                        // return;
                    }

                    // console.log('Selected project_id:', selectedProjectIds);

                    $.ajax({
                        type: "POST",
                        url: 'config/gen_Pro_thum.php',
                        data: {
                            pro_id: selectedProjectIds,
                            year_pro: year
                        },
                        success: function(data) {
                            $('.Header_main_nu').show();
                            $('#So_pro').show();
                            $('#So_pro').html(data);

                            $('#dtBasicExample').DataTable({
                                "lengthMenu": [
                                    [10, 10, 25, 50, 100],
                                    ["แสดงจำนวนข้อมูล", 10, 25, 50, 100]
                                ],
                                "pagingType": "simple_numbers",
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
                                "drawCallback": function(settings) {
                                    $('[data-toggle="tooltip"]').tooltip();
                                }
                            });
                        }
                    });
                });

                window.addEventListener('resize', function() {
                    myChart.resize();
                });
            },
            error: function(data) {
                console.log(data);
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
</script>