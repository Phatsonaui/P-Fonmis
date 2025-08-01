<?php
include("../../class/class.db.php");

$selectedYear = isset($_POST['year']) ? $_POST['year'] : '2023';

if ($selectedYear != '') {
    $money_outside_real = 0;
    $money_outside = 0;
    $money_income_real = 0;
    $money_income = 0;
    $money_regis_real = 0;
    $money_regis = 0;

    $dbGrp1 = new Database('nurse');
    $dbGrp1->Table = "proj_list";
    $dbGrp1->Where = "where project_Year = '$selectedYear' AND project_status IN('06','07','08','09','11','14') AND project_id <> '14'";
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

        // ประมวลผลรวมเงิน
        
        if ($dataproject['project_status'] == "09") {
            foreach ($usermoney as $valuesmoney => $datamoney) {
                if ($datamoney['source_id'] == '07') {
                    $money_outside_real += $datamoney['moneyIN_Report'];
                } elseif ($datamoney['source_id'] == '06') {
                    $money_regis_real += $datamoney['moneyIN_Report'];
                } elseif ($datamoney['source_id'] == '02') {
                    $money_income_real += $datamoney['moneyIN_Report'];
                }
            }
        }
        // else{
        //     foreach ($usermoney as $valuesmoney => $datamoney) {
        //         if ($datamoney['source_id'] == '07') {
        //             $money_outside += $datamoney['moneyIN_Money'];
        //         } elseif ($datamoney['source_id'] == '06') {
        //             $money_regis += $datamoney['moneyIN_Money'];
        //         } elseif ($datamoney['source_id'] == '02') {
        //             $money_income += $datamoney['moneyIN_Money'];
        //         }
        //     }
        // }

    }
    }
    
    // Create an array with the updated values
    $response = array(
        'money_outside_real' => $money_outside_real,
        'money_outside' => $money_outside,
        'money_regis_real' => $money_regis_real,
        'money_regis' => $money_regis,
        'money_income_real' => $money_income_real,
        'money_income' => $money_income,
        'selectedYear' => $selectedYear
    );

    // Return the values as JSON
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
