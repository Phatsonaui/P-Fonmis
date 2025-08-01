<?php
include("../../class/class.db.php");
header('Content-Type: application/json');
$selectedYear = isset($_POST['year']) ? $_POST['year'] : '2023';

if ($selectedYear != '') {
    $all_pro = [];
    $ser_pro = [];
    $sum_p = $sum_m = $sum = $thumPercent = $Roi = $sumMoneyReal = $sumMoneyReal_in = $sum_money = $money_outside_real = $money_income_real = $sum_group = 0;

    $dbGrp1 = new Database('nurse');
    $dbGrp1->Table = "proj_list";
    $dbGrp1->Where = "where project_Year = '$selectedYear' AND project_status IN('09') AND project_id <> '14' AND project_type = '2'";
    $userGrp1 = $dbGrp1->Select();
    foreach ($userGrp1 as $valuesproject => $dataproject) {

        $dbmoney1 = new Database('nurse');
        $dbmoney1->Table = "Proj_MoneyIN";
        $dbmoney1->Where = "where project_id = '$dataproject[project_id]' ";
        $usermoney1 = $dbmoney1->Select();

        $dbmoney_out1 = new Database('nurse');
        $dbmoney_out1->Table = "proj_MoneyOut";
        $dbmoney_out1->Where = "where project_id = '$dataproject[project_id]' ";
        $usermoney_out1 = $dbmoney_out1->Select();

        foreach ($usermoney_out1 as $valuesmoney_out1 => $datamoney_out1) {
            $sumMoneyReal += (float)$datamoney_out1['moneyOut_MoneyReal'];
        }

        foreach ($usermoney1 as $valuesmoney1 => $datamoney1) {
            $sumMoneyReal_in += (float)$datamoney1['moneyIN_Report'];
        }

        // $Roi = $sumMoneyReal;
        if ($sumMoneyReal_in > 0 && $sumMoneyReal > 0) { // ตรวจสอบว่า sumMoneyReal_in ไม่เป็นศูนย์ก่อนคำนวณ
            $Roi = (($sumMoneyReal_in - $sumMoneyReal) / $sumMoneyReal_in) * 100;
        } else {
            $Roi = 0;
        }
    }
    $db = new Database('nurse');
    $db->Table = "proj_list";
    $db->Where = "where project_Year ='$selectedYear' AND project_id <> '000000000000014' AND  (project_status >= '06' AND (project_status NOT IN('00','10','12','13','16'))) ";
    $userdb = $db->Select();
    $SumProject = count($userdb);
    foreach ($userdb as $valuesdb => $datadb) {
        if ($datadb['project_status'] != "09") {
            $all_pro[] = $datadb['project_id'];
        }
    }

    // AND p.project_status NOT IN('00','10','12','13','16') 
    // AND p.project_status >= '06'
    $dbSumProject = new Database('nurse');
    $dbSumProject->Table = "proj_list p LEFT JOIN Proj_ProcessProject pp ON p.project_id = pp.project_id";
    $dbSumProject->Where = "
        WHERE p.project_Year = '$selectedYear' 
        AND p.project_status = '09'
        AND pp.partwork_id = '003'
        AND pp.process_id = '001'
        ORDER BY p.project_id";
    $userSumProject = $dbSumProject->Select();
    $sum_p = count($userSumProject);
    foreach ($userSumProject as $valuedbSumProject => $datadbSumProject) {
        $ser_pro[] = $datadbSumProject['project_id'];
    }

    $dbSumProject1 = new Database('nurse');
    $dbSumProject1->Table = "proj_list p LEFT JOIN Proj_ProcessProject pp ON p.project_id = pp.project_id";
    $dbSumProject1->Where = "
        WHERE p.project_Year = '$selectedYear' 
        AND p.project_status = '09'
        AND pp.partwork_id = '003'
        AND pp.process_id = '001'
        ORDER BY p.project_id";
    $userSumProject1 = $dbSumProject1->Select();
    $SumProject1 = count($userSumProject1);
    foreach ($userSumProject1 as $valuesproject => $dataproject) {

        $dbmoney = new Database('nurse');
        $dbmoney->Table = "proj_MoneyOut";
        $dbmoney->Where = "where project_id = '$dataproject[project_id]' ";
        $usermoney = $dbmoney->Select();

        foreach ($usermoney as $valuesmoney => $datamoney) {
            $sum_money += $datamoney['moneyOut_MoneyReport'];
        }

        $dbmoney_out = new Database('nurse');
        $dbmoney_out->Table = "Proj_MoneyIN";
        $dbmoney_out->Where = "where project_id = '$dataproject[project_id]' AND source_id IN ('07', '06', '02')";
        $usermoney_out = $dbmoney_out->Select();
        foreach ($usermoney_out as $valuesmoney_out => $datamoney_out) {
            if ($datamoney_out['source_id'] == '07' || $datamoney_out['source_id'] == '06') {
                $money_outside_real += (int)$datamoney_out['moneyIN_Report'];
            }
            if ($datamoney_out['source_id'] == '02') {
                $money_income_real += (int)$datamoney_out['moneyIN_Report'];
            }
        }

        $dbgroup = new Database('nurse');
        $dbgroup->Table = "proj_GrpGoal";
        $dbgroup->Where = "where project_id = '$dataproject[project_id]' AND grp_numberReal <> '' ORDER BY grp_id";
        $usergroup = $dbgroup->Select();

        foreach ($usergroup as $valuesgroup => $datagroup) {
            $sum_group += $datagroup['grp_numberReal'];
        }
    }
    $project_al = 0;
    $sum = $sum_p;
    $sum_m = $sum_money;

    if ($SumProject != 0) {
        $thumPercent = ($sum / $SumProject) * 100;
    } else {
        $thumPercent = 0; // ป้องกันหารด้วย 0
    }

    $project_al = $SumProject - $sum_p;


    echo json_encode([
        'project_al' => $project_al,
        'project' => $sum,
        'Percent' => $thumPercent,
        'sum_money' => $sum_m,
        'money_outside_real' => $money_outside_real,
        'money_income_real' => $money_income_real,
        'sum_group' => $sum_group,
        'allProjectIds' => $all_pro,
        'roi' => $Roi,
        'serProjectIds' => $ser_pro

    ]);
}
