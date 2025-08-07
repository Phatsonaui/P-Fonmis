<script src="
https://cdn.jsdelivr.net/npm/echarts@5.5.1/dist/echarts.min.js
"></script>
<style>
    .content-card {
        display: grid;
        grid-template-columns: repeat(4, minmax(150px, 1fr));
        gap: 10px;
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .project-container {
        display: grid;
        grid-template-columns: repeat(3, minmax(150px, 1fr));
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

    .kpi-card {
        border-radius: 12px;
        padding: 20px;
        height: 100%;
        border: none;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
        transition: all 0.3s ease;
        overflow: hidden;
        position: relative;
    }

    .kpi-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
    }

    .kpi-card>.success {
        /* content: ''; */
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #28a745, #20c997);
    }

    .card-body {
        padding: 1rem;
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
        }

        .project-container {
            grid-template-columns: repeat(2, minmax(150px, 1fr));
        }
    }
</style>
<div class="container-fluid pb-4" style=" color: #000000; background-color:#d8d6d6"><!--color: 2b4068-> 9d0208/ bgc: unset -->
    <div class="row g-3 mt-2">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="Page.php" style="color: #fff;">Home</a></li>
                <li class="breadcrumb-item active" id="activet" aria-current="page">โครงการ</li>
            </ol>
        </nav>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h1 style="font-weight: 700;">สรุปภาพรวม</h1>
        </div>
        <div class="col-md-9"></div>
        <div class="col-md-3">
            <form name="form55" id="form55" method="Post">
                <label for="project_Year" class="form-label"><strong>ประจำปีงบประมาณ <span class="text-danger">*</span></strong></label>
                <?php


                ?>
                <?php
                $dbuni = new Database('nurse');
                $dbuni->Table = "proj_list";
                $dbuni->Where = "order by project_id";
                $useruni = $dbuni->Select();

                $currentYear = date("Y");

                if (isset($_POST['proyear'])) {
                    $projyear = $_POST['proyear'];
                } else {
                    $projyear = $currentYear;
                }

                echo '<select class="form-select select-sm" name="proyear" id="proyear" OnChange="document.form55.submit();">';
                echo '<option>ปีงบประมาณ</option>';

                for ($year = $currentYear - 1; $year <= $currentYear + 3; $year++) {
                    $isDisabled = true;

                    // ตรวจสอบว่าปีนี้มีในฐานข้อมูลหรือไม่
                    foreach ($useruni as $datauni) {
                        if ($datauni['project_Year'] == $year) {
                            $isDisabled = false;
                            break;
                        }
                    }

                    echo '<option value="' . $year . '"';

                    // เลือกเฉพาะปีที่ตรงกับ selectedYear
                    if ($year == $projyear) {
                        echo ' selected';
                    }

                    if ($isDisabled) {
                        echo ' disabled';
                    }

                    echo '>' . ($year + 543) . '</option>';
                }

                echo '</select>';

                ?>
            </form>
        </div>

        <div class="col-md-12 mt-5">
            <div class="kpi-card">
                <h2><strong>โครงการ</strong></h2>
                <div class="content-card">
                    <div class="kpi-card">
                        <div class="card-body">
                            <div class="row"> <!-- style="align-items: center;" -->
                                <div class="flex-container-rounded">
                                    <p class="card-text"><i class="bi bi-journals"></i> จำนวนโครงการ </p>
                                    <p class="rounded-full success-full"></p>
                                </div>

                                <div class="d-flex justify-content-around">
                                    <h1 class="card-title">
                                        <?php
                                        $dbSumProject = new Database('nurse');
                                        $dbSumProject->Table = "proj_list";
                                        $dbSumProject->Where = "where project_Year ='$projyear' AND project_status <>'00' order by project_id";
                                        $userSumProject = $dbSumProject->Select();
                                        $SumProject = count($userSumProject);
                                        echo "<script> var sumProject = $SumProject; </script>$SumProject"
                                        ?>
                                    </h1>
                                    <!-- <div id="P_all" style="width: 100%;height: 100px;"></div> -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="kpi-card success">
                        <div class="card-body">
                            <div class="row" style="align-items: center;">
                                <div class="flex-container-rounded">
                                    <p class="card-text"><i class="bi bi-check-circle"></i> อนุมัติ </p>
                                    <p class="rounded-full success-full"></p>
                                </div>
                                <div class="d-flex justify-content-around">
                                    <h1 class="card-title">
                                        <?php
                                        $dbApprove = new Database('nurse');
                                        $dbApprove->Table = "proj_list";
                                        $dbApprove->Where = "where project_Year ='$projyear' AND project_status IN ('06','07','08','09','11','14') order by project_id";
                                        $userApprove = $dbApprove->Select();
                                        $approve = count($userApprove);
                                        echo "<script> var approve = $approve; </script>" . $approve;
                                        $approvePercent = ($approve / $SumProject) * 100;
                                        ?>
                                    </h1>
                                    <!-- <div id="P_app" style="width: 100%;height: 100px;"></div> -->
                                </div>
                            </div>
                        </div>
                        <p style="font-style: italic; font-size:11px;">(<?php echo number_format($approvePercent, 1); ?> %)</p>
                    </div>

                    <div class="kpi-card d-none">
                        <div class="card-body">
                            <div class="row" style="align-items: center;">
                                <p class="card-text">อยู่ระหว่างการขออนุมัติ</p>
                                <div class="d-flex justify-content-around">
                                    <h1 class="card-title">
                                        <?php

                                        $dbTimeLine = new Database('nurse');
                                        $dbTimeLine->Table = "proj_list";
                                        $dbTimeLine->Where = "where project_Year ='$projyear' AND project_status IN ('01','02','03','04','05','10','13','15') order by project_id";
                                        $userTimeLine = $dbTimeLine->Select();
                                        $TimeLine = count($userTimeLine);
                                        echo  "<script> var being = $TimeLine; </script>" . $TimeLine;
                                        $beingPercent = ($TimeLine / $SumProject) * 100;
                                        ?></h1>
                                    <!-- <div id="P_bing" style="width: 100%;height: 100px;"></div> -->
                                    <h1><i class="bi bi-clock"></i></h1>
                                </div>
                            </div>
                        </div>
                        <p style="font-style: italic; font-size:11px;">(<?php echo number_format($beingPercent, 1); ?> %)</p>
                    </div>

                    <div class="kpi-card">
                        <div class="card-body">
                            <div class="row" style="align-items: center;">
                                <div class="flex-container-rounded">
                                    <p class="card-text"><i class="bi bi-x-circle"></i> ไม่อนุมัติ </p>
                                    <p class="rounded-full danger-full"></p>
                                </div>
                                <div class="d-flex justify-content-around">
                                    <h1 class="card-title">
                                        <?php

                                        $dbNONApprove = new Database('nurse');
                                        $dbNONApprove->Table = "proj_list";
                                        $dbNONApprove->Where = "where project_Year ='$projyear' AND project_status ='12' order by project_id";
                                        $userNONApprove = $dbNONApprove->Select();
                                        $NONapprove = count($userNONApprove);
                                        echo "<script> var nota = $NONapprove; </script>" . $NONapprove;
                                        $notaPercent = ($NONapprove / $SumProject) * 100;
                                        ?>
                                    </h1>
                                    <!-- <div id="P_nota" style="width: 100%;height: 100px;"></div> -->
                                </div>
                            </div>
                        </div>
                        <p style="font-style: italic; font-size:11px;">(<?php echo number_format($notaPercent, 1); ?> %)</p>
                    </div>

                    <div class="kpi-card">
                        <div class="card-body">
                            <div class="row" style="align-items: center;">
                                <div class="flex-container-rounded">
                                    <p class="card-text"><i class="bi bi-x-circle"></i> ยกเลิกโครงการ </p>
                                    <p class="rounded-full danger-full"></p>
                                </div>
                                <div class="d-flex justify-content-around">
                                    <h1 class="card-title">
                                        <?php

                                        $dbCancel = new Database('nurse');
                                        $dbCancel->Table = "proj_list";
                                        $dbCancel->Where = "where project_Year ='$projyear' AND project_status ='16' order by project_id";
                                        $userCancel = $dbCancel->Select();
                                        $Cancel = count($userCancel);
                                        echo "<script> var cancel = $Cancel; </script>" . $Cancel;
                                        $cancelPercent = ($Cancel / $SumProject) * 100;
                                        ?>
                                    </h1>
                                    <!-- <div id="P_cancel" style="width: 100%;height: 100px;"></div> -->
                                </div>
                            </div>
                        </div>
                        <p style="font-style: italic; font-size:11px;">(<?php echo number_format($cancelPercent, 1); ?> %)</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-5">
            <div class="kpi-card">
                <h2><strong>รายงานผล</strong></h2>
                <div class="row justify-content-center">
                    <div class="col-md-5">
                        <div class="kpi-card">
                            <div id="re_pro" style="width: 100%; height:100%"></div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="content-card_re">
                            <div class="kpi-card">

                                <div class="card-body">
                                    <div class="flex-container-rounded">
                                        <p class="card-text"><i class="bi bi-check-circle"></i> รายงานผลเรียบร้อย </p>
                                        <p class="rounded-full success-full"></p>
                                    </div>
                                    <h1 class="card-title">
                                        <?php
                                        $dbSuccessProject = new Database('nurse');
                                        $dbSuccessProject->Table = "proj_list";
                                        $dbSuccessProject->Where = "where project_Year ='$projyear' AND project_status ='09' order by project_id";
                                        $userSuccessProject = $dbSuccessProject->Select();
                                        $SuccessProject = count($userSuccessProject);
                                        echo "<script> var suss_re = $SuccessProject; </script>" . $SuccessProject;
                                        $suss_rePercent = ($SuccessProject / $SumProject) * 100;
                                        ?></h1>
                                </div>
                                <p style="font-style: italic; font-size:11px;">(<?php echo number_format($suss_rePercent, 1); ?> %)</p>
                            </div>
                            <div class="kpi-card">

                                <div class="card-body">
                                    <div class="flex-container-rounded">
                                        <p class="card-text"><i class="bi bi-clock"></i> อยู่ระหว่างการรายงานผล </p>
                                        <p class="rounded-full warning-full"></p>
                                    </div>
                                    <h1 class="card-title">
                                        <?php
                                        $dbApprove_re = new Database('nurse');
                                        $dbApprove_re->Table = "proj_list";
                                        $dbApprove_re->Where = "where project_Year ='$projyear' AND (project_status ='07' OR project_status ='08' OR project_status ='11' OR  project_status ='14') order by project_id";
                                        $userApprove_re = $dbApprove_re->Select();
                                        $approve_re = count($userApprove_re);
                                        echo "<script> var approve_re = $approve_re; </script>" . $approve_re;
                                        $approve_rePercent = ($approve_re / $SumProject) * 100;
                                        ?>
                                    </h1>
                                </div>
                                <p style="font-style: italic; font-size:11px;">(<?php echo number_format($approve_rePercent, 1); ?> %)</p>
                            </div>

                            <a href="Page.php?feed=not_re&year_a=<?php echo $projyear; ?>" style="user-select: none; text-decoration: none; color: #000000;">
                                <div class="kpi-card">
                                    <div class="card-body">
                                        <div class="flex-container-rounded">
                                            <p class="card-text"><i class="bi bi-x-circle"></i> ไม่ได้ทำการรายงานผล </p>
                                            <p class="rounded-full danger-full"></p>
                                        </div>
                                        <h1 class="card-title">
                                            <?php
                                            $dbnouse = new Database('nurse');
                                            $dbnouse->Table = "proj_list";
                                            $dbnouse->Where = "where project_Year ='$projyear' AND (project_status ='06' ) order by project_id";
                                            $usernouse = $dbnouse->Select();
                                            $nouse_re = count($usernouse);
                                            echo "<script> var nouse_re = $nouse_re; </script>" . $nouse_re;
                                            $nouse_rePercent = ($nouse_re / $SumProject) * 100;
                                            ?>
                                        </h1>
                                    </div>
                                    <p style="font-style: italic; font-size:11px;">(<?php echo number_format($nouse_rePercent, 1); ?> %)</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12 mt-5">
                    <div class="kpi-card">
                        <h2><strong>ความสอดคล้องกับการวางแผน</strong></h2>
                        <div class="row">
                            <div class="col-md-7">
                                <div class="content-card_re">
                                    <div class="kpi-card">

                                        <div class="card-body">
                                            <div class="flex-container-rounded">
                                                <p class="card-text"><i class="bi bi-activity"></i> อยู่ในแผนปฏิบัติการ </p>
                                                <p class="rounded-full default-full"></p>
                                            </div>
                                            <h1 class="card-title">
                                                <?php
                                                $dbInProcess = new Database('nurse');
                                                $dbInProcess->Table = "proj_list";
                                                $dbInProcess->Where = "where project_Year ='$projyear' AND project_InOutProject='1' AND (project_status <>'00' AND  project_status <>'12' AND project_status <>'16') order by project_id";
                                                $userInProcess = $dbInProcess->Select();
                                                $InProcess = count($userInProcess);
                                                echo "<script> var inPro = $InProcess; </script>" . $InProcess;

                                                ?></h1>
                                        </div>
                                    </div>
                                    <div class="kpi-card">

                                        <div class="card-body">
                                            <div class="flex-container-rounded">
                                                <p class="card-text"><i class="bi bi-bullseye"></i> นอกแผนปฏิบัติการ </p>
                                                <p class="rounded-full default-full"></p>
                                            </div>
                                            <h1 class="card-title">
                                                <?php
                                                $dbOutProcess = new Database('nurse');
                                                $dbOutProcess->Table = "proj_list";
                                                $dbOutProcess->Where = "where project_Year ='$projyear' AND (project_status <>'00' AND  project_status <>'12' AND project_status <>'16') AND project_InOutProject='2' order by project_id";
                                                $userOutProcess = $dbOutProcess->Select();
                                                $OutProcess = count($userOutProcess);
                                                echo "<script> var outPro = $OutProcess; </script>" . $OutProcess;

                                                ?>
                                            </h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="kpi-card">
                                    <div id="process" style="width: 100%; height:100%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mt-5">
                    <div class="kpi-card">
                        <h2><strong>ลักษณะโครงการ</strong></h2>
                        <div class="row">
                            <div class="col-md-5">
                                <div class="kpi-card">
                                    <div id="in_process" style="width: 100%; height:100%"></div>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="content-card_re">
                                    <div class="kpi-card">

                                        <div class="card-body">
                                            <div class="flex-container-rounded">
                                                <p class="card-text"><i class="bi bi-bullseye"></i> โครงการต่อเนื่อง </p>
                                                <p class="rounded-full default-full"></p>
                                            </div>
                                            <h1 class="card-title">
                                                <?php
                                                $dbInProcess = new Database('nurse');
                                                $dbInProcess->Table = "proj_list";
                                                $dbInProcess->Where = "where project_Year ='$projyear' AND (project_status <>'00' AND  project_status <>'12' AND project_status <>'16')  AND project_NewContin='2' order by project_id";
                                                $userInProcess = $dbInProcess->Select();
                                                $InProcess = count($userInProcess);
                                                echo "<script> var con = $InProcess; </script>" . $InProcess;

                                                ?></h1>
                                        </div>
                                    </div>
                                    <div class="kpi-card">

                                        <div class="card-body">
                                            <div class="flex-container-rounded">
                                                <p class="card-text"><i class="bi bi-bullseye"></i> โครงการใหม่ </p>
                                                <p class="rounded-full default-full"></p>
                                            </div>
                                            <h1 class="card-title">
                                                <?php
                                                $dbProjectNew = new Database('nurse');
                                                $dbProjectNew->Table = "proj_list";
                                                $dbProjectNew->Where = "where project_Year ='$projyear' AND (project_status <>'00' AND  project_status <>'12' AND project_status <>'16') AND project_NewContin='1' order by project_id";
                                                $userProjectNew = $dbProjectNew->Select();
                                                $ProjectNew = count($userProjectNew);
                                                echo "<script> var newpro = $ProjectNew; </script>" . $ProjectNew;

                                                ?>
                                            </h1>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 mt-5">
            <div class="kpi-card">
                <h2><strong>ผลักดันวิสัยทัศน์ตามวัตถุประสงค์เชิงกลยุทธ์</strong></h2>
                <div class="row">
                    <div class="kpi-card">
                        <?php
                        // กำหนดรายการสี
                        $progressColors = ["bgg-primary", "bgg-success", "bgg-danger", "bgg-warning", "bgg-info"];
                        $colorIndex = 0; // ตัวนับสีเริ่มต้น
                        $dbPillar = new Database('nurse');
                        $dbPillar->Table = "stg_Pillar";
                        $dbPillar->Where = "where Pillar_year ='$projyear' order by Pillar_no"; //14 เป็น project_test
                        $userPillar = $dbPillar->Select();
                        foreach ($userPillar as $valuesPillar => $dataPillar) {
                            $dbProjPillar = new Database('nurse');
                            $dbProjPillar->Table = "proj_list";
                            $dbProjPillar->Where = "LEFT JOIN Proj_SO ON proj_list.project_id = Proj_SO.project_id where project_Year ='$projyear' AND (project_status <>'00' AND  project_status <>'12' AND project_status <>'16') AND Pillar_id='$dataPillar[Pillar_id]'";
                            $userProjPillar = $dbProjPillar->Select();
                            $ProjPillar = count($userProjPillar);
                            // เลือกสีจากรายการและอัพเดทตัวนับสี
                            $progressColor = $progressColors[$colorIndex];
                            $colorIndex = ($colorIndex + 1) % count($progressColors); // วนกลับไปที่สีแรกเมื่อครบจำนวนสี

                            echo '<div class="d-flex justify-content-between mt-3"><label class=" form-check-label text-break " >' . $dataPillar['Pillar_name'] . '</label><b>' . $ProjPillar . '</b></div>';
                            echo '<div class="progress">';
                            echo '<div class="progress-bar progress-bar-striped progress-bar-animated ' . $progressColor . '" role="progressbar" aria-label="Animated striped example" aria-valuenow="' . $ProjPillar . '" aria-valuemin="0" aria-valuemax="100" style="width: ' . $ProjPillar . '%"></div>';
                            echo '</div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-5">
            <div class="kpi-card">
                <h2><strong>รองรับการปฏิบัติงานประจำตามพันธกิจ</strong></h2>
                <div class="row">
                    <div class="kpi-card">
                        <?php
                        $progressColorsm = ["bgg-primary", "bgg-success", "bgg-danger", "bgg-warning", "bgg-info"];
                        $colorIndexm = 0;
                        $dbMission = new Database('nurse');
                        $dbMission->Table = "stg_Mission";
                        $dbMission->Where = "where mission_year ='$projyear' order by mission_no"; //14 เป็น project_test
                        $userMission = $dbMission->Select();
                        foreach ($userMission as $valuesMission => $dataMission) {
                            $dbProjMission = new Database('nurse');
                            $dbProjMission->Table = "proj_list";
                            $dbProjMission->Where = "LEFT JOIN Proj_Mission ON proj_list.project_id = Proj_Mission.project_id where project_Year ='$projyear' AND (project_status <>'00' AND  project_status <>'12' AND project_status <>'16') AND mission_id='$dataMission[mission_id]' ";
                            $userProjMission = $dbProjMission->Select();
                            $ProjMission = count($userProjMission);
                            $progressColorm = $progressColorsm[$colorIndexm];
                            $colorIndexm = ($colorIndexm + 1) % count($progressColorsm);

                            echo '<div class="d-flex justify-content-between mt-3"><label class=" form-check-label text-break " >' . $dataMission['mission_name'] . '</label><b>' . $ProjMission . '</b></div>';
                            echo '<div class="progress">';
                            echo '<div class="progress-bar progress-bar-striped progress-bar-animated ' . $progressColorm . '" role="progressbar" aria-label="Animated striped example" aria-valuenow="' . $ProjMission . '" aria-valuemin="0" aria-valuemax="100" style="width: ' . $ProjMission . '%"></div>';
                            echo '</div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 mt-5">
            <div class="kpi-card">
                <h2><strong>ความสอดคล้องกับกระบวนการปฏิบัติงาน</strong></h2>
                <div class="container-core">

                    <?php
                    $dbProcess = new Database('nurse');
                    $dbProcess->Table = "proj_Process";
                    $dbProcess->Where = "order by process_no"; //14 เป็น project_test
                    $userProcess = $dbProcess->Select();

                    foreach ($userProcess as $valuesProcess => $dataProcess) {
                        $dbProcessPart = new Database('nurse');
                        $dbProcessPart->Table = "proj_ProcessPart";
                        $dbProcessPart->Where = "where process_id='$dataProcess[process_id]' order by partwork_id"; //14 เป็น project_test
                        $userProcessPart = $dbProcessPart->Select();

                        $totalPartwork = 0;

                        foreach ($userProcessPart as $valuesProcessPart => $dataProcessPart) {
                            $dbpartwork = new Database('nurse');
                            $dbpartwork->Table = "proj_list";
                            $dbpartwork->Where = "LEFT JOIN Proj_ProcessProject ON proj_list.project_id = Proj_ProcessProject.project_id where project_Year ='$projyear' AND (project_status <>'00' AND  project_status <>'12' AND project_status <>'16') AND partwork_id='$dataProcessPart[partwork_id]'";
                            $userpartwork = $dbpartwork->Select();
                            $partwork = count($userpartwork);

                            $totalPartwork += $partwork;
                        }
                    ?>

                        <div class="card-core">
                            <div class="number-core"><?php echo $totalPartwork; ?></div>
                            <div class="header-core"><?php echo $dataProcess['process_name']; ?></div>

                            <?php
                            foreach ($userProcessPart as $valuesProcessPart => $dataProcessPart) {
                                $dbpartwork = new Database('nurse');
                                $dbpartwork->Table = "proj_list";
                                $dbpartwork->Where = "LEFT JOIN Proj_ProcessProject ON proj_list.project_id = Proj_ProcessProject.project_id where project_Year ='$projyear' AND (project_status <>'00' AND project_status <>'12' AND project_status <>'16') AND partwork_id='$dataProcessPart[partwork_id]'";
                                $userpartwork = $dbpartwork->Select();
                                $partwork = count($userpartwork);
                            ?>
                                <div class="list-item-core">
                                    <span><?php echo $dataProcessPart['partwork_name']; ?></span>
                                    <span class="badge-count"><?php echo $partwork; ?></span>
                                </div>
                            <?php } ?>
                        </div>

                    <?php } ?>


                </div>
            </div>
        </div>

        <div class="col-md-12 mt-5">
            <?php
            $In_re = $In_stu = $In_thum = $no_in = 0;

            $dbIn = new Database('nurse');
            $dbIn->Table = "proj_list";
            $dbIn->Where = "where project_Year = '$projyear' AND project_status NOT IN('00','12','16') AND project_id <> '14' AND project_id <> '183'";
            $userIn = $dbIn->Select();
            foreach ($userIn as $valuesIn => $dataIn) {
                if ($dataIn['project_Integration'] == '1') {
                    $In_stu++;
                } elseif ($dataIn['project_Integration'] == '2') {
                    $In_re++;
                } elseif ($dataIn['project_Integration'] == '3') {
                    $In_thum++;
                } else {
                    $no_in++;
                }
            }
            $sum_In_stu = $In_stu;
            $sum_In_re = $In_re;
            $sum_thum = $In_thum;
            $sum_no = $no_in;
            ?>
            <div class="kpi-card">
                <div class="justify-content-start">
                    <h2>บูรณาการ</h2>
                </div>
                <div class="row">
                    <div class="content-card">
                        <div class="kpi-card">
                            <h5 style="text-align: justify;"><i class="bi bi-mortarboard"></i> การเรียนการสอน</h5>
                            <h2 class="text-center"><span id="in_stud"><?php echo number_format($sum_In_stu); ?></span> </h2>
                        </div>
                        <div class="kpi-card">
                            <h5 style="text-align: justify;"><i class="bi bi-bar-chart-line"></i> การวิจัย</h5>
                            <h2 class="text-center"><span id="in_rese"><?php echo number_format($sum_In_re); ?></span> </h2>
                        </div>
                        <div class="kpi-card">
                            <h5 style="text-align: justify;"><i class="bi bi-bank"></i> การทำนุศิลปะและวัฒนธรรม</h5>
                            <h2 class="text-center"><span id="in_thum"><?php echo number_format($sum_thum); ?></span> </h2>
                        </div>
                        <div class="kpi-card">
                            <h5 style="text-align: justify;"><i class="bi bi-x-circle"></i> ไม่มี</h5>
                            <h2 class="text-center"><span id="in_no"><?php echo number_format($sum_no); ?></span> </h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 mt-5 d-none">
            <div class="kpi-card">
                <div class="justify-content-start">
                    <h2>ROI <i class="text-default" style="font-size: 12px;">= ((รายรับจริง - รายจ่าย) / รายจ่าย) X 100 </i></h2><i class="text-default" style="font-size: 12px;">ตัวเลขนี้ไม่รวมโครงการที่ไม่ได้รายงานผล</i>
                </div>
                <div class="row">
                    <div class="kpi-card">
                        <?php
                        $Roi = $sumMoneyReal = $sumMoneyReal_in = 0;
                        $dbGrp1 = new Database('nurse');
                        $dbGrp1->Table = "proj_list";
                        $dbGrp1->Where = "where project_Year = '$projyear' AND project_status IN('09') AND project_id <> '14' AND project_type = '2'";
                        $userGrp1 = $dbGrp1->Select();
                        foreach ($userGrp1 as $valuesproject => $dataproject) {

                            $dbmoney = new Database('nurse');
                            $dbmoney->Table = "Proj_MoneyIN";
                            $dbmoney->Where = "where project_id = '$dataproject[project_id]' ";
                            $usermoney = $dbmoney->Select();

                            $dbmoney_out = new Database('nurse');
                            $dbmoney_out->Table = "proj_MoneyOut";
                            $dbmoney_out->Where = "where project_id = '$dataproject[project_id]' ";
                            $usermoney_out = $dbmoney_out->Select();

                            foreach ($usermoney_out as $valuesmoney_out => $datamoney_out) {
                                $sumMoneyReal += (float)$datamoney_out['moneyOut_MoneyReal'];
                            }

                            foreach ($usermoney as $valuesmoney => $datamoney) {
                                $sumMoneyReal_in += (float)$datamoney['moneyIN_Report'];
                            }

                            // $Roi = $sumMoneyReal;
                            if ($sumMoneyReal_in > 0 && $sumMoneyReal > 0) { // ตรวจสอบว่า sumMoneyReal_in ไม่เป็นศูนย์ก่อนคำนวณ
                                $Roi = (($sumMoneyReal_in - $sumMoneyReal) / $sumMoneyReal_in) * 100;
                            } else {
                                $Roi = 0;
                            }
                        }
                        ?>
                        <div class="project-card project-card-default">
                            <h5 style="text-align: justify;"><i class="bi bi-coin"></i> ROI</h5>
                            <!-- <h4 style="color: #000;margin-bottom:0;"><span id="money_income">0</span> + <span id="money_income_real">0</span></h4> -->
                            <h2 class="d-flex justify-content-center"><span id="roii"><?php echo number_format($Roi, 2); ?></span> <span style="text-align: end;">%</span></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9 mt-5">
            <?php
            $money_outside_real = 0;
            $money_outside = 0;
            $money_income_real = 0;
            $money_income = 0;
            $money_regis_real = 0;
            $money_regis = 0;

            $dbGrp1 = new Database('nurse');
            $dbGrp1->Table = "proj_list";
            $dbGrp1->Where = "where project_Year = '$projyear' AND project_status IN('06','07','08','09','11','14') AND project_id <> '14'";
            $userGrp1 = $dbGrp1->Select();
            foreach ($userGrp1 as $valuesproject => $dataproject) {
                $project_ids = array_column($userGrp1, 'project_id'); // เก็บ project_id ทั้งหมดใน array

                if (!empty($project_ids)) {
                    $ids_string = implode("','", $project_ids); // แปลง array เป็น string สำหรับ query

                    // Query รวมเงินจากทั้ง source_id = '07' และ '06'
                    $dbmoney = new Database('nurse');
                    $dbmoney->Table = "Proj_MoneyIN";
                    $dbmoney->Where = "where project_id = '$dataproject[project_id]' AND source_id IN ('07', '06', '02')";
                    $usermoney = $dbmoney->Select();

                    if ($dataproject['project_status'] == "09") {
                        foreach ($usermoney as $valuesmoney => $datamoney) {
                            if ($datamoney['source_id'] == '07') {
                                $money_outside_real += (float)$datamoney['moneyIN_Report'];
                            } elseif ($datamoney['source_id'] == '06') {
                                $money_regis_real += (float)$datamoney['moneyIN_Report'];
                            } elseif ($datamoney['source_id'] == '02') {
                                $money_income_real += (float)$datamoney['moneyIN_Report'];
                            }
                        }
                    }
                }
            }
            $sum_outside = $money_outside + $money_outside_real;
            $sum_regis = $money_regis + $money_regis_real;
            $sum_income = $money_income + $money_income_real;
            ?>
            <div class="kpi-card">
                <div class="justify-content-start">
                    <h2>การใช้เงินภายในโครงการของคณะพยาบาลศาสตร์</h2><i class="text-default" style="font-size: 12px;">ตัวเลขนี้ไม่รวมโครงการที่ไม่ได้รายงานผล</i>
                </div>
                <div class="row">
                    <div class="project-container"> <!-- content-card -->
                        <div class="kpi-card">
                            <h5 style="text-align: justify;"><i class="bi bi-coin"></i> เงินรายได้ส่วนงาน</h5>
                            <h2><span id="sum_income"><?php echo number_format($money_income); ?></span> <span style="text-align: end;">บาท</span></h2>
                        </div>
                        <div class="kpi-card">
                            <h5 style="text-align: justify;"><i class="bi bi-coin"></i> เงินสนับสนุนภายนอก</h5>
                            <h2><span id="sum_outside"><?php echo number_format($sum_outside); ?></span> <span style="text-align: end;">บาท</span></h2>
                        </div>
                        <div class="kpi-card">
                            <h5 style="text-align: justify;"><i class="bi bi-coin"></i> เงินรายได้จากการลงทะเบียน</h5>
                            <h2><span id="sum_regis"><?php echo number_format($sum_regis); ?></span> <span style="text-align: end;">บาท</span></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function createPieChart(id, value1, value2, value3 = 0, name1, name2, name3 = '') {
        var chartDom = document.getElementById(id);
        var myChart = echarts.init(chartDom);

        // สร้าง data array
        var data = [{
                value: value1,
                name: name1,
                itemStyle: {
                    color: '#132d53'
                },
                label: {
                    color: '#000000'
                }
            },
            {
                value: value2,
                name: name2,
                itemStyle: {
                    color: '#ff9b69'
                },
                label: {
                    color: '#000000'
                }
            }
        ];

        // เพิ่ม item ที่ 3 ถ้า value3 ไม่เป็น 0
        if (value3 !== 0) {
            data.push({
                value: value3,
                name: name3,
                itemStyle: {
                    color: '#dd6b66'
                },
                label: {
                    color: '#000000'
                }
            });
        }

        var option = {
            legend: {
                top: '20%',
                left: 'center',
                textStyle: {
                    color: '#000000',
                    fontWeight: 'bold'
                }
            },
            backgroundColor: '',
            toolbox: {
                feature: {
                    saveAsImage: {}
                }
            },
            tooltip: {
                trigger: 'item'
            },
            series: [{
                type: 'pie',
                radius: ['40%', '70%'],
                center: ['50%', '85%'],
                startAngle: 180,
                endAngle: 360,
                data: data,
                emphasis: {
                    itemStyle: {
                        shadowBlur: 10,
                        shadowOffsetX: 0,
                        shadowColor: 'rgba(0, 0, 0, 0.5)'
                    }
                }
            }]
        };

        myChart.setOption(option);

        window.addEventListener('resize', function() {
            myChart.resize();
        });
    }

    // การเรียกใช้ฟังก์ชัน
    createPieChart('re_pro', suss_re, approve_re, nouse_re, 'รายงานผลเรียบร้อย', 'อยู่ระหว่างการรายงานผล', 'ไม่ได้ทำการรายงานผล');
    createPieChart('process', inPro, outPro, 0, 'อยู่ในแผนปฏิบัติการ', 'นอกแผนปฏิบัติการ', '');
    createPieChart('in_process', con, newpro, 0, 'โครงการต่อเนื่อง', 'โครงการใหม่', '');
</script>