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

    .clickable-type-card {
        transition: all 0.3s ease;
    }

    .clickable-type-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .badge-primary {
        background-color: #007bff;
        color: white;
        padding: 5px 10px;
        border-radius: 15px;
        font-size: 0.9em;
    }

    .text-truncate {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .icon-box i {
        color: inherit;
    }

    .card-header h5 {
        margin: 0;
        font-size: 1.1rem;
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
                <li class="breadcrumb-item active" id="activet" aria-current="page">ครุภัณฑ์</li>
            </ol>
        </nav>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-12 mt-5">
            <div class="kpi-card">
                <div class="flex-container-rounded">
                    <h1 style="font-weight: 700;">ครุภัณฑ์</h1>
                </div>
                <div class="content-card_re mt-3">
                    <div class="kpi-card">
                        <div class="card-body">
                            <div class="flex-container-rounded">
                                <p class="card-text"><i class="bi bi-journals"></i> เปรียบเทียบครุภัณฑ์เพิ่มขึ้น - ลดลง 5 ปีย้อนหลัง </p>
                                <p class="rounded-full success-full"></p>
                            </div>
                            <div class="row">

                                <div id="CompareChart" style="width: 100%; height: 400px;border-radius: 10px; overflow: hidden;"></div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-card_plan mt-3">
                    <!-- จำนวนครุภัณฑ์ 5 ปีย้อนหลัง -->
                    <div class="kpi-card">
                        <div class="card-body">
                            <div class="flex-container-rounded">
                                <p class="card-text"><i class="bi bi-journals"></i> จำนวนครุภัณฑ์ 5 ปีย้อนหลัง </p>
                                <p class="rounded-full success-full"></p>
                            </div>
                            <div class="row"> <!-- style="align-items: center;" -->

                                <div id="DeviceChart" style="width: 100%; height: 400px;border-radius: 10px; overflow: hidden;"></div>

                            </div>
                        </div>
                    </div>
                    <!-- จำนวนครุภัณฑ์ที่จำหน่าย 5 ปีย้อนหลัง -->
                    <div class="kpi-card">
                        <div class="card-body">
                            <div class="flex-container-rounded">
                                <p class="card-text"><i class="bi bi-journals"></i> จำนวนครุภัณฑ์ที่จำหน่าย 5 ปีย้อนหลัง </p>
                                <p class="rounded-full success-full"></p>
                            </div>
                            <div class="row"> <!-- style="align-items: center;" -->

                                <div id="DOutChart" style="width: 100%; height: 400px;border-radius: 10px; overflow: hidden;"></div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ตารางแสดงข้อมูล -->
        <div class="col-md-12 mt-5 sec-table">
            <div class="kpi-card">
                <div class="Header_main_nu">
                    <div class="row">
                        <div id="So_pro"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-5">
            <div class="kpi-card">
                <div class="content-card_plan mt-3">
                    <!-- จำนวนครุภัณฑ์แต่ละประเภท -->
                    <div class="kpi-card">
                        <div class="card-body">
                            <div class="flex-container-rounded">
                                <p class="card-text"><i class="bi bi-journals"></i> จำนวนครุภัณฑ์แต่ละประเภท </p>
                                <p class="rounded-full success-full"></p>
                            </div>
                            <div class="row"> <!-- style="align-items: center;" -->


                                <div id="DeviTyChart" style="width: 100%; height: 400px;border-radius: 10px; overflow: hidden;"></div>

                            </div>


                        </div>
                    </div>
                    <!-- จำนวนอายุการใช้งานครุภัณฑ์ -->
                    <div class="kpi-card">
                        <div class="card-body">
                            <div class="flex-container-rounded">
                                <p class="card-text"><i class="bi bi-journals"></i> จำนวนอายุการใช้งานครุภัณฑ์ </p>
                                <p class="rounded-full success-full"></p>
                            </div>
                            <div class="row">

                                <div id="AgeChart" style="width: 100%; height: 400px;border-radius: 10px; overflow: hidden;"></div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-5 sec-table-age-detail">
            <div class="kpi-card">
                <div class="content-card_re mt-3">
                    <div class="kpi-card">
                        <div id="type-cards-container" class="row mt-4" style="display: none;">
                            <!-- Cards จะถูกแทรกที่นี่โดย JavaScript -->
                        </div>
                        <div class="sec-table-age" style="display: none; margin-top: 30px;">
                            <div class="card">
                                <div class="card-header bg-primary text-white">
                                    <h5 id="selected-type-label" class="mb-0"></h5>
                                </div>
                                <div class="card-body">
                                    <div id="D_type"></div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        <div class="col-md-12 mt-5">
            <div class="kpi-card">
                <div class="content-card_plan mt-3">
                    <!-- จำนวนครุภัณฑ์แต่ละอาคาร -->
                    <div class="kpi-card">
                        <div class="card-body">
                            <div class="flex-container-rounded">
                                <p class="card-text"><i class="bi bi-journals"></i> จำนวนครุภัณฑ์แต่ละอาคาร </p>
                                <p class="rounded-full success-full"></p>
                            </div>
                            <div class="row">

                                <div id="BuildingChart" style="width: 100%; height: 400px;border-radius: 10px; overflow: hidden;"></div>

                            </div>
                        </div>
                    </div>
                    <!-- จำนวนอายุการใช้งานครุภัณฑ์ -->
                    <div class="kpi-card">
                        <div class="row"> <!-- style="align-items: center;" -->
                            <div class="content-card_re">
                                <div class="kpi-card">
                                    <div class="card-body">
                                        <div class="flex-container-rounded">
                                            <p class="card-text"><i class="bi bi-journals"></i> จำนวนเงินทั้งหมด </p>
                                            <p class="rounded-full success-full"></p>
                                        </div>
                                        <div class="row">
                                            <div class="d-flex justify-content-around">
                                                <h1 class="card-title" id="sumMoney"></h1>
                                            </div>
                                            <div class="flex-container-rounded justify-content-end">
                                                <p>บาท</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="content-card_plan mt-3">
                                <div class="kpi-card">
                                    <div class="card-body">
                                        <div class="flex-container-rounded">
                                            <p class="card-text"><i class="bi bi-coin"></i> จำนวนเงินแผ่นดิน </p>
                                            <p class="rounded-full success-full"></p>
                                        </div>
                                        <div class="row">
                                            <div class="d-flex justify-content-around">
                                                <h1 class="card-title" id="moneyStone"></h1>
                                            </div>
                                            <div class="flex-container-rounded justify-content-end">
                                                <p>บาท</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="kpi-card">
                                    <div class="card-body">
                                        <div class="flex-container-rounded">
                                            <p class="card-text"><i class="bi bi-coin"></i> จำนวนเงินอุดหนุนรัฐบาล </p>
                                            <p class="rounded-full success-full"></p>
                                        </div>
                                        <div class="row">
                                            <div class="d-flex justify-content-around">
                                                <h1 class="card-title" id="moneyGrov"></h1>
                                            </div>
                                            <div class="flex-container-rounded justify-content-end">
                                                <p>บาท</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="content-card_plan mt-3">
                                <div class="kpi-card">
                                    <div class="card-body">
                                        <div class="flex-container-rounded">
                                            <p class="card-text"><i class="bi bi-coin"></i> จำนวนเงินรายได้ </p>
                                            <p class="rounded-full success-full"></p>
                                        </div>
                                        <div class="row">
                                            <div class="d-flex justify-content-around">
                                                <h1 class="card-title" id="moneyIncome"></h1>
                                            </div>
                                            <div class="flex-container-rounded justify-content-end">
                                                <p>บาท</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="kpi-card">
                                    <div class="card-body">
                                        <div class="flex-container-rounded">
                                            <p class="card-text"><i class="bi bi-coin"></i> จำนวนเงินอื่นๆ </p>
                                            <p class="rounded-full success-full"></p>
                                        </div>
                                        <div class="row">
                                            <div class="d-flex justify-content-around">
                                                <h1 class="card-title" id="moneyOther"></h1>
                                            </div>
                                            <div class="flex-container-rounded justify-content-end">
                                                <p>บาท</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        loadDeviceCompare();
        loadDeviceInData();
        loadDeviceOutData();
        loadDeviceTypeData();
        loadDeviceAgeData();
        loadDeviceBuildingData();
        loadDeviceMoneyData();
    });

    function animateMoney(selector, start, end, duration) {
        const obj = document.querySelector(selector);
        let startTimestamp = null;

        const step = (timestamp) => {
            if (!startTimestamp) startTimestamp = timestamp;
            const progress = Math.min((timestamp - startTimestamp) / duration, 1);
            const current = start + (end - start) * progress;

            // แสดงเป็นคอมม่าพร้อมทศนิยม 2 ตำแหน่ง
            obj.innerHTML = current.toLocaleString('en-US', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });

            if (progress < 1) {
                window.requestAnimationFrame(step);
            }
        };

        window.requestAnimationFrame(step);
    }

    // แปลงสี Hex เป็น RGBA สำหรับพื้นหลังอ่อน
    function hexToRGBA(hex, alpha) {
        let r = parseInt(hex.slice(1, 3), 16),
            g = parseInt(hex.slice(3, 5), 16),
            b = parseInt(hex.slice(5, 7), 16);
        return `rgba(${r}, ${g}, ${b}, ${alpha})`;
    }

    $('.sec-table').hide();
    $('.sec-table-age-detail').hide();
    $('.sec-table-type').hide();

    function loadDeviceCompare() {
        $.ajax({
            type: "POST",
            url: 'config/controllerDevice/get_data_compare.php',
            data: {},
            dataType: 'json',
            success: function(data) {
                let years = data.years;
                let cumulativeData = data.cumulativeData;
                let yearlyIncrease = data.yearlyIncrease;

                var chartDomcom = document.getElementById('CompareChart');
                var ComChart = echarts.init(chartDomcom);

                // คำนวณช่วงค่า Y ให้เหมาะสม
                let maxValue = Math.max(...cumulativeData);
                let yInterval = 1000;
                let yMax = Math.ceil(maxValue / yInterval) * yInterval;

                var optioncom = {
                    backgroundColor: 'rgba(254,248,239,1)',
                    title: {
                        text: 'จำนวนครุภัณฑ์สะสมและเพิ่มขึ้นรายปี (5 ปีย้อนหลัง)',
                        left: 'center',
                        textStyle: {
                            color: '#d7ab82',
                            fontSize: 16
                        }
                    },
                    tooltip: {
                        trigger: 'axis',
                        axisPointer: {
                            type: 'cross'
                        },
                        formatter: function(params) {
                            let result = params[0].name + '<br/>';

                            // แสดงข้อมูลเส้นสะสม
                            let cumulativeParam = params.find(p => p.seriesName === 'จำนวนสะสม');
                            if (cumulativeParam) {
                                result += cumulativeParam.marker + cumulativeParam.seriesName + ': ' +
                                    cumulativeParam.value.toLocaleString() + ' รายการ<br/>';
                            }

                            // แสดงข้อมูลเส้นเพิ่มขึ้นรายปี
                            let increaseParam = params.find(p => p.seriesName === 'เพิ่มขึ้นรายปี');
                            if (increaseParam) {
                                result += increaseParam.marker + increaseParam.seriesName + ': ' +
                                    increaseParam.value.toLocaleString() + ' รายการ';
                            }

                            return result;
                        }
                    },
                    legend: {
                        data: ['จำนวนสะสม', 'เพิ่มขึ้นรายปี'],
                        bottom: 10
                    },
                    grid: {
                        left: '3%',
                        right: '4%',
                        bottom: '15%',
                        top: '15%',
                        containLabel: true
                    },
                    xAxis: {
                        type: 'category',
                        data: years,
                        axisLabel: {
                            fontSize: 12
                        }
                    },
                    yAxis: {
                        type: 'value',
                        name: 'จำนวนครุภัณฑ์',
                        min: 0,
                        max: yMax,
                        interval: yInterval,
                        axisLabel: {
                            formatter: '{value}'
                        }
                    },
                    series: [{
                            name: 'จำนวนสะสม',
                            data: cumulativeData,
                            type: 'line',
                            smooth: true,
                            symbol: 'circle',
                            symbolSize: 8,
                            lineStyle: {
                                width: 4,
                                color: '#5470c6'
                            },
                            itemStyle: {
                                color: '#5470c6'
                            },
                            label: {
                                show: true,
                                formatter: '{c}',
                                position: 'top'
                            }
                        },
                        {
                            name: 'เพิ่มขึ้นรายปี',
                            data: yearlyIncrease,
                            type: 'line',
                            smooth: true,
                            symbol: 'emptyCircle',
                            symbolSize: 6,
                            lineStyle: {
                                width: 4,
                                type: 'dashed',
                                color: '#FF6F61'
                            },
                            itemStyle: {
                                color: '#FF6F61'
                            }
                        }
                    ]
                };

                ComChart.setOption(optioncom);
                window.addEventListener('resize', function() {
                    ComChart.resize();
                });
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error:", error);
                console.log("Response:", xhr.responseText);
            }
        });
    }

    function loadDeviceInData() {
        $.ajax({
            type: "POST",
            url: 'config/controllerDevice/get_data_in.php',
            data: {},
            dataType: 'json',
            success: function(data) {
                let years = data.years;
                let records = data.recordsPerYear;
                let devices = data.devicesByYear;

                var chartDom = document.getElementById('DeviceChart');
                var myChart = echarts.init(chartDom);

                var option = {
                    backgroundColor: 'rgba(254,248,239,1)',
                    title: {
                        text: 'จำนวนอุปกรณ์ย้อนหลัง 5 ปี',
                        left: 'center',
                        textStyle: {
                            color: '#d7ab82'
                        }
                    },
                    tooltip: {
                        trigger: 'axis'
                    },
                    xAxis: {
                        type: 'category',
                        data: years
                    },
                    yAxis: {
                        type: 'value'
                    },
                    series: [{
                        data: records,
                        type: 'bar',
                        barWidth: "40%",
                        itemStyle: {
                            color: function(params) {
                                let colors = ["#61a0a8", '#FF6F61', '#FFA07A', '#FFD700', '#90EE90'];
                                return colors[params.dataIndex % colors.length];
                            },
                            borderRadius: [5, 5, 0, 0]
                        },
                    }]
                };

                myChart.setOption(option);
                myChart.on('click', function(params) {
                    let year = params.name; // ปี พ.ศ. ที่คลิก
                    let deviceIDs = devices[year]; // device_ID ของปีนั้นทั้งหมด

                    console.log("คลิกปี:", year, "ได้ device_ID:", deviceIDs);

                    $.ajax({
                        url: 'config/get_data_work_over.php',
                        method: 'POST',
                        data: {
                            devices: deviceIDs,
                            status: 'in'
                        },
                        success: function(data) {
                            $('.sec-table').show();
                            $('#So_pro').show();
                            $('#So_pro').html(data);
                            if ($.fn.DataTable.isDataTable('#dtBasicExample')) {
                                $('#dtBasicExample').DataTable().destroy();
                            }
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
            error: function(xhr, status, error) {
                console.error("AJAX Error:", error);
                console.log("Response:", xhr.responseText);
            }
        });
    }

    function loadDeviceOutData() {
        $.ajax({
            type: "POST",
            url: 'config/controllerDevice/get_data_out.php',
            data: {},
            dataType: 'json',
            success: function(data) {
                let yearsOut = data.yearsOut;
                let recordsOut = data.recordsPerYearOut;
                let devicesOut = data.devicesByYearOut;

                var chartDomOut = document.getElementById('DOutChart');
                var myChartOut = echarts.init(chartDomOut);

                var optionOut = {
                    backgroundColor: 'rgba(254,248,239,1)',
                    title: {
                        text: 'จำนวนอุปกรณ์ที่จำหน่ายย้อนหลัง 5 ปี',
                        left: 'center',
                        textStyle: {
                            color: '#d7ab82'
                        }
                    },
                    tooltip: {
                        trigger: 'axis'
                    },
                    xAxis: {
                        type: 'category',
                        data: yearsOut
                    },
                    yAxis: {
                        type: 'value'
                    },
                    series: [{
                        data: recordsOut,
                        type: 'bar',
                        barWidth: "40%",
                        itemStyle: {
                            color: function(params) {
                                let colors = ["#61a0a8", '#FF6F61', '#FFA07A', '#FFD700', '#90EE90'];
                                return colors[params.dataIndex % colors.length];
                            },
                            borderRadius: [5, 5, 0, 0]
                        },
                    }]
                };

                myChartOut.setOption(optionOut);
                myChartOut.on('click', function(params) {
                    let yearOut = params.name; // ปี พ.ศ. ที่คลิก
                    let deviceIDsOut = devicesOut[yearOut]; // device_ID ของปีนั้นทั้งหมด
                    console.log(devicesOut);

                    console.log("คลิกปี:", yearOut, "ได้ device_ID:", deviceIDsOut);

                    $.ajax({
                        url: 'config/get_data_work_over.php',
                        method: 'POST',
                        data: {
                            devices: deviceIDsOut,
                            status: 'out'
                        },
                        success: function(data) {
                            $('.sec-table').show();
                            $('#So_pro').show();
                            $('#So_pro').html(data);
                            if ($.fn.DataTable.isDataTable('#dtBasicExample')) {
                                $('#dtBasicExample').DataTable().destroy();
                            }
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
                    myChartOut.resize();
                });
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error:", error);
                console.log("Response:", xhr.responseText);
            }
        });
    }

    function loadDeviceTypeData() {
        $.ajax({
            type: "POST",
            url: 'config/controllerDevice/get_data_type.php',
            data: {},
            dataType: 'json',
            success: function(data) {
                let categories = data.categories;
                let counts = data.categoryCounts;
                let devicesByCategory = data.devicesByCategory;

                // กำหนดสีสำหรับ bar chart
                let barColors = [
                    '#5470C6', '#91CC75', '#EE6666', '#73C0DE', '#FAC858',
                    '#9A60B4', '#EA7CCC', '#FF9F7F', '#B5C334', '#F08080',
                    '#40A9FF', '#FFD700', '#8B4513'
                ];

                // สร้างกราฟ ECharts
                var chartDomType = document.getElementById('DeviTyChart');
                var assetChart = echarts.init(chartDomType, 'vintage');

                var optionType = {
                    backgroundColor: 'rgba(254,248,239,1)',
                    title: {
                        text: 'จำแนกประเภทครุภัณฑ์',
                        left: 'center',
                        top: '2%',
                        textStyle: {
                            color: '#d7ab82'
                        }
                    },
                    tooltip: {
                        trigger: 'axis',
                        axisPointer: {
                            type: 'shadow'
                        }
                    },
                    grid: {
                        left: '0%',
                        right: '10%',
                        bottom: '10%',
                        containLabel: true
                    },
                    xAxis: {
                        type: 'value',
                        name: 'จำนวน',
                        axisLine: {
                            show: true
                        },
                        axisTick: {
                            show: true
                        }
                    },
                    yAxis: {
                        type: 'category',
                        data: categories,
                        axisLine: {
                            show: true
                        },
                        axisTick: {
                            show: false
                        },
                        inverse: true
                    },
                    series: [{
                        type: 'bar',
                        data: counts,
                        barWidth: 20,
                        itemStyle: {
                            color: function(params) {
                                return barColors[params.dataIndex];
                            },
                            borderRadius: [5, 5, 5, 5]
                        },
                        label: {
                            show: true,
                            position: 'right',
                            formatter: '{c}'
                        }
                    }]
                };

                assetChart.setOption(optionType);

                // ปรับขนาดกราฟเมื่อหน้าจอ resize
                window.addEventListener('resize', function() {
                    assetChart.resize();
                });
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error:", error);
            }
        });
    }

    function loadDeviceAgeData() {
        $.ajax({
            type: "POST",
            url: 'config/controllerDevice/get_data_age.php',
            data: {},
            dataType: 'json',
            success: function(data) {
                let ageCategories = data.ageCategories;
                let ageCounts = data.ageCounts;
                let tooltipDetails = data.tooltipDetails;
                let devicesByGroup = data.devicesByGroup;

                var chartDomAge = document.getElementById('AgeChart');
                var ageChart = echarts.init(chartDomAge, 'vintage');

                var optionAge = {
                    backgroundColor: 'rgba(254,248,239,1)',
                    title: {
                        text: 'อายุการใช้งานครุภัณฑ์',
                        left: 'center',
                        top: '2%',
                        textStyle: {
                            color: '#d7ab82'
                        }
                    },
                    tooltip: {
                        trigger: 'axis',
                        axisPointer: {
                            type: 'shadow'
                        },
                        formatter: function(params) {
                            let idx = params[0].dataIndex;
                            let detail = tooltipDetails[idx] || "";
                            return `<b>${params[0].axisValue}</b><br/>
                    รวม: ${params[0].data} ชิ้น<br/><br/>
                    ${detail}`;
                        }
                    },
                    xAxis: {
                        type: 'category',
                        data: ageCategories,
                        axisLabel: {
                            rotate: 30
                        }
                    },
                    yAxis: {
                        type: 'value',
                        name: 'จำนวน'
                    },
                    series: [{
                        type: 'bar',
                        data: ageCounts,
                        barWidth: 40,
                        itemStyle: {
                            color: function(params) {
                                let colors = ['#FF6F61', '#FFA07A', '#FFD700', '#90EE90'];
                                return colors[params.dataIndex % colors.length];
                            },
                            borderRadius: [5, 5, 0, 0]
                        },
                        label: {
                            show: true,
                            position: 'top',
                            formatter: '{c}'
                        }
                    }]
                };

                ageChart.setOption(optionAge);
                ageChart.on('click', function(params) {
                    $('.sec-table-age-detail').show();
                    let ageRange = params.name; // ปี พ.ศ. ที่คลิก
                    let deviceIDag = devicesByGroup[ageRange]; // device_ID ของปีนั้นทั้งหมด

                    if (!deviceIDag || Object.keys(deviceIDag).length === 0) {
                        alert(`ไม่มีข้อมูลในช่วงอายุ: ${ageRange}`);
                        return;
                    }

                    renderTypeCards(ageRange, deviceIDag);
                });

                window.addEventListener('resize', function() {
                    ageChart.resize();
                });

            },
            error: function(xhr, status, error) {
                console.error("AJAX Error:", error);
                console.log("Response:", xhr.responseText);
            }
        });
    }

    function renderTypeCards(ageRange, typesData) {
        let container = $('#type-cards-container');
        container.empty().show();

        let colors = ['#40A9FF', '#FFD700', '#FF6F61', '#91CC75', '#FAC858', '#EA7CCC'];

        // เพิ่ม header ให้ชัดเจน
        let header = `
        <div class="col-12 mb-3">
            <h5 class="text-center">ประเภทครุภัณฑ์ในช่วงอายุ: ${ageRange}</h5>
        </div>`;
        container.append(header);

        Object.keys(typesData).forEach((typeName, index) => {
            let info = typesData[typeName];

            // ตรวจสอบโครงสร้างข้อมูล
            let count, deviceIDs;

            if (typeof info === 'object' && info !== null) {
                // ถ้า info เป็น object ที่มี count และ devices
                count = parseInt(info.count) || 0;
                deviceIDs = Array.isArray(info.devices) ? info.devices : [];
            } else if (Array.isArray(info)) {
                // ถ้า info เป็น array ของ device IDs
                count = info.length;
                deviceIDs = info;
            } else {
                // fallback
                count = 0;
                deviceIDs = [];
            }

            let bgColor = colors[index % colors.length];

            let card = `
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="card h-100 shadow-sm clickable-type-card"
                    data-type="${typeName}"
                    data-count="${count}"
                    data-age="${ageRange}"
                    style="border-left: 5px solid ${bgColor}; cursor: pointer; transition: transform 0.2s;">
                    <div class="card-body text-center">
                        <div style="font-size: 1.5em; color: ${bgColor}; margin-bottom: 10px;">
                            <i class="fas fa-cube"></i>
                        </div>
                        <h6 class="mb-1 text-truncate" title="${typeName}">${typeName}</h6>
                        <span class="badge badge-primary">${count} ชิ้น</span>
                    </div>
                </div>
            </div>`;

            let $card = $(card);
            $card.find('.clickable-type-card').data('devices', deviceIDs);

            // เพิ่ม hover effect
            $card.find('.clickable-type-card').hover(
                function() {
                    $(this).css('transform', 'translateY(-3px)');
                },
                function() {
                    $(this).css('transform', 'translateY(0)');
                }
            );

            container.append($card);
        });

        // คลิก card → แสดงตาราง
        $('#type-cards-container').off('click', '.clickable-type-card').on('click', '.clickable-type-card', function() {
            let typeName = $(this).data('type');
            let count = $(this).data('count');
            let ageRange = $(this).data('age');
            let deviceIDs = $(this).data('devices');

            // ตรวจสอบค่าก่อนแสดง
            if (count === undefined || count === null) {
                count = 0;
            }

            $('#selected-type-label').text(`ประเภท: ${typeName} | อายุ: ${ageRange} (${count} รายการ)`);
            $('.sec-table-age').show(); // เปลี่ยนจาก sec-table-type เป็น sec-table-age

            // เรียกใช้ฟังก์ชันแสดงตาราง (ถ้ามี)
            loadDevicesTable(deviceIDs);
        });
    }

    function loadDevicesTable(deviceIDs) {
        $.ajax({
            url: 'config/get_data_work_per.php',
            method: 'POST',
            data: {
                devices: deviceIDs
            },
            success: function(data) {
                $('#D_type').html(data);
                if ($.fn.DataTable.isDataTable('#dataType')) {
                    $('#dataType').DataTable().destroy();
                }
                $('#dataType').DataTable({
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
    }

    function loadDeviceBuildingData() {
        $.ajax({
            type: "POST",
            url: 'config/controllerDevice/get_data_building.php',
            data: {},
            dataType: 'json',
            success: function(data) {
                // ตอนนี้ใช้ข้อมูลจาก AJAX response แทน PHP variables
                let buildingNames = data.buildingNames;
                let deviceCountsByBuilding = data.deviceCountsByBuilding;
                let devicesByBuilding = data.devicesByBuilding;

                var chartDom = document.getElementById('BuildingChart');
                var buildingChart = echarts.init(chartDom, 'vintage');

                var optionBuilding = {
                    backgroundColor: 'rgba(254,248,239,1)',
                    title: {
                        text: 'จำนวนครุภัณฑ์ตามอาคาร',
                        left: 'center',
                        top: '2%',
                        textStyle: {
                            color: '#d7ab82'
                        }
                    },
                    tooltip: {
                        trigger: 'axis',
                        axisPointer: {
                            type: 'shadow'
                        },
                        formatter: function(params) {
                            let bName = params[0].axisValue;
                            let count = params[0].value;
                            return `${bName}<br/>จำนวน: ${count} ชิ้น`;
                        }
                    },
                    grid: {
                        left: '0%',
                        right: '10%',
                        bottom: '5%',
                        containLabel: true
                    },
                    xAxis: {
                        type: 'value',
                        name: 'จำนวน',
                        minInterval: 1
                    },
                    yAxis: {
                        type: 'category',
                        data: buildingNames,
                        axisLabel: {
                            interval: 0
                        }
                    },
                    series: [{
                        type: 'bar',
                        data: deviceCountsByBuilding,
                        itemStyle: {
                            color: function(params) {
                                let colors = ['#FF6F61', '#FFA07A', '#FFD700', '#90EE90', '#6A5ACD', '#20B2AA'];
                                return colors[params.dataIndex % colors.length];
                            },
                            borderRadius: [0, 5, 5, 0]
                        },
                        label: {
                            show: true,
                            position: 'right',
                            formatter: '{c}'
                        }
                    }]
                };

                buildingChart.setOption(optionBuilding);

                // เพิ่ม click event ถ้าต้องการ
                buildingChart.on('click', function(params) {
                    let buildingName = params.name;
                    let deviceIDs = devicesByBuilding[buildingName];
                    console.log('Building:', buildingName, 'Devices:', deviceIDs);
                    // ทำอะไรต่อกับข้อมูลที่คลิก
                });
                window.addEventListener('resize', function() {
                    buildingChart.resize();
                });
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error:", error);
                console.log("Response:", xhr.responseText);
            }
        });

    }

    function loadDeviceMoneyData() {
        $.ajax({
            type: "POST",
            url: 'config/controllerDevice/get_data_money.php',
            data: {},
            dataType: 'json',
            success: function(data) {
                animateMoney('#sumMoney', 0, data.sumMoney || 0, 2000);
                animateMoney('#moneyStone', 0, data.moneyStone || 0, 2000);
                animateMoney('#moneyGrov', 0, data.moneyGrov || 0, 2000);
                animateMoney('#moneyIncome', 0, data.moneyIncome || 0, 2000);
                animateMoney('#moneyOther', 0, data.moneyOther || 0, 2000);
            }
        });
    }
</script>