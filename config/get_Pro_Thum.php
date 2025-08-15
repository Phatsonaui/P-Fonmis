<?php
include("../../class/class.db.php");
header('Content-Type: application/json');

$selectedYear = isset($_POST['year']) ? $_POST['year'] : '2023';

// ป้องกัน SQL Injection
$selectedYear = intval($selectedYear);

if ($selectedYear <= 0) {
    echo json_encode(['error' => 'Invalid year']);
    exit;
}

$db = new Database('nurse');

// 1. ดึง project_id ทั้งหมดตามเงื่อนไข
// AND project_status >= '06' ถ้าต้องการดึงเฉพาะโครงการที่มีสถานะ >= '06' สามารถเพิ่มเงื่อนไขนี้ได้
$db->Table = "proj_list";
$db->Where = "WHERE project_Year = '$selectedYear' 
              AND project_Integration = 0 
              AND project_status NOT IN ('00','10','12','13','16')";
$allProjects = $db->Select();
$all_pro = array_column($allProjects, 'project_id');
$SumProject = count($all_pro);

// 2. ดึง project_id ที่มี project_Integration มี 3
$db->Where = "WHERE project_Year = '$selectedYear' 
              AND project_status NOT IN ('00','10','12','13','16') 
              AND project_Integration <> 0 
              AND FIND_IN_SET('3', REPLACE(project_Integration, ' ', '')) > 0 
              AND NOT FIND_IN_SET('2', REPLACE(project_Integration, ' ', ''))  
              AND NOT FIND_IN_SET('1', REPLACE(project_Integration, ' ', ''))
              ORDER BY project_id";
$thumProjects = $db->Select();
$thum_pro = array_column($thumProjects, 'project_id');
$SumProject2 = count($thum_pro);

// 3. ดึง project_id ที่มีทั้ง 1 และ 3
$db->Where = "WHERE project_Year = '$selectedYear' 
              AND project_status NOT IN ('00','10','12','13','16') 
              AND FIND_IN_SET('1', REPLACE(project_Integration, ' ', '')) > 0 
              AND NOT FIND_IN_SET('2', REPLACE(project_Integration, ' ', ''))
              AND FIND_IN_SET('3', REPLACE(project_Integration, ' ', '')) > 0 
              ORDER BY project_id";
$thumStdProjects = $db->Select();
$thum_std = array_column($thumStdProjects, 'project_id');
$Sumthum_st = count($thum_std);

// 4. ดึง project_id ที่มีทั้ง 2 และ 3
$db->Where = "WHERE project_Year = '$selectedYear' 
              AND project_status NOT IN ('00','10','12','13','16') 
              AND NOT FIND_IN_SET('1', REPLACE(project_Integration, ' ', ''))
              AND FIND_IN_SET('2', REPLACE(project_Integration, ' ', '')) > 0 
              AND FIND_IN_SET('3', REPLACE(project_Integration, ' ', '')) > 0 
              ORDER BY project_id";
$thumReProjects = $db->Select();
$thum_re = array_column($thumReProjects, 'project_id');
$Sumthum_re = count($thum_re);

// 5. ดึง project_id ที่มีทั้ง 1 2 และ 3
$db->Where = "WHERE project_Year = '$selectedYear'
              AND project_status NOT IN ('00','10','12','13','16')
              AND FIND_IN_SET('1', REPLACE(project_Integration, ' ', '')) > 0
              AND FIND_IN_SET('2', REPLACE(project_Integration, ' ', '')) > 0
              AND FIND_IN_SET('3', REPLACE(project_Integration, ' ', '')) > 0
              ORDER BY project_id";
$thumAllProjects = $db->Select();
$thum_all = array_column($thumAllProjects, 'project_id');
$Sumthum_all = count($thum_all);

// 6. ดึง project_id ที่มี project_Integration มี 3 และ project_status = '09'
$db->Where = "WHERE project_Year = '$selectedYear' 
              AND FIND_IN_SET('3', REPLACE(project_Integration, ' ', '')) > 0 
              AND project_status = '09' 
              ORDER BY project_id";
$finalProjects = $db->Select();

$sum_money = $money_outside_real = $money_income_real = $sum_group = 0;

if (!empty($finalProjects)) {
    $project_ids = implode("','", array_column($finalProjects, 'project_id'));

    // คำนวณ moneyOut_MoneyReport
    $db->Table = "proj_MoneyOut";
    $db->Where = "WHERE project_id IN ('$project_ids')";
    $moneyOutResults = $db->Select();
    foreach ($moneyOutResults as $row) {
        $sum_money += (float)$row['moneyOut_MoneyReport'];
    }

    // คำนวณ moneyIN_Report
    $db->Table = "Proj_MoneyIN";
    $db->Where = "WHERE project_id IN ('$project_ids') AND source_id IN ('07', '06', '02')";
    $moneyInResults = $db->Select();
    foreach ($moneyInResults as $row) {
        if (in_array($row['source_id'], ['07', '06'])) {
            $money_outside_real += (float)$row['moneyIN_Report'];
        } elseif ($row['source_id'] === '02') {
            $money_income_real += (float)$row['moneyIN_Report'];
        }
    }

    // คำนวณ grp_numberReal
    $db->Table = "proj_GrpGoal";
    $db->Where = "WHERE project_id IN ('$project_ids') AND grptype_id = '1'";
    $groupResults = $db->Select();
    foreach ($groupResults as $row) {
        $sum_group += (float)$row['grp_numberReal'];
    }
}

$thumPercent = $SumProject > 0 ? ($SumProject2 / $SumProject) * 100 : 0;

echo json_encode([
    'project_al' => $SumProject,
    'project' => $SumProject2,
    'SumThumStd' => $Sumthum_st,
    'SumThumRe' => $Sumthum_re,
    'SumThumAll' => $Sumthum_all,
    'Percent' => round($thumPercent, 2),
    'sum_money' => $sum_money,
    'money_outside_real' => $money_outside_real,
    'money_income_real' => $money_income_real,
    'sum_group' => $sum_group,
    'allProjectIds' => $all_pro,
    'thumProjectIds' => $thum_pro,
    'thumStd' => $thum_std,
    'thumRe' => $thum_re,
    'thumAll' => $thum_all,
]);
