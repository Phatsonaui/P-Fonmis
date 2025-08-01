<script type="text/javascript">
    function createChart(chartData) {
        chartData.forEach(data => {
            const {
                id,
                labels,
                datas,
                con_data,
                con_fig,
                plugin,
                color = 'rgba(75,192,192,0.6)' // สี default ถ้าไม่ส่งมา
            } = data;
            const pl_in = {
                id: 'customCanvasBackgroundColor',
                beforeDraw: (chart, args, options) => {
                    const {
                        ctx
                    } = chart;
                    ctx.save();

                    // กำหนดขนาดของรัศมี
                    const radius = 20;

                    // กำหนดพิกัดของจุดเริ่มต้น และขนาดของรูปร่าง
                    const x = 0;
                    const y = 0;
                    const width = chart.width;
                    const height = chart.height;

                    // เริ่มเส้นรูปร่าง
                    ctx.beginPath();
                    ctx.moveTo(x + radius, y);
                    ctx.lineTo(x + width - radius, y);
                    ctx.quadraticCurveTo(x + width, y, x + width, y + radius);
                    ctx.lineTo(x + width, y + height - radius);
                    ctx.quadraticCurveTo(x + width, y + height, x + width - radius, y + height);
                    ctx.lineTo(x + radius, y + height);
                    ctx.quadraticCurveTo(x, y + height, x, y + height - radius);
                    ctx.lineTo(x, y + radius);
                    ctx.quadraticCurveTo(x, y, x + radius, y);
                    ctx.closePath();

                    // กำหนดสีรูปร่างและลักษณะการวาด
                    ctx.globalCompositeOperation = 'destination-over';
                    ctx.fillStyle = options.color || '#99ffff';
                    ctx.fill();

                    ctx.restore();
                }
            };
            const ctx = document.getElementById(id).getContext('2d');
            const myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: JSON.parse(labels),
                    datasets: [{
                        label: con_data,
                        data: JSON.parse(datas),
                        backgroundColor: color,
                        borderColor: [
                            'rgba(1,1,1,1)'
                        ],
                        borderWidth: 2,
                        borderRadius: 10,
                    }]
                },
                options: {

                    layout: {
                        autoPadding: true,
                    },
                    aspectRatio: 0.9,
                    maintainAspectRatio: false,
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                        },
                    },
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                                pointStyle: 'circle',
                                usePointStyle: true,
                                padding: 20,
                                color: 'rgba(1,1,1,1)',
                            },
                        },
                        customCanvasBackgroundColor: {
                            color: 'rgba(254,248,239,1)',
                        },
                    }
                },
                plugins: [pl_in],
            });
        });
    }
</script>

<div class="col-md-4 mt-3 ">
    <div class="card" style="background-color: white; margin-bottom: 15px; padding: 10px;height:100%">
        <div class="card-header text-center">
            Professional Nursing Leaders
        </div>
        <?php
        $years_c = [];
        $years_cp = [];
        $Prof_list = [];
        $rowc = $C_per = $ch_Cre = 0;
        $dbStgy = new Database('nurse');
        $dbStgy->Table = "stg_strategic";
        $dbStgy->Where = "WHERE strategic_year IS NOT NULL AND TRIM(strategic_year) <> '' ORDER BY strategic_id ASC";
        $userdbStgy = $dbStgy->Select();
        foreach ($userdbStgy as $valuesStgy => $dataStgy) {
            $year_c = (int)$dataStgy['strategic_year'];
            $years_c[] = $year_c;
            $years_cp[] = $year_c + 543;
        }

        $dbStg = new Database('nurse');
        $dbStg->Table = "stg_strategic";
        $dbStg->Where = "WHERE strategic_year IN ('" . implode("','", $years_c) . "') ORDER BY strategic_id ASC";
        $userdbStg = $dbStg->Select();
        // foreach ($userdbStg as $valuesStg => $dataStg) {

        $dbCKPI = new Database('nurse');
        $dbCKPI->Table = "stg_CKPI";
        $dbCKPI->Where = "where CKPI_name LIKE '%Professional Nursing Leaders%' ORDER BY strategic_id ASC";
        $userCKPI = $dbCKPI->Select();
        foreach ($userCKPI as $valuesCKPI => $dataCKPI) {
            $value_prof = 0;
            $dbCKPI3 = new Database('nurse');
            $dbCKPI3->Table = "stg_CKPIRespon";
            $dbCKPI3->Where = "where CKPIR_id = '$dataCKPI[CKPI_id]' order by strategic_id ASC";
            $userCKPI3 = $dbCKPI3->Select();
            $ch_Cre = count($userCKPI3);
            foreach ($userCKPI3 as $valuesCKPI3 => $dataCKPI3) {
                $Prof_list[] = $dataCKPI3['CKPIR_score'];
            }
        }
        // $Prof_list[] = $value_prof;
        // }

        $Prof_ListJson = implode(",", $Prof_list);
        $P_yearListJson = implode(",", $years_cp);
        // echo $Prof_ListJson. "<br>".$P_yearListJson;
        ?>
        <div class="card-body">
            <p align="center">
                <canvas id="ProfChart"></canvas>

                <script>
                    const ProfChart = [{
                        id: 'ProfChart',
                        labels: '[<?php echo $P_yearListJson; ?>]',
                        datas: '[<?php echo $Prof_ListJson; ?>]',
                        con_data: 'ผล',
                        con_fig: null,
                        plugin: null,
                        color: '#d87c7c'
                    }, ];
                    createChart(ProfChart);
                </script>
            </p>
        </div>
    </div>
</div>
<div class="col-md-4 mt-3 ">
    <div class="card" style="background-color: white; margin-bottom: 15px; padding: 10px;height:100%">
        <div class="card-header text-center">
            Employer Satisfaction
        </div>
        <?php
        $Emp_list = [];
        // foreach ($userdbStg as $valuesStg => $dataStg) {
        $value_Emp = 0;
        $dbCKPI1 = new Database('nurse');
        $dbCKPI1->Table = "stg_CKPI";
        $dbCKPI1->Where = "where CKPI_name LIKE 'Employer Satisfaction%'  order by strategic_id ASC";
        $userCKPI1 = $dbCKPI1->Select();
        foreach ($userCKPI1 as $valuesCKPI1 => $dataCKPI1) {

            $dbCKPI31 = new Database('nurse');
            $dbCKPI31->Table = "stg_CKPIRespon";
            $dbCKPI31->Where = "where CKPIR_id = '$dataCKPI1[CKPI_id]' order by strategic_id ASC ";
            $userCKPI31 = $dbCKPI31->Select();
            foreach ($userCKPI31 as $valuesCKPI31 => $dataCKPI31) {
                $value_Emp = $dataCKPI31['CKPIR_score'];
            }
            $Emp_list[] = $value_Emp;
        }

        // }
        $Emp_ListJson = implode(",", $Emp_list);
        ?>
        <div class="card-body">
            <p align="center">
                <canvas id="EmpChart"></canvas>

                <script>
                    const EmpChart = [{
                        id: 'EmpChart',
                        labels: '[<?php echo $P_yearListJson; ?>]',
                        datas: '[<?php echo $Emp_ListJson; ?>]',
                        con_data: 'ผล',
                        con_fig: null,
                        plugin: null,
                        color: '#759aa0'
                    }, ];
                    createChart(EmpChart);
                </script>
            </p>
        </div>
    </div>
</div>
<div class="col-md-4 mt-3">
    <div class="card" style="background-color: white; margin-bottom: 15px; padding: 10px;height:100%">
        <div class="card-header text-center">
            H-index
        </div>
        <?php
        $H_per = array();
        $H_year = array();
        $ALL_H_person = array();
        $H_person = array();
        $person_s = array();
        $dbPillar = new Database('nurse');
        $dbPillar->Table = "RS_HIndexYear";
        $dbPillar->Where = "order by hiy_year ";
        $userPillar = $dbPillar->Select();
        $row1 = count($userPillar);
        foreach ($userPillar as $valuesPillar => $dataPillar) {
            $pe_s = $dataPillar['hiy_SumIndex'];
            $person_s[] = $pe_s;
            $personHIndex = 0;
            $dbhiy = new Database('nurse');
            $dbhiy->Table = "RS_HIndexPerson";
            $dbhiy->Where = "where hiy_id='{$dataPillar['hiy_id']}' ";
            $userhiy = $dbhiy->Select();
            foreach ($userhiy as $valueshiy => $datahiy) {
                $personHIndex++;
            }

            $h_pe = 0;
            $dbh = new Database('nurse');
            $dbh->Table = "RS_HIndexPerson";
            $dbh->Where = "Where hiy_id = '{$dataPillar['hiy_id']}' ";
            $userh = $dbh->Select();
            foreach ($userh as $valuesh => $datah) {
                if ($datah['HIndex_Value'] > 0) {
                    $h_pe++;
                }
            }

            if ($personHIndex > 0) {
                $percentage = ($h_pe / $personHIndex) * 100;
            } else {
                $percentage = 0; // กรณีที่ไม่มี personHIndex
            }

            $H_per[] = $percentage;
            $ALL_H_person[] = $personHIndex;
            $H_person[] = $h_pe;
            $H_year[] = $dataPillar['hiy_year'] + 543;
        }

        $H_year = implode(",", $H_year);
        $H_person = implode(",", $H_person);
        $ALL_H_person = implode(",", $ALL_H_person);
        $person_s = implode(",", $person_s);
        $H_per = implode(",", $H_per);

        ?>
        <div class="card-body">
            <p align="center">
                <canvas id="myChartH_avgper"></canvas>
                <script>
                    const myChartH_avgper = [{
                            id: 'myChartH_avgper',
                            labels: '[<?php echo $H_year; ?>]',
                            datas: '[<?php echo $person_s; ?>]',
                            con_data: 'H-index per Faculty',
                            con_fig: null,
                            plugin: null,
                            color: '#ea7e53'
                        },
                        // เพิ่มอีกตามความต้องการ
                    ];
                    createChart(myChartH_avgper);
                </script>
            </p>
        </div>
    </div>
</div>
<div class="col-md-6 mt-3">
    <div class="card" style="background-color: white; margin-bottom: 15px; padding: 10px;height:100%">
        <div class="card-header text-center">
            ผลงานวิจัยที่มีการอ้างอิง(Citations)
        </div>
        <?php
        $befdate = date('Y') - 4;
        $h_J_sum = array();
        $datesave = array();
        for ($toyear = $befdate; $toyear <= date('Y'); $toyear++) {
            $J_s = 0;
            $dbhJ = new Database('nurse');
            $dbhJ->Table = "RS_CitationCount";
            $dbhJ->Where = "Where citc_year = '$toyear' ";
            $userhJ = $dbhJ->Select();
            foreach ($userhJ as $valueshJ => $datahJ) {
                $J_s++;
            }
            $h_J_sum[] = $J_s;
            $datesave[] = $toyear + 543;
        }
        // $datesave = implode(",", $datesave);
        // $h_J_sum = implode(",", $h_J_sum);
        ?>
        <div class="card-body">
            <p align="center">
                <canvas id="myChart_Cita"></canvas>
                <script>
                    const myChart_Cita = [{
                        id: 'myChart_Cita',
                        labels: '<?php echo json_encode($datesave); ?>',
                        datas: '<?php echo json_encode($h_J_sum); ?>',
                        con_data: 'Citations',
                        con_fig: null,
                        plugin: null,
                        color: '#7289ab'
                    }];
                    createChart(myChart_Cita);
                </script>
            </p>
        </div>
    </div>
</div>
<div class="col-md-6 mt-3 ">
    <div class="card" style="background-color: white; margin-bottom: 15px; padding: 10px;height:100%">
        <div class="card-header text-center">
            Roi
        </div>
        <?php
        $years = [];
        $dbYears = new Database('nurse');
        $dbYears->Table = "proj_list";
        $dbYears->Where = "WHERE project_Year IS NOT NULL AND TRIM(project_Year) <> '' ORDER BY project_Year ASC";
        $yearRows = $dbYears->Select();

        foreach ($yearRows as $row) {
            $year = (int)$row['project_Year'];
            if (!in_array($year, $years)) {
                $years[] = $year;
            }
        }

        // ดึงโปรเจกต์ที่เข้าเงื่อนไข
        $roi_by_year = [];
        $count_by_year = [];

        $dbGrp1 = new Database('nurse');
        $dbGrp1->Table = "proj_list";
        $dbGrp1->Where = "WHERE project_status IN('09') AND project_id <> '14' AND project_type = '2'";
        $userGrp1 = $dbGrp1->Select();

        foreach ($userGrp1 as $dataproject) {
            $year = trim($dataproject['project_Year']);
            if ($year === '') continue;
            $year = (int)$year;

            if (!isset($roi_by_year[$year])) {
                $roi_by_year[$year] = 0;
                $count_by_year[$year] = 0;
            }

            $sumMoneyReal = 0;
            $sumMoneyReal_in = 0;

            // เงินเข้า
            $dbmoney = new Database('nurse');
            $dbmoney->Table = "Proj_MoneyIN";
            $dbmoney->Where = "WHERE project_id = '$dataproject[project_id]'";
            $usermoney = $dbmoney->Select();

            // เงินออก
            $dbmoney_out = new Database('nurse');
            $dbmoney_out->Table = "proj_MoneyOut";
            $dbmoney_out->Where = "WHERE project_id = '$dataproject[project_id]'";
            $usermoney_out = $dbmoney_out->Select();

            foreach ($usermoney_out as $datamoney_out) {
                $sumMoneyReal += (float)$datamoney_out['moneyOut_MoneyReal'];
            }

            foreach ($usermoney as $datamoney) {
                $sumMoneyReal_in += (float)$datamoney['moneyIN_Report'];
            }

            if ($sumMoneyReal_in > 0 && $sumMoneyReal > 0) {
                $roi = (($sumMoneyReal_in - $sumMoneyReal) / $sumMoneyReal_in) * 100;
            } else {
                $roi = 0;
            }

            $roi_by_year[$year] += $roi;
            $count_by_year[$year]++;
        }

        // 👉 เตรียมข้อมูลสำหรับกราฟ (รวมทุกปี — ถ้าไม่มีข้อมูลก็ 0)
        $yearList = [];
        $roiList = [];

        foreach ($years as $year) {
            $yearList[] = $year + 543;
            if (isset($roi_by_year[$year]) && $count_by_year[$year] > 0) {
                $roi = $roi_by_year[$year] / $count_by_year[$year];
                $roiList[] = round($roi, 2);
            } else {
                $roiList[] = 0;
            }
        }
        $yearListJson = implode(",", $yearList);
        $roiListJson = implode(",", $roiList);
        ?>

        <div class="card-body">
            <p align="center">
                <canvas id="roiByYearChart"></canvas>

                <script>
                    const roiByYearChart = [{
                        id: 'roiByYearChart',
                        labels: '[<?php echo $yearListJson; ?>]',
                        datas: '[<?php echo $roiListJson; ?>]',
                        con_data: 'ROI เฉลี่ย (%) ตามปี',
                        con_fig: null,
                        plugin: null,
                        color: '#f49f42'
                    }, ];
                    createChart(roiByYearChart);
                </script>
            </p>
        </div>
    </div>
</div>