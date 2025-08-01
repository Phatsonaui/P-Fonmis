<?php
include("../../class/class.db.php");
header('Content-Type: application/json');
$selectedYear = isset($_POST['year']) ? $_POST['year'] : '2023';
$sum_money = $money_outside_real = $money_income_real = $sum_group = 0;
if ($selectedYear != '') {
    $all_pro = [];
    $thum_pro = [];
    $sum_g = $sum = $thumPercent = 0;

    $db = new Database('nurse');
    $db->Table = "proj_list";
    $db->Where = "where project_Year ='$selectedYear' AND project_status >= '06' AND (project_status NOT IN('00','10','12','13','16')) ";
    $userdb = $db->Select();
    $SumProject = count($userdb);
    foreach($userdb as $valuesdb=>$datadb){ $all_pro[] = $datadb['project_id']; }

    $dbSumProject = new Database('nurse');
    $dbSumProject->Table = "proj_list";
    $dbSumProject->Where = "where project_Year ='$selectedYear' AND (project_status NOT IN('00','10','12','13','16')) AND FIND_IN_SET('3', REPLACE(project_Integration, ' ', '')) > 0 AND project_status >= '06' order by project_id";
    $userSumProject = $dbSumProject->Select();
    $SumProject2 = count($userSumProject);
    foreach($userSumProject as $valuedbSumProject=>$datadbSumProject){ $thum_pro[] = $datadbSumProject['project_id']; }

    $dbSumProject1 = new Database('nurse');
    $dbSumProject1->Table = "proj_list";
    $dbSumProject1->Where = "where project_Year ='$selectedYear'  AND FIND_IN_SET('3', REPLACE(project_Integration, ' ', '')) > 0 AND project_status = '09' order by project_id";
    $userSumProject1 = $dbSumProject1->Select();
    $SumProject1 = count($userSumProject1);
    foreach ($userSumProject1 as $valuesproject => $dataproject) {
    
        $dbmoney = new Database('nurse');
        $dbmoney->Table = "proj_MoneyOut";
        $dbmoney->Where = "where project_id = '$dataproject[project_id]' ";
        $usermoney = $dbmoney->Select();

            foreach ($usermoney as $valuesmoney => $datamoney) {
                $sum_money += (float)$datamoney['moneyOut_MoneyReport'];
            }

        $dbmoney_out = new Database('nurse');
        $dbmoney_out->Table = "Proj_MoneyIN";
        $dbmoney_out->Where = "where project_id = '$dataproject[project_id]' AND source_id IN ('07', '06', '02')";
        $usermoney_out = $dbmoney_out->Select();
            foreach ($usermoney_out as $valuesmoney_out => $datamoney_out) {
                if ($datamoney_out['source_id'] == '07' || $datamoney_out['source_id'] == '06') {
                    $money_outside_real += (float)$datamoney_out['moneyIN_Report'];
                }
                if ($datamoney_out['source_id'] == '02') {
                    $money_income_real += (float)$datamoney_out['moneyIN_Report'];
                }
            }

        $dbgroup = new Database('nurse');
        $dbgroup->Table = "proj_GrpGoal";
        $dbgroup->Where = "where project_id = '$dataproject[project_id]' AND grptype_id = '1' ";
        $usergroup = $dbgroup->Select();

            foreach ($usergroup as $valuesgroup => $datagroup) {
                $sum_group += (float)$datagroup['grp_numberReal'];
            }
    }

    
    ($sum_group ?? '') ? $sum_g = $sum_group : $sum_g = 0;
    
    ($sum_money ?? '') ? $sum = $sum_money : $sum = 0;
    $a = 0;
    if ($SumProject != 0) {
        $a = ($SumProject2 / $SumProject) * 100;
    }
    $thumPercent = $a;

    echo json_encode([
        'project_al' => $SumProject,
        'project' => $SumProject2,
        'Percent' => $thumPercent,
        'sum_money' => $sum,
        'money_outside_real' => $money_outside_real,
        'money_income_real' => $money_income_real,
        'sum_group' => $sum_group,
        'allProjectIds' => $all_pro, // ส่ง project_id ของ earn
        'thumProjectIds' => $thum_pro
    ]);
}
?>
